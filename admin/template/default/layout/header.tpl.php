<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>后台头部内容</title>
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<base href="<?php echo TPL; ?>" />
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<style type="text/css">
		html {
			overflow-y: hidden;
		}
	</style>
</head>
<body>
<div class="wrap">
	<!-- 头部 S -->
	<div class="header">
		<!-- 头部 S -->
		<div class="admin_layout_head">
			<div class="head_title">
				<div class="head_logo"><img alt="head_logo" src="image/layout/head/admin_head_logo.png"></div>
			</div>
			<div class="head_welcome">
				<div class="welcome_str"><?php echo $_SESSION['admin_user_name']; ?>，欢迎你</div>
				<div class="welcome_info">今天是<span id="js_time_now"></span></div>
			</div>
			<div class="head_quick_handle">
				<a href="javascript:">消息<span class="admin_message_nums">5</span></a>
				<a href="manage.php?type=clearCache" target="conframe" title="清除缓存"><img src="image/layout/head/cache_clear.png"></a>
				<a href="index.html" title="网站主页" target="_blank"><img src="image/layout/head/web_home.png"></a>
				<a href="<?php echo BASE_URL;?>index.php?act=AdminUser&op=loginOut" id="log_out" title="安全退出" target="_parent"><img src="image/layout/head/logout.png"></a>
			</div>
			<div class="tool_bar">
				<div class="nav_handle_left">
					<img id="nav_go_back" alt="后退" src="image/layout/toolbar/Max_arrow_left.png" title="后退">
					<img id="nav_go_next" alt="前进" src="image/layout/toolbar/Max_arrow_right.png" title="前进">
					<img id="nav_frame_refresh" alt="刷新" src="image/layout/toolbar/refresh.png" title="刷新">
					<a href="" target="_parent"><img id="nav_default_page" alt="起始页" src="image/layout/toolbar/admin_home.png" title="起始页"></a>
				</div>
				<div class="current_dir">
					<img alt="当前位置" src="image/layout/toolbar/networking.png" title="当前位置">
					<span>当前位置：</span>
					<span id="nav_default_frame"><a href="index.php?page=default" target="conframe">起始页</a></span>

					<div class="nav_location" id="nav_location">
						<img src="image/layout/toolbar/arrows.gif" style="height: 14px;">
						<span id="current_location"></span>
					</div>
				</div>
				<div class="nav_handle_right">
					<input id="input_search" type="text" placeholder="搜索" title="输入以搜索">
					<img alt="搜索" src="image/layout/toolbar/search.png" title="搜索">
				</div>
			</div>
		</div>
	</div>
	<!-- 头部 E -->
	<!-- 脚部 S -->
	<div class="footer">
		<div class="text-center">你为何要看到我？</div>
	</div>
	<!-- 脚部 E -->
</div>
<cite>
	<!-- js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/frame.js"></script>
	<!-- 折叠功能的框架 -->
	<!-- js E -->
</cite>
</body>
</html>