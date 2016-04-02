<script type="text/javascript" src="/public/static/libs/js/jquery.lazyload/1.9.5/jquery.lazyload.min.js"></script>
<script type="text/javascript">
	$(function() {
		//图片延迟加载
		$('img.lazyload').lazyload({
			effect : "fadeIn",
			threshold : 200
		});
	})
</script>
<div class="main-content w-wrap">
	<div class="goods-list-block">
		<div class="goods-list">
			<?php if (isset($output['wareCollectListOrdered']) && count($output['wareCollectListOrdered'])){ ?>
				<?php foreach ($output['wareCollectListOrdered'] as $key => $wareCollect) { ?>
					<fieldset class="collect-time-fieldset">
						<legend class="collect-time-legend"><?php echo $wareCollect['collect_date'] ?></legend>
					</fieldset>
					<?php if (!isset($wareCollect['collect_wares']) || !count($wareCollect['collect_wares'])){ ?>
						<div class="collect-no-result">
							<p class="no-result-title">还没有产品收藏，快去看看吧~</p>
							<p class="no-result-content no-result-text text-center">
								<a href="<?php echo BASE_URL . 'index.php?act=wareShop' ?>" class="no-result-href">金融超市</a>
							</p>
						</div>
					<?php } else{ ?>
						<ul class="goods-list-ul clearfix">
						<?php foreach ($wareCollect['collect_wares'] as $sub_key => $ware) { ?>
							<li class="goods-li">
								<div class="goods-block">
									<a href="<?php echo BASE_URL; ?>index.php?act=wareShop&id=<?php echo $ware['id']; ?>" class="goods-href">
										<div class="goods-image">
											<img data-original="<?php echo SYS_HOST.$ware['_cover_img_src']; ?>" src="image/ware/goods-loading.png" class="lazyload">
										</div>
										<div class="info">
											<p class="goods-name"><?php echo $ware['name']; ?></p>
											<p class="goods-price"><i class="integral-icon mini"></i><?php echo $ware['shop_price']; ?></p>
										</div>
										<div class="meta">
											<span class="original-price"><?php echo $ware['original_price']; ?></span>
											<i class="goods-separate-border"></i>
											<span class="sold-out">已兑<?php echo $ware['total_sold_num']; ?>件</span>
										</div>
									</a>
								</div>
							</li>
						<?php } ?>
					<?php } ?>
					</ul>
				<?php } ?>
			<?php } else{ ?>
				<div class="collect-no-result">
					<p class="no-result-title">还没有商品收藏，快去看看吧~</p>
					<p class="no-result-content no-result-text text-center">
						<a href="<?php echo BASE_URL . 'index.php?act=wareShop' ?>" class="no-result-href">金宝街</a>
					</p>
				</div>
			<?php } ?>
		</div>
	</div>
</div>