<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

//require_once '../resources/org/code/Code.class.php';
require 'org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if ($input = Input::get()) {
            $codepic = new \Code;
            $code = $codepic->get();
            if ($code != strtoupper($input['code'])) {
                return back() -> with('msg', '验证码错误');
            }
            $user = BlogUser::first();
            if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']) {
                return back() -> with('msg', '用户名或密码错误');
            }
            session(['user' => $user]);
            return redirect('admin/index');
        } else {
            session(['user' => null]);
            return view('admin.login');
        }
    }

    public function codePic()
    {
        $codepic = new \Code;
        $codepic->make();
    }

    public function crypt()
    {
        //
    }
}
