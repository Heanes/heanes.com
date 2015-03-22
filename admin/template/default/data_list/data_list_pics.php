<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
<meta name="renderer" content="webkit"><!-- 让360等多核模式浏览器默认用极速模式打开 -->
<meta name="author" content="Heanes heanes.com email(heanes@163.com)">
<meta name="keywords" content="软件,商务,HTML,tutorials,source codes">
<meta name="description" content="描述">
<title>图片相册列表</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">相册列表</span>
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
		<!-- 主要内容 S -->
		<div class="main">
			<!-- 搜索区域 S -->
			<div class="data_list_search">
				<form action="" method="post">
					<table>
						<tbody>
							<tr>
								<th>相册名称</th>
								<td><input type="text" placeholder="输入名称"/></td>
								<th>上传者</th>
								<td><input type="text" placeholder="输入名称"/></td>
								<td rowspan="2"><a href="javascript:;" class="btn btn-primary">搜索</a></td>
							</tr>
							<tr>
								<th>上传时间</th>
								<td><input type="text" name="order_insert_time" id="order_insert_time_start" value="2014-11-30 12:20:35" placeholder="选择起始时间" onclick="javascript:$.calendar({maxDate:'#order_insert_time_end',format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
								<th style="text-align:center;">/</th>
								<td><input type="text" name="order_insert_time" id="order_insert_time_end" placeholder="选择结束时间" onclick="javascript:$.calendar({minDate:'#order_insert_time_start',format:'yyyy-MM-dd HH:mm:ss'})    ;" class="date_time_picker"/></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!-- 搜索区域 E -->
			<!-- 相册列表 S -->
			<div class="ablum_list">
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/default.png">
							<span class="ablum_photo_num">33</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face001.jpg">
							<span class="ablum_photo_num">48</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face002.jpg">
							<span class="ablum_photo_num">79</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face003.jpg">
							<span class="ablum_photo_num">355</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face004.jpg">
							<span class="ablum_photo_num">123</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face005.jpg">
							<span class="ablum_photo_num">435</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face006.jpg">
							<span class="ablum_photo_num">637</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face007.jpg">
							<span class="ablum_photo_num">758</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face008.jpg">
							<span class="ablum_photo_num">21</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
				<div class="ablum_one">
					<div class="ablum_src">
						<a class="ablum_cover">
							<img alt="" src="/data/upload/image/user_photo/face009.jpg">
							<span class="ablum_photo_num">9</span>
							<span class="ablum_photo_categroy">旅游<span class="ablum_photo_categroy_border"></span></span>
						</a>
					</div>
					<div class="ablum_info">
						<a href=""><span class="ablum_name">远方 有一个地方 那里种有我们的梦想 远方 有一个地方 那里种有我们的梦想</span></a>
						<p class="ablum_upload_time">2015.02.05 08:23:19</p>
					</div>
				</div>
			</div>
			<!-- 相册列表 E -->
			<!-- 分页部分 S -->
			<div class="turn_page">
				<p class="text-right">
					<span class="page_info">总计128个记录分为7页 当前第1页，每页<input type="text" size="3" value="15"/>条 <input type="button" value="确定" class="btn"/></span>
					<span class="page_link">
						<a href="javascript:;">首页</a>
						<a href="javascript:;"><b class="triangle-left"></b> 上一页</a>
						<a href="javascript:;" class="current">1</a> <a href="javascript:;">2</a> <a href="javascript:;">3</a> <em>...</em> <a href="javascript:;">10</a>
						<a href="javascript:;">下一页 <b class="triangle-right"></b></a>
						<a href="javascript:;">末页</a>
						到第<input type="text" value="2">页 <input type="button" value="确定" class="btn"/>
						<select>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</span>
				</p>
			</div>
			<!-- 分页部分 E -->
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
		<script type="text/javascript" src="../js/dateTimePicker/lhgcalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
		<script type="text/javascript" src="../js/common/common.js"></script>
		<!-- js E -->
	</cite>
</body>
</html>