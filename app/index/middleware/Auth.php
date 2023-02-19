<?php
namespace app\index\middleware;
use think\facade\Request;

class Auth
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}