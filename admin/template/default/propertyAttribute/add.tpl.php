<form action="<?php echo BASE_URL;?>index.php?act=PropertyAttribute&op=insert" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">添加财产类型属性</td>
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
				<th>资产类型名称</th>
				<td>
					<select name="property_id">
						<option value="0">请选择</option>
						<?php foreach ($output['info'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>资产属性名称</th>
				<td><input type="text" name="attribute_name" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>输入方式</th>
				<td>
					<select name="input_type">
						<option value="">请选择</option>
						<option value="text">文本框</option>
						<option value="select">下拉框</option>
						<option value="radio">单选按钮</option>
						<option value="checkbox">复选框</option>
					</select>
				</td>
				<th>输入备选值</th>
				<td><input type="text" name="input_value" value="" style="width: 60%;"/></td>
			</tr>
			<tr>
				<th>值的单位</th>
				<td><input type="text" name="value_unit" value="" style="width: 60%;"></td>
				<th>注册/添加时是否显示此项</th>
				<td>
					<input type="radio" name="reg_show" value="1" checked="checked"/>显示
					<input type="radio" name="reg_show" value="0" />不显示
				</td>
			</tr>
			<tr>
				<th>是否必须的</th>
				<td colspan='4'>
					<input type="radio" name="is_required" value="1" checked="checked"/>是
					<input type="radio" name="is_required" value="0" />否
				</td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" checked="checked"/>是
					<input type="radio" name="is_enable" value="0" />否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1"/>是
					<input type="radio" name="is_delete" value="0" checked="checked" />否
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
