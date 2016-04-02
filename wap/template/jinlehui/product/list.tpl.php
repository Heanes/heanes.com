<div class="main-content w-wrap">
	<!-- 金融产品列表页面 -->
	<div class="product-list clearfix">
		<ul>
			<?php if (!isset($output['productList']) || !count($output['productList'])) { ?>
				<li class="no-result">暂无数据</li>
			<?php } else {
				foreach ($output['productList'] as $key => $product) { ?>
					<li onclick="window.location='<?php echo BASE_URL;?>index.php?act=product&id=<?php echo $product['id'];?>'">
						<table class="product-list-table">
							<tbody>
							<tr>
								<td class="product-img">
									<div class="product-img-block">
										<img src="<?php echo PATH_BASE_FILE_UPLOAD.'image/product/'.$product['cover_img_src']; ?>">
										<?php if($product['is_recommend']){?>
											<i class="recommend-mark-icon"></i>
											<span class="recommend-mark-text">行长推荐</span>
										<?php }?>
									</div>
								</td>
								<td class="product-text-td">
									<div class="product-text-introduce">
										<div class="product-introduce-title">
											<h1 class="text-introduce-title"><?php echo $product['name']; ?></h1>
											<?php if(!empty($product['description'])){?>
											<h2 class="type-mark"><?php echo $product['loan_type'];?></h2>
											<?php }?>
										</div>
										<div class="product-introduce-content">
											<?php if(empty($product['description'])){?>
												<?php echo $product['loan_type'];?>
											<?php }else{?>
												<?php echo $product['description']; ?>
											<?php }?>
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
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php');?>
		<!-- E 分页 E -->
	</div>
	<?php if (isset($output['productList']) && count($output['productList'])<5) { ?>
		<div class="more-product-placeholder">
			<img src="image/product/more-product.png" class="more-product-img">
			<p class="more-product-text">更多贷款产品，敬请期待<span style="letter-spacing:-0.5em">。。。</span></p>
		</div>
	<?php } ?>
</div>