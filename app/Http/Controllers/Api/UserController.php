<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Tokens;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
    /**
     * 用户注册
     * @param Request $request
     * */
    public function reg(Request $request){


        $password =$request->input('password');
        $pwds =$request->input('pwds');
        $user_name =$request->input('user_name');
        $email =$request->input('email');

        //密码长度是否大于6
        $len = strlen($password);
        if($len<6){
            $response = [
                'error' => 50001,
                'msg' => '密码长度必须大于6'
            ];
            return $response;
        }

        //两次密码不一致
        if($password !=$pwds){
            $response = [
                'error' => 50002,
                'msg' => '密码不一致'
            ];
            return $response;
        }
        $password = password_hash($pwds,PASSWORD_BCRYPT);


        //验证通过生成用户记录
        $data = [
            'user_name' =>$user_name,
            'email' =>$email,
            'password' =>$password,
            'reg_time' =>time(),
        ];

        $res = Users::insert($data);
        if($res){
            $response = [
                'error' =>0,
                'msg' =>"注册成功"
            ];
        }else{
            $response = [
                'error' =>50005,
                'msg' =>"注册失败"
            ];
        }
    }

    //登录执行
    public function login(){
        $password =request()->input('password');
        $user_name =request()->input('user_name');

        $where=[
            ["user_name","=",$user_name]
        ];
        $res=Users::where($where)->first();
        $yz=password_verify($password,$res['password']);

        if($yz){
            //生成token
            $str=$res->user_id.$res->username.time();
            $token=substr(md5($str),10,16).substr(md5($str),0,10);

            //将token保存在redis中
            Redis::set($token,$res->user_id);
            //设置key的过期时间x
            //Redis::expire($token,20);

            $response=[
                'errno'=>0,
                'msg'=>'ok',
                'token'=>$token
            ];
        }else{
            $response=[
                'errno'=>50007,
                'msg'=>'用户名或密码有误，请重新登陆',
            ];
        }
        return $response;

    }

    //用户信息视图
    public function index(Request $request){
        $token=$request->input('token');
        $uid=Redis::get($token);
        if($uid){
            //已登录
            $userInfo=Users::find($uid);

            echo $userInfo->user_name."欢迎来到个人中心";
        }else{
            //未登录
            $response=[
                'errno'=>50008,
                'msg'=>'请先登录'
            ];
            return $response;
        }
    }

    //订单
    public function orders(){
        //订单信息
        $arr=[
            '67897690087608976761',
            '67897690087608976762',
            '67897690087608976723',
            '67897690087608976724',
        ];
        $response=[
            'errno'=>0,
            'msg'=>'ok',
            'data'=>[
                'orders'=>$arr
            ]
        ];
        return $response;
    }

    public function cart(){

        $goods=[
            123,
            456,
            789
        ];
        $response=[
            'errno'=>0,
            'msg'=>'ok',
            'data'=>$goods
        ];
        return $response;
    }
}
