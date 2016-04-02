<form action="<?php echo BASE_URL;?>index.php?act=UserRankType&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户积分类型</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="ranktype_id" readonly value="<?php echo $output['userRankType']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['userRankType']['order'];?>"></td>
			</tr>
			<tr>
				<th>积分名称</th>
				<td><input type="text" name="points_name" value="<?php echo $output['userRankType']['name'];?>" style="width: 60%;"></td>
				<th>积分Code</th>
				<td><input type="text" name="code" value="<?php echo $output['userRankType']['code'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>积分单位</th>
				<td><input type="text" name="unit" value="<?php echo $output['userRankType']['unit'];?>" style="width: 60%;"></td>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" id="insert_time1" value="<?php echo to_date($output['userRankType']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
			
				<th>更新时间</th>
				<td><input type="text" name="update_time" id="update_time2" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['userRankType']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['userRankType']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td colspan='4'>
					<input type="radio" name="is_delete" value="1" <?php if($output['userRankType']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['userRankType']['is_delete']==0){?>checked="checked" <?php }?>> 否
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
