<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use Illuminate\Support\Facades\Http;

class DashboardViewController extends Controller
{
    public function index(){
        // Total pendapatan bulan ini
        $monthlyEarnings = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'completed')
            ->sum('total_price');

        // Total pendapatan setahun ini
        $annualEarnings = Order::whereYear('created_at', now()->year)
            ->where('status', 'completed')
            ->sum('total_price');

        // Jumlah request pending
        $pendingRequests = Order::where('status', 'pending')->count();

 
        $taskPercentage = 50; 


        $chartData = Order::selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->where('status', 'completed')
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->orderByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total', 'month');

        $chartLabels = array_map(function($m) {
            return date('F', mktime(0, 0, 0, $m, 1));
        }, array_keys($chartData->toArray()));


        return view('dashboard.index', compact(
            'monthlyEarnings',
            'annualEarnings',
            'pendingRequests',
            'taskPercentage',
            'chartData',
            'chartLabels'
        ));
    }

    public function products(){
        $response = Http::get(env('API_BASE_URL') . '/api/products');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data produk dari API');
        }

        $products = $response->json();
        
        return view('dashboard.product', compact('products'));
    }

    public function create(){
        return view('dashboard.create');
    }

    public function edit($id){
        $response = Http::get(env('API_BASE_URL') . "/api/products/{$id}");

        if ($response->failed()) {
            abort(404, 'Product not found');
        }

        $product = $response->json();
        return view('dashboard.edit', compact('product'));
    }

    
    public function showOrders()
    {
        $response = Http::get(env('API_BASE_URL') . '/api/orders-all');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data order dari API');
        }

        $orders = $response->json();
        
        return view('dashboard.orders', compact('orders'));
    }
}
