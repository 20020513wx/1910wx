<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Users;
class LoginController extends Controller
{
    //登录视图
    public function login(){
        return view('admin.login');
    }
    //登录执行
    public function loginDo(){
        $data=request()->except('_token');
        $validator=Validator::make($data,[
            'user_name'=>'required',
            'password'=>'required',
        ],[
            'user_name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ]);
        if($validator->fails()){
            return redirect('admin/login')->withErrors($validator)->withInput();
        }
        $where=[
            ["user_name","=",$data['user_name']],
            ["password","=",$data['password']]
        ];
        $res=Users::where($where)->first();
        if($res){
            return redirect('/');
        }else{
            return redirect('admin/login')->with("cuowu","密码错误，请重新登陆");
        }
    }
}
