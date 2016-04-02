$(document).ready(function() {
	/* 可隐藏可拖拽后台框架布局 */
	if($('.ui-layout-center').length){
		$('body').layout({
			spacing_open : 3, // 边框的间隙
			spacing_closed : 3, // 关闭时边框的间隙
			resizerDragOpacity : 0.5,// 拖拽时透明度
			north__size : 81, // 顶部页面高度
			west__size : 170, // 左侧页面宽度
			//east__size : 120, // 右侧页面宽度
			east__size : 0, // 右侧页面宽度
			south__size : 18	// 底部页面高度
		});
	}
	
	/* 动态显示当前时间 */
	if(document.getElementById("js_time_now")){
		showDynamicDateAndTime('js_time_now');
	}
	
	/* 导航栏 */
	$('#nav_go_back').click(function(){
		history.go(-1);
	});
	$('#nav_go_next').click(function(){
		history.go(1);
	});
	$('#nav_frame_refresh').click(function(){
		top.frames['conframe'].location.reload();
	});
	$('#nav_default_page').click(function(){
		//window.location.href="index.php";
	});
	$('#log_out').click(function(){
		if (!confirm('你确认退出吗？')) {
			return false;
		}
	});
	
	//搜索框失焦功能
	/* 用placehoder 代替
	var default_search_str = $('#input_search').val();
	$('#input_search').focus(function(){
		if(this.value==default_search_str){
			this.value="";
		}
	});
	$('#input_search').blur(function(){
		if(this.value==""){
			this.value=default_search_str;
		}
	});
	*/
	
	/* 菜单点击后将被点击链接传到面包屑导航 */
	$('#nav_default_frame').click(function(){
		$('#nav_location').css('display','none');
	});
	
	if($('#current_location').html()==''){
		$('#nav_location').css('display','none');
	}else{
		$('#nav_location').css('display','inline');
	}
	$('.box dd').click(function(){
		$('#current_location').html($(this).html());
		$('#nav_location').css('display','inline');
	});
});


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
