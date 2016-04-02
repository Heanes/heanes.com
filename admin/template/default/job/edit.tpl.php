<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=job&op=update'; ?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="4"><?php echo $output['page_title']; ?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="job_id" readonly value="<?php echo $output['job']['id']; ?>"></td>
			<th>排序</th>
			<td><input type="text" name="job_order" value="<?php echo $output['job']['order']; ?>"></td>
		</tr>
		<tr>
			<th><span class="need">*</span>职位名称</th>
			<td><input type="text" name="job_name" value="<?php echo $output['job']['name']; ?>" datatype="s2-10" errormsg="职位名称至少2个字符,最多10个字符！" style="width:70%;">
				<span class="Validform_checktip"></span>
			</td>
			<th>分类</th>
			<td>
				<select>
					<option value="">请选择</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>职位代码，一般即缩写</th>
			<td colspan="3"><input type="text" name="job_code" value="<?php echo $output['job']['code']; ?>" style="width:30%;"></td>
		</tr>
		<tr>
			<th>创建时间</th>
			<td><input type="text" name="job_insert_time" id="job_insert_time1" value="<?php echo to_date($output['job']['insert_time']); ?>" placeholder="选择起始时间"
					   onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker" /></td>
			<th>修改时间</th>
			<td><input type="text" name="job_insert_time" id="job_insert_time2" value="<?php echo to_date(getGMTime()); ?>" placeholder="选择起始时间"
					   onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker" /></td>
		</tr>
		<tr>
			<th>职位描述</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="job_description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['job']['description']; ?></textarea>

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
							K.create('textarea[name="job_description"]', {
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
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="javascript:history.go(-1)" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="/public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="/public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
<script type="text/javascript">
$(function(){
	$(".submitform").Validform({
		tiptype:3
	});
})
</script>
