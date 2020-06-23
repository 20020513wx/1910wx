<button><a href="{{url('/admin/index')}}">主页</a></button><br>
<table border="1">
    <tr>
        <td>用户ID</td>
        <td>用户名</td>
        <td>用户邮箱</td>
        <td>用户注册时间</td>
        <td>最后一次登陆时间</td>
        <td>操作</td>
    </tr>
    <tr>
        <td>{{$userInfo->user_id}}</td>
        <td>{{$userInfo->user_name}}</td>
        <td>{{$userInfo->email}}</td>
        <td>{{date("Y-m-d H:i:s",$userInfo->reg_time)}}</td>
        <td>{{date("Y-m-d H:i:s",$userInfo->login_time)}}</td>
        <td></td>
    </tr>
</table>