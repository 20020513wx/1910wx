<form action="{{url('admin/loginDo')}}" method="post">
    @csrf
    用户名<input type="text" name="user_name"><font color="red">{{$errors->first('user_name')}}</font><br>
    密码<input type="text" name="password"><font color="red">{{$errors->first('pwd')}}</font><br>
    <input type="submit" value="点击登录"><button><a href="{{url('/')}}">注册</a></button>
</form>