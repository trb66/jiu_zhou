@extends('Admin.index')
@section('title', '商品列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')


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
                                    <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                    <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                                    <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                                    <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                    <div class="am-form-group tpl-table-list-select">
                        <select data-am-selected="{btnSize: 'sm'}">
                            <option value="option1">所有类别</option>
                            <option value="option2">IT业界</option>
                            <option value="option3">数码产品</option>
                            <option value="option3">笔记本电脑</option>
                            <option value="option3">平板电脑</option>
                            <option value="option3">只能手机</option>
                            <option value="option3">超极本</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                        <input type="text" class="am-form-field ">
                        <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
                        </span>
                    </div>
                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>所属分类</th>
                            <th>商品名</th>
                            <th>商品价格</th>
                            <th>商品厂家</th>
                            <th>添加时间</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $v)

                        <tr class="gradeX">
                            <td style="color:#000;font-weight:800">{{$v->tname->name}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->price}}}</td>
                            <td>{{$v->company}}</td>
                            <td>{{$v->status == 1 ? '已下架': '在售中' }}</td>
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
                             <a style="color:blue" href="/admin/goodsPrices?key_id={{$v->tname->id}}"  class="tpl-table-black-operation-del xs" >
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
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>

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
            dataType:'json',
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

</script>
@endsection