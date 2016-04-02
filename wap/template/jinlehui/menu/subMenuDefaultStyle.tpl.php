<?php
/**
 * @doc 子菜单，菜单前无图标
 * @filesource subMenuDefaultStyle.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.10 010
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="menu-list-block clearfix">
		<?php if (isset($output['menuArray']) && is_array($output['menuArray']) && count($output['menuArray'])) { ?>
			<?php if(is_array($output['menuArray'][0][0])){?>
				<?php foreach ($output['menuArray'] as $key => $sub_menu) { ?>
					<?php if (is_array($sub_menu) && is_array($sub_menu[0]) && count($sub_menu)) { ?>
						<ul class="common-menu-ul">
							<?php foreach ($sub_menu as $sub_key => $menu) { ?>
								<li class="common-menu-oneline-all-li">
									<a href="<?php echo $menu['href'];?>" class="common-sub-menu-li-a oneline-all-a">
										<span class="common-sub-menu-ul-span"><?php echo $menu['text'];?>11</span>
										<span class="common-menu-ul-span-arrow">
											<i class="arrow-r"></i>
										</span>
									</a>
								</li>
							<?php } ?>
						</ul>
					<?php }?>
				<?php }?>
			<?php }else{?>
				<ul class="common-menu-ul">
					<?php foreach ($output['menuArray'] as $key => $menu) {?>
						<li class="common-menu-oneline-all-li">
							<a href="<?php echo $menu['href'];?>" class="common-sub-menu-li-a oneline-all-a">
								<span class="common-sub-menu-ul-span"><?php echo $menu['text'];?><?php if($menu['is_new_function']){?><span class="menu-new">&nbsp;New!</span><?php }?></span>
								<span class="common-menu-ul-span-arrow">
									<i class="arrow-r"></i>
								</span>
							</a>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		<?php } ?>
	</div>
</div>

