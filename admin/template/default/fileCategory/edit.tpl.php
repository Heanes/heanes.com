<form action="<?php echo BASE_URL;?>index.php?act=FileCategory&op=update" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改文件分类</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="category_id" readonly value="<?php echo $output['fileCategory']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['fileCategory']['order'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>父分类名称</th>
				<td>
					<select name="parent_id" datatype="*" nullmsg="请选择父分类名称！">
						<option value="">请选择</option>
						<?php foreach ($output['fileCategoryArr'] as $key => $fileCategoryArr) {?>
							<option value ="<?php echo $fileCategoryArr['id'];?>" <?php if($fileCategoryArr["id"]==$output['fileCategory']['parent_id']) { ?> selected="selected"<?php  } ?> ><?php echo $fileCategoryArr['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
				<th><span class="need">*</span>分类名称</th>
				<td><input type="text" name="category_name" value="<?php echo $output['fileCategory']['name'];?>" datatype="s2-10" errormsg="分类名称至少2个字符,最多10个字符！" style="width:60%;" />
					<span class="Validform_checktip"></span>
				</td>
			</tr><tr>
				<th>分类信息介绍</th>
				<td><input type="text" name="desc" value="<?php echo $output['fileCategory']['desc'];?>" style="width:60%;"/></td>
				<th>分类存储路径</th>
				<td><input type="text" name="path" value="<?php echo $output['fileCategory']['path'];?>" style="width:60%;" /></td>
			</tr>
			<tr>
				<th><span class="need">*</span>允许存储文件的类型</th>
				<td>
					<select name="file_type" class="select-normal" datatype="*" nullmsg="请选择允许存储文件的类型！">
						<option value="">请选择</option>
						<?php foreach ($output['fileType_List'] as $key => $fileType) {?>
							<option value="<?php echo $fileType['id']?>" <?php if($fileType['id']==$output['fileCategory']['file_type']){?>selected<?php }?>><?php echo $fileType['name']?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
				<th><span class="need">*</span>允许访问角色</th>
				<td>
					<select name="user_role_id" datatype="*" nullmsg="请选择允许访问角色！">
						<option value="">请选择</option>
						<?php foreach ($output['userRole_List'] as $key => $userRole) {?>
							<option value ="<?php echo $userRole['id'];?>" <?php if($userRole["id"]==$output['fileCategory']['user_role_id']) { ?> selected="selected"<?php  } ?> ><?php echo $userRole['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>访问密码</th>
				<td><input type="password" name="pwd" value="<?php echo $output['fileCategory']['pwd'];?>" style="height:30px;margin:0;"/></td>
				<th>插入时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['fileCategory']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['fileCategory']['is_enable']==1){?>checked="checked" <?php }?>> 启用
					<input type="radio" name="is_enable" value="0" <?php if($output['fileCategory']['is_enable']==0){?>checked="checked" <?php }?>> 不启用
				</td>
			</tr>
			<tr>
				<th>备注介绍</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['fileCategory']['description']; ?></textarea>
	
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
	$(".submitform").Validform({
		tiptype:3
	});
});
</script>