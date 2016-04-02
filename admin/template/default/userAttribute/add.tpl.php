<form action="<?php echo BASE_URL;?>index.php?act=UserAttribute&op=insert" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户额外属性</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value=""></td>
			</tr>
			<tr>
				<th>注册项名称</th>
				<td><input type="text" name="attribute_name" value="" style="width:60%;"></td>
				<th>注册项输入类型</th>
				<td><input type="text" name="input_type" value="" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>注册时是否显示此项</th>
				<td>
					<input type="radio" name="add_show" value="1" checked="checked"> 是
					<input type="radio" name="add_show" value="0"> 否
				</td>
				<th>是否必须的</th>
				<td>
					<input type="radio" name="is_required" value="1" checked="checked">是
					<input type="radio" name="is_required" value="0">否
				</td>
			</tr>
			<tr>
				<th>插入时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date('now');?>" placeholder="选择插入时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td colspan="4">
					<input type="radio" name="is_enable" value="1" checked="checked"/>是
					<input type="radio" name="is_enable" value="0" />否
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
