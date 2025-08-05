<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function homeAdmin()
    {
        // Dữ liệu tổng quan
        $totalRevenue = OrderDetail::sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalStock = ProductVariant::sum('quantity');

        // Dữ liệu cho biểu đồ và các bảng
        $charts = [
            'initialRevenueData' => $this->getRevenueByDayData(30),
        ];

        $topProducts = $this->getTopProductsData();
        $categoryRevenue = $this->getRevenueByCategoryData();
        $lowStock = $this->getLowStockProducts();

        return view('admin.homeAdmin', compact(
            'totalRevenue', 'totalOrders', 'totalProducts', 'totalStock',
            'charts', 'topProducts', 'categoryRevenue', 'lowStock'
        ));
    }

    public function getRevenueChartData(Request $request)
    {
        $period = $request->input('period', '30d');
        $data = [];
        switch ($period) {
            case '7d': $data = $this->getRevenueByDayData(7); break;
            case '12m': $data = $this->getRevenueByMonthData(); break;
            default: $data = $this->getRevenueByDayData(30); break;
        }
        return response()->json($data);
    }

    private function getRevenueByMonthData(): array
    {
        $labels = [];
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = 'T' . $month->format('n/y');
            $data[$month->format('Y-m')] = 0;
        }
        $revenueData = OrderDetail::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total_revenue')
            ->groupBy('month')->get();
        foreach ($revenueData as $record) {
            if (isset($data[$record->month])) {
                $data[$record->month] = (float) $record->total_revenue;
            }
        }
        return ['labels' => $labels, 'data' => array_values($data)];
    }

    private function getRevenueByDayData(int $days = 30): array
    {
        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d/m');
            $data[$date->format('Y-m-d')] = 0;
        }
        $revenueData = OrderDetail::where('created_at', '>=', Carbon::now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total_revenue')
            ->groupBy('date')->get();
        foreach ($revenueData as $record) {
            if (isset($data[$record->date])) {
                $data[$record->date] = (float) $record->total_revenue;
            }
        }
        return ['labels' => $labels, 'data' => array_values($data)];
    }

    // ĐÃ SỬA: Xóa ': array'
    private function getRevenueByCategoryData()
    {
        return OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.total) as total_revenue')
            )
            ->groupBy('categories.name')
            ->orderByDesc('total_revenue')
            ->get();
    }

    // ĐÃ SỬA: Xóa ': array'
    private function getTopProductsData()
    {
        return OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(order_details.quantity) as total_sold'),
                DB::raw('SUM(order_details.total) as total_revenue')
            )
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
    }

    private function getLowStockProducts()
    {
        return ProductVariant::join('products', 'product_variants.id_product', '=', 'products.id')
            ->select('products.name', 'product_variants.quantity')
            ->where('product_variants.quantity', '<=', 5)
            ->orderBy('product_variants.quantity', 'asc')
            ->get();
    }
}