<form action="<?php echo BASE_URL;?>index.php?act=UserPropertyData&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户额外注册项数据</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="mapped_id" readonly value="<?php echo $output['userPropertyData']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['userPropertyData']['order'];?>"></td>
			</tr>
			<tr>
				<th>用户ID</th>
				<td>
					<select name="user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['type'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['userPropertyData']['user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $value['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>财产类型属性ID</th>
				<td>
					<select name="fields_id">
						<option value="0">请选择</option>
						<?php foreach ($output['info'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['userPropertyData']['fields_id']) { ?> selected="selected"<?php  } ?> ><?php echo $value['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>财产属性值</th>
				<td colspan='4'><input type="text" name="fields_value" value="<?php echo $output['userPropertyData']['fields_value'];?>" style="width: 25%;"></td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date($output['userPropertyData']['create_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" id="reg_time1" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
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
