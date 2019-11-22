@extends('Home/User.index')

@section('title', '修改密码')

@section('css')
    
@endsection

@section('body')
    <div class="user-content__box clearfix bgf">
        <div class="title"><a style='color:#666' href="/home/userinfo">账户信息</a> - 修改登陆密码</div>
        <div class="modify_div">
            <div class="clearfix">
                <a href="/home/showeditpwd" role="button" class="but">修改登陆密码</a>
            </div>
            <div class="help-block">随时都能更改密码，保障您账户的安全</div>
        </div>
    </div>
@endsection
    


@section('js')

@endsection