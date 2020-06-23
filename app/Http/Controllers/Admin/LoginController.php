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
            ["user_name","=",$data['user_name']]
        ];
        $res=Users::where($where)->first();
        $yz=password_verify($data['password'],$res['password']);
        if(!$yz){
            return redirect('admin/login')->with("pwd","密码错误，请重新登陆");
        }
        if($res==true){
            $wheres=[
                ["user_id","=",$res['user_id']]
            ];
            $time=time();
            Users::where($wheres)->update(['login_time'=>$time]);
            session(['user_id'=>$res['user_id']]);
            return redirect('admin/index');
        }else{
            return redirect('admin/login')->with("pwds","账号有误");
        }


    }
    public function test(){
        $ss=session('user_id');
        dd($ss);
    }
}
