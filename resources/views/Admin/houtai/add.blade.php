@extends('Admin.index')

@section('title', '添加管理')

@section('css')
    <link rel="stylesheet" type="text/css" href="/plug/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link rel="stylesheet" type="text/css" href="/plug/build.css">
@endsection

@section('body')
    <div class="row" id='app'>
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-border-form tpl-form-border-br">  
                        <div class='container'>
                            <div class='col-md-4 col-md-offset-2'>
                                <ul id='tips' class="list-group" style='width:800px'>

                                </ul>
                            </div>

                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">管理员名
                                <span class="tpl-form-line-small-title">admin</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name='name' class="tpl-form-input" id="user-name" placeholder="请输入管理员名字">
                                <small></small></div>
                        </div>


                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">管理员密码
                                <span class="tpl-form-line-small-title">pwd</span></label>

                            <div class="am-u-sm-9">
                                <input type="password" name='pwd' class="tpl-form-input" id="user-pwd" placeholder="请输入密码">
                                <small></small></div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">确认密码
                                <span class="tpl-form-line-small-title">pwd</span></label>
                            <div class="am-u-sm-9">
                                <input type="password" name='pwd2' class="tpl-form-input" id="user-pwd2" placeholder="请输入密码">
                                <small></small></div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">手机号
                                <span class="tpl-form-line-small-title">phone</span></label>
                            <div class="am-u-sm-9">
                                <input type="number" name='phone' id='user-phone' placeholder="输入手机号">
                                <small ></small></div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">邮箱
                                <span class="tpl-form-line-small-title">email</span></label>
                            <div class="am-u-sm-9">
                                <input type="email" name='email' id="user-email" placeholder="请输入邮箱">
                                <small></small>
                                <div></div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">状态
                                <span class="tpl-form-line-small-title">status</span></label>
                            <div class="am-u-sm-9">
                                <select  name='status' data-am-selected="{searchBox: 1}" style="display: none;">
                                    <option value="0">启用</option>
                                    <option value="1">暂时禁用</option>
                                </select>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">角色
                                <span class="tpl-form-line-small-title">role</span></label>

                            <div class="am-u-sm-9" id=roles>
                                <div class="col-md-8 checkbox checkbox-primary" id='checks'>
                                    @foreach($data as $k => $v)
                                    <div class='col-md-4' style='margin-top:5px'>
                                        <input value='{{$v->id}}' class='inps' id="checkbox{{$k}}" class="styled" type="checkbox">
                                        <label for="checkbox{{$k}}">
                                            {{$v->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="button" onclick='quan(this)' class="btn btn-default">全 选</button>
                                 <button type="button" onclick='tijiao()' class="btn btn-primary">添 加</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="/plug/Vue/axios.min.js"></script>
    <script type="text/javascript">
        // 全选
        function quan(mys)
        {
            $('.inps').prop('checked', !$('.inps')[0].checked);        
            $(mys).html() == '全 选' ? $(mys).html('取 消') : $(mys).html('全 选');
        }

        function tijiao()
        {
            var name = $('input[name=name]').val();
            var pwd = $('input[name=pwd]').val();
            var pwd2 = $('input[name=pwd2]').val();
            var email =  $('input[name=email]').val();
            var phone = $('input[name=phone]').val();
            var status = $('select[name=status]').val();
            // 获取所有多选框
            var chs = $('#roles').children('input');
            var roles = {};

            for (var i =0; i < chs.length; i++) {
                if (chs[i].checked == true) {
                    roles[i] = $(chs[i]).val();
                }
            }
            // 提示
            var tips = $('#tips');
            axios({
                method: 'post',
                url: '/admin/caddAdmin',
                data: {
                    name: name,
                    pwd: pwd,
                    pwd2: pwd2,
                    email:email,
                    phone: phone,
                    status: status,
                    roles: roles,
                },
            })
            .then(function (res) {
                tips.empty(); // 清空提示下的所有内容
                if (res.data.code) {
                    alert(res.data.msg);
                    location.href = '/admin/adminlist';
                } else {
                    alert(res.data.msg);
                }
            })
            .catch(function (err) {
                tips.empty(); // 清空提示下的所有内容
                var msg = err.response.data.errors;
                for(v in msg) {
                    for (vv in msg[v]) {
                        tips.append('<li class="list-group-item list-group-item-danger">'+msg[v][vv]+'</li>');
                    }
                }
            })
        }
    </script>
@endsection