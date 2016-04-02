<?php
/**
 * @doc 贷款申请页面（未登录情况）
 * @author Heanes
 * @time 2015-08-17 10:45:24
 */
?>
<div class="main-content w-wrap">
	<div class="page-introduce-img">
		<img src="image/introduce/introduce-product-apply.png" class="introduce-img">
	</div>
	<div class="product-apply">
		<form action="<?php echo BASE_URL; ?>index.php?act=money&op=apply" method="post" name="reg_form" id="reg_form">
			<input type="hidden" name="time" value="" />
			<table class="data-edit-table data-apply-table">
				<tbody>
				<tr>
					<th>姓名<i class="border-one"></i></th>
					<td>
						<input type="text" name="real_name" class="input-data input-border-none" placeholder="请输入真实姓名" />
					</td>
				</tr>
				<tr>
					<th>手机号码<i class="border-one"></i></th>
					<td>
						<span class="text-right"><input type="text" name="user_mobile" class="input-data input-border-none" placeholder="请填写手机号码" required value="" /></span>
						<input type="hidden" name="reg_verify_type" value="mobile" />
					</td>
				</tr>
				<tr>
					<th>验证码<i class="border-one"></i></th>
					<td class="mobile-verify-code">
						<input type="text" name="mobile_verify_code" class="input-data input-border-none" placeholder="请填写验证码" />
						<span class="input-verify-code" id="get_regsms_code">获取验证码</span>
						<p class="reg-tip input-error-notice">验证码不正确</p>
					</td>
				</tr>
				<tr>
					<th>贷款额度<i class="border-one"></i></th>
					<td class="input-width-unit">
						<span><input type="text" name="money_want" class="input-data input-border-none text-right" placeholder="请填写贷款额度" /></span>
						<span class="input-data-decorate">万元</span>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-detail-handle">
				<div class="handle-center">
					<input type="submit" name="apply_money_form_submit" class="button-large-super-long button-show" value="立即申请" />
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
		$('#get_regsms_code').click(function () {
			var user_mobile = $('input[name="user_mobile"]');
			if ($.trim(user_mobile.val()).length == 0) {
				is_lock_send_vy = false;
				alert('未填写用户名或手机号！');
				$('input[name="real_name"]').css({border: '1px solid red'});
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
			var ajaxurl = "<?php echo BASE_URL;?>index.php?act=money&op=sendRegCaptchaSms";
			var query = {};
			query.user_mobile = $.trim(user_mobile.val());
			$.ajax({
				url: ajaxurl,
				data: query,
				type: "POST",
				dataType: "json",
				success: function (result) {
					if (result.status == 1) {
						$('input[name="time"]').attr('value',result.time);
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
					return false;
				}
			});
		});
	});
</script>