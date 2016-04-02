<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=member&op=login">返回登录</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=user_update">修改密码</a></li>
		</ul>
	</div>
	<div class="reg-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=user_pwd" method="post" name="reg_form" id="reg_form">
			<div class="reg-field reg-mobile">
				<input type="text" name="user_pwd" placeholder="旧密码" required value="" autofocus />
			</div>


			<div class="reg-field reg-captcha">
				<input type="text" name="captcha" placeholder="验证码" maxlength="4" required autocomplete="off" value="" />
				                <span class="captcha-wrap">
				                	<img alt="" src="<?php echo BASE_URL; ?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d" class="captcha-code"
										 onclick="this.src='<?php echo BASE_URL; ?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d&t=' + Math.random();" />
			                	</span>

				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>

			<div class="reg-handle">
				<div class="reg-handle-field">
					<input type="submit" class="reg-submit" name="reg_form_submit" value="下一步" />
				</div>
			</div>
		</form>

	</div>
</div>

