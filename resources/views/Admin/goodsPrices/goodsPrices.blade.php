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
      <button style="margin-top:100px;margin-left:20px" type="button" class="am-btn am-btn-warning am-round" id="add" onclick="rad()">橙色按钮</button>
      


   </div>
</div>
@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
  

  function rad(obj) {
  var arr = $('input:radio:checked');

  // console.dir(arr);
  var key_name = []
    for (var i = 0; i < arr.length; i++) {
      key_name.push($('.spec_name').eq(i).val() + ':' + $(arr).eq(i).val());
    }

   var price = $('#price').val();
   var store_count = $('#store_count').val();

   var keys = '';
   // var id = $('.items_id').data('items_id');
      for(var j = 0; j < arr.length; j++) {
          keys += $(arr).eq(j).data('items_id')+ '_';
      }
   
    var key = keys.slice(0, -1);
    var goods_id = $('#goods_id').val();
     
    var key_names = '';
    for(k in key_name ) {
        console.dir(key_name[k]);
        key_names +=  key_name[k] + ' ';
    }

    
    // $.ajax({
    //     type:'post',
    //     url:'/admin/goodsPrices/add',
    //     headers:{
    //            'X-CSRF-TOKEN' : '{{csrf_token()}}'
    //         },
    //     data:{
    //        key_name = key_name,
    //        price = price,
    //        store_count = store_count,
    //     }
    // })

    
  }
</script>
@endsection