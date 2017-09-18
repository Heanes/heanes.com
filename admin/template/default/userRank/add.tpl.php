<form action="<?php echo BASE_URL;?>index.php?act=UserRank&op=insert" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">添加用户积分</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></td>
				<th>用户ID</th>
				<td>
					<select name="user_id" class="select-normal">
						<option value="0">请选择</option>
						<?php foreach ($output['usersList'] as $key => $usersList) {?>
						<option value="<?php echo $usersList['id']?>"><?php echo $usersList['user_name']?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>积分类型ID</th>
				<td>
					<select name="type_id" class="select-normal">
						<option value="0">请选择</option>
						<?php foreach ($output['userRankTypeList'] as $key => $userRankTypeList) {?>
						<option value="<?php echo $userRankTypeList['id']?>"><?php echo $userRankTypeList['name']?></option>
						<?php }?>
					</select>
				</td>
				<th>积分个数</th>
				<td><input type="text" name="value" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
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
