<?php
/**
 * @doc 搜索页
 * @filesource searcheUser.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 09:11:13
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
					<input type="text" name="keywords" class="input-data input-border-none" placeholder="请输入身份证号" id="user_name" value="<?php if(isset($output['keywords'])){echo $output['keywords']; }?>" />
				</td>
			</tr>
			</tbody>
		</table>
		<div class="search-input-handle">
			<input type="submit" class="data-submit-button" id="search_user" value="查询">
		</div>
	</div>
	<!-- E 搜索关键词输入 E -->
	<?php  if (isset($output['userList'])){?>
	<!-- S 搜索结果 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<?php if (isset($output['userList']) && !count($output['userList']) && isset($_GET['keywords'])) { ?>
					<li class="no-result">无匹配项</li>
				<?php } else {
					foreach ($output['userList'] as $key => $user) { ?>
						<li>
							<a class="block-href" href="<?php echo BASE_URL; ?>index.php?act=borrow&op=show&id=<?php echo $user['id'];?>">
								<table class="result-list-table">
									<tbody>
									<tr>
										<td>
											<div style="background-image: url(<?php echo PATH_BASE_PUBLIC; ?>static/image/user-avatar/default.png);" class="user-center-avatar"></div>
										</td>
										<td>
											<table class="result-list-table-in-td">
												<tbody>
												<tr>
													<th>ID：</th>
													<td><?php echo $user['id']; ?></td>
												</tr>
												<tr>
													<th>用户名：</th>
													<td><?php echo $user['user_name']; ?></td>
												</tr>
												<tr>
													<th>姓名：</th>
													<td><?php echo $user['real_name']; ?></td>
												</tr>
												<tr>
													<th>手机号：</th>
													<td><?php echo $user['mobile']; ?></td>
												</tr>
												<tr>
													<th>身份证号：</th>
													<td><?php echo $user['idcard']; ?></td>
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
	<?php }?>
</div>
<script type="text/javascript">
	$('#search_user').on('click', function () {
		var keywords = $('input[name="keywords"]').val();
		if (keywords == '') {
			alert('请输入关键字!');
		} else {
			window.location = '<?php echo BASE_URL; ?>index.php?act=borrow&op=search&keywords=' + keywords;
		}
	});
</script>