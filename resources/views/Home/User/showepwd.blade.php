@extends('Home/User.index')

@section('title', '修改密码')

@section('css')
    
@endsection

@section('body')
    <!-- 密码1 -->
    <div class="user-content__box clearfix bgf" id='step1'>
        <div class="title"><a style='color:#666' href="/home/userinfo">账户信息</a> - 修改登陆密码</div>
        <div class='yuanpwd'>
            
        </div>
        <div class="step-flow-box">
            <div class="step-flow__bd">
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">　输入旧密码</p>
                </div>
                <div class="step-flow__line step-flow__line_ing">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p  class="step-flow__title-top">重置登陆密码</p>
                </div>
                <div class="step-flow__line">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">完成</p>
                </div>
            </div>
        </div>
        <form  class="user-setting__form" onsubmit='return false;' role="form">
            <div class="form-group">
                <input class="form-control" id='yuanpwd' maxlength="25" autocomplete="off" type="password">
                <span class="tip-text">请输入原密码</span>
                <span class="see-pwd pwd-toggle" title="显示密码"><i class="glyphicon glyphicon-eye-open"></i></span>
                <span class="error_tip"></span>
            </div>
            <div class="user-form-group tags-box">
                <button type="submit" class="btn" id='yuan'>提交</button>
            </div>
            <script src="/Home/js/login.js"></script>
            <script>
                $(document).ready(function(){
                    $('.form-control').on('blur focus',function() {
                        $(this).addClass('focus');
                        $('.error_tip').empty();
                        if ($(this).val() == ''){$(this).removeClass('focus')}
                    });
                });
            </script>
        </form>
    </div>

    <!-- 密码2 -->
    <div class="user-content__box clearfix bgf" id='step2' style='display:none'>
        <div class="title"><a style='color:#666' href="/home/userinfo">账户信息</a> - 修改登陆密码</div>
        <div class='xinpwd'>
            
        </div>
        <div class="step-flow-box">
            <div class="step-flow__bd">
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">输入旧密码</p>
                </div>
                <div class="step-flow__line step-flow__li_done">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p  class="step-flow__title-top">重置登陆密码</p>
                </div>
                <div class="step-flow__line step-flow__line_ing">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">完成</p>
                </div>
            </div>
        </div>
        <form class="user-setting__form" role="form">
            <div class="form-group">
                <input class="form-control" name='pwd1' required="" maxlength="20" autocomplete="off" type="password">
                <span class="tip-text">新的密码</span>
                <span class="see-pwd pwd-toggle" title="显示密码"><i class="glyphicon glyphicon-eye-open"></i></span>
                <span class="error_tip"></span>
            </div>
            <div class="form-group">
            <div class="form-group">
                <input class="form-control" name='pwd2'  required="" maxlength="20" autocomplete="off" type="password">
                <span class="tip-text">再次确认新的密码</span>
                <span class="see-pwd pwd-toggle" title="显示密码"><i class="glyphicon glyphicon-eye-open"></i></span>
                <span class="error_tip"></span>
            </div>
            </div>
            <div class="user-form-group tags-box">
                <button type="submit" class="btn " id='xin'>提交</button>
            </div>
            <script src="/Home/js/login.js"></script>
            <script>
                $(document).ready(function(){
                    $('.form-control').on('blur focus',function() {
                        $(this).addClass('focus')
                        if ($(this).val() == ''){$(this).removeClass('focus')}
                    });
                });
            </script>
        </form>
    </div>

    <!-- 密码3 -->
    <div class="user-content__box clearfix bgf" id='step3' style='display:none'>
        <div class="title"><a style='color:#666' href="/home/userinfo">账户信息</a> - 修改登陆密码</div>
        <div class="step-flow-box">
            <div class="step-flow__bd">
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">输入旧密码</p>
                </div>
                <div class="step-flow__line step-flow__li_done">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p  class="step-flow__title-top">重置登陆密码</p>
                </div>
                <div class="step-flow__line step-flow__li_done">
                  <div class="step-flow__process"></div>
                </div>
                <div class="step-flow__li step-flow__li_done">
                  <div class="step-flow__state"><i class="iconfont icon-ok"></i></div>
                  <p class="step-flow__title-top">完成</p>
                </div>
            </div>
        </div>
        <div class="modify-success__box text-center">
            <div class="icon b-r50"><i class="iconfont icon-checked cf fz24"></i></div>
            <div class="text c6">登陆密码设置成功！</div>
            <a href="/home/userinfo" class="btn"><span id="sec">3</span> 秒后跳转至用户信息页，如果浏览器未跳转请点击这里</a>
        </div>
    </div>

@endsection
    
@section('js')
    <script type="text/javascript">
        // 输入原密码
        $('#yuan').click(function (){
            var yuanpwd = $('#yuanpwd').val();
            if(yuanpwd != '') {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/home/showeditpwd',
                    data: {
                        pwd: yuanpwd,
                    },
                    success: function(res) {
                        $('#step1').css('display', 'none');
                        $('#step2').css('display', 'block');
                        $('.yuanpwd').empty();
                    },
                    error: function(err) {
                        $('.yuanpwd').empty();
                        $('.yuanpwd').append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
                    }
                });
            } else {
                alert('请输入原密码');
            }
        });

        // 新的密码
        $('#xin').click(function() {
            var xinpwd = $('.xinpwd');
            var pwd1 = $('input[name=pwd1]').val();
            var pwd2 = $('input[name=pwd2]').val();

            if(pwd1 == '' || pwd2 == '') {
                xinpwd.empty();
                xinpwd.append('<div class="alert alert-danger" role="alert">请填写密码</div>');
                return false;
            }

            if (!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$/.test(pwd1)) || !(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$/.test(pwd2))) {
                xinpwd.empty();
                xinpwd.append('<div class="alert alert-danger" role="alert">密码至少包含 数字和英文，长度6-20</div>');
                return false;
            }

            if(pwd1 != pwd2) {
                xinpwd.empty();
                xinpwd.append('<div class="alert alert-danger" role="alert">两次密码不一致</div>');
                return false; 
            }

            $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/editpwd',
                data: {
                    pwd: pwd1,
                },
                success: function(res) {
                    $('#step1').css('display', 'none');
                    $('#step2').css('display', 'none');
                    $('#step3').css('display', 'block');
                    var time = 3;
                    var timer;
                    timer = setInterval(function(){
                        $('#sec').html(time--);
                        if (time < 0) {
                            window.location.href = '/home/userinfo'
                            clearInterval(timer);
                        }
                    }, 1000);
                    $('.xinpwd').empty();
                },
                error: function(err) {
                    $('.xinpwd').empty();
                    $('.xinpwd').append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
                }
            });
            return false;

        });
    </script>
@endsection