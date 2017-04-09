<?php

namespace App\Http\Middleware;

use Closure;

class CheckAjax
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
        if($request->ajax()){

           //dd(111);
            return $next($request); 
        }else{
            return response(json_encode(['status'=>false,
                                        'msg'=>'Unauthorized'
                                        ]));
        }
    }
}
