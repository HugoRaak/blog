<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$slugRegex = '[a-z0-9\-]+';
$idRegex = '[0-9]+';

Route::get('/', \App\Http\Controllers\HomeController::class);

Route::prefix('posts')->name('post.')->controller(\App\Http\Controllers\PostController::class)
    ->group(fn () => [
       Route::get('', 'index')->name('index'),
       Route::get('/{slug}-{post}', 'show')->name('show')->where([
           'post' => $idRegex,
           'slug' => $slugRegex
       ])->middleware(\App\Http\Middleware\EnsureSlugPostIsValid::class)
]);

Route::prefix('admin')->name('admin.')->group(fn () => [
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except(['show']),
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show'])
]);
