<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExtractCustomerID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $customer = JWTAuth::parseToken()->authenticate();
            $request->merge(['customer_id' => $customer->id]);
        } catch (JWTException $e) {
            // Handle any exceptions that may occur while extracting the customer_id.
        }

        return $next($request);
    }
}
