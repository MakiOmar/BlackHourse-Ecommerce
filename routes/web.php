<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

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

// This should check if a user has been blocked and
Route::post(
    '/login',
    [
    'uses'    => 'App\Http\Controllers\Auth\LoginController@login',
    'middleware' => 'auth.customer',
    ]
);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Include routes from separate route files
    include __DIR__ . '/admin.php';
    include __DIR__ . '/customer.php';
    include __DIR__ . '/vendor.php';
});