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

Route::get('/', [HomeController::class, 'index'])->name('home')->name('home');
Route::get('/post/{id}', [HomeController::class, 'show'])->name('post.show');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(PostController::class)->prefix('posts')->group(function () {
    Route::get('/', 'index')->name('post');
    Route::get('/create', 'create')->name('post.create');
    Route::post('/store', 'store')->name('post.store');
    Route::get('/edit/{id}', 'edit')->name('post.edit');
    Route::post('/update', 'update')->name('post.update');
    Route::get('/delete/{id}', 'destroy')->name('post.destroy');    
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index')->name('category');
    Route::get('/create', 'create')->name('category.create');
    Route::post('/store', 'store')->name('category.store');
    Route::get('/edit/{id}', 'edit')->name('category.edit');
    Route::post('/update', 'update')->name('category.update');
    Route::get('/delete/{id}', 'destroy')->name('category.destroy');    
});
