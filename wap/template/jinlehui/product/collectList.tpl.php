<link rel="stylesheet" type="text/css" href="css/listFilter.css" />
<!-- S 筛选标题 S -->
<!--<div class="screening">-->
<!--	<ul>-->
<!--		--><?php //foreach ($output['productFilterList'] as $key => $productFilter) {
//			$productFilter['_filter_value']=explode(',',$productFilter['input_value']);
//			?>
<!--			<li class="filter-level1">--><?php //echo $productFilter['name']?><!--</li>-->
<!--		--><?php //}?>
<!--	</ul>-->
<!--</div>-->
<!-- E 筛选标题 E -->
<!-- S 筛选值 S -->
<!--<div class="grade-eject">-->
<!--	<ul class="grade-w" id="gradew">-->
<!--		<li><a href="--><?php //echo BASE_URL?><!--index.php?act=product&op=list&filter=3">银行</a></li>-->
<!--		<li><a href="--><?php //echo BASE_URL?><!--index.php?act=product&op=list&filter=4">其他</a></li>-->
<!--	</ul>-->
<!--</div>-->
<!--<div class="Category-eject">-->
<!--	<ul class="Category-w" id="Categorytw">-->
<!--		<li><a href="--><?php //echo BASE_URL?><!--index.php?act=product&op=list&filter=3">抵押贷款</a></li>-->
<!--		<li><a href="--><?php //echo BASE_URL?><!--index.php?act=product&op=list&filter=3">信用贷款</a></li>-->
<!--	</ul>-->
<!--</div>-->
<!-- E 筛选值 E -->
<div class="main-content w-wrap">
	<!-- 金融产品列表页面 -->
	<div class="product-list">
		<?php if (!isset($output['productCollectListOrdered']) || !count($output['productCollectListOrdered'])){ ?>
			<div class="collect-no-result">
				<p class="no-result-title">还没有产品收藏，快去看看吧~</p>
				<p class="no-result-content no-result-text text-center">
					<a href="<?php echo BASE_URL.'index.php?act=product'?>" class="no-result-href">金融超市</a>
				</p>
			</div>
		<?php } else{
			foreach ($output['productCollectListOrdered'] as $key => $productCollect) { ?>
				<fieldset class="collect-time-fieldset">
					<legend class="collect-time-legend"><?php echo $productCollect['collect_date'] ?></legend>
				</fieldset>
					<?php if (!isset($productCollect['collect_products']) || !count($productCollect['collect_products'])){ ?>
						<div class="collect-no-result">
							<p class="no-result-title">还没有产品收藏，快去看看吧~</p>
							<p class="no-result-content no-result-text text-center">
								<a href="<?php echo BASE_URL.'index.php?act=product'?>" class="no-result-href">金融超市</a>
							</p>
						</div>
					<?php } else{?>
						<ul>
						<?php foreach ($productCollect['collect_products'] as $sub_key => $product) { ?>
							<li onclick="window.location='<?php echo BASE_URL; ?>index.php?act=product&id=<?php echo $product['product_id']; ?>'">
								<table class="product-list-table">
									<tbody>
									<tr>
										<td class="product-img">
											<img src="<?php echo PATH_BASE_FILE_UPLOAD . 'image/product/' . $product['cover_img_src']; ?>">
										</td>
										<td class="product-text-td">
											<div class="product-text-introduce">
												<div class="product-introduce-title">
													<h1 class="text-introduce-title"><?php echo $product['name']; ?></h1>
													<?php if (!empty($product['description'])){ ?>
														<h2 class="type-mark"><?php echo $product['loan_type']; ?></h2>
													<?php } ?>
												</div>
												<div class="product-introduce-content">
													<?php if (empty($product['description'])){ ?>
														<?php echo $product['loan_type']; ?>
													<?php } else{ ?>
														<?php echo $product['description']; ?>
													<?php } ?>
												</div>
											</div>
										</td>
										<td class="product-more-td">
											<i class="product-more-icon"></i>
										</td>
									</tr>
									</tbody>
								</table>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			<?php } ?>
		<?php } ?>
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php');?>
		<!-- E 分页 E -->
	</div>
</div>
<script type="text/javascript" src="js/listFilter.js"></script>