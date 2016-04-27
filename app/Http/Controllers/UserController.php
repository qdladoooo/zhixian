<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\User;
use Illuminate\Support\Facades\Input;
use App\Libs\SampleImporter;

class UserController extends Controller
{
    public function getIndex() {
//        $si = new SampleImporter();
//        $data = $si->analyseCSV( '/var/www/zhixian/storage/upload_file/test.csv' );
//        //导入数据库
//        $success = $si->saver($data);
//        var_dump($success);


        return view('user.index');
    }

    public function login() {
        $data = array();
        $data['frontTitle'] = '知先后台';

        //提交
        if( request()->isMethod('post') ) {
            $email = Input::get('email');
            $cipher = Input::get('cipher');

            $user_info = User::where(array('email'=>$email, 'cipher'=>$cipher))->first();
            if(!empty($user_info)) {
                //登陆成功
                User::login( $user_info->id );
                return json_encode(array('flag'=>true));
            } else {
                return json_encode(array('flag'=>false, 'messages'=>array('用户名或密码错误。')));
            }
        }

        return view('user.login');
    }

    public function logout() {
        User::logout();
        return response()->redirectTo('/user/login');
    }
}
