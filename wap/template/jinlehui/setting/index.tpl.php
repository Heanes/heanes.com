<?php
/**
 * @doc 设置页面
 * @filesource index.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-23 22:37:36
 */
defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<div class="menu-list-block clearfix">
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL;?>index.php?act=setting&op=account" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">帐号与安全</span>
					<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
				</a>
			</li>
		</ul>
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL;?>index.php?act=setting&op=systemAbout" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">关于</span>
					<span class="common-menu-ul-span-arrow"><i class="arrow-r"></i></span>
				</a>
			</li>
		</ul>
	</div>
</div>

