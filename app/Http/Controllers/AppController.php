<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class AppController extends Controller
{
    public function index()
    {
        $cartCount = Cart::content()->count();
        $products = Product::where('status', 'published')->get()->take(12);
        return view('index', [
            'products' => $products,
            'cartCount' => $cartCount,
        ]);
    }
}
