@extends('Admin.index')

<!-- 头部 -->
@section('title', '角色列表')

<!-- CSS -->
@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection


<!-- 身体 -->
@section('body')
<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title  am-cf">权限列表</div></div>
            <div class="widget-body  am-fr">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-5">
                    <div class="am-form-group">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button type="button" onclick='location.href="/admin/addpower"' class="am-btn am-btn-default am-btn-success">
                                    <span class="am-icon-plus"></span>新增</button>
                                
                                <button type="button" onclick='delall()' class="am-btn am-btn-default am-btn-danger">
                                    <span class="am-icon-trash-o"></span>删除</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                        <!-- <select data-am-selected="{btnSize: 'sm'}">
                            <option value="option1">所有类别</option>
                            <option value="option2">IT业界</option>
                        </select> -->
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input name='str' value="@php if(!empty($_GET['str'])) echo $_GET['str'] @endphp" type="text" class="am-form-field ">
                        <span class="am-input-group-btn">
                            <button onclick='sel()' class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
                        </span>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-6 am-u-lg-1">
                    <div class="am-form-group ">
                        <button type="submit" style='background:#5EB95E' onclick='location.href="/admin/power"' class="btn btn-primary">还 原</button>
                    </div>
                </div>

                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>选择</th>
                                <th>ID</th>
                                <th>权限名称</th>
                                <th>控制器</th>
                                <th>操作方法</th>
                                <th>描述</th>
                            </tr>
                        </thead>
                        <tbody id='box'>
                            @foreach($pers as $v)
                                <tr class="gradeX">
                                    <td><input class='chs' value="{{$v->id}}" type="checkbox" name=""></td>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->controller}}</td>
                                    <td>{{$v->action}}</td>
                                    <td>{{$v->descr}}</td>
                                    <td>
                                        <div class="tpl-table-black-operation">
                                            <a href="/admin/poweredit/?id={{$v->id}}">
                                                <i class="am-icon-pencil"></i>编辑</a>
                                            <a data-id='{{$v->id}}' href="javascript:;" onclick='delone(this)' class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i>删除</a>
                                        </div>
                                    </td>
                                </tr>
                            <!-- more data -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="am-u-lg-12 am-cf">
                    <div><button type="submit" onclick='xuan(this)' class="btn btn-primary">全 选</button></div>
                    <div class="am-fr">
                        {{ $pers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection


<!-- JS -->
@section('js')
<script type="text/javascript">
    // 全选删除
    function xuan(mys)
    {
        $('.chs').prop('checked', !$('.chs')[0].checked);        
        $(mys).html() == '全 选' ? $(mys).html('取 消') : $(mys).html('全 选');
    }

    function delone(mes)
    {
        var r = confirm('您确定要删除吗?');
        if (r) { // 删除
            var pid = $(mes).data('id'); // 存储要删除的权限ID
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/admin/powerdel',
                data: {
                    id: pid,
                },
                success: function(res) {
                    if (res.code == 1) { // 删除成功
                        // 删除节点
                        $(mes).parent().parent().parent().remove();
                        if ($('#box').children().length == 0) {
                            location.href = '/admin/power?page=1';
                        }
                    }
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.msg);
                }
            });
        }
    }

    // 删除所有
    function delall()
    {
        var chall = $('#box :checked'); // 获取所有选中的多选框
        if (chall.length != 0) {
            var rs = confirm('您确定要删除吗?');
            if (rs) {
                var pers = {}; // 存储角色ID

                var dels = {}; // 存储节点

                for(var i = 0; i < chall.length; i++) { // 循环拿出选中的id
                        pers[i] = $(chall[i]).val();
                        dels[i] = $(chall[i]);
                }
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/admin/powerdel',
                    data: {
                        id: pers,
                    },
                    success: function(res) {
                        if (res.code == 1) {
                            for(var v in dels) { // 删除成功，删除节点
                                console.log(dels[v].parent().parent().remove());
                            }
                            if ($('#box').children().length == 0) { // 判断当前节点为空，跳转至第一页
                                location.href = '/admin/power?page=1';
                            }
                        } else {
                            alert('服务器繁忙~');
                        }
                    },
                    error: function(err) {
                        if (err.responseJSON.code == 0) {
                            alert(err.responseJSON.msg);
                        } else {
                            alert('网络错误~');                            
                        }
                    }
                });
            }

        } else {
            alert('请选择要删除的角色');
        }     
    }

    // 搜索
    function sel()
    {
        var str = $('input[name=str]').val();

        // 只搜名字
        if (str != '') {
            location.href = '/admin/power/?str=' + str;
        }
    }
</script>
@endsection
