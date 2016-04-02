<form action="<?php echo BASE_URL;?>index.php?act=FileType&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改文件类型</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td colspan="4"><input type="text" name="type_id" readonly value="<?php echo $output['fileType']['id'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>文件类型名称</th>
				<td><input type="text" name="type_name" value="<?php echo $output['fileType']['type'];?>" style="width:60%;"></td>
				<th>文件类型描述</th>
				<td><input type="text" name="type_des" value="<?php echo $output['fileType']['name'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td colspan="4">
					<input type="radio" name="is_enable" value="1" <?php if($output['fileType']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['fileType']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>备注介绍</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['fileType']['description']; ?></textarea>
	
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
			<a href="javascript:history.go(-1)" class="btn btn-large">取消</a>
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
			datatype:{
				"type_name":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{2,10}$/
			}
		});
		demo.addRule([{
			ele:'input[name="type_name"]',
			datatype:"type_name",
			errormsg:'文件类型名称至少2个字符,最多10个字符！',
			nullmsg:'文件类型名称不能为空！'
		}]);
	});
</script>