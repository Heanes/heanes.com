<form action="<?php echo BASE_URL;?>index.php?act=PropertyAttribute&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改财产类型属性</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="attribute_id" readonly value="<?php echo $output['propertyFields']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['propertyFields']['order'];?>"></td>
			</tr>
			<tr>
				<th>资产类型名称</th>
				<td>
					<select name="property_id">
						<option value="0">请选择</option>
						<?php foreach ($output['type'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['propertyFields']["property_id"]) { ?> selected="selected"<?php  } ?> ><?php echo $value['name'];?></option>
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
						<option value="text" <?php if($output['propertyFields']['input_type']=="text") { ?> selected="selected"<?php  } ?>>文本框</option>
						<option value="select" <?php if($output['propertyFields']['input_type']=="select") { ?> selected="selected"<?php  } ?>>下拉框</option>
						<option value="radio" <?php if($output['propertyFields']['input_type']=="radio") { ?> selected="selected"<?php  } ?>>单选按钮</option>
						<option value="checkbox" <?php if($output['propertyFields']['input_type']=="checkbox") { ?> selected="selected"<?php  } ?>>复选框</option>
					</select>
				</td>
				<th>输入备选值</th>
				<td><input type="text" name="input_value" value="<?php echo $output['propertyFields']['input_value'];?>" style="width: 60%;"/></td>
			</tr>
			<tr>
				<th>值的单位</th>
				<td><input type="text" name="value_unit" value="<?php echo $output['propertyFields']['value_unit'];?>" style="width: 60%;"/></td>
				<th>注册/添加时是否显示此项</th>
				<td>
					<input type="radio" name="reg_show" value="1" <?php if($output['propertyFields']['reg_show']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="reg_show" value="0" <?php if($output['propertyFields']['reg_show']==0){?>checked="checked" <?php }?>> 不显示
				</td>
			</tr>
			<tr>
				<th>是否必须的</th>
				<td colspan='4'>
					<input type="radio" name="is_required" value="1" <?php if($output['propertyFields']['is_required']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_required" value="0" <?php if($output['propertyFields']['is_required']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>	
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['propertyFields']['insert_time']);?>"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" id="reg_time1" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['propertyFields']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['propertyFields']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['propertyFields']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['propertyFields']['is_delete']==0){?>checked="checked" <?php }?>> 否
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
