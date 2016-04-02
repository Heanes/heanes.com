<?php
/**
 * @doc 添加借款页面
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
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=borrow&op=add">添加贷款</a></li>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=borrow">贷款列表</a></li>
		</ul>
	</div>
	<div class="data-detail-handle">
		<div class="handle-left">
			<a href="<?php echo BASE_URL; ?>index.php?act=borrow&op=addFromExistsCustomer" class="button-normal button-show">已有客户中选</a>
		</div>
		<div class="handle-right">
			<a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add" class="button-normal button-edit">添加新客户</a>
		</div>
	</div>
</div>

