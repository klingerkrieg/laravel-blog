<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
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
