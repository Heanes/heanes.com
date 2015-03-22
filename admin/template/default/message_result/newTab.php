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
<title>新标签页面-结果提示</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">提示信息</span>
			</div>
			<!-- 标题部分 E -->
		</div>
		<!-- 头部 E -->
		<!-- 主要内容 S -->
		<div class="main">
			<div class="message_result">
				<div class="message_result_success">
					<h3>恭喜你！操作成功</h3>
					<hr/>
					<p>接下来请选择跳转，若不做选择将自动返回… 
						<a href="javascript:;">返回</a><b style="border-right:1px solid #888;margin:0 5px;"></b><a href="javascript:;">继续编辑</a>
					</p>
				</div>
				<div class="margin10"></div>
				<div class="message_result_failed">
					<h3>抱歉！操作失败</h3>
					<hr/>
					<fieldset>
						<legend>失败原因</legend>
						<em>某某原因</em>
					</fieldset>
					<p>接下来请选择跳转，若不做选择将自动返回… 
						<a href="javascript:;">返回</a><b style="border-right:1px solid #888;margin:0 5px;"></b><a href="javascript:;">继续编辑</a>
					</p>
				</div>
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
		<script type="text/javascript" src="../js/common/common.js"></script>
		<!-- js E -->
	</cite>
</body>
</html>