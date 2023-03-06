<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/', [ MainController::class, 'main' ])->name('main');
Route::get('/categories', [ MainController::class, 'categories' ])->name('categories');
Route::get('/products', [ MainController::class, 'products' ])->name('products');
Route::get('/product/{product?}', [ MainController::class, 'product' ])->name('product');

