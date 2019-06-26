<?php

namespace App\Http\Middleware;

use Closure;

class Users
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
        // dd($request->session()->has('userInfo'));
        if(!$request->session()->has('userInfo')){
            return redirect('admin/Users/login');
        }
        return $next($request);
    }
}
