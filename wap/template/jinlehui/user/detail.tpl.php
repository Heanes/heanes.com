<?php
/**
 * @doc 用户详情页，模仿微信
 * @filesource userDetail.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-10 13:31:23
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/jquery.form/3.51/jquery.form.js"></script><!-- ajax提交数据 -->
<div class="main-content w-wrap">
	<div class="service-operate-block clearfix" style="padding-top:10px;">
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="javascript:" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span" style="width:50%">
						<div class="menu-file-upload-wrap" style="width:100%;height:100%;">
							<span class="upload-button-text absolute-center">头像</span>
							<input type="file" name="avatar_src" class="upload-file-filed">
						</div>
					</span>
					<span class="common-sub-menu-ul-span-value">
						<img class="user-detail-avatar-img img-gallery" id="avatar_src" src="<?php echo empty($output['user']['avatar_src']) ? PATH_BASE_PUBLIC.'static/image/user-avatar/default.png' :$output['user']['avatar_src']; ?>"
							 href="<?php echo empty($output['user']['avatar_src']) ? PATH_BASE_PUBLIC.'static/image/user-avatar/default.png' : $output['user']['avatar_src']; ?>">
					</span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=realName" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">名字</span>
					<span class="common-sub-menu-ul-span-value"><?php echo $output['user']['real_name']; ?></span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=userName" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">用户名</span>
					<span class="common-sub-menu-ul-span-value"><?php echo $output['user']['user_name']; ?></span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=member&op=qrCode&id=<?php echo $_SESSION['user_id']?>" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">我的二维码</span>
					<span class="common-sub-menu-ul-span-value"><img src="image/common/QR-code.jpg" style="height:40px;"></span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<?php if(isset($output['defaultMenuArray']) && is_array($output['defaultMenuArray'])){?>
				<?php foreach ($output['defaultMenuArray'] as $key => $menu) {?>
				<li class="common-menu-oneline-all-li">
					<a href="<?php echo $menu['href'] ?>" class="common-sub-menu-li-a oneline-all-a">
						<span class="common-sub-menu-ul-span"><?php echo $menu['text'] ?></span>
						<span class="common-menu-ul-span-arrow">
							<i class="arrow-r"></i>
						</span>
					</a>
				</li>
				<?php }?>
			<?php }?>
		</ul>
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=gender" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">性别</span>
					<span class="common-sub-menu-ul-span-value"><?php if ($output['user']['gender'] == 1) { ?>男<?php } elseif ($output['user']['gender'] == 0) { ?>女<?php } elseif($output['user']['gender'] == -1) { ?>保密<?php } ?></span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=location" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">地区</span>
					<span class="common-sub-menu-ul-span-value">
						<?php echo empty($output['user']['province']) ? '' : $output['user']['province'].' '; ?><?php echo empty($output['user']['city']) ? '' : $output['user']['city'].' '; ?><?php echo empty($output['user']['address']) ? '' : $output['user']['address']; ?>
					</span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=signature" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">个性签名</span>
					<span class="common-sub-menu-ul-span-value"><?php echo $output['user']['signature']; ?></span>
					<span class="common-menu-ul-span-arrow">
						<i class="arrow-r"></i>
					</span>
				</a>
			</li>
		</ul>
		<ul class="common-menu-ul">
			<li class="common-menu-oneline-all-li">
				<a href="<?php echo BASE_URL; ?>index.php?act=user&op=edit&field=password" class="common-sub-menu-li-a oneline-all-a">
					<span class="common-sub-menu-ul-span">修改密码</span>
						<span class="common-menu-ul-span-arrow">
							<i class="arrow-r"></i>
						</span>
				</a>
			</li>
		</ul>
	</div>
</div>
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
				url:'<?php echo BASE_URL;?>'+'index.php?act=user&op=uploadAvatar',
				target:$(this),
				dataType: 'json',
				data:{field_name:$(this).attr('name')},
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
					$('#avatar_src').attr('src', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
					$('#avatar_src').attr('href', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
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

