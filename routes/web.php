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

Route::get('/post/list', [PostController::class,"list"])->name('post.list')->middleware("auth");
Route::get('/post', [PostController::class,"create"])->name('post.create')->middleware("auth");
Route::post('/post', [PostController::class,"store"])->name('post.store')->middleware("auth");
Route::get('/post/{post}', [PostController::class,"edit"])->name('post.edit')->middleware("auth");
Route::put("/post/{post}", [PostController::class,"update"])->name('post.update')->middleware("auth");
Route::delete('/post/{post}', [PostController::class,"destroy"])->name('post.destroy')->middleware("auth");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('test_clear', [TestController::class,"delete_user"]);



Route::get('/user/list', [UserController::class,"list"])->name('user.list')->middleware("auth");
Route::post('/user', [UserController::class,"store"])->name('user.store')->middleware("auth");
Route::get('/user/{user}', [UserController::class,"edit"])->name('user.edit')->middleware("auth");
Route::put("/user/{user}", [UserController::class,"update"])->name('user.update')->middleware("auth");
Route::delete('/user/{user}', [UserController::class,"destroy"])->name('user.destroy')->middleware("auth");



Route::get('/category/list', [CategoryController::class,"list"])->name('category.list')->middleware("auth");
Route::get('/category', [CategoryController::class,"create"])->name('category.create')->middleware("auth");
Route::post('/category', [CategoryController::class,"store"])->name('category.store')->middleware("auth");
Route::get('/category/{category}', [CategoryController::class,"edit"])->name('category.edit')->middleware("auth");
Route::put("/category/{category}", [CategoryController::class,"update"])->name('category.update')->middleware("auth");
Route::delete('/category/{category}', [CategoryController::class,"destroy"])->name('category.destroy')->middleware("auth");
