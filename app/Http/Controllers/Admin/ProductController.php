<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;
    protected $productVariantService;

    public function __construct(ProductService $productService, ProductVariantService $productVariantService)
    {
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }
    public function list()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.product.list-product', compact('products'));
    }
    public function create()
    {
        $brands = Brand::all();
        $cate = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.create-product', compact('cate', 'brands', 'colors', 'sizes'));
    }

    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250|unique:products,name',
            'description' => 'nullable|string',
            'id_brand' => 'required|exists:brands,id',
            'id_category' => 'required|exists:categories,id',
            'image_primary' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'in:active,inactive',

            // mảng biến thể
            'variants' => 'required|array|min:1',
            'variants.*.id_color' => 'required|exists:colors,id',
            'variants.*.id_size' => 'required|exists:sizes,id',
            'variants.*.quantity' => 'required|integer|min:0',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.sale_price' => 'nullable|numeric|min:0',
        ]);

        // Ràng buộc sale_price < price cho từng biến thể (nếu có sale_price)
        $validator->after(function ($v) use ($request) {
            foreach (($request->input('variants') ?? []) as $idx => $var) {
                if (isset($var['sale_price']) && $var['sale_price'] !== null && $var['sale_price'] !== '') {
                    $sale = (float)$var['sale_price'];
                    $price = (float)($var['price'] ?? 0);
                    if ($sale >= $price) {
                        $v->errors()->add("variants.$idx.sale_price", "Giá sale phải nhỏ hơn giá gốc (hàng #" . ($idx + 1) . ").");
                    }
                }
            }
        });

        $validator->validate();

        // Tạo sản phẩm
        $product = $this->productService->createProduct($request->all());

        if ($product) {
            // Tạo biến thể (có cả sale_price)
            foreach ($request->variants as $variant) {
                $variant['id_product'] = $product->id;
                // Nếu rỗng thì set null
                if (($variant['sale_price'] ?? '') === '') {
                    $variant['sale_price'] = null;
                }
                $this->productVariantService->createProductVariant($variant);
            }

            return redirect()->route('admin.product.listProduct')
                ->with('success', 'Thêm sản phẩm và biến thể thành công');
        }

        return back()->withErrors(['error' => 'Không thể tạo sản phẩm.'])->withInput();
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $brands = Brand::all();
        $cate = Category::all();

        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.edit-product', compact('product', 'brands', 'cate', 'colors', 'sizes'));
    }

    public function postEdit(Request $request, $id)
    {
        // Validate phần product
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:250|unique:products,name,' . $id,
            'description'   => 'nullable|string',
            'id_brand'      => 'required|exists:brands,id',
            'id_category'   => 'required|exists:categories,id',
            'image_primary' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status'        => 'in:active,inactive',

            // --- biến thể cũ ---
            'variants'                  => 'nullable|array',
            'variants.*.id'             => 'required_with:variants|integer|exists:product_variants,id',
            'variants.*.id_color'       => 'nullable|integer|exists:colors,id',
            'variants.*.id_size'        => 'nullable|integer|exists:sizes,id',
            'variants.*.quantity'       => 'nullable|integer|min:0',
            'variants.*.price'          => 'nullable|numeric|min:0',
            'variants.*.sale_price'     => 'nullable|numeric|min:0',

            // --- biến thể mới ---
            'variants_new'              => 'nullable|array',
            'variants_new.*.id_color'   => 'required_with:variants_new|integer|exists:colors,id',
            'variants_new.*.id_size'    => 'required_with:variants_new|integer|exists:sizes,id',
            'variants_new.*.quantity'   => 'required_with:variants_new|integer|min:0',
            'variants_new.*.price'      => 'required_with:variants_new|numeric|min:0',
            'variants_new.*.sale_price' => 'nullable|numeric|min:0',
        ]);

        // Ràng buộc: sale_price < price cho từng item (cũ & mới)
        $validator->after(function ($v) use ($request) {
            foreach (($request->input('variants') ?? []) as $idx => $var) {
                $price = isset($var['price']) ? (float)$var['price'] : null;
                $sale  = isset($var['sale_price']) && $var['sale_price'] !== '' ? (float)$var['sale_price'] : null;
                if ($sale !== null && $price !== null && $sale >= $price) {
                    $v->errors()->add("variants.$idx.sale_price", "Giá sale phải nhỏ hơn giá gốc (hàng #" . ($idx + 1) . ").");
                }
            }
            foreach (($request->input('variants_new') ?? []) as $idx => $var) {
                $price = isset($var['price']) ? (float)$var['price'] : null;
                $sale  = isset($var['sale_price']) && $var['sale_price'] !== '' ? (float)$var['sale_price'] : null;
                if ($sale !== null && $price !== null && $sale >= $price) {
                    $v->errors()->add("variants_new.$idx.sale_price", "Giá sale phải nhỏ hơn giá gốc (mới #" . ($idx + 1) . ").");
                }
            }
        });

        $validator->validate();

        // Cập nhật product
        $product = $this->productService->updateProduct($request->all(), $id);
        if (!$product) {
            return redirect()->route('admin.product.edit', $id)
                ->with('error', 'Cập nhật sản phẩm thất bại');
        }

        // --- cập nhật biến thể cũ ---
        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                if (!empty($variantData['id'])) {
                    // sale_price rỗng -> null
                    if (!isset($variantData['sale_price']) || $variantData['sale_price'] === '') {
                        $variantData['sale_price'] = null;
                    }
                    $this->productVariantService->updateProductVariant($variantData, $variantData['id']);
                }
            }
        }

        // --- thêm biến thể mới ---
        if ($request->filled('variants_new')) {
            foreach ($request->variants_new as $variantNew) {
                $variantNew['id_product'] = $id;
                if (!isset($variantNew['sale_price']) || $variantNew['sale_price'] === '') {
                    $variantNew['sale_price'] = null;
                }
                $this->productVariantService->createProductVariant($variantNew);
            }
        }

        return redirect()->route('admin.product.listProduct')
            ->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function detail($id)
    {
        $product = $this->productService->getProductById($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.detail-product', compact('product', 'brands', 'categories'));
    }

    public function trash()
    {
        $trashedProducts = $this->productService->getTrashedProducts();
        return view('admin.product.trashProduct', compact('trashedProducts'));
    }
    public function restore($id)
    {
        if ($this->productService->restoreProduct($id)) {
            return redirect()->route('admin.product.listProduct')->with('success', 'Khôi phục sản phẩm thành công');
        }
        return redirect()->route('admin.product.trash')->with('error', 'Khôi phục sản phẩm thất bại');
    }



    public function destroy($id)
    {
        if ($this->productService->deleteProduct($id)) {
            return redirect()->route('admin.product.listProduct')->with('success', 'Xóa sản phẩm thành công');
        }
        return redirect()->route('admin.product.listProduct')->with('error', 'Xóa sản phẩm thất bại');
    }
    public function forceDelete($id) //vĩnh viễn
    {
        if ($this->productService->delete($id)) {
            return redirect()->route('admin.product.trash')->with('success', 'Xóa vĩnh viễn sản phẩm thành công');
        }
        return redirect()->route('admin.product.trash')->with('error', 'Xóa vĩnh viễn sản phẩm thất bại');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->route('admin.product.trash')->with('error', 'Chưa chọn sản phẩm nào');
        }
        if ($this->productService->bulkDelete($ids)) {
            return redirect()->route('admin.product.listProduct')->with('success', 'Xóa hàng loạt thành công');
        }
        return redirect()->route('admin.product.listProduct')->with('error', 'Xóa hàng loạt thất bại');
    }


    public function bulkRestore(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->route('admin.product.trash')->with('error', 'Chưa chọn sản phẩm nào');
        }
        if ($this->productService->bulkRestore($ids)) {
            return redirect()->route('admin.product.listProduct')->with('success', 'Khôi phục hàng loạt thành công');
        }
        return redirect()->route('admin.product.trash')->with('error', 'Khôi phục hàng loạt thất bại');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $products = Product::with(['brand', 'category'])
            ->when(!empty($searchTerm), function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('brand', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })->paginate(10);
        $search = $searchTerm;
        if ($request->ajax()) {
            return view('admin.product.components.product-table', compact('products'))->render();
        }
        return view('admin.product.list-product', compact('products', 'search'));
    }
}
