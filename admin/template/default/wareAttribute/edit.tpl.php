<form action="<?php echo BASE_URL;?>index.php?act=WareAttribute&op=update" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改物品属性</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="attribute_id" readonly value="<?php echo $output['wareFields']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['wareFields']['order'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>类型名称</th>
				<td>
					<select name="type_id" datatype="*" nullmsg="请选择类型名称！">
						<option value="">请选择</option>
						<?php foreach ($output['wareTypeList'] as $key => $wareType) {?>
						<option value ="<?php echo $wareType['id'];?>" <?php if($wareType["id"]==$output['wareFields']['type_id']) { ?> selected="selected"<?php  } ?> ><?php echo $wareType['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
				<th><span class="need">*</span>属性名称</th>
				<td><textarea class="editor_id2" name="attribute_name"><?php echo $output['wareFields']['name'];?></textarea>
				 	<span class="Validform_checktip" style="position: relative;"></span>
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor.js"></script>
					<script charset="utf-8" src="<?php echo SYS_HOST; ?>public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
					<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('.editor_id2', {
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
			<tr>
				<th><span class="need">*</span>属性输入类型</th>
				<td>
					<select name="input_type" datatype="*" nullmsg="请选择属性输入类型！">
						<option value="">请选择</option>
						<option value="text" <?php if($output['wareFields']['input_type']=="text") { ?> selected="selected"<?php  } ?>>文本框</option>
						<option value="select" <?php if($output['wareFields']['input_type']=="select") { ?> selected="selected"<?php  } ?>>下拉框</option>
						<option value="textarea" <?php if($output['wareFields']['input_type']=="textarea") { ?> selected="selected"<?php  } ?>>文本域</option>
					</select>
					<span class="Validform_checktip"></span>
				</td>
				<th>输入备选值</th>
				<td><input type="text" name="input_value" value="<?php echo $output['wareFields']['input_value'];?>"/></td>
			</tr>
			<tr>
				<th>允许上传的文件类型</th>
				<td><input type="text" name="accept_type" value="<?php echo $output['wareFields']['accept_type'];?>"/></td>
				<th>值的单位</th>
				<td><input type="text" name="value_unit" value="<?php echo $output['wareFields']['value_unit'];?>"></td>
			</tr>
			<tr>
				<th>是否必须的</th>
				<td>
					<input type="radio" name="is_required" value="1" <?php if($output['wareFields']['is_required']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_required" value="0" <?php if($output['wareFields']['is_required']==0){?>checked="checked" <?php }?>/>否
				</td>
				<th>是否作为筛选条件</th>
				<td>
					<input type="radio" name="as_filter" value="1" <?php if($output['wareFields']['as_filter']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="as_filter" value="0" <?php if($output['wareFields']['as_filter']==0){?>checked="checked" <?php }?>/>否
				</td>
			</tr>
			<tr>
				<th>是否显示在详细页</th>
				<td>
					<input type="radio" name="is_show" value="1" <?php if($output['wareFields']['is_show']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_show" value="0" <?php if($output['wareFields']['is_show']==0){?>checked="checked" <?php }?>/>否
				</td>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['wareFields']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['wareFields']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['wareFields']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['wareFields']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>允许查看的最小角色ID</th>
				<td>
					<select name="allow_read_min_role_level">
						<option value="">请选择</option>
						<?php foreach ($output['userRole'] as $key => $userRole) {?>
							<option value ="<?php echo $userRole['id'];?>" <?php if($userRole["id"]==$output['wareFields']['allow_read_min_role_level']) { ?> selected="selected"<?php  } ?>><?php echo $userRole['id'];?>—<?php echo $userRole['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr style="border:1px solid #ccc;">
				<th style="width:120px;">允许查看的角色名称</th>
				<td colspan="4" style="border:1px solid #ccc;">
					<?php foreach ($output['userRole'] as $key => $userRole) {?>
						<div style="width:150px;float:left;">
							<input class="checkbox" type="checkbox" <?php if(in_array($userRole['id'],$output['newAllowReadRole'])){?> checked <?php }?> value="<?php echo $userRole['id']?>" name="allow_read_role[]">
							<?php echo $userRole['name']?>
						</div>
					<?php }?>
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