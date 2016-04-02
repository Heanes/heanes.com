<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<!--分类折叠导航-->
	<div class="nav-category w-wrap fixed">
		<?php /*if(isset($output['articleCategoryList']) && count($output['articleCategoryList'])){*/?><!--
			<div class="lap-category-wrap w-wrap">
				<ul class="category-ul">
					<?php /*foreach ($output['articleCategoryList'] as $key => $articleCategory) { */?>
						<li class="<?php /*if(isset($_GET['category']) && ($_GET['category']==$articleCategory['code'] || $_GET['category']==$articleCategory['id'])){*/?>current<?php /*}*/?>">
							<a href="<?php /*echo BASE_URL; */?>index.php?act=article&category=<?php /*echo $articleCategory['code']; */?>"><?php /*echo $articleCategory['name'] */?></a>
						</li>
					<?php /*} */?>
				</ul>
				<span class="lap-icon-wrap"><i class="lap-icon"></i></span>
			</div>
		--><?php /*}*/?>
		<div class="category-list-cross">
			<?php if(isset($output['articleCategoryList']) && count($output['articleCategoryList'])){?>
				<ul class="category-list-ul">
					<?php foreach ($output['articleCategoryList'] as $key => $articleCategory) { ?>
						<li class="<?php if(isset($_GET['category']) && ($_GET['category']==$articleCategory['code'] || $_GET['category']==$articleCategory['id'])){?>current<?php }?>">
							<a href="<?php echo BASE_URL; ?>index.php?act=article&category=<?php echo $articleCategory['code']; ?>"><?php echo $articleCategory['name'] ?></a>
						</li>
					<?php } ?>
				</ul>
			<?php }?>
		</div>
	</div>
	<div class="category-list-cross-placeholder"></div>
	<!-- S 响应式幻灯部分 S -->
	<?php if (isset($output['hotArticleList']) && count($output['hotArticleList'])){ ?>
	<div class="index-slide news-slide text-center" id="index_slide">
		<?php foreach ($output['hotArticleList'] as $key => $article) { ?>
			<a href="<?php echo !empty($article['a_href']) ? $article['a_href'] : BASE_URL . 'index.php?act=article&id=' . $article['id']; ?>">
				<img src="<?php echo empty($article['cover_img_src']) ? 'image/article/cover/random/'.($article['id']%70).'.jpg':$article['_cover_img_src']; ?>" alt="<?php echo 'article_cover_'.$article['id'],'.jpg';?>" />
				<p class="slide-title"><?php echo $article['title']; ?></p>
			</a>
		<?php } ?>
	</div>
	<?php } ?>
	<!-- E 响应式幻灯部分 E -->
	<div class="news-list">
		<div class="news-list-content img-style">
			<ul class="news-list-ul img-style">
				<?php if (!isset($output['articleList']) || empty($output['articleList'])){ ?>
					<li>
						<div class="no-result">
							<h2 class="no-result-title cell">暂无内容</h2>
						</div>
					</li>
				<?php }else{ ?>
				<?php foreach ($output['articleList'] as $key => $article) { ?>
					<li>
						<a href="<?php echo !empty($article['a_href']) ? $article['a_href'] : BASE_URL . 'index.php?act=article&id=' . $article['id']; ?>" class="block">
							<div class="cell article-cover">
								<img src="<?php echo empty($article['cover_img_src']) ? 'image/article/cover/random/'.($article['id']%70).'.jpg':$article['_cover_img_src']; ?>" class="article-cover-img">
							</div>
							<div class="cell article-text-block">
								<div class="article-title-block">
									<h1><?php echo $article['title']; ?></h1>
								</div>
								<div class="article-meta-info">
									<span class="cell meta-time"><?php echo to_date($article['insert_time']); ?></span>
									<span class="cell read-count"><i class="read-eye-icon"></i><?php echo $article['click_count']; ?></span>
									<span class="cell comment-count"><i class="article-comment-icon"></i><?php echo $article['comment_num']; ?></span>
								</div>
							</div>
						</a>
					</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php'); ?>
		<!-- E 分页 E -->
	</div>
	<div class="blank"></div>
	<!--<div class="page-introduce-img">
		<img alt="" src="image/introduce/01.png" class="introduce-img">
	</div>-->
</div>
<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
<script type="text/javascript">
	$(function() {
		$('.lap-icon-wrap').on('click', function() {
			$('.lap-category-wrap').toggleClass('fixed-lap-on');
			$('.lap-icon').toggleClass('open');
			$('.lap-category-wrap-placeholder').toggle();
		});
		/**
		 * 响应式幻灯，支持触摸滑动，将JS脚本放在html中是为了响应更快，避免未加载完成时造成页面排版错乱的情况
		 * @author 方刚
		 * @time 2014-11-28 14:02:12
		 */
		if (jQuery.isFunction(jQuery.fn.excoloSlider)) {
			var slider=$("#index_slide").excoloSlider({
				pagerClass: "index-slide-pager",
				autoPlay: true,
				height: '146px'
			});
		}
	})
</script>