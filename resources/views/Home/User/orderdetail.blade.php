@extends('Home/User.index')

@section('title', '订单详情')

@section('css')

@endsection

@section('body')
<div class="user-content__box clearfix bgf">
    <div class="title">订单中心-订单详情</div>
    <div class="order-info__box">
        <div class="order-addr">收件人：<span class="c6">{{ $order->username }} 　手机号：{{ $order->phone }}</span>
        </div>
        <div class="order-addr">收货地址：<span class="c6">{{ $order->address }}</span>
        </div>
        <div class="order-info">
            订单信息
            <table>
                <tr>
                    <td>订单编号：{{ $order->id }}</td>
                    <td>下单时间：{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <td>订单状态：<span style='color:red'>
                        @if($order->status == '0')
                            待支付
                        @elseif($order->status == '1')
                            待发货
                        @elseif($order->status == '2')
                            待收货
                        @elseif($order->status == '3')
                            待评价
                        @endif
                    </span></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="table-thead">
            <div class="tdf3">商品</div>
            <div class="tdf1">状态</div>
            <div class="tdf1">数量</div>
            <div class="tdf1">单价</div>
            <div class="tdf2">优惠</div>
            <div class="tdf1">总价</div>
            <div class="tdf1">运费</div>
        </div>
        <div class="order-item__list">
            @foreach($order->orderInfo as $v)
                <div class="item">
                    <div class="tdf3">
                        <a href="/home/item_show/?id={{ $v->gid }}"><div class="img"><img src="/storage/{{ $v->goodsImg->pic }}" alt="" class="cover"></div>
                        <div class="ep2 c6">{{ $v->name }}</div></a>
                        <div class="attr ep">{{ $v->specification->key_name }}</div>
                    </div>
                    <div class="tdf1">
                        <a href="">
                            @if($order->status == '0')
                            待支付
                            @elseif($order->status == '1')
                                待发货
                            @elseif($order->status == '2')
                                待收货
                            @elseif($order->status == '3')
                                待评价
                            @endif
                        </a>
                    </div>
                    <div class="tdf1">{{ $v->num }}</div>
                    <div class="tdf1">¥{{ $v->price }}</div>
                    <div class="tdf2">
                        <div class="ep2">暂无~</div>
                    </div>
                    <div class="tdf1">¥{{ $v->price * $v->num }}</div>
                    <div class="tdf1">
                        <div class="ep2">快递<br>¥0.00</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="price-total">
            <div class="fz12 c9">无优惠<br>快递运费 ￥0.0</div>
            <div class="fz18 c6">实付款：<b class="cr">¥{{ $order->total_price }}</b></div>
        </div>
    </div>
</div>
@endsection
    
@section('js')

<script type="text/javascript">
    $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });
    // 取消收藏
    $('.quxiao').click(function() {
        var mys = $(this);

        var id = $(this).data('id');

        $.ajax({
            type: 'post',
            url: '/home/cancelcollection',
            data: {
                id: id,
            },
            success: function(res) {
                mys.parent().parent().parent().remove();
                if ($('#container').children().length <= 0) {
                    location.href = '/home/collect?page=1';
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        });
    });

</script>
@endsection