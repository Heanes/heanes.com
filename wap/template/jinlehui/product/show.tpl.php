<div class="main-content w-wrap">
	<div class="page-introduce-img">
		<img src="image/introduce/introduce-product.jpg" class="introduce-img">
	</div>
	<div class="product-detail-block">
		<div class="product-detail-title">
			<h1 class="detail-title"><?php echo $output['product']['name'];?></h1>
		</div>
		<div class="product-detail-content">
			<table class="product-detail-table">
				<tbody>
				<?php if(isset($output['productFieldsList']) && count($output['productFieldsList'])){
					foreach ($output['productFieldsList'] as $key => $productFields) {?>
					<tr>
						<th><?php echo $productFields['name']?>：</th>
						<td><?php echo $productFields['fieldsData']['fields_value']?></td>
					</tr>
					<?php }?>
				<?php }?>
				<tr>
					<th>产品介绍：</th>
					<td><?php echo $output['product']['description']; ?></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="action-bar-wrap product-bar product-fixed-bottom-handle">
		<div class="cell add-favourite">
			<div class="cell-content-wrap" id="product_add_favourite">
				<i class="add-favourite-icon<?php if($output['productCollect']){?> collected<?php }?>"></i>
				<a class="bar-text add-favourite-href"><?php if($output['productCollect']){?>已<?php }?>收藏</a>
			</div>
		</div>
		<div class="cell handle-center">
			<div class="cell-content-wrap">
				<a href="<?php echo BASE_URL;?>index.php?act=money&op=apply&id=<?php echo $output['product']['id'];?>" class="button-large-long full-fill product-apply-button">立即申请</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('document').ready(function () {
		$('#product_add_favourite').on('click', function () {
			var user_id=<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id']:'0'?>;
			var product_id = <?php echo isset($_GET['id']) ? intval($_GET['id']):'0'?>;
			if($(this).hasClass('disabled') || user_id=='0' || user_id==''){
				alert('请登录后使用此功能！');
				return false;
			}else{
				var ajaxurl = "<?php echo BASE_URL;?>index.php?act=product&op=collect";
				var query = {};
				query.user_id = user_id;
				query.product_id = product_id;
				$.ajax({
					url: ajaxurl,
					data: query,
					type: "POST",
					dataType: "json",
					success: function (result) {
						if(result.status==1){
							$('.add-favourite-icon').addClass('collected');
							$('.add-favourite-href').html('已收藏');
							//alert(result.msg);
						}
						if(result.status==0){
							//alert(result.msg);
							$('.add-favourite-icon').removeClass('collected');
							$('.add-favourite-href').html('收藏');
						}
						if(result.status==-1){
							alert(result.msg);
						}
					}, error: function () {
						alert('未知原因，收藏失败，请稍后再试！');
					}
				});
			}
		});
	});
</script>