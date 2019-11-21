@extends('Admin.index')
@section('title', '商品列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')  
  
<div class="row-content am-cf" style="background:#fff;margin-top:20px;margin-left:15px;position:relative;height:1000px">
    <div class="row" style="position:absolute">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div style="margin-bottom:20px">
        商品名称：{{$good->name}}
    </div>   
         <div class="widget-body  am-fr">
                                      
                                <input type="hidden" id="goods_id" value="{{$good->id}}">
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <tbody>
                                              @foreach($specs as $v)
                                              <tr>
                                               <th ><input class="spec_name" type="" readonly  value="{{$v->name}}" style="width:50px"></th>
                                                    @foreach($v->value as $vals)
                                                        
                                                              <td><label ><input type="radio" class="items_id"  data-items_id='{{$vals->id}}' value="{{$vals->time}}" name="{{$v->id}}">{{$vals->time}}</label></td>                                                 
                                              
                                                  @endforeach
                                            </tr>
                                            @endforeach
                                            <!-- more data -->
                                            <tr>
                                            <td></td>
                                            <td>价格: <input type="number" style="width:100px" id="price"></td>
                                            
                                            <td>库存: <input type="number" style="width:100px" id="store_count"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             
    

      </div>
      <button style="margin-top:100px;margin-left:20px" type="button" class="am-btn am-btn-warning am-round" id="add" onclick="return rad()">提交</button>
      


   </div>
</div>
@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
  

  function rad() {

      var arr = $('input:radio:checked');
       //将数据存进key_name数组中
      // console.dir(arr);
      var key_name = []
        for (var i = 0; i < arr.length; i++) {
          key_name.push($('.spec_name').eq(i).val() + ':' + $(arr).eq(i).val());
        }

       var price = $('#price').val();
       var store_count = $('#store_count').val();
       //字符串拼接
       var keys = '';
       // var id = $('.items_id').data('items_id');
          for(var j = 0; j < arr.length; j++) {
              keys += $(arr).eq(j).data('items_id')+ '_';
          }
       
        var key_id = keys.slice(0, -1);
        var goods_id = $('#goods_id').val();
         
        var key_names = '';
        for(k in key_name ) {
            // console.dir(key_name[k]);
            key_names +=  key_name[k] + ' ';
        }

        // console.dir(goods_id);
        $.ajax({
            type:'post',
            url:'/admin/goodsPrices/add',
            headers:{
                   'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
            dataType: 'json',   
            data:{
               key_id : key_id,
               goods_id : goods_id,
               key_name : key_names,
               price : price,
               store_count : store_count,
            },
            success:function (res) {
                // console.log(132);
                // function myFunction() {
                //           var txt;
                //           if (confirm("添加成功!立即跳到规格列表页")) {
                //             txt = "确定";
                //           } else {
                //             txt = "no！ 我要继续添加";
                //           }
                          
                //         }
               alert('添加成功');
               window.location.href = '/admin/specsItems';
                console.dir(res.msg);
            },
            error:function(err) {
                // console.log(8789);
                alert(err.responseJSON.msg);
            }

        });

  }
</script>
@endsection