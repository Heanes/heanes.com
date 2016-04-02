<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<div class="login-block-popup-layer">
		<form action="" method="post" name="login_form" id="login_form">
			<div class="login-field login-user-account">
				<input type="text" name="user_name" placeholder="输入用户名/手机号" required />
				<p class="login-tip input-error-notice">用户名/手机号太短</p>
			</div>
			<div class="login-field login-user-pwd">
				<input type="password" name="user_pwd" placeholder="输入密码" required />
				<p class="login-tip input-error-notice">密码长度不够</p>
			</div>
			<div class="login-field login-captcha">
				<input type="text" name="captcha" placeholder="验证码" maxlength="4" required />
				<span class="captcha-wrap">
					<img alt="" src="<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d" class="captcha-code"
						 onclick="this.src='<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d&t=' + Math.random();" />
				</span>
				<p class="login-tip input-error-notice"></p>
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
			<div class="login-redirect">
				<a href="<?php echo BASE_URL;?>index.php?act=member&op=reg&style=mini"><button class="turn-to-reg">注册</button></a>
			</div>
		</div>
	</div>
</div>
