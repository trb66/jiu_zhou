@extends('Home.index')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">

@section('seek')
@endsection
@section('nav')
@endsection

@section('body')
    <div class="content clearfix bgf5">
        <section class="user-center inner clearfix">
            <div class="user-content__box clearfix bgf">
                <div class="title">购物车-确认支付 </div>
                <div class="shop-title">收货地址</div>
                <form action="" class="shopcart-form__box">
                    <div class="addr-radio">
                
                    @foreach($addrs as $v)
                     @if($v->acquiescent == 1)
                        <div class="radio-line radio-box active">
                            <label class="radio-label ep" title=" {{$v->address.$v->addrinfo.' '.'('.$v->username.' '.'收)'.' '. $v->phone}}">
                                <input name="addr" checked="" value="0" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
                                  {{$v->address.$v->addrinfo.' '.'('.$v->username.' '.'收)'.' '. $v->phone}}
                            </label>
                            <a href="javascript:;" class="default" data-id="{{$v->id}}" data-acquiescent="{{$v->acquiescent}}">{{$v-> acquiescent== 1 ? '默认地址':'设为默认地址' }}</a>
                            <a href="/home/editaddress?id={{$v->id}}" class="edit">修改</a>
                        </div>
                     @else
                        <div class="radio-line radio-box">
                            <label class="radio-label ep" title="{{$v->address.$v->addrinfo.' '.'('.$v->username.' '.'收)'.' '. $v->phone}}">
                                <input name="addr" value="2" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
                                 {{$v->address.$v->addrinfo.' '.'('.$v->username.' '.'收)'.' '. $v->phone}}
                            </label>
                            <a href="" class="default" data-id="{{$v->id}}" data-acquiescent="{{$v->acquiescent}}">{{$v->acquiescent == 1 ? '默认地址':'设为默认地址' }}</a>
                            <a href="/home/editaddress?id={{$v->id}}" class="edit">修改</a>
                        </div>
                     @endif
                    @endforeach
                        
                        
                    </div>
                    <div class="add_addr"><a href="/home/useraddress">添加新地址</a></div>
                    <div class="shop-order__detail">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="120"></th>
                                    <th width="300">商品信息</th>
                                    <th width="170">单价</th>
                                    <th width="200">数量</th>
                                    <th width="100"></th>
                                    <th width="170">总价</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                             @foreach($cars as $v)  
                                <tr>
                                    <th scope="row" ><a href="item_show.html"><div class="img"><img style='width:140px;height:140px;' src="/storage/{{ $v->prices->goods_name->goods_img->pic }}" alt="" class="cover"></div></a></th>
                                    <td>
                                        <div class="name ep3">{{ $v->prices->goods_name->name }}</div>
                                        <div class="type c9">规格：{{$v->prices->key_name}}</div>
                                    </td>
                                    <td>¥{{$v->prices->price}}</td>
                                    <td>{{$v->commod}}</td>
                                    <td></td>
                                    <td class="price">¥{{$v->prices->price * $v->commod}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="shop-cart__info clearfix">
                     
                        <div class="pull-right text-right">
                        
                            <div class="info-line">合计：<b class="fz18 cr crr">¥0</b></div>
                        </div>
                    </div>
                    <div class="user-form-group shopcart-submit">
                        <button type="submit" class="btn">继续支付</button>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $(this).on('change','input',function() {
                                $(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
                         
                            })
                        });
                    </script>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('shopcart')
<div class="right-nav">
        <ul class="r-with-gotop">
            <li class="r-toolbar-item">
                <a href="/home/user_welcome" class="r-item-hd">

                    <i class="iconfont icon-user"></i>
                    <div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="/home/udai_shopcart" class="r-item-hd">
                    <i class="iconfont icon-cart" data-badge="{{$numm}}"></i>
                    <div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="" class="r-item-hd">
                    <i class="iconfont icon-aixin"></i>
                    <div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="" class="r-item-hd">
                    <i class="iconfont icon-liaotian"></i>
                    <div class="r-tip__box"><span class="r-tip-text">联系客服</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="issues.html" class="r-item-hd">
                    <i class="iconfont icon-liuyan"></i>
                    <div class="r-tip__box"><span class="r-tip-text">留言反馈</span></div>
                </a>
            </li>
            <li class="r-toolbar-item to-top">
                <i class="iconfont icon-top"></i>
                <div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
            </li>
        </ul>
    </div>
 
@endsection

@section('js')

<script src="/Home/js/jquery.1.12.4.min.js">

</script>
<script>

   var price = $('.price');
    var sum = 0
   for (var i = 0; i < price.length; i++) {
        
       sum += Number($(price[i]).text().substring(1))
   }  
   $('.crr').html(sum);
$('.default').click(function() {
    if($(this).data('acquiescent') == 2) {
        var id = $(this).data('id')
        $.ajax({
            type: 'post',
            url: '/home/addrs_sta',
            headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
            data: {
                id: id,
            },
            success: function(res) {
                if(res) {
                    location.href = '/home/shopcar_pay';
                }
            },
            error: function(err) {
            }
        });
    return false;
    }
    return false;
})

$('.btn').click(function() {
    //地址
    var addrsID =  $('.default').data('id');

    $.ajax({
        type:'post',
        url: '/home/pay',
        headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
        data: {
            id : addrsID,
            sum : sum
            },
        success: function(res) {
            console.dir(res)
        },
        error: function(err) {
            console.dir(err)
        },

    });
    return false;
    
})

</script>
@endsection
