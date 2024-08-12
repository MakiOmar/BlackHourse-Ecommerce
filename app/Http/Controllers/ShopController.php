<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('shop', ['products' => $products]);
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder()->get()->take(8);
        return view('details', ['product' => $product, 'products' => $products]);
    }
}
