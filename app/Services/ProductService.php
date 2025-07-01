<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductService
{



    public function getAllProducts()
    {
        return Product::with(['brand', 'category'])->paginate(10);
    }


    // public function getProductById($id) //lấy sản phẩm theo id
    // {
    //     return Product::with(['brand', 'category'])->findOrFail($id);
    // }
    public function getProductById($id)
    {
        return Product::with(['brand', 'category', 'variants.color', 'variants.size'])
            ->findOrFail($id);
    }

    public function createProduct($data)
    {
        try {
            if (isset($data['image_primary'])) {
                $data['image_primary'] = $data['image_primary']->store('products', 'public');
            }
            return Product::create($data);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật sản phẩm.
     */
    public function updateProduct($data, $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (isset($data['image_primary'])) {
                if ($product->image_primary) {
                    Storage::disk('public')->delete($product->image_primary);
                }
                $data['image_primary'] = $data['image_primary']->store('products', 'public');
            }
            $product->update($data);
            return $product;
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function deleteProduct($id) //xóa mềm
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function getTrashedProducts() //danh sách đã xóa
    {
        return Product::onlyTrashed()->with(['brand', 'category'])->get();
    }

    public function restoreProduct($id) //khôi phục sản phẩm đã xóa 
    {
        try {
            $product = Product::onlyTrashed()->findOrFail($id);
            $product->restore();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi khôi phục sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function delete($id) //xóa vĩnh viễn
    {
        try {
            $product = Product::onlyTrashed()->findOrFail($id);
            if ($product->image_primary) {
                Storage::disk('public')->delete($product->image_primary);
            }
            $product->forceDelete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa vĩnh viễn sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function bulkDelete(array $ids) // xóa nhiều bản ghi
    {
        try {
            Product::whereIn('id', $ids)->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa hàng loạt sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function bulkRestore(array $ids) //khôi phục nhiều bản ghi
    {
        try {
            Product::onlyTrashed()->whereIn('id', $ids)->restore();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi khôi phục hàng loạt sản phẩm: ' . $e->getMessage());
            return false;
        }
    }


    public function getProductsByCategory($categoryId)
    {
        return Product::with(['variants.color', 'variants.size'])
            ->where('id_category', $categoryId)
            ->where('status', 'active')
            ->whereHas('variants', function ($query) {
                $query->where('price', '>', 0);
            });
    }
}
