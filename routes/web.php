<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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
Route::get('/posts', [PostController::class,"index"])->name('posts');
Route::get('/contact', [ContactController::class,"index"])->name('contact');
Route::post('/contact', [ContactController::class,"form"])->name('contact.form');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('test_clear', [TestController::class,"delete_user"]);



Route::middleware(['auth','can:viewAny,App\Models\Post'])->group(function () {
    Route::get('/post/list', [PostController::class,"list"])->name('post.list');
    Route::get('/post', [PostController::class,"create"])->name('post.create')->can('create', Post::class);
    Route::post('/post', [PostController::class,"store"])->name('post.store')->can('create', Post::class);
    Route::get('/post/{post}', [PostController::class,"edit"])->name('post.edit')->can('view', 'post');
    Route::put("/post/{post}", [PostController::class,"update"])->name('post.update')->can('update', 'post');
    Route::delete('/post/{post}', [PostController::class,"destroy"])->name('post.destroy')->can('delete', 'post');
});


Route::middleware(['auth','can:viewAny,App\Models\User'])->group(function () {
    Route::get('/user/list', [UserController::class,"list"])->name('user.list');
    Route::post('/user', [UserController::class,"store"])->name('user.store');
    Route::get('/user/{user}', [UserController::class,"edit"])->name('user.edit');
    Route::put("/user/{user}", [UserController::class,"update"])->name('user.update');
    Route::delete('/user/{user}', [UserController::class,"destroy"])->name('user.destroy');
});


Route::middleware(['auth','can:viewAny,App\Models\Category'])->group(function () {
    Route::get('/category/list', [CategoryController::class,"list"])->name('category.list');
    Route::get('/category', [CategoryController::class,"create"])->name('category.create');
    Route::post('/category', [CategoryController::class,"store"])->name('category.store');
    Route::get('/category/{category}', [CategoryController::class,"edit"])->name('category.edit');
    Route::put("/category/{category}", [CategoryController::class,"update"])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class,"destroy"])->name('category.destroy');
});