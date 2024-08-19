<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ AppController::class, 'index' ])->name('app.index');

Auth::routes();

Route::group([ 'middleware' => ['auth', 'auth.admin'] ], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'productDetails'])->name('shop.product.details');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');



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

Route::group([ 'middleware' => ['auth', 'auth.customer'] ], function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});

Route::post(
    '/login',
    [
    'uses'    => 'App\Http\Controllers\Auth\LoginController@login',
    'middleware' => 'auth.customer',
    ]
);

Route::group([ 'middleware' => ['auth', 'auth.admin'] ], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::group(
        array(
            'prefix' => '/admin/product',
        ),
        function () {
            Route::get('/', array( ProductController::class, 'index' ))->name('product');
            Route::get('/show/{product}', array( ProductController::class, 'show' ))->name('product.show');
            Route::get('/edit/{product}', array( ProductController::class, 'edit' ))->name('product.edit');
            Route::get('/create', array( ProductController::class, 'create' ))->name('product.create');
            Route::put('/edit/{product}', array( ProductController::class, 'update' ))->name('product.update');
            Route::post('/create', array( ProductController::class, 'store' ))->name('product.store');
            Route::delete('/delete/{product}', array( ProductController::class, 'destroy' ))->name('product.destroy');
        }
    );

    Route::group(
        array(
            'prefix' => '/admin/user',
        ),
        function () {
            Route::get('/', array( UserController::class, 'list' ))->name('users.list');
            Route::get('/{user}', array( UserController::class, 'show' ))->name('user.show');
            Route::get('/edit/{user}', array( UserController::class, 'edit' ))->name('user.edit');
            Route::get('/create', array( UserController::class, 'create' ))->name('user.create');
            Route::put('/edit/{user}', array( UserController::class, 'update' ))->name('user.update');
            Route::post('/create', array(UserController::class, 'store' ))->name('user.store');
            Route::delete('/delete/{user}', array( UserController::class, 'destroy' ))->name('user.destroy');
            Route::post('/block/{user}', array( UserController::class, 'actions' ))->name('user.block');
            Route::post('/unblock/{user}', array( UserController::class, 'actions' ))->name('user.unblock');
        }
    );
});
