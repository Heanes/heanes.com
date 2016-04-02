<?php
/**
 * @doc
 * @filesource add.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015/7/13 0:08
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add">添加客户</a></li>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=customer">客户列表</a></li>
		</ul>
	</div>
	<div class="data-detail-handle">
		<div class="handle-left">
			<a href="<?php echo BASE_URL; ?>index.php?act=customer&op=addFromExistsUser" class="button-normal button-show">注册用户中选</a>
		</div>
		<div class="handle-right">
			<a href="<?php echo BASE_URL; ?>index.php?act=customer&op=addFromNewUser" class="button-normal button-edit">添加新用户</a>
		</div>
	</div>
</div>

