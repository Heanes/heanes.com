<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL; ?>index.php?act=articleCategory&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="4"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="category_id" readonly value="<?php echo $output['articleCategory']['id'];?>"></td>
			<th>排序</th>
			<td><input type="text" name="order" value="<?php echo $output['articleCategory']['order'];?>"></td>
		</tr>
		<tr>
			<th>父分类名称</th>
			<td>
				<select name="parent_id">
					<option value="0">顶级</option>
					<?php foreach ($output['articleCategoryList'] as $key => $articleCategory) {?>
						<option value ="<?php echo $articleCategory['id'];?>" <?php if($articleCategory["id"]==$output['articleCategory']['parent_id']) { ?> selected="selected"<?php  } ?> ><?php echo $articleCategory['name'];?></option>
					<?php }?>
				</select>
			</td>
			<th>分类名称</th>
			<td><input type="text" name="article_category_name" value="<?php echo $output['articleCategory']['name'];?>" style="width:60%;"></td>
		</tr>
		<tr>
			<th>code</th>
			<td><input type="text" name="code" value="<?php echo $output['articleCategory']['code'];?>" style="width:60%;"></td>
			<th>分类模版ID</th>
			<td><input type="text" name="template_id" value="待定" style="width:60%;"></td>
		</tr>
		<tr>
			<th>分类链接</th>
			<td><input type="text" name="a_href" value="<?php echo $output['articleCategory']['a_href'];?>" style="width:60%;"></td>
			<th>分类链接标题</th>
			<td><input type="text" name="a_title" value="<?php echo $output['articleCategory']['a_title'];?>" style="width:60%;"></td>
		</tr>
			<th>分类图标</th>
			<td><input type="file" name="img_src" value="<?php echo $output['articleCategory']['img_src'];?>"></td>
			<th>SEO关键词</th>
			<td><input type="text" name="seo_keywords" value="<?php echo $output['articleCategory']['seo_keywords'];?>" style="width:60%;"></td>
		</tr>
		<tr>
			<th>SEO描述</th>
			<td><input type="text" name="seo_description" value="<?php echo $output['articleCategory']['seo_description'];?>" style="width:60%;"></td>
			<th>分类阅读用户角色权限</th>
			<td>
				<select name="user_role_id" class="select-normal">
					<option value="">请选择</option>
					<?php foreach ($output['roleUrl_List'] as $user_role_key => $roleUrl) {?>
						<option value="<?php echo $roleUrl['id']?>" <?php if($roleUrl['id']==$output['articleCategory']['user_role_id']){?>selected<?php }?>><?php echo $roleUrl['name']?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th>分类阅读用户积分</th>
			<td><input type="text" name="user_rank" value="<?php echo $output['articleCategory']['user_rank'];?>" style="width:60%;"></td>
			<th>分类阅读密码</th>
			<td><input type="password" name="pwd" value="<?php echo $output['articleCategory']['pwd'];?>" style="height:30px;margin:0;width:60%;"></td>
		</tr>
		<tr>
			<th>创建时间</th>
			<td><input type="text" name="create_time" value="<?php echo to_date($output['articleCategory']['create_time']);?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>修改时间</th>
			<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否显示</th>
			<td>
				<input type="radio" name="is_enable" value="1" <?php if($output['articleCategory']['is_enable']==1){?>checked<?php }?>> 是
				<input type="radio" name="is_enable" value="0" <?php if($output['articleCategory']['is_enable']!=1){?>checked="false" <?php }?>> 否
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1" <?php if($output['articleCategory']['is_delete']==1){?>checked="checked" <?php }?>> 是
				<input type="radio" name="is_delete" value="0" <?php if($output['articleCategory']['is_delete']==0){?>checked="checked" <?php }?>> 否
			</td>
		</tr>
		<tr>
			<th>分类介绍</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['articleCategory']['description'];?></textarea>
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
