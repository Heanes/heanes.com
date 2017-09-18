<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=customerApply&op=update';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="customerApply_id" readonly value="<?php echo $output['customerApply']['id'];?>"></td>
				<th>是否递交申请</th>
				<td>
					<input type="radio" name="is_applying" value="1" <?php if($output['customerApply']['is_applying']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_applying" value="0" <?php if($output['customerApply']['is_applying']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>关系人主</th>
				<td><input type="text" name="uid_master" value="<?php echo $output['customerApply']['user_master']['user_name'];?>" readonly></td>
				<th>关系人客</th>
				<td><input type="text" name="uid_slave" value="<?php echo $output['customerApply']['user_slave']['user_name'];?>" readonly></td>
			</tr>
			<tr>
				<th>关系状态</th>
				<td colspan="3">
					<select name="status">
						<option value="">请选择</option>
						<option value ="0" <?php if($output['customerApply']['status']==0) { ?> selected="selected"<?php  } ?>>审核中</option>
						<option value ="1" <?php if($output['customerApply']['status']==1) { ?> selected="selected"<?php  } ?>>已通过</option>
						<option value ="2" <?php if($output['customerApply']['status']==2) { ?> selected="selected"<?php  } ?>>已拒绝</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>插入时间</th>
				<td><input type="text" name="customer_create_time" value="<?php echo to_date($output['customerApply']['create_time']);?>" readonly placeholder="选择插入时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="customer_update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td colspan="4">
					<input type="radio" name="is_delete" value="1" <?php if($output['customerApply']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['customerApply']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=customer';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
