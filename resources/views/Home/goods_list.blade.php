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
        <ol class="breadcrumb">
            <li><a href="/">首页</a></li>
            <li class="active">{{ $type->name }}</li>
        </ol>
        <div class="pull-left">
            <div class="item-list__area clearfix">
            @foreach($list as $v)
                <div class="item-card">
                    <a href="/home/item_show/{{ $v->id }}" class="photo">
                        <img src="/storage/{{ $v->pic }}" alt="" class="cover">
                        <div class="name">{{ $v->name }}</div></a>
                    <div class="middle">
                        <div class="price"><small>￥</small>{{ $v->price }}</div>
                        <div class="sale no-hide"><a href="">满100减20</a></div>
                    </div>
                    <div class="buttom">
                        <div>销量 <b>666</b></div>
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