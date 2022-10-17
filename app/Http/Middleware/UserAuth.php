<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action
        if($request->session()->has('email'))
        {
            $response = $next($request);
            return $response;
        }
        else
        {
            return response()->json([
                'message'   => 'you need to login first'
            ], 405);
        }
    }
}
