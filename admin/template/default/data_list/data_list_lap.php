<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
<meta name="renderer" content="webkit"/><!-- 让360等多核模式浏览器默认用极速模式打开 -->
<meta name="author" content="Heanes heanes.com email(heanes@163.com)"/>
<meta name="keywords" content="软件,商务,HTML,tutorials,source codes"/>
<meta name="description" content="描述"/>
<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico"/>
<link rel="bookmark" href="/data/upload/image/web/favicon.ico"/>
<title>可折叠数据列表</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">数据列表</span>
			</div>
			<!-- 标题部分 E -->
		</div>
		<!-- 头部 E -->
		<!-- 主要内容 S -->
		<div class="main">
			<div class="data-list data-lap-tree">
				<!-- 表格式 S -->
				<div class="tips_div">
					<p>提示信息：点击“+”加号可以展开折叠</p>
				</div>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th></th>
							<th>排序</th>
							<th>分类名称</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<table class="table-condensed table-data-lap">
									<tr>
										<td><b class="lap-tree-icon">+</b></td>
										<td>
											<table>
												<tr>
													<td>1</td>
													<td>首页</td>
													<td>操作</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2"></td>
									</tr>
								</table>
								<table class="table-condensed table-data-lap">
									<tr>
										<td><b class="lap-tree-icon">+</b></td>
										<td>
											<table class="table-data-lap-cell">
												<tr>
													<td>我要借款</td>
													<td>操作</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table class="table-condensed table-data-lap">
												<tr>
													<td><b class="lap-tree-icon">+</b></td>
													<td>
														<table class="table-data-lap-cell">
															<tr>
																<td>散标投资</td>
																<td>操作</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="2"></td>
												</tr>
											</table>
											<table class="table-condensed table-data-lap">
												<tr>
													<td><b class="lap-tree-icon">+</b></td>
													<td>
														<table class="table-data-lap-cell">
															<tr>
																<td>债权转让</td>
																<td>操作</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="2"></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<table class="table-condensed table-data-lap">
									<tr>
										<td><b class="lap-tree-icon">+</b></td>
										<td>
											<table>
												<tr>
													<td>新闻资讯</td>
													<td>操作</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table class="table-condensed table-data-lap">
												<tr>
													<td><b class="lap-tree-icon">+</b></td>
													<td>
														<table>
															<tr>
																<td>科技</td>
																<td>操作</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<table class="table-condensed table-data-lap">
															<tr>
																<td><b class="lap-tree-icon">+</b></td>
																<td>
																	<table class="table-data-lap-cell">
																		<tr>
																			<td>苹果</td>
																			<td>操作</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td colspan="2"></td>
															</tr>
														</table>
														<table class="table-condensed table-data-lap">
															<tr>
																<td><b class="lap-tree-icon">+</b></td>
																<td>
																	<table class="table-data-lap-cell">
																		<tr>
																			<td>谷歌</td>
																			<td>操作</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td colspan="2"></td>
															</tr>
														</table>
														<table class="table-condensed table-data-lap">
															<tr>
																<td><b class="lap-tree-icon">+</b></td>
																<td>
																	<table class="table-data-lap-cell">
																		<tr>
																			<td>微软</td>
																			<td>操作</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td colspan="2"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<table class="table-condensed table-data-lap">
												<tr>
													<td><b class="lap-tree-icon">+</b></td>
													<td>
														<table>
															<tr>
																<td>生活</td>
																<td>操作</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="2"></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<!-- 表格式 E -->
				<div class="margin20"></div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>折叠</th>
							<th>排序</th>
							<th>分类名称</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>+</th>
							<td>1</td>
							<td>分类1</td>
							<td><a href="javascript:;">编辑</a> <a href="javascript:;">删除</a></td>
						</tr>
						<tr>
							<th>+</th>
							<td>2</td>
							<td>分类2</td>
							<td><a href="javascript:;">编辑</a> <a href="javascript:;">删除</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- 主要内容 E -->
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/common/common.js"></script>
		<!-- js E -->
	</cite>
</body>
</html>