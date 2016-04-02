<?php
/**
 * @doc 修改员工
 * @filesource edit.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 09:26:33
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL;?>index.php?act=employee">员工列表</a></li>
			<li><a href="<?php echo BASE_URL;?>index.php?act=employee&op=add">添加员工</a></li>
			<li class="active"><a href="javascript:">修改员工</a></li>
		</ul>
	</div>
	<div class="data-edit-block">
		<form action="<?php echo BASE_URL.'index.php?act=employee&op=update';?>" method="post" id="employee_add_form">
			<table class="data-edit-table">
				<tbody>
				<tr>
					<th>ID：<i class="border-one"></i></th>
					<td>
						<input type="text" name="employee_id" value="<?php echo $output['employee']['id']; ?>" class="input-data input-border-none readonly" readonly />
					</td>
				</tr>
				<tr>
					<th>员工名称：<i class="border-one"></i></th>
					<td>
						<input type="text" name="user_id" class="input-data input-border-none" value="<?php echo $output['employee']['user_name']?>" disabled />
					</td>
				</tr>
				<tr>
					<th>加入部门：<i class="border-one"></i></th>
					<td>
						<select name="department_id" class="select-normal">
							<option value="0">请选择</option>
							<?php foreach ($output['departmentList'] as $key => $department) {?>
								<option value="<?php echo $department['id'];?>" <?php if($output['employee']['job_id']==$department['id']) { ?>selected="selected" <?php }?>><?php echo $department['name'];?></option>
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
								<li><input type="radio" name="job_id" value="<?php echo $job['id'];?>" <?php if($output['employee']['job_id']==$job['id']) { ?>checked<?php }?>><?php echo $job['name'];?></li>
							<?php }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>是否有效：<i class="border-one"></i></th>
					<td>
						<input type="radio" name="is_enable" value="1" <?php if($output['employee']['is_enable']==1) {?>checked<?php }?>>有效
						<input type="radio" name="is_enable" value="0" <?php if($output['employee']['is_enable']==0) {?>checked<?php }?>>无效
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-edit-handle">
				<div class="handle-left">
					<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
				</div>
				<div class="handle-right">
					<input type="submit" name="employee_add_form_submit" class="data-submit-button" value="保存" />
				</div>
			</div>
		</form>
	</div>
</div>


