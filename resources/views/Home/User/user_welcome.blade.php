@extends('Home/User.index')

@section('title', '个人中心')

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="/Home/Orders/admin.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/amazeui.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/personal.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/orstyle.css" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class="pull-right">
    <div class="user-center__info bgf">
        <div class="pull-left clearfix">
            <div class="port b-r50 pull-left">
                <img src="/storage/{{ $user->userinfo->photo }}" onerror="this.src='/Home/images/icons//default_avt.png';" alt="用户名" class="cover b-r50">
                <a href="/home/userinfo" class="edit"><i class="iconfont icon-edit"></i></a>
            </div>
            <br>
            <p class="name text-nowrap">您好，{{ $user->username }}！</p>
            <p class="level text-nowrap">身份：普通会员 </p>
        </div>
        <div class="pull-right user-nav">
            <a href="/home/userorderl" class="user-nav__but">
                <i class="iconfont icon-rmb fz40 cr"></i>
                <div class="c6">待支付 <span class="cr">{{ $countorder[0] }}</span></div>
            </a>
            <a href="/home/userorder" class="user-nav__but">
                <i class="iconfont icon-xiaoxi fz40 cr"></i>
                <div class="c6">待发货 <span class="cr">{{ $countorder[1] }}</span></div>
            </a>
            <a href="/home/userorder" class="user-nav__but">
                <i class="iconfont icon-speed fz40 cr"></i>
                <div class="c6">待收货 <span class="cr">{{ $countorder[2] }}</span></div>
            </a>
            <a href="/home/userorder" class="user-nav__but">
                <i class="iconfont icon-eval fz40 cr"></i>
                <div class="c6">待评价 <span class="c3">{{ $countorder[3] }}</span></div>
            </a>
            <a href="/home/collect" class="user-nav__but">
                <i class="iconfont icon-star fz40 cr"></i>
                <div class="c6">收藏 <span class="c3">{{ $countorder['coll'] }}</span></div>
            </a>
        </div>
    </div>
    <div class="order-list__div bgf">
        <div class="user-title">
            我的订单<span class="c6"></span>
            <span class="c6">（显示最新四条）</span>
            <a href="/home/userorder" class="pull-right">查看所有订单></a>
        </div>
        <div class="center">
        <div class="col-main">
            <div class="user-order">
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
                                        <h1 style='font-size:25px'>暂无最新~</h1>
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
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                @elseif($v->status == 1)
                                                                    <p class="Mystatus">买家已付款</p>
                                                                    <p class="order-info">
                                                                        <a href="orderinfo.html">等待发货</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                @elseif($v->status == 2)
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="order-info">
                                                                        <a href="/home/logistics/?id={{$v->id}}">查看物流</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                @else
                                                                    <p class="order-info">
                                                                        <a href="#">交易完成</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a data-id="{{ $v->id }}" data-toggle="modal" data-target="#myModal" onclick='dels(this)' style='color:black'>删除订单</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
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
                                                                    @if($v->orderComm->isEmpty())
                                                                        <div onclick="location.href = '/home/comments/?id={{$v->id}}'" class="am-btn am-btn-danger anniu">
                                                                            评价商品
                                                                        </div>
                                                                    @else
                                                                        <div class="am-btn am-btn-danger anniu">
                                                                            已评价
                                                                        </div>
                                                                    @endif
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
                                <div class="order-list konorder">
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
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
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
                                <div class="order-list konorder">
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
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
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
                                <div class="order-list konorder">
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
                                                                        <a href="/home/logistics/?id={{$v->id}}">查看物流</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
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
                                <div class="order-list konorder">
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
                                                                    <p class="order-info">
                                                                        <a href="#">交易完成</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a data-id="{{ $v->id }}" data-toggle="modal" data-target="#myModal" onclick='dels(this)' style='color:black'>删除订单</a>
                                                                    </p>
                                                                    <p class="order-info">
                                                                        <a style='color:red' href="/home/orderinfo/?id={{ $v->id }}">订单详情</a>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="td td-change">
                                                                @if($v->orderComm->isEmpty())
                                                                    <div onclick="location.href = '/home/comments/?id={{$v->id}}'" class="am-btn am-btn-danger anniu">
                                                                        评价商品
                                                                    </div>
                                                                @else
                                                                    <div class="am-btn am-btn-danger anniu">
                                                                        已评价
                                                                    </div>
                                                                @endif
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
    <div class="recommends">
        <div class="lace-title type-2">
            <span class="cr">爆款推荐</span>
        </div>
        <div class="swiper-container recommends-swiper">
            <div class="swiper-wrapper">
                @foreach($goods as $v)
                    <div class="swiper-slide">
                        @foreach($v as $vv)
                            <a class="picked-item" onclick='console.log(1213);' href="/home/item_show/?id={{ $vv->id }}">
                                <img src="/storage/{{ $vv->baokuan_img->pic }}" alt="" class="cover">
                                <div class="look_price">¥{{ $vv->price }}</div>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            $(document).ready(function(){
                var recommends = new Swiper('.recommends-swiper', {
                    spaceBetween : 40,
                    autoplay : 5000,
                });
            });
        </script>
    </div>
</div>

@endsection
    
@section('js')
<script src="/Home/Orders/amazeui.js"></script>
<script type="text/javascript">
    var son = $('.konorder');
    son.each(function() {
        if($(this).children().length == 0) {
            $(this).append('<h1 style="font-size:25px">暂无最新~</h1>');
        }
    })
</script>
@endsection