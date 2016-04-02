<script type="text/javascript" src="/public/static/libs/js/jquery.lazyload/1.9.5/jquery.lazyload.min.js"></script>
<script type="text/javascript">
	$(function() {
		//Tab选项卡切换
		$('.content-ul li').on('click',function(){
			var li=$('.content-ul li');
			li.removeClass('current');
			$(this).addClass('current');
			var li_index=$(this).index();
			var li_toggle_block_list=$('.toggle-block');
			li_toggle_block_list.hide();
			$(li_toggle_block_list[li_index]).show();
		});
		//图片延迟加载
		$('img.lazyload').lazyload({
			effect : "fadeIn",
			threshold : 200
		});
	})
</script>
<div class="main-content w-wrap">
	<div class="goods-detail-block">
		<!-- S 商品图片响应式幻灯部分 S -->
		<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
		<div class="goods-slide text-center" id="goods_slide">
			<a href="<?php echo SYS_HOST.$output['ware']['_cover_img_src']?>"><img src="<?php echo SYS_HOST.$output['ware']['_cover_img_src']?>" alt="slide1.jpg" /></a>
			<a href="<?php echo SYS_HOST.$output['ware']['_cover_img_src']?>"><img src="<?php echo SYS_HOST.$output['ware']['_cover_img_src']?>" alt="slide1.jpg" /></a>
		</div>
		<script type="text/javascript">
			/**
			 * 响应式幻灯，支持触摸滑动，将JS脚本放在html中是为了响应更快，避免未加载完成时造成页面排版错乱的情况
			 * @author 方刚
			 * @time 2014-11-28 14:02:12
			 */
			if (jQuery.isFunction(jQuery.fn.excoloSlider)) {
				var slider=$("#goods_slide").excoloSlider({
					pagerClass: "goods-slide-pager",
					autoPlay: true,
					height: '240px'
				});
			}
		</script>
		<!-- E 商品图片响应式幻灯部分 E -->
		<!--商品价格、运费等信息-->
		<div class="goods-info">
			<h1 class="goods-name"><?php echo $output['ware']['name']?></h1>
			<div class="meta">
				<p class="goods-price"><i class="integral-icon mini"></i><?php echo $output['ware']['shop_price']?></p>
				<span class="original-price"><del><?php echo $output['ware']['original_price']?></del></span>
				<i class="goods-separate-border"></i>
				<span class="sold-out">已兑<?php echo $output['ware']['total_sold_num']?>件</span>
			</div>
		</div>
		<!--快递信息-->
		<div class="goods-delivery delivery-block">
			<span class="delivery-fee">快递 10.00</span>
			<span>月兑53件</span>
			<span class="goods-address">北京 海淀</span>
		</div>
		<!-- 商品属性 -->
		<div class="choose-goods-attribute attribute-block">
			<span>请选择尺码、颜色</span><i class="arrow-r"></i>
		</div>
		<div class="goods-content-block">
			<div class="toggle-ul">
				<ul class="content-ul">
					<li class="current">图文详情</li>
					<li>产品参数</li>
					<li>累计评价</li>
					<li>相似推荐</li>
				</ul>
			</div>
			<div class="toggle-block-content">
			<!-- 商品图文详情 -->
			<div class="toggle-block goods-content">
				<?php echo $output['ware']['description']?>
			</div>
			<!--产品参数-->
			<div class="toggle-block goods-attribute">
				<ul class="goods-attribute-ul">
					<li>
						<label class="attribute-name">长度</label>
						<span class="attribute-value">35cm</span>
					</li>
					<li>
						<label class="attribute-name">厚薄</label>
						<span class="attribute-value">23cm 我是很长的文字很长的文字很长的文字很长的文字</span>
					</li>
					<li>
						<label class="attribute-name">上市时间</label>
						<span class="attribute-value">2015-09-07 09:18:37</span>
					</li>
				</ul>
			</div>
			<!--累计评价-->
			<div class="toggle-block goods-comment">
				<ul class="goods-comment-ul">
					<li>
						<div class="user-meta">
							<img src="<?php echo $comment['_user']['avatar_src']?>" class="buyer-avatar">
							<strong>Heanes</strong>
							<i class="user-buyer-level-icon"></i>
						</div>
						<div class="goods-comment-detail">
							<p>衣服质量很不错，做工精细，款式很时尚，我非常满意，试穿很合适很舒服，颜色我很喜欢。卖家发货很快，面料很独特。。很舒服。穿上也很帅气。质量很好，面料很舒服，没有一点色差，颜色很漂亮，上身效果棒棒的，卖家推荐的尺码很合适</p>
						</div>
						<div class="comment-time">
							<p>2015-09-07 09:51:38 尺码:175/96A 颜色:白色</p>
						</div>
					</li>
				</ul>
			</div>
			<!--相似推荐-->
			<div class="toggle-block goods-recommend">
				<div class="goods-list-block">
					<div class="goods-list">
						<ul class="goods-list-ul clearfix">
							<li class="goods-li">
								<div class="goods-block">
									<a href="javascript:void(0);" class="goods-href">
										<div class="goods-image">
											<img data-original="/data/upload/image/ware/100001/album/1.jpg" src="image/ware/goods-loading.png" class="lazyload">
										</div>
										<div class="info">
											<p class="goods-name">锅碗瓢盆任你挑任你选，破的不要钱，旧的白送，假的买一赔三</p>
											<p class="goods-price"><i class="integral-icon mini"></i>156.00</p>
										</div>
										<div class="meta">
											<span class="original-price"></span>
											<i class="goods-separate-border"></i>
											<span class="sold-out">已兑111件</span>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- 商品操作栏 -->
		<div class="action-bar-placeholder"></div>
		<div class="action-bar-wrap goods-buy-bar goods-buy-fixed-bottom-handle">
			<div class="cell add-favourite">
				<div class="cell-content-wrap" id="ware_add_favourite">
					<i class="add-favourite-icon<?php if($output['wareCollect']){?> collected<?php }?>"></i>
					<a class="bar-text add-favourite-href"><?php if($output['wareCollect']){?>已<?php }?>收藏</a>
				</div>
			</div>
			<div class="cell handle-center">
				<div class="cell-content-wrap">
					<a href="javascript:void(0);" class="button-large-long full-fill goods-buy-button" id="buy_goods">立即兑换</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('document').ready(function () {
		/**
		 * @doc 收藏操作
		 * @author Heanes
		 * @time 2015-09-11 10:41:06
		 */
		$('#ware_add_favourite').on('click', function () {
			var user_id=<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id']:'0'?>;
			var ware_id = <?php echo isset($_GET['id']) ? intval($_GET['id']):'0'?>;
			if($(this).hasClass('disabled') || user_id=='0' || user_id==''){
				alert('请登录后使用此功能！');
				return false;
			}else{
				var ajaxurl = "<?php echo BASE_URL;?>index.php?act=wareShop&op=collect";
				var query = {};
				query.user_id = user_id;
				query.ware_id = ware_id;
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

		/**
		 * @doc 兑换前的操作
		 * @author Heanes
		 * @time 2015-09-11 10:41:30
		 */
		$('#buy_goods').on('click', function () {
			//1.检测用户积分是否足够
			alert('您的金币不足！');
		});
	});
</script>