@extends('Home/User.index')

@section('title', '我的评价')

@section('css')
    <link href="/Home/Orders/personal.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/my.css" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class='container'>
    <div class="center">
        <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
            </div>
            <hr/>

            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
                @foreach($comminfo as $v)
                    <div class='col-md-12 box'>
                        <div class='col-md-5 biao' style='font-weight:bold;font-size:15px'>评价</div>
                        <div class='col-md-5 biao' style='font-weight:bold;font-size:15px'>商品</div>
                        <div class='col-md-2 biao' style='font-weight:bold;font-size:15px'>单价</div>
                        <div class='col-md-1 imgs' style=''>
                            <a href="/home/item_show/?id={{$v->gid}}"><img style='border:1px solid #e5e4e6' src="/storage/{{ $v->goodImgs->pic }}" width='70px' height='70px'></a>
                        </div>
                        <div class='col-md-5 pjia' style='line-height:22px'>
                            {{ $v->text }}
                        </div>
                        <div class='col-md-5' style='width:330px;line-height:22px'>
                            <a href="/home/item_show/?id={{$v->gid}}">{{ $v->goodsName->name }}</a>
                        </div>
                        <div class='col-md-1'>￥{{ $v->goodsName->price }}</div>
                    </div>
                    <div class='col-md-4 col-md-offset-'>评价时间： {{ $v->created_at }}</div>
                    <div class='col-md-12' style='margin-top:10px;border-top:1px solid #e5e4e6'></div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
    
@section('js')
    <script type="text/javascript">

    </script>
@endsection