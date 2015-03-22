<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
<meta name="renderer" content="webkit"><!-- 让360等多核模式浏览器默认用极速模式打开 -->
<meta name="author" content="Heanes heanes.com email(heanes@163.com)">
<meta name="keywords" content="软件,商务,HTML,tutorials,source codes">
<meta name="description" content="描述">
<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico"/>
<link rel="bookmark" href="/data/upload/image/web/favicon.ico"/>
<title>步骤式提交-数据修改</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
<!-- Tabs样式 -->
<link rel="stylesheet" type="text/css" href="../css/tabs/kandytabs/4.2.0112/kandytabs.css" />
<link rel="stylesheet" type="text/css" href="../css/tabs/kandytabs/4.2.0112/style.css" />
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">步骤提交</span>
			</div>
			<!-- 标题部分 E -->
		</div>
		<!-- 头部 E -->
		<!-- 主要内容 S -->
		<div class="main">
			<div class="data-post-step">
				<!-- 简单的步骤提交 -->
				<form id="simplestep">
					<h4>第1步</h4>
					<div>
						1.这是一个<em>普通的向导</em>，记得在lang里把“<em>上一步</em>”，“<em>下一步</em>”给写上。
					</div>
					<h4>第2步</h4>
					<div>
						2.使用的是普通的<em>tab模式</em>加上<em>nav</em>并用CSS隐藏了.tabprevno和.tabnextno还有.tabpage，采用了<em>slide效果</em>
					</div>
					<h4>第3步</h4>
					<div>3.为什么.tabbtn不能点击呢？因为trigger用的是自定义事件“step”，或者你可以写“GongChanDangWanSui_Orz”，别用敏感词哦，小心被**，就JS报错了！</div>
					<h4>第4步</h4>
					<div>4.已经经过的.tabbtn颜色不一样是吧？这里加了个“.tabok”的class，或者你也可以改成“MinZhuZiYouWanSui_Orz”，还是一样，注意别被屏蔽了！</div>
					<h4>第5步</h4>
					<div>5.到这里啦，你就写个“完成”呗！够用了吧？太简单了？那看看右边……</div>
				</form>
				<div class="clear"></div>
				<!-- 带输入验证的步骤提交 -->
				<form id="verifystep">
					<h4>填写姓名</h4>
					<div>
						1.这是一个验证表单的向导，或者叫<em>步骤表单</em>吧，你要填了姓名才能下一步哦！<br /> <br />姓名
						<input type="text" size="20" />
						不能为空
					</div>
					<h4>填写年龄</h4>
					<div>
						2.这跟左边没太大区别，就是custom的时候加上验证功能就行，当然，别用CSS把.tabprevno和.tabnextno隐藏，不然就没得玩了！别忘了填你的年龄！<br /> <br />年龄
						<input type="text" size="20" />
						不能为空
					</div>
					<h4>填写性别</h4>
					<div>
						3.有点意思是不？那就自己把本页的custom.js下载下来研究下吧，确实有点复杂，看不懂可以来找我，但真别来找我，我真的不是很有空，抱歉了！不过，我现在不是很忙，所以我帮你把性别填了，不客气！<br /> <br />性别
						<input type="text" size="20" value="就不告诉你" />
						不能为空
					</div>
					<h4>填写婚姻状况</h4>
					<div>
						4.要么，还是玩左边那种简单的吧，或者去这里（<a href="http://photo.guilin.li/?join/" target="_blank">photo.guilin.li/?join/</a>）看看，应用的很完美哦！别偷懒，加上您的婚姻状态就可以过关啦！<br /> <br />婚姻状况
						<input type="text" size="20" />
						不能为空
					</div>
					<h4>完成表单</h4>
					<div>5.恭喜你来到第5步，别告诉我你前面都是认真填写的哦，哈哈哈哈！</div>
				</form>
			</div>
		</div>
		<!-- 主要内容 E -->
		<!-- 脚部 S -->
		<div class="footer">
		
		</div>
		<!-- 脚部 E -->
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/tabs/kandytabs/4.2.0112/kandytabs.js"></script><!-- Tab选项卡 -->
		<script type="text/javascript" src="../js/common/common.js"></script>
		<script type="text/javascript">
			// Step/Guide步骤表单/向导效果演示
			$("#simplestep").KandyTabs({
				trigger:"step",
				classes:"kandyStep",
				nav:true,
				action:"fade",
				lang:{
					prev:["上一步","上一步"],
					next:["下一步","下一步"]
				},
				custom:function(b,c,i,t){
					b.eq(i).removeClass("tabok").prev().addClass("tabok").next().removeClass("tabok")
				}
			});
			/* 带验证的步骤提交 */
			$("#verifystep").KandyTabs({
				trigger:"step",
				classes:"kandyStep",
				nav:true,
				lang:{
					prev:["上一步","上一步"],
					next:["下一步","下一步"]
				},
				custom:function(b,c,i,t){
					i == 0 ? $(".tabprev",t).hide() : $(".tabprev",t).show()
					i == b.length-1 ? $(".tabnext",t).hide() : $(".tabnext",t).show()
					b.eq(i).removeClass("tabok").prev().addClass("tabok").next().removeClass("tabok")
					c.eq(i).find("input").keyup(function(){
						if (this.value != "") {
							$(".tabnext",t).removeClass("tabnextno")
							$(this).removeClass("err")
						} else {
							$(".tabnext",t).addClass("tabnextno")
							$(this).addClass("err")
						}
					})
					setTimeout(function(){c.eq(i).find("input").trigger("keyup")},1)
				},
				done:function(b,c,t){
					$("input",t).each(function(){
						this.value == "" ?  $(this).addClass("err") : $(this).removeClass("err")
					})
					b.first().trigger("step")
				}
			});
		</script>
		<!-- js E -->
	</cite>
</body>
</html>