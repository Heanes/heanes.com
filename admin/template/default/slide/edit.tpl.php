<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=slide&op=update';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="slide_id" readonly value="<?php echo $output['slide']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['slide']['order'];?>"></td>
			</tr>
			<tr>
				<th>幻灯名称</th>
				<td><input type="text" name="slide_name" value="<?php echo $output['slide']['name'];?>" style="width:60%;"></td>
				<th>幻灯链接地址</th>
				<td><input type="text" name="a_href" value="<?php echo $output['slide']['a_href'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>幻灯文件地址</th>
				<td colspan="4"><input type="file" name="img_src" value="<?php echo $output['slide']['img_src'];?>"></td>
			</tr>
			<tr>
				<th>是否新窗口</th>
				<td>
					<input type="radio" name="a_target" value="1" <?php if($output['slide']['a_target']=='1'){?>checked="checked" <?php }?>> 是
					<input type="radio" name="a_target" value="0" <?php if($output['slide']['a_target']=='0'){?>checked="checked" <?php }?>> 否
				</td>
				<th>显示标题</th>
				<td><input type="text" name="title" value="<?php echo $output['slide']['title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>幻灯创建时间</th>
				<td><input type="text" name="slide_insert_time" value="<?php echo to_date($output['slide']['insert_time']);?>" placeholder="选择创建时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>幻灯最后修改时间</th>
				<td><input type="text" name="slide_update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['slide']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['slide']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['slide']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['slide']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
			<th>幻灯备注信息</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['slide']['description']; ?></textarea>

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
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=slide';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
