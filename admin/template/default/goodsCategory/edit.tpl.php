<form action="<?php echo BASE_URL;?>index.php?act=GoodsCategory&op=update" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改商品分类</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="category_id" readonly value="<?php echo $output['goodsCategory']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['goodsCategory']['order'];?>"></td>
			</tr>
			<tr>
				<th>父分类名称</th>
				<td>
					<select name="parent_id">
						<option value="0">顶级</option>
						<?php foreach ($output['goodsCategoryList'] as $key => $goodsCategory) {?>
							<option value ="<?php echo $goodsCategory['id'];?>" <?php if($goodsCategory["id"]==$output['goodsCategory']['parent_id']) { ?> selected="selected"<?php  } ?> ><?php echo $goodsCategory['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th><span class="need">*</span>分类名称</th>
				<td style="width:35%;"><textarea class="editor_id1" name="category_name"><?php echo $output['goodsCategory']['name'];?></textarea>
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor.js"></script>
					<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('.editor_id1', {
								resizeType : 1,
								allowPreviewEmoticons : false,
								autoHeightMode : true,
								allowImageUpload : false,
								minWidth : 465,
								minHeight : 35,
								items : [
									"source","fontname", "fontsize", "|", "forecolor", "hilitecolor", "bold", "italic", "underline",
									"removeformat", "|", "justifyleft", "justifycenter", "justifyright", "insertorderedlist",
									"insertunorderedlist", "|", "emoticons", "image", "link"]
							});
						});
					</script>
				</td>
				</td>
			</tr>
			<tr>
				<th>分类链接</th>
				<td><input type="text" name="a_href" value="<?php echo $output['goodsCategory']['a_href'];?>" style="width:60%;"></td>
				<th>分类链接title值</th>
				<td><input type="text" name="a_title" value="<?php echo $output['goodsCategory']['a_title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>分类图标地址</th>
				<td><input type="text" name="img_src" value="<?php echo $output['goodsCategory']['img_src'];?>" style="width:60%;"></td>
				<th>分类图标title值</th>
				<td><input type="text" name="img_title" value="<?php echo $output['goodsCategory']['img_title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>分类访问用户组权限</th>
				<td>
					<select name="user_role_id" class="select-normal">
						<option value="">请选择</option>
						<?php foreach ($output['roleUrl_List'] as $user_role_key => $roleUrl) {?>
							<option value="<?php echo $roleUrl['id']?>" <?php if($roleUrl['id']==$output['goodsCategory']['user_role_id']){?>selected<?php }?>><?php echo $roleUrl['name']?></option>
						<?php }?>
					</select>
				</td>
				<th>分类访问用户积分</th>
				<td><input type="text" name="user_rank" value="<?php echo $output['goodsCategory']['user_rank'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>分类访问密码</th>
				<td colspan="4"><input type="password" name="pwd" value="<?php echo $output['goodsCategory']['pwd'];?>" style="height:30px;margin:0;width:25%;"></td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" id="insert_time1" value="<?php echo to_date($output['goodsCategory']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" id="update_time2" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['goodsCategory']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['goodsCategory']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['goodsCategory']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['goodsCategory']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>分类备注</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['goodsCategory']['description']; ?></textarea>
	
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
