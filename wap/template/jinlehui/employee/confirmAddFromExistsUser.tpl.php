<?php
/**
 * @doc 询问是否添加此用户为客户
 * @filesource confirmAddFromExistsUser.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 09:11:13
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=employee">客户列表</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=employee&op=add">添加客户</a></li>
		</ul>
	</div>
	<!-- E 搜索关键词输入 E -->
	<?php if (isset($output['user'])) { ?>
		<!-- S 搜索结果 S -->
		<div class="search-result-list-block">
			<div class="result-block">
				<ul class="result-block-ul default-background">
					<li>
						<a class="block-href" href="<?php echo BASE_URL; ?>index.php?act=employee&op=addFromExistsUser&user_id=<?php echo $output['user']['id']; ?>">
							<table class="result-list-table">
								<tbody>
								<tr>
									<td>
										<div style="background-image: url(<?php echo SYS_HOST; ?>data/upload/image/user-avatar/default.png);"
											 class="user-center-avatar"></div>
									</td>
									<td>
										<table class="result-list-table-in-td">
											<tbody>
											<tr>
												<th>用户名：</th>
												<td><?php echo $output['user']['user_name']; ?></td>
											</tr>
											<tr>
												<th>手机号：</th>
												<td><?php echo substr_replace($output['user']['mobile'], '****', '3', '4');; ?></td>
											</tr>
											<tr>
												<th>身份证号：</th>
												<td><?php echo substr_replace($output['user']['idcard'], '********', '3', '8'); ?></td>
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
				</ul>
			</div>
		</div>
		<!-- E 搜索结果 E -->
		<div class="operate-result">
			<div class="operate-result-fail">
				<div class="operate-result-title">
					<h3>提示</h3>
				</div>
				<div class="operate-result-text-content">
					<p>确定将此用户添加为兼职吗？</p>
				</div>
				<form action="<?php echo BASE_URL; ?>index.php?act=employee&op=_addFromExistsUser" method="post">
					<div class="operate-result-jump">
						<ul class="jump-ul">
							<li>
								<a class="button-normal jump-button-normal button-ok" href="javascript:history.go(-1);">取消</a>
							</li>
							<li>
								<input type="hidden" name="uid_slave" value="<?php echo $output['user']['id']; ?>">
								<input class="button-normal jump-button-normal button-ok" type="submit" value="确定" />
							</li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>
</div>