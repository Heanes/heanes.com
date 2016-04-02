<?php
/**
 * @doc 从已有用户中选择添加客户
 * @filesource addFromExistsUser.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 11:02:17
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=customer">客户列表</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add">添加客户</a></li>
		</ul>
	</div>
	<?php if(isset($output['user'])){?>
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<li>
					<a class="block-href" href="<?php echo BASE_URL; ?>index.php?act=customer&op=addFromExistsUser&user_id=<?php echo $user['id']; ?>">
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
											<td><?php echo $user['user_name']; ?></td>
										</tr>
										<tr>
											<th>手机号：</th>
											<td><?php echo substr_replace($user['mobile'], '****', '3', '4');; ?></td>
										</tr>
										<tr>
											<th>身份证号：</th>
											<td><?php echo substr_replace($user['idcard'], '********', '3', '8'); ?></td>
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
	<?php }?>
</div>


