<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Cart;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $cartCount = Cart::content()->count();
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
        $categories = Category::orderBy('name', 'ASC')->get();
        $q_categories = $request->query('categories');

        $brands = Brand::orderBy('name', 'ASC')->get();
        $q_brands = $request->query('brands');

        $prange = $request->query('prange') ?? '0,500';
        $from = explode(',', $prange)[0];
        $to = explode(',', $prange)[1];
        $products = Product::where(
            function ($query) use ($q_categories) {
                $query->whereIn('category_id', explode(',', $q_categories))->orWhereRaw("'" . $q_categories . "'=''");
            }
        )
        ->where(
            function ($query) use ($q_brands) {
                $query->whereIn('brand_id', explode(',', $q_brands))->orWhereRaw("'" . $q_brands . "'=''");
            }
        )
        ->where('status', 'published')
        ->whereBetween('regular_price', array($from,$to))
        ->orderBy($order_by, $order_type)->paginate($size);
        return view('shop', [
            'products' => $products,
            'page' => $page,
            'size' => $size,
            'order' => $order,
            'categories' => $categories,
            'q_categories' => $q_categories,
            'brands' => $brands,
            'q_brands' => $q_brands,
            'from' => $from,
            'to' => $to,
            'cartCount' => $cartCount,
        ]);
    }
}
