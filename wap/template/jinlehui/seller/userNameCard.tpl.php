<?php
/**
 * @doc 用户详情页，模仿微信
 * @filesource userDetail.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-10 13:31:23
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<!-- 顶部用户信息块 -->
	<div class="user-info-block" style="background:none;">
		<div class="user-info-field user-name-card-field">
			<div class="user-name-card-image">
				<a href="<?php if (!empty($output['user']['avatar_src'])) {echo $output['user']['avatar_src'];} else { echo PATH_BASE_PUBLIC;?>static/image/user-avatar/default.png<?php } ?>" class="img-gallery user-name-card-avatar-href">
					<img src="<?php if (!empty($output['user']['avatar_src'])) {echo $output['user']['avatar_src'];} else { echo PATH_BASE_PUBLIC;?>static/image/user-avatar/default.png<?php } ?>" class="user-name-card-avatar">
				</a>
			</div>
			<div class="user-name-card-text">
				<p><?php echo isset($output['user']['nickname']) ? $output['user']['nickname'] : '未定义' ?>&nbsp;</p>
				<p class="unnoticed-text">账户名：<span><?php echo $output['user']['user_name']; ?></span></p>
				<p class="unnoticed-text"><?php if ($output['user']['gender'] == '1') { ?>男<?php } elseif ($output['user']['gender'] == '0') { ?>女<?php } else { ?>保密<?php } ?></p>
			</div>
		</div>
	</div>
	<!-- 信息菜单 -->
	<div class="menu-list-block clearfix user-name-card-menu">
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="javascript:" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span menu-header">地区</span>
					<span class="common-sub-menu-ul-span menu-content"><?php echo !empty($output['user']['province'])? $output['user']['province'] : '北京'; ?>  <?php echo !empty($output['user']['city'])?$output['user']['city']:'海淀'; ?></span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="javascript:" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span menu-header">个性签名</span>
					<span class="common-sub-menu-ul-span menu-content"><?php echo $output['user']['signature']; ?></span>
				</a>
			</li>
			<!--
			<li class="common-menu-oneline-all-li">
				<a href="javascript:" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span menu-header">个人相册</span>
					<span class="common-menu-ul-span-arrow menu-content">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			-->
		</ul>
	</div>
	<div class="handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL; ?>index.php?act=employee&op=introduce&invite=<?php echo $output['user']['id']; ?>" class="long-button user-name-card-apply-button">获取秘笈</a>
		</div>
		<div class="handle-field">
			<a href="<?php echo BASE_URL; ?>index.php?act=product" class="long-button user-name-card-redirect-button">查看金融产品</a>
		</div>
	</div>
	<div style="margin-bottom:100px;"></div>
	<?php include(TPL.'ads/insert_ads_FollowWeiXin.tpl.php');?>
</div>

