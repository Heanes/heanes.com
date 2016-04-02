<form action="<?php echo BASE_URL;?>index.php?act=userMessage&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改会员私信</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="message_id" readonly value="<?php echo $output['userMessage']['id'];?>"></td>
				<th>接收人用户名称</th>
				<td>
					<select name="recvier_user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['recvierUsersList'] as $key => $recvierUsersList) {?>
						<option value ="<?php echo $recvierUsersList['id'];?>" <?php if($recvierUsersList["id"]==$output['userMessage']['recvier_user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $recvierUsersList['user_name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>发送人用户名称</th>
				<td>
					<select name="sender_user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['senderUsersList'] as $key => $senderUsersList) {?>
						<option value ="<?php echo $senderUsersList['id'];?>" <?php if($senderUsersList["id"]==$output['userMessage']['sender_user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $senderUsersList['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>私信标题</th>
				<td><input type="text" name="title" value="<?php echo $output['userMessage']['title'];?>"></td>
			</tr>
			<tr>
				<th>私信内容</th>
				<td><input type="text" name="content" value="<?php echo $output['userMessage']['content'];?>"></td>
				<th>发送时间</th>
				<td><input type="text" name="send_time" value="<?php echo to_date($output['userMessage']['send_time']);?>" placeholder="选择发送时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否已读</th>
				<td>
					<input type="radio" name="is_read" value="1" <?php if($output['userMessage']['is_read']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_read" value="0" <?php if($output['userMessage']['is_read']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>阅读时间</th>
				<td><input type="text" name="read_time" value="<?php echo to_date($output['userMessage']['read_time']);?>" placeholder="选择阅读时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否已删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['userMessage']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['userMessage']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>删除时间</th>
				<td><input type="text" name="delete_time" value="<?php echo to_date($output['userMessage']['delete_time']);?>" placeholder="选择删除时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否放入回收站</th>
				<td>
					<input type="radio" name="is_recycle" value="1" <?php if($output['userMessage']['is_recycle']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_recycle" value="0" <?php if($output['userMessage']['is_recycle']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>回收时间</th>
				<td><input type="text" name="recycle_time" value="<?php echo to_date($output['userMessage']['recycle_time']);?>" placeholder="选择回收时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否紧急</th>
				<td>
					<input type="radio" name="is_emergency" value="1" <?php if($output['userMessage']['is_emergency']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_emergency" value="0" <?php if($output['userMessage']['is_emergency']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否定时发送</th>
				<td>
					<input type="radio" name="is_timing_auto" value="1" <?php if($output['userMessage']['is_timing_auto']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_timing_auto" value="0" <?php if($output['userMessage']['is_timing_auto']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>定时发送时间</th>
				<td><input type="text" name="auto_send_time" value="<?php echo to_date($output['userMessage']['auto_send_time']);?>" placeholder="选择定时发送时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker">
					
				</td>
				<th>是否具有有效期</th>
				<td>
					<input type="radio" name="is_time_limit" value="1" <?php if($output['userMessage']['is_time_limit']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_time_limit" value="0" <?php if($output['userMessage']['is_time_limit']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>失效时间</th>
				<td><input type="text" name="limit_time_end" value="<?php echo to_date($output['userMessage']['limit_time_end']);?>" placeholder="选择失效时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker">
					
				</td>
				<th>是否置顶</th>
				<td>
					<input type="radio" name="is_top" value="1" <?php if($output['userMessage']['is_top']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_top" value="0" <?php if($output['userMessage']['is_top']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>置顶开始时间</th>
				<td><input type="text" name="top_time_start" value="<?php echo to_date($output['userMessage']['"top_time_start"']);?>" placeholder="选择置顶开始时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>置顶结束时间</th>
				<td><input type="text" name="top_time_end" value="<?php echo to_date($output['userMessage']['top_time_end']);?>" placeholder="选择置顶结束时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td colspan='4'>
					<input type="radio" name="is_enable" value="1" <?php if($output['userMessage']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['userMessage']['is_enable']==0){?>checked="checked" <?php }?>> 否
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
