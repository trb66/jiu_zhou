@extends('Home/User.index')

@section('title', '我的订单')

@section('css')
    <link href="/Home/Orders/admin.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/amazeui.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/personal.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/orstyle.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #container{
            background:white;
            margin-top:-15px;
        }
    </style>
@endsection

@section('body')


<div id='container'>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">删除订单</h4>
      </div>
      <div class="modal-body">
        您确定要删除订单吗？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id='gb' data-dismiss="modal">关 闭</button>
        <button type="button" class="btn btn-primary" id='ok'>确 定</button>
      </div>
    </div>
  </div>
</div>
    <div class="center">
        <div class="col-main">
            <div class="user-order">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf">
                        <strong class="am-text-danger am-text-lg">订单中心</strong> / <small>订单管理</small>
                    </div>
                </div>
                <hr/>
                <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
                    <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">所有订单</a></li>
                        <li><a href="#tab2">待付款</a></li>
                        <li><a href="#tab3">待发货</a></li>
                        <li><a href="#tab4">待收货</a></li>
                        <li><a href="#tab5">待评价</a></li>
                    </ul>

                    <div class="am-tabs-bd">

                        <!-- 所有订单 -->
                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">
                                    @if($orders->isEmpty()) 
                                        <h1 style='font-size:25px'>暂无订单~</h1>
                                    @else
                                        @foreach($orders as $v)
                                            <!--不同状态订单-->
                                            <div class="order-status3">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{ $v->id }}</a></div>
                                                    <span>成交时间：{{ $v->created_at }}</span>
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">

                                                    @foreach($v->orderInfo as $vv)
                                                        <!-- 商品 -->
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="/home/item_show/?id={{ $vv->gid }}" class="J_MakePoint">
                                                                        <img src="/storage/{{ $vv->goodsImg->pic }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $vv->name }}</p>
                                                                            <br>
                                                                            <p class="info-little">
                                                                                {{$vv->specification->key_name}}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{ $vv->price }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number" style='margin-top:23px'>
                                                                <div class="item-number">
                                                                    <span>×</span>{{ $vv->num }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    <a href="refund.html">退款/退货</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- 商品结束 -->
                                                    @endforeach
                                                        

                                                    </div>
                                                    <div class="order-right">

                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <h1 style='font-size:16px'>￥ {{ $v->total_price }}</h1>
                                                                <h1>运费： ￥0</h1>
                                                            </li>
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                @if($v->status == 0)
                                                                    <br>
                                                                    <p class="Mystatus">等待买家付款</p>
                                                                    <p class="order-info">
                                                                        <a onclick='cancel(this)' data-id='{{ $v->id }}' style='color:red'>取消订单</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                @elseif($v->status == 1)
                                                                    <p class="Mystatus">买家已付款</p>
                                                                    <p class="order-info">
                                                                        <a href="orderinfo.html">等待发货</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                @elseif($v->status == 2)
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/logistics/?id={{$v->id}}">查看物流</a>
                                                                    </p>
                                                                @else
                                                                    <br>
                                                                    <p class="order-info">
                                                                        <a href="#">交易完成</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a data-id="{{ $v->id }}" data-toggle="modal" data-target="#myModal" onclick='dels(this)' style='color:red'>删除订单</a>
                                                                    </p>
                                                                @endif
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                @if($v->status == 0)
                                                                    <div class="am-btn am-btn-danger anniu">
                                                                        一键支付
                                                                    </div>
                                                                @elseif($v->status == 1)
                                                                    <div class="tips am-btn am-btn-danger anniu">
                                                                        提醒发货
                                                                    </div>
                                                                @elseif($v->status == 2)
                                                                    <div class="am-btn am-btn-danger anniu">
                                                                        确认收货
                                                                    </div>
                                                                @else
                                                                    <div onclick="location.href = '/home/comments/?id={{$v->id}}'" class="am-btn am-btn-danger anniu">
                                                                        评价商品
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 订单 -->
                                        @endforeach
                                    @endif     
                                </div>


                            </div>

                        </div>

                        <!-- 待付款 -->
                        <div class="am-tab-panel am-fade" id="tab2">

                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">
                                    @foreach($orders as $v)
                                        @if($v->status == 0)
                                            <!--不同状态订单-->
                                            <div class="order-status3">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{ $v->id }}</a></div>
                                                    <span>成交时间：{{ $v->created_at }}</span>
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">

                                                    @foreach($v->orderInfo as $vv)
                                                        <!-- 商品 -->
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="/home/item_show/?id={{ $vv->gid }}" class="J_MakePoint">
                                                                        <img src="/storage/{{ $vv->goodsImg->pic }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $vv->name }}</p>
                                                                            <br>
                                                                            <p class="info-little">
                                                                                {{$vv->specification->key_name}}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{ $vv->price }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number" style='margin-top:23px'>
                                                                <div class="item-number">
                                                                    <span>×</span>{{ $vv->num }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    <a href="refund.html">退款/退货</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- 商品结束 -->
                                                    @endforeach
                                                        

                                                    </div>
                                                    <div class="order-right">

                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <h1 style='font-size:16px'>￥ {{ $v->total_price }}</h1>
                                                                <h1>运费： ￥0</h1>
                                                            </li>
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <br>
                                                                    <p class="Mystatus">等待买家付款</p>
                                                                    <p class="order-info">
                                                                        <a  onclick='cancel(this)' data-id='{{ $v->id }}' style='color:red'>取消订单</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                    <div class="am-btn am-btn-danger anniu">
                                                                        一键支付
                                                                    </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 订单 -->
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- 待发货 -->
                        <div class="am-tab-panel am-fade" id="tab3">
                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">
                                    @foreach($orders as $v)
                                        @if($v->status == 1)
                                            <!--不同状态订单-->
                                            <div class="order-status3">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{ $v->id }}</a></div>
                                                    <span>成交时间：{{ $v->created_at }}</span>
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">

                                                    @foreach($v->orderInfo as $vv)
                                                        <!-- 商品 -->
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="/home/item_show/?id={{ $vv->gid }}" class="J_MakePoint">
                                                                        <img src="/storage/{{ $vv->goodsImg->pic }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $vv->name }}</p>
                                                                            <br>
                                                                            <p class="info-little">
                                                                                {{$vv->specification->key_name}}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{ $vv->price }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number" style='margin-top:23px'>
                                                                <div class="item-number">
                                                                    <span>×</span>{{ $vv->num }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    <a href="refund.html">退款/退货</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- 商品结束 -->
                                                    @endforeach
                                                        

                                                    </div>
                                                    <div class="order-right">

                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <h1 style='font-size:16px'>￥ {{ $v->total_price }}</h1>
                                                                <h1>运费： ￥0</h1>
                                                            </li>
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">买家已付款</p>
                                                                    <p class="order-info">
                                                                        <a href="orderinfo.html">等待发货</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                    <div class="tips am-btn am-btn-danger anniu">
                                                                        提醒发货
                                                                    </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 订单 -->
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- 待收货 -->
                        <div class="am-tab-panel am-fade" id="tab4">
                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">
                                     @foreach($orders as $v)
                                        @if($v->status == 2)
                                            <!--不同状态订单-->
                                            <div class="order-status3">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{ $v->id }}</a></div>
                                                    <span>成交时间：{{ $v->created_at }}</span>
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">

                                                    @foreach($v->orderInfo as $vv)
                                                        <!-- 商品 -->
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="/home/item_show/?id={{ $vv->gid }}" class="J_MakePoint">
                                                                        <img src="/storage/{{ $vv->goodsImg->pic }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $vv->name }}</p>
                                                                            <br>
                                                                            <p class="info-little">
                                                                                {{$vv->specification->key_name}}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{ $vv->price }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number" style='margin-top:23px'>
                                                                <div class="item-number">
                                                                    <span>×</span>{{ $vv->num }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    <a href="refund.html">退款/退货</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- 商品结束 -->
                                                    @endforeach
                                                        

                                                    </div>
                                                    <div class="order-right">

                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <h1 style='font-size:16px'>￥ {{ $v->total_price }}</h1>
                                                                <h1>运费： ￥0</h1>
                                                            </li>
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info">
                                                                        <a href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="/home/logistics/?id={{$v->id}}">查看物流</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a href="#">延长收货</a>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                    <div class="am-btn am-btn-danger anniu">
                                                                        确认收货
                                                                    </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 订单 -->
                                        @endif
                                    @endforeach 
                                </div>
                            </div>
                        </div>


                        <!-- 待评价 -->
                        <div class="am-tab-panel am-fade" id="tab5">
                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">
                                    @foreach($orders as $v)
                                        @if($v->status == 3)
                                            <!--不同状态订单-->
                                            <div class="order-status3">
                                                <div class="order-title">
                                                    <div class="dd-num">订单编号：<a href="javascript:;">{{ $v->id }}</a></div>
                                                    <span>成交时间：{{ $v->created_at }}</span>
                                                </div>
                                                <div class="order-content">
                                                    <div class="order-left">

                                                    @foreach($v->orderInfo as $vv)
                                                        <!-- 商品 -->
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="/home/item_show/?id={{ $vv->gid }}" class="J_MakePoint">
                                                                        <img src="/storage/{{ $vv->goodsImg->pic }}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{ $vv->name }}</p>
                                                                            <br>
                                                                            <p class="info-little">
                                                                                {{$vv->specification->key_name}}
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{ $vv->price }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number" style='margin-top:23px'>
                                                                <div class="item-number">
                                                                    <span>×</span>{{ $vv->num }}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    <a href="refund.html">退款/退货</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- 商品结束 -->
                                                    @endforeach
                                                        

                                                    </div>
                                                    <div class="order-right">

                                                        <div class="move-right">
                                                            <li class="td td-status">
                                                                <h1 style='font-size:16px'>￥ {{ $v->total_price }}</h1>
                                                                <h1>运费： ￥0</h1>
                                                            </li>
                                                            <li class="td td-status">
                                                                <div class="item-status">
                                                                    <br>
                                                                    <p class="order-info">
                                                                        <a href="#">交易完成</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a data-id="{{ $v->id }}" data-toggle="modal" data-target="#myModal" onclick='dels(this)' style='color:red'>删除订单</a>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                    <div onclick="location.href = '/home/comments/?id={{$v->id}}'" class="am-btn am-btn-danger anniu">
                                                                        评价商品
                                                                    </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 订单 -->
                                        @endif
                                    @endforeach 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('js')
    <script src="/Home/Orders/amazeui.js"></script>
    <script type="text/javascript">
        $('.tips').click(function () {
            alert('卖家已收到您的留言，正在为您积极备货呢~');
        })        
        var id;
        var me;
        function dels(mys) {
            id = $(mys).data('id');
            me = mys;
        }

        $('#ok').click(function() {
            $('#gb').click(); // 关闭模态框

            // 发起ajax请求
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/delorder',
                data: {
                    id: id,
                },
                success: function(res) {
                    $(me).parent().parent().parent().parent().parent().parent().parent().remove();
                },
                error: function(err) {
                    alert('网络错误，请重试');
                }
            });
        })

        // 取消订单
        function cancel(mys)
        {
            var s = window.confirm("你确定要取消订单吗？");

            if(s) {
                var oid = $(mys).data('id'); // 订单ID
                // 发起ajax请求
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $.ajax({
                    type: 'post',
                    url: '/home/cancelorder',
                    data: {
                        oid: oid,
                    },
                    success: function(res) {
                        $(mys).parent().parent().parent().parent().parent().parent().parent().remove();
                    },
                    error: function(err) {
                        alert('网络错误，请重试');
                    }
                });

            }

        }

    </script>
@endsection