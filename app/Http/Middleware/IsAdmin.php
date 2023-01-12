<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
      // if(auth()->user_ones->role == 'admin'){
         // dd($request);

       //}

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    //}else{
        return redirect('/');
    }

}
