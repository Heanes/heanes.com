<?php
/**
 * @doc 用户资料修改页，单字段修改，模仿微信
 * @filesource userDetail.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-10 13:31:23
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<!-- 姓名 -->
	<form action="" method="post" enctype="multipart/form-data">
		<div class="handle-top-bar">
			<table class="handle-bar-table">
				<tbody>
				<tr>
					<td class="user-edit-cancel-td"><a href="javascript:history.go(-1)" class="user-edit-cancel-href">取消</a></td>
					<td class="text-center"><span class="user-edit-field-name"><?php echo $output['legalFields'][$output['_field']]?></span></td>
					<td class="user-edit-save-td text-right"><input type="submit" name="user_edit_form_submit" class="user-edit-save-submit text-right disabled" value="保存"/></td>
				</tr>
				</tbody>
			</table>
		</div>
		<?php if ($output['_field'] == 'realName') { ?>
			<!-- 姓名 -->
			<div class="user-edit-field">
				<input type="text" name="real_name" class="user-edit-input user-edit-field-text" value="<?php echo $output['user']['real_name'];?>" />
			</div>
		<?php } else if ($output['_field'] == 'userName') { ?>
			<!-- 用户名 -->
			<div class="user-edit-field">
				<input type="text" name="user_name" class="user-edit-input user-edit-field-text" value="<?php echo $output['user']['user_name'];?>" />
			</div>
		<?php } else if ($output['_field'] == 'gender') { ?>
			<!-- 性别 -->
			<div class="user-edit-field">
				<div class="input-radio-wrap">
					<span class="radio-text">男</span>
					<input type="radio" name="gender" class="user-edit-input user-edit-radio right-wrong-hook-radio" value="1" <?php if($output['user']['gender']==1){?>checked<?php }?> />
				</div>
				<div class="input-radio-wrap">
					<span class="radio-text">女</span>
					<input type="radio" name="gender" class="user-edit-input user-edit-radio right-wrong-hook-radio" value="0" <?php if($output['user']['gender']==0){?>checked<?php }?> />
				</div>
				<div class="input-radio-wrap">
					<span class="radio-text">保密</span>
					<input type="radio" name="gender" class="user-edit-input user-edit-radio right-wrong-hook-radio" value="-1" <?php if($output['user']['gender']==-1){?>checked<?php }?> />
				</div>
			</div>
		<?php } else if ($output['_field'] == 'location') { ?>
			<!-- 地区 -->
			<div class="user-edit-field">
				<div id="live_address_select">
					<select name="province" class="province select-normal user-edit-input user-edit-location-select"></select>
					<select name="city" class="city select-normal user-edit-input user-edit-location-select"></select>
					<select name="region" class="area select-normal user-edit-input user-edit-location-select"></select>
				</div>
				<script src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/jquery.cxselect.js"></script>
				<script type="text/javascript">
					$('#live_address_select').cxSelect({
						url: '<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/cityData.min.json',   // 提示：如果服务器不支持 .json 类型文件，请将文件改为 .js 文件
						selects: ['province', 'city', 'area'],
						nodata: 'none'
					});
				</script>
			</div>
			<div class="user-edit-field">
				<textarea name="address" class="user-edit-input user-edit-address" placeholder="请输入详细地址"><?php echo $output['user']['address']; ?></textarea>
			</div>
		<?php } else if ($output['_field'] == 'signature') { ?>
		<!-- 个性签名 -->
		<div class="user-edit-field">
			<p class="text-right user-edit-signature-notice">* 不能超过80个字符</p>
			<textarea name="signature" class="user-edit-input user-edit-address" placeholder="请输入个性签名"><?php echo $output['user']['signature']; ?></textarea>
		</div>
	<?php }else if ($output['_field'] == 'password') { ?>
		<div class="user-edit-field">
			<input type="text" name="old_password" class="user-edit-input user-edit-field-text" placeholder="请输入旧密码" />
		</div>
		<div class="user-edit-field">
			<input type="text" name="new_password" class="user-edit-input user-edit-field-text" placeholder="请输入新密码" />
		</div>
		<div class="user-edit-field">
			<input type="text" name="new_password_repeat" class="user-edit-input user-edit-field-text" placeholder="请重复输入新密码" />
		</div>
	<?php } ?>
	</form>
</div>
<script type="text/javascript">
	$(function () {
		//数据有改变才允许保存
		$('.user-edit-input').on('change input', function () {
			$('input[type=submit]').removeClass('disabled');
		});
		//数据保存时的检测
		$('input[type=submit]').on('click',function(){
			if($(this).hasClass('disabled')){
				return false;
			}
		});
		var user_pwd = $('input[name="new_password"]');
		var yanzheng = /^(?=.{6,16}$)(?![0-9]+$)[0-9a-zA-Z]+$/;
		user_pwd.blur(function () {
			if (yanzheng.test($(this).val()) == false) {
				alert('密码必须包含字母且长度不可超过16位。');
			}
		})
	})
</script>