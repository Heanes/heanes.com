<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<div class="reg-block-popup-layer">
		<form action="" method="post" name="reg_form" id="reg_form">
			<div class="reg-field reg-mobile">
				<input type="text" name="mobile" placeholder="手机号" required />
				<p class="reg-tip input-error-notice">手机号不正确</p>
			</div>
			<div class="reg-field mobile-verify-code">
				<input type="text" name="mobile_verify_code" placeholder="输入手机验证码" required />
				<span class="get-mobile-verify-code">获取验证码</span>
				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>
			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd" placeholder="请输入密码" required />
				<p class="reg-tip input-error-notice">密码长度不够</p>
			</div>
			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd_repeat" placeholder="请再次确认密码" required />
				<p class="reg-tip input-error-notice">两次密码输入不一致</p>
			</div>
			<div class="reg-field reg-captcha">
				<input type="password" name="captcha" placeholder="验证码" maxlength="4" required />
				<span class="captcha-wrap">
					<img alt="" src="<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d" class="captcha-code"
						 onclick="this.src='<?php echo BASE_URL;?>index.php?act=captcha&op=makeCaptcha&width=100&height=40&hash=4a0bd59d&t=' + Math.random();" />
				</span>
				<p class="reg-tip input-error-notice">验证码不正确</p>
			</div>
			<div class="reg-clause">
				<p>
					<input type="checkbox" name="reg_law_check" checked="checked" />我已阅读并同意<a href="" class="law-href">《金乐汇交易条款》</a>
				</p>
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
				<a href="<?php echo BASE_URL;?>index.php?act=login&style=mini" class="href-duck">已有帐号？</a>
			</div>
		</div>
	</div>
</div>
