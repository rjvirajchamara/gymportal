<?php

namespace App\Http\Middleware;

use Closure;

class Isuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        //if(auth()->user_ones->role == 'user'){
            //dd($request);
//}

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
