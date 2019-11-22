@extends('Home/index')

@section('fenlei')
    @foreach($str as $v)
        <div class="cat-box">
            <div class="title">
                <i class="iconfont icon-shoes ce"></i> {{ $v['name'] }}
            </div>
            <ul class="cat-list clearfix">
                <li></li>
            </ul>
            <div class="cat-list__deploy">
                <div class="deploy-box">
                @foreach($v['son'] as $vv)
                    <div class="genre-box clearfix">
                    <span class="title">{{ $vv['name'] }}：</span>
                    @if(!empty($vv['sun']))
                        @foreach($vv['sun'] as $vo)
                            <a style="color:#ccc" href="/home/goods_list/{{ $vo['id'] }}">{{ $vo['name'] }}</a>
                        @endforeach
                    @endif
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('ss')
<form method="get" action="/home/search" class="input-group">
    <input name="name" placeholder="Ta们都在搜九州网" type="text">
    <span class="input-group-btn">
        <button type="submit">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </button>
    </span>
</form>
@endsection


@section('body')
<div class="swiper-container banner-box">
    <div class="swiper-wrapper">
        @foreach($res as $v)
        <div class="swiper-slide"><a href=""><img src="/storage/{{ $v['pic'] }}" class="cover"></a></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
    <!-- 首页楼层导航 -->
<nav class="floor-nav visible-lg-block">
    @foreach($str as $v)
        <span class="scroll-nav active">{{ $v['name'] }}</span>
    @endforeach
</nav>
    <!-- 楼层内容 -->
<div class="content inner" style="margin-bottom: 40px;">
@foreach($str as $v)
    <section class="scroll-floor floor-6">
        <div class="floor-title">
            <i class="iconfont icon-shoes fz16"></i>{{ $v['name'] }}
            @foreach($v['son'] as $vv)
                @foreach($vv['sun'] as $vvv)
            <div class="case-list fz0 pull-right">
                <a href="/home/goods_list/{{ $vvv['id'] }}">{{ $vvv['name'] }}</a>
            </div>
                @endforeach
            @endforeach
        </div>
        <div class="con-box">

            <a class="left-img hot-img" href="">
                <img src="/Home/images/floor_6.jpg" class="cover">
            </a>
            
            <div class="right-box">
        @if(!empty($v['goodtype']))
            @foreach($v['goodtype'] as $vo)
                <a href="/home/item_show/?id={{ $vo->id }}" class="floor-item">
                    <div class="item-img hot-img">
                        <img title="{{ $vo->name }}" src="/storage/{{ $vo->pic }}" alt="{{ $vo->name }}" class="cover">
                    </div>

                    <div class="price clearfix">
                        <span class="pull-left cr fz16">￥{{ $vo->price }}</span>
                        <span class="pull-right c6">进货价</span>
                    </div>
                    <div class="name ep">{{ $vo->name }}</div>
                </a>
            @endforeach
        @endif
            </div>
        </div>
    </section>
@endforeach
</div>
@endsection

@section('bottom')
<div class="footer">
        <div class="footer-tags">
            <div class="tags-box inner">
                <div class="tag-div">
                    <img src="/Home/images/icons/footer_1.gif" alt="厂家直供">
                </div>
                <div class="tag-div">
                    <img src="/Home/images/icons/footer_2.gif" alt="一件代发">
                </div>
                <div class="tag-div">
                    <img src="/Home/images/icons/footer_3.gif" alt="美工活动支持">
                </div>
                <div class="tag-div">
                    <img src="/Home/images/icons/footer_4.gif" alt="信誉认证">
                </div>
            </div>
        </div>
        <div class="footer-links inner">
            <dl>
                <dt>九州网</dt>
                <a href="javascript:;"><dd>企业简介</dd></a>
                <a href="javascript:;"><dd>加入九州</dd></a>
                <a href="javascript:;"><dd>隐私说明</dd></a>
            </dl>
            <dl>
                <dt>服务中心</dt>
                <a href="javascript:;"><dd>售后服务</dd></a>
                <a href="javascript:;"><dd>配送服务</dd></a>
                <a href="javascript:;"><dd>用户协议</dd></a>
                <a href="javascript:;"><dd>常见问题</dd></a>
            </dl>
            <dl>
                <dt>新手上路</dt>
                <a href="javascript:;"><dd>如何成为代理商</dd></a>
                <a href="javascript:;"><dd>代销商上架教程</dd></a>
                <a href="javascript:;"><dd>分销商常见问题</dd></a>
                <a href="javascript:;"><dd>付款账户</dd></a>
            </dl>
        </div>
        <div class="copy-box clearfix">
            <ul class="copy-links">
                <a href="javascript:;"><li>网店代销</li></a>
                <a href="javascript:;"><li>九州商城</li></a>
                <a href="javascript:;"><li>联系我们</li></a>
                <a href="javascript:;"><li>企业简介</li></a>
                <a href="javascript:;"><li>新手上路</li></a>
            </ul>
            <!-- 版权 -->
            <p class="copyright">
                © 2005-2017 九州网 版权所有，并保留所有权利<br>
                ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;友情链接：@foreach($arr as $v)<a href="http://{{ $v['url'] }}" target="_blank">{{ $v['name'] }}</a> | @endforeach&nbsp;&nbsp;&nbsp;&nbsp;Tel: 15577178717&nbsp;&nbsp;&nbsp;&nbsp;E-mail: syznb520@163.com
            </p>
        </div>
    </div>
@endsection
