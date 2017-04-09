<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
          //判断是否没有登录
          if(!$request->session()->has('user')) {
              return redirect("login");  
          } 
                  
        return $next($request);
    }
}
