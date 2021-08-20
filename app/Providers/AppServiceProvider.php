<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Video;
use App\Models\Order;
use App\Models\PostM;
use App\Models\Customer;
use App\Models\IconM;
use App\Models\PartnerM;
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
        
        view()->composer('*', function ($view) {

            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');

            $min_price_range = $min_price + 5000000;
            $max_price_range = $max_price + 10000000;

            $app_product = Product::all()->count();
            $app_post = PostM::all()->count();
            $app_order = Order::all()->count();
            $app_video = Video::all()->count();
            $app_customer = Customer::all()->count();
            $share_image = '';
            $icons = IconM::OrderBy('icon_id','ASC')->get();
            $partners = PartnerM::OrderBy('partner_id','ASC')->get();

            $view->with(compact('min_price', 'max_price', 'min_price_range', 'max_price_range','app_product', 'app_post', 'app_order', 'app_video', 'app_customer','share_image','icons','partners'));
        });
    }
}
