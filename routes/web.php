<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController as FrontCommentsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\SubscribesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;

Route::get('/'                , [PageController::class, 'index'])->name('home');
Route::get('/post/{slug}.html', [PageController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}/'     , [PageController::class, 'tag'])->name('post.tag');
Route::get('/category/{slug}/', [PageController::class, 'category'])->name('post.category');
Route::post('/subscribe'      , [SubsController::class, 'subscribe'])->name('subscribe');
Route::get('/verify/{token}'  , [SubsController::class, 'verify'])->name('verify');

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
    Route::post('/comment', [FrontCommentsController::class, 'store'])->name('comment');
});

Route::group([
    'middleware' => 'admin',
    'prefix'     => 'admin',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::resource('/categories', CategoriesController::class);    
    Route::resource('/posts'     , PostsController::class);    
    Route::resource('/tags'      , TagsController::class);    
    Route::resource('/users'     , UsersController::class);
    Route::resource('/comments'  , CommentsController::class);
    Route::get('/comments/status/{id}', [CommentsController::class, 'status']);
    Route::resource('/subscribes', SubscribesController::class);        
});
