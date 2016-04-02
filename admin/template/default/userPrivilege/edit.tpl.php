<form action="<?php echo BASE_URL;?>index.php?act=UserPrivilege&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户权限</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="id" readonly value="<?php echo $output['userPrivilege']['id'];?>"></td>
				<th>权限名称</th>
				<td>
					<select name="privilege_id" class="select-normal">
						<option value="0">请选择</option>
						<?php foreach ($output['privilegeUrl_List'] as $key => $privilegeUrl_List) {?>
							<option value="<?php echo $privilegeUrl_List['id']?>" <?php if($privilegeUrl_List['id']==$output['userPrivilege']['privilege_id']){?>selected<?php }?>><?php echo $privilegeUrl_List['name']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>角色名称</th>
				<td colspan='4'>
					<select name="role_id" class="select-normal">
						<option value="0">请选择</option>
						<?php foreach ($output['roleUrl_List'] as $key => $roleUrl_List) {?>
							<option value="<?php echo $roleUrl_List['id']?>" <?php if($roleUrl_List['id']==$output['userPrivilege']['role_id']){?>selected<?php }?>><?php echo $roleUrl_List['name']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['userPrivilege']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['userPrivilege']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['userPrivilege']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['userPrivilege']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['userPrivilege']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="javascript:history.go(-1)" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
