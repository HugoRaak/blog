<?php

use App\Http\Controllers\ProfileController;
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
 * routes about authentication
 */
Route::prefix('profile')->name('profile.')->middleware('auth')->controller(ProfileController::class)
    ->group(fn () => [
        Route::get('', 'edit')->name('edit'),
        Route::patch('', 'update')->name('update'),
        Route::delete('', 'destroy')->name('destroy')
]);

/**
 * routes about the admin interface
 */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(fn () => [
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except(['show']),
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show'])
]);

require __DIR__ . '/auth.php';
