<form action="<?php echo BASE_URL;?>index.php?act=UserCertification&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户认证</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="usercer_id" readonly value="<?php echo $output['Usercertification']['id'];?>"></td>
				<th>用户ID</th>
				<td>
					<select name="user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['usersList'] as $key => $users) {?>
						<option value ="<?php echo $users['id'];?>" <?php if($users["id"]==$output['Usercertification']['user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $users['user_name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>认证类型ID</th>
				<td>
					<select name="type_id">
						<option value="0">请选择</option>
						<?php foreach ($output['certificationTypeList'] as $key => $certificationType) {?>
						<option value ="<?php echo $certificationType['id'];?>" <?php if($certificationType["id"]==$output['Usercertification']['type_id']) { ?> selected="selected"<?php  } ?> ><?php echo $certificationType['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>申请审核留言</th>
				<td><input type="text" name="message" value="<?php echo $output['Usercertification']['message'];?>"></td>
			</tr>
			<tr>
				<th>申请认证时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['Usercertification']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>认证状态</th>
				<td colspan='4'>
					<select name="status">
						<option value="">请选择</option>
						<option value ="0" <?php if($output['Usercertification']['status']=="0") { ?> selected="selected"<?php  } ?>>审核中</option>
						<option value ="1" <?php if($output['Usercertification']['status']=="1") { ?> selected="selected"<?php  } ?>>已通过验证</option>
						<option value ="-1" <?php if($output['Usercertification']['status']=="-1") { ?> selected="selected"<?php  } ?>>未通过验证</option>
					</select>
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
