<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<!-- 顶部用户信息块 -->
	<div class="user-info-block" onclick="window.location='<?php echo BASE_URL; ?>index.php?act=user&op=detail'">
		<div class="user-info-field user-avatar-field">
			<div class="user-avatar-image">
				<!--<a href="<?php /*if (!empty($output['user']['avatar_src'])) {echo $output['user']['avatar_src'];} else { echo PATH_BASE_PUBLIC;*/?>static/image/user-avatar/default.png<?php /*} */?>" class="img-gallery user-name-card-avatar-href">
					<img src="<?php /*if (!empty($output['user']['avatar_src'])) {echo $output['user']['avatar_src'];} else { echo PATH_BASE_PUBLIC;*/?>static/image/user-avatar/default.png<?php /*} */?>" class="user-name-card-avatar">
				</a>-->
				<img src="<?php if (!empty($output['user']['avatar_src'])) {echo $output['user']['avatar_src'];} else { echo PATH_BASE_PUBLIC;?>static/image/user-avatar/default.png<?php } ?>" class="user-name-card-avatar">
			</div>
			<div class="user-info-text">
				<p><?php echo isset($output['user']['nickname']) ? $output['user']['nickname'] : $output['user']['real_name']; ?>&nbsp;</p>
				<p>账户名：<span><?php echo $output['user']['user_name']; ?></span></p>
				<p class="user-center-role-p"><?php echo $output['user']['_role']['name']; ?> ( ID:<?php echo $output['user']['id']; ?> )</p>
<!--				<p class="user-center-rank-p">金币：--><?php //echo isset($output['user']['_rank']['value'])?$output['user']['_rank']['value']:'0'; ?><!--</p>-->
			</div>
		</div>
		<!-- 充值提现按钮
		<div class="user-info-handle clear-right">
			<a href="" class="button-money-charge button-mini">充值</a>
			<a href="" class="button-money-withdraw button-mini">提现</a>
		</div>
		-->
		<div class="user-info-more">
			<i class="arrow-r"></i>
		</div>
	</div>
	<div class="user-other-info-block">
		<ul class="my-financial-info">
			<li>
				<p class="my-money large-block"><strong>0.00</strong>元</p>
				<p class="mini-block">我的余额</p>
			</li>
			<li>
				<p class="my-red-packet large-block"><strong><?php echo isset($output['user']['_rank']['value'])?$output['user']['_rank']['value']:'0'; ?></strong>个</p>
				<p class="mini-block">我的金币</p>
			</li>
			<li>
				<p class="my-rank large-block"><strong><?php echo isset($output['user']['_rank']['value'])?$output['user']['_rank']['value']:'0'; ?></strong>分</p>
				<p class="mini-block">我的积分</p>
			</li>
		</ul>
	</div>
	<div class="service-operate-block clearfix">
		<?php if (isset($output['defaultMenuArray']) && is_array($output['defaultMenuArray']) && count($output['defaultMenuArray'])) { ?>
			<?php foreach ($output['defaultMenuArray'] as $key => $sub_menu) { ?>
				<?php if (is_array($sub_menu) && count($sub_menu)) { ?>
					<ul class="common-menu-ul">
						<?php foreach ($sub_menu as $sub_key => $menu) { ?>
							<li class="common-menu-oneline-all-li">
								<a href="<?php echo BASE_URL; ?>index.php?act=<?php echo $menu['act']; if (!empty($menu['op'])) { ?>&op=<?php echo $menu['op']; } ?>" class="common-menu-li-a oneline-all-a">
									<span class="common-menu-ul-span-icon"><i style="background-image:url(<?php echo $menu['icon'] ?>)" class="common-menu-icon"></i></span>
									<span class="common-menu-ul-span"><?php echo $menu['text'] ?><?php if($menu['is_new_function']){?><span class="menu-new">&nbsp;New!</span><?php }?></span>
									<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			<?php } ?>
		<?php } ?>
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=menu&op=collect" class="common-menu-li-a oneline-all-a">
					<span class="common-menu-ul-span-icon"><i style="background-image:url(image/menu-icon/style2/collect.png)" class="common-menu-icon"></i></span>
					<span class="common-menu-ul-span">收藏管理</span>
					<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=menu&op=service" class="common-menu-li-a oneline-all-a">
					<span class="common-menu-ul-span-icon"><i style="background-image:url(image/menu-icon/style2/help.png)" class="common-menu-icon"></i></span>
					<span class="common-menu-ul-span">帮助中心</span>
					<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=setting" class="common-menu-li-a oneline-all-a">
					<span class="common-menu-ul-span-icon"><i style="background-image:url(image/menu-icon/style2/setting.png)" class="common-menu-icon"></i></span>
					<span class="common-menu-ul-span">设置</span>
					<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
				</a>
			</li>
		</ul>
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=member&op=loginOut" class="common-menu-li-a oneline-all-a">
					<span class="common-menu-ul-span" style="text-align:center;color:red">退出登录</span>
				</a>
			</li>
		</ul>
	</div>
</div>
