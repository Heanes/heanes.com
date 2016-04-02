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
			<td><input type="text" name="employeeLog_id" readonly value="<?php echo $output['employeeStatusLog']['id'];?>"></td>
			<th>员工ID</th>
			<td><a href="<?php echo BASE_URL;?>index.php?act=employee&op=edit&id=<?php echo $output['employeeStatusLog']['id'];?>"><?php echo $output['employeeStatusLog']['id'];?></a></td>
		</tr>
		<tr>
			<th>操作用户名称</th>
			<td><input type="text" name="actor_user_id" value="<?php echo $output['employeeStatusLog']['actor_user_name'];?>"></td>
			<th>审核状态</th>
			<td>
				<select name="status">
					<option value="">请选择</option>
					<option value="0" <?php if($output['employeeStatusLog']['status']=="0") { ?> selected="selected"<?php  } ?>>审核中</option>
					<option value="1" <?php if($output['employeeStatusLog']['status']=="1") { ?> selected="selected"<?php  } ?>>通过</option>
					<option value="-1" <?php if($output['employeeStatusLog']['status']=="-1") { ?> selected="selected"<?php  } ?>>拒绝</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>处理原因</th>
			<td><input type="text" name="reason" value="<?php echo $output['employeeStatusLog']['reason'];?>" style="width:100%;"></td>
			<th>添加时间</th>
			<td><input type="text" name="insert_time" id="insert_time1" value="<?php echo to_date($output['employeeStatusLog']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否有效</th>
			<td colspan='4'>
				<input type="radio" name="is_enable" value="1" <?php if($output['employeeStatusLog']['is_enable']==1){?>checked="checked" <?php }?>> 有效
				<input type="radio" name="is_enable" value="0" <?php if($output['employeeStatusLog']['is_enable']==0){?>checked="checked" <?php }?>> 无效
			</td>
		</tr>
		<tr>
			<th>操作留下的备注信息,留给系统查看</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:600px;visibility:hidden;"><?php echo $output['employeeStatusLog']['description']; ?></textarea>

				<p style="font-size:12px;">
					您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br />
					您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
				</p>
				<cite>
					<!-- js S -->
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor-min.js"></script>
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
					<script>
						KindEditor.ready(function (K) {
							K.create('textarea[name="description"]', {
								afterChange: function () {
									K('.word_count1').html(this.count());
									K('.word_count2').html(this.count('text'));
								}
							});
						});
					</script>
					<!-- js E -->
				</cite>
			</td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->