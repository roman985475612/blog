<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/'                , [PageController::class, 'index'])->name('home');
Route::get('/post/{slug}.html', [PageController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}/'     , [PageController::class, 'tag'])->name('post.tag');
Route::get('/category/{slug}/', [PageController::class, 'category'])->name('post.category');

Route::middleware(['guest'])->group(function () {
    Route::get('/register' , [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login'    , [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login'   , [AuthController::class, 'login']);    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout'  , [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile' , [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
});

Route::group([
    'middleware' => 'admin',
    'prefix'     => 'admin',
], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class);    
    Route::resource('/posts'     , PostsController::class);    
    Route::resource('/tags'      , TagsController::class);    
    Route::resource('/users'     , UsersController::class);        
});
