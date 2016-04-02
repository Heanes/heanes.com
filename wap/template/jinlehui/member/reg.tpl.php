<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<div class="reg-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=member&op=reg" method="post" name="reg_form" id="reg_form">
			<div class="reg-field reg-mobile">
				<input type="text" name="user_mobile" placeholder="手机号" required />
				<p class="reg-tip input-error-notice">手机号不正确</p>
			</div>
			<div class="reg-field mobile-verify-code">
				<input type="text" name="mobile_verify_code" placeholder="输入六位数手机验证码" value="" autocomplete="off" />
				<input type="hidden" name="reg_verify_type" value="mobile" />
				<span class="get-mobile-verify-code disabled" id="get_regsms_code">获取验证码</span>
				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>
			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd" placeholder="请输入密码" required value="" />
				<p class="reg-tip input-error-notice">密码长度不够</p>
			</div>
			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd_repeat" placeholder="请再次确认密码" required value="" />
				<p class="reg-tip input-error-notice">两次密码输入不一致</p>
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
			<div class="reg-clause">
				<label>
					<input type="checkbox" name="reg_law_check" checked="checked" />我已阅读并同意<a href="<?php echo BASE_URL; ?>index.php" class="law-href">《金乐汇交易条款》</a>
				</label>
				<p class="input-error-notice">必须同意相关条款</p>
			</div>
			<div class="reg-handle">
				<div class="reg-handle-field">
					<input type="submit" class="reg-submit" name="reg_form_submit" value="提交" />
				</div>
			</div>
		</form>
		<div class="reg-handle-extra">
			<div class="reg-extra-redirect">
				<a href="<?php echo BASE_URL; ?>index.php?act=member&op=login" class="href-duck">已有帐号？</a>
			</div>
		</div>
	</div>
</div>
<!-- js E -->
<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Validform/5.3.2/Validform_Datatype.js"></script>
<script type="text/javascript">
	$(function () {
		var reg_form_validate = $("#reg_form").Validform({
			tiptype: 3,
			showAllError: false,
			ignoreHidden:false,
			datatype: {
				"s6":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6}$/,
				"zh2-6": /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
				"file":function(gets,obj,curform,datatype) {
				},
				'exists_m':function(gets,obj,curform,datatype){
					var this_valid=false;
					var ajaxurl = "<?php echo BASE_URL;?>index.php?act=member&op=checkFiled";
					var query = {user_name:gets};
					var temp;
					$.ajax({
						url:ajaxurl,
						data:query,
						type:"post",
						dataType: "json",
						async: false,
						success:function(result){
							if(result.status==1){
								$('#get_regsms_code').removeClass('disabled');
								this_valid=true;
								$.data('this_valid',this_valid);
								return true;
							}
							if(result.status==-1){
								$('#get_regsms_code').addClass('disabled');
								this_valid=false;
								$.data('this_valid',this_valid);
								return false;
							}
						}
					});
					if(this_valid){
						return '可以注册';
					}else{
						return '该用户已经存在';
					}
				}
			},
			ajaxPost: false
		});
		reg_form_validate.tipmsg.w["zh2-6"] = "请输入2到6个中文字符！";
		reg_form_validate.addRule([
			{
				ele: 'input[name="user_mobile"]',
				//datatype: 'm|e,exists_m',
				datatype: 'm|e,exists_m',
				nullmsg:"请填写正确的手机号码",
				errormsg:"请填写正确的手机号码"
				//ajaxurl:'<?php echo BASE_URL;?>index.php?act=member&op=checkFiled&fields=user_name'
			},
			{
				ele: 'input[name="mobile_verify_code"]',
				datatype: 's6',
				nullmsg:"请填写手机验证码",
				errormsg:"请填写正确的手机验证码"
			},
			{
				ele: 'input[name="user_pwd"]',
				datatype: 's6-18',
				nullmsg:"请输入6位-18位密码",
				errormsg:"请输入6位-18位密码"
			},
			{
				ele: 'input[name="user_pwd_repeat"]',
				datatype: 's6-18',
				recheck:"user_pwd",
				nullmsg:"请重复输入密码",
				errormsg:"两次输入不一致"
			},
			{
				ele: 'input[name="reg_law_check"]',
				datatype: '*',
				nullmsg:"必须同意相关条款",
				errormsg:"必须同意相关条款",
				sucmsg:' '
			}
		]);
		$('input').on('input',function(){
			var form_submit=$('input[type="submit"]');
			var valid=false;
			var user_mobile_valid=false;
			$('input[name="user_mobile"]').on('input blur',function(){
				user_mobile_valid=reg_form_validate.check(true,'input[name="user_mobile"]');
				if(user_mobile_valid){
					$('#get_regsms_code').removeClass('disabled');
				}else{
					$('#get_regsms_code').addClass('disabled');
				}
			});
			valid = reg_form_validate.check(true,'input[name="user_mobile"]')
					&& reg_form_validate.check(true,'input[name="mobile_verify_code"]')
					&& reg_form_validate.check(true,'input[name="user_pwd"]')
					&& reg_form_validate.check(true,'input[name="user_pwd_repeat"]')
					&& reg_form_validate.check(true,'input[name="reg_law_check"]')
				;
			if(valid){
				form_submit.removeClass('disabled');
				form_submit.attr('disabled',false);
			}else{
				form_submit.addClass('disabled');
				form_submit.attr('disabled',true);
			}
			form_submit.on('click',function(){
				if(!valid){
					reg_form_validate.check();
					//return false;
				}
			});
		});

	});
	/**
	 * @doc 获取表单的验证状态
	 * @param Validform form 表单对象
	 * @returns boolean
	 */
	function getFormCheckStatus(form){
		return form.check(true);
	}
</script>
<!-- E js E -->
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
			button_get_regsms_code.addClass("disabled");
			left_rg_time--;
		} else {
			is_lock_send_vy = false;
			button_get_regsms_code.removeClass('disabled');
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
				$('input[name="user_name"]').css({border: '1px solid red'});
				return false;
			}
			if ($(this).hasClass('disabled')) {
				return false;
			} else {
				$(this).html('正在发送中...');
				$(this).addClass('disabled');
			}
			is_lock_send_vy = true;
			//ajax发送手机验证码
			var ajaxurl = "<?php echo BASE_URL;?>index.php?act=sms&op=sendRegCaptchaSms";
			var query = {};
			query.user_mobile = $.trim(user_mobile.val());
			$.ajax({
				url: ajaxurl,
				data: query,
				type: "POST",
				dataType: "json",
				success: function (result) {
					if (result.status == 1) {
						left_rg_time = 180;
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

	/**
	 * @doc ajax验证手机号是否被注册
	 */
	/*
	$('input[name="user_mobile"]').on("blur", function () {
		var user_name=$(this);
		var ajaxurl = "<?php echo BASE_URL;?>index.php?act=member&op=checkFiled";
		var query = {user_name:user_name.val()};
		$.ajax({
			url:ajaxurl,
			data:query,
			type:"post",
			dataType: "json",
			success:function(result){
				if(result.status==1){
					$('#get_regsms_code').removeClass('disabled');
					return true;
				}
				if(result.status==-1){
					user_name.next('.input-error-notice').html('此用户已经注册过');
					//$('input[name="user_mobile"]').val('');
					$('input[type="submit"]').attr('disabled','true');
					$('input[type="submit"]').addClass('disabled');
				}
			}
		});
	});
	*/

	/**
	 * @doc ajax检测图形验证码
	 */
	$('input[name="captcha"]').blur(function () {
		var ajaxurl = "<?php echo BASE_URL;?>index.php?act=code&op=captcha_code";
		var query = {captcha: $(this).val()};
		$.ajax({
			url: ajaxurl,
			data: query,
			type: "post",
			dataType: "json",
			success: function (result) {
				if (result.status == 1) {
					return true;
				}
				if (result.status == -1) {
					alert(result.msg);
				}
			}
		});
	})
</script>
