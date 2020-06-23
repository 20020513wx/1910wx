<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $user_id=session("user_id");
        if(!$user_id){
            return redirect("admin/login")->with("msg","请先登录");
        }
        return $next($request);
    }
}
