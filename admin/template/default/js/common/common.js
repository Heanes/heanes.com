/**
 * 后台公共js库
 * @author 方刚
 * @time 2014-07-23 17:38:06
 */
$(document).ready(function() {
	
	$('#new_tab').click(function() {
		var current_frame=window.location;
		var a = $("<a href='"+current_frame+"' target='_blank'>新窗打开</a>").get(0);  
        var e = document.createEvent('MouseEvents');  
        e.initEvent('click', true, true);  
        a.dispatchEvent(e);  
        console.log('event has been changed');  
	})
	
	/*分类树折叠功能*/
	$('.lap-tree-icon').click(function(event){
		var first_container = $(this).parent();
		var second_container = first_container.parent();
		second_container.next().toggle();
		$(this).html(($(this).html()=='+')? '-' :'+');
	});
	
	// 多行删除事件
	$(':button.btn-danger').click(function(event) {
		var checkedTr=$('table.table-data-list tbody tr td').find('input[name="check"]:checked').parent().parent();
		if(checkedTr.length >0){
			checkedTr.parent().parent().removeClass('table-striped');
			checkedTr.addClass('bgRed');
		}else{
			alert('未选中任何数据');
			return false;;
		}
		//选中后的该列数据闪烁
		checkedTrTwinkle = setInterval(function(){checkedTr.fadeOut(50).fadeIn(40);},180);
		//等待600毫秒后再询问删除
		setTimeout(function(){
			if (!confirm('你确认删除吗？')) {
				checkedTr.removeClass('bgRed');
				checkedTr.parent().parent().addClass('table-striped');//bootstrap表格样式中隔行背景色冲突，需移去此样式
				clearInterval(checkedTrTwinkle);
				return false;
			}else{
				checkedTr.removeClass('bgRed');
				checkedTr.parent().parent().addClass('table-striped');
				clearInterval(checkedTrTwinkle);
				checkedTr.remove();
			}
		},900);
	});
	//单个checkbox按钮点击事件
	$('table.table-data-list tbody tr td :checkbox').click(function(){
		event.stopPropagation();//// 只执行单个按钮的click，如果注释掉该行，将执行整个tr的click
	})
	
	//单行按钮删除确认
	$('a.btn-danger').click(function(event){
		var checkedTr=$(this).parent().parent();
		checkedTr.unbind("mouseenter mouseleave");//解除bootstarp表格每行hover样式
		var checkbox=checkedTr.find(':checkbox')[0];
		checkbox.checked=true;//改变状态为选中
		$('.checked_count').html($('input[name="check"]:checked').length);
		if (checkedTr.length > 0) {
			checkedTr.parent().parent().removeClass('table-striped');
			checkedTr.addClass('bgRed');
			//覆盖bootstrap对tr和td的hover样式
			checkedTr.hover(function() {
				$(this).css('background-color','red');
				$(this).find('td').css('background-color','red');
			})
		} else {
			alert('未选中任何数据');
			return false;
		}
		//选中后的该列数据闪烁
		checkedTrTwinkle = setInterval(function(){checkedTr.fadeOut(50).fadeIn(40);},180);
		//等待600毫秒后再询问删除
		setTimeout(function(){
			if (!confirm('你确认删除吗？')) {
				clearInterval(checkedTrTwinkle);
				checkbox.checked=false;//改变状态为未选中
				$('.checked_count').html($('input[name="check"]:checked').length);
				checkedTr.parent().parent().addClass('table-striped');
				checkedTr.removeClass('bgRed');
				checkedTr.unbind("mouseenter").unbind("mouseleave");
				checkedTr.css('background-color','');
				checkedTr.find('td').css('background-color','');
				return false;
			}else{
				checkedTr.removeClass('bgRed');
				checkedTr.unbind("mouseenter").unbind("mouseleave");
				checkedTr.css('background-color','blue');
				checkedTr.find('td').removeAttr("style");
				checkedTr.parent().parent().addClass('table-striped');
				clearInterval(checkedTrTwinkle);
				checkedTr.remove();
			}
		},900);
		event.stopPropagation();//// 只执行单个按钮的click，如果注释掉该行，将执行整个tr的click
	})
	//单机整行任意位置选中该行（除第一列和最后一列）
	$('table.table-data-list tbody tr').on('click', function() {
		//$(this).toggleClass('bgRed');
		var checkbox = $(this).find(':checkbox')[0];
		checkbox != null ? checkbox.checked = !checkbox.checked : null;
		$('.checked_count').html($('input[name="check"]:checked').length);
		if($('input[name="check"]:checked').length==$('input[name="check"]').length){
			$('.check_all').prop("checked", true);//这种写法可解决属性为选中但样式没打勾的错误
		}else{
			$('.check_all').prop("checked", false);
		}
	});
	//单个复选框选中后输出被选中统计数目
	$('input[name="check"]').change(function() {
		$('.checked_count').html($('input[name="check"]:checked').length);
		if($('input[name="check"]:checked').length==$('input[name="check"]').length){
			$('.check_all').prop("checked", true);//这种写法可解决属性为选中但样式没打勾的错误
		}else{
			$('.check_all').prop("checked", false);
		}
	});
	
	//全选/全不选
	$('.check_all').change(function() {
		if ($('.check_all').is(":checked")==true) {
			$('input[name="check"]').each(function() {
				this.checked = true;
			})
		}else{
			$('input[name="check"]').each(function() {
				this.checked = false;
			})
		}
		$('.checked_count').html($('input[name="check"]:checked').length);
	});
	//反选
	$('.check_reverse').change(function() {
		$('input[name="check"]').each(function() {
			if(this.checked == true){
				this.checked=false
			}else {
				this.checked=true
			}
		})
		$('.checked_count').html($('input[name="check"]:checked').length);
		if($('input[name="check"]:checked').length==$('input[name="check"]').length){
			$('.check_all').prop("checked", true);//这种写法可解决属性为选中但样式没打勾的错误
		}else{
			$('.check_all').prop("checked", false);
		}
	});
	
	/* 右下角导航事件响应 */
	//添加要加载执行的事件:
	//addLoadEvent(gotoTop('goto_top', false , 1000));
	//addLoadEvent(gotoBottom('goto_bottom', false , 100));
	/*
	var clientHeight=document.documentElement.clientHeight || document.body.clientHeight;
	alert(clientHeight);//839
	var scrollHeight=document.documentElement.scrollHeight || document.body.scrollHeight;
	alert(scrollHeight);//2030
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	alert(scrollTop);//1191
	*/
	/**
	 * 回到顶部功能
	 * 第一个参数是按钮id；
	 * 第二个参数是一个布尔值，true是一直显示按钮，false是当滚动距离不为0时，显示按钮；
	 * 第三个参数是滚动高度，默认为1000
	*/
	function gotoTop(id, show,height) {
		var oTop = document.getElementById(id);
		var bShow = show;
		if (!bShow) {
			oTop.style.display = 'none';
			setTimeout(btnShow(height), 50);
		}
		oTop.onclick = scrollToTop;
		function scrollToTop() {
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			var iSpeed = Math.floor(-scrollTop / 2);
			if (scrollTop <= 0) {
				if (!bShow) {
					oTop.style.display = 'none';
				}
				return;
			}
			document.documentElement.scrollTop = document.body.scrollTop = scrollTop + iSpeed;
			setTimeout(arguments.callee, 50);
		}
		function btnShow(height) {
			height = height!=null? height:1000;
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			if (scrollTop >= height) {
				oTop.style.display = 'block';
			} else {
				oTop.style.display = 'none';
			}
			setTimeout(arguments.callee, 50);
		}
	}
	/**
	 * 回到底部功能
	 * 第一个参数是按钮id；
	 * 第二个参数是一个布尔值，true是一直显示按钮，false是当滚动距离不为0时，显示按钮；
	 * 第三个参数是滚动高度，默认为1000
	 */
	function gotoBottom(id, show,height) {
		var oTop = document.getElementById(id);
		var bShow = show;
		if (!bShow) {
			oTop.style.display = 'block';
			setTimeout(btnShow(height), 50);
		}
		oTop.onclick = scrollToBottom;
		function scrollToBottom() {
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
			var iSpeed = Math.floor(-scrollTop / 2);
			if (scrollTop <= 0) {
				if (!bShow) {
					oTop.style.display = 'none';
				}
				return;
			}
			document.documentElement.scrollTop = document.body.scrollHeight = scrollHeight + iSpeed;
			setTimeout(arguments.callee, 50);
		}
		function btnShow(height) {
			height = height!=null? height:100;
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			var clientHeight=document.documentElement.clientHeight || document.body.clientHeight;
			var scrollHeight=document.documentElement.scrollHeight || document.body.scrollHeight;
			if (scrollTop + clientHeight >= scrollHeight-height) {
				oTop.style.display = 'none';
			} else {
				oTop.style.display = 'block';
			}
			setTimeout(arguments.callee, 50);
		}
	}
	
	//监听load事件，防止冲突;
	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {//判断类型是否为'function',注意typeof返回的是字符串
			window.onload = func;
		} else {
			window.onload = function() {
				oldonload();//调用之前覆盖的onload事件的函数---->由于我对js了解不多,这里我暂时理解为通过覆盖onload事件的函数来实现加载多个函数
				func();
			}
		}
	}
});

/**
 * 更改图片验证码
 * @author 方刚
 * @time 2014-10-27 10:46:31
 */
function changeCaptchaCode(id_str) {
	document.getElementById(id_str).src = "../source/instance/captcha.inst.php?id="
			+ Math.random();
}

/**
 * 上传图片后实时载入图片显示到指定标签
 * 
 * @author 方刚
 * @time 2014-09-17 09:50:29
 */
function load_img(src, ID) {
	var src = document.getElementById("upload_img").value;
	document.getElementById("upload_img_show").src = src;
}

/* 删除确认 */
function delID(ID, url, mes) {
	var mymes;
	mymes = confirm(mes);
	if (mymes == true) {
		window.location = url + ID;
	}
}

//不同时间显示不同提示，优秀代码提示
function showTimeTips(){
	var h = new Date().getHours();
	var arr = [ 0, 6, 12, 18, 24 ], msg = '', t = [], m = [
	                                                       '凌晨好', '早上好', '下午好', '晚上好' ];
	for (var i = 0, len = arr.length; i < len; i++) {
		t[i] = h - arr[i];
		if (t[i] <= 0) {
			msg = m[i - 1];
			break;
		}
	}
}

/*
 * 对页面上的字体增大、缩小、恢复原始大小 需要在html页面中定义三个元素 元素的class分别为
 * resetFont、increaseFont、decreaseFont
 * 在本文件的JQuery事件中分别定义了三个元素的click事件来实现增大、缩小、恢复原始大小
 */
$(function() {
	// 取得字体大小，在html标记下定义了font-size
	var originalFontSize = $("html").css("font-size");
	// 恢复默认字体大小
	$(".resetFont").click(function() {
		$(".table-data-list tbody tr td").css("font-size", originalFontSize);
		// JavaScript不向下执行
		return false;
	});

	// 加大字体,某个元素的class定义为increaseFont
	$(".increaseFont").click(function() {
		// 取得当前字体大小 后缀px,pt,pc
		var currentFontSize = $(".table-data-list tbody tr td").css("font-size");
		// 取得当前字体大小，parseFloat()转为float类型去除后缀
		var currentFontSizeNumber = filterFontSize(currentFontSize);
		// 新定义的字体大小
		var newFontSize = currentFontSizeNumber + 1;
		// 重写样式表
		$(".table-data-list tbody tr td").css("font-size", newFontSize);
		// JavaScript不向下执行
		return false;
	});

	// 减小字体，某个元素的class定义为decreaseFont
	$(".decreaseFont").click(function() {
		// 取得当前字体大小 后缀px,pt,pc
		var currentFontSize = $(".table-data-list tbody tr td").css("font-size");
		// 取得当前字体大小，parseFloat()转为float类型去除后缀
		var currentFontSizeNumber = filterFontSize(currentFontSize);
		// 重新定义字体大小
		var newFontSize = currentFontSizeNumber - 1;
		// 重写样式表
		$(".table-data-list tbody tr td").css("font-size", newFontSize);
		// JavaScript不向下执行
		return false;
	});
});

/* 过滤字体单位 */
function filterFontSize(string){
	string = string.replace(/px/g,'');
	string = string.replace(/em/g,'');
	string = string.replace(/rem/g,'');
	return Number(string);
}

/**
 * 动态显示当前时间
 * 通过id="time"来调用
 * Time 2014.06.23
 */
function getDateAndTimeStatic(str) {
	var now = new Date();// 获取当前时间
	var year = now.getFullYear();// 年
	var month = now.getMonth() + 1;// 月
	var date = now.getDate();// 日
	var day = now.getDay();// 星期
	var hour = now.getHours();// 时
	var minute = now.getMinutes();// 分
	var second = now.getSeconds();// 秒
	if (hour < 10)
		hour = "0" + hour;
	if (minute < 10)
		minute = "0" + minute;
	if (second < 10)
		second = "0" + second;
	if (date < 10)
		date = "0" + date;
	if (month < 10)
		month = "0" + month;
	dateAndTimeString=year + "." + month + "." + date + " " + hour + ":" + minute + ":" + second;
	return dateAndTimeString;
}
/**
 * 动态显示当前时间
 * 通过id="time"来调用
 * Time 2014.06.23
 */
function showDynamicDateAndTime(selector) {
	var now = new Date();// 获取当前时间
	var year = now.getFullYear();// 年
	var month = now.getMonth() + 1;// 月
	var date = now.getDate();// 日
	var day = now.getDay();// 星期
	var hour = now.getHours();// 时
	var minute = now.getMinutes();// 分
	var second = now.getSeconds();// 秒
	if (day == 0)
		day = "周天";
	else if (day == 1)
		day = "周一";
	else if (day == 2)
		day = "周二";
	else if (day == 3)
		day = "周三";
	else if (day == 4)
		day = "周四";
	else if (day == 5)
		day = "周五";
	else if (day == 6)
		day = "周六";
	if (hour < 10)
		hour = "0" + hour;
	if (minute < 10)
		minute = "0" + minute;
	if (second < 10)
		second = "0" + second;
	if (date < 10)
		date = "0" + date;
	if (month < 10)
		month = "0" + month;
	dateAndTimeString=year + "." + month + "." + date + "&nbsp;" + day + "&nbsp;" + hour + ":" + minute + ":" + second;
	document.getElementById('js_time_now').innerHTML = year + "." + month + "." + date
			+ "&nbsp;" + day + "&nbsp;" + hour + ":" + minute + ":" + second;
	// 刷新时间
	setTimeout('showDynamicDateAndTime()', 1000);
	return dateAndTimeString;
}