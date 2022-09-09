<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminSlideShowControlller;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Routing\RouteGroup;
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


Route::get('dashboard', function () {
    return;
})->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('user#home');

Route::prefix('movies')->group(function () {
    Route::get('', [MovieController::class, 'index'])->name('user#movies');
    Route::get('{id}', [MovieController::class, 'info'])->name('user#movie_info');
    Route::get('comments/{id}', [CommentController::class, 'index'])->name('user#movie_comments');
    Route::get('get_link/{id}', [MovieController::class, 'get_link'])->name('user#movie_get_link');
    Route::get('get_comment_preview/{id}', [CommentController::class, 'get_comments_preview'])->name('user#comment_preview');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('update_profile', [ProfileController::class, 'update_profile'])->name('user#up_profile');
        Route::post('update_password', [ProfileController::class, 'update_password'])->name('user#up_password');
    });

    //Comments Route
    Route::prefix('comment')->group(function () {
        Route::post('add/{id}', [CommentController::class, 'add'])->name('user#comment_add');
        Route::get('destroy/{id}', [CommentController::class, 'destroy'])->name('user#comment_del');
    });


    // Routes For Admins
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        //Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('', [AdminDashboardController::class, 'index'])->name('admin#dashboard');
        });
        //Movies
        Route::prefix('movies')->group(function () {
            Route::get('', [AdminMovieController::class, 'index'])->name('admin#movie_list');
            Route::get('insert', [AdminMovieController::class, 'insertPage'])->name('admin#movie_insert');
            Route::post('insert', [AdminMovieController::class, 'insert'])->name('admin#movie_insert');
            Route::get('edit/{id}', [AdminMovieController::class, 'editPage'])->name('admin#movie_edit');
            Route::post('edit/{id}', [AdminMovieController::class, 'edit'])->name('admin#movie_edit');
            Route::get('new_arrives', [AdminMovieController::class, 'new_arrives'])->name('admin#movie_new_arrives');
        });
        //Users
        Route::prefix('users')->group(function () {
            Route::get('', [AdminUserController::class, 'index'])->name('admin#user_list');
            Route::get('edit/{id}', [AdminUserController::class, 'editPage'])->name('admin#user_edit');
            Route::put('plan_change/{id}', [AdminUserController::class, 'plan_change'])->name('admin#user_plan_change');
            Route::put('update/{id}', [AdminUserController::class, 'update'])->name('admin#user_update');
            Route::post('destroy/{id}', [AdminUserController::class, 'destroy'])->name('admin#user_destroy');
            Route::get('remove_device/{id}', [AdminUserController::class, 'rm_device'])->name('admin#user_rm_device');
        });
        //SlideShows
        Route::prefix('slideShows')->group(function () {
            Route::get('', [AdminSlideShowControlller::class, 'index'])->name('admin#slideshow_list');
            Route::get('insert', [AdminSlideShowControlller::class, 'insertPage'])->name('admin#slideshow_insertPage');
            Route::post('insert', [AdminSlideShowControlller::class, 'insert'])->name('admin#slideshow_insert');
            Route::get('searchMovie', [AdminSlideShowControlller::class, 'searchMovie'])->name('admin#slideshow_searchMov');
            Route::get('destroy/{id}', [AdminSlideShowControlller::class, 'destroy'])->name('admin#slideshow_destroy');
            Route::get('edit/{id}', [AdminSlideShowControlller::class, 'editPage'])->name('admin#slideshow_edit');
            Route::post('edit/{id}', [AdminSlideShowControlller::class, 'update'])->name('admin#slideshow_edit');
        });
    });
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
// });
