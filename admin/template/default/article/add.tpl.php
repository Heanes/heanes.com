<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=article&op=insert';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value=""></td>
			</tr>
			<tr>
				<th><span class="need">*&nbsp;</span>文章分类名称</th>
				<td>
					<select name="category_id">
						<option value="">请选择</option>
						<?php foreach ($output['articleCategoryList'] as $category_key => $articleCategory) {?>
							<option value ="<?php echo $articleCategory['id'];?>"><?php echo $articleCategory['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th><span class="need">*&nbsp;</span>文章标题</th>
				<td><input type="text" name="title" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章副标题</th>
				<td><input type="text" name="subtitle" value="" style="width: 60%;"></td>
				<th>文章封面图片</th>
				<td><input type="text" name="cover_img_src" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章作者</th>
				<td>
					<select name="user_id">
						<option value="">请选择</option>
						<?php foreach ($output['usersList'] as $users_key => $users) {?>
							<option value ="<?php echo $users['id'];?>"><?php echo $users['user_name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>文章作者链接</th>
				<td><input type="text" name="user_link" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章作者笔名</th>
				<td><input type="text" name="author" value="" style="width: 60%;"></td>
				<th>责任编辑</th>
				<td><input type="text" name="editor" value="" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>文章来源，为空表示原创</th>
				<td><input type="text" name="origin_source" value="" style="width: 60%;"></td>
				<th>样式</th>
				<td>
					标题背景颜色 <input type="text" class="color" name="title_bg_color" value="" style="width:60px"/>
					内容背景颜色<input type="text" class="color" name="content_bg_color" value="" style="width:60px"/>
				</td>
			</tr>
			<tr>
				<th>关键词</th>
				<td><input type="text" name="keywords" style="width:60%;"></td>
				<th>标签ID</th>
				<td><input type="text" name="tags" style="width:60%;"></td>
			</tr>
			<tr>
				<th>语义化链接</th>
				<td><input type="text" name="semantic_a_href" style="width:60%;"></td>
				<th>文章链接</th>
				<td><input type="text" name="a_href" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章链接标题</th>
				<td><input type="text" name="a_title" style="width:60%;"></td>
				<th>文章模版ID</th>
				<td><input type="text" name="template_id" style="width:60%;"></td>
			</tr>
			<tr>
				<th>是否为新发布文章</th>
				<td>
					<input type="radio" name="is_new" value="1" checked="checked"/>是
					<input type="radio" name="is_new" value="0" />否
				</td>
				<th>是否推荐</th>
				<td>
					<input type="radio" name="is_recommend" value="1" checked="checked"/>是
					<input type="radio" name="is_recommend" value="0" />否
				</td>
			</tr>
			<tr>
				<th>是否置顶</th>
				<td>
					<input type="radio" name="is_top" value="1" checked="checked"/>是
					<input type="radio" name="is_top" value="0" />否
				</td>
				<th>是否精品</th>
				<td>
					<input type="radio" name="is_great" value="1" checked="checked"/>是
					<input type="radio" name="is_great" value="0" />否
				</td>
			</tr>
			<tr>
				<th>是否允许评论</th>
				<td>
					<input type="radio" name="allow_comment" value="1" checked="checked"/>是
					<input type="radio" name="allow_comment" value="0" />否
				</td>
				<th>评论数</th>
				<td><input type="text" name="comment_num" value="" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章评分，允许为负分</th>
				<td><input type="text" name="comment_score" value="" style="width:60%;"/></td>
				<th>阅读次数</th>
				<td><input type="text" name="read_num" value="" disabled="disabled" style="width:60%;"></td>
			</tr>
			<tr>
				<th>点击次数</th>
				<td><input type="text" name="click_count"  value="" style="width:60%;"></td>
				<th>文章SEO标题</th>
				<td><input type="text" name="seo_title" value="" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章SEO关键词</th>
				<td><input type="text" name="seo_keywords" value="" style="width:60%;"/></td>
				<th>文章SEO描述</th>
				<td><input type="text" name="seo_description" value="" style="width:60%;"></td>
			</tr>
			<tr>
				<th>文章阅读用户权限</th>
				<td>
					<select name="user_role_id">
						<option value="">请选择</option>
						<?php foreach ($output['userRoleList'] as $userRole_key => $userRole) {?>
							<option value ="<?php echo $userRole['id'];?>"><?php echo $userRole['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>文章阅读用户积分</th>
				<td><input type="text" name="user_rank" value="" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>阅读密码</th>
				<td><input type="password" name="pwd" value="" style="width:60%;height:30px;margin:0;"/></td>
				<th>文章创建时间</th>
				<td><input type="text" name="article_insert_time" id="article_insert_time1" value="<?php echo to_date('now');?>" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>文章更新时间</th>
				<td><input type="text" name="article_update_time" id="article_update_time2" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" checked="checked"/>显示
					<input type="radio" name="is_enable" value="0" />不显示
				</td>
			</tr>
			<tr>
				<th>是否删除</th>
				<td colspan="4">
					<input type="radio" name="is_delete" value="1"/>是
					<input type="radio" name="is_delete" value="0" checked="checked" />否
				</td>
			</tr>
			<tr>
				<th>文章内容</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="content" style="width:800px;height:400px;visibility:hidden;"></textarea>
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