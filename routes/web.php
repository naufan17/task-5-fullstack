<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\PostController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [HomeController::class, 'show']);

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'formStore']);
Route::post('/posts/create', [PostController::class, 'store']);
Route::get('/posts/update/{id}', [PostController::class, 'formUpdate']);
Route::post('/posts/update', [PostController::class, 'update']);
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/create', [CategoryController::class, 'formStore']);
Route::post('/categories/create', [CategoryController::class, 'store']);
Route::get('/categories/update/{id}', [CategoryController::class, 'formUpdate']);
Route::post('/categories/update', [CategoryController::class, 'update']);
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy']);
