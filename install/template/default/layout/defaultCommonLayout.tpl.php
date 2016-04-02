<?php
/**
 * @doc 
 * @filesource defaultCommonLayout.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.23 023 10:28
 */
defined('InHeanes') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html class="default-background">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
	<meta name="renderer" content="webkit"><!-- 让360等多核模式浏览器默认用极速模式打开 -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui" />
	<meta content="yes" name="apple-mobile-web-app-capable" />

	<meta name="author" content="Heanes heanes.com email(heanes@163.com)"/>
	<meta name="keywords" content="<?php echo isset($output['seo_keywords']) ? $output['seo_keywords'] : '软件,电商,开发';?>"/>
	<meta name="description" content="<?php echo isset($output['seo_description']) ? $output['seo_description'] : '软件';?>"/>
	<base href="<?php echo TPL;?>"/>
	<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico"/>
	<link rel="bookmark" href="/data/upload/image/web/favicon.ico"/>

	<!-- S Stylesheet S -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST?>public/static/libs/css/reset/reset.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST?>public/static/libs/css/base/base.css"/>
	<link rel="stylesheet" type="text/css" href="css/style/style1.css"/>
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<link rel="stylesheet" type="text/css" href="css/css.css"/>
	<!-- E Stylesheet E -->

	<!-- S js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST?>public/static/libs/js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST?>public/static/libs/js/validation/jquery-validation/1.13.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST?>public/static/libs/js/showDialog/lhgDialog/4.2.0/lhgdialog.min.js?skin=blue"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<!-- E js E -->
	<!-- 使IE6实现hover效果 -->
	<!--[if IE 6]>
	<style type=“text/css” media=“screen”>
		body{behavior:url(<?php echo SYS_HOST;?>public/static/libs/hack/csshover.htc);}
	</style>
	<![endif]-->
	<!--[if IE]>
	<script src="<?php echo SYS_HOST?>public/static/libs/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<title><?php echo isset($output['html_title']) ? $output['html_title'] : SYS_HOST;?></title>
</head>
<body>
<div class="wrap default-background">
	<!-- S 头部 S -->
	<div class="header">

	</div>
	<!-- E 头部 E-->
	<!-- S 主要内容 S -->
	<div class="main">
		<!-- 载入页面内容 -->
		<?php require_once($tpl_file);?>
	</div>
	<!-- E 主要内容 E -->

	<!-- S 脚部 S -->
	<div class="footer">

	</div>
	<!-- E 脚部 E -->
</div>
</body>
</html>

