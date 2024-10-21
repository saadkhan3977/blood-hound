<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        // \Auth::logout();
        if($request->user()->role=='admin'){
            return $next($request);
        }
        else{
            echo $request->user()->role;die;
            request()->session()->flash('error','You do not have any permission to access this pages');
            return redirect()->route();
        }
    }
}
