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
<title>多种类型编辑页面</title>
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
			<form action="" method="post" class="input-condensed">
				<table class="table table-striped table-condensed table-data-eidt">
					<thead>
						<tr>
							<td colspan="4">修改文章</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>内部ID</th>
							<td><input type="text" disabled="disabled" value="1"></td>
							<th>排序</th>
							<td><input type="text" name="" value="1"></td>
						</tr>
						<tr>
							<th>文章标题</th>
							<td><input type="text" name="" value="2014广东省钓鱼联赛龙岗“收竿”"></td>
							<th>样式</th>
							<td>
								标题颜色<input type="text" class="color" name="color" value="000000" style="width:43px"/>
								背景颜色<input type="text" class="color" name="color" value="FFFFFF" style="width:43px"/>
							</td>
						</tr>
						<tr>
							<th>创建时间</th>
							<td><input type="text" name="article_insert_time" id="article_insert_time" value="" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
							<th>修改时间</th>
							<td><input type="text" name="article_insert_time" id="article_insert_time" value="" placeholder="选择起始时间" onclick="javascript:$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
						</tr>
						<tr>
							<th>单一下拉框</th>
							<td>
								<select>
									<option value="">请选择</option>
									<option value="">选择1</option>
									<option value="">选择2</option>
									<option value="">选择3</option>
								</select>
							</td>
							<th>联动下拉框</th>
							<td>
								<select>
									<option value="">请选择</option>
									<option value="">北京</option>
									<option value="">上海</option>
									<option value="">深圳</option>
								</select>省
								<select>
									<option value="">请选择</option>
									<option value="">选择1</option>
									<option value="">选择2</option>
									<option value="">选择3</option>
								</select>市
							</td>
						</tr>
						<tr>
							<th>复选样式</th>
							<td>
								选择1 <input type="checkbox" name="some_checkbox" value="">
								选择1 <input type="checkbox" name="some_checkbox" value="">
								选择1 <input type="checkbox" name="some_checkbox" value="">
							</td>
							<th>单选样式</th>
							<td>
								<input type="radio" name="same_radio" value=""> 是
								<input type="radio" name="same_radio" value=""> 否
							</td>
						</tr>
						<tr>
							<th>简单文字输入域</th>
							<td><textarea rows="" cols="3" style="width:100%;">输入内容</textarea></td>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<th>文章内容</th>
							<td colspan="3" style="height:460px;padding:0;margin:0;">
								<!-- KindEditor -->
								<iframe src="../editor/kindEditor.html" style="height:100%"></iframe>
							</td>
						</tr>
						<tr>
							<th>文章内容</th>
							<td colspan="3" style="height:480px;padding:0;margin:0;">
								<!-- 百度UEditor -->
								<iframe src="../editor/uEditor.html" style="height:100%"></iframe>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<!-- 主要内容 E -->
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/dateTimePicker/lhgcalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
		<script type="text/javascript" src="../js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
		<script type="text/javascript" src="../js/common/common.js"></script>
		<!-- js E -->
	</cite>
</body>
</html>