<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
class UserController extends Controller
{
    //用户信息视图
    public function index(){
        $user_id=session("user_id");
        $where=[
            ["user_id","=",$user_id]
        ];
        $userInfo=Users::where($where)->first();
        //$userInfo=unserialize($userInfo);
        return view("admin.user.index",['userInfo'=>$userInfo]);
    }
}
