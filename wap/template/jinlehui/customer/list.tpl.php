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
					<input type="text" name="keywords" class="input-data input-border-none" placeholder="客户名称/手机号/身份证号" id="user_name" value="<?php if(isset($output['keywords'])){echo $output['keywords']; }?>" />
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
			<li <?php if (!isset($_REQUEST['status'])){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer">全部</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 1){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&status=1">已通过</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 0){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&status=0">审核中</a></li>
			<li <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == -1){ ?>class="active" <?php } ?>><a href="<?php echo BASE_URL; ?>index.php?act=customer&status=-1">已拒绝</a></li>
		</ul>
	</div>
	<!-- S 搜索结果 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<?php if (!count($output['customerList'])) { ?>
					<li class="no-result">暂无数据</li>
				<?php } else {
					foreach ($output['customerList'] as $key => $customer) { ?>
						<li>
							<a class="block-href" href="<?php echo BASE_URL; ?>index.php?act=customer&op=show&id=<?php echo $customer['id'] ?>">
								<table class="result-list-table">
									<tbody>
									<tr>
										<td>
											<div style="background-image: url(<?php echo PATH_BASE_PUBLIC ?>static/image/user-avatar/default.png);"
												 class="user-center-avatar"></div>
										</td>
										<td>
											<table class="result-list-table-in-td">
												<tbody>
												<tr>
													<th>ID：</th>
													<td><?php echo $customer['user']['id']; ?></td>
												</tr>
												<tr>
													<th>姓名：</th>
													<td><?php echo $customer['user']['real_name']; ?></td>
												</tr>
												<tr>
													<th>手机号：</th>
													<td><?php echo $customer['user']['mobile']; ?></td>
												</tr>
												<tr>
													<th>身份证号：</th>
													<td><?php echo $customer['user']['idcard']; ?></td>
												</tr>
												<tr>
													<th>添加时间：</th>
													<td><?php echo to_date($customer['create_time']); ?></td>
												</tr>
												</tbody>
											</table>
										</td>
										<td>
											<i class="arrow-r"></i>
										</td>
									</tr>
									</tbody>
								</table>
							</a>
						</li>
					<?php }
				} ?>
			</ul>
		</div>
	</div>
	<!-- E 搜索结果 E -->
	<?php include(TPL.'pager/pagerDefaultStyle.tpl.php');?>
</div>
<script type="text/javascript">
	$('#search_user').on('click', function () {
		var keywords = $('input[name="keywords"]').val();
		if (keywords == '') {
			alert('请输入关键字');
		} else {
			window.location = '<?php echo BASE_URL; ?>index.php?act=customer&op=search&keywords=' + keywords;
		}
	});
</script>

