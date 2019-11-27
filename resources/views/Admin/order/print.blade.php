<!DOCTYPE html>
<html dir="ltr" lang="cn"><head>
    <meta charset="UTF-8">
    <title>配货单打印</title>
    <link href="/Admin/assets/css/orderprint.css" rel="stylesheet" media="all">
    <style media="print" type="text/css">.noprint{display:none}</style>
</head>
<body>
<div class="container">
    <div style="page-break-after: always;">
        <h1 class="text-center">订单信息</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td style="width: 50%;">发送自</td>
                <td style="width: 50%;">订单详情</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><address><strong>九州商城</strong><br>
                    广州市天河区高唐路时代广场E-park</address>
                    <b>电话：</b> {{$order['phone']}}<br>
                    <b>E-Mail：</b>{{$order->uinfo->email}} <br>
                </td>
                <td style="width: 50%;">
                    <b>订单号：</b>
                    @if(is_null($order->express_num))
                        暂无~
                    @else
                       {{$order->express_num->express}}
                    @endif
                    <br> 
                    <b></b><br>                    
                    <b>配送方式：</b>
                    @if(is_null($order->express_num))
                        暂无~
                    @else
                       {{$order->express_num->express_name}}
                    @endif
                    <br><br>
                    <b></b><br>                                 
                    <b>下单日期：</b> {{$order['created_at']}}<br>  
                    <b>用户备注：</b>{{$order['message']}}<br>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td colspan="4"><b>收货信息</b></td>
            </tr>
            <tr>
                <td>收件人</td>
                <td>联系电话</td>
                <td>收货地址</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$order['username']}}</td>
                <td>{{$order['phone']}}</td>
                <td>{{$order['address']}}</td>
       
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td><b>商品名称</b></td>
                <td><b>规格属性</b></td>
                <td><b>数量</b></td>
                <td><b>单价</b></td>
                <td class="text-right"><b>小计</b></td>
               
            </tr>
            </thead>
            <tbody>
                @foreach($detail as $v)
                 <tr>
                    <td>{{$v['name']}}</td>
                    <td>{{$v->order_spec->key_name}}</td>
                    <td>{{$v['num']}}</td>
                    <td>{{$v['price']}}</td>
                    <td class="text-right">{{$v['price']*$v['num']}}</td>
                </tr>
               @endforeach
            </tbody>
            <tfoot>
            <tr><td colspan="5" class="text-center"><input class="btn btn-default noprint" type="submit" onclick="window.print();" value="打印" style="border:1px solid black"></td></tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>