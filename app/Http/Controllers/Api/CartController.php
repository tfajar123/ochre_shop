<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('cartItems.product')->firstOrCreate(['is_active' => true]);
        return response()->json($cart);
    }

    public function add(Request $request)
    {
         $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = auth()->user()->cart()->firstOrCreate(['is_active' => true]);

        $existingItem = $cart->cartItems()->where('product_id', $request->product_id)->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            $existingItem = $cart->cartItems()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'message' => 'Item added to cart',
            'item' => $existingItem,
        ]);
    }

    public function remove(Request $request)
    {
        $cart = auth()->user()->cart;
        $cart->cartItems()->where('product_id', $request->product_id)->delete();

        return response()->json(['message' => 'Item removed']);
    }

}
