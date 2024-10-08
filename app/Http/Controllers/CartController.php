<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        return view('cart', [ 'cartItems' => $cartItems, 'cartCount' => count($cartItems) ]);
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $price   = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::add($product->id, $product->name, $request->qty, $price)->associate('App\Models\Product');
        return redirect()->back()->with('message', 'Success! Item has been added to the cart');
    }

    public function updateCart(Request $request)
    {
        Cart::update($request->rowId, $request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($request->rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::destroy();
        return redirect()->route('cart.index');
    }
}
