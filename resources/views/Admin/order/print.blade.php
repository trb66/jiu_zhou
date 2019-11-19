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
                <td><address><strong>九州商城</strong><br>广州市天河区高唐路时代广场E-park</address>
                    <b>电话：</b> {{$order->addr->phone}}<br>
                    <b>E-Mail：</b>{{$order->uinfo->email}} <br>
                 
                </td>
                <td style="width: 50%;">
                    <b>下单日期：</b> {{$order['created_at']}}<br>               
                    <b></b><br>                    
                    <b>配送方式：</b> 快递配送<br><br>
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
                <td>{{$order->uinfo->name}}</td>
                <td>{{$order->uinfo->phone}}</td>
                <td>{{$order->addr->address}}&nbsp;{{$order->addr->addrinfo}}</td>
       
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td><b>商品名称</b></td>
                <td><b>状态</b></td>
                <td><b>规格属性</b></td>
                <td><b>数量</b></td>
                <td><b>单价</b></td>
                <td class="text-right"><b>小计</b></td>
            </tr>
            </thead>
            <tbody>
                 <tr>
                    <td>{{$order['name']}}</td>
                    <td>{{$status[$order['status']]}}</td>
                    <td>规格规格规格规格</td>
                    <td>{{$order['num']}}</td>
                    <td>{{$order['price']}}</td>
                    <td class="text-right">{{$order['price']*$order['num']}}</td>
                </tr>
               
            </tbody>
            <tfoot>
            <tr><td colspan="5" class="text-center"><input class="btn btn-default noprint" type="submit" onclick="window.print();" value="打印" style="border:1px solid black"></td></tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>