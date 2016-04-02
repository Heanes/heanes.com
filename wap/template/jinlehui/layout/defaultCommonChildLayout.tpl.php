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
	<title><?php echo isset($output['html_title']) ? $output['html_title'].' - 金乐汇' : '金乐汇'; ?></title>
	<script type="text/javascript">
		/**
		 * @doc 页面等待加载时显示信息
		 * @author Heanes
		 * @time 2015-08-14 12:51:38
		 */
		//document.write('<div id="loading" style="position:absolute;top:0;z-index:2;background:#fff;height:100%;width:100%"><style type="text/css">body{margin:0;padding:0;}</style><div style="background:rgba(0,0,0,0.8);border-radius:5px;position:absolute;top:50%;left:50%;margin:-15px 0 0 -80px;padding:0 10px;line-height:30px;font-size:14px;height:30px;text-align:center;color:#f1f1f1">正在玩命加载中...</div></div>');
	</script>
	<!-- S***********资源文件相关***********S -->
	<link rel="shortcut icon" type="image/x-icon" href="/data/upload/image/web/favicon.ico" />
	<link rel="bookmark" type="image/x-icon" href="/data/upload/image/web/favicon.ico" />
	<base href="<?php echo TPL; ?>" />

	<!-- S Stylesheet S -->
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<link rel="stylesheet" type="text/css" href="css/style/style1.css<?php echo '?v='.$output['web_version'];?>" />
	<link rel="stylesheet" type="text/css" href="css/common.css<?php echo '?v='.$output['web_version'];?>" />
	<link rel="stylesheet" type="text/css" href="css/css.css<?php echo '?v='.$output['web_version'];?>" />
	<link rel="stylesheet" type="text/css" href="css/Validform.css<?php echo '?v='.$output['web_version'];?>" />
	<!-- E Stylesheet E -->

	<!-- S js S -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
	<!--<script type="text/javascript" src="--><?php //echo SYS_HOST ?><!--public/static/libs/js/validation/jquery-validation/1.13.1/jquery.validate.min.js"></script>-->
	<!-- 表单验证 -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Validform/5.3.2/Validform.min.js"></script>
	<!-- 图片弹出浏览 -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/colorbox/1.6.2/jquery.colorbox-min.js"></script>
	<!-- 下拉刷新 -->
	<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/dropload/0.3.0/dropload.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/js/dropload/0.3.0/dropload.css" />
	<!-- 页面弹出层 -->
	<!--<script type="text/javascript" src="--><?php //echo SYS_HOST ?><!--public/static/libs/js/showDialog/lhgDialog/4.2.0/lhgdialog.min.js?skin=blue"></script>-->
	<script type="text/javascript" src="js/js.js<?php echo '?v='.$output['web_version'];?>"></script>
	<script type="text/javascript" src="js/common.js<?php echo '?v='.$output['web_version'];?>"></script>
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
<div class="wrap default-background">
	<!-- S 头部 S -->
	<div class="header">
		<div class="nav-head-fix">
			<div class="nav-head-banner w-wrap">
				<a href="javascript:history.go(-1)" class="nav-head-back-href">
					<i class="nav-head-back-icon nav-head-back-wrap"></i>
					<span class="nav-head-text">返回</span>
				</a>
			</div>
		</div>
		<div class="nav-head-fix-placeholder"></div>
	</div>
	<!-- E 头部 E-->
	<!-- S 主要内容 S -->
	<div class="main">
		<!-- 载入页面内容 -->
		<?php include($tpl_file); ?>
	</div>
	<!-- E 主要内容 E -->

	<!-- S 脚部 S -->
	<div class="footer">
		<div class="footer-placeholder"></div>
		<!--
		<div class="footer-content footer-inline">
			<div class="footer-nav-bar">
				<p class="footer-user-info">
					<?php if (isset($_SESSION['is_login'])) { ?>
						<a href="<?php echo BASE_URL; ?>index.php?act=member&op=userCenterDefault"><span><?php echo $_SESSION['user_name']; ?></span></a>
						<a href="<?php echo BASE_URL; ?>index.php?act=member&op=loginOut"><span>退出</span></a>
					<?php } else { ?>
						<a href="<?php echo BASE_URL; ?>index.php?act=member&op=reg"><span>注册</span></a>
						<a href="<?php echo BASE_URL; ?>index.php?act=member&op=login"><span>登录</span></a>
					<?php } ?>
					<a href="<?php echo BASE_URL; ?>" style="float:right;"><span>首页</span></a>
				</p>

				<p class="boot-nav">
					<a href="<?php echo BASE_URL; ?>"><span>首页</span></a>
					<a href="javascript:scroll(0,0)"><span>回顶部</span></a>
				</p>
			</div>
		</div>
		-->
		<div class="footer-content default-background fix">
			<div class="footer-nav-bar w-wrap">
				<ul class="footer-nav-ul">
					<!-- sprite形式 -->
					<!--
					<li <?php if(lcfirst($_GET['act'])=='index'){?>class="active"<?php }?>><a href="<?php echo BASE_URL; ?>"><i class="nav-home"></i><span>首页</span></a></li>
					<li <?php if(lcfirst($_GET['act'])=='article' && isset($_GET['category']) && $_GET['category']=='news'){?>class="active"<?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=article&category=news&op=list"><i class="nav-news"></i><span>资讯</span></a></li>
					<li <?php if(lcfirst($_GET['act'])=='article' && $_GET['op']=='about'){?>class="active"<?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=article&op=about"><i class="nav-about"></i><span>创业之家</span></a></li>
					<li <?php if(lcfirst($_GET['act'])=='member'){?>class="active"<?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=member"><i class="nav-member active"></i><span>我的</span></a></li>
					-->
					<?php if(isset($output['wapNavigationList']) && count($output['wapNavigationList'])){?>
						<style type="text/css">
							.footer-nav-ul li{width:<?php echo 100/count($output['wapNavigationList'])?>%;}
						</style>
						<?php foreach ($output['wapNavigationList'] as $key=>$navigation) {?>
							<style type="text/css">
								.fix-nav-icon<?php echo $key;?>{background-image:url(<?php echo PATH_BASE_FILE_UPLOAD; ?>wap/image/common/footer-nav/<?php echo $navigation['img_src'];?>);}
								.footer-nav-ul li.active a i.fix-nav-icon<?php echo $key;?>,.footer-nav-ul li:hover a i.fix-nav-icon<?php echo $key;?>{background-image:url(<?php echo PATH_BASE_FILE_UPLOAD; ?>wap/image/common/footer-nav/<?php echo $navigation['img_src_hover'];?>);}
							</style>
							<li <?php if(in_array(lcfirst($_GET['act']),$navigation['href_in_hover'])){?>class="active"<?php }?>>
								<a href="<?php echo $navigation['a_href']; ?>"><i class="fix-nav-icon<?php echo $key;?>"></i><span><?php echo $navigation['name'];?></span></a>
							</li>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<!-- E 脚部 E -->
</div>
<cite>
	<script type="text/javascript">
			$(document).ready(function () {
				$('#loading').remove();
			});
	</script>
</cite>
</body>
</html>