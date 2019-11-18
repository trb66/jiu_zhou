@extends('Admin.index')
@section('title', '分类列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>.xs{cursor: pointer;}</style>
@endsection
@section('body')
<div class="row-content am-cf" style="background:white;margin-top:20px;margin-left:15px">
<div class="widget-body  widget-body-lg am-fr">
    <div class="am-scrollable-horizontal " id="types">
        <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>分类名</th>
                    <th>父ID</th>
                    <th>path路径</th>
                    <th>添加时间</th>
                    <th>修改时间</th>
                    <th>操作</th>
                </tr>
            </thead>           
            <tbody>
            @foreach($types as $v)
            @php
               $sum = substr_count($v['path'], ',');
               $str = str_repeat('**', ($sum-1)*2);
            @endphp

                <tr class="gradeX">
                    <td>{{$v['id']}}</td>
                    @if($v['pid'] == 0)
                   <td style="color:#000;font-weight:800">{{$v['name']}}</td>
                    @else
                    <td>┟-{{$str}}{{$v['name']}}</td>
                    @endif
                    <td>{{$v['pid']}}</td>
                    <td>{{$v['path']}}</td>
                    <td>{{$v['created_at']}}</td>
                    <td>{{$v['updated_at']}}</td>
                    <td>
                        <div class="tpl-table-black-operation">
                            <a href="/admin/types/red?id={{$v['id']}}" >
                                <i class="am-icon-pencil"></i> 编辑
                            </a>
                            <a data-id="{{$v['id']}}" data-path="{{$v['path']}}" onclick="return del(this)" class="tpl-table-black-operation-del xs" >
                                <i class="am-icon-trash"></i> 删除
                            </a>

                            <a style="color:blue" href="/admin/types/addSon?id={{$v['id']}}"  class="tpl-table-black-operation-del xs" >
                                <i class="am-icon-pencil"></i> 添加子级
                            </a>
                      
                        </div>
                    </td>
                </tr>

            </tbody>
            @endforeach

         {{ $types->links() }}
            
        </table>
    </div>
</div>
</div>

@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
    function del(zj) {
        var path = $(zj).data()
        var zj = $(zj).parent().parent().parent()

          $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type:'post',
            url: '/admin/types/del',
            dataType:'json',
            data:{
                path:path,
            },
            success:function(res){
                // console.dir(res.msg);
                zj.remove();
               
            },
            error:function(err){
                alert(err.responseJSON.msg)
               console.dir(err)
            }
        });
        return false;
    }
     
</script>
@endsection