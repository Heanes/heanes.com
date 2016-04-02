<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- S 浏览器兼容相关 S -->
	<!-- 使IE6实现hover效果 -->
	<!--[if IE 6]>
	<style type=“text/css” media=“screen”>
		body {
			behavior: url(<?php echo SYS_HOST;?>public/static/libs/hack/csshover.htc);
		}
	</style>
	<![endif]-->

	<!-- 使IE支持html5,placeholder -->
	<!--[if IE]>
	<script src="<?php echo SYS_HOST;?>public/static/libs/js/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="<?php echo SYS_HOST;?>public/static/libs/hack/placeholder.js"></script>
	<![endif]-->


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
	<title><?php echo isset($output['html_title']) ? $output['html_title'] : SYS_HOST; ?></title>

	<!-- S***********资源文件相关***********S -->
	<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico" />
	<link rel="bookmark" href="/data/upload/image/web/favicon.ico" />
	<base href="<?php echo TPL; ?>" />

	<!-- S Stylesheet S -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/js/jquery-ui/layout/1.4.3/layout-default.css"/>
	<link rel="stylesheet" type="text/css" href="css/base/base.css"/>
	<link rel="stylesheet" type="text/css" href="css/layout.css"/>
</head>
<body>
	<!-- 头部 -->
	<div class="ui-layout-north">
		<!--头部开始-->
		<iframe src="<?php echo BASE_URL;?>index.php?act=index&op=header"></iframe>
		<!--头部结束-->
	</div>
	<!-- 菜单部分-->
	<div class="ui-layout-west">
		<iframe src="<?php echo BASE_URL;?>index.php?act=index&op=menu"></iframe>
	</div>
	<!-- 中间部分 -->
	<div class="ui-layout-center">
		<iframe name="conframe" src="<?php echo BASE_URL;?>index.php?act=BaseLayout&op=default" class="iframe_admin"></iframe>
	</div>
	<!-- 右侧部分 -->
	<div class="ui-layout-east">
		<iframe src="layout/right.tpl.php"></iframe>
	</div>
	<!-- 脚部 -->
	<div class="ui-layout-south">
		<iframe src="layout/footer.tpl.php"></iframe>
	</div>
	<!-- js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery-ui/1.11.2/jquery-ui-1.11.2.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery-ui/layout/1.4.3/jquery.layout-1.4.3.js"></script>
	<script type="text/javascript" src="js/frame.js"></script><!-- 折叠功能的框架 -->
	<!-- js E -->
</body>
</html>