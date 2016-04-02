<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=slide&op=insert';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="slide_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th>排序</th>
			<td><input type="text" name="order" value=""></td>
		</tr>
		<tr>
			<th>幻灯名称</th>
			<td><input type="text" name="slide_name" value="" style="width:60%;"></td>
			<th>幻灯链接地址</th>
			<td><input type="text" name="a_href" value="" style="width:60%;"></td>
		</tr>
		<tr>
<!--			<th>幻灯文件地址</th>-->
<!--			<td colspan="4"><input type="file" name="img_src"></td>-->

		</tr>
		<tr>
			<th>是否新窗口</th>
			<td>
				<input type="radio" name="a_target" value="1" checked> 是
				<input type="radio" name="a_target" value="0" > 否
			</td>
			<th>显示标题</th>
			<td><input type="text" name="title" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>幻灯创建时间</th>
			<td><input type="text" name="slide_insert_time" value="<?php echo to_date('now');?>" placeholder="选择创建时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>幻灯最后修改时间</th>
			<td><input type="text" name="slide_update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否启用</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked> 显示
				<input type="radio" name="is_enable" value="0" > 不显示
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1"> 是
				<input type="radio" name="is_delete" value="0" checked="checked"> 否
			</td>
		</tr>
		<tr style="border-bottom: 1px solid #ddd;">
			<th>幻灯备注信息</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:400px;visibility:hidden;"></textarea>
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



	<style>
		a{color:#3b5998;}
	</style>
	<script type="text/javascript">

		//保存缩略图的地址.
		var saveUrl = '<?php echo SYS_HOST;?>admin/template/default/slide/flash/save_avatar.php';
		//保存摄象头白摄图片的地址.
		var cameraPostUrl = '<?php echo SYS_HOST;?>admin/template/default/slide/flash/camera.php';
		//头像编辑器flash的地址.
		var editorFlaPath = '<?php echo SYS_HOST;?>admin/template/default/slide/flash/up/swf/AvatarEditor.swf';
		//以下是flash无刷新上传
		//配置当前路径 例如:http://local.com/up
		var baseurl = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['SCRIPT_NAME'],'/')); ?>';
	</script>

	<link href="<?php echo SYS_HOST;?>admin/template/default/slide/flash/up/css/upload.css" rel="stylesheet" type="text/css" />
	<script type="text/javaScript" src="<?php echo SYS_HOST;?>admin/template/default/slide/flash/up/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST;?>admin/template/default/slide/flash/up/js/swfobject.js"></script>


	<div class="magic">幻灯文件地址：<input type="button" value="点击上传图像" onclick="$('#info').show();"/></div>
	<span style="color:red;display:none;" id="msg">保存成功!</span>

<!--	<span style="display:none;" id="msg"><img src="--><?php //echo SYS_HOST;?><!--admin/template/default/slide/flash/avatar_big/--><?php //echo $pic_id ?><!--_big.jpg" /></span>-->


	<div style="width:600px;margin-left: 9%;display:none;" id="info">
		<div>
			<div style="padding:10px 0;color:#666;">
				上传本地图片,或者<a style="color:#cc3300;" href="javascript:void(0);" onclick="useCamera()">使用摄像头拍照</a>
			</div>

			<!-- 头像flash 无刷新上传开始 -->
			<input type="hidden" name="dosubmit" value="1" />
			<input type="hidden" name="fsize" id="fsize" value="">
			<input type="hidden" name="forward" value="">
			<input type="hidden" name="uuid" value="1">
			<input type="hidden" id="video_uploader" value="0">

			<table>
				<tr>
					<td><div id="uploadp"></div></td>
					<td><div id="upload_flash_video"></div></td>
					<td><div id="filesize"></div></td>
				</tr>
			</table>
			<!-- /头像flash 无刷新上传结束 -->

			<div id="avatar_editor"></div>

		</div>
	</div>
	<script type="text/javascript" src="<?php echo SYS_HOST;?>admin/template/default/slide/flash/up/js/upload.js"></script>







	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=slide';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->




