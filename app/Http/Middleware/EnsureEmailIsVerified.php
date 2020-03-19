<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
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
        //已经登录用户 && 邮箱未认证 && 路由不是email相关，logout
       if($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*','logout')){
           return $request->expectsJson() ? abort(403,'your email is not verified') : redirect()->route('verification.notice');
       }
        return $next($request);
    }
}
