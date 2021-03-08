<?php

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

Route::get('/blog', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/blog/{post}', [\App\Http\Controllers\PostController::class, 'show']);

Auth::routes();

Route::get('/blog/create/post', [\App\Http\Controllers\PostController::class, 'create'])->middleware('auth');
Route::post('/blog/create/post', [\App\Http\Controllers\PostController::class, 'store'])->middleware('auth');
Route::get('/blog/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->middleware('auth');
Route::put('/blog/{post}/edit', [\App\Http\Controllers\PostController::class, 'update'])->middleware('auth');
Route::delete('/blog/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->middleware('auth');

