/*关系人主DIV弹窗*/
function popMaster(){
	//将窗口居中
	makeCenter1();
	//初始化列表
	initUidMaster();
}
//隐藏窗口
function hide1()
{
	$('#choose-box-wrapper1').css("display","none");
}
function makeCenter1()
{
	$('#choose-box-wrapper1').css("display","block");
	$('#choose-box-wrapper1').css("position","absolute");
	$('#choose-box-wrapper1').css("top", Math.max(0, (($(window).height() - $('#choose-box-wrapper1').outerHeight()) / 2) + $(window).scrollTop()) + "px");
	$('#choose-box-wrapper1').css("left", Math.max(0, (($(window).width() - $('#choose-box-wrapper1').outerWidth()) / 2) + $(window).scrollLeft()) + "px");
}


/*关系人客DIV弹窗*/
function popSlave(){
	//将窗口居中
	makeCenter2();
	//初始化列表
	initUidSlave();
}
//隐藏窗口
function hide2()
{
	$('#choose-box-wrapper2').css("display","none");
}
function makeCenter2()
{
	$('#choose-box-wrapper2').css("display","block");
	$('#choose-box-wrapper2').css("position","absolute");
	$('#choose-box-wrapper2').css("top", Math.max(0, (($(window).height() - $('#choose-box-wrapper2').outerHeight()) / 2) + $(window).scrollTop()) + "px");
	$('#choose-box-wrapper2').css("left", Math.max(0, (($(window).width() - $('#choose-box-wrapper2').outerWidth()) / 2) + $(window).scrollLeft()) + "px");
}

//鼠标拖拽事件
var drag_=false
var D=new Function('obj','return document.getElementById(obj);')
var oevent=new Function('e','if (!e) e = window.event;return e')
function Move_obj(obj){
	var x,y;
	D(obj).onmousedown=function(e){
		drag_=true;
		with(this){
			style.position="absolute";
			var temp1=offsetLeft;
			var temp2=offsetTop;
			x=oevent(e).clientX;y=oevent(e).clientY;
			document.onmousemove=function(e){
				if(!drag_)return false;
				with(this){
					style.left=temp1+oevent(e).clientX-x+"px";
					style.top=temp2+oevent(e).clientY-y+"px";
				}
			}
		}
		document.onmouseup=new Function("drag_=false");
	}
}
