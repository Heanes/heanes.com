<?php
/**
 * @doc 前台默认公共布局
 * @filesource defaultCommonLayout.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-09 17:24:40
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<!DOCTYPE html>
<html class="default-background">
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
	<script src="<?php echo SYS_HOST?>public/static/libs/js/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="<?php echo SYS_HOST?>public/static/libs/hack/placeholder.js"></script>
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
	<link rel="shortcut icon" type="image/x-icon" href="/data/upload/image/web/favicon.ico" />
	<link rel="bookmark" type="image/x-icon" href="/data/upload/image/web/favicon.ico" />
	<base href="<?php echo TPL; ?>" />

	<!-- S Stylesheet S -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style/style1.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<!-- E Stylesheet E -->

	<!-- S js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
	<!-- 图片弹出浏览 -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/colorbox/1.6.2/jquery.colorbox-min.js"></script>
	<!-- 下拉刷新 -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/dropload/0.3.0/dropload.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/js/dropload/0.3.0/dropload.css" />
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<!-- E js E -->
	<script type="text/javascript">
		$(document).ready(function () {
			//S 图片弹出放大浏览 S
			/*
			 $('.img-gallery').on('click',function(){
			 if($(this).prop('tagName')=='IMG'){
			 $(this).attr('href',$(this).attr('src'));
			 }
			 });
			 */
			if($('.img-gallery').length>0){
				$('.img-gallery').colorbox();
			}
			//E 图片弹出放大浏览 E
			//S 下拉刷新 S
			var dropload = $('body').dropload({
				domUp : {
					domClass   : 'dropload-up',
					domRefresh : '<div class="dropload-refresh">↓下拉刷新</div>',
					domUpdate  : '<div class="dropload-update">↑释放更新</div>',
					domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
				},
				domDown : {
					domClass   : 'dropload-down',
					domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
					domUpdate  : '<div class="dropload-update">↓释放加载</div>',
					domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
				},
				loadUpFn : function(me){
					//刷新当前页
					history.go(0);
					me.resetload();
				}
			});
			//E 下拉刷新 E
		});
	</script>
	<!-- E***********资源文件相关***********E -->
</head>
<body>
<?php require_once($tpl_file); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#loading').remove();
	});
</script>
</body>
</html>