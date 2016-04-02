<?php
/**
 * @doc 查找用户作为客户
 * @filesource searcheUser.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 09:11:13
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add">搜索用户</a></li>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=customer">客户列表</a></li>
		</ul>
	</div>
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
	<?php  if (isset($output['userList'])){?>
	<!-- S 搜索结果 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<?php if (isset($output['userList']) && !count($output['userList'])) { ?>
					<li class="no-result">无匹配项</li>
				<?php } else {
					foreach ($output['userList'] as $key => $user) { ?>
						<li>
							<a class="block-href" href="<?php echo BASE_URL; ?>index.php?act=customer&op=addFromExistsUser&user_id=<?php echo $user['id'];?>">
								<table class="result-list-table">
									<tbody>
									<tr>
										<td>
											<div style="background-image: url(<?php echo SYS_HOST; ?>data/upload/image/user-avatar/default.png);" class="user-center-avatar"></div>
										</td>
										<td>
											<table class="result-list-table-in-td">
												<tbody>
												<tr>
													<th>用户名：</th>
													<td><?php echo $user['user_name'];?></td>
												</tr>
												<tr>
													<th>手机号：</th>
													<td><?php echo substr_replace($user['mobile'],'****','3','4');  ;?></td>
												</tr>
												<tr>
													<th>身份证号：</th>
													<td><?php echo substr_replace($user['idcard'],'********','3','8');?></td>
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
			window.location = '<?php echo BASE_URL; ?>index.php?act=customer&op=addFromExistsUser&keywords=' + keywords;
		}
	});
</script>