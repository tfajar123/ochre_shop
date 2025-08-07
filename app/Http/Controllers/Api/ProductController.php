<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $this->authorize('admin-only');

        $validatedData = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar ke folder public/images
        if ($request->hasFile('image')) {
            $filename = round(microtime(true)) . '-' . str_replace(' ', '', $request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images'), $filename);
            $validatedData['image_url'] = $filename;
        }

        $product = Product::create($validatedData);
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('admin-only');

        $validatedData = $request->validate([
            'name'        => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'sometimes|numeric',
            'stock'       => 'sometimes|integer',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            $filename = round(microtime(true)) . '-' . str_replace(' ', '', $request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images'), $filename);
            $validatedData['image_url'] = $filename;
        }

        $product->update($validatedData);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('admin-only');
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
