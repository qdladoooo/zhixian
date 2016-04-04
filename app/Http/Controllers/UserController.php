<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function getIndex() {
        return view('user.index');
    }

    public function getLogin() {
        return "hello world?";
    }

    public function getLogout() {
        return "hello world?";
    }



}
