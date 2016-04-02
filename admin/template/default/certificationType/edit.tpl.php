<form action="<?php echo BASE_URL;?>index.php?act=CertificationType&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改认证方式类别</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="type_id" readonly value="<?php echo $output['certificationType']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['certificationType']['order'];?>"></td>
			</tr>
			<tr>
				<th>认证方式名称</th>
				<td><input type="text" name="type_name" value="<?php echo $output['certificationType']['name'];?>" style="width: 60%;"></td>
				<th>认证方式code</th>
				<td><input type="text" name="code" value="<?php echo $output['certificationType']['code'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>认证方式对应显示的图片</th>
				<td><input type="text" name="img_src" value="<?php echo $output['certificationType']['img_src'];?>" style="width: 60%;"/></td>
				<th>认证方式对应显示的图片alt属性</th>
				<td><input type="text" name="img_alt" value="<?php echo $output['certificationType']['img_alt'];?>" style="width: 60%;"/></td>
			</tr>
			<tr>
				<th>必要条件介绍</th>
				<td><input type="text" name="requirement" value="<?php echo $output['certificationType']['requirement'];?>" style="width: 60%;"/></td>
				<th>上传时小提示</th>
				<td><input type="text" name="tips" value="<?php echo $output['certificationType']['tips'];?>" style="width: 60%;"/></td>
			</tr>
			<tr>
				<th>认证通过加分值</th>
				<td><input type="text" name="point" value="<?php echo $output['certificationType']['point'];?>" style="width: 60%;"/></td>
				<th>注册/添加时是否显示此项</th>
				<td>
					<input type="radio" name="add_show" value="1" <?php if($output['certificationType']['add_show']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="add_show" value="0" <?php if($output['certificationType']['add_show']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否必须的</th>
				<td colspan='4'>
					<input type="radio" name="is_required" value="1" <?php if($output['certificationType']['is_required']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_required" value="0" <?php if($output['certificationType']['is_required']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['certificationType']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['certificationType']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['certificationType']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['certificationType']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['certificationType']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>认证方式备注信息</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['certificationType']['description']; ?></textarea>
	
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
