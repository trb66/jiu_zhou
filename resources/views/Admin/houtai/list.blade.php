@extends('Admin.index')

<!-- 头部 -->
@section('title', '管理列表')

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
                <div class="widget-title  am-cf">管理员列表</div></div>
            <div class="widget-body  am-fr">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-5">
                    <div class="am-form-group">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button onclick="location.href = '/admin/addAdmin'" type="button" class="am-btn am-btn-default am-btn-success">
                                    <span class="am-icon-plus"></span>新增</button>
                                <button type="button" onclick='jin(0)' class="am-btn am-btn-default am-btn-secondary">
                                    <span class="am-icon-save"></span>启用</button>
                                <button type="button" onclick='jin(1)' class="am-btn am-btn-default am-btn-warning">
                                    <span class="am-icon-archive"></span>禁用</button>
                                <button type="button" onclick='delall()' class="am-btn am-btn-default am-btn-danger">
                                    <span class="am-icon-trash-o"></span>删除</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                        <select name='status' data-am-selected="{btnSize: 'sm'}">
                            <option>状态</option>
                                <option
                                    @php
                                        if(!empty($_GET['status']) &&  $_GET['status'] == 1)
                                        echo 'selected';
                                    @endphp
                                 value='1'>禁用</option>
                                <option
                                    @php
                                        if(!empty($_GET['status']) &&  $_GET['status'] == '0')
                                        echo 'selected';
                                    @endphp
                                 value="0">启用</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input value='@php if(!empty($_GET['str'])) echo $_GET['str'] @endphp' type="text" name='str' class="am-form-field ">
                        <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" id='sel' type="button"></button>
                        </span>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-6 am-u-lg-1">
                    <div class="am-form-group ">
                        <button type="submit" style='background:#5EB95E' onclick='location.href="/admin/adminlist"' class="btn btn-primary">还 原</button>
                    </div>
                </div>

                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                            <tr>
                                <th>选择</th>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>手机号</th>
                                <th>邮箱</th>
                                <th>角色</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id='box'>
                            @foreach($data as $v)
                                <tr class="gradeX">
                                    <td><input class='chs' value='{{$v->id}}' type="checkbox" name=""></td>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->phone}}</td>
                                    <td>{{$v->email}}</td>
                                    <td>
                                        @foreach($roles as $vv)
                                            @if ($vv->id == $v->id)         
                                                <a href='javascript:void(0)';>{{$vv->rolesname}}</a>&
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>
                                        <div class="tpl-table-black-operation">
                                            <a href="/admin/adminedit/?id={{$v->id}}">
                                                <i class="am-icon-pencil"></i>查看
                                            </a>

                                            <a onclick='dels(this)' data-id="{{$v->id}}" href="javascript:;" class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i>删除
                                            </a>

                                            @if($v->status == 0) 
                                                <a data-id="{{$v->id}}" onclick='stus(this)' href="javascript:;" id='12' class="tpl-table-black-operation sts">已启用</a>
                                            @else
                                                <a data-id="{{$v->id}}" onclick='stus(this)' href="javascript:;" class="tpl-table-black-operation-del sts">已禁用</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- more data --></tbody>
                    </table>
                </div>

                <div class="am-u-lg-12 am-cf">
                    <div><button type="submit" onclick='xuan(this)' class="btn btn-primary">全 选</button></div>
                    <div class="am-fr">
                        {{ $data->links() }}
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
    <!-- <script type="text/javascript" src='/plug/bootstrap/js/bootstrap.min.js'></script> -->

<script type="text/javascript">
    // 搜索
    $('#sel').click(function () {
        var sts = $('select[name=status] :selected').val();
        var str = $('input[name=str]').val();
        var sou = '';
        // 1.只搜状态
        if (sts != '状态' && str =='') sou = '?status='+sts; 

        // 2.只搜名字
        if (sts == '状态' && str !='') sou = '?str='+str; 

        // 3.都搜索
        if (sts != '状态' && str !='') sou = '?status='+sts+'&str='+str;

        // 判断搜索
        if (sts != '状态' || str != '') location.href = '/admin/adminlist/' + sou;
    });

    // 删除用户
    function dels(as) {
        var r = confirm('您确定要删除吗?');
        if (r) { // 确定删除
            var id = $(as).data('id');
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/admin/admindel',
                data: {
                    id: id,
                },
                success: function(res) {
                    if (res.code == 1) { // 删除成功
                        // 删除节点
                        $(as).parent().parent().parent().remove();
                        if ($('#box').children().length == 0) {
                            location.href = '/admin/adminlist?page=1';
                        }
                    }
                },
                error: function(err) {
                    alert(err.responseJSON.msg);
                }
            });
        }

    }
    // 改变状态
    function stus(mys) {
        $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type: 'post',
            url: '/admin/adminstatus',
            data: {
                id: $(mys).data('id'),
            },
            success: function(res) {
                if (res == 1) {
                    var cls = $(mys).html();
                    if (cls == '已禁用') {
                        $(mys).attr("class","tpl-table-black-operation sts");
                        $(mys).html('已启用');
                    } else {
                        $(mys).attr("class","tpl-table-black-operation-del sts");
                        $(mys).html('已禁用');
                    }
                } else {
                    alert('网络不佳，请重试~');
                }
            },
            error: function(err) {
                alert('网络错误，请重试~');
            }
        });
    }

    // 全选删除
    function xuan(mys)
    {
        $('.chs').prop('checked', !$('.chs')[0].checked);        
        $(mys).html() == '全 选' ? $(mys).html('取 消') : $(mys).html('全 选');
    }


    // 删除所有
    function delall()
    {
        var chall = $('#box :checked'); // 获取所有的多选框

        if (chall.length != 0) {
            var rs = confirm('您确定要删除吗?');
            if (rs) {
                var users = {}; // 存储用户ID

                var dels = {}; // 存储节点
                for(var i = 0; i < chall.length; i++) { // 循环拿出选中的id
                        users[i] = $(chall[i]).val();
                        dels[i] = $(chall[i]);
                }

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/admin/admindelall',
                    data: {
                        id: users,                        
                    },
                    success: function(res) {
                        for(var v in dels) { // 删除成功，删除节点
                            console.log(dels[v].parent().parent().remove());
                        }

                        if ($('#box').children().length == 0) { // 判断当前节点为空，跳转至第一页
                            location.href = '/admin/adminlist?page=1';
                        }
                    },
                    error: function(err) {
                        alert('删除失败，请重试~');
                    }
                });
            }
        } else {
            alert('请选择要删除的用户~');
        }
    }

    // 一键禁用
    function jin(status)
    {
        var chall = $('#box :checked'); // 获取所有的多选框
        var msgs = '';
        status == 1 ? msgs = '禁用' : msgs = '启用';
        if (chall.length != 0) {
            var r = confirm('您确定要'+msgs+'吗?');
            if (r) { // 确定删除
                var users = {}; // 存储用户ID

                var dels = {}; // 存储节点
                for(var i = 0; i < chall.length; i++) { // 循环拿出选中的id
                        users[i] = $(chall[i]).val();
                        dels[i] = $(chall[i]);
                }

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/admin/adminjinall',
                    data: {
                        id: users,
                        status: status,                    
                    },
                    success: function(res) {
                        var tt = '';
                        var cls = '';

                        status == 1 ? cls = 'tpl-table-black-operation-del sts' : cls = 'tpl-table-black-operation sts';

                        status == 1 ? tt = '已禁用' : tt = '已启用'; 
                        for(var v in dels) {
                            dels[v].parent().parent().find('.sts').html(tt);
                            dels[v].parent().parent().find('.sts').attr("class", cls);
                        }
                    },
                    error: function(err) {
                        alert(err.responseJSON.msg);
                    }
                });
            }
        } else {
            alert('请选择您要'+msgs+'的用户~');
        }
    }
</script>
@endsection


