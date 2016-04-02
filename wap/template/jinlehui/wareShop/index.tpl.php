<script type="text/javascript" src="/public/static/libs/js/jquery.lazyload/1.9.5/jquery.lazyload.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('img.lazyload').lazyload({
			effect : "fadeIn",
			threshold : 200
		});
	});
</script>
<div class="main-content w-wrap">
	<?php if(count($output['slideWapList'])){?>
		<!-- S 响应式幻灯部分 S -->
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
		<div class="index-slide text-center" id="index_slide">
			<?php foreach ($output['slideWapList'] as $key => $slideWap) {?>
				<a href="<?php echo $slideWap['a_href']?>"><img src="<?php echo $slideWap['img_src']?>" alt="<?php echo $slideWap['img_src']?>" /></a>
			<?php }?>
		</div>
		<script type="text/javascript">
			/**
			 * 响应式幻灯，支持触摸滑动，将JS脚本放在html中是为了响应更快，避免未加载完成时造成页面排版错乱的情况
			 * @author 方刚
			 * @time 2014-11-28 14:02:12
			 */
			if (jQuery.isFunction(jQuery.fn.excoloSlider)) {
				var slider=$("#index_slide").excoloSlider({
					pagerClass: "index-slide-pager",
					autoPlay: true,
					height: 'auto'
				});
			}
		</script>
		<!-- E 响应式幻灯部分 E -->
	<?php }?>
	<!-- 商品列表 -->
	<div class="integral-nav-block">
		<ul class="integral-nav-ul">
			<li><a href="javascript:"><i class="integral-icon"></i><span class="integral-text"><strong class="my-rank-total"><?php echo isset($output['user']['_rank']['value'])?$output['user']['_rank']['value']:'0'; ?></strong>金币</span></a></li>
			<li><a href="javascript:"><i class="integral-icon integral-record-icon"></i><span class="integral-text">兑换记录</span></a></li>
		</ul>
	</div>
	<div class="goods-list-block clearfix">
		<div class="goods-list">
			<ul class="goods-list-ul">
				<?php if(isset($output['wareList']) && count($output['wareList'])){?>
					<?php foreach ($output['wareList'] as $key => $ware) {?>
					<li class="goods-li">
						<div class="goods-block">
							<a href="<?php echo BASE_URL.'index.php?act=wareShop&id='.$ware['id'];?>" class="goods-href">
								<div class="goods-image">
									<img data-original="<?php echo SYS_HOST.$ware['_cover_img_src']?>" src="image/ware/goods-loading.png" class="lazyload">
								</div>
								<div class="info">
									<p class="goods-name"><?php echo $ware['name']?></p>
									<p class="goods-price"><i class="integral-icon mini"></i><?php echo $ware['shop_price']?></p>
								</div>
								<div class="meta">
									<span class="original-price"><?php echo $ware['original_price']?></span>
									<i class="goods-separate-border"></i>
									<span class="sold-out">已兑<?php echo $ware['total_sold_num']?>件</span>
								</div>
							</a>
						</div>
					</li>
					<?php }?>
				<?php }else{?>
				<li class="goods-li">暂无积分商品</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>
