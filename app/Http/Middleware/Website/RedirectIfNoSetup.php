<?php

namespace App\Http\Middleware\Website;
use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfNoSetup
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
        if (!isset(Auth::user()->website->id)) {
            return redirect()->route('account.website.wizard');
        }

        return $next($request);
    }
}
