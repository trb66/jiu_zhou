@extends('Home.index')

@section('title',$good['name'])

@section('css')
<style>
	#collect:hover{
       color: #b31e22;
	}
	.ceshi{

	}
</style>
@endsection

@section('type')

@endsection

@section('body')

<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
				<ol class="breadcrumb">
					<li><a href="/">首页</a></li>
					<li><a href="/home/goods_list/{{ $type['id'] }}" class="typeid" data-typeid="{{ $type['id'] }}">{{$type['name']}}</a></li>
					<li class="active">{{$good['name']}}</li>
				</ol>
				<div class="item-pic__box" id="magnifier">
					<div class="small-box">
                   
						<img class="cover" src="/storage/{{$pre[count($pre) - 1]->pic}}" alt="{{$good['name']}}">
						<span class="hover"></span>
                       
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix" id='test'>
                               @foreach($pre as $ki => $img)

								<li class="item" data-src="/storage/{{$img['pic']}}"><img class="cover" src="/storage/{{$img['pic']}}" alt="商品预览图"></li>
                               @endforeach

							</ul>
						</div>
						<a href="javascript:;" class="btn btn-default btn-next"></a>
					</div>
                    @foreach($pre as $img)
					<div class="big-box"><img src="/storage/{{$img['pic']}}" alt="{{$good['name']}}"></div>
                    @endforeach

				</div>
				<script src="/Home/js/jquery.magnifier.js"></script>
				<script>
					$(function () {
						$('#magnifier').magnifier();
					});
				</script>
				<div class="item-info__box">
					<div class="item-title">
						<div class="name ep2">{{$good['name']}}</div>
						<div class="sale cr">优惠活动：该商品享受8折优惠</div>
					</div>
					<div class="item-price bgf5">
						<div class="w clearfix">
							<div class="price-panel pull-left">
								售价：<span class="price jiage">￥{{$good['price']}}</span> <s class="fz16 c9 jiages">￥{{$good['price'] / 0.8 }}</s>
							</div>
                              <spn id="collect" onclick="collect(this)" data-id="{{$good['id']}}" style="float: right;font-size: 20px;font-weight: 700;vertical-align: middle;margin-top: 5px;position: relative;" aria-hidden="true" class="glyphicon glyphicon glyphicon-star"><b style="font-size: 15px; cursor: pointer;">收藏宝贝</b></span>
                              </a>
						</div>
					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<span class="ind-label c9">累计销量</span>
							<span class="ind-count cr">{{$good['sales']}}</span>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr">{{$count}}</span></a>
						</li>
					</ul>
					<div class="item-key">
						<div class="item-sku">
						   @foreach ($spec as $v)
                             
							<dl class="item-prop clearfix gui" data-spec_id="{{$v['id']}}" data-goods_id="{{$good['id']}}">
								<dt class="item-metatit">{{$v['name']}}：</dt>
								<dd>
								   <ul data-property="" data-name='{{ $v["name"] }}' class="clearfix test">
									@foreach($v['time'] as $vo)
									<li data-name="{{$v['name']}}" data-value="{{ $vo }}">
										<a role="button" aria-disabled="true">
										  <span >{{ $vo }}</span>
									    </a>
								    </li>

									@endforeach
								    </ul>
							    </dd>
							</dl>
							@endforeach                       
						</div>
					   
						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="amount-box">
								<div class="amount-widget">
									<input class="amount-input" value="1" id="num" maxlength="8" title="请输入购买量" type="text">
									<div class="amount-btn">
										<a class="amount-but add"></a>
										<a class="amount-but sub"></a>
									</div>
								</div>
								<div class="item-stock"><span style="margin-left: 10px;">库存 <b id="Stock">{{$ku}}</b> 件</span></div>
								<script>
									$(function () {
										$('.amount-input').onlyReg({reg: /[^0-9]/g});
										var stock = parseInt($('#Stock').html());
										$('.amount-widget').on('click','.amount-but',function() {
											var num = parseInt($('.amount-input').val());
											if (!num) num = 0;
											if ($(this).hasClass('add')) {
												if (num > stock - 1){
													return DJMask.open({
													　　width:"300px",
													　　height:"100px",
													　　content:"您输入的数量超过库存上限"
												　　});
												}
												$('.amount-input').val(num + 1);
											} else if ($(this).hasClass('sub')) {
												if (num == 1){
													return DJMask.open({
													　　width:"300px",
													　　height:"100px",
													　　content:"您输入的数量有误"
												　　});
												}
												$('.amount-input').val(num - 1);
											}
										});
									});

                                    $('#num').blur(function() {
										var stock = parseInt($('#Stock').html());
									    var num = parseInt($('.amount-input').val());
                                    
                                      if (num > stock) {
                                         $('.amount-input').val(stock)
                                      }
                                      
                                     
                       
                                      
                                    })
								</script>
							</div>
						</div>
						<!--  -->
						<div class="item-action clearfix bgf5 tihuan">
							<a href="javascript:;" rel="nofollow" onclick="return gobuy(this)" data-addfastbuy="true" title="点击此按钮，到下一步确认购买信息。" role="button" class="item-action__buy">立即购买</a>
							<a  href="javascript:;" onclick="return addcar(this)" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i>加入购物车
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-right picked-div">
				<div class="lace-title">
					<span class="c6">爆款推荐</span>
				</div>
				<div class="swiper-container picked-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
						   @foreach($baokuan as $b)
							<a class="picked-item" href="/home/item_show/?id={{$b->id}}">
								<img src="/storage/{{$b->baokuan_img['pic']}}" alt="" class="cover">
								<div class="look_price">¥{{$b->price}}</div>
							</a>
						  @endforeach
						</div>
					</div>
				</div>
                <div class="picked-button-prev"></div>
				<div class="picked-button-next"></div>
				<script>
					$(document).ready(function(){ 
						// 顶部banner轮播
						var picked_swiper = new Swiper('.picked-swiper', {
							loop : true,
							direction: 'vertical',
							prevButton:'.picked-button-prev',
							nextButton:'.picked-button-next',
						});
					});
				</script>
			</div>
		</section>
		<section class="item-show__div item-show__body posr clearfix">
			<div class="item-nav-tabs">
				<ul class="nav-tabs nav-pills clearfix" role="tablist" id="item-tabs">
					<li role="presentation" class="active"><a href="#detail" role="tab" data-toggle="tab" aria-controls="detail" aria-expanded="true">商品详情</a></li>
					<li role="presentation"><a href="#evaluate" role="tab" data-toggle="tab" aria-controls="evaluate">累计评价 <span class="badge">{{$count}}</span></a></li>
					<li role="presentation"><a href="#service" role="tab" data-toggle="tab" aria-controls="service">售后服务</a></li>

 				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab">
						<div class="item-detail__info clearfix">
							<div class="record">商品编号：D-{{$good['id']}}</div>
							<div class="record">上架时间：{{$good['created_at']}}</div>
					
							<div class="record">商品库存：{{$ku}}件</div>
						</div>
						<div class="rich-text">
							<p style="text-align: center;">
							 @php
							 $a = 1;
							 @endphp
                             @foreach($introduce as $iimg)
								<i id="desc-module-{{$a++}}" style="font-size: 0">
									<img src="/storage/{{$iimg['pic']}}" alt=""><br>
								</i>
                              @endforeach
							
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">{{$count}}</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">0</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">0</span></a></li>
								<li role="presentation"><a href="#bad" role="tab" data-toggle="tab" aria-controls="bad">差评 <span class="badge">0</span></a></li>
							</ul>
						</div>
						<div class="evaluate-content">
							<div class="tab-content">
								<!--  -->
								<div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledby="all-tab">
						
                                  @foreach($comments as $c)
									@if($c['type'] == 0)
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
						
												<img src="/storage/{{$c->item_userinfo->photo}}" alt="欢迎来到九州商城" class="cover b-r50">
											</div>
											<div class="name">{{$c->item_user->username}}</div>
										</div>
										<div class="eval-content">
											
											<div class="eval-text" style="margin-top: 10px">
												{{$c['text']}}

											</div>
											 <div class="eval-time" style="margin-top:35px">
												{{$c['created_at']}} {{$c->item_orderx['item_gui']['key_name']}}
											</div>
										@foreach($comments as $v)
											@if($v['type'] == 1 && $c['id'] == $v['pid'])
										      <div class="eval-text" style="margin-top: 5px;color: #AF874D;font-size: 14px">
												商家回复 : {{$v['text']}}
											</div>
											@endif
										@endforeach
										</div>
									</div>
								    @endif				
											
									@endforeach
                         
								<!-- 分页 -->
								</div>
								<!--  -->
								<div role="tabpanel" class="tab-pane fade" id="normal" aria-labelledby="normal-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
										
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									<!--  -->
									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/5页</a>
									</div>
								</div>
								<!--  -->
								<div role="tabpanel" class="tab-pane fade" id="bad" aria-labelledby="bad-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
									
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
									</div>
								</div>
								<!-- 差评结尾 -->
							</div>
							<script src="/Home/js/jquery.zoom.js"></script>
						</div>
					</div>
							<div role="tabpanel" class="tab-pane fade" id="service" aria-labelledby="service-tab">
						<!-- 富文本 -->
						<div class="service-content rich-text">
							<img title="" alt="" src="http://img.aocmonitor.com.cn/image/2014-06/86575417.gif" width="240" height="160" border="0" align="left"><p>承蒙惠购 AOC 产品，谨致谢意！为了让您更好地使用本产品，武汉艾德蒙科技股份有限公司通过该产品随机附带的保修证向您做出下述维修服务承诺，并按照该服务的承诺向您提供维修服务。</p><p>这些服务承诺仅适用于2016年6月1日（含）之后销售的AOC品牌显示器标准品。</p><p>如果您选择购买了 AOC 显示器扩展功能模块或其它厂家电脑主机，其保修承诺请参见相应产品的保修卡。</p><p>所有承诺内容以产品附件的保修卡为准。</p><p><br></p><h3>一、全国联保</h3><p style="text-indent:2em">AOC 显示器实施全国范围联保，国家标准三包服务。无论您是在中国大陆 ( 不含香港、澳门、台湾地区) 何处购买并在大陆地区使用的显示器，出现三包范围内的故障时，可凭显示器的保修证正本和购机发票到 AOC 显示器维修网点或授权网点进行维修同时，也欢迎您关注官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)进行查询。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/89154415.jpg" alt=""></div><p><br></p><p>三包服务如下：</p><ol><li>商品自售出之日起 7 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择退货、换货或修理。</li><li>商品自售出之日起 15 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择换货或修理。</li><li>商品自售出之日起 1 年内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择修理。</li></ol><p>以下情况不在三包范围内：</p><ol><li>超过三包有效期。</li><li>无有效的三包凭证及发票。</li><li>发票上内容与商品实物标识不符或者涂改的。</li><li>未按产品使用说明书要求使用、维护、保养而造成损坏的（人为损坏）。</li><li>非 AOC 授权的修理者拆动造成损坏的（私自拆修）。</li><li>非 AOC 在中国大陆（不含香港、澳门、台湾地区）销售的商品。</li></ol><h3>二、显示器专享服务</h3><p><strong>1、LUVIA视界头等舱，VIP专享服务</strong></p><p style="text-indent:2em">AOC针对各省市地区采取指定商品销售，消费者购买指定销往该区域的LUVIA卢瓦尔显示器标准品，从发票开具之日起1年内，注册成为官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)产品会员，即可在当地享“LUVIA视界头等舱，VIP专享服务”。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/25352146.jpg" alt=""></div><p><br></p><p style="text-indent:2em">* 如客户未在发票开具之日起1年内注册AOC微信会员，则只享受国家三包服务。</p><p style="text-indent:2em">注册会员方式：1、关注“AOC用户俱乐部”微信公众号。2、点击“会员”→“注册会员”。3、填写个人真实信息并注册产品信息，即可成为AOC产品会员。</p><p style="text-indent:2em"><strong>3年免费上门更换</strong>：从发票开具之日起3年内，产品若发生《微型计算机商品性能故障表》所列性能故障，可免费更换不低于同型号同规格产品。（服务网点无法覆盖区域，全国区域免费邮寄，双向运费由AOC负担）</p><p style="text-indent:2em"><strong>一键快捷掌上服务：</strong>从注册成为“AOC用户俱乐部”会员之日起，可享在线贴身技术顾问有问必答、售后服务在线预约、服务网点在线查询等一键快捷掌上服务。（人工客服咨询在线时间：8:00-22:00）</p><p style="text-indent:2em"><strong>增值豪礼尊享服务：</strong>可参加“AOC用户俱乐部”有奖互动赢取豪礼。</p><p>注：<br>(1)如不能及时提供购机发票或发票记载不清、涂改、商品实物标示和发票内容不符，将以您上传“AOC用户俱乐部”的发票信息为准计算保修时间；如果发票信息并未上传，将以该显示器制造日期(制造日期见显示器后壳条形码标签)加一个月为准计算保修时间。<br>(2)非“AOC用户俱乐部”产品会员，不享受“LUVIA视界头等舱，VIP专享服务”。</p>
						</div>
					</div>
                  <!--  -->
			    </div>
				<div class="recommends">
					<div class="lace-title type-2">
						<span class="cr">相关推荐</span>
					</div>
					<div class="swiper-container recommends-swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								@foreach($baokuan as $b)
								<a class="picked-item" href="/home/item_show/?id={{$b->id}}">
									<img src="/storage/{{$b->baokuan_img['pic']}}" alt="" class="cover">
									<div class="look_price">¥ {{$b->price}}</div>
								</a>
								@endforeach
							</div>
						
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
		      			<div class="pull-right">
				<div class="tab-content" id="descCate">
					<div role="tabpanel" class="tab-pane fade in active" id="detail-tab" aria-labelledby="detail-tab">
						<div class="descCate-content bgf5">
							<dd class="dc-idsItem selected">
								<a href="#desc-module-1"><i class="iconfont icon-dot"></i> 产品图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-2"><i class="iconfont icon-selected"></i> 细节图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-3"><i class="iconfont"></i> 尺寸及试穿</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-4"><i class="iconfont"></i> 模特效果图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-5"><i class="iconfont"></i> 常见问题</a>
							</dd>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate-tab" aria-labelledby="evaluate-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">相关推荐</span>
							</div>
							<div class="picked-box">
							    @foreach($baokuan as $b)
								<a class="picked-item" href="/home/item_show/?id={{$b->id}}">
									<img src="/storage/{{$b->baokuan_img['pic']}}" alt="" class="cover">
									<div class="look_price">¥ {{$b->price}}</div>
								</a>
								@endforeach
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service-tab" aria-labelledby="service-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">相关推荐</span>
							</div>
							<div class="picked-box">
							  @foreach($baokuan as $b)
								<a class="picked-item" href="/home/item_show/?id={{$b->id}}">
									<img src="/storage/{{$b->baokuan_img['pic']}}" alt="" class="cover">
									<div class="look_price">¥ {{$b->price}}</div>
								</a>
							  @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#descCate').smartFloat(0);
					$('.dc-idsItem').click(function() {
						$(this).addClass('selected').siblings().removeClass('selected');
					});
					$('#item-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
						$('#descCate #' + $(e.target).attr('aria-controls') + '-tab')
						.addClass('in').addClass('active').siblings()
						.removeClass('in').removeClass('active');
					});
				});
			</script>
		</section>
	</div>
   <script>	

   </script>
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
                    <i class="iconfont icon-cart" data-badge="{{$num}}"></i>
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
<script>
var typeid = $('.typeid').data('typeid')
//选规格的时候
$(function(){
  $(".gui li").click(function(){
	 var goods_id = $('.gui').data('goods_id')
	 $(this).parent().children().children().css('border', '').css('color','')
   
     $(this).children().css('border', '1px solid #b31e22').css('color','#b31e22');
    
   	var s = $('.test');
   	var a = {};

   	s.each(function(v, val) {
   		var bb = $(val).data('name');
   		$(val).children().each(function() {
   			if ($(this).children('a').attr('style') == 'border: 1px solid rgb(179, 30, 34); color: rgb(179, 30, 34);') {
   				a[bb] = $(this).children('a').children('span').html();
   			}
   		});
   	})
   	// console.log(Object.keys(a).length);
   	var names = '';
   	var x = 0;
   	for(k in a) {
   		x++;
   		names += k+':'+a[k]+' ';
   	}
   	if(s.length == x) {
       
        $('.amount-input').val(1)
        $.ajax({
            type: 'get',
            url: '/home/item_show/spec_all',
                data: {
                    goods_id:goods_id,
                    names: names,
                },
            success:function(res) {

             if (res.good != null) {

				var spec_id = res.good.id;
				var price = res.good.price;
				var store_count = res.good.store_count;

				$('.jiage').html(price);
				$('.jiages').html(price / 0.8);
				$('#Stock').html(store_count);
				 
				if (store_count == 0) {
					alter('该规格的商品已售罄 ，商家正在匆忙补货中！！！');
				} 

             } else {
                  var r=confirm('该规格的商品已售罄 ，去看看其他商品吧')
	               if (r) {
	              	   location.href = '/home/goods_list/'+typeid;
	                } else {
                       $('.tihuan').html('<div class=""><a style="cursor:not-allowed;" href="javascript:;" rel="nofollow" data-addfastbuy="true" title="点击此按钮，到下一步确认购买信息。" role="button" class="item-action__buy">立即购买</a><a  href="javascript:;" style="cursor:not-allowed" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket"><i class="iconfont icon-shopcart"></i>加入购物车</a></div>')
	                }

                }

            },
            error:function(err) {
            }

        })
   		
   	}

  })
})
 //添加购物车
  function addcar(car) {
    var commod = $('#num').val()
    var goods_id = $('.gui').data('goods_id')

	var s = $('.test');
   	var a = {};

   	s.each(function(v, val) {
   		var bb = $(val).data('name');
   		$(val).children().each(function() {
   			if ($(this).children('a').attr('style') == 'border: 1px solid rgb(179, 30, 34); color: rgb(179, 30, 34);') {
   				a[bb] = $(this).children('a').children('span').html();
   			}
   		});
   	})
   	var names = '';
   	var x = 0;
   	for(k in a) {
   		x++;
   		names += k+':'+a[k]+' ';
   	}
	    $.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
	        });
		$.ajax({
			   type: 'post',
			   url: '/home/item_show/addcar',
			   data: {
			   	commod:commod,
			   	names:names,
                goods_id:goods_id,

			},
	        success:function(res) {
	          if(res.code == 0){
	           var r=confirm(res.msg)
	               if (r) {
	              	   location.href = '/home/udai_shopcart';

	                }
              } else if(res.code == 1){ 
                  alert(res.msg)
              } else if (res.msg == 2) {
              	   alert(res.msg)
              } else {
              	alert(res.msg)

              }

	  
	        },
	        error:function(err) {
              if(err.responseJSON.code == 1){
              	 location.href = '/home/login';
              }
	        }

		})
} 
  //收藏
 function collect(coll) {
 	var gid = $(coll).data('id');
     console.dir(gid)

      $.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
	        });
		$.ajax({
			   type: 'post',
			   url: '/home/item_show/item_collect',
			   data: {
			   gid:gid,
			},
	        success:function(res) {
	           if(res.code == 0){
                  alert(res.msg)
                  $('#collect').css('color','orange')
 
	           } else if (res.msg == 1) {
                  alert(res.msg)
	           } else {
                  alert(res.msg)
                  $('#collect').css('color','orange')

	           }
	    
	        },
	       error:function(err) {
              if(err.responseJSON.code == 1){
              	 location.href = '/home/login';
              }
	        }

		}) 
 }
  //立即购买
 function gobuy(wo) {
    var commod = $('#num').val()
    var goods_id = $('.gui').data('goods_id')
    var typeid = $('.typeid').data('typeid')

	var s = $('.test');
   	var a = {};

   	s.each(function(v, val) {
   		var bb = $(val).data('name');
   		$(val).children().each(function() {
   			if ($(this).children('a').attr('style') == 'border: 1px solid rgb(179, 30, 34); color: rgb(179, 30, 34);') {
   				a[bb] = $(this).children('a').children('span').html();
   			}
   		});
   	})
   	var names = '';
   	var x = 0;
   	for(k in a) {
   		x++;
   		names += k+':'+a[k]+' ';
   	}
   	$.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
	        });
		$.ajax({
			   type: 'post',
			   url: '/home/item_show/item_gobuy',
			   data: {
			   commod:commod,
			   names:names,
               goods_id:goods_id,


			},
	        success:function(res) {
	          if(res.code == 0){

	              location.href = '/home/';

              } else if(res.code == 1){ 
                  alert(res.msg)
              } else if(res.code == 2){
              	   alert(res.msg)
              } else {
              	   var r=confirm(res.msg)
	               if (r) {
	              	   location.href = '/home/goods_list/'+typeid;
	                }
              }

	  
	        },
	        error:function(err) {
              if(err.responseJSON.code == 1){
              	 location.href = '/home/login';
              }
	        }

		}) 
  
 
 }
 </script>
@endsection