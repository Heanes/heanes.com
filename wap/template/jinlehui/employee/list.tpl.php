<?php
/**
 * @doc 员工列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:41:08
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL;?>index.php?act=employee">金鹰列表</a></li>
			<li><a href="<?php echo BASE_URL;?>index.php?act=employee&op=add">添加金鹰</a></li>
		</ul>
	</div>
	<!-- S 列表展示 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<?php if(!count($output['employee_list'])){?>
				<li class="no-result">暂无数据</li>
				<?php }else{
					foreach ($output['employee_list'] as $key => $employee) {?>
				<li>
					<a class="block-href" href="<?php echo BASE_URL;?>index.php?act=employee&op=edit&id=<?php echo $employee['id'];?>">
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
											<th>员工名称：</th>
											<td><?php echo $employee['user_name'];?></td>
										</tr>
										<tr>
											<th>员工职位：</th>
											<td><?php echo $employee['job_name'];?></td>
										</tr>
										<tr>
											<th>所在部门：</th>
											<td><?php echo $employee['department_name'];?></td>
										</tr>
										<tr>
											<th>入职时间：</th>
											<td><?php echo to_date($employee['create_time']);?></td>
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
				<?php }}?>
			</ul>
		</div>
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php');?>
		<!-- E 分页 E -->
	</div>
	<!-- E 列表展示 E -->
</div>

