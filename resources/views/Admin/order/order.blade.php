@extends('Admin.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@endsection

@section('title','订单列表')

@section('body')
<div class="row-content am-cf">
<div class="row">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title  am-cf">订单列表</div>
    
        </div>
        <div class="widget-body  am-fr">

            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                <div class="am-form-group">
                </div>
            </div>
    
            <form>
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                <div class="am-form-group tpl-table-list-select">
                    <select data-am-selected="{btnSize: 'sm'}"  name="order_status">
                        <option {{ session('status') == 69 ? 'selected' : '' }}  value="69">订单状态</option>
                        <option {{ session('status') == '0' ? 'selected' : '' }} value="0">未支付</option>
                        <option {{ session('status') == 1 ? 'selected' : '' }} value="1">已支付</option>
                        <option {{ session('status') == 2 ? 'selected' : '' }} value="2">待发货</option>
                        <option {{ session('status') == 3 ? 'selected' : '' }} value="3">待收货</option>
                        <option {{ session('status') == 4 ? 'selected' : '' }} value="4">已完成</option>
                   </select>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">

                    <input type="text" class="am-form-field" value="{{session('text')}}" name="order_search" id="oo">

                    <span class="am-input-group-btn">
                      <button id="sea" type='button' class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search"></button>
                    </span>
                </div>
            </div>
            </form>
            <div class="am-u-sm-12">
                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                    <thead>
                        <tr>
                            <th>订单序号</th>
                            <th>收货人名字</th>
                            <th>手机号</th>
                            <th>收货地址</th>
                            <th>总金额</th>
                            <th>用户留言</th>
                            <th>订单状态</th>
                            <th>下单时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                   	@foreach($orders as $o)                                      
                        <tr class="gradeX">
                            <td>{{$o['id']}}</td>
                            <td>{{$o['username']}}</td>
                            <td>{{$o['phone']}}</td>
                            <td>{{$o['address']}}</td>
                            <td>{{$o['total_price']}}</td>
                            <td>{{$o['message']}}</td>   

                            @if($o['status'] ==  0)
                            <td style="color: red;">{{$status[$o['status']]}}</td>
                            @elseif($o['status'] == 1)
                            <td style="color: orange;">{{$status[$o['status']]}}</td>
                            @elseif($o['status'] == 2)
                            <td style="color: #009ACD;">{{$status[$o['status']]}}</td>
                            @elseif($o['status'] == 3)
                            <td style="color: #551A8B;">{{$status[$o['status']]}}</td>
                            @else
                            <td style="color: green;">{{$status[$o['status']]}}</td>
                            @endif

                            <td>{{$o['created_at']}}</td>
                            <td>
                                <input type="hidden" name="status" value="{{$o['status']}}">
                                <div class="tpl-table-black-operation">
                                     <a href="/admin/order/lookorder/?id={{$o['id']}}" >
                                        <i class="am-icon-lemon-o"></i>查看
                                    </a>
                                    @if($o['status'] == 1 or $o['status'] == 2)
                                      <a href="javascript:;" style="border:1px solid orange;color: orange" class="tpl-table-black-operation" data-id="{{$o['id']}}" onclick="return fahuo(this)">
                                         <i class="am-icon-hospital-o"></i>发货
                                    </a>
                                    @endif
                                    <a href="javascript:;" class="tpl-table-black-operation-del dell" data-id="{{$o['id']}}" onclick="return del(this)">
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
            {{ $orders->links() }}
        
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('js')
<script src="/Admin/assets/js/jquery.min.js"></script>
<script>
      // 搜索
      $('#sea').click(function(){

        var status = $('select[name=order_status]').val();
        var text = $('#oo').val();
        console.dir(text)
        console.dir(status)
        
        if (status == '69' && text == '') location.href = '/admin/order/?status='+ status+'&text='+text;
        if (status == '69' && text != '') location.href = '/admin/order/?text='+ text+'&status='+status;
        if(status != '69' &&  text != '' ) location.href = '/admin/order/?status='+ status+'&text='+text;      
        if (status != '69' && text == '') location.href = '/admin/order/?status='+ status+'&text='+text;
      })
     
      function del(ord) {
        var id = $(ord).data();
        var ojd = $(ord).parent().parent().parent();
        var isbeauty=confirm("确认删除这个订单吗？");

        if (isbeauty) {

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
            $.ajax({
                type: 'post',
                url: '/admin/order/del',
                data: {
                   id : id,
                },
                success: function(res) { 
                if (res.code == 0) {
                         ojd.remove()
                  }     
                },
                error: function (err) {
                    alert(err.responseJSON.msg);
                }
            })
        }
    }

    function fahuo(sta) {
     var id = $(sta).data()
     $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });

          $.ajax({
            type: 'post',
            url: '/admin/order/fahuo',
            data: {
               id : id,

            },
            success: function(res) { 

             location.href = '/admin/order';   
               
            },
            error: function (err) {
                alert(err.responseJSON.msg);    
            
            }
        })
    }

  
</script>
@endsection



