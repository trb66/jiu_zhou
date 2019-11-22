@extends('Home/User.index')

@section('title', '我的收藏')

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style type="text/css">
        .texts{
            /*强制文本在同一行显示*/
            white-space:nowrap;
            /*隐藏超出部分*/
            overflow:hidden;
            /*将隐藏的内容用...代替*/
            text-overflow:ellipsis;
        }
    </style>
@endsection

@section('body')
    <div class="user-content__box clearfix bgf">
        <div class="title">订单中心-我的收藏</div>
        <div class="collection-list__area clearfix">
        <div style='height:550px'>
            @foreach($collects as $v)
                <div class="item-card">
                    <a href="/home/item_show/?id={{$v->id}}" class="photo">
                        <img src="/storage/{{$v->img->pic}}" title="{{$v->name}}" class="cover">
                        <div class="name texts">{{$v->name}}</div>
                    </a>
                    <div class="middle">
                        <div class="price"><small>￥</small>{{$v->price}}</div>
                        <div class="sale"><a href="javascript:void(0)" id='quxiao' data-id='{{$v->id}}'>取消收藏</a></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style='float:right'>{{ $collects->links() }}</div>

        
<!--         <div class="page text-right clearfix">
            <a class="disabled">上一页</a>
            <a class="select">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a class="" href="">下一页</a>
            <a class="disabled">1/3页</a>
        </div> -->
    </div>
    </div>
@endsection
    
@section('js')

<script type="text/javascript">
    $('#quxiao').click(function() {
        var id = $(this).data('id');

        $
        console.log(this);
    });
</script>
@endsection