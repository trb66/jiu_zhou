@extends('Home.index')

@section('title',$good['name'])


@section('type')

@endsection

@section('body')

<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
				<ol class="breadcrumb">
					<li><a href="index.html">首页</a></li>
					<li><a href="item_sale_page.html">{{$type->name}}</a></li>
					<li class="active">{{$good['name']}}</li>
				</ol>
				<div class="item-pic__box" id="magnifier">
					<div class="small-box">
                   
						<img class="cover" src="/storage/{{$pre[0]->pic}}" alt="{{$good['name']}}">
						<span class="hover"></span>
                       
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix">
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
						<div class="price-box clearfix">
							<div class="price-panel pull-left">
								售价：<span class="price">￥{{$good['price']}} <s class="fz16 c9">￥{{$good['price'] / 0.8 }}</s></span>
							</div>
						</div>

					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<span class="ind-label c9">累计销量</span>
							<span class="ind-count cr">1688</span>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr">{{$count}}</span></a>
						</li>
					</ul>
					<div class="item-key">
						<div class="item-sku">
						   @foreach ($spec as $v)
							<dl class="item-prop clearfix">
								<dt class="item-metatit">{{$v['name']}}：</dt>
								<dd><ul data-property="颜色" class="clearfix">
									@foreach($v['time'] as $vo)
									<li><a href="javascript:;" role="button" data-value="{{ $vo }}"  aria-disabled="true">
										<span>{{ $vo }}</span>
									</a></li>
									@endforeach
								</ul></dd>
							</dl>
							@endforeach
						</div>
						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="amount-box">
								<div class="amount-widget">
									<input class="amount-input" value="1" maxlength="8" title="请输入购买量" type="text">
									<div class="amount-btn">
										<a class="amount-but add"></a>
										<a class="amount-but sub"></a>
									</div>
								</div>
								<div class="item-stock"><span style="margin-left: 10px;">库存 <b id="Stock">1000</b> 件</span></div>
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
								</script>
							</div>
						</div>
						<div class="item-action clearfix bgf5">
							<a href="javascript:;" rel="nofollow" data-addfastbuy="true" title="点击此按钮，到下一步确认购买信息。" role="button" class="item-action__buy">立即购买</a>
							<a href="javascript:;" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i> 加入购物车
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
 				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab">
						<div class="item-detail__info clearfix">
							<div class="record">商品编号：D-{{$good['id']}}</div>
							<div class="record">上架时间：{{$good['created_at']}}</div>
					
							<div class="record">商品库存：1000件</div>
						</div>
						<div class="rich-text">
							<p style="text-align: center;">
                             @foreach($introduce as $iimg)
								<i id="desc-module-1" style="font-size: 0"></i>
								<img src="/storage/{{$iimg['pic']}}" alt=""><br>
                              @endforeach
							
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">{{$count}}</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">1000</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">314</span></a></li>
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
												<img src="images/icons/default_avt.png" alt="欢迎来到九州商城" class="cover b-r50">
											</div>
											<div class="name">{{$c->item_user->username}}</div>
										</div>
										<div class="eval-content">
											
											<div class="eval-text" style="margin-top: 10px">
												{{$c['text']}}

											</div>
											 <div class="eval-time" style="margin-top:35px">
												{{$c['created_at']}} 颜色分类：深棕色 尺码：均码 
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
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
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
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
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

@section('js')

@endsection