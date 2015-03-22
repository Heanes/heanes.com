<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
<meta name="renderer" content="webkit"><!-- 让360等多核模式浏览器默认用极速模式打开 -->
<meta name="author" content="Heanes heanes.com email(heanes@163.com)">
<meta name="keywords" content="软件,商务,HTML,tutorials,source codes">
<meta name="description" content="描述">
<title>右下角导航样式</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<link rel="stylesheet" type="text/css" href="../css/sidebar.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
		
		</div>
		<!-- 头部 E -->
		<!-- 主要内容 S -->
		<div class="main">
			<div style="height:2000px;border:1px dashed silver;text-align:center;">占用高度</div>
		</div>
		<!-- 主要内容 E -->
		<!-- 右下角内容 S -->
		<div class="right_corner_nav">
			<button class="self-icon-back-top" id="goto_top" title="回到顶部"></button>
			<button class="self-icon-share" title="分享"></button>
			<button class="self-icon-tablet" title="手机上浏览"></button>
			<a href="/" target="_top"><button class="self-icon-goto_home" id="goto_home" title="回到首页"></button></a>
			<button class="self-icon-reload" onclick="javascript:window.location.reload();" title="刷新本页"></button>
			<button class="self-icon-comment" title="评论"></button>
			<button class="self-icon-goto-bottom" id="goto_bottom" title="去底部"></button>
		</div>
		<!-- 右下角内容 E -->
		<!-- 脚部 S -->
		<div class="footer">
			
		</div>
		<!-- 脚部 E -->
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/common/common.js"></script>
		<!-- js E -->
	</cite>
</body>
</html>