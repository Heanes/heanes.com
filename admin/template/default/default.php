<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/common.css"/>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/font-awesome/3.2.1/css/font-awesome-ie7.min.css">
<![endif]-->
<title>后台管理默认欢迎页面</title>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">起始页<a class="external-link" id="new_tab">新窗</a></span>
			</div>
			<!-- 标题部分 E -->
		</div>
		<!-- 内容部分 -->
		<div class="main">
			<div class="admin_default_block_list">
				<table>
					<tbody>
						<tr>
							<td>
								<div class="admin_default_block_info">
									<div class="block_title">
										<span>商品</span>
									</div>
									<div class="block_content">
										<p style="height: 200px;"></p>
									</div>
								</div>
							</td>
							<td>
								<div class="admin_default_block_info">
									<div class="block_title">
										<span>会员</span>
									</div>
									<div class="block_content">
										<p style="height: 200px;"></p>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
					
				</table>
				<!-- 
				<div class="admin_default_block_info">
					<div class="block_title">
						<span>商品</span>
					</div>
					<div class="block_content">
						<p style="height:200px;"></p>
					</div>
				</div>
				<div class="admin_default_block_info">
					<div class="block_title">
						<span>会员</span>
					</div>
					<div class="block_content">
						<p style="height:200px;"></p>
					</div>
				</div>
				<div class="admin_default_block_info">
					<div class="block_title">
						<span>订单</span>
					</div>
					<div class="block_content">
						<p style="height:200px;"></p>
					</div>
				</div>
				<div class="admin_default_block_info">
					<div class="block_title">
						<span>文章</span>
					</div>
					<div class="block_content">
						<p style="height:200px;"></p>
					</div>
				</div>
			</div>
			<div class="admin_copyright">
				<div class="admin_copyright_about">
					<table>
						<thead>
							<tr>
								<th colspan="10"><h4>系统信息</h4></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>服务器信息</th>
								<td>Windows Server 2003</td>
							</tr>
							<tr>
								<th>运行环境</th>
								<td>PHP 5.3</td>
				</div>
				-->
			</div>
			<div class="admin_copyright">
				<div class="admin_copyright_about">
					<table>
						<thead>
							<tr>
								<th colspan="10"><h4>关于本系统</h4></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>版权所有</th>
								<td>Heanes</td>
							</tr>
							<tr>
								<th>关于我们</th>
								<td><a href="http://www.heanes.com">heanes.com</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="js/dateTimePicker/lhgcalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
		<script type="text/javascript" src="js/common/common.js"></script>
		<script type="text/javascript">
			/* 日期时间选择器 */
			//$('#order_insert_time_start').calendar({format:'yyyy-MM-dd HH:mm:ss'});
			//$('#order_insert_time_end').calendar({format:'yyyy-MM-dd HH:mm:ss'});
			$('#order_insert_time_end').val(getDateAndTimeStatic());
		</script>
		<!-- js E -->
	</cite>
</body>
</html>