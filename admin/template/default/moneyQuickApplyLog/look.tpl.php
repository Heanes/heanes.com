<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="moneyQuickApplyLog_id" readonly value="<?php echo $output['moneyQuickApplyLog_list']['id'];?>"></td>
			<th>申请ID</th>
			<td><a href="<?php echo BASE_URL;?>index.php?act=moneyQuickApply&op=edit&id=<?php echo $output['moneyQuickApplyLog_list']['apply_id'];?>"><?php echo $output['moneyQuickApplyLog_list']['apply_id'];?></a></td>
		</tr>
		<tr>
			<th>处理者用户名称</th>
			<td><input type="text" name="actor_user_id" value="<?php echo $output['moneyQuickApplyLog_list']['actor_user_name'];?>"></td>
			<th>处理结果</th>
			<td>
				<select name="handle_result">
					<option value="">请选择</option>
					<option value="0" <?php if($output['moneyQuickApplyLog_list']['handle_result']=="0") { ?> selected="selected"<?php  } ?>>未知</option>
					<option value="1" <?php if($output['moneyQuickApplyLog_list']['handle_result']=="1") { ?> selected="selected"<?php  } ?>>符合要求</option>
					<option value="2" <?php if($output['moneyQuickApplyLog_list']['handle_result']=="2") { ?> selected="selected"<?php  } ?>>不符合要求</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>处理结果备注</th>
			<td style="height:76px;width:465px;"><textarea class="editor_id2" name="handle_desc"><?php echo $output['moneyQuickApplyLog_list']['handle_desc'];?></textarea>
				<span class="Validform_checktip"></span>
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
			<th>日志说明</th>
			<td><input type="text" name="log_desc" value="<?php echo $output['moneyQuickApplyLog_list']['log_desc'];?>" style="width:100%;"></td>
		</tr>
		<tr>
			<th>添加时间</th>
			<td><input type="text" name="create_time" id="create_time1" value="<?php echo to_date($output['moneyQuickApplyLog_list']['create_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>是否有效</th>
			<td>
				<input type="radio" name="is_enable" value="1" <?php if($output['moneyQuickApplyLog_list']['is_enable']==1){?>checked="checked" <?php }?>> 是
				<input type="radio" name="is_enable" value="0" <?php if($output['moneyQuickApplyLog_list']['is_enable']==0){?>checked="checked" <?php }?>> 否
			</td>
		</tr>
		<tr>
			<th>是否删除</th>
			<td colspan="4">
				<input type="radio" name="is_delete" value="1" <?php if($output['moneyQuickApplyLog_list']['is_delete']==1){?>checked="checked" <?php }?>> 是
				<input type="radio" name="is_delete" value="0" <?php if($output['moneyQuickApplyLog_list']['is_delete']==0){?>checked="checked" <?php }?>> 否
			</td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->