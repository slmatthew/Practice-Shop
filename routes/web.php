<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\ValidateAdmin;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'reset' => false,
    'confirm' => false
]);

Route::get('/', [ MainController::class, 'main' ])->name('main');
Route::get('/categories', [ MainController::class, 'categories' ])->name('categories');
Route::get('/products', [ MainController::class, 'products' ])->name('products');
Route::get('/product/{product}', [ MainController::class, 'product' ])->name('product');

Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

});

Route::group(['middleware' => ['auth']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});

Route::group(['middleware' => ['auth', ValidateAdmin::class]], function() {

    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');

    /* товары */
    Route::get('/admin/products', [ProductController::class, 'getProducts'])->name('admin.products');

    Route::get('/admin/product/{product}', [ProductController::class, 'updateProduct'])->name('admin.product');
    Route::post('/admin/product/update', [ProductController::class, 'updateProductAction'])->name('admin.product.update');
    Route::get('/admin/product/{product}/delete', [ProductController::class, 'deleteProductAction'])->name('admin.product.delete');

    Route::get('/admin/product/add', [ProductController::class, 'addProduct'])->name('admin.product.add');
    Route::post('/admin/product/add', [ProductController::class, 'addProductAction'])->name('admin.product.add.post');

    /* категории */
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/category/{category}', [AdminController::class, 'category'])->name('admin.category');

    /* пользователи */
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/user/{user}', [AdminController::class, 'user'])->name('admin.user');

    /* заказы */
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/order/{order}', [AdminController::class, 'order'])->name('admin.order');

});
