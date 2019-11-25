@extends('Home/index')

@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('type')
@endsection

@section('ss')

<form action="/home/goods/search" method="get" class="input-group">
    <input value="" name="name" placeholder="Ta们都在搜九州网" type="text">
    <span class="input-group-btn">
        <button type="submit">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </button>
    </span>
</form>
@endsection

@section('body')
<div class="content inner">
    <section class="item-show__div clearfix">
        <div class="filter-box">

            @foreach($type->specs_Info as $v)
                <div class="filter-prop-item">
                    <span class="filter-prop-title">{{ $v->name }}</span>
                    <ul class="clearfix">
                        <a href="/home/goods_list/{{ $type->id }}"><li class="active">全部</li></a>
                        @foreach($v->specs_Items_Info as $vv)
                            <a href="javascript:;"><li>{{ $vv->time }}</li></a>
                        @endforeach
                    </ul>
                </div>
            @endforeach

                <div class="filter-prop-item">
                    <span class="filter-prop-title">价格</span>
                    <ul class="clearfix">
                        <a href=""><li class="active">全部</li></a>
                        <form method="get" action="/home/group/{{ $type->id }}" class="price-order">
                            <input value="<?= !empty($_GET['price']) ? $_GET['price'] : '' ?>" name="price" type="text">
                            <span class="cc">--</span>
                            <input value="<?= !empty($_GET['prices']) ? $_GET['prices'] : '' ?>" name="prices" type="text">
                            <input type="submit" value="确定">
                        </form>
                    </ul>
                </div>
            </div>
            <div class="sort-box bgf5">
                <div class="sort-text">排序：</div>
                <a href="/home/goods_list/{{ $type->id }}"><div class="sort-text">综合</div></a>
                <a href="/home/orders/{{ $type->id }}"><div class="sort-text">销量 <i class="iconfont icon-sortDown"></i></div></a>
                <a href="/home/price/{{ $type->id }}"><div class="sort-text">价格 </div></a>
                <div class="sort-total pull-right">共 {{ $count }} 个商品</div>
            </div>
        <div class="pull-left">
            <div class="item-list__area clearfix">
            @foreach($list as $v)
                <div class="item-card">
                    <a href="/home/item_show/?id={{ $v->id }}" class="photo">
                        <img src="/storage/{{ $v->pic }}" alt="" class="cover">
                        <div class="name">{{ $v->name }}</div></a>
                    <div class="middle">
                        <div class="price"><small>￥</small>{{ $v->price }}</div>
                        <div class="sale no-hide"><a href="">满100减20</a></div>
                    </div>
                    <div class="buttom">
                        <div>销量 <b>{{ $v->sales }}</b></div>
                        <div>人气 <b>888</b></div>
                        <div>评论 <b>1688</b></div>
                    </div>
                </div>
            @endforeach
            </div>
            <!-- 分页 -->
            {{ $list->links() }}
        </div>
    </section>
</div>
@endsection