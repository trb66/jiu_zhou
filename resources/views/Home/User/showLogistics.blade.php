@extends('Home/User.index')

@section('title', '我的订单')

@section('css')
    <link href="/Home/Orders/admin.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/Home/Orders/personal.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/lostyle.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/dizhi.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .container{
            background:white;
            width:950px;
            height:2000px;
        }
    </style>
@endsection

@section('body')
<div class='container' >
    <!--标题 -->
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">物流跟踪</strong> / <small>Logistics&nbsp;History</small></div>
    </div>
    <hr>
    <div style='height:150px;margin-left:50px'>
        <div class="item-pic">
            <img src="/Home/images/icons//default_avt.png" class="itempic J_ItemImg">
        </div>

        <div class="item-info" style='margin-top:25px'>
            <p class="log-status">物流状态:<span>{{ $express_info['deliverystatus'] }}</span> </p>
            <p>承运公司：{{ $express_info['expName'] }}</p>
            <p>快递单号：{{ $express_info['number'] }}</p>
            <p>官方电话：<a style='color:#00E' href="tel:{{ $express_info['expPhone'] }}">{{ $express_info['expPhone'] }}</a></p>
        </div>
    </div>

    <div data-mohe-type="kuaidi_new" class="g-mohe " id="mohe-kuaidi_new">
        <div id="mohe-kuaidi_new_nucom">
            <div class="mohe-wrap mh-wrap">
                <div class="mh-cont mh-list-wrap mh-unfold">
                    <div class="mh-list">
                        <ul id='test'>
                            @foreach($express_info['list'] as $v)
                                <li>
                                    <p>{{ $v->time }}</p>
                                    <p>{{ $v->status }}</p>
                                    <span class="before"></span><span class="after"></span>
                                </li>
                            @endforeach
                            <li>
                                <br>
                                <p>商家正通知快递公司揽件</p>
                                <span class="before"></span><span class="after"></span>
                            </li>
                            <li>
                                <br>
                                <p>您的包裹已出库</p>
                                <span class="before"></span><span class="after"></span>
                            </li>
                            <li>
                                <br>
                                <p>您的订单待配货</p>
                                <span class="before"></span><span class="after"></span>
                            </li>
                            <li>
                                <br>
                                <p>您的订单开始处理</p>
                                <span class="before"></span><span class="after"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('js')
    <script type="text/javascript">
        $('#test li:first').addClass('first');

        $('#test li:first').append('<i class="mh-icon mh-icon-new"></i>');

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });

        $.ajax({
            type: 'post',
            url: '/home/addcomments',
            data: {
                id: uid,
                comments: comments,
            },
            success: function(res) {
                $('#hhh').css('display', 'none');
                $('#tips').css('display', 'block');
                var time = 3;
                var timer;
                timer = window.setInterval(function(){
                    $('#sec').html(time--);
                    if (time < 0) {
                        window.location.href = '/home/userorder';
                        clearInterval(timer);
                    }
                }, 1000);
            },
            error: function(err) {
                console.dir(err);
            }
        }); 
    </script>
@endsection