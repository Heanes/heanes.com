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
	});
	
	/*分类树折叠功能*/
	$('.lap-tree-icon').click(function(){
		var first_container = $(this).parent();
		var second_container = first_container.parent();
		second_container.next().toggle();
		$(this).html(($(this).html()=='+')? '-' :'+');
	});
	
	// 多行删除事件
	/*
	$(':button.btn-danger').click(function() {
		var checkedTr=$('table.table-data-list tbody tr td').find('input[name="check"]:checked').parent().parent();
		if(checkedTr.length >0){
			checkedTr.parent().parent().removeClass('table-striped');
			checkedTr.addClass('bgRed');
		}else{
			alert('未选中任何数据');
			return false;
		}
		//选中后的该列数据闪烁
		var checkedTrTwinkle = setInterval(function(){checkedTr.fadeOut(50).fadeIn(40);},180);
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
	});
	
	//单行按钮删除确认
	$('a.btn-danger').click(function(event){
		var checkedTr=$(this).parent().parent();
		checkedTr.unbind("mouseenter mouseleave");//解除bootstrap表格每行hover样式
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
		var checkedTrTwinkle = setInterval(function(){checkedTr.fadeOut(50).fadeIn(40);},180);
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
	});
	*/
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
		});
		$('.checked_count').html($('input[name="check"]:checked').length);
		if($('input[name="check"]:checked').length==$('input[name="check"]').length){
			$('.check_all').prop("checked", true);//这种写法可解决属性为选中但样式没打勾的错误
		}else{
			$('.check_all').prop("checked", false);
		}
	});
	

});

/**
 * @doc 删除操作
 * @param string data_object 数据库名称
 * @param integer id id值
 * @param boolean real_delete 是否真实删除
 * @param string controller_class 处理控制器名称，若为空则默认为index控制器
 * @author Heanes
 * @time 2015-09-24 09:42:49
 */
function del (data_object, id, real_delete,controller_class,is_ajax){
	var http_port=window.location.port == ''? '': (':'+window.location.port);
	var base_url=window.location.protocol+'//'+window.location.host+http_port+window.location.pathname;
	if(data_object=='' || id=='') return false;
	if(confirm('你确认删除吗？')){

		//模型到控制器转换，未完成，可以直接到indexController
		var controller_array=[];
		controller_array=data_object.split('_');
		var controller='';
		for(i=0;i<controller_array.length ;i++ ){
			controller=controller+(controller_array[i].toUpperCase());
		}
		var act_controller= typeof(controller_class)=="undefined" ? 'index':controller_class;
		var is_ajax_set= typeof(is_ajax)=="undefined" ? true : is_ajax;
		var ajaxurl = base_url+"?act="+act_controller+"&op=delete";
		var query = {is_ajax:is_ajax_set,data_object:data_object,id:id,real_delete:real_delete};
		$.ajax({
			url:ajaxurl,
			data:query,
			type:"post",
			dataType: "json",
			async: false,
			success:function(result){
				if(result.status==1){
					alert('删除成功！');
					window.location.reload();
					return true;
				}
				if(result.status==-1){
					alert('未知原因，删除失败！');
					return false;
				}
			}
		});
	}else{
		return false;
	}
}


/**
 * 上传图片后实时载入图片显示到指定标签
 * 
 * @author 方刚
 * @time 2014-09-17 09:50:29
 */
function load_img(src, ID) {
	document.getElementById("upload_img_show").src = document.getElementById("upload_img").value;
}

/* 删除确认 */
function delID(ID, url, mes) {
	var mymes;
	mymes = confirm(mes);
	if (mymes == true) {
		window.location = url + ID;
	}
}

/**
 * @doc 点击表标题排序功能
 * @param field 排序字段
 * @param sortType 排序方式
 * @param module_name 模块名称
 * @param action_name 模块的方法名称
 * @author Heanes
 * @time 2015-07-05 22:05:05
 */
function sortBy(field,sortType,module_name,action_name){
    location.href = CURRENT_URL+"&_sort="+sortType+"&_order="+field;
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
		var target_style=$(".table-data-list tbody tr td");
		var currentFontSize = target_style.css("font-size");
		// 取得当前字体大小，parseFloat()转为float类型去除后缀
		var currentFontSizeNumber = filterFontSize(currentFontSize);
		// 新定义的字体大小
		var newFontSize = currentFontSizeNumber + 1;
		// 重写样式表
		target_style.css("font-size", newFontSize);
		// JavaScript不向下执行
		return false;
	});

	// 减小字体，某个元素的class定义为decreaseFont
	$(".decreaseFont").click(function() {
		// 取得当前字体大小 后缀px,pt,pc
		var target_style=$(".table-data-list tbody tr td");
		var currentFontSize = target_style.css("font-size");
		// 取得当前字体大小，parseFloat()转为float类型去除后缀
		var currentFontSizeNumber = filterFontSize(currentFontSize);
		// 重新定义字体大小
		var newFontSize = currentFontSizeNumber - 1;
		// 重写样式表
		target_style.css("font-size", newFontSize);
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
function getDateAndTimeStatic() {
	var now = new Date();// 获取当前时间
	var year = now.getFullYear();// 年
	var month = now.getMonth() + 1;// 月
	var date = now.getDate();// 日
	//var day = now.getDay();// 星期
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
	return year + "." + month + "." + date + " " + hour + ":" + minute + ":" + second;
}
/**
 * 动态显示当前时间
 * 通过id="time"来调用
 * Time 2014.06.23
 */
function showDynamicDateAndTime() {
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
	var dateAndTimeString=year + "." + month + "." + date + "&nbsp;" + day + "&nbsp;" + hour + ":" + minute + ":" + second;
	document.getElementById('js_time_now').innerHTML = year + "." + month + "." + date
			+ "&nbsp;" + day + "&nbsp;" + hour + ":" + minute + ":" + second;
	// 刷新时间
	setTimeout('showDynamicDateAndTime()', 1000);
	return dateAndTimeString;
}