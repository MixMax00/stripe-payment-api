<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index'])->name('produts');
Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [ProductController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
