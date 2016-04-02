<?php
/**
 * @doc
 * @filesource menuDefaultStyle.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.07 007
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="menu-list-block clearfix">
		<?php if(count($output['menuArray'])<1){?>
		<?php }?>
		<ul class="common-menu-ul">
			<?php foreach ($output['menuArray'] as $key => $menu) {?>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo $menu['href'];?>" class="common-menu-li-a oneline-all-a">
				<span class="common-menu-ul-span-icon">
					<i style="background-image:url(<?php echo $menu['icon'];?>)" class="common-menu-icon"></i>
				</span>
				<span class="common-menu-ul-span"><?php echo $menu['text'];?><?php if($menu['is_new_function']){?><span class="menu-new">&nbsp;New!</span><?php }?></span>
				<span class="common-menu-ul-span-arrow">
					<i class="arrow-r"></i>
				</span>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</div>
