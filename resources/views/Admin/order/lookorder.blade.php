@extends('Admin.index')

@section('title','订单详情')

@section('css')
<style>
	.ncap-order-details{border:solid 1px #2cbca3;position:relative;z-index:1;background-color:#FAFAFA}
	.ncap-order-details .tabs-panels{padding:9px 19px}
	.ncap-order-details .tabs-panels dl{font-size:0;padding-bottom:5px}
	.ncap-order-details .tabs-panels dt,.ncap-order-details .tabs-panels dd{font-size:12px;line-height:20px;display:inline-block;max-width:720px}
	.ncap-order-details .tabs-panels dt{color:#999;width:100px;text-align:right}
	.ncap-order-details .tabs-panels dd{color:#333;min-width:200px}
	.ncap-order-details .misc-info,.ncap-order-details .addr-note,.ncap-order-details .contact-info{padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #E6E6E6}
	.ncap-order-details .total-amount{text-align:right;padding:10px 0}
    .ncap-order-details .total-amount h3{font-size:20px;font-weight:normal;color:black;line-height:24px}
    .ncap-order-details .total-amount h4{color:#999;font-size:12px;font-weight:normal;line-height:20px}
    .subject{ display:inline-block;}
    a.ncap-btn-big{font:bold 14px/20px "microsoft yahei",arial;color:#FFF;background-color:#3b639f;text-align:center;display:inline-block;height:40px;padding:7px 19px;border:solid 1px #BEC3C7;border-radius:3px;cursor:pointer}

     
</style>

@endsection


@section('body')

<div class="row-content am-cf">

<div class="ncap-order-details" style="margin:0 auto;">
      <form id="order-action">
          <input name="order_id" value="1487" type="hidden">
        <div class="tabs-panels">
            <div class="misc-info">
                <h3>基本信息</h3>
                <dl>
                    <dt>订单 ID：</dt>
                    <dd>{{$order['id']}}</dd>
                    <dt>用户昵称：</dt>
                    <dd>{{$order->username->username}}    ID:{{$order->username->id}}</dd>
                    <dt>手机号码：</dt>
                    <dd>{{$order->addr->phone}}</dd>
                </dl>
                <dl>
                    <dt>电子邮箱</dt>
                    <dd>{{$order->uinfo->email}}</dd>
                    <dt>应付金额：</dt>
                    <dd> ￥{{$order['price']}}</dd>
                    <dt>购买数量：</dt>
                    <dd>{{$order['num']}}</dd>
                </dl>
                <dl> 
                    <dt>订单状态：</dt>
                    <dd>{{$status[$order['status']]}}</dd>
                    <dt>下单时间：</dt>
                    <dd>{{$order['created_at']}}</dd>
                    <dt>支付方式：</dt>
                    <dd>其他方式</dd>
                </dl>
            </div>
            <div class="addr-note">
                <h4>收货信息</h4>
                <dl>
                    <dt>收货人：</dt>
                    <dd>{{$order->uinfo->name}}</dd>
                    <dt>联系方式：</dt>
                    <dd>{{$order->uinfo->phone}}</dd>
                </dl>
                <dl>
                    <dt>收货地址：</dt>
                    <dd>{{$order->addr->address}} {{$order->addr->addrinfo}}</dd>
                </dl>
                <dl>
                    <dt>配送方式：</dt>
                    <dd>快递配送</dd>
               </dl>
                <dl>
                    <dt>留言：</dt>
                    <dd>{{$order['message']}}</dd>
                </dl> 
            </div>
      
        <div class="goods-info">
          <h4>商品信息</h4>
      <div class="am-u-sm-12">
        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
            <thead>
                <tr>
                    <th>商品编号</th>
                    <th>商品名</th>
                    <th>商品图片</th>
                    <th>规格</th>
                    <th>数量</th>
                    <th>商品价格</th>
                    <th>商品小计</th>

                </tr>
            </thead>
            <tbody>
                <tr class="gradeX">
                    <td class="am-text-middle">{{$order->goods->id}}</td>
                    <td class="am-text-middle">{{$order->goods->name}}</td>
                    <td>
                        <img src="assets/img/k.jpg" class="tpl-table-line-img" alt="">
                    </td>
                    <td class="am-text-middle">规格规格</td>
                    <td class="am-text-middle">{{$order['num']}}</td>
                    <td>{{$order['price']}}</td>
                    <td class="am-text-middle">{{$order['price']*$order['num']}}</td>
                </tr>
            </tbody>
          </table>
     </div>  
     <div class="total-amount contact-info">
        <h3>订单总额:<span style="color: red">￥{{$order['price']*$order['num']}}</span></h3>
     </div>

  </div> 
 </div>
  </form>
      <div class="subject" style="width:52%;margin:10px 0 0 0;">
           @if($order['status'] == '1' || $order['status'] == '2')
            <a href="/admin/order/alter/?id={{$order['id']}}" style="float:right;margin-right:10px" class="ncap-btn-big ncap-btn-green"><i class="fa fa-pencil-square-o"></i>修改订单</a>
           @endif
            <a href="/admin/order/print/?id={{$order['id']}}" target="_blank" style="float:right;margin-right:10px" class="ncap-btn-big ncap-btn-green"><i class="fa fa-print"></i>打印订单</a>
      </div>
  	</div> 
</div>


@endsection

@section('js')


@endsection