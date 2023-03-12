<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoriesController;
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
Route::get('/products', [ MainController::class, 'products' ])->name('products');

Route::get('/products/categories', [ ProductsController::class, 'allCategories' ])->name('products.categories');
Route::get('/products/{category}', [ ProductsController::class, 'byCategory' ])->name('products.byCategory');
Route::get('/product/{product}', [ ProductsController::class, 'product' ])->name('products.item');

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

    Route::get('/user/me', [UserController::class, 'userMe'])->name('user.me');

    /**
     * Корзина
     */
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');

    Route::get('/basket/checkout', [BasketController::class, 'index'])->name('basket.checkout');

    Route::get('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');

    Route::put('/basket/add', [BasketController::class, 'addProduct'])->name('basket.addProduct');
    Route::post('/basket/edit', [BasketController::class, 'editProduct'])->name('basket.editProduct');
    Route::delete('/basket/delete', [BasketController::class, 'deleteProduct'])->name('basket.deleteProduct');
});

Route::get('/user/{user}', [UserController::class, 'user'])->name('user.user');

Route::group(['middleware' => ['auth', ValidateAdmin::class]], function() {

    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');

    /* товары */
    Route::get('/admin/products', [ProductController::class, 'getProducts'])->name('admin.products');

    Route::get('/admin/product/add', [ProductController::class, 'addProduct'])->name('admin.product.add');
    Route::post('/admin/product/add/action', [ProductController::class, 'addProductAction'])->name('admin.product.add.action');

    Route::get('/admin/product/{product}', [ProductController::class, 'updateProduct'])->name('admin.product');
    Route::post('/admin/product/update', [ProductController::class, 'updateProductAction'])->name('admin.product.update');

    Route::post('/admin/product/delete', [ProductController::class, 'deleteProductAction'])->name('admin.product.delete');

    /* категории */
    Route::get('/admin/categories', [CategoriesController::class, 'main'])->name('admin.categories.main');

    Route::post('/admin/category/add', [CategoriesController::class, 'add'])->name('admin.category.add');
    Route::post('/admin/category/update', [CategoriesController::class, 'update'])->name('admin.category.update');
    Route::post('/admin/category/delete', [CategoriesController::class, 'delete'])->name('admin.category.delete');

    /* пользователи */
    Route::get('/admin/users', [AdminUserController::class, 'main'])->name('admin.users.main');
    Route::get('/admin/user/{user}', [AdminController::class, 'user'])->name('admin.user');

    /* заказы */
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/order/{order}', [AdminController::class, 'order'])->name('admin.order');

});
