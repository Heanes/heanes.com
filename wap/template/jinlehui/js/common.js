window.onload=function(){
	/**
	 * @doc 切换标签后标题文字更改
	 * @author Heanes
	 * @time 2015-05-09 12:49:28
	 */
	var original_document_title = document.title;
	document.addEventListener("visibilitychange", function () {
		document.title = document.hidden ? '你快回来~ | 金乐汇 - '+ original_document_title : original_document_title;
	});

	/**
	 * @doc 页面等待加载时显示信息
	 * @author Heanes
	 * @time 2015-08-14 12:51:38
	 */
	//document.write('<div id="loading" style="position:absolute;top:0;z-index:2;background:#fff;height:100%;width:100%"><style type="text/css">body{margin:0;padding:0;}</style><div style="background:rgba(0,0,0,0.8);border-radius:5px;position:absolute;top:50%;left:50%;margin:-15px 0 0 -80px;padding:0 10px;line-height:30px;font-size:14px;height:30px;text-align:center;color:#f1f1f1">正在玩命加载中...</div></div>');
};

/**
 * @doc 检测浏览器是否是微信
 * @returns {boolean}
 * @author Heanes
 * @time 2015-07-31 13:05:54
 */
function isWeiXin(){
	var ua = window.navigator.userAgent.toLowerCase();
	return ua.match(/MicroMessenger/i) == 'micromessenger';
}

/**
 * @doc 页面效果
 * @author Heanes
 * @time 2015-06-09 12:49:45
 *
 */
jQuery(function () {

	if(!isWeiXin()){
		//alert('请在微信上访问！');
		//$('body').html('<p style="text-align:center;">请在微信上访问！</p>');
	}

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
			alert('未填写用户名或手机号！');
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
	 * @doc 注册数据验证（提交时）
	 * @author Heanes
	 * @time 2015-06-04 15:42:16
	 */
	jQuery('#reg_form').on("submit", function () {

		//手机号验证
		var user_mobile = $('input[name="user_mobile"]');
		//为空验证
		if (user_mobile.val() == '') {
			alert('未填写用户名或手机号！');
			user_mobile.css({border: '1px solid red'});
			return false;
		}

		//长度验证
		if (user_mobile.val().length < 2) {
			alert('手机号过短！');
			user_mobile.css({border: '1px solid red'});
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
			user_pwd.css({border: '1px solid red'});
			return false;
		}
		if (user_pwd.val().length > 64) {
			alert('密码长度太长');
			user_pwd.css({border: '1px solid red'});
			return false;
		}
		//重复密码验证
		var user_pwd_repeat = $('input[name="user_pwd_repeat"]');
		if (user_pwd_repeat.val() != user_pwd.val()) {
			alert('两次密码填写不一致！');
			user_pwd_repeat.css({border: '1px solid red'});
			return false;
		}

	});


	/**
	 * @doc 提交贷款不通过原因验证（提交时）
	 * @author Heanes
	 * @time 2015-06-05 09:43:00
	 */
	jQuery('#loan_refuse_form').on("submit", function () {
		//评论内容验证
		var refuse_reason = $('textarea[name="refuse_reason"]');
		//为空验证
		if (refuse_reason.val() == '') {
			alert('请填写原因');
			refuse_reason.css({border: '1px solid red'});
			return false;
		}

		//长度验证
		if (refuse_reason.val().length < 5) {
			alert('不通过原因至少5个字符');
			refuse_reason.css({border: '1px solid red'});
			return false;
		}
	});

	// 贷款不通过原因验证（输入时）
	var refuse_reason = $('textarea[name="refuse_reason"]');
	refuse_reason.on("blur input", function () {
		verify.StringLength(this, 5);
	});

	/**
	 * @doc 评论提交验证（提交时）
	 * @author Heanes
	 * @time 2015-06-05 09:43:00
	 */
	jQuery('#add_comment').on("submit", function () {
		//评论内容验证
		var comment_content = $('textarea[name="comment_content"]');
		//为空验证
		if (comment_content.val() == '') {
			alert('请填写评论内容');
			comment_content.css({border: '1px solid red'});
			return false;
		}

		//长度验证
		if (comment_content.val().length < 1) {
			alert('评论内容至少1个字');
			comment_content.css({border: '1px solid red'});
			return false;
		}
	});
	// 评论长度验证（输入时）
	var comment_content = $('textarea[name="comment_content"]');
	comment_content.on("input", function () {
		verify.StringLength(this, 1);
	});



	/**
	 * @doc 图片未找到时的处理
	 * @author Heanes
	 * @time 2015-07-08 12:10:55
	 */
	//方式一，针对单个
	/*
	 var img = document.getElementById("myImg");
	 img.onerror = function () {
	 this.style.display = "none";
	 };
	 */
	//方式二，正对整站
	//jQuery方式
	$("img").error(function () {
		//$(this).attr("src","/public/static/image/common/image_not_found.png");
	});
	//原生JS形式
	var images=document.getElementsByTagName("img");
	for(i=0;i<images.length;i++){
		images[i].onerror=function(){
			this.src = "/public/static/image/common/image_not_found.png";
		};
		//images[i].style.height="247px";
	}

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
	VerifyIDCard: function (_this) {
		var _count = "123456";
		var _value = $(_this).val();
		//console.log(_value)
		if (_value != _count) {
			showNotice(_this);
		} else {
			hideNotice(_this);
		}
	}//身份证号验证
};

/**
 * @doc 计算页面的实际高度，iframe自适应会用到
 * @param doc 调整对象
 * @returns {number}
 * @author 方刚
 * @time 2015-05-18 15:51:15
 */
function calcPageHeight(doc) {
	var cHeight = Math.max(doc.body.clientHeight, doc.documentElement.clientHeight);
	var sHeight = Math.max(doc.body.scrollHeight, doc.documentElement.scrollHeight);
	return Math.max(cHeight, sHeight);
}
/**
 * @doc 自动设置iframe高度
 * @author 方刚
 * @time 2015-05-18 15:51:15
 */
function autoHeight() {
	var height = calcPageHeight(document.getElementById('autoHeight').contentWindow.document);
	//console.log(document);
	//console.log(document.getElementById('autoHeight').contentWindow.document);
	parent.document.getElementById('autoHeight').style.height = height + 'px';
}

/**
 * @doc 是否存在指定函数
 * @author 方刚
 * @time 2015-05-18 15:55:29
 */
function isExitsFunction(fname, object) {
	object = !object || typeof object !== 'object' ? window : object;
	return typeof object[fname] === 'function';
}

/**
 * @doc 是否存在指定变量
 * @param variableName 变量名称
 * @returns {boolean} true-存在，false-不存在
 * @author 方刚
 * @time 2015-05-18 15:55:46

 */
function isExitsVariable(variableName) {
	try {
		return typeof(variableName) != "undefined";
	} catch (e) {
	}
	return false;
}

/*
 * 为低版本IE添加placeholder效果
 *
 * 使用范例：
 * [html]
 * <input id="captcha" name="captcha" type="text" placeholder="验证码" value="" >
 * [javascrpt]
 * $("#captcha").placeholder();
 *
 * 生效后提交表单时，placeholder的内容会被提交到服务器，提交前需要把值清空
 * 范例：
 * $('[data-placeholder="placeholder"]').val("");
 * $("#form").submit();
 *
 */
(function ($) {
	$.fn.placeholder = function () {
		var isPlaceholder = 'placeholder' in document.createElement('input');
		return this.each(function () {
			if (!isPlaceholder) {
				$el = $(this);
				$el.focus(function () {
					if ($el.attr("placeholder") === $el.val()) {
						$el.val("");
						$el.attr("data-placeholder", "");
					}
				}).blur(function () {
					if ($el.val() === "") {
						$el.val($el.attr("placeholder"));
						$el.attr("data-placeholder", "placeholder");
					}
				}).blur();
			}
		});
	};
})(jQuery);
