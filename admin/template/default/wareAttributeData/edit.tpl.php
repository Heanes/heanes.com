<form action="<?php echo BASE_URL;?>index.php?act=WareAttributeData&op=update" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改物品属性映射</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="attribute_id" readonly value="<?php echo $output['wareFieldsData']['id'];?>"></td>
				<th>属性价格</th>
				<td><input type="text" name="fields_price" value="<?php echo $output['wareFieldsData']['fields_price'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>属性名称</th>
				<td>
					<select name="fields_id" datatype="*" nullmsg="请选择属性名称！">
						<option value="">请选择</option>
						<?php foreach ($output['wareFieldsList'] as $key => $wareFields) {?>
						<option value ="<?php echo $wareFields['id'];?>" <?php if($wareFields["id"]==$output['wareFieldsData']['fields_id']) { ?> selected="selected"<?php  } ?> ><?php echo $wareFields['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
				<th><span class="need">*</span>物品名称</th>
				<td>
					<select name="ware_id" datatype="*" nullmsg="请选择物品名称！">
						<option value="">请选择</option>
						<?php foreach ($output['wareList'] as $key => $ware) {?>
						<option value ="<?php echo $ware['id'];?>" <?php if($ware["id"]==$output['wareFieldsData']['ware_id']) { ?> selected="selected"<?php  } ?> ><?php echo $ware['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>物品属性值</th>
				<td colspan="4">
					<textarea class="editor_id1" name="fields_value"><?php echo $output['wareFieldsData']['fields_value'];?></textarea>
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor.js"></script>
					<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('.editor_id1', {
								resizeType : 1,
								allowPreviewEmoticons : false,
								autoHeightMode : true,
								allowImageUpload : false,
								minWidth : 465,
								minHeight : 35,
								items : [
									"source","fontname", "fontsize", "|", "forecolor", "hilitecolor", "bold", "italic", "underline",
									"removeformat", "|", "justifyleft", "justifycenter", "justifyright", "insertorderedlist",
									"insertunorderedlist", "|", "emoticons", "image", "link"]
							});
						});
					</script>
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
<script type="text/javascript">
$(function(){
	$(".submitform").Validform({
		tiptype:3
	});
});
</script>