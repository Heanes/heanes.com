<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=friendlinkCategory&op=insert';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="friendlinkCategory_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th>排序</th>
			<td><input type="text" name="order" value=""></td>
		</tr>
		<tr>
			<th>父分类名称</th>
			<td>
				<select name="parent_id">
					<option value="0">顶级</option>
					<?php foreach ($output['friendlinkCategoryList'] as $friendlinkCategory_key => $friendlinkCategory) {?>
						<option value ="<?php echo $friendlinkCategory['id'];?>"><?php echo $friendlinkCategory['name'];?></option>
					<?php }?>
				</select>
			</td>
			<th>分类名称</th>
			<td><input type="text" name="friendlinkCategory_name" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>分类图片地址</th>
			<td><input type="text" name="img_src" value="" style="width:60%;"></td>
			<th>分类图片title值</th>
			<td><input type="text" name="img_title" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>分类外链</th>
			<td><input type="text" name="a_href" value="" style="width:60%;"></td>
			<th>分类外链title值</th>
			<td><input type="text" name="a_title" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>分类添加时间</th>
			<td><input type="text" name="create_time" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>分类更新时间</th>
			<td><input type="text" name="update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否启用</th>
			<td colspan="4">
				<input type="radio" name="is_enable" value="1" checked="checked"/>显示
				<input type="radio" name="is_enable" value="0" />不显示
			</td>
		</tr>
		<tr>
			<th>备注介绍</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:400px;visibility:hidden;"></textarea>
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
							K.create('textarea[name="description"]', {
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
			<a href="javascript:history.go(-1)" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
