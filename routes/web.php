<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class);    
});
