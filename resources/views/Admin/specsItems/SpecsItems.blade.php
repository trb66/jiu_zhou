@extends('Admin.index')
@section('title', '图片列表')
@section('css')
<link rel="stylesheet" href="/plug/bootstrap/css/bootstrap.min.css">

@endsection
@section('body')
<div class="row-content am-cf" style="background:white;margin-top:20px;margin-left:15px">
      <div class="widget-body  am-fr">
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
        <div class="am-form-group">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a href="/admin/specsItems/add" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增模型 </a>
                    <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> <a href="/admin/specsItems" style="color:#fff">还原</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
        <div class="am-form-group tpl-table-list-select">
        </div>
    </div>
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
            <input type="text" id="name" class="am-form-field" placeholder="请输入商品名">
            <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" onclick="seek(this)" type="button"></button>
         </span>
         </div>
    </div>
        <div class="am-u-sm-12">
            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                <thead>
                
                    <tr>
                        <th>ID</th>
                        <th>所属商品</th>
                        <th>规格</th>
                        <th>价格</th>
                        <th>库存</th>
                        <th>操作</th>
                    </tr>
              
                </thead>
                <tbody>
                @foreach($specGoodsPrices as $v)
                    <tr class="even gradeC">
                        <td>{{$v->id}}</td>
                        <td>{{$v->goods_name->name}}</td>
                        <td>{{$v->key_name}}</td>
                        <td>{{$v->price}}￥</td>
                        <td>{{$v->store_count}}</td>
                        <td>
                            <div class="tpl-table-black-operation">
                                <a  onclick='del(this)' data-id="{{$v->id}}" class="tpl-table-black-operation-del">
                                    <i class="am-icon-trash"></i> 删除
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                    <!-- more data -->
                </tbody>
            </table>
        </div>
         {{$specGoodsPrices->links()}}
    </div>
</div>

             
       


</div>

@endsection
@section('js')
<script src="/plug/bootstrap/js/bootstrap.min.js"></script>
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
   function del(zj)
   {
    var id = $(zj).data('id');
    var td = $(zj).parent().parent().parent();
    $.ajax({
        type:'post',
        url:'/admin/specsItems/del',
        headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
        dataType:'json',
        data:{
            id:id
        },
        success: function(res) {
           if(res) {
            alert('删除成功');
            td.remove();
           }
        },
        error: function(err) {
          // console.dir(err)
        }
    })
   
   }
   
   //搜索
   function seek() {
      var name = $('#name').val();
      location.href = '/admin/specsItems?name='+name;
      console.dir(name);
   }
</script>
@endsection