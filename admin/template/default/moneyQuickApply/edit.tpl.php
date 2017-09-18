<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=moneyQuickApply&op=update';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="moneyQuickApply_id" readonly value="<?php echo $output['moneyQuickApply']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['moneyQuickApply']['order'];?>"></td>
			</tr>
			<tr>
				<th>产品名称</th>
				<td>
					<select name="product_id">
						<option value="">请选择</option>
						<?php foreach ($output['product'] as $key => $product) {?>
							<option value ="<?php echo $product['id'];?>" <?php if($product["id"]==$output['moneyQuickApply']['product_id']) { ?> selected="selected"<?php  } ?> ><?php echo $product['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>姓名</th>
				<td><input type="text" name="real_name" value="<?php echo $output['moneyQuickApply']['real_name'];?>"></td>
			</tr>
			<tr>
				<th>联系电话</th>
				<td><input type="text" name="phone" value="<?php echo $output['moneyQuickApply']['phone'];?>"></td>
				<th>贷款额度</th>
				<td><input type="text" name="money_want" value="<?php echo $output['moneyQuickApply']['money_want'];?>"></td>
			</tr>
			<tr>
				<th>贷款类型</th>
				<td>
					<select name="loan_type">
						<option value="">请选择</option>
						<option value ="1" <?php if($output['moneyQuickApply']['loan_type']==1) { ?> selected="selected"<?php  } ?>>抵押贷款</option>
						<option value ="2" <?php if($output['moneyQuickApply']['loan_type']==2) { ?> selected="selected"<?php  } ?>>信用贷款</option>
					</select>
				</td>
				<th>客户IP</th>
				<td><input type="text" name="user_ip" value="<?php echo $output['moneyQuickApply']['user_ip'];?>"></td>
			</tr>
			<tr>
				<th>是否已读</th>
				<td>
					<input type="radio" name="is_read" value="1" <?php if($output['moneyQuickApply']['is_read']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_read" value="0" <?php if($output['moneyQuickApply']['is_read']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>阅读时间</th>
				<td><input type="text" name="read_time" value="<?php echo to_date($output['moneyQuickApply']['read_time']);?>" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>联系状态</th>
				<td><input type="text" name="had_contact" value="<?php echo $output['moneyQuickApply']['apply_time'];?>"></td>
				<th>处理状态</th>
				<td>
					<input type="radio" name="is_handle" value="1" <?php if($output['moneyQuickApply']['is_handle']==1){?>checked="checked" <?php }?>> 已处理
					<input type="radio" name="is_handle" value="0" <?php if($output['moneyQuickApply']['is_handle']==0){?>checked="checked" <?php }?>> 未处理
				</td>
			</tr>
			<tr>
				<th>处理人用户名称</th>
				<td>
					<select name="handle_user_id">
						<option value="">请选择</option>
						<?php foreach ($output['adminUser'] as $key => $adminUser) {?>
							<option value ="<?php echo $adminUser['id'];?>" <?php if($adminUser["id"]==$output['moneyQuickApply']['handle_user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $adminUser['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>处理结果</th>
				<td>
					<select name="handle_result">
						<option value="">请选择</option>
						<option value ="0" <?php if($output['moneyQuickApply']['handle_result']==0) { ?> selected="selected"<?php  } ?>>未知</option>
						<option value ="1" <?php if($output['moneyQuickApply']['handle_result']==1) { ?> selected="selected"<?php  } ?>>符合要求</option>
						<option value ="2" <?php if($output['moneyQuickApply']['handle_result']==2) { ?> selected="selected"<?php  } ?>>不符合要求</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>处理时间</th>
				<td><input type="text" name="handle_time" value="<?php echo to_date($output['moneyQuickApply']['handle_time']);?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否放入回收站</th>
				<td>
					<input type="radio" name="is_recycle" value="1" <?php if($output['moneyQuickApply']['is_recycle']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_recycle" value="0" <?php if($output['moneyQuickApply']['is_recycle']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否置顶</th>
				<td>
					<input type="radio" name="is_top" value="1" <?php if($output['moneyQuickApply']['is_top']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_top" value="0" <?php if($output['moneyQuickApply']['is_top']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>创建时间</th>
				<td><input type="text" name="create_time" id="create_time1" value="<?php echo to_date('now');?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>修改时间</th>
				<td><input type="text" name="update_time" id="create_time2" value="<?php echo to_date('now');?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['moneyQuickApply']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['moneyQuickApply']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td colspan="4">
					<input type="radio" name="is_delete" value="1" <?php if($output['moneyQuickApply']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['moneyQuickApply']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>处理结果备注</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="handle_desc" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['moneyQuickApply']['handle_desc'];?></textarea>
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
								K.create('textarea[name="handle_desc"]', {
									//uploadJson : '<?php echo PATH_BASE_PUBLIC;?>include/editor/kindEditor/php/upload_json.php',
									uploadJson : '<?php echo BASE_URL.'index.php?act=moneyQuickApply&op=editorUpload';?>',
									fileManagerJson : '<?php echo BASE_URL.'index.php?act=moneyQuickApply&op=editorFileManagerJson';?>',
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
			<a href="<?php echo BASE_URL.'index.php?act=moneyQuickApply';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
