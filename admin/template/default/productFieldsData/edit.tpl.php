<form action="<?php echo BASE_URL;?>index.php?act=ProductFieldsData&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改产品属性映射</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="attribute_id" readonly value="<?php echo $output['proFieldsData']['id'];?>"></td>
				<th>属性价格</th>
				<td><input type="text" name="fields_price" value="<?php echo $output['proFieldsData']['fields_price'];?>"></td>
			</tr>
			<tr>
				<th>属性ID</th>
				<td>
					<select name="fields_id">
						<option value="0">请选择</option>
						<?php foreach ($output['info'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['proFieldsData']['fields_id']) { ?> selected="selected"<?php  } ?> ><?php echo $value['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>产品ID</th>
				<td>
					<select name="product_id">
						<option value="0">请选择</option>
						<?php foreach ($output['type'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['proFieldsData']['product_id']) { ?> selected="selected"<?php  } ?> ><?php echo $value['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>产品属性值</th>
				<td><input type="text" name="fields_value" value="<?php echo $output['proFieldsData']['fields_value'];?>"></td>
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
