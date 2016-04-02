<form action="" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="messageLog_id" readonly value="<?php echo $output['messageLog_list']['id'];?>"></td>
				<th>被操作消息ID</th>
				<td><a href="<?php echo BASE_URL;?>index.php?act=userMessage&op=edit&id=<?php echo $output['messageLog_list']['message_id'];?>"><?php echo $output['messageLog_list']['message_id'];?></a></td>
			</tr>
			<tr>
				<th>用户名称</th>
				<td><input type="text" name="act_user_id" value="<?php echo $output['messageLog_list']['act_user_name'];?>"></td>
				<th>操作类型</th>
				<td>
					<select name="act_type">
						<option value="">请选择</option>
						<option value="0" <?php if($output['messageLog_list']['act_type']=="0") { ?> selected="selected"<?php  } ?>>是否发送</option>
						<option value="1" <?php if($output['messageLog_list']['act_type']=="1") { ?> selected="selected"<?php  } ?>>是否阅读</option>
						<option value="2" <?php if($output['messageLog_list']['act_type']=="2") { ?> selected="selected"<?php  } ?>>是否删除</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>操作者IP</th>
				<td><input type="text" name="actor_ip" value="<?php echo $output['messageLog_list']['actor_ip'];?>"></td>
				<th>操作者浏览器</th>
				<td><input type="text" name="actor_browser" value="<?php echo $output['messageLog_list']['actor_browser'];?>"></td>
			</tr>
			<tr>
				<th>操作者操作系统</th>
				<td><input type="text" name="actor_os" value="<?php echo $output['messageLog_list']['actor_os'];?>"></td>
				<th>操作者浏览器语言</th>
				<td><input type="text" name="actor_language" value="<?php echo $output['messageLog_list']['actor_language'];?>" ></td>
			</tr>
			<tr>
				<th>操作者国家</th>
				<td><input type="text" name="actor_country" value="<?php echo $output['messageLog_list']['actor_country'];?>"></td>
				<th>操作者省</th>
				<td><input type="text" name="actor_province" value="<?php echo $output['messageLog_list']['actor_province'];?>"></td>
			</tr>
			<tr>
				<th>操作者市</th>
				<td><input type="text" name="actor_city" value="<?php echo $output['messageLog_list']['actor_city'];?>"></td>
				<th>操作时间</th>
				<td><input type="text" name="act_time" value="<?php echo to_date($output['messageLog_list']['act_time']);?>" placeholder="选择操作时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
