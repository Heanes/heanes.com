jQuery(document).ready(function() {
	//选择主题时的js脚本
	ShowImage();//鼠标浮上时大图效果
	
	
});
/**
 * 选择主题的js脚本
 * @author 方刚
 * @time 2014-09-23 17:36:28
 */
var ShowImage = function() {
	xOffset = 10;
	yOffset = 30;
	$("#imglist").find("img").hover(function(e) {
		$("<img id='imgshow' src='" + this.src + "' />").appendTo("body");
		// 下面是两种样式赋值方法
		// $("#imgshow").css("top", (e.pageY - xOffset) + "px").css("left",
		// (e.pageX + yOffset) + "px").fadeIn("slow");
		$("#imgshow").css({
			"top" : (e.pageY - xOffset) + "px",
			"left" : (e.pageX + yOffset) + "px"
		}).fadeIn("slow");
	}, function() {
		$("#imgshow").remove();
	});
	
	$(".theme").hover(function(e) {
		$(".theme_down").css({"display":"block"})
		// 下面是两种样式赋值方法
		// $("#imgshow").css("top", (e.pageY - xOffset) + "px").css("left",
		// (e.pageX + yOffset) + "px").fadeIn("slow");
	}, function() {
		$(".theme_down").css({"display":"none"})
	});
};