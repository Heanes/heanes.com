<form action="<?php echo BASE_URL;?>index.php?act=CertificationCheck&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改认证审核</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="check_id" readonly value="<?php echo $output['certificationCheck']['id'];?>"></td>
				<th>认证用户</th>
				<td>
					<select name="user_certification_id">
						<option value="0">请选择</option>
						<?php foreach ($output['usersList'] as $key => $usersList) {?>
						<option value ="<?php echo $usersList['id'];?>" <?php if($usersList["id"]==$output['userCertification']['user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $usersList['user_name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>操作人ID</th>
				<td>
					<select name="actor_user_id">
						<option value="0">请选择</option>
						<?php foreach ($output['adminUser'] as $key => $adminUser) {?>
						<option value ="<?php echo $adminUser['id'];?>" <?php if($adminUser["id"]==$output['certificationCheck']['actor_user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $adminUser['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>处理原因</th>
				<td><input type="text" name="reason" value="<?php echo $output['certificationCheck']['reason'];?>"></td>
			</tr>
			<tr>
				<th>处理结果</th>
				<td>
					<select name="status">
						<option value="">请选择</option>
						<option value ="0" <?php if($output['certificationCheck']['status']==0) { ?> selected="selected"<?php  } ?>>审核中</option>
						<option value ="1" <?php if($output['certificationCheck']['status']==1) { ?> selected="selected"<?php  } ?>>已通过验证</option>
						<option value ="-1" <?php if($output['certificationCheck']['status']==-1) { ?> selected="selected"<?php  } ?>>未通过验证</option>
					</select>
				</td>
				<th>处理时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date($output['certificationCheck']['create_time']);?>" placeholder="选择处理时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>操作留下的备注信息,留给系统查看</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:600px;visibility:hidden;"><?php echo $output['certificationCheck']['description']; ?></textarea>
	
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
