<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=department&op=insert';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="department_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th>排序</th>
			<td><input type="text" name="department_order" value=""></td>
		</tr>
		<tr>
			<th>部门名称</th>
			<td><input type="text" name="department_name" value="" style="width:60%;"></td>
			<th>英文代码</th>
			<td><input type="text" name="department_english_name" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>创建时间</th>
			<td><input type="text" name="department_insert_time" id="department_insert_time1" value="<?php echo to_date('now');?>" placeholder="选择起始时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>修改时间</th>
			<td><input type="text" name="department_update_time" id="department_insert_time2" value="<?php echo to_date('now');?>" placeholder="选择起始时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否有效</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked> 是
				<input type="radio" name="is_enable" value="0" > 否
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1"> 是
				<input type="radio" name="is_delete" value="0" checked="checked"> 否
			</td>
		</tr>
		<tr>
			<th>部门描述</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="department_description" style="width:800px;height:400px;visibility:hidden;"></textarea>
				<p style="font-size:12px;">
					您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br />
					您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
				</p>
				<cite>
					<!-- js S -->
					<script charset="utf-8" src="<?php echo SYS_HOST;?>public/static/libs/js/editor/kindEditor/kindeditor-min.js"></script>
					<script charset="utf-8" src="<?php echo SYS_HOST;?>public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
					<script>
						KindEditor.ready(function(K) {
							K.create('textarea[name="department_description"]', {
								afterChange : function() {
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
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=department';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
