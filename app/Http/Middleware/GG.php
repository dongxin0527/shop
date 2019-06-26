<?php

namespace App\Http\Middleware;

use Closure;

class GG
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
        // date_default_timezone_set('Asia/Shanghai');
        //特定时间转化成时间戳
        //php函数
        $start = strtotime('09:02:00');
        $end = strtotime('22:02:00');
        // echo $start.'<br/>';
        $now = time();
        // echo date('H:i:s',$now);die;
        // die();
        //$time =  date("His",time());
        if($now<$start||$now>$end){
            echo "不可修改";die;
        }
        return $next($request);
    }
}
