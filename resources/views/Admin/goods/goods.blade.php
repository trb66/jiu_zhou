@extends('Admin.index')
@section('title', '商品列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')

@php
    $typeName = [];
    foreach ($goods as $key => $v)
    {
         $typeName[$v->tname->id] = $v->tname->name;
         
    }
   
@endphp
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
            <div class="widget-head am-cf">
            <div class="widget-title  am-cf">商品列表</div>
            </div>
                <div class="widget-body  am-fr">

                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="/admin/goods/goodsAdd" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</a>
                                    <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> <a href="/admin/goods" style="color:#fff">还原</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 搜索 -->
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                        <select id="inputState" data-am-selected="{btnSize: 'sm'}">

                            <option value="">--请选择分类名--</option>
                            @foreach(array_unique($typeName) as $k => $v)
                            <option
                             {{$id == $k ? 'selected' : ''}}
                             value="{{$k}}">{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input type="text" value="{{$name}}" id="val" placeholder="请输入商品名" class="am-form-field ">
                        <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" id="but" type="button"></button>
                        </span>
                    </div>
                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>所属分类</th>
                            <th>商品名</th>
                            <th>商品价格</th>
                            <th>商品厂家</th>
                            <th>状态</th>
                            <th>添加时间</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($goods as $v)

                        <tr>

                        <tr class="gradeX">
                            <td>{{$v->id}}</td>
                            <td style="color:#000;font-weight:800">{{$v->tname->name}}</td>
                            <td title="{{ $v->name }}" style="display:inline-block;width:150px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">{{$v->name}}</td>
                            <td>{{$v->price}}</td>
                            <td>{{$v->company}}</td>
                            <td>
                                @if($v->status == 1) 

                                <button type="button" onclick="status(this)" class="am-btn am-btn-default am-btn-danger" data-status="{{$v->id}}">已下架</button>
                                @else 
                                <button type="button" onclick="status(this)" class="am-btn am-btn-default am-btn-success" data-status="{{$v->id}}">在售中</button>
                                @endif

                                </td>
                            <td>{{$v->created_at}}</td>
                            <td>{{$v->updated_at}}</td>
                            <td>
                            <div class="tpl-table-black-operation">
                            <a href="/admin/goods/edit?id={{$v->id}}">
                            <i class="am-icon-pencil"></i> 编辑
                            </a>
                            <a href="" onclick="return del(this)" data-id="{{$v->id}}" class="tpl-table-black-operation-del">
                            <i class="am-icon-trash"></i> 删除
                            </a>
                            <a style="color:#f26522" href="/admin/imgs?id={{$v->id}}" >
                                <i class="am-icon-photo"></i> 商品图片
                            </a>
                             <a style="color:blue" href="/admin/goodsPrices?id={{$v->id}}"  class="tpl-table-black-operation-del xs" >
                                <i class="am-icon-pencil"></i> 商品规格
                            </a>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    <!-- 分页 -->
                      {{ $goods->links() }}
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script>
    //删除
    function del(zj)
    {
        var id= $(zj).data('id')
        var zj =  $(zj).parent().parent().parent()
        $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type:'post',
            url:'/admin/goods/del',
            data:{
              id:id
            },
            success:function(res){
                if(res){
                zj.remove();
               }
            },
            error:function(err){
                if(err.code = 1){
                alert(err.msg)     
               }
            }
        })
        return false;
    }
//搜索
$('#inputState').on('change', function(){
       let id = $(this).val();
       location.href = '/admin/goods?id= '+ id;

})
$('#but').click(function() {
     let id = $('#inputState').val();
     var val = $('#val').val();
     location.href = '/admin/goods?id='+id+'&name='+val;
})



//   //搜索
//     $('#inputState').on('change',function(){

//        var typeID = $(this).val();
//        $.ajax({
//           type:'post',
//           url:'/admin/goods/seek',
//           headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
//           // dataType:'json',
//           data:{cid:typeID},
//           success:(res) => {
//              console.dir(res);
//             // console.dir($('.gradeX').parent().parent());
//             // window.location.replace('/admin/goods/show')
//           },
//           error:function(err) { 
//             console.dir(err)
//           },
            
//     })
// })
    
function status(zj) 
{
    var id = $(zj).data('status');
    $.ajax({
        type:'post',
        url:'/admin/goods/status',
        headers:{ 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
       
        data:{id:id},
        success:function(res) {
               var zt = $(zj).html();
            if(zt == '在售中') {
                  $(zj).attr("class", "am-btn am-btn-default am-btn-danger")
                  $(zj).html('已下架')
            }else {
                  $(zj).attr("class", "am-btn am-btn-default am-btn-success")
                  $(zj).html('在售中')
            }
        },
        error:function(err) {
        }
    })
}
</script>
@endsection