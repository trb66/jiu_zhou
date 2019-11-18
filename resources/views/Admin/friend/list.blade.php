@extends('Admin.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection


@section('body')
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title  am-cf">友链列表</div>
                </div>
                <div class="widget-body  am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <div class="am-btn-toolbar">
                                <a href="/admin/add" class="am-btn-group am-btn-group-xs">
                                    <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                            <thead>
                                <tr>
                                    <th>友链名称</th>
                                    <th>友链地址</th>
                                    <th>友链状态</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                        @foreach($list as $v)
                            <tbody>
                                <tr class="gradeX">
                                    <td>{{ $v['name'] }}</td>
                                    <td>{{ $v['url'] }}</td>
                                    <td style="cursor:pointer" onclick="status(this)" data-id="{{ $v['id'] }}" data-status="{{ $v['status'] }}">{{ $arr[ $v['status'] ] }}</td>
                                    <td>{{ $v['create_at'] }}</td>
                                    <td>
                                        <div class="tpl-table-black-operation">
                                            <a href="/admin/friendedit/{{ $v['id'] }}">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a onclick="del(this)" data-id="{{ $v['id'] }}" href="javascript:;" class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                        </table>
                    </div>
                </div>
                {{ $list->links() }}
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
//删除数据
function del(d){
    var fid = $(d).data('id');

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });

    $.ajax({
        type : 'post',
        url : '/admin/friendsdel',
        data: {id:fid},
        success:function(res){
            if(res.code == 0){
                alert(res.msg)
                location.href = res.url
            }
        },
        error:function(err){
            if(res.code == 1){
                alert(res.msg)
            }
        }
    });
}
// 修改状态
function status(e){
    var sta = $(e).data('status');
    var d = $(e).data('id');
    var s = $(e).html()

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });

    $.ajax({
        type:'post',
        url : '/admin/friendsta',
        data:{status:sta,id:d},
        success:function(res){
            if(res.code == 0){
                alert(res.msg);
                if(s == '禁用'){
                    $(e).html('显示')
                }else if(s == '显示'){
                    $(e).html('禁用')
                }
            }
        },
        error:function(err){
            if(res.code == 1){
                alert(res.msg);
                if(s == '禁用'){
                    $(e).html('显示')
                }else if(s == '显示'){
                    $(e).html('禁用')
                }
            }
        }
    });
}
</script>
@endsection