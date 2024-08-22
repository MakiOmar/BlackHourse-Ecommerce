<?php
/**
 * Admin routes
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::group([ 'middleware' => ['auth', 'auth.admin'],'prefix' => 'admin', ], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::group(
        array(
            'prefix' => 'product',
        ),
        function () {
            Route::get('/show/{product}', array( ProductController::class, 'show' ))->name('product.show');
            Route::get('/edit/{product}', array( ProductController::class, 'edit' ))->name('product.edit');
            Route::get('/create', array( ProductController::class, 'create' ))->name('product.create');
            Route::put('/edit/{product}', array( ProductController::class, 'update' ))->name('product.update');
            Route::put('/publish/{product}', array( ProductController::class, 'publish' ))->name('product.publish');
            Route::put('/pending/{product}', array( ProductController::class, 'pending' ))->name('product.pending');
            Route::post('/create', array( ProductController::class, 'store' ))->name('product.store');
            Route::delete('/delete/{product}', array( ProductController::class, 'destroy' ))->name('product.destroy');
            Route::get('/', array( ProductController::class, 'index' ))->name('product');
        }
    );

    Route::group(
        array(
            'prefix' => 'users',
        ),
        function () {
            Route::get('/edit/{user}', array( UserController::class, 'edit' ))->name('user.edit');
            Route::get('/create', array( UserController::class, 'create' ))->name('user.create');
            Route::put('/edit/{user}', array( UserController::class, 'update' ))->name('user.update');
            Route::post('/create', array(UserController::class, 'store' ))->name('user.store');
            Route::delete('/delete/{user}', array( UserController::class, 'destroy' ))->name('user.destroy');
            Route::post('/block/{user}', array( UserController::class, 'actions' ))->name('user.block');
            Route::post('/unblock/{user}', array( UserController::class, 'actions' ))->name('user.unblock');
            Route::get('/{user}', array( UserController::class, 'show' ))->name('user.show');
            Route::get('/', array( UserController::class, 'list' ))->name('users.list');
        }
    );
});
