<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
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
        Schema::defaultStringLength(191);
        
        if(Auth::user()) {
            View::composer(
                [
                'layouts.app',
                ], function ($view) {
                    $websiteData = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'asc')->first();
                    $view->with('websitedata');
                }
            );
        }
        
    }
}
