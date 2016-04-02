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
	
	$(".theme").hover(function() {
		$(".theme_down").css({"display":"block"});
		// 下面是两种样式赋值方法
		// $("#imgshow").css("top", (e.pageY - xOffset) + "px").css("left",
		// (e.pageX + yOffset) + "px").fadeIn("slow");
	}, function() {
		$(".theme_down").css({"display":"none"})
	});
};


<!-- 表单的验证 -->
/*下拉输入框的相关操作*/
var Select = {
	del : function(obj,e){
		if((e.keyCode||e.which||e.charCode) == 8){
			var opt = obj.options[0];
			opt.text = opt.value = opt.value.substring(0, opt.value.length>0?opt.value.length-1:0);
		}
	},
	write : function(obj,e){
		if((e.keyCode||e.which||e.charCode) == 8)return ;
		var opt = obj.options[0];
		opt.selected = "selected";
		opt.text = opt.value += String.fromCharCode(e.charCode||e.which||e.keyCode);
	}
};

function test(){
	alert(document.getElementById("select").value);
}


$(document).ready(
	function() {
		$("#myform").submit(function(){
			var username=$("#name").val();
			var phone=$("#phone").val();
			var m =  $("#name").val().match(/^[\u4e00-\u9fa5]{2,4}$/i);
			var h =  $("#phone").val().match(/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/);
			if(username=="")
			{
				alert("性名不能为空！");
				$("#name").focus();
				return false;
			}
			if(!m)
			{
				alert("请输入真实姓名！");
				$("#name").focus();
				return false;
			}
			if(phone=="")
			{
				alert("联系电话不能为空！");
				$("#phone").focus();
				return false;
			}
			if(!h)
			{
				alert("请输入正确的手机号码！");
				$("#phone").focus();
				return false;
			}

		});
	});
<!-- 快速表单申请结束 -->
