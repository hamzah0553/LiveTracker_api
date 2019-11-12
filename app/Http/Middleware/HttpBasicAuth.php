<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 18-11-2018
 * Time: 20:06
 */

namespace App\Http\Middleware;



use Closure;

class HttpBasicAuth
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
        $envs = [
            'staging',
            'production'
        ];

        $token = "qKYXDuMUKXplpoW3hSIPOMffz";

        if(!$request->has('token'))
        {
            return response()->json(['message' => 'Something is missing'], 400);
        }
        if($token != $request->token || $request->token == null) {
            return response()->json(['message' => 'Access denied.'], 401);
        }

        return $next($request);
    }

}