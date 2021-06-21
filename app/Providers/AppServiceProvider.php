<?php

namespace App\Providers;

use App\Models\Product;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('*', function ($view) {

        //     $min_price = Product::min('product_price');
        //     $max_price = Product::max('product_price');

        //     $min_price_range = $min_price + 500000;
        //     $max_price_range = $max_price + 10000000;

        //     $view->with(compact('min_price', 'max_price', 'min_price_range', 'max_price_range'));
        // });
    }
}
