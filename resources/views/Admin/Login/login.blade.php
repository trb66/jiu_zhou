<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>九州-登陆</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/Admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/Admin/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/Admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/Admin/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/Admin/assets/css/app.css">
    <script src="/plug/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/plug/bootstrap/css/bootstrap.min.css'">

</head>

<body data-type="login">
    <script src="/Admin/assets/js/theme.js"></script>
    <div class="am-g tpl-g" style='margin-top:-100px'>
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">

                </div>

                <form onsubmit='return false' class="am-form tpl-form-line-form">
                <div id='tips' style='display:none' class="am-alert am-alert-secondary" data-am-alert>
                </div>

                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">用户名：</label>
                        <div class="am-u-sm-9">
                            <input type="text" name='user' class="tpl-form-input" id="user-name" placeholder="请输入用户名">
                            <small style='color:red' id='user'></small>
                        </div>

                    </div>

                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">密码：
                        </label>
                        <div class="am-u-sm-9">
                            <input type="password" name='pwd' class="am-form-field tpl-form-no-bg" placeholder="密码">
                            <small style='color:red' id='pwds'></small>
                        </div>
                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <span for="user-intro" class="am-u-sm-3 am-form-label">登陆状态：</span>
                        <div class="am-u-sm-9">
                            <div class="tpl-switch">
                                <input type="checkbox" id='status' class="ios-switch bigswitch tpl-switch-btn">
                                <div class="tpl-switch-btn-view">
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="am-form-group">

                        <button type="button" onclick='tj()' class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="/plug/amazeui.min.js"></script>
<script src="/plug/Vue/axios.min.js"></script>
<script src="/Admin/assets/js/app.js"></script>
<script type="text/javascript" src='/plug/bootstrap/js/bootstrap.min.js'></script>
<script type="text/javascript">
    $("input[name=user]").blur(function(){
        if ($('input[name=user]').val() == '') {
            $('#user').html('请填写用户名');
        } else {
            $('#user').html('');
        }
    });

    $("input[name=pwd]").blur(function(){
        if ($('input[name=user]').val() == '') {
            $('#pwds').html('请填写密码');
        } else {
            $('#pwds').html('');
        }
    });

    function tj() {
        var name = $('input[name=user]').val();
        var pwd = $('input[name=pwd]').val();
        var status = $('#status')[0].checked;

        if (name == '' || pwd == '') { // 用户名和密码不完整时
            alert('请填写用户名和密码');
        } else { // OK时
            axios({
                method: 'post',
                url: '/admin/chulilogin',
                data: {
                    name: name,
                    pwd: pwd,
                    status: status,
                },
            })
            .then(function (res) {
                if (res.data.code == 0) {
                    alert(res.data.msg);
                } else {
                    location.href = '/admin';
                }
            })
            .catch(function (err) {
                var msg = err.response.data.errors.name[0];
                $('#user').html(msg);
            })
        }

    }


    // var sts = ''; 
    // function yzm(mys) {
    //     console.log(132);
    //     if ($(mys).html() == '发送验证码') {
    //         $('#tips').css('display', 'none');
    //         var email = $('input[name=email]').val(); // 获取邮箱
    //         var zz = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/; // 匹配邮箱正则
    //         if (zz.test(email)) { // 邮箱通过
    //             axios({
    //                 method: 'post',
    //                 url: '/admin/sendemail',
    //                 data: {
    //                     email: email,
    //                 },
    //             })
    //             .then(function (res) {
    //                 sts = res.data.code;
    //                 $(mys).html('已发送');
    //             })
    //             .catch(function (err) {
    //                 $('#tips').css('display', 'block');

    //                 $('#tips').html(''); // 设置内容为空

    //                 var errs = err.response.data.errors.email;

    //                 for (var v in errs) {
    //                     $('#tips').append('<li>'+ errs[v] +'</li>'); // 提示内容
    //                 }

    //             })
    //         } else { // 邮箱不通过
    //             $('#tips').css('display', 'block');

    //             $('#tips').html(''); // 设置内容为空

    //             $('#tips').append('<li>邮箱格式不正确</li>'); // 提示内容
    //         }
    //     } else {
    //         alert('已发送，请输入~');
    //     }
    // }

    // function logins()
    // {
    //     if (sts == 1) {
    //         var uyz = $('input[type=number]').val();

    //         var yz = /^\d{6}$/; // 匹配验证码正则

    //         if (yz.test(uyz)) { // 判断通过
    //             axios({
    //                 method: 'post',
    //                 url: '/admin/chulilogin',
    //                 data: {
    //                     yangzm: uyz, // 用户输入的验证
    //                     email: $('input[name=email]').val(),
    //                 },
    //             })
    //         } else {
    //             alert('验证码格式不正确');
    //         }
    //     } else {
    //         alert('请先发送验证码');
    //     }
    // }
</script>

</body>

</html>