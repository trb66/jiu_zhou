<!DOCTYPE html>
<html lang="zh-cmn-Hans">
    
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="/Home/favicon.ico">
        <link rel="stylesheet" href="/Home/css/iconfont.css">
        <link rel="stylesheet" href="/Home/css/global.css">
        <link rel="stylesheet" href="/Home/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Home/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/Home/css/login.css">
        <script src="/Home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
        <script src="/Home/js/bootstrap.min.js" charset="UTF-8"></script>
        <script src="/Home/js/jquery.form.js" charset="UTF-8"></script>
        <script src="/Home/js/global.js" charset="UTF-8"></script>
        <script src="/Home/js/login.js" charset="UTF-8"></script>


        <title>九州商城用户协议 - 登录 / 注册</title></head>
        <style type="text/css">
            .sucmsg{
                height:50px;
                padding-left:20px;
                line-height:50px;
                color:white;
                font-size:16px;
                border-radius:5px;
                background:#7ebea5;
            }

            .errmsg{
                height:50px;
                padding-left:20px;
                line-height:50px;
                color:white;
                font-size:16px;
                border-radius:5px;
                background:#ea5506;
            }
        </style>
    
    <body>
        <div class="public-head-layout container">
            <a class="logo" href="index.html">
                <img src="/Home/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
        </div>
        <div style="background:url(/Home/images/login_bg.jpg) no-repeat center center; ">
            <div class="login-layout container">
                <div class="form-box login">
                    <div class="tabs-nav">
                        <h2>欢迎登录U袋网平台</h2></div>
                    <div class="tabs_container">
                        <form class="tabs_form" action="" method="post" id="login_form">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control phone" name="phone" id="login_phone" required placeholder="手机号" maxlength="11" autocomplete="off" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control password" name="password" id="login_pwd" placeholder="请输入密码" autocomplete="off" type="password">
                                    <div class="input-group-addon pwd-toggle" title="显示密码">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input checked="" id="login_checkbox" type="checkbox">
                                    <i>
                                    </i>30天内免登录</label>
                                <a href="javascript:;" class="pull-right" id="resetpwd">忘记密码？</a></div>
                            <!-- 错误信息 -->
                            <div class="form-group">
                                <div class="error_msg logmsg" id="login_error">

                                </div>
                            </div>
                            <button class="btn btn-large btn-primary btn-lg btn-block submit" id="login_submit" type="button">登录</button>
                            <br>
                            <p class="text-center">没有账号？
                                <a href="javascript:;" id="register">免费注册</a></p>
                        </form>
                        <div class="tabs_div">
                            <div class="success-box">
                                <div class="success-msg">
                                    <i class="success-icon"></i>
                                    <p class="success-text">登录成功</p></div>
                            </div>
                            <div class="option-box">
                                <div class="buts-title">现在您可以</div>
                                <div class="buts-box">
                                    <a role="button" href="index.html" class="btn btn-block btn-lg btn-default">继续访问商城</a>
                                    <a role="button" href="udai_welcome.html" class="btn btn-block btn-lg btn-info">登录会员中心</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 用户注册模块 -->
                <div class="form-box register">
                    <div class="tabs-nav">
                        <h2>欢迎注册
                            <a href="javascript:;" class="pull-right fz16" id="reglogin">返回登录</a></h2>
                    </div>
                    <div class="tabs_container">
                        <form class="demoform tabs_form" action="index.html" method="post" id="register_form">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control" id='register_phone' name="phone" placeholder="手机号" autocomplete="off" maxlength="11" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control sms" name="smscode" id="register_sms" maxlength="6"  placeholder="输入验证码" type="text">
                                    <span class="input-group-btn">
                                        <button id='yzm' class="btn btn-primary getsms" type="button">发送短信验证码</button></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control username" name="username" id="register_name" required placeholder="请输入用户名" maxlength="8" maxlength="11" autocomplete="off" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control password" name="password" id="register_pwd" placeholder="请输入密码" autocomplete="off" type="password">
                                    <div class="input-group-addon pwd-toggle" title="显示密码">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input checked="" id="register_checkbox" type="checkbox">
                                    <i>
                                    </i>同意
                                    <a href="temp_article/udai_article3.html">九州商城用户协议</a></label>
                            </div>

                        <!-- 错误信息 -->
                            <div class="form-group">
                                <div class="error_msg regmsg" id="login_error">
                                    

                                </div>
                            </div>
                            <button class="btn btn-large btn-primary btn-lg btn-block submit" id="register_submit" type="button">注册</button>
                        </form>
                        <div class="tabs_div">
                            <div class="success-box">
                                <div class="success-msg">
                                    <i class="success-icon"></i>
                                    <p class="success-text">注册成功</p></div>
                            </div>
                            <div class="option-box">
                                <div class="buts-title">现在您可以</div>
                                <div class="buts-box">
                                    <a role="button" href="index.html" class="btn btn-block btn-lg btn-default">继续访问商城</a>
                                    <a role="button" href="udai_welcome.html" class="btn btn-block btn-lg btn-info">登录会员中心</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 找回密码 -->
                <div class="form-box resetpwd">
                    <div class="tabs-nav clearfix">
                        <h2>找回密码
                            <a href="javascript:;" class="pull-right fz16" id="pwdlogin">返回登录</a></h2>
                    </div>
                    <div class="tabs_container">
                        <form class="tabs_form" action="https://rpg.blue/member.php?mod=logging&action=login" method="post" id="resetpwd_form">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control phone" name="phone" id="resetpwd_phone" required placeholder="手机号" maxlength="11" autocomplete="off" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control test" name="sms" id="resetpwd_sms" placeholder="输入验证码" type="text">
                                    <span class="input-group-btn">
                                        <button id='fs' class="btn btn-primary getsms" type="button">发送短信验证码</button></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                    </div>
                                    <input class="form-control password" name="password" id="resetpwd_pwd" placeholder="新的密码" autocomplete="off" type="password">
                                    <div class="input-group-addon pwd-toggle" title="显示密码">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- 错误信息 -->
                            <div class="form-group">
                                <!-- 错误信息 -->
                                <div class="error_msg" id="resetpwd_error">

                                </div>
                            </div>
                            <button class="btn btn-large btn-primary btn-lg btn-block submit" id="resetpwd_submit" type="button">重置密码</button></form>
                        <div class="tabs_div">
                            <div class="success-box">
                                <div class="success-msg">
                                    <i class="success-icon"></i>
                                    <p class="success-text">密码重置成功</p></div>
                            </div>
                            <div class="option-box">
                                <div class="buts-title">现在您可以</div>
                                <div class="buts-box">
                                    <a role="button" href="index.html" class="btn btn-block btn-lg btn-default">继续访问商城</a>
                                    <a role="button" href="login.html" class="btn btn-block btn-lg btn-info">返回登陆</a></div>
                            </div>
                        </div>
                    </div>
                </div>
<script>
    $(document).ready(function() {
        // 判断直接进入哪个页面 例如 login.php?p=register
        switch ($.getUrlParam('p')) {
        case 'register':
            $('.register').show();
            break;
        case 'resetpwd':
            $('.resetpwd').show();
            break;
        default:
            $('.login').show();
        };

        var logmsg = $('.logmsg'); // 注册提示信息
        // 登陆验证
        $('#login_submit').click(function (){
            var phone = $('#login_phone').val(); // 手机号
            var pwd = $('#login_pwd').val(); // 密码

            if (phone == '') {
                logmsg.empty('');
                logmsg.append('<p class="errmsg">请填写手机号</p>')
                return false;
            }

            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                logmsg.empty('');
                logmsg.append('<p class="errmsg">手机号格式不正确</p>');
                return false; 
            }

            if (pwd == '') {
                logmsg.empty('');
                logmsg.append('<p class="errmsg">请填写密码</p>')
                return false;
            }

            // 发起ajax请求
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/login',
                data: {
                    phone: phone,
                    pwd: pwd,
                },
                success: function(res) {
                    if (res.code == 1) {
                        alert('登陆成功,将为您跳转至首页');
                        location.href = '/';
                    }
                },
                error: function(err) {
                    if(err.responseJSON.code == 0) {
                        logmsg.empty('');
                        logmsg.append('<p class="errmsg">'+err.responseJSON.msg+'</p>');
                    } else {
                        logmsg.empty('');
                        logmsg.append('<p class="errmsg">'+err.responseJSON.errors.phone[0]+'</p>');
                    }
                }

            });

        });


        
        var regmsg = $('.regmsg'); // 注册提示信息
        // 注册验证
        $('#register_submit').click(function (){
            var phone = $('#register_phone').val(); // 手机号

            var yzm = $('#register_sms').val(); // 验证码

            var name = $('#register_name').val(); // 用户名

            var pwd = $('#register_pwd').val(); // 密码

            var sts = $('#register_checkbox'); // 注册协议

            if (phone == '') {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">请填写手机号</p>');
                return false; 
            }

            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                regmsg.empty('');
                regmsg.append('<p class="errmsg">手机号格式不正确</p>');
                return false; 
            }

            if (yzm == '') {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">请填写验证码</p>');
                return false; 
            }

            if(!(/^\d{6}$/.test(yzm))) { 
                regmsg.empty('');
                regmsg.append('<p class="errmsg">请填写6位纯数字的验证码</p>');
                return false; 
            }

            if (name == '') {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">请填写用户名</p>');
                return false; 
            }

            if (!(/^[0-9a-zA-Z\u4e00-\u9fa5]{2,8}$/.test(name))) {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">用户名为2-8位的中英文、数字</p>');
                return false; 
            }

            if (pwd == '') {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">请填写密码,不能含有特殊字符</p>');
                return false; 
            }
            
            if (!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$/.test(pwd))) {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">密码至少包含 数字和英文，长度6-20</p>');
                return false; 
            }

            if(!sts[0].checked) {
                alert('请勾选用户协议');                
                return false;
            }

            // 发送ajax请求，后台验证
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/register',
                data: {
                    yzm: yzm,
                    phone: phone,
                    username: name,
                    pwd: pwd,
                },
                success: function(res) {
                    if(res.code == 1) {
                        var r = confirm('添加成功，是否立即登陆？')
                        if(r) {
                            location.href = '/home/login';
                        }
                    }
                },
                error: function(err) {
                    if(err.responseJSON.code == 0) {
                        regmsg.empty();
                        regmsg.append('<p class="errmsg">'+err.responseJSON.msg+'</p>');
                    } else {
                        regmsg.empty(); // 清空提示下的所有内容
                        var ss = err.responseJSON.errors;
                        for(var v in ss) {
                            for(var vv in ss[v]) {
                                regmsg.append('<p class="errmsg">'+ss[v][vv]+'</p>');
                            }
                        }
                    }
                }

            });
        });

        var timer; // 验证码定时器
        // 发送验证码
        var yzm = $('#yzm');
        yzm.click(function() {
            var phone = $('#register_phone').val(); // 用户填写的手机号

            if((/^1[3456789]\d{9}$/.test(phone))){ 
                regmsg.empty('');
                regmsg.append('<p class="sucmsg">验证码已发送</p>');
                yzm.attr('disabled', true);
                yzm.html('重新发送(60)');

                // 发起ajax请求，去后台发送验证码

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/home/registeryzm',
                    data: {
                        phone: phone,
                    },
                    success: function(res) {
                        // console.log(res);
                    },
                    error: function(err) {
                        // console.log(err);
                    }
                });

                var s = 60;
                timer = setInterval(function() {
                    yzm.html('重新发送（' + s + '）');
                    s--;
                    if (s == 0) {
                        clearInterval(timer); // 清除定时器
                        yzm.html('重新发送');
                        yzm.attr('disabled', false);
                    }
                }, 1000);
            } else {
                regmsg.empty('');
                regmsg.append('<p class="errmsg">手机号格式不正确</p>');
            }
        });


        // 重置密码
        var resmsg = $('#resetpwd_error'); // 错误提示信息

        $('#resetpwd_submit').click(function (){
            var phone = $('#resetpwd_phone').val(); // 手机号

            var yzm = $('#resetpwd_sms').val(); // 验证码

            var pwd = $('#resetpwd_pwd').val(); // 密码   

            // 手机号
            if (phone == '') {
                resmsg.empty();
                resmsg.append('<p class="errmsg">请填写手机号</p>');
                return false; 
            }

            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                resmsg.empty();
                resmsg.append('<p class="errmsg">手机号格式不正确</p>');
                return false; 
            }

            // 验证码
            if (yzm == '') {
                resmsg.empty();
                resmsg.append('<p class="errmsg">请填写验证码</p>');
                return false; 
            }

            if(!(/^\d{6}$/.test(yzm))) { 
                resmsg.empty('');
                resmsg.append('<p class="errmsg">请填写6位纯数字的验证码</p>');
                return false; 
            }

            // 密码
            if (phone == '') {
                resmsg.empty();
                resmsg.append('<p class="errmsg">请填写手机号</p>');
                return false; 
            }

            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                resmsg.empty();
                resmsg.append('<p class="errmsg">手机号格式不正确</p>');
                return false; 
            }

            if (pwd == '') {
                resmsg.empty('');
                resmsg.append('<p class="errmsg">请填写密码,不能含有特殊字符</p>');
                return false; 
            }
            
            if (!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$/.test(pwd))) {
                resmsg.empty('');
                resmsg.append('<p class="errmsg">密码至少包含 数字和英文，长度6-20</p>');
                return false; 
            }

            // 发送ajax请求，后台验证
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/respwd',
                data: {
                    yzm: yzm,
                    phone: phone,
                    pwd: pwd,
                },
                success: function(res) {
                    if(res.code == 1) {
                        resmsg.empty();
                        alert('重置成功');
                    }
                },
                error: function(err) {
                    if(err.responseJSON.code == 0) {
                        resmsg.empty();
                        resmsg.append('<p class="errmsg">'+err.responseJSON.msg+'</p>');
                    } else {
                        alert('网络错误，请重试~');
                    }
                }

            });
        });


        var timer2;
        var yzm2 = $('#fs');
        yzm2.click(function (){ // 重置密码发送短信
            var phone = $('#resetpwd_phone').val(); // 用户填写的手机号

            if((/^1[3456789]\d{9}$/.test(phone))){
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });

                // 发起ajax请求，后台检查号码是否存在
                $.ajax({
                    type: 'post',
                    url: '/home/isphone',
                    data: {
                        phone: phone,
                    },
                    success: function(res) { // 发送短信
                        resmsg.empty('');
                        resmsg.append('<p class="sucmsg">验证码已发送</p>');
                        yzm2.attr('disabled', true);
                        yzm2.html('重新发送(60)');

                        // 发起ajax请求，去后台发送验证码
                        $.ajaxSetup({
                            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                        });
                        $.ajax({
                            type: 'post',
                            url: '/home/resyzm',
                            data: {
                                phone: phone,
                            },
                            success: function(res) {
                                console.log(res);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });

                        var s = 60;
                        timer2 = setInterval(function() {
                            yzm2.html('重新发送（' + s + '）');
                            s--;
                            if (s == 0) {
                                clearInterval(timer2); // 清除定时器
                                yzm2.html('重新发送');
                                yzm2.attr('disabled', false);
                            }
                        }, 1000);
                    },
                    error: function(err) {
                        resmsg.empty(); // 清空提示下的所有内容
                        var ss = err.responseJSON.errors;
                        for(var v in ss) {
                            for(var vv in ss[v]) {
                                resmsg.append('<p class="errmsg">'+ss[v][vv]+'</p>');
                            }
                        }
                    }
                });
                
            } else {
                resmsg.empty('');
                resmsg.append('<p class="errmsg">手机号格式不正确</p>');
            }
        });
    });

</script>
            </div>
        </div>
        <div class="footer-login container clearfix">
            <ul class="links">
                <a href="">
                    <li>网店代销</li></a>
                <a href="">
                    <li>U袋学堂</li></a>
                <a href="">
                    <li>联系我们</li></a>
                <a href="">
                    <li>企业简介</li></a>
                <a href="">
                    <li>新手上路</li></a>
            </ul>
            <!-- 版权 -->
            <p class="copyright">© 2005-2017 U袋网 版权所有，并保留所有权利
                <br>ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com</p></div>
    </body>

</html>