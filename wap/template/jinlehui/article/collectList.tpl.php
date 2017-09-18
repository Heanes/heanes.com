<div class="main-content w-wrap">
	<!-- 文章收藏列表页面 -->
	<div class="news-list collect-list">
		<?php if (!isset($output['articleCollectListOrdered']) || !count($output['articleCollectListOrdered'])){ ?>
			<div class="collect-no-result">
				<p class="no-result-title">还没有文章收藏，快去看看吧~</p>
				<p class="no-result-content no-result-text text-center">
					<a href="<?php echo BASE_URL.'index.php?act=article'?>" class="no-result-href">资讯中心</a>
				</p>
			</div>
		<?php } else{
			foreach ($output['articleCollectListOrdered'] as $key => $articleCollect) { ?>
				<fieldset class="collect-time-fieldset">
					<legend class="collect-time-legend"><?php echo $articleCollect['collect_date'] ?></legend>
				</fieldset>
				<ul class="news-list-ul img-style collect-list">
					<?php if (!isset($articleCollect['collect_articles']) || !count($articleCollect['collect_articles'])){ ?>
						<li class="no-result">
							还没有文章收藏，快去看看吧
						</li>
					<?php } else{
						foreach ($articleCollect['collect_articles'] as $sub_key => $article) { ?>
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
											<span class="cell meta-time"><?php echo to_date($article['create_time']); ?></span>
											<span class="cell read-count"><i class="read-eye-icon"></i><?php echo $article['click_count']; ?></span>
											<span class="cell comment-count"><i class="article-comment-icon"></i><?php echo $article['comment_num']; ?></span>
										</div>
									</div>
								</a>
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