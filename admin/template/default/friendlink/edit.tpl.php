<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=friendLink&op=update';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="friendLink_id" readonly value="<?php echo $output['friendLink']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="friendLink_order" value="<?php echo $output['friendLink']['order'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>链接名称</th>
				<td><input type="text" name="friendLink_name" value="<?php echo $output['friendLink']['name'];?>" datatype="z2-10" errormsg="链接名称为2~10个中文字符！" style="width:60%;"></td>
				<th><span class="need">*</span>友情链接Email</th>
				<td><input type="text" name="friendLink_email" value="<?php echo $output['friendLink']['email'];?>" datatype="e" nullmsg="请输入Email！" errormsg="Email格式不对！" style="width:60%;"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>链接地址</th>
				<td><input type="text" name="a_href" value="<?php echo $output['friendLink']['a_href'];?>" datatype="url" nullmsg="请输入链接地址！" errormsg="链接地址格式不对！" style="width:60%;"></td>
				<th>链接title</th>
				<td><input type="text" name="a_title" value="<?php echo $output['friendLink']['a_title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="friendLink_insert_time" id="friendLink_insert_time1" value="<?php echo to_date($output['friendLink']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="friendLink_update_time" id="friendLink_insert_time2" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['friendLink']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['friendLink']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>链接打开方式</th>
				<td>
					<input type="radio" name="a_target" value="1" <?php if($output['friendLink']['a_target']==1){?>checked="checked" <?php }?>> 原窗口
					<input type="radio" name="a_target" value="0" <?php if($output['friendLink']['a_target']==0){?>checked="checked" <?php }?>> 新窗口
				</td>
			</tr>
			<tr>
				<th>备注介绍</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="friendLink_description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['friendLink']['description'];?></textarea>
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
								K.create('textarea[name="friendLink_description"]', {
									//uploadJson : '<?php echo PATH_BASE_PUBLIC;?>include/editor/kindEditor/php/upload_json.php',
									uploadJson : '<?php echo BASE_URL.'index.php?act=friendLink&op=editorUpload';?>',
									fileManagerJson : '<?php echo BASE_URL.'index.php?act=friendLink&op=editorFileManagerJson';?>',
									allowFileManager : true,
									afterChange : function() {
										K('.word_count1').html(this.count());
										K('.word_count2').html(this.count('text'));
									}
								});

								//单个按钮实现点击图片上传
								var editor = K.editor({
										allowFileManager : true //允许图片管理 开启后再挑选图片的时候可以直接从图片空间内挑选
								});
								//这里是监听按钮点击事件 然后在初始化点击按钮弹窗上传图片的基本配置
								K('#image').click(function () {
									editor.loadPlugin('image', function () {
										editor.plugin.imageDialog({
											imageUrl: K('#url').val(),
											clickFn: function (url, title, width, height, border, align) {
												K('#url').val(url);
												editor.hideDialog();
											}
										});
									});
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
			<a href="<?php echo BASE_URL.'index.php?act=friendLink';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
<script type="text/javascript">
$(function(){
	var demo=$(".input-condensed").Validform({
		tiptype:3,
		datatype:{//传入自定义datatype类型【方式二】;
			"z2-10" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,10}$/
		}
	});
	demo.addRule([{
		ele:".inputxt:eq(2)",
		datatype:"e"
	},
	{
		ele:".inputxt:eq(3)",
		datatype:"url"
	}]);
	
}); 
</script>