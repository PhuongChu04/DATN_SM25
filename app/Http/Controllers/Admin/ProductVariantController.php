<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected $productVariantService;
    public function __construct(ProductVariantService $productVariantService){
        $this->productVariantService = $productVariantService;
    }
    public function index()
    {
        $variants = $this->productVariantService->getProductVariants();
        return view('admin.product_variant.listVariant', compact('variants'));
    }

/**
     * Hiển thị form tạo biến thể sản phẩm.
     */
    public function create()
    {
        $products = \App\Models\Product::all();
        $colors = \App\Models\Color::all();
        $sizes = \App\Models\Size::all();
        return view('admin.product_variant.addVariant', compact('products', 'colors', 'sizes'));
    }

    /**
     * Lưu biến thể sản phẩm mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'id_color' => 'required|exists:colors,id',
            'id_size' => 'required|exists:sizes,id',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'status' => 'required|in:active,inactive',
        ]);

        $variant = $this->productVariantService->createProductVariant($request->all());
        if ($variant) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Thêm biến thể sản phẩm thành công');
        }
        return redirect()->route('admin.product_variant.index')->with('error', 'Thêm biến thể sản phẩm thất bại');
    }

    /**
     * Hiển thị form chỉnh sửa biến thể sản phẩm.
     */
    public function edit($id)
    {
        $variant = $this->productVariantService->getProductVariantsById($id);
        $products = \App\Models\Product::all();
        $colors = \App\Models\Color::all();
        $sizes = \App\Models\Size::all();
        return view('admin.product_variant.editVariant', compact('variant', 'products', 'colors', 'sizes'));
    }

    /**
     * Cập nhật biến thể sản phẩm.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'id_color' => 'required|exists:colors,id',
            'id_size' => 'required|exists:sizes,id',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'status' => 'required|in:active,inactive',
        ]);

        $variant = $this->productVariantService->updateProductVariant($request->all(), $id);
        if ($variant) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Cập nhật biến thể sản phẩm thành công');
        }
        return redirect()->route('admin.product_variant.index')->with('error', 'Cập nhật biến thể sản phẩm thất bại');
    }

    /**
     * Xóa mềm biến thể sản phẩm.
     */
    public function destroy($id)
    {
        if ($this->productVariantService->deleteProductVariant($id)) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Xóa biến thể sản phẩm thành công');
        }
        return redirect()->route('admin.product_variant.index')->with('error', 'Xóa biến thể sản phẩm thất bại');
    }

    /**
     * Hiển thị danh sách biến thể sản phẩm đã xóa mềm.
     */
    public function trash()
    {
        $trashedVariants = $this->productVariantService->getTrashedProductVariants();
        return view('admin.product_variant.trashVariant', compact('trashedVariants'));
    }

    /**
     * Khôi phục biến thể sản phẩm.
     */
    public function restore($id)
    {
        if ($this->productVariantService->restoreProductVariant($id)) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Khôi phục biến thể sản phẩm thành công');
        }
        return redirect()->route('admin.product_variant.index')->with('error', 'Khôi phục biến thể sản phẩm thất bại');
    }

    /**
     * Xóa vĩnh viễn biến thể sản phẩm.
     */
    public function forceDelete($id)
    {
        if ($this->productVariantService->forceDeleteProductVariant($id)) {
            return redirect()->route('admin.product_variant.trash')->with('success', 'Xóa vĩnh viễn biến thể sản phẩm thành công');
        }
        return redirect()->route('admin.product_variant.trash')->with('error', 'Xóa vĩnh viễn biến thể sản phẩm thất bại');
    }

    /**
     * Xóa mềm hàng loạt.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->route('admin.product_variant.index')->with('error', 'Chưa chọn biến thể nào');
        }
        if ($this->productVariantService->bulkDelete($ids)) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Xóa hàng loạt biến thể thành công');
        }
        return redirect()->route('admin.product_variant.index')->with('error', 'Xóa hàng loạt biến thể thất bại');
    }

    /**
     * Khôi phục hàng loạt.
     */
    public function bulkRestore(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->route('admin.product_variant.trash')->with('error', 'Chưa chọn biến thể nào');
        }
        if ($this->productVariantService->bulkRestore($ids)) {
            return redirect()->route('admin.product_variant.index')->with('success', 'Khôi phục hàng loạt biến thể thành công');
        }
        return redirect()->route('admin.product_variant.trash')->with('error', 'Khôi phục hàng loạt biến thể thất bại');
    }


}

?>