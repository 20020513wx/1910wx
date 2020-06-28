<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redis;
use Closure;

class CheckPri
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
        $token=$request->input('token');
        //验证token
        $uid=Redis::get($token);
        if(!$uid){
            $response=[
                'errno'=>50011,
                'msg'=>'鉴权失败'
            ];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die;
        }

        return $next($request);
    }
}
