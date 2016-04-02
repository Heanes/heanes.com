<div class="main-content w-wrap">
	<!-- 金融产品首页 -->
	<div class="page-introduce-img">
		<a href="<?php echo BASE_URL.'index.php?act=money&op=apply'?>"><img src="image/product/introduce/personal-tailor.jpg" class="introduce-img"></a>
	</div>
	<div class="block-list product-filter absolute-center1">
		<?php foreach ($output['productCategoryList'] as $key => $productCategory) {?>
			<div class="block product-filter-block" onclick="window.location='<?php echo BASE_URL.'index.php?act=product&category='.$productCategory['id'];?>'">
				<div class="block-icon" style="background-image:url(<?php echo $productCategory['img_src'];?>)"></div>
				<div class="block-title"><?php echo $productCategory['name'];?></div>
			</div>
		<?php }?>
		<div class="block product-filter-block">
			<div class="block-icon" style="background-image:url(/data/upload/image/product/category-icon/5.svg)"></div>
			<div class="block-title"><p class="block-title">开发贷</p></div>
		</div>
		<div class="block product-filter-block">
			<!-- 图片模式 -->
			<div class="block-icon" style="background-image:url(/data/upload/image/product/category-icon/6.svg)"></div>
			<div class="block-title"><p class="block-title">受托支付</p></div>
		</div>
	</div>
</div>