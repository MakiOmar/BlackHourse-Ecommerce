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

Route::group([ 'middleware' => ['auth', 'auth.customer'], 'prefix' => 'vendor'], function () {

    Route::get('/', [UserController::class, 'vendorIndex'])->name('vendor.index');

    Route::group(array('prefix' => 'products', ), function () {
        Route::get('/edit/{product}', array( ProductController::class, 'edit' ))->name('vendor.product.edit');
        Route::get('/create', array( ProductController::class, 'create' ))->name('vendor.product.create');
        Route::put('/edit/{product}', array( ProductController::class, 'update' ))->name('vendor.product.update');
        Route::post('/store', array( ProductController::class, 'store' ))->name('vendor.product.store');
        Route::delete('/delete/{product}', array( ProductController::class, 'destroy' ))->name('vendor.product.destroy');
        Route::get('/', array( ProductController::class, 'index' ))->name('vendor.products');
    });
    Route::group(array('prefix' => 'account', ), function () {
        Route::get('/', array( UserController::class, 'index' ))->name('vendor.account');
    });
});
