<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<div class="install-setup-title">
		<h1 class="install-title">海利系统安装程序</h1>
	</div>
	<div class="install-setup-block">
		<form action="" method="post" class="install-setup-form">
			<div class="input-row">
				<div class="input-field">
					<label for="admin_name">管理员名称</label>
					<input type="text" name="admin_name" id="admin_name" value="admin" class="install-normal-input" title="管理员名称" placeholder="管理员名称" required />
				</div>
				<div class="input-tips">
					<span class="tips">后台管理员</span>
				</div>
			</div>
			<div class="input-row">
				<div class="input-field">
					<label for="admin_pwd">管理密码</label>
					<input type="text" name="admin_pwd" id="admin_pwd" value="fg123456" class="install-normal-input" title="管理密码<" placeholder="管理密码" required />
				</div>
				<div class="input-tips">
					<span class="tips">管理员密码</span>
				</div>
			</div>
			<div class="input-row">
				<div class="input-field">
					<label for="admin_pwd_repeat">重复管理密码</label>
					<input type="text" name="admin_pwd_repeat" id="admin_pwd_repeat" value="fg123456" class="install-normal-input" title="重复管理密码" placeholder="重复管理密码" required />
				</div>
				<div class="input-tips">
					<span class="tips">重复管理员密码</span>
				</div>
			</div>
			<div class="input-row">
				<div class="input-field">
					<label for="admin_email">电子邮件</label>
					<input type="text" name="admin_email" id="admin_email" value="admin@heanes.com" class="install-normal-input" title="电子邮件" placeholder="email" required />
				</div>
				<div class="input-tips">
					<span class="tips">请仔细检查电子邮件地址</span>
				</div>
			</div>
			<div class="form-handle">
				<div class="form-handle-field">
					<input type="submit" class="setup-submit" name="install_system_setup_submit" value="提交" />
				</div>
			</div>
		</form>

	</div>
</div>