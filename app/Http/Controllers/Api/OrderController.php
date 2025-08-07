<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $orders = Order::with('user', 'orderItems.product')->latest()->get();
        } else {
            $orders = $user->orders()->with('orderItems.product')->latest()->get();
        }

        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        $this->authorize('view', $order);

        return response()->json($order);
    }

}
