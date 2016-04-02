<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- 让IE8在新模式下渲染（禁止兼容模式） -->
	<meta name="renderer" content="webkit">
	<!-- 让360等多核模式浏览器默认用极速模式打开 -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- E 设备兼容相关 E -->

	<meta name="author" content="Heanes heanes.com email(heanes@163.com)" />
	<meta name="copyright" content="Heanes heanes.com email(heanes@163.com)" />

	<!-- SEO信息相关 -->
	<meta name="keywords" content="<?php echo isset($output['seo_keywords']) ? $output['seo_keywords'] : '软件,电商,开发'; ?>" />
	<meta name="description" content="<?php echo isset($output['seo_description']) ? $output['seo_description'] : '软件'; ?>" />
	<title>很抱歉，此页面暂时找不到！</title>
	<style type="text/css">
		body{margin:0;padding:0;font-family: "微软雅黑", Arial, "Trebuchet MS", Helvetica, Verdana, serif;font-size:16px}
		div{margin-left:auto;margin-right:auto}
		a{text-decoration:none;color:#1064A0}
		a:hover{color:#0078D2}
		img{border:none}
		h1,h2,h3,h4{margin:0;font-weight:normal;font-family: "微软雅黑", Arial, "Trebuchet MS", Helvetica, Verdana, serif}
		h1{line-height:60px;font-size:44px;color:#0188DE;padding:20px 0 10px 0}
		h2{color:#0188DE;font-size:16px;padding:10px 0 40px 0}
		#page{padding:20px 20px 40px 20px;margin-top:80px}
		.button{width:180px;height:28px;margin-left:0;margin-top:10px;background:#009CFF;border-bottom:4px solid #0188DE;text-align:center}
		.button a{width:180px;height:28px;display:block;font-size:14px;color:#fff}
		.button a:hover{background:#5BBFFF}
		@media screen and (min-width:320px) and (max-width:374px){}
		@media screen and (min-width:375px) and (max-width:413px){}
		@media screen and (min-width:414px) and (max-width:479px){}
		@media screen and (min-width:480px) and (max-width:639px){.w-wrap{max-width:600px}}
		@media screen and (min-width:640px) and (max-width:767px){.w-wrap{max-width:600px}}
		@media screen and (min-width:767px) and (max-width:1139px){.w-wrap{max-width:600px}}
		@media screen and (min-width:1139px) and (max-width:1366px){.w-wrap{max-width:600px}}
		@media screen and (min-width:1366px){.w-wrap{max-width:600px}}
	</style>
</head>
<body>
<div class="w-wrap" id="page" style="border:dashed #e4e4e4;line-height:30px;">
	<h1>抱歉，找不到此页面~</h1>

	<h2>Sorry, the site now can not be accessed. </h2>
	<span style="color:#666666">你请求访问的页面，暂时找不到，我们建议你返回首页进行浏览，谢谢！</span><br /><br />

	<div class="button">
		<a href="<?php echo BASE_URL; ?>" title="进入首页" target="_blank">进入首页</a>
	</div>
</div>
</body>
</html>
