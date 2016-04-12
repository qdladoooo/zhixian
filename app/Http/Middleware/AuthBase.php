<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Illuminate\Support\Facades\Session;
class AuthBase
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
        //已登录
        if( $this->does_user_login() ) {
            return $next($request);
        } else {
            //记录用户访问uri，转至登陆界面
            $url = Request::url();
            Session::put('redirect_url', $url);

            return redirect("/user/login");
        }
    }

    //用户是否登录
    public function does_user_login(){
        if( session('does_user_login') ){
            return true;
        }
        return false;
    }
}
