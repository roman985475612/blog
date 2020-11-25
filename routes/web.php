<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/post/{slug}.html', [PageController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}/', [PageController::class, 'tag'])->name('post.tag');
Route::get('/category/{slug}/', [PageController::class, 'category'])->name('post.category');

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class);    
    Route::resource('/posts', PostsController::class);    
    Route::resource('/tags', TagsController::class);    
    Route::resource('/users', UsersController::class);    
});
