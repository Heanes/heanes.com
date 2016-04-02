<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=member&op=login">返回登录</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=update">找回密码</a></li>
		</ul>
	</div>
	<div class="page-nav-tab">
		<ul>

			<li style="border: none"><h2>设置新密码</h2></li>
		</ul>
	</div>
	<div class="reg-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=resetpwd&op=edit" method="post" name="reg_form" id="reg_form">
			<input type="hidden" name="mobile" value="<?php echo $output['mobile_id']; ?>">

			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd" placeholder="请输入新密码" required value="" />

				<p class="reg-tip input-error-notice">密码长度不够</p>
			</div>
			<div class="reg-field reg-user-pwd">
				<input type="password" name="user_pwd_repeat" placeholder="请再次确认密码" required value="" />

				<p class="reg-tip input-error-notice">两次密码输入不一致</p>
			</div>

			<div class="reg-handle">
				<div class="reg-handle-field">
					<input type="submit" class="reg-submit" name="reg_form_submit" value="提交" />
				</div>
			</div>
		</form>

	</div>
</div>

<script type="text/javascript">
	$(function () {
		var user_pwd = $('input[name="user_pwd"]');
		var yanzheng = /^(?=.{6,16}$)(?![0-9]+$)[0-9a-zA-Z]+$/;
		user_pwd.blur(function () {
			if (yanzheng.test($(this).val()) == false) {
				alert('密码必须包含字母且长度不可超过16位。');
			}
		})

	})
</script>