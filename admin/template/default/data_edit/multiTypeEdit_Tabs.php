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
<title>Tabs式多类型数据编辑</title>
<!-- Tabs样式 -->
<link rel="stylesheet" type="text/css" href="../css/tabs/kandytabs/4.2.0112/kandytabs.css" />
<link rel="stylesheet" type="text/css" href="../css/tabs/kandytabs/4.2.0112/style.css" />
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">数据修改</span>
			</div>
			<!-- 标题部分 E -->
		</div>
		<!-- 头部 E -->
		<!-- 主要内容 S -->
		<div class="main">
			<!-- Tab样式编辑修改 -->
			<div class="data-edit-tab">
				<dl id="data-edit-tab">
					<dt>基本信息</dt>
					<dd>
						<!-- 编辑基本信息 -->
						<table>
							<thead>
								<tr>
									<td colspan="5">基本信息编辑</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>ID</td>
									<td><input type="text" disabled="disabled" value="1"/></td>
								</tr>
								<tr>
									<td>名称</td>
									<td><input type="text" placeholder="输入数据" value="输入数据"/></td>
								</tr>
							</tbody>
						</table>
					</dd>
					<dt>附属信息</dt>
					<dd>
						<!-- 编辑其他附属信息 -->
						<table>
							<thead>
								<tr>
									<td colspan="5">其他信息编辑</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>商品相册</td>
									<td><input type="file"/></td>
								</tr>
								<tr>
									<td>商品库存</td>
									<td><input type="text" placeholder="输入数据" value="输入数据"/></td>
								</tr>
							</tbody>
						</table>
					</dd>
					<dt>其他信息</dt>
					<dd>
						<!-- 编辑其他附属信息 -->
						<table>
							<thead>
								<tr>
									<td colspan="5">其他信息编辑</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>商品相关文章</td>
									<td><textarea rows="" cols="">文章内容</textarea></td>
								</tr>
								<tr>
									<td>商品库存</td>
									<td><input type="text" placeholder="输入数据" value="输入数据"/></td>
								</tr>
							</tbody>
						</table>
					</dd>
				</dl>
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
		<script type="text/javascript" src="../js/tabs/kandytabs/4.2.0112/kandytabs.js"></script><!-- Tab选项卡 -->
		<script type="text/javascript" src="../js/common/common.js"></script>
		<script type="text/javascript">
			$(function() {
				/* Tabs选项卡 */
				$("#data-edit-tab").KandyTabs({
					trigger:"click"
				});
			})
		</script>
		<!-- js E -->
	</cite>
</body>
</html>