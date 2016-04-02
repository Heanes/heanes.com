/**
 * 管理后台公共js效果
 * 
 * @author 方刚
 * @time 2014-09-11 17:47:35
 */
$(document).ready(function() {

	/** 左下角日历 */
	$("#datepicker").datepicker();
	$('.one').click(function() {
		$('.one').removeClass('one-hover');
		$(this).addClass('one-hover');
		$(this).parent().find('.kid').toggle();
	});
	// 折叠菜单
	// 左边菜单
	var l = $('.left_c');
	var r = $('.right_c');
	var c = $('.Conframe');
	$('.nav-tip').click(function() {
		if (l.css('left') == '8px') {
			l.animate({
				left : -300
			}, 500);
			r.animate({
				left : 13
			}, 500);
			c.animate({
				left : 18
			}, 500);
			$(this).animate({
				"background-position-x" : "-12"
			}, 300);
		} else {
			l.animate({
				left : 8
			}, 500);
			r.animate({
				left : 256
			}, 500);
			c.animate({
				left : 260
			}, 500);
			$(this).animate({
				"background-position-x" : "0"
			}, 300);
		}
	});
	// 横向菜单
	$('.top-menu-nav li').click(function() {
		$('.kidc').hide();
		$(this).find('.kidc').show();
	});
	$('.kidc').bind('mouseleave', function() {
		$('.kidc').hide();
	})
});
