<?php

use App\Http\Controllers\Admin\OrdersController;
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

    Route::get('/user/me', function () {
        return to_route('user.user', ['user' => Auth::user()->id]);
    })->name('user.me');

    /**
     * Корзина
     */
    Route::prefix('basket')->group(function () {
        Route::name('basket.')->group(function () {

            Route::get('', [BasketController::class, 'index'])->name('index');

            Route::get('/checkout', [BasketController::class, 'checkout'])->name('checkout');
            Route::post('/checkout', [BasketController::class, 'doCheckout'])->name('doCheckout');

            Route::get('/clear', [BasketController::class, 'clear'])->name('clear');

            Route::put('/add', [BasketController::class, 'addProduct'])->name('addProduct');
            Route::post('/edit', [BasketController::class, 'editProduct'])->name('editProduct');
            Route::delete('/delete', [BasketController::class, 'deleteProduct'])->name('deleteProduct');

        });
    });

});

Route::get('/user/{user}', [UserController::class, 'user'])->name('user.user');

Route::group(['middleware' => ['auth', ValidateAdmin::class]], function() {

    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            Route::get('', [AdminController::class, 'home'])->name('home');

            /**
             * товары
             */
            Route::get('/products', [ProductController::class, 'getProducts'])->name('products.main');

            Route::get('/product/add', [ProductController::class, 'addProduct'])->name('product.add');
            Route::post('/product/add/action', [ProductController::class, 'addProductAction'])->name('product.add.action');

            Route::get('/product/{product}', [ProductController::class, 'updateProduct'])->name('product');
            Route::post('/product/update', [ProductController::class, 'updateProductAction'])->name('product.update');

            Route::post('/product/delete', [ProductController::class, 'deleteProductAction'])->name('product.delete');

            /**
             * категории
             */
            Route::get('/categories', [CategoriesController::class, 'main'])->name('categories.main');

            Route::post('/category/add', [CategoriesController::class, 'add'])->name('category.add');
            Route::post('/category/update', [CategoriesController::class, 'update'])->name('category.update');
            Route::post('/category/delete', [CategoriesController::class, 'delete'])->name('category.delete');

            /**
             * пользователи
             */
            Route::get('/users', [AdminUserController::class, 'main'])->name('users.main');
            Route::get('/user/{user}', [AdminController::class, 'user'])->name('user');

            /**
             * заказы
             */
            Route::get('/orders', [OrdersController::class, 'index'])->name('orders.main');

            Route::post('/order/confirm', [OrdersController::class, 'confirm'])->name('orders.confirm');
            Route::post('/order/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');
            Route::delete('/order/delete', [OrdersController::class, 'delete'])->name('orders.delete');

            Route::get('/order/{order}', [OrdersController::class, 'item'])->name('orders.item');

        });
    });

});
