<?php

use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
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
Route::prefix('posts')->name('post.')
    ->group(fn () => [
        Route::get('', [PostController::class, 'index'])->name('index'),
        Route::prefix('/{slug}-{post}')->where([
            'post' => $idRegex,
            'slug' => $slugRegex])->group(fn () => [
            Route::get('', [PostController::class, 'show'])->name('show')->middleware('post.slug'),
            Route::post('/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth'),
        ])
    ]);

/**
 * routes about comments and replies
 */
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')
    ->middleware('auth')->where(['comment' => $idRegex]);
Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy')
    ->middleware('auth')->where(['reply' => $idRegex]);

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
 * route about profile
 */
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show')->where(['user' => $idRegex]);

/**
 * routes about the admin interface
 */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(fn () => [
    Route::get('tableau-de-bord', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard'),
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class)->except(['show']),
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']),
    Route::prefix('user')->name('user.')->controller(\App\Http\Controllers\Admin\UserController::class)
        ->group(fn () => [
            Route::get('', 'index')->name('index'),
            Route::get('/{user}', 'show')->name('show')->where(['user' => $idRegex]),
            Route::delete('/{user}', 'destroy')->name('destroy')->where(['user' => $idRegex])
        ]),
    Route::prefix('report')->name('report.')->controller(\App\Http\Controllers\Admin\ReportController::class)
        ->group(fn () => [
            Route::get('', 'index')->name('index'),
            Route::get('/{report}', 'show')->name('show')->where(['report' => $idRegex]),
            Route::delete('/do/{report}', 'do')->name('do')->where(['report' => $idRegex]),
            Route::delete('/{report}', 'destroy')->name('destroy')->where(['report' => $idRegex]),
        ])
]);

require __DIR__ . '/auth.php';
