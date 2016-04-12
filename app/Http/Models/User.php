<?php namespace App\Http\Models;

use Session;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;
use App\Libs\SweeterFetch;

class User extends Model {

    protected $table = 'user';
    //用户登录
    public static function login( $user_id ) {
        $user_id = (int)$user_id;
        $sf = new SweeterFetch();
        $user_info = $sf->Eor("select id, name from user where id = {$user_id}");
        if($user_info) {
            Session::put('does_user_login', true);
            Session::put('login_user', $user_info);
            return true;
        } else {
            return false;
        }
    }

    //用户登出
    public static function logout() {
        Session::flush();
        return true;
    }
}


