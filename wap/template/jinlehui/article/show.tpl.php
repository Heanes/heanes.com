<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<div class="article-page">
		<!-- 文章分类 -->
		<div class="article-category">
			<a href="">首页</a>
			<span class="nav-sub">></span>
			<a href="">资讯</a>
			<span class="nav-sub">></span>
			<a href="">网络</a>
		</div>
		<!-- 单篇文章 -->
		<div class="article-block">
			<!-- 文章标题 -->
			<div class="article-title">
				<h1 class="entry-title"><?php echo $output['article']['title'];?></h1>
			</div>
			<!-- 文章相关属性信息 -->
			<div class="article-info">
				<p>人气：<?php echo $output['article']['click_count'];?> <a href="<?php echo CURRENT_URL;?>#comment-list" class="comment-num">评论：<?php echo $output['commentNum'];?></a></p>
				<p>作者：<?php echo empty($output['article']['author'])?'admin':$output['article']['author'];?> 责编：<?php echo empty($output['article']['editor'])?'admin':$output['article']['editor'];?> </p>
				<p><?php echo to_date($output['article']['insert_time']);?> 来源：<?php echo !empty($output['article']['origin_source'])?$output['article']['origin_source']:'原创';?></p>
			</div>
			<!-- 文章主体 -->
			<div class="article-content">
				<?php echo $output['article']['content']?>
			</div>
			<div class="article-meta">
				<p class="article-tags">本文关键词：
				<?php foreach ($output['article']['keywords'] as $key => $keyword) {?>
					<strong><a href="<?php echo BASE_URL.'index.php?act=articleKeywords&op=list&name='.$keyword;?>"><?php echo $keyword;?></a></strong>
					<?php if($key != count($output['article']['keywords'])-1){
						echo '，';
					} ?>
				<?php }?>
			</div>
		</div>
		<!-- 文章相关交互 -->
		<div class="article-handle">
			<div class="article-handle-data">
				<span class="collect-data" id="collect_article"><span class="collect-text">收藏</span>(<ins class="collect-count"><?php echo $output['article']['_collect_count'];?></ins>)</span>
				<i class="border-separate"></i>
				<span>阅读数(<?php echo $output['article']['click_count'];?>)</span>
				<!--
				<i class="border-separate"></i>
				<span><a href="" class="vote-up">点赞(847)</a></span>
				-->
			</div>
			<!-- 文章分享按钮 -->
			<div class="article-share-block">
				<div class="share-title">
					<span class="share-title-text">分享给小伙伴</span>
				</div>
				<!-- 百度分享 -->
				<div class="bdsharebuttonbox">
					<a href="#" class="bds_more" data-cmd="more"></a>
					<a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
					<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
					<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
					<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
					<a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣"></a>
					<a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a>
					<a class="bds_more" data-cmd="more"></a>
					<a class="bds_count" data-cmd="count"></a>
				</div>
				<!-- 百度分享按钮区域 -->
				<script>
					window._bd_share_config = {
						"common" : {
							"bdSnsKey" : {},
							"bdText" : "",
							"bdMini" : "2",
							"bdMiniList" : false,
							"bdPic" : "",
							"bdStyle" : "0",
							"bdSize" : "24"
						},
						"share" : {}
					};
					with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src =
						'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='	+ ~(-new Date() / 36e5)];
				</script>
			</div>
		</div>
		<!-- 相关文章 -->
		<div class="article-relate-block">
			<div class="article-relate-text">
				<h1 class="relate-title"><a id="relate-article">相关文章</a></h1>
				<ul class="relate-text-ul">
					<?php if(count($output['relateArticleList'])){
						foreach ($output['relateArticleList'] as $key => $relateArticle) {?>
							<li>
								<a href="" class="relate-li-a">腾讯旗下微众银行推出首款小额贷款产品“微粒贷”</a>
							</li>
						<?php }
					}else{?>
						<li>
							暂无数据
						</li>
					<?php }?>
				</ul>
			</div>
			<div class="article-relate-img">
				<ul>
					<li></li>
					<li></li>
				</ul>
			</div>
		</div>
		<!-- 评论区域 -->
		<div class="article-comment-block">
			<div class="add-comment-block">
				<h1 class="add-comment-title"><a id="add-comment">发表评论</a></h1>
				<p class="add-comment-remind">愿您的每句评论，都能给大家的生活添色彩，带来共鸣，带来思索，带来快乐。</p>
				<div class="add-comment">
					<form action="<?php echo BASE_URL.'index.php?act=articleComment&op=addComment&article_id='.$output['article']['id'];?>" method="post" name="add_comment" id="add_comment">
						<textarea name="comment_content" rows="8" class="comment-textarea" placeholder="评论有你更精彩~"></textarea>
						<input type="hidden" id="article_id" value="<?php echo $output['article']['id'];?>">
						<p class="input-error-notice">评论内容至少1个字符</p>
						<div class="add-comment-handle">
							<input type="submit" name="article_comment_form_submit" class="submit-button button-normal" value="提交评论" />
						</div>
					</form>
				</div>
			</div>
			<div class="comment-list">
				<h3 class="comment-list-title"><a id="comment-list">评论列表</a></h3>
				<ul class="comment-list-ul">
					<?php if(!count($output['commentList'])){ ?>
						<li>
							<div class="comment-content">
								<p>暂无评论</p>
							</div>
						</li>
					<?php } ?>
					<?php foreach ($output['commentList'] as $key => $comment) { ?>
					<li>
						<div class="comment-info">
							<span class="comment-user-avatar"><img src="<?php echo empty($comment['_user']['avatar_src'])? 'image/user-avatar/default.png':$comment['_user']['avatar_src'];?>"></span>
							<span class="comment-user-name"><a href="<?php echo ($comment['user_id']!=0)?BASE_URL.'index.php?act=member&op=zone&id='.$comment['user_id']:'javascript:;';?>" class="user-name-a"><?php echo empty($comment['_user']['user_name'])?'游客':$comment['_user']['user_name']; ?></a></span>
							<span class="comment-user-ip"><?php echo $comment['location']; ?></span>
							<span><?php echo to_date($comment['insert_time']);?></span>
							<span class="comment-floor"><a id="comment-floor-<?php echo $key+1;?>" class="comment-floor-a"><?php echo $key+1;?>楼</a></span>
						</div>
						<div class="comment-content">
							<?php echo $comment['content'];?>
						</div>
						<div class="comment-handle">
							<span class="comment-complain" rel="<?php echo $comment['id'];?>"><a href="javascript:void(0);">举报</a></span>
							<i class="border-separate"></i>
							<span class="comment-vote-up"><a href="javascript:void(0);">支持(<ins class="vote-number" rel="<?php echo $comment['id'];?>"><?php echo $comment['comment_judge']['support'];?></ins>)</a></span>
							<i class="border-separate"></i>
							<span class="comment-vote-down"><a href="javascript:void(0);">反对(<ins class="vote-number" rel="<?php echo $comment['id'];?>"><?php echo $comment['comment_judge']['against'] ?></ins>)</a></span>
							<i class="border-separate"></i>
							<span class="comment-reply"><a href="">回复</a></span>
							<!-- @todo 添加AJAX楼层回复功能 -->
						</div>
					</li>
					<?php } ?>
				</ul>
				<?php include(TPL.'pager/pagerDefaultStyle.tpl.php');?>
			</div>
		</div>
	</div>
	<?php include(TPL.'ads/insert_ads_FollowWeiXin.tpl.php');?>
</div>
<script type="text/javascript">
	//文章收藏
	$('#collect_article').on('click', function () {
		var user_id=<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id']:'0'?>;
		var article_id = <?php echo isset($_GET['id']) ? intval($_GET['id']):'0'?>;
		if($(this).hasClass('disabled') || user_id=='0' || user_id==''){
			alert('请登录后使用此功能！');
			return false;
		}else{
			var old_collect_count=$('.collect-count').html();
			var ajaxurl = "<?php echo BASE_URL;?>index.php?act=article&op=collect";
			var query = {};
			query.user_id = user_id;
			query.article_id = article_id;
			$.ajax({
				url: ajaxurl,
				data: query,
				type: "POST",
				dataType: "json",
				success: function (result) {
					if(result.status==1){
						$('.collect-count').html(parseInt(old_collect_count)+1);
						$('.collect-text').html('已收藏');
						alert('收藏成功！');
					}
					if(result.status==0){
						$('.collect-count').html(parseInt(old_collect_count)-1);
						$('.collect-text').html('收藏');
						alert('取消收藏成功！');
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

	$('.comment-vote-up').on('click', function () {
		var old_vote=$(this).find('.vote-number');
		var old_vote_number=old_vote.html();
		var comment_id=old_vote.attr('rel');

		//ajax支持
		var ajaxurl = "<?php echo BASE_URL;?>index.php?act=articleComment&op=vote";
		var query = {'comment_id':comment_id,'type':'up'};
		$.ajax({
			url: ajaxurl,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(result){
				if(result.status==1){
					old_vote.html(parseInt(old_vote_number)+1);
					alert(result.msg);
					return true;
				}else{
					alert(result.msg);
					return false;
				}
			},error:function(){
				alert('Sorry,fail,unknown reason.');
				return false;
			}
		});
	});
	$('.comment-vote-down').on('click', function () {
		var old_vote=$(this).find('.vote-number');
		var old_vote_number=old_vote.html();
		var comment_id=old_vote.attr('rel');

		//ajax支持
		var ajaxurl = "<?php echo BASE_URL;?>index.php?act=articleComment&op=vote";
		var query = {'comment_id':comment_id,'type':'down'};
		$.ajax({
			url: ajaxurl,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(result){
				if(result.status==1){
					old_vote.html(parseInt(old_vote_number)+1);
					alert(result.msg);
					return true;
				}else{
					alert(result.msg);
					return false;
				}
			},error:function(){
				alert('Sorry,fail,unknown reason.');
				return false;
			}
		});
	});
	$('.comment-complain').on('click', function () {
		if(confirm('确定举报此条评论吗？')){
			var comment_id=$(this).attr('rel');
			//ajax支持
			var ajaxurl = "<?php echo BASE_URL;?>index.php?act=articleComment&op=vote";
			var query = {'comment_id':comment_id,'type':'report'};
			$.ajax({
				url: ajaxurl,
				data:query,
				type: "POST",
				dataType: "json",
				success: function(result){
					if(result.status==1){
						alert(result.msg);
						return true;
					}else{
						alert(result.msg);
						return false;
					}
				},error:function(){
					alert('Sorry,fail,unknown reason.');
					return false;
				}
			});
		}
	});
</script>
