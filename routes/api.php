<?php

use App\Http\Controllers\Interno\ProductController;
use App\Http\Controllers\JwtAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api'
], function ($router) {

    Route::post('login', [JwtAuthController::class, 'login']);
    Route::post('logout', [JwtAuthController::class, 'logout']);
    Route::post('refresh', [JwtAuthController::class, 'refresh']);
    Route::post('me', [JwtAuthController::class, 'me']);
    Route::post('register', [JwtAuthController::class, 'register']);
    #Route::post('forgotPassword', [ForgotPasswordController::class, 'sendResetCodeEmail']);
    #Route::post('redefinePassword', [ForgotPasswordController::class, 'redefinePassword']);

    Route::middleware(['auth:api','can:viewAny,App\Models\Product'])->group(function () {
        Route::get('produtos', [ProductController::class, 'list']);
        Route::get('produtos/{product}', [ProductController::class, 'edit']);
        Route::post('produtos', [ProductController::class, 'store']);
        Route::put('produtos', [ProductController::class, 'update']);
        #por algum motivo o insomnia nao faz multipart/form-data com put
        Route::post('produtos/upd', [ProductController::class, 'update']);
        Route::delete('produtos/{product}', [ProductController::class, 'destroy']);
    });

});