<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=article&op=update';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="article_id" readonly value="<?php echo $output['article']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['article']['order'];?>"></td>
			</tr>
			<tr>
				<th>文章分类名称</th>
				<td>
					<select name="category_id">
						<option value="">请选择</option>
						<?php foreach ($output['articleCategoryList'] as $category_key => $articleCategory) {?>
							<option value ="<?php echo $articleCategory['id'];?>" <?php if($articleCategory["id"]==$output['article']['category_id']) { ?> selected="selected"<?php  } ?> ><?php echo $articleCategory['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th><span class="need">*&nbsp;</span>文章标题</th>
				<td><input type="text" name="title" value="<?php echo $output['article']['title'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章副标题</th>
				<td><input type="text" name="subtitle" value="<?php echo $output['article']['subtitle'];?>" style="width: 60%;"></td>
				<th>文章封面图片</th>
				<td><input type="text" name="cover_img_src" value="<?php echo $output['article']['cover_img_src'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章作者</th>
				<td>
					<select name="user_id">
						<option value="">请选择</option>
						<?php foreach ($output['usersList'] as $users_key => $users) {?>
							<option value ="<?php echo $users['id'];?>" <?php if($users["id"]==$output['article']['user_id']) { ?> selected="selected"<?php  } ?> ><?php echo $users['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>文章作者链接</th>
				<td><input type="text" name="user_link" value="<?php echo $output['article']['user_link'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章作者笔名</th>
				<td><input type="text" name="author" value="<?php echo $output['article']['author'];?>" style="width: 60%;"></td>
				<th>责任编辑</th>
				<td><input type="text" name="editor" value="<?php echo $output['article']['editor'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章来源，为空表示原创</th>
				<td><input type="text" name="origin_source" value="<?php echo $output['article']['origin_source'];?>" style="width: 60%;"></td>
				<th>样式</th>
				<td>
					标题背景颜色 <input type="text" class="color" name="title_bg_color" value="<?php echo $output['article']['title_bg_color'];?>" style="width:60px"/>
					内容背景颜色<input type="text" class="color" name="content_bg_color" value="<?php echo $output['article']['content_bg_color'];?>" style="width:60px"/>
				</td>
			</tr>
			<tr>
				<th>关键词</th>
				<td><input type="text" name="keywords" value="<?php echo $output['article']['keywords'];?>" style="width: 60%;"></td>
				<th>标签ID</th>
				<td><input type="text" name="tags" value="<?php echo $output['article']['tags'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>语义化链接</th>
				<td><input type="text" name="semantic_a_href" value="<?php echo $output['article']['semantic_a_href'];?>" style="width:60%;"></td>
				<th>文章链接</th>
				<td><input type="text" name="a_href" value="<?php echo $output['article']['a_href'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章链接标题</th>
				<td><input type="text" name="a_title" value="<?php echo $output['article']['a_title'];?>" style="width:60%;"></td>
				<th>文章模版ID</th>
				<td><input type="text" name="template_id" value="<?php echo $output['article']['template_id'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>是否为新发布文章</th>
				<td>
					<input type="radio" name="is_new" value="1" <?php if($output['article']['is_new']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_new" value="0" <?php if($output['article']['is_new']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否推荐</th>
				<td>
					<input type="radio" name="is_recommend" value="1" <?php if($output['article']['is_recommend']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_recommend" value="0" <?php if($output['article']['is_recommend']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否置顶</th>
				<td>
					<input type="radio" name="is_top" value="1" <?php if($output['article']['is_top']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_top" value="0" <?php if($output['article']['is_top']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否精品</th>
				<td>
					<input type="radio" name="is_great" value="1" <?php if($output['article']['is_great']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_great" value="0" <?php if($output['article']['is_great']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>是否允许评论</th>
				<td>
					<input type="radio" name="allow_comment" value="1" <?php if($output['article']['allow_comment']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="allow_comment" value="0" <?php if($output['article']['allow_comment']==0){?>checked="checked" <?php }?>/>否
				</td>
				<th>评论数</th>
				<td><input type="text" name="comment_num" value="<?php echo $output['article']['comment_num'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章评分，允许为负分</th>
				<td><input type="text" name="comment_score" value="<?php echo $output['article']['comment_score'];?>" style="width:60%;"/></td>
				<th>阅读次数</th>
				<td><input type="text" name="read_num" value="<?php echo $output['article']['read_num'];?>" disabled="disabled" style="width:60%;"></td>
			</tr>
			<tr>
				<th>点击次数</th>
				<td><input type="text" name="click_count"  value="<?php echo $output['article']['click_count'];?>" style="width:60%;"></td>
				<th>文章SEO标题</th>
				<td><input type="text" name="seo_title" value="<?php echo $output['article']['seo_title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>SEO关键词</th>
				<td><input type="text" name="seo_keywords" value="<?php echo $output['article']['seo_keywords'];?>" style="width: 60%;"></td>
				<th>SEO描述</th>
				<td><input type="text" name="seo_description" value="<?php echo $output['article']['seo_description'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章阅读用户权限</th>
				<td>
					<select name="user_role_id">
						<option value="">请选择</option>
						<?php foreach ($output['userRoleList'] as $userRole_key => $userRole) {?>
							<option value ="<?php echo $userRole['id'];?>" <?php if($userRole["id"]==$output['article']['user_role_id']) { ?> selected="selected"<?php  } ?> ><?php echo $userRole['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>文章阅读用户积分</th>
				<td><input type="text" name="user_rank" value="<?php echo $output['article']['user_rank'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>阅读密码</th>
				<td><input type="password" name="pwd" value="<?php echo $output['article']['pwd'];?>" style="width:60%;height:30px;margin:0;"/></td>
				<th>文章创建时间</th>
				<td><input type="text" name="article_insert_time" id="article_insert_time1" value="<?php echo to_date($output['article']['insert_time']);?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>文章更新时间</th>
				<td><input type="text" name="article_update_time" id="article_update_time2" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否显示</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['article']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['article']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td colspan="4">
					<input type="radio" name="is_delete" value="1" <?php if($output['article']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['article']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>文章内容</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="content" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['article']['content'];?></textarea>
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
								K.create('textarea[name="content"]', {
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
<script type="text/javascript">
	$(function(){
		var demo=$(".input-condensed").Validform({
			tiptype:3,
			datatype:{
				"title":/[\w\W]+/
			}
		});
		demo.addRule([{
			ele:'input[name="title"]',
			datatype:"title",
			nullmsg:'文章标题不能为空！'
		}]);
	});
</script>