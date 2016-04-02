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
			<td><input type="text" name="visitor_id" readonly value="<?php echo $output['webWisitorList']['id'];?>"></td>
			<th>访客访问页面</th>
			<td><input type="text" name="access_url" value="<?php echo $output['webWisitorList']['access_url'];?>"></td>
		</tr>
		<tr>
			<th>来源页面</th>
			<td><input type="text" name="refer_url" value="<?php echo $output['webWisitorList']['refer_url'];?>"></td>
			<th>访客IP</th>
			<td><input type="text" name="ip" value="<?php echo $output['webWisitorList']['ip'];?>"></td>
		</tr>
		<tr>
			<th>访客浏览器信息</th>
			<td><input type="text" name="borwser" value="<?php echo $output['webWisitorList']['borwser'];?>"></td>
			<th>访客操作系统信息</th>
			<td><input type="text" name="os" value="<?php echo $output['webWisitorList']['os'];?>"></td>
		</tr>
		<tr>
			<th>访客地域语言</th>
			<td><input type="text" name="language" value="<?php echo $output['webWisitorList']['language'];?>"></td>
			<th>访客所在国家</th>
			<td><input type="text" name="country" value="<?php echo $output['webWisitorList']['country'];?>"></td>
		</tr>
		<tr>
			<th>访客所在省</th>
			<td><input type="text" name="province" value="<?php echo $output['webWisitorList']['province'];?>"></td>
			<th>访客所在市</th>
			<td><input type="text" name="city" value="<?php echo $output['webWisitorList']['city'];?>"></td>
		</tr>
		<tr>
			<th>访问时间</th>
			<td><input type="text" name="come_time" value="<?php echo to_date($output['webWisitorList']['come_time']);?>"></td>
			<th>访客离开时间</th>
			<td><input type="text" name="leave_time" value="<?php echo to_date($output['webWisitorList']['leave_time']);?>"></td>
		</tr>
		<tr>
			<th>访问次数</th>
			<td colspan="4"><input type="text" name="visit_times" value="<?php echo $output['webWisitorList']['visit_times'];?>"></td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->