@extends('Admin.index')

@section('title', '添加角色')

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
                    <form onsubmit='return false' class="am-form tpl-form-border-form tpl-form-border-br">  
                        <!-- 错误提示 -->
                        <div class='container'>
                            <div class='col-md-4 col-md-offset-2'>
                                <ul id='tips' class="list-group" style='width:800px'>

                                </ul>
                            </div>

                        </div>

                        <div class='container'>
                            <div class='col-md-4 col-md-offset-2'>
                                <ul id='tips' class="list-group" style='width:800px'>

                                </ul>
                            </div>

                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">角色名
                                <span class="tpl-form-line-small-title">role</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" name='name' class="tpl-form-input" id="user-name" placeholder="请输入角色名字">
                                <small></small></div>
                        </div>


                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">角色拥有的权限
                                <span class="tpl-form-line-small-title">power</span></label>

                            <div class="am-u-sm-9">
                                <div class="col-md-8 checkbox checkbox-primary" id='checks'>
                                    @foreach($pers as $k => $v)
                                    <div class='col-md-4' style='margin-top:5px'>
                                        <input data-id="{{$v['id']}}" class='inps' id="checkbox{{$k}}" class="styled" type="checkbox">
                                        <label for="checkbox{{$k}}">
                                            {{$v['name']}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" onclick='quan(this)' class="btn btn-default">全 选</button>
                                 <button type="submit" onclick='tijiao()' class="btn btn-primary">添 加</button>
                            </div>
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

        function tijiao() // 添加角色
        {
            var pres = {}; // 存储选择的权限ID

            var name = $('input[name=name]').val(); // 存储角色名字

            var ces = $('#checks :checked'); // 存储所有选中的多选框

            for(var i = 0; i < ces.length; i++) {
                pres[i] = $(ces[i]).data('id');
            }

            var tips = $('#tips'); // 提示
            // 发起axios请求，存储数据
            axios({
                method: 'post',
                url: '/admin/addroles',
                data: {
                    name: name,
                    id: pres,
                },
            })
            .then(function (res) {
                tips.empty(); // 清空提示下的所有内容

                if(res.data.code == 1) { // 插入成功
                    $('input[name=name]').val('');
                    alert(res.data.msg);
                } else {
                    alert(res.data.msg)
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