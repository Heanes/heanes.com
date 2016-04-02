<?php
/**
 * @doc 找回密码页面
 * @filesource findPassword.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-20 14:12:17
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=member&op=login">返回登录</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=update">找回密码</a></li>
		</ul>
	</div>
	<div class="reg-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=update_pwd" method="post" name="reg_form" id="reg_form">
			<div class="reg-field reg-mobile">
				<input type="text" name="user_mobile" placeholder="手机号" required value="" autofocus />
				<p class="reg-tip input-error-notice">手机号不正确</p>
			</div>
			<div class="reg-field mobile-verify-code">
				<input type="text" name="mobile_verify_code" placeholder="输入六位数手机验证码" value="" autocomplete="off" />
				<input type="hidden" name="reg_verify_type" value="mobile" />
				<span class="get-mobile-verify-code btn_disable" id="get_regsms_code">获取验证码</span>
				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>
			<!--
			<div class="reg-field reg-captcha">
				<input type="text" name="captcha" placeholder="验证码" maxlength="4" required autocomplete="off" value="" />
				<span class="captcha-wrap">
					<img alt="" src="<?php echo BASE_URL; ?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d" class="captcha-code"
						 onclick="this.src='<?php echo BASE_URL; ?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d&t=' + Math.random();" />
				</span>

				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>
			-->
			<div class="reg-handle">
				<div class="reg-handle-field">
					<input type="submit" class="reg-submit" name="reg_form_submit" value="下一步" />
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var register_vy_time = null;  	//定义时间
	var is_lock_send_vy = false;	//解除锁定
	var left_rg_time = 0;			//开始时间

	function left_time_to_send_regvy() {
		clearTimeout(register_vy_time);
		var button_get_regsms_code = $("#get_regsms_code");
		if (left_rg_time > 0) {
			register_vy_time = setTimeout(left_time_to_send_regvy, 1000);
			button_get_regsms_code.html(left_rg_time + "秒后重新获取验证码");
			button_get_regsms_code.addClass("btn_disable");
			left_rg_time--;
		} else {
			is_lock_send_vy = false;
			button_get_regsms_code.removeClass('btn_disable');
			button_get_regsms_code.html("重新获取验证码");
			left_rg_time = 0;
		}
	}

	$(document).ready(function () {
		//手机号验证
		var user_mobile = $('input[name="user_mobile"]');
		user_mobile.on("blur input", function () {
			if (verify.verifyMobile(this)) {
				$('#get_regsms_code').removeClass('btn_disable');
			} else {
				$('#get_regsms_code').addClass('btn_disable');
			}
		});

		$('#get_regsms_code').click(function () {
			var user_mobile = $('input[name="user_mobile"]');
			if ($.trim(user_mobile.val()).length == 0) {
				is_lock_send_vy = false;
				alert('未填写用户名或手机号！');
				$('input[name="user_name"]').css({border: '1px solid red'});
				return false;
			}
			if ($(this).hasClass('btn_disable')) {
				return false;
			} else {
				$(this).html('正在发送中...');
				$(this).addClass('btn_disable');
			}
			is_lock_send_vy = true;
			//ajax发送手机验证码
			var ajaxurl = "<?php echo BASE_URL;?>index.php?act=resetpwd&op=sms";
			var query = {};
			query.user_mobile = $.trim(user_mobile.val());
			$.ajax({
				url: ajaxurl,
				data: query,
				type: "POST",
				dataType: "json",
				success: function (result) {
					if (result.status == 1) {
						left_rg_time = 60;
						left_time_to_send_regvy();
					}
					else {
						alert(result.msg);
						$("#get_regsms_code").html(result.msg);
						is_lock_send_vy = true;
						return false;
					}

				}, error: function () {
					is_lock_send_vy = false;
					alert('未知原因，发送失败，请稍后再试');
				}
			});
		});
	});
</script>

