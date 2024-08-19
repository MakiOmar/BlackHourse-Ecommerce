<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class WishlistController extends Controller
{
    public function getWishlist()
    {
        $wishlist = Cart::instance('wishlist')->content();
        return view('wishlist', ['items' => $wishlist]);
    }
    public function add(Request $request)
    {
        Cart::instance('wishlist')->add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');

        return response()->json(['status' => 200, 'message' => 'success! Product has been added successfully to wish list', 'count' => Cart::instance('wishlist')->content()->count()]);
    }

    public function remove(Request $request)
    {
        Cart::instance('wishlist')->remove($request->rowId);

        return redirect()->route('wishlist.list');
    }
    public function clear()
    {
        Cart::instance('wishlist')->destroy();

        return redirect()->route('wishlist.list');
    }
    public function moveToCart(Request $request)
    {
        $item = Cart::instance('wishlist')->get($request->rowId);
        $removed = Cart::instance('wishlist')->remove($request->rowId);
        if ($item->model->sale_price) {
            $price = $item->model->sale_price;
        } else {
            $price = $item->model->regular_price;
        }
        $added = Cart::add($item->model->id, $item->model->name, 1, $price)->associate('App\Models\Product');

        return redirect()->route('wishlist.list');
    }
}
