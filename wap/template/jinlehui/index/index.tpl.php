<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<?php if(count($output['slideWapList'])){?>
	<!-- S 响应式幻灯部分 S -->
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<!--
		<div class="boxone dis">
			<form id="user_form" method="post" action="http://jinlehui.net/index.php?ctl=query&act=add">
				<fieldset class="contact-inner">
					<p class="contact-input">
						<label for="select" class="select-one">
							<select name="yongtu" id="select-one" onkeydown="Select.del(this,event)" onkeypress="Select.write(this,event)">
								<option value="" selected>贷款类型：</option>
								<option value="抵押贷款">抵押贷款</option>
								<option value="信用贷款">信用贷款</option>
							</select>
						</label>
					</p>
					<p class="contact-input">
						<input id="select-two" type="text" name="pic" placeholder="贷款金额（万元）" >
					</p>
					<p class="contact-input">
						<input id="phone" type="text" name="phone" placeholder="联系电话" >
					</p>
					<p class="contact-submit">
						<input type="submit" value="立 即 申 请" name="but">
					</p>
				</fieldset>
			</form>
		</div>
		-->
		<!-- 首页幻灯 -->
		<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
		<!--
		<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/css/jquery.excoloSlider.css" />
		-->
		<div class="index-slide text-center" id="index_slide">
			<?php foreach ($output['slideWapList'] as $key => $slideWap) {?>
				<a href="<?php echo $slideWap['a_href']?>"><img src="<?php echo $slideWap['img_src']?>" alt="<?php echo $slideWap['img_src']?>" /></a>
			<?php }?>
		</div>
		<script type="text/javascript">
			/**
			 * 响应式幻灯，支持触摸滑动，将JS脚本放在html中是为了响应更快，避免未加载完成时造成页面排版错乱的情况
			 * @author 方刚
			 * @time 2014-11-28 14:02:12
			 */
			if (jQuery.isFunction(jQuery.fn.excoloSlider)) {
				var slider=$("#index_slide").excoloSlider({
					pagerClass: "index-slide-pager",
					autoPlay: true,
					height: 'auto'
				});
			}
		</script>
	<!-- E 响应式幻灯部分 E -->
	<?php }?>
	<!-- S 大色块 设计高度为180px  S -->
	<div class="index-fragment-block clearfix">
		<div class="block-left-list">
			<div class="block-large">
				<div class="red-block">
					<a href="<?php echo BASE_URL;?>index.php?act=member">
						<img alt="" src="image/index/user-center.png" class="index-nav-block-img">
						<span>会员中心</span>
					</a>
				</div>
			</div>
			<div class="block-large">
				<div class="orange-block">
					<a href="<?php echo BASE_URL;?>index.php?act=product">
						<img alt="" src="image/index/financial-supermarket.png" class="index-nav-block-img">
						<span>金融超市</span>
					</a>
				</div>
			</div>
		</div>
		<div class="block-right-list">
			<div class="block-normal">
				<div class="red-block">
					<a href="<?php echo BASE_URL;?>index.php?act=borrow&op=search">
						<img alt="" src="image/index/about.png" class="index-nav-block-img-small">
						<span>贷款查询</span>
					</a>
				</div>
			</div>
			<div class="block-normal">
				<div class="blue-block">
					<a href="<?php echo BASE_URL;?>index.php?act=employee&op=introduce">
						<img alt="" src="image/index/part-jober.png" class="index-nav-block-img-small">
						<span>金鹰招募</span>
					</a>
				</div>
			</div>
			<div class="block-normal">
				<div class="green-block">
					<a href="<?php echo BASE_URL;?>index.php?act=article&op=about">
						<img alt="" src="image/index/contact.png" class="index-nav-block-img-small">
						<span>关于我们</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- E 大色块 E -->
</div>
<script style="text/javaScript">
	$('#select-one').click(function(){
		$('a:eq(2)').attr('class','slide es-active') ;
	});
	function show(){
		if($('a:eq(2)').attr('class') == 'slide es-active'){
			$('.boxone').removeClass('dis');
		}else{
			$('.boxone').addClass('dis');
		}
	}
	$(document).ready(function(){
		setInterval(show,30);
	});
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
	$('input[name="but"]').click(function(){
		var h =  /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
		var x = /^[0-9]{1,7}$/;
		var ok1= true;
		var ok2= true;
		var ok3= true;
		var ok4= true;
		if($('#select-one').val() == ''){
			alert('请选择贷款类型！');
			ok1 = false;
		}else
		if(x.test($('#select-two').val()) == false ){
			alert('贷款金额不能为空且为数字！');
			ok2 = false;
		}else
		if($('#phone').val() == ''){
			alert('请输入手机号码，便于我们联系您。');
			ok3 = false;
		}else
		if(h.test($('#phone').val()) == false){
			alert('请输入正确的手机号！');
			ok4 = false;
		}
		if(ok1 && ok2 && ok3 && ok4){
			$('form').submit();
		}else{
			return false;
		}
	});

</script>
