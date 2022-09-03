<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Interno\ProductController;
use App\Http\Controllers\Interno\CategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomePageController::class,"index"])->name('home');
Route::get('/about', [HomePageController::class,"about"])->name('about');
Route::get('/products', [ProductController::class,"index"])->name('products');
Route::get('/contact', [ContactController::class,"index"])->name('contact');
Route::post('/contact', [ContactController::class,"form"])->name('contact.form');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('test_clear', [TestController::class,"delete_user"]);


Route::get('verificar_email/{email}', [UserController::class,"verifyEmail"])->name("verify_email");



Route::middleware(['auth','can:viewAny,App\Models\Product'])->group(function () {
    Route::get('/produtos/list', [ProductController::class,"list"])->name('product.list');
    Route::get('/produtos', [ProductController::class,"create"])->name('product.create')->can('create', 'App\Models\Product');
    Route::post('/produtos', [ProductController::class,"store"])->name('product.store')->can('create', 'App\Models\Product');
    Route::get('/produtos/{product}', [ProductController::class,"edit"])->name('product.edit')->can('view', 'product');
    Route::put("/produtos/{product}", [ProductController::class,"update"])->name('product.update')->can('update', 'product');
    Route::delete('/produtos/{product}', [ProductController::class,"destroy"])->name('product.destroy')->can('delete', 'product');
});


Route::middleware(['auth','can:admin-access'])->group(function () {
    Route::get('/user/list', [UserController::class,"list"])->name('user.list');
    Route::post('/user', [UserController::class,"store"])->name('user.store');
    Route::get('/user/{user}', [UserController::class,"edit"])->name('user.edit');
    Route::put("/user/{user}", [UserController::class,"update"])->name('user.update');
    Route::delete('/user/{user}', [UserController::class,"destroy"])->name('user.destroy');

    Route::get('/category/list', [CategoryController::class,"list"])->name('category.list');
    Route::get('/category', [CategoryController::class,"create"])->name('category.create');
    Route::post('/category', [CategoryController::class,"store"])->name('category.store');
    Route::get('/category/{category}', [CategoryController::class,"edit"])->name('category.edit');
    Route::put("/category/{category}", [CategoryController::class,"update"])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class,"destroy"])->name('category.destroy');
});