<?php
/**
 * @doc 修改操作
 * @filesource edit.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 09:42:04
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL;?>index.php?act=department">部门列表</a></li>
			<li><a href="<?php echo BASE_URL;?>index.php?act=department&op=add">添加部门</a></li>
			<li class="active"><a href="javascript:">修改部门</a></li>
		</ul>
	</div>
	<div class="data-edit-block">
		<form action="<?php echo BASE_URL.'index.php?act=department&op=update';?>" method="post" id="department_edit_form">
			<table class="data-edit-table">
				<tbody>
				<tr>
					<th>ID：<i class="border-one"></i></th>
					<td>
						<input type="text" name="department_id" value="<?php echo $output['department']['id']; ?>" class="input-data input-border-none readonly" readonly />
					</td>
				</tr>
				<tr>
					<th>部门名称：<i class="border-one"></i></th>
					<td>
						<input type="text" name="department_name" value="<?php echo $output['department']['name']; ?>" class="input-data input-border-none" placeholder="请填写部门名称" required />
						<p class="input-tip input-error-notice">部门名称不能为空</p>
					</td>
				</tr>
				<tr>
					<th>所属上级部门：<i class="border-one"></i></th>
					<td>
						<select name="department_pid" class="select-normal">
							<option value="0">请选择</option>
							<?php foreach ($output['departmentList'] as $key => $department) {?>
								<option value="<?php echo $department['id']?>" <?php if($department['id']==$output['department']['pid']){?>selected<?php }?>><?php echo $department['name']?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th>最高管理职位：<i class="border-one"></i></th>
					<td>
						<select name="manager_job_id" class="select-normal">
							<option value="0">请选择</option>
							<?php foreach ($output['jobList'] as $key => $job) {?>
								<option value="<?php echo $job['id']?>" <?php if($job['id']==$department['manager_job_id']){?>selected<?php }?>><?php echo $job['name']?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th>部门代码：<i class="border-one"></i></th>
					<td>
						<input type="text" name="department_english_name" value="<?php echo $output['department']['english_name']; ?>" class="input-data input-border-none" placeholder="部门代码可以不填" />
					</td>
				</tr>
				<tr>
					<th>部门介绍：<i class="border-one"></i></th>
					<td>
						<textarea name="department_description" rows="8" class="data-textarea" placeholder="填写部门介绍" ><?php echo $output['department']['description'];?></textarea>
					</td>
				</tr>
				<tr>
					<th>是否有效：<i class="border-one"></i></th>
					<td>
						<input type="radio" name="is_enable" value="1" <?php if($output['department']['is_enable']==1){?>checked="true"<?php } ?>>有效
						<input type="radio" name="is_enable" value="0" <?php if($output['department']['is_enable']!=1){?>checked="true"<?php } ?>>无效
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-edit-handle">
				<div class="handle-left">
					<button class="data-reset-button" onclick="history.go(-1)">返回</button>
				</div>
				<div class="handle-right">
					<input type="submit" name="department_edit_form_submit" class="data-submit-button" value="保存" />
				</div>
			</div>
		</form>
	</div>
</div>


