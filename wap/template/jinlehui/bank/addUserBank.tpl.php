<?php
/**
 * @doc 银行卡添加
 * @filesource searcheUser.tpl.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015-07-15 09:11:13
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-edit-block">
		<div class="add-user-data">
			<div class="page-nav-tab">
				<ul>
					<li><a href="<?php echo BASE_URL; ?>index.php?act=userBank">银行卡列表</a></li>
					<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=userBank&op=add">添加银行卡</a></li>
				</ul>
			</div>
		</div>
		<!-- 1.2银行卡信息 -->
		<div class="add-user-data">
			<div class="page-nav-tab">
				<ul>
					<li class="active"><a href="javascript:">银行卡信息</a></li>
				</ul>
			</div>
			<form action="<?php echo BASE_URL; ?>index.php?act=userBank&op=upload" method="post" enctype="multipart/form-data">
				<table class="data-edit-table" rel="add_user_bank">
					<tbody>
					<tr>
						<th>持卡人：<i class="border-one"></i></th>
						<td>
							<input type="text" name="real_name" class="input-data input-border-none" placeholder="请填写真实姓名" />
						</td>
					</tr>
					<tr>
						<th>银行卡号：<i class="border-one"></i></th>
						<td>
							<input type="text" name="bank_no" class="input-data input-border-none" placeholder="银行卡号" />
						</td>
					</tr>
					<tr>
						<th>银行：<i class="border-one"></i></th>
						<td class="td-input-select">
							<select name="bank_id" class="select-normal">
								<option value="0">请选择</option>
								<?php foreach ($output['bankList'] as $key => $bank) { ?>
									<option value="<?php echo $bank['id']; ?>"><?php echo $bank['name']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="upload-field" style="width:220px;text-align:center;margin:0 auto;">
								<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
									<span class="upload-button-text">点我上传银行卡正面</span>
									<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
									<input type="file" name="bank_front_pic_src" class="upload-file-filed">
								</div>
								<img class="upload-img-preview img-gallery" alt="" src="<?php echo PATH_BASE_PUBLIC;?>static/image/bankCard/demo_front.jpg" href="<?php echo PATH_BASE_PUBLIC;?>static/image/bankCard/demo_front.jpg" style="width:100%;">
							</div>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="data-edit-handle">
					<div class="handle-left">
						<input type="reset" class="data-reset-button" value="清空" />
					</div>
					<div class="handle-right">
						<input type="submit" name="bank_form_submit" class="data-submit-button sub" value="保存" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ajax提交数据 -->
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript">
	$(function () {
		var bar = $('.upload-progress .bar');
		var percent = $('.upload-progress .percent');
		var progress = $('.upload-progress');
		var files = $('.uploaded-files');
		$('input[type="file"]').change(function () {
			var this_input=$(this);
			$(this).wrap("<form id='my_upload' method='post' enctype='multipart/form-data'></form>");
			$("#my_upload").ajaxSubmit({
				url:'<?php echo BASE_URL;?>'+'index.php?act=AjaxResponse&op=fileUpload',
				target:$(this),
				dataType: 'json',
				data:{field_name:$(this).attr('name'),save_path:'temp'},
				beforeSend: function () {
					progress.show();
					var percentVal = '0%';
					bar.width(percentVal);
					percent.html(percentVal);
				},
				uploadProgress: function (event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal);
					percent.html(percentVal);
				},
				success: function (data) {
					files.html("<b>" + data.name + "(" + data.size + "k)</b> <span class='delimg' rel='" + data.pic + "'>删除</span>");
					this_input.parent().parent().parent().find('img.upload-img-preview').attr('src', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
					this_input.parent().parent().parent().find('img.upload-img-preview').attr('href', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
					this_input.after('<input type="hidden" name="'+this_input.attr('name')+'" value="'+data.pic+'">');
				},
				error: function (xhr) {
					bar.width('0');
					files.html(xhr.responseText);
					alert(xhr.responseText);
				}
			});
			$(this).unwrap();//拆掉form包裹，则可以多个上传
		});
	});
</script>
