<?php
/**
 * @doc 客户列表页面
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-09 15:03:42
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<!-- S 搜索关键词输入 S -->
	<div class="search-input-block">
		<table class="search-input-table">
			<tbody>
			<tr>
				<th>关键字：</th>
				<td>
					<input type="text" name="keywords" class="input-data input-border-none" placeholder="客户名称/手机号/身份证号" id="user_name" value="<?php if (isset($output['keywords'])) { echo $output['keywords']; } ?>" />
				</td>
			</tr>
			</tbody>
		</table>
		<div class="search-input-handle">
			<input type="submit" class="data-submit-button" id="search_user" value="查询">
		</div>
	</div>
	<!-- E 搜索关键词输入 E -->
	<div class="page-nav-tab">
		<ul>
			<li <?php if (!isset($_REQUEST['status'])){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=checkList">全部</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 0){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=checkList&status=0">待审核</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 1){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=checkList&status=1">已通过</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == -1){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=checkList&status=-1">已拒绝</a></li>
		</ul>
	</div>
	<div class="data-block-list">
		<?php if (!isset($output['customerList']) || !count($output['customerList'])) { ?>
			<div class="result-block">
				<div class="no-result">暂无数据</div>
			</div>
		<?php } else {
			foreach ($output['customerList'] as $key => $customer) { ?>
				<table style="cursor:pointer;" class="data-block-table">
					<thead>
					<tr>
						<th>申请时间：</th>
						<td colspan="4"><?php echo to_date($customer['insert_time']); ?></td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>业务员名称：</th>
						<td><?php echo $customer['user_master']['user_name']; ?></td>
						<th>业务员ID：</th>
						<td><?php echo $customer['user_master']['id']; ?></td>
						<td rowspan="2">
							<span class="data-block-td-arrow">
								<i class="arrow-r"></i>
							</span>
						</td>
					</tr>
					<tr>
						<th>客户姓名：</th>
						<td><?php echo $customer['user_slave']['real_name']; ?></td>
						<th>客户ID：</th>
						<td><?php echo $customer['user_slave']['id']; ?></td>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<td colspan="5">
							<?php if ($customer['status'] == 0) { ?>
								<a href="<?php echo BASE_URL; ?>index.php?act=customer&op=check&id=<?php echo $customer['id']; ?>">
									<button class="button-normal turn-to-check">去审核</button>
								</a>
							<?php } ?>
							<?php if ($customer['status'] != 0) { ?>
								<a href="<?php echo BASE_URL; ?>index.php?act=customer&op=show&id=<?php echo $customer['id']; ?>">
									<button class="button-normal button-show">查看</button>
								</a>
							<?php } ?>
						</td>
					</tr>
					</tfoot>
				</table>
			<?php } ?>
			<!-- S 分页 S -->
			<?php include(TPL.'pager/pagerDefaultStyle.tpl.php'); ?>
			<!-- E 分页 E -->
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
	$('#search_user').on('click', function () {
		var keywords = $('input[name="keywords"]').val();
		if (keywords == '') {
			alert('请输入关键字!');
		} else {
			window.location = '<?php echo BASE_URL; ?>index.php?act=customer&op=checkList&keywords=' + keywords;
		}
	});
</script>