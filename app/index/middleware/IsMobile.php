<?php
namespace app\index\middleware;

class IsMobile
{
    public function handle($request, \Closure $next,$name)
    {
        //判断模板
        if (request()->isMobile()) {
            $request->template = 'mobile/';
        }else{
            $request->template = 'pc/';
        }
        return $next($request);
    }
}