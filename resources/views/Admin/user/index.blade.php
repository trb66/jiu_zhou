@extends('Admin.index')

<!-- 头部 -->
@section('title', '会员列表')

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
                <div class="widget-title  am-cf">会员列表</div></div>
            <div class="widget-body  am-fr">

                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                    <div class="am-form-group tpl-table-list-select">
<!--                         <select data-am-selected="{btnSize: 'sm'}">
                            <option>性别</option>
                            <option value="0">男</option>
                            <option value="1">女</option>
                        </select> -->
                    </div>
                </div>


                <div class="am-u-sm-12 am-u-md-6 am-u-lg-2">
                    <div class="am-form-group tpl-table-list-select">
                        <select name='status' data-am-selected="{btnSize: 'sm'}">
                            <option>状态</option>
                            <option
                                @php
                                    if(!empty($_GET['status']) &&  $_GET['status'] == 1)
                                    echo 'selected';
                                @endphp
                             value="1">封禁</option>
                            <option
                                @php
                                    if(!empty($_GET['status']) &&  $_GET['status'] == 0)
                                    echo 'selected';
                                @endphp
                             value="0">正常</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input value='@php if(!empty($_GET['str'])) echo $_GET['str'] @endphp' type="text" name='str' class="am-form-field ">
                        <span class="am-input-group-btn">
                            <button id='sel' class="am-btn am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
                        </span>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-6 am-u-lg-1">
                    <div class="am-form-group ">
                        <button type="submit" style='background:#5EB95E' onclick='location.href="/admin/userlist"' class="btn btn-primary">还 原</button>
                    </div>
                </div>

                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                        <thead>
                            <tr>
                                <th>头像</th>
                                <th>用户名</th>
                                <th>真实姓名</th>
                                <th>手机号</th>
                                <th>邮箱</th>
                                <th>性别</th>
                                <th>状态</th>
                                <!-- <th>操作</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_list as $v)
                                <tr class="gradeX">
                                    <td>
                                        <img style='border-radius:50%' src="/storage/{{$v->userinfo->photo}}" width=75 height=75 class="tpl-table-line-img" alt="">
                                    </td>
                                    <td class="am-text-middle">{{$v->username}}</td>
                                    <td class="am-text-middle">{{$v->userinfo->name}}</td>
                                    <td class="am-text-middle">{{$v->phone}}</td>
                                    <td class="am-text-middle">{{$v->userinfo->email}}</td>
                                    <td class="am-text-middle">
                                        @if($v->userinfo->sex == 0)
                                            男
                                        @else
                                            女
                                        @endif
                                    </td>
                                    <td class="am-text-middle">
                                        @if($v->status == 0) 
                                            <div class="tpl-table-black-operation">
                                                <a data-id='{{$v->id}}' onclick='jin(this)' href="javascript:;">正常</a>
                                            </div>
                                        @else
                                            <div class="tpl-table-black-operation">
                                                <a href="javascript:;" onclick='jin(this)' data-id='{{$v->id}}' class="tpl-table-black-operation-del">封禁</a>
                                            </div>
                                        @endif

                                    </td>
<!--                                     <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="javascript:;">
                                                <i class="am-icon-pencil"></i>编辑</a>
                                            <a href="javascript:;" class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i>删除</a>
                                        </div>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="am-u-lg-12 am-cf">
                    <!-- <div><button type="submit" onclick='xuan(this)' class="btn btn-primary">全 选</button></div> -->
                    <div class="am-fr">
                        {{ $user_list->links() }}
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
    function jin(mys) {
        var id = $(mys).data('id'); // 修改状态的用户id
        console.log(id);
        $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type: 'post',
            url: '/admin/userstatus',
            data: {
                id: id,
            },
            success: function(res) {
                    var cls = $(mys).html();
                    if (cls == '正常') {
                        $(mys).attr("class","tpl-table-black-operation-del");
                        $(mys).html('封禁');
                    } else {
                        $(mys).attr("class","tpl-table-black-operation");
                        $(mys).html('正常');
                    }
            },
            error: function(err) {
                alert('网络错误，请重试~');
            }
        });
    }

    // 搜索
    $('#sel').click(function () {
        var sts = $('select[name=status] :selected').val();
        var str = $('input[name=str]').val();
        var sou = '';
        console.log(sts);
        console.log(str);
        // 1.只搜状态
        if (sts != '状态' && str =='') sou = '?status='+sts; 

        // 2.只搜名字
        if (sts == '状态' && str !='') sou = '?str='+str; 

        // 3.都搜索
        if (sts != '状态' && str !='') sou = '?status='+sts+'&str='+str;

        // 判断搜索
        if (sts != '状态' || str != '') location.href = '/admin/userlist/' + sou;
    });
</script>
@endsection
