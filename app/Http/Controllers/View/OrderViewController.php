<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderViewController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function checkout()
    {
        return view('orders.checkout');
    }

    public function show($id)
    {
        return view('orders.show', compact('id'));
    }
}
