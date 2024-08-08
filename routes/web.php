<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});

Route::group([ 'middleware' => ['auth', 'auth.admin'] ], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
