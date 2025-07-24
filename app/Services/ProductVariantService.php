<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class ProductVariantService
{
    public function getProductVariants()
    {
        return ProductVariant::with(['product', 'color', 'size'])->get();
    }

    public function getProductVariantsById($id)
    {
        return ProductVariant::with(['product', 'color', 'size'])->findOrFail($id);
    }

    public function createProductVariant($data)
    {
        try {
            return ProductVariant::create($data);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function updateProductVariant($data, $id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);
            $variant->update($data);
            return $variant;
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProductVariant($id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);
            $variant->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function getTrashedProductVariants()
    {
        return ProductVariant::onlyTrashed()->with(['product', 'color', 'size'])->get();
    }

    public function restoreProductVariant($id)
    {
        try {
            $variant = ProductVariant::onlyTrashed()->findOrFail($id);
            $variant->restore();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi khôi phục biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function forceDeleteProductVariant($id)
    {
        try {
            $variant = ProductVariant::onlyTrashed()->findOrFail($id);
            $variant->forceDelete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa vĩnh viễn biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function bulkDelete(array $ids)
    {
        try {
            ProductVariant::whereIn('id', $ids)->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa hàng loạt biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

    public function bulkRestore(array $ids)
    {
        try {
            ProductVariant::onlyTrashed()->whereIn('id', $ids)->restore();
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi khôi phục hàng loạt biến thể sản phẩm: ' . $e->getMessage());
            return false;
        }
    }

 
  
}