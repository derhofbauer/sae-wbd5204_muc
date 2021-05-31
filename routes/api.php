<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\FeedController;
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

Route::middleware('auth:web')->get('/user', function (Request $request) {
    return $request->user();
}); // <domain>/api/user

Route::get('/feed', [FeedController::class, 'api'])->name('api.feed');
Route::get('/profile/{user?}', [ApiPostController::class, 'index'])->middleware('auth:web')->name('api.profile');
Route::get('/users/{user}', [ApiController::class, 'user'])->middleware('auth:web')->name('api.user.single');

/**
 * @todo: continue by implementing the controller actions
 */
Route::apiResource('posts', ApiPostController::class)->names([
    'index' => 'api.posts.index',
    'store' => 'api.posts.store',
    'show' => 'api.posts.show',
    'update' => 'api.posts.update',
    'destroy' => 'api.posts.destroy'
]);
