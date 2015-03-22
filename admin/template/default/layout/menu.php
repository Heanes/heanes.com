<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>左侧菜单</title>
<link rel="stylesheet" type="text/css" href="../css/reset/reset.css"/>
<link rel="stylesheet" type="text/css" href="../css/base/base.css"/>
<link rel="stylesheet" type="text/css" href="../css/layout.css"/>
</head>
<body>
	<div class="menu_ul">
		<ul id="list">
			<li class="li_current"><p><img src="../image/layout/menu/fire.jpg" />常用功能</p></li>
			<li><p><img src="../image/layout/menu/fire.jpg" />网站编辑</p></li>
			<li><p><img src="../image/layout/menu/fire.jpg" />功能模块</p></li>
			<li><p><img src="../image/layout/menu/fire.jpg" />网站设置</p></li>
			<li><p><img src="../image/layout/menu/fire.jpg" />站长维护</p></li>
		</ul>
	</div>
	<div class="menu_list">
		<div class="menu_content" id="menu_content">
			<div class="fct">
				<div class="head">常用功能<em class="lap" title="折叠全部"></em></div>
				<div class="box">
					<dl class="box_dl">
						<dt><a title="">数据列表</a></dt>
						<dd><a href="../data_list/data_list.php" target="conframe">普通数据列表</a></dd>
						<dd><a href="../data_list/data_list_ajax.php" target="conframe">ajax数据列表</a></dd>
						<dd><a href="../data_list/data_list_lap.php" target="conframe">可折叠菜单</a></dd>
						<dd><a href="../data_list/data_list_pics.php" target="conframe">图片平铺列表</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
						<dt><a title="">数据编辑</a></dt>
						<dd><a href="../data_edit/multiTypeEdit.php" target="conframe">多类型数据编辑</a></dd>
						<dd><a href="../data_edit/multiTypeEdit_Tabs.php" target="conframe">选项卡式编辑</a></dd>
						<dd><a href="../data_edit/multiTypeEdit_Steps.php" target="conframe">步骤式提交</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">结果提示</a></dt>
					<dd><a href="../message_result/newTab.php" target="conframe">普通提示</a></dd>
					<dd><a href="../message_result/newDiv.php" target="conframe">弹出层提示</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">其他样式</a></dt>
					<dd><a href="../right_corner/page_nav.php" target="conframe">右下脚导航</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="fct">
				<div class="head">网站编辑<em class="lap" title="折叠全部"></em></div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">文章管理</a></dt>
					<dd><a href="article_category.php?type=list" target="conframe">文章分类</a></dd>
					<dd><a href="article.php?type=list" target="conframe">文章列表</a></dd>
					<dd><a href="article_comment.php" target="conframe">评论列表</a></dd>
					<dd><a href="article_comment.php?type=check" target="conframe">评论审核</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">公告管理</a></dt>
					<dd><a href="notice_category.php" target="conframe">公告分类</a></dd>
					<dd><a href="notice.php" target="conframe">公告列表</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="fct">
				<div class="head">功能模块<em class="lap" title="折叠全部"></em></div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">商品管理</a></dt>
					<dd><a href="goods_category.php" target="conframe">商品分类</a></dd>
					<dd><a href="goods.php" target="conframe">商品列表</a></dd>
					<dd><a href="goods_attribute.php" target="conframe">商品属性</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">订单管理</a></dt>
					<dd><a href="order.php" target="conframe">订单列表</a></dd>
					<dd><a href="order.php?method=search" target="conframe">订单查询</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">公司管理</a></dt>
					<dd><a href="company_category.php" target="conframe">公司分类</a></dd>
					<dd><a href="company.php" target="conframe">公司列表</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">品牌管理</a></dt>
					<dd><a href="brand_category.php" target="conframe">品牌分类</a></dd>
					<dd><a href="brand.php" target="conframe">品牌列表</a></dd>
					</dl>
				</div>
			</div>
			<div class="fct">
				<div class="head">网站设置<em class="lap" title="折叠全部"></em></div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">管理员用户</a></dt>
					<dd><a href="user.php?type=admin" target="conframe">用户列表</a></dd>
					<dd><a href="user.php?type=admin" target="conframe">用户权限</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">普通用户</a></dt>
					<dd><a href="user.php?type=user" target="conframe">用户列表</a></dd>
					<dd><a href="user.php?type=user" target="conframe">用户权限</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">网站配置</a></dt>
					<dd><a href="manage.php?type=theme" target="conframe">主题设置</a></dd>
					<dd><a href="friendly_link.php" target="conframe">友情链接</a></dd>
					<dd><a href="slide.php" target="conframe">幻灯管理</a></dd>
					<dd><a href="attachment.php" target="conframe">附件设置</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="fct">
				<div class="head">站长维护<em class="lap" title="折叠全部"></em></div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">模版库</a></dt>
					<dd><a href="template.php" target="conframe">模版列表</a></dd>
					<dd><a href="template.php?type=user" target="conframe">邮件模版列表</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">缓存管理</a></dt>
					<dd><a href="manage.php?type=clearCache" target="conframe">清除缓存</a></dd>
					<dd><a href="manage.php?type=user" target="conframe">生成静态页面</a></dd>
					</dl>
				</div>
				<div class="box">
					<dl class="box_dl">
					<dt><a title="">数据库</a></dt>
					<dd><a href="user.php?type=admin" target="conframe">数据库优化</a></dd>
					<dd><a href="user.php?type=admin" target="conframe">数据库备份</a></dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
	<!-- js S -->
	<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
	<script src="../js/menu.js" type="text/javascript"></script>
	<!-- js E -->
</body>
</html>