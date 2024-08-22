<?php
/**
 * Admin routes
 */

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\ProductController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\ShopController;
 use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

// Allow access to my account if not an admin.
Route::group([ 'middleware' => ['auth', 'auth.customer'] ], function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});


Route::group(
    array(
        'prefix' => 'cart',
    ),
    function () {
        Route::post('/store', [CartController::class, 'addToCart'])->name('cart.store');
        Route::put('/update', [CartController::class, 'updateCart'])->name('cart.update');
        Route::delete('/remove', [CartController::class, 'removeItem'])->name('cart.remove');
        Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
    }
);

Route::group(
    array(
        'prefix' => 'wishlist',
    ),
    function () {
        Route::get('/', [WishlistController::class, 'getWishlist'])->name('wishlist.list');
        Route::post('/add', [WishlistController::class, 'add'])->name('wishlist.store');
        Route::post('/to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.to.cart');
        Route::delete('/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
        Route::delete('/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
    }
);

Route::group(
    array(
        'prefix' => 'product',
    ),
    function () {
        Route::get('/{slug}', [ProductController::class, 'productDetails'])->name('shop.product.details');
    }
);


Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
