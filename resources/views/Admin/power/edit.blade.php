@extends('Admin.index')

@section('title', '添加角色')

@section('css')
    <link rel="stylesheet" type="text/css" href="/plug/bootstrap/css/bootstrap.min.css">
@endsection

@section('body')
<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">权限修改</div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
            <div class="widget-body am-fr">
                <!-- 错误提示 -->
                <div class='container'>
                    <div class='col-md-4 col-md-offset-2'>
                        <ul id='tips' class="list-group" style='width:800px'>
                            <!-- <li class="list-group-item list-group-item-danger">'+err.response.data.msg+'</li> -->
                        </ul>
                    </div>

                </div>

                <form class="am-form tpl-form-border-form tpl-form-border-br">
                    <div class="am-form-group">
                        <label for="user-name" value='' class="am-u-sm-3 am-form-label">权限名称
                            <span class="tpl-form-line-small-title">name</span></label>
                        <div class="am-u-sm-9">
                            <input data-id='{{$per["id"]}}' style='color:black' type="text" value='{{$per['name']}}' name=name class="tpl-form-input" id="user-name" placeholder="请输入权限名">
                            <small></small></div>
                    </div>
                    
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">控制器名
                            <span class="tpl-form-line-small-title">　ctrl</span></label>
                        <div class="am-u-sm-9">
                            <input type="text" style='color:black' value='{{$per["controller"]}}' name='controller' placeholder="输入控制器名"></div>
                    </div>
                    
                    <div class="am-form-group">
                        <label for="user-weibo" class="am-u-sm-3 am-form-label">操作名称
                            <span class="tpl-form-line-small-title">meth</span></label>
                        <div class="am-u-sm-9">
                            <input type="text" style='color:black' value='{{$per["action"]}}' name='action' id="user-weibo" placeholder="请添加操作方法名">
                            <div></div>
                        </div>
                    </div>                    
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">简短描述</label>
                        <div class="am-u-sm-9">
                            <textarea class="" name='descr' rows="3" id="user-intro" placeholder="描述在5-20字左右" style='color:black'>{{$per['descr']}}</textarea>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" onclick='tijiao()' class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button></div>
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
        function tijiao()
        {
            var id = $('input[name=name]').data('id'); // id
            var name  = $('input[name=name]').val(); // 名字

            var controller  = $('input[name=controller]').val(); // 控制器名称

            var action  = $('input[name=action]').val(); // 方法名

            var descr  = $('textarea[name=descr]').val(); // 简短描述

            var tips = $('#tips');

            axios({
                method: 'post',
                url: '/admin/poweredit',
                data: {
                    id: id,
                    name: name,
                    controller: controller,
                    action: action,
                    descr: descr,
                },
            })
            .then(function (res) {
                console.log(res);
                tips.empty(); // 清空提示下的所有内容
                alert(res.data.msg);
 
            })
            .catch(function (err) {
                tips.empty(); // 清空提示下的所有内容
                if (err.response.data.code == 0) {
                    tips.append('<li class="list-group-item list-group-item-danger">'+err.response.data.msg+'</li>');
                } else {
                    var msg = err.response.data.errors;
                    for(v in msg) {
                        for (vv in msg[v]) {
                            tips.append('<li class="list-group-item list-group-item-danger">'+msg[v][vv]+'</li>');
                        }
                    }
                }
            })
        }
    </script>
@endsection