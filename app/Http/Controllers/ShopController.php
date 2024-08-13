<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;
        $size = $request->query('size') ?? 12;
        $order = $request->query('order') ?? -1;
        $order_by = '';
        $order_type = '';
        switch ($order) {
            case '1':
                $order_by = 'created_at';
                $order_type = 'DESC';
                break;

            case '2':
                $order_by = 'created_at';
                $order_type = 'ASC';
                break;

            case '3':
                $order_by = 'regular_price';
                $order_type = 'ASC';
                break;

            case '4':
                $order_by = 'regular_price';
                $order_type = 'DESC';
                break;

            default:
                $order_by = 'id';
                $order_type = 'DESC';
                break;
        }
        $products = Product::orderBy($order_by, $order_type)->paginate($size);
        return view('shop', ['products' => $products, 'page' => $page, 'size' => $size, 'order' => $order]);
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder()->get()->take(8);
        return view('details', ['product' => $product, 'products' => $products]);
    }
}
