<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductViewController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_BASE_URL') . '/api/products');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data produk dari API');
        }

        $products = $response->json();
        
        return view('products.index', compact('products'));
    }

    public function mainIndex()
    {
        $response = Http::get(env('API_BASE_URL') . '/api/products');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data produk dari API');
        }

        $randomProducts = collect($response->json())->shuffle();
        $products = $response->json();
        
        return view('main.index', compact('products', 'randomProducts'));
    }

    public function search(Request $request)
    {
        $query = strtolower($request->s);

        $response = Http::get(env('API_BASE_URL') . '/api/products');

        if ($response->failed()) {
            abort(500, 'Gagal mengambil data produk dari API');
        }

        $products = collect($response->json())
            ->filter(function ($product) use ($query) {
                return str_contains(strtolower($product['name']), $query);
            })
            ->values()
            ->all();

        return view('products.index', compact('products', 'query'));
    }
}
