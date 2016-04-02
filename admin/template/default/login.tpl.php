<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="<?php echo TPL;?>css/login.css" />
<title>登录</title>
</head>
<body>
	<div id="clouds" class="stage"></div>
	<div class="admin_login_box_background"></div>
		<div class="admin_login_box login-block">
			<h1>后台管理系统登录</h1>
			<form action="" method="post" name="login_form" id="login_form">
				<div class="login-field login-user-account">
					<label>管理帐号</label>
					<input type="text" name="admin_user_name" placeholder="输入用户名/手机号" title="请输入用户名或手机号" required />
					<p class="login-tip input-error-notice">账户名不正确</p>
				</div>
				<div class="login-field login-user-pwd">
					<label>密码</label>
					<input type="password" name="admin_user_pwd" placeholder="输入密码" title="密码长度至少为6位" required />
					<p class="login-tip input-error-notice">密码长度不够</p>
				</div>
				<div class="login-field login-captcha">
					<label>验证码</label>
					<input type="text" name="captcha" placeholder="验证码" title="请对照输入右侧图片中的字符" maxlength="4" required autocomplete="off" />
					<span class="captcha-wrap">
						<img alt="" src="<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d" class="captcha-code"
							 onclick="this.src='<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d&t=' + Math.random();" />
					</span>
					<p class="login-tip input-error-notice">验证码错误</p>
				</div>
				<div class="login-handle">
					<div class="login-handle-field">
						<input type="submit" class="login-submit" name="login_form_submit" value="登录" />
					</div>
				</div>
			</form>
			<div class="login-handle-extra">
				<div class="forget-password">
					<a href="" class="href-duck">忘记密码？</a>
				</div>
			</div>
		</div>
    <!-- js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery.spritely/0.6.8/jquery.spritely-0.6.8.js"></script><!-- 云层效果 -->
	<script type="text/javascript" src="<?php echo TPL;?>js/effect.js"></script>
	<script type="text/javascript" src="<?php echo TPL;?>js/chur.min.js"></script><!-- 蒲公英漂浮效果 -->
	<script type="text/javascript">
		snowStorm = new SnowStorm('<?php echo TPL;?>image/chur/');
		jQuery(function () {

			/**
			 *  @doc 登录数据验证（提交时）
			 *  @author Heanes
			 *  @time 2015-06-04 15:40:53
			 */
			jQuery('#login_form').on("submit", function () {

				//用户名验证
				var user_name = $('input[name="user_name"]');
				//为空验证
				if (user_name.val() == '') {
					alert('未填写用户名！');
					user_name.css({border: '1px solid red'});
					return false;
				}
				//长度验证
				if (user_name.val().length < 2) {
					alert('用户名过短！！');
					return false;
				}
				//密码验证
				//为空验证
				var user_pwd = $('input[name="user_pwd"]');
				if (user_pwd.val() == '') {
					alert('未填写密码！');
					user_pwd.css({border: '1px solid red'});
					return false;
				}
				//长度验证
				if (user_pwd.val().length < 6) {
					alert('密码长度过短');
					return false;
				}
				if (user_pwd.val().length > 64) {
					alert('密码长度太长');
					return false;
				}

			});

			/**
			 * @doc 注册登录验证实时响应（输入时）
			 * @author Heanes
			 * @time 2015-06-04 17:45:41
			 */
			//长度验证
			var user_name = $('input[name="user_name"]');
			user_name.on("blur input", function () {
				verify.StringLength(this, 2);
			});

			//为空验证
			var user_pwd = $('input[name="user_pwd"]');
			user_pwd.on("blur input", function () {
				verify.StringLength(this, 6);
			});

		});

		var _handle = false;//储存是否填写正确
		//表单验证
		function showNotice(_this) {
			$(_this).parent().find(".input-error-notice").fadeIn(100);
			//$(_this).focus();
		}//错误提示显示
		function hideNotice(_this) {
			$(_this).parent().find(".input-error-notice").fadeOut(100);
		}//错误提示隐藏
		var verify = {
			verifyEmail: function (_this) {
				var validateReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				var _value = $(_this).val();
				if (!validateReg.test(_value)) {
					showNotice(_this);
					_handle = false;
				} else {
					hideNotice(_this);
					_handle = true;
				}
				return _handle;
			},//验证邮箱
			verifyMobile: function (_this) {
				var validateReg = /^((\+?86)|(\(\+86\)))?1\d{10}$/;
				var _value = $(_this).val();
				if (!validateReg.test(_value)) {
					showNotice(_this);
					_handle = false;
				} else {
					hideNotice(_this);
					_handle = true;
				}
				return _handle;
			},//验证手机号码
			StringLength: function (_this, length) {
				var _length = $(_this).val().length;
				if (_length < length) {
					showNotice(_this);
					_handle = false;
				} else {
					hideNotice(_this);
					_handle = true;
				}
				return _handle;
			},//验证设置密码长度
			VerifyRepeat: function (_this, other) {
				var compare = $(other);
				if ($(_this).val() != compare.val()) {
					showNotice(_this);
					_handle = false;
				} else {
					hideNotice(_this);
					_handle = true;
				}
				return _handle;
			},//重复行验证
			VerifyCount: function (_this) {
				var _count = "123456";
				var _value = $(_this).val();
				//console.log(_value)
				if (_value != _count) {
					showNotice(_this);
				} else {
					hideNotice(_this);
				}
			}//验证验证码
		};
	</script>
	<!-- js E -->
</body>
</html>