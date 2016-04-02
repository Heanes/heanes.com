$(document).ready(function() {
	/* 菜单分级 */
	lap_menu();
	/* 菜单全部折叠 */
	$('.lap').click(function(){
		var head=$(this).parent();
		var fct=head.parent();
		var box= fct.find('.box');
		$(this).toggleClass('lap_close');
		if(box.length>0){
			box.removeClass('box');
			box.addClass('box_close');
		}
		else{
			var box_close=fct.find('.box_close');
			box_close.removeClass('box_close');
			box_close.addClass('box');
		}
	});
	
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
 * 菜单折叠部分js，放在body末尾处
 * @author 方刚
 * @time 2014-12-11 16:30:35
 */
function lap_menu() {
	var list = document.getElementById('list').getElementsByTagName('li');
	var div = document.getElementById('menu_content').getElementsByTagName('div');
	var dd = document.getElementById('menu_content').getElementsByTagName('dd');
	var arr = [];
	var arr2 = [];
	var arr3 = [];

	for (var i = 0; i < div.length; i++) {
		if (div[i].className == 'fct') {
			var n = arr.length;
			arr.splice(n, 1, i);
		}
	}

	for (var i = 0; i < list.length; i++) {
		div[arr[i]].className = 'hide';
		list[i].onclick = function() {
			for (var j = 0; j < list.length; j++) {
				list[j].className = '';
				div[arr[j]].className = 'hide';
				if (list[j] == this) {
					div[arr[j]].className = 'fct';
					list[j].className = 'li_current';
				}
			}
		}
	}
	div[arr[0]].className = 'fct';
	for (var i = 0; i < div.length; i++) {
		if (div[i].className == 'box') {
			var n = arr2.length;
			arr2.splice(n, 1, i);
			arr3.splice(n, 1, 0);
		}
	}

	for (var i = 0; i < arr2.length; i++) {
		div[arr2[i]].getElementsByTagName('dt')[0].onclick = function() {
			for (var j = 0; j < arr2.length; j++) {
				if (div[arr2[j]].getElementsByTagName('dt')[0] == this) {
					if (arr3[j] == 0) {
						if (div[arr2[j]].className == 'box') {
							div[arr2[j]].className = 'box_close';
						} else {
							div[arr2[j]].className = 'box';
						}
						// div[arr2[j]].className = 'box_close';
						// div[arr2[j]].getElementsByTagName('dt')[0].className
						// = 'dt_title'
						arr3.splice(j, 1, 1);
						// console.log(arr3)
					} else {
						if (div[arr2[j]].className == 'box') {
							div[arr2[j]].className = 'box_close';
						} else {
							div[arr2[j]].className = 'box';
						}
						// div[arr2[j]].className = 'box';
						// div[arr2[j]].getElementsByTagName('dt')[0].className
						// = 'dt_title_open'
						arr3.splice(j, 1, 0);
						// console.log(arr3)
					}
				}
			}
		}
	}
	for (var i = 0; i < dd.length; i++) {
		dd[i].onclick = function() {
			for (var j = 0; j < dd.length; j++) {
				dd[j].className = '';
				if (dd[j] == this) {
					//console.log(j);
					dd[j].className = 'dd_current';
				}
			}
		}
	}
}
/* 菜单折叠部分js，放在body末尾处  end */