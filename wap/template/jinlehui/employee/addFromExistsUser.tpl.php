<?php
/**
 * @doc 添加部门
 * @filesource add.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 09:26:33
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add">添加兼职</a></li>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=customer">兼职列表</a></li>
		</ul>
	</div>
	<div class="data-edit-block">
		<form action="<?php echo BASE_URL.'index.php?act=employee&op=insert';?>" method="post" id="employee_add_form">
			<table class="data-edit-table">
				<tbody>
				<tr>
					<th>选择用户：<i class="border-one"></i></th>
					<td>
						<input type="text" name="user_id" class="input-data input-border-none" placeholder="请选择用户" required />
						<p class="input-tip input-error-notice">员工不能为空</p>
					</td>
				</tr>
				<tr>
					<th>加入部门：<i class="border-one"></i></th>
					<td>
						<select name="department_id" class="select-normal">
							<option value="0">请选择</option>
							<?php foreach ($output['departmentList'] as $key => $department) {?>
							<option value="<?php echo $department['id'];?>"><?php echo $department['name'];?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th>职位名称：<i class="border-one"></i></th>
					<td>
						<ul class="select-list">
							<!-- @todo 改为商品选择形式，点击后改变样式形成勾选样式 -->
							<?php foreach ($output['jobList'] as $key => $job) {?>
								<li><input type="radio" name="job_id" value="<?php echo $job['id'];?>"><?php echo $job['name'];?></li>
							<?php }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>是否有效：<i class="border-one"></i></th>
					<td>
						<input type="radio" name="is_enable" checked value="1">有效
						<input type="radio" name="is_enable" value="0">无效
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-edit-handle">
				<div class="handle-left">
					<input type="reset" class="data-reset-button" value="清空" />
				</div>
				<div class="handle-right">
					<input type="submit" name="employee_add_form_submit" class="data-submit-button" value="保存" />
				</div>
			</div>
		</form>
	</div>
</div>


