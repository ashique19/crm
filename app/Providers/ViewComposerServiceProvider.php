<?php

namespace App\Providers;

use Auth;
use App\Models\{
    Blog, Lead
};
use App\Models\{Role, User};

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Popular posts
         */
        View::composer(
            [
            'frontend.*.home',             
            'frontend.*.landing',     
            'frontend.blog.components.*'             
            ], function ($view) {
            
                $blog = Blog::where('status', 1)->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
                
                $view->with('popularPosts', $blog);
            }
        );
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
