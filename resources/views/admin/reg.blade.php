<form action="{{url('admin/regDo')}}" method="post">
    @csrf
    用户名<input type="text" name="user_name"><font color="red">{{$errors->first('user_name')}}</font><br>

    邮箱<input type="text" name="email"><font color="red">{{$errors->first('email')}}</font><br>
    密码<input type="text" name="password"><font color="red">{{$errors->first('password')}}</font><br>
    确认密码<input type="text" name="pwds"><font color="red">{{$errors->first('pwds')}}{{session("a")}}</font><br>
    <input type="submit" value="点击注册"><button><a href="{{url('admin/login')}}">登录</a></button>
</form>