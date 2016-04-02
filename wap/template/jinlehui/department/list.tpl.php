<?php
/**
 * @doc 列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 09:42:20
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL;?>index.php?act=department">部门列表</a></li>
			<li><a href="<?php echo BASE_URL;?>index.php?act=department&op=add">添加部门</a></li>
		</ul>
	</div>
	<!-- S 列表展示 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<?php if(!count($output['departmentList'])){?>
					<li class="no-result">暂无数据</li>
				<?php }else{
					foreach ($output['departmentList'] as $key => $department) {?>
				<li>
					<a class="block-href" href="<?php echo BASE_URL;?>index.php?act=department&op=edit&id=<?php echo $department['id'];?>">
						<table class="result-list-table">
							<tbody>
							<tr>
								<td>
									<div style="background-image: url(<?php echo PATH_BASE_PUBLIC; ?>static/image/department/default.png);" class="user-center-avatar"></div>
								</td>
								<td>
									<table class="result-list-table-in-td">
										<tbody>
										<tr>
											<th>部门名称：</th>
											<td><?php echo $department['name'];?></td>
										</tr>
										<tr>
											<th>部门人数：</th>
											<td><?php echo $department['employee_count'];?></td>
										</tr>
										<tr>
											<th>部门管理：</th>
											<td>
												<?php if(isset($department['manager']) && count($department['manager'])){
													foreach ($department['manager'] as $k => $manager) {?>
														<strong><?php echo $manager['user_name'];?></strong>
													<?php }?>
												<?php }?>
											</td>
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


