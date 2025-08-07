<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->cart()->where('is_active', true)->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        DB::beginTransaction();

        try {
            $total = 0;
            $order = $user->orders()->create([
                'total_price' => 0,
                'status' => 'pending',
            ]);

            foreach ($cart->cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Stok tidak cukup untuk {$item->product->name}");
                }

                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $total += $item->product->price * $item->quantity;

                $item->product->decrement('stock', $item->quantity);
            }

            $order->update(['total_price' => $total]);
            $cart->update(['is_active' => false]);

            DB::commit();
            return response()->json(['message' => 'Checkout success', 'order' => $order]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
