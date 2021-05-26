<?php

use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth'])->name('dashboard');

/**
 * s. https://laravel.com/docs/8.x/controllers#resource-controllers
 */
Route::resources([
    'posts' => PostController::class
]);
