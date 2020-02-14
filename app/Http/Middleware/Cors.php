<?php

namespace App\Http\Middleware;

use \Closure;
use \Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getMethod() === 'OPTIONS') {
            return response(['OK'], 204)->withHeaders([
                'Access-Control-Allow-Origin'      => '*',
                'Access-Control-Allow-Methods'     => 'GET, POST, PUT, OPTIONS, DELETE',
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers'     => 'DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Range',
                'Access-Control-Max-Age'           => 1728000,
                'Content-type'                     => 'text/plain; charset=utf-8',
                'Content-Length'                   => 0
            ]);
        }

        return $next($request)
            ->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Origin', '*');
    }
}
