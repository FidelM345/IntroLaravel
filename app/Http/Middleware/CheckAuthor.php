<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthor
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
        if($request->name=="fidel")
        {
            return \Redirect::route('about');
        }
        echo "I am the global middleware";
        return $next($request);
    }





}
