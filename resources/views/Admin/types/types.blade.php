@extends('Admin.index')
@section('title', '分类列表')
@section('css')
@endsection
@section('body')
  
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

            @foreach($types as $v)
            <tbody>
                <tr class="gradeX">
                    <td>{{$v['id']}}</td>
                    <td>{{$v['name']}}</td>
                    <td>{{$v['pid']}}</td>
                    <td>{{$v['path']}}</td>
                    <td>{{$v['created_at']}}</td>
                    <td>{{$v['updated_at']}}</td>
                    <td>
                        <div class="tpl-table-black-operation">
                            <a href="" onclick="return del(this)">
                                <i class="am-icon-pencil"></i> 编辑
                            </a>
                            <a data-id="{{$v['id']}}" onclick="return del(this)" class="tpl-table-black-operation-del" >
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

@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
    function del(zj) {
        var id = $(zj).data()
        var zj = $(zj).parent().parent().parent()

          $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type:'post',
            url: '/admin/types/del',
            data:{
                id:id,
            },
            success:function(res){
               // $(id).parent().
               zj.remove();
               
            },
            error:function(err){
               console.dir(err)
            }
        });
        return false;
    }
  


     // var types = new Vue({
     //         el: '#types',
     //         data:{
     //           err:'',
     //           id:'',
     //           aa:'123',          
     //         },
     //         methods:{
     //                del:function(ids){
     //                console.dir(ids)
     //                let data = new FormData()
     //                data.append('id', ids)  //传分类ID
     //                axios({
     //                    method:'post',  
     //                    url: '/admin/types/del',  
     //                    data: data,
     //                })
     //                .then((res) => {
     //                    if(res.status == 200){
                           
                            
     //                    }
     //                })
     //                .catch(function(err){

     //                })
     //            }

     //         }

     // })
</script>
@endsection