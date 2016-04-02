<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=employee&op=insert';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="employee_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th><span class="need">*</span>员工名称</th>
			<td>
			<select name="employee_name" datatype="*" nullmsg="请选择员工名称！">
				<option value="">请选择</option>
				<?php foreach ($output['users'] as $key => $users) {?>
				<option value ="<?php echo $users['id'];?>"><?php echo $users['user_name'];?></option>
				<?php }?>
			</select>
			<span class="Validform_checktip"></span>
			</td>
		</tr>
		<tr>
			<th><span class="need">*</span>部门名称</th>
			<td>
			<select name="department_name" datatype="*" nullmsg="请选择部门名称！">
				<option value="">请选择</option>
				<?php foreach ($output['department'] as $key => $department) {?>
				<option value ="<?php echo $department['id'];?>"><?php echo $department['name'];?></option>
				<?php }?>
			</select>
			<span class="Validform_checktip"></span>
			</td>
			<th><span class="need">*</span>职位名称</th>
			<td>
			<select name="job_name" datatype="*" nullmsg="请选择职位名称！">
				<option value="">请选择</option>
				<?php foreach ($output['job'] as $key => $job) {?>
				<option value ="<?php echo $job['id'];?>"><?php echo $job['name'];?></option>
				<?php }?>
			</select>
			<span class="Validform_checktip"></span>
			</td>
		</tr>
		<tr>
			<th>添加时间</th>
			<td><input type="text" name="employee_insert_time" id="employee_insert_time1" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>更新时间</th>
			<td><input type="text" name="employee_update_time" id="employee_update_time2" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否有效</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked> 是
				<input type="radio" name="is_enable" value="0" > 否
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1"> 是
				<input type="radio" name="is_delete" value="0" checked="checked"> 否
			</td>
		</tr>
		<tr>
			<th><span class="need">*</span>审核状态</th>
			<td colspan='4'>
				<select name="status" datatype="*" nullmsg="请选择审核状态！">
					<option value="">请选择</option>
					<option value="0">审核中</option>
					<option value="1">通过</option>
					<option value="-1">拒绝</option>
				</select>
				<span class="Validform_checktip"></span>
			</td>
		</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=employee';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
<script type="text/javascript">
$(function(){
	$(".submitform").Validform({
		tiptype:3
	});
});
</script>

