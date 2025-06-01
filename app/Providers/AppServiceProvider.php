<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Gửi dữ liệu categories, podcasts, ebooks cho mọi view
        View::composer('*', function ($view) {
            $view->with([
                'categories' => Category::all(),
                'podcasts' => Product::where('type', 'podcast')->get(),
                'ebooks' => Product::where('type', 'ebook')->get(),
            ]);
        });
    }
}
