<?php
/**
 * @doc 
 * @filesource adminFrameMainContentLayout.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-26 17:08:43
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<!-- SEO信息相关 -->
	<meta name="keywords" content="<?php echo isset($output['seo_keywords']) ? $output['seo_keywords'] : '软件,电商,开发'; ?>" />
	<meta name="description" content="<?php echo isset($output['seo_description']) ? $output['seo_description'] : '软件'; ?>" />
	<title><?php echo isset($output['html_title']) ? $output['html_title'].' - 后台管理 - 金乐汇' : '金乐汇'; ?></title>

	<!-- S***********资源文件相关***********S -->
	<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico" />
	<link rel="bookmark" href="/data/upload/image/web/favicon.ico" />
	<base href="<?php echo TPL; ?>" />

	<!-- S Stylesheet S -->
	<!--导入重设样式-->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<!-- 导入基础简写样式库 -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/short.css" />
	<!-- 导入font-awesome字体文件 -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/fonts/font-awesome/4.2.0/css/font-awesome.min.css" />
	<!-- 导入bootstrap样式 -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/bootstrap/2.3.2/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style/style1.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<!-- E Stylesheet E -->

	<!-- S js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/tabs/kandytabs/4.2.0112/kandytabs.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/tabs/kandytabs/4.2.0112/kandytabs.css" />
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/validation/jquery-validation/1.13.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Excolo-Slider/1.1.0/jquery.excoloSlider.js"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/showDialog/lhgDialog/4.2.0/lhgdialog.min.js?skin=blue"></script>
	<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/Validform/5.3.2/Validform.min.js"></script><!-- 表单提示验证 -->
	<link rel="stylesheet" type="text/css" href="css/formstyle.css" />
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript">
		var CURRENT_URL='<?php echo CURRENT_URL;?>';
	</script>
	<!-- E js E -->
	<!-- E***********资源文件相关***********E -->
</head>
<body>
<div class="wrap">
	<!-- 头部 S -->
	<div class="header">
		<!-- 标题部分 S -->
		<div class="page_title">
			<span class="first">后台管理中心</span>——<span class="second"><?php echo isset($output['page_title'])?$output['page_title']:$output['html_title'];?><a class="external-link" id="new_tab">新窗</a></span>
		</div>
		<!-- 标题部分 E -->
		<!-- 右上角功能区域 S -->
		<div class="topCorner">
			<div class="text_operate">
				<table>
					<tr>
						<td><b class="increaseFont" title="放大文字">+</b></td>
						<td><b class="resetFont" title="重置字体大小"></b></td>
						<td><b class="decreaseFont" title="缩小字体">-</b></td>
					</tr>
				</table>
			</div>
		</div>
		<!-- 右上角功能区域 E -->
	</div>
	<!-- 头部 E -->
	<!-- 内容部分 S -->
	<div class="main">
	<?php require_once($tpl_file); ?>
	</div>
	<!-- 主要内容 E -->
</div>
</body>
</html>

