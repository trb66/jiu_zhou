@extends('Home/User.index')

@section('title', '我的订单')

@section('css')
    <link href="/Home/Orders/admin.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/Home/Orders/personal.css" rel="stylesheet" type="text/css">
    <link href="/Home/Orders/appstyle.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .container{
            background:white;
            width:950px;
        }
    </style>
@endsection

@section('body')
<div class='container' id='tips' style='display:none'>
    <div class="modify-success__box text-center">
            <div class="icon b-r50"><i class="iconfont icon-checked cf fz24"></i></div>
            <div class="text c6">评价成功！</div>
            <a href="/home/userorder" class="btn"><span id="sec">3</span> 秒后跳转至订单页, 如果浏览器未跳转请点击这里</a>
    </div>
</div>


<div class='container' id='hhh'>
    <div class="center">
        <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong style='cursor:pointer' onclick='location.href="/home/userorder"' class="am-text-danger am-text-lg">订单管理</strong> / <small>发表评论</small></div>
            </div>
            <hr/>
            <!-- 用户ID -->
            <div data-id='{{$order->uid}}' class='uid'></div>
            <div class="comment-main">
                @foreach($order->orderInfo as $v)
                    <div class="comment-list">
                        <div class="item-pic">
                            <a href="#" class="J_MakePoint">
                                <img src="/storage/{{$v->goodsImg->pic}}" class="itempic">
                            </a>
                        </div>

                        <div class="item-title">
                            <div class="item-name">
                                <a href="#" title='{{$v->name}}'>
                                    <p class="item-basic-info">{{ $v->name }}</p>
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="info-little">
                                    <span></span>
                                </div>
                                <div class="item-price">
                                    单价：<strong>{{ $v->price }}</strong>
                                    <br>
                                    数量　×　<strong>{{ $v->num }}</strong>
                                </div>                                      
                            </div>
                        </div>
                        <!-- 商品ID -->
                        <div data-id='{{$v->gid}}' class='goodsId'></div>
                        <div class="clear"></div>
                        <div class="item-comment">
                            <textarea class='liuyan' maxlength=80  style='border:1px #dcdddd solid;margin-top:20px' placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
                        </div>
                   
                        <div class="item-opinion">
                            <li><i class="op1 active"></i>好评</li>
                            <li><i class="op2"></i>中评</li>
                            <li><i class="op3"></i>差评</li>
                        </div>
                    </div>
                @endforeach
                         
                    <div class="info-btn">
                        <div class="am-btn am-btn-danger" onclick='addcomment()'>发表评论</div>
                    </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".comment-list .item-opinion li").click(function() {  
                            $(this).prevAll().children('i').removeClass("active");
                            $(this).nextAll().children('i').removeClass("active");
                            $(this).children('i').addClass("active");
                            
                        });
                 })
                </script>                   
            </div>
        </div>
    </div>
    <!-- 提示 -->

</div>
@endsection
    
@section('js')
    <script type="text/javascript">

        function addcomment()
        {
            // // JSON.stringify
            var comments = {};

            var uid = $('.uid').data('id'); // 用户ID

            var allcomment = $('.liuyan'); // 评价

            var goodsId = $('.goodsId'); // 商品ID

            goodsId.each(function(k, val) {
                comments[k] = $(val).data('id');
            })

            var s = '';

            allcomment.each(function(k, val) {
                if($(val).val() == '')  s = 1;
                comments[k] = comments[k]+ '-' +$(val).val();
            })

            if(s == 1) {
                alert('评论不能留空哦~');
                return false;
            }

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
        }
    </script>
@endsection