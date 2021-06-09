<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\FeedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;


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

Route::get('/feed', [FeedController::class, 'api'])->name('api.feed');
Route::get('/profile/{user?}', [ApiPostController::class, 'index'])->middleware('auth:sanctum')->name('api.profile');

Route::post('/auth/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
Route::post('/auth/login', [ApiAuthController::class, 'login'])->name('api.auth.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [ApiAuthController::class, 'logout'])->name('api.auth.logout');

    Route::apiResource('posts', ApiPostController::class)->names([
        'index' => 'api.posts.index',
        'store' => 'api.posts.store',
        'show' => 'api.posts.show',
        'update' => 'api.posts.update',
        'destroy' => 'api.posts.destroy'
    ]);

    Route::get('/users/{user}', [ApiController::class, 'user'])->middleware('auth:sanctum')->name('api.users.single');
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    })->name('api.users.me');
});
