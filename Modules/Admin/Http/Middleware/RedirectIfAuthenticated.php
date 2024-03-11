<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            if ($request->ajax()) { 
                return response([
                    'error' => 'unauthorized',
                    'error_description' => 'Failed authentication.',
                    'data' => [],
                ], 401);
            } else {

                return redirect('/admin');
            }

        }
        return $next($request);
    }
}
