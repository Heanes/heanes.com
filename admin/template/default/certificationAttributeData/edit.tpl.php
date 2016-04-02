<form action="<?php echo BASE_URL;?>index.php?act=CertificationAttributeData&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改认证属性映射</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="attributeData_id" readonly value="<?php echo $output['certificationFieldsData']['id'];?>"></td>
				<th>认证属性值</th>
				<td><input type="text" name="fields_value" value="<?php echo $output['certificationFieldsData']['fields_value'];?>"></td>
			</tr>
			<tr>
				<th>属性ID</th>
				<td>
					<select name="fields_id">
						<option value="0">请选择</option>
						<?php foreach ($output['certificationFieldsList'] as $key => $certificationFields) {?>
						<option value ="<?php echo $certificationFields['id'];?>" <?php if($certificationFields["id"]==$output['certificationFieldsData']['fields_id']) { ?> selected="selected"<?php  } ?> ><?php echo $certificationFields['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>用户ID</th>
				<td>
					<select name="user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['usersList'] as $key => $users) {?>
						<option value ="<?php echo $users['id'];?>" <?php if($users["id"]==$output['certificationFieldsData']['user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $users['user_name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['certificationFieldsData']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
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
