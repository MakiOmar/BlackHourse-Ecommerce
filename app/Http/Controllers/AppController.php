<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AppController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'published')->get()->take(12);
        return view('index', [
            'products' => $products,
        ]);
    }
}
