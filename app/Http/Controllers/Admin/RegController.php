<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Users;
class RegController extends Controller
{
    //注册视图
    public function create(){
        return view('admin.reg');
    }
    //注册执行
    public function store(){
        $data=request()->except("_token");
        $validator=Validator::make($data,[
            'user_name'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
            'pwds'=>'required',
        ],[
            'user_name.required'=>'用户名不能为空',
            'user_name.unique'=>'用户名重复',
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'邮箱已绑定，请您换个邮箱',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码至少为六位',
            'pwds.required'=>'确认密码不能为空',
        ]);
        if($validator->fails()){
            return redirect('/')->withErrors($validator)->withInput();
        }
        if($data['pwds']!=$data['password']){
            return redirect('/')->with("a","确认密码和密码不一致");
        }
        array_pop($data);
        $data['reg_time']=time();
        //$data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
        $res=Users::insert($data);
       // dd($res);
        if($res){
            return redirect('admin/login');
        }
    }
}
