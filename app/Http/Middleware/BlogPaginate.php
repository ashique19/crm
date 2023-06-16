<?php

namespace App\Http\Middleware;

use Closure;

class BlogPaginate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        
        if ($route->parameter('id') == '') {
            return redirect()->route("blog", '1');
        }
        return $next($request);
    }
}