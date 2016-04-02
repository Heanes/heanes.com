<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<div class="page-introduce-img">
		<img alt="" src="image/introduce/01.png" class="introduce-img">
	</div>
	<div class="news-list">
		<div class="news-category-list">
			<?php if(isset($output['articleCategoryList']) && count($output['articleCategoryList'])){?>
				<ul class="category-list-ul">
					<?php foreach ($output['articleCategoryList'] as $key => $articleCategory) { ?>
						<li class="<?php if($_GET['category']==$articleCategory['code'] || $_GET['category']==$articleCategory['id']){?>current<?php }?>">
							<a href="<?php echo BASE_URL; ?>index.php?act=article&category=<?php echo $articleCategory['code']; ?>"><?php echo $articleCategory['name'] ?></a>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
		<div class="news-list-content">
			<ul class="news-list-ul">
				<?php if (!isset($output['articleList']) || empty($output['articleList'])){ ?>
					<li>暂无内容</li>
				<?php }else{ ?>
					<?php foreach ($output['articleList'] as $key => $article) { ?>
					<li>
						<i class="triangle-r-red"></i>
						<a href="<?php echo !empty($article['a_href']) ? $article['a_href'] : BASE_URL . 'index.php?act=article&id=' . $article['id']; ?>" title="<?php echo $article['title']; ?>"><?php echo $article['title']; ?></a>
					</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php'); ?>
		<!-- E 分页 E -->
	</div>
</div>
