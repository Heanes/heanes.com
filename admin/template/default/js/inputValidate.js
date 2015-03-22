/**
 * 输入相关公共验证部分
 */

/**
 * 输入相关登录部分的js脚本
 */

$(function() {
	/**
	 * 管理后台登录
	 */
	$('#admin_keyword').focus(function() {
		if ($(this).val() == '请输入管理员账号') {
			$(this).val("");
		}
	});

	$('#admin_keyword').blur(function() {
		if ($(this).val() == "") {
			$(this).val('请输入管理员账号');
		}
	});

	$('#keypwd').focus(function() {
		if ($(this).val() == '请输入密码') {
			$(this).val("");
		}
		document.getElementById("keypwd").type = "password";
	});

	$('#keypwd').blur(function() {
		if ($(this).val() == "") {
			$(this).val('请输入密码');
			document.getElementById("keypwd").type = "text";
		}
	});
	
	$('.login').click(function () {
        if ($('#admin_keyword').val() == "" || $('#keypwd').val() == "" || $('#code').val() == "") { $('.tip').html('用户名或密码不可为空！');}
        else {
            location.href = 'index.html';
        }
    });
});

/**
 * 输入相关注册验证部分
 */
