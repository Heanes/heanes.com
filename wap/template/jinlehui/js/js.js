/**
 * @doc 手机页面js脚本
 * @author 方刚
 * @time 2015-05-13 16:58:14
 */
$(function () {
	/****************************************首页区域*******************************************/
	$(document).ready(function () {

	});
	/****************************************各页面区域*******************************************/
	/*********************************仿iPhone通讯录通讯录*******************************************/
	/**
	 * 仿iPhone通讯录形式用户列表
	 * @author 方刚
	 * @time 2015-05-18 13:55:29
	 */
	if (jQuery.isFunction(jQuery.fn.sliderNav)) {
		$('#slider').sliderNav();
		$('#transformers').sliderNav({items: ['autobots', 'decepticons'], debug: true, height: '300', arrows: false});
	}

	/**
	 * @doc 弹出登录窗口
	 * @author 方刚
	 * @time 2015-05-20 17:18:26
	 */
	$('#showMiniLogin').click(function () {
		$.dialog({
			fixed: true,
			max: false,
			min: false,
			drag: false,
			resize: false,
			title: '登录',
			content: 'url:loginMini.html'
		});
	});

	/**
	 * @doc 输入数据验证
	 * @author Heanes
	 * @time 2015-06-05 10:35:57
	 */
	jQuery('#data_insert_form').on("submit", function () {
		var user_name = $('input[name="user_name"]');
		//为空验证
		if (user_name.val() == '') {
			alert('请填姓名');
			user_name.css({border: '1px solid red'});
			return false;
		}
		//长度验证
		if (user_name.val().length < 2) {
			alert('姓名至少2个字符');
			user_name.css({border: '1px solid red'});
			return false;
		}

		var mobile = $('input[name="mobile"]');
		//为空验证
		if (mobile.val() == '') {
			alert('请填电话号码');
			mobile.css({border: '1px solid red'});
			return false;
		}
		//长度验证
		if (mobile.val().length < 2) {
			alert('电话号码格式错误！');
			mobile.css({border: '1px solid red'});
			return false;
		}
		
	});

	/**
	 * @doc 点击表头thead 第一行折叠表格
	 * @author 方刚
	 * @time 2015-05-21 17:51:34
	 */
	$('.lap').click(function () {
		if ($(this).parent().parent().hasClass("folded")) {
			$(this).parent().parent().removeClass("folded");
			$(this).find('i.triangle-down').removeClass('triangle-down').addClass('triangle-up');

		} else {
			$(this).parent().parent().addClass("folded");
			$(this).find('i.triangle-up').removeClass('triangle-up').addClass('triangle-down');
		}
	});

	$('#employee_add_form').on("submit", function () {
		var job_radios = document.getElementsByName("job_id");
		var job_check_flag = false;
		for (var i = 0; i < job_radios.length; i++) {
			if (job_radios.item(i).checked == true) {
				job_check_flag = true;
				break;
			}
		}
		if (!job_check_flag) {
			alert('未选择职位');
			return false;
		}
	});
});