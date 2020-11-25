<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('pages._sidebar', function ($view) {
            $view->with('pupularPosts' , Post::getPopular());
            $view->with('recentPosts'  , Post::getRecent());
            $view->with('featuredPosts', Post::getFeatured());
            $view->with('categories'   , Category::getAll());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
