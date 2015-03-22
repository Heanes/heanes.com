<?php defined('InHeanes') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="UTF-8">
<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico" />
<link rel="bookmark" href="/data/upload/image/web/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/jquery-ui/layout/css/layout-default-latest.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_TPL_ADMIN_DEFAULT;?>css/reset/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_TPL_ADMIN_DEFAULT;?>css/base/base.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo PATH_TPL_ADMIN_DEFAULT;?>css/layout.css"/>
<title>后台管理中心</title>
</head>
<body>
	<!-- 头部 -->
	<div class="ui-layout-north">
		<!--头部开始-->
		<iframe src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>layout/header.php"></iframe>
		<!--头部结束-->
	</div>
	<!-- 菜单部分-->
	<div class="ui-layout-west">
		<iframe src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>layout/menu.php"></iframe>
	</div>
	<!-- 中间部分 -->
	<div class="ui-layout-center">
		<iframe name="conframe" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>default.php" class="iframe_admin"></iframe>
	</div>
	<!-- 右侧部分 -->
	<div class="ui-layout-east">
		<iframe src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>layout/right.php"></iframe>
	</div>
	<!-- 脚部 -->
	<div class="ui-layout-south">
		<iframe src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>layout/footer.php"></iframe>
	</div>
	<!-- js S -->
	<script type="text/javascript" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/jquery-ui/jquery-ui-1.11.1.js"></script>
	<script type="text/javascript" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/jquery-ui/layout/jquery.layout-latest.js"></script>
	<script type="text/javascript" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/dateTimePicker/lhgcalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
	<script type="text/javascript" src="<?php echo PATH_TPL_ADMIN_DEFAULT;?>js/frame.js"></script><!-- 折叠功能的框架 -->
	<!-- js E -->
</body>
</html>