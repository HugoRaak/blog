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

/**
 * routes about the display of posts
 */
Route::prefix('posts')->name('post.')->controller(\App\Http\Controllers\PostController::class)
    ->group(fn () => [
       Route::get('', 'index')->name('index'),
       Route::get('/{slug}-{post}', 'show')->name('show')->where([
           'post' => $idRegex,
           'slug' => $slugRegex
       ])->middleware(\App\Http\Middleware\EnsureSlugPostIsValid::class)
]);

/**
 * routes about contact form
 */
Route::prefix('contact')->name('contact.')->controller(\App\Http\Controllers\ContactController::class)
    ->group(fn () => [
        Route::get('', 'index')->name('index'),
        Route::post('send', 'send')->name('send')
]);

/**
 * routes about authentification
 */
Route::controller(\App\Http\Controllers\AuthController::class)->group(fn () => [
    Route::get('/login', 'login')->middleware('guest')->name('login'),
    Route::post('/login', 'doLogin'),
    Route::delete('/logout', 'logout')->middleware('auth')->name('logout')
]);

/**
 * routes about the admin interface
 */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(fn () => [
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except(['show']),
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show'])
]);
