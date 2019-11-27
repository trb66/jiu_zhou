@extends('Admin.index')
@section('title', '分类列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>.xs{cursor: pointer;}</style>
@endsection
@section('body')


<div class="row-content am-cf" style="background:white;margin-top:20px;margin-left:15px;">

   <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
        <div class="am-form-group">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="/admin/types/add" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增顶级分类</a>
                   <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> <a href="/admin/types" style="color:#fff">还原</a></button>
                </div>
            </div>
         </div>
      </div>

        <div class="am-u-sm-6 am-u-md-12 am-u-lg-6">
               <div class="am-u-sm-0 am-margin-top-xs" style=""> 
                一级分类：<select onchange="one(this)" style="height:200px" data-am-selected="{searchBox: 1}" style="display: none;">
               <option value="">--请选择--</option>
            @foreach($type as $v)
               @php
                   $sum = substr_count($v->path, ',');
                @endphp
                @if($sum == 1)
                <option {{$v->id == $id ? 'selected' : ''}} value="{{$v->id}}">{{$v->name}}</option>                       
                @endif
             @endforeach
                    </select>
                二级分类：<select onchange="two(this)" data-am-selected="{searchBox: 1}" style="display: none;">
               <option value="">--请选择--</option>
            @foreach($type as $v)
               @php
                   $sum = substr_count($v->path, ',');
                @endphp
                @if($sum == 2)
                <option {{$v->id == $cid ? 'selected' : ''}} value="{{$v->id}}">{{$v->name}}</option>                       
                @endif
            @endforeach

     </div>
                         <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                           <input type="text" class="am-form-field ">
                           <span class="am-input-group-btn">
                           </span>
                         </div>
                   </div>
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
        </table>
         
        <div style="margin-left:1100px">
         {{ $types->links() }}
        </div>
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
            data:{
                path:path,
            },
            success:function(res) {
                zj.remove();       
            },
            error:function(err) {
                alert(err.responseJSON.msg)
            }
        });
        return false;
    }


    //搜索一级分类
    function one(zj) {
          var id = $(zj).val();
          location.href = '/admin/types?id='+id

    }

    //搜索二级分类
    function two(zj) {
        var cid = $(zj).val();
        location.href = '/admin/types?cid='+cid;
    }
     
</script>
@endsection