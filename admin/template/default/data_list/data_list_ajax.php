<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>数据列表页面-无刷新更新</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
</head>
<body>
	<div class="container">
		<!-- 头部 S -->
		<div class="header">
			<!-- 标题部分 S -->
			<div class="page_title">
				<span class="first">后台管理中心</span>——<span class="second">数据列表<a class="external-link" id="new_tab">新窗</a></span>
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
			<!-- 搜索区域 S -->
			<div class="data_list_search">
				<form action="" method="post">
					<table>
						<tbody>
							<tr>
								<th>订单号</th>
								<td><input type="text" placeholder="输入订单号"/></td>
								<th>店铺</th>
								<td><input type="text" placeholder="输入店铺名称"/></td>
								<th>订单状态</th>
								<td>
									<select>
										<option>请选择</option>
										<option value="1">待付款</option>
										<option value="1">待发货</option>
										<option value="1">待收货</option>
										<option value="1">交易完成</option>
										<option value="1">已取消</option>
									</select>
								</td>
								<td rowspan="2"><a href="javascript:;" class="btn btn-primary">搜索</a></td>
							</tr>
							<tr>
								<th>下单时间</th>
								<td><input type="text" name="order_insert_time" id="order_insert_time_start" value="2014-11-30 12:20:35" placeholder="选择起始时间" onclick="javascript:$.calendar({maxDate:'#order_insert_time_end',format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
								<th style="text-align:center;">/</th>
								<td><input type="text" name="order_insert_time" id="order_insert_time_end" placeholder="选择结束时间" onclick="javascript:$.calendar({minDate:'#order_insert_time_start',format:'yyyy-MM-dd HH:mm:ss'})    ;" class="date_time_picker"/></td>
								<th>付款方式</th>
								<td>
									<select>
										<option>请选择</option>
										<option value="1">货到付款</option>
										<option value="1">支付宝</option>
										<option value="1">网银支付</option>
										<option value="1">预存款</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!-- 搜索区域 E -->
			<!-- 数据列表 S -->
			<div class="data-list-table">
				<table class="table table-striped table-bordered table-condensed table-data-list">
					<thead>
						<tr>
							<td colspan="15">订单列表</td>
						</tr>
						<tr>
							<th style="min-width: 24px;">选择</th>
							<th style="min-width: 40px;">
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">商品名称<em class="triangle-down"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">货号<em class="triangle-down"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">价格<em class="triangle-down"></em></a>
							</th>
							<th style="width: auto;">
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">精品<em class="triangle-up"></em></a>
							</th>
							<th style="width: auto;">
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">新品<em class="triangle-down"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">热销<em class="triangle-up"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">推荐排序<em class="triangle-up"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">库存<em class="triangle-up"></em></a>
							</th>
							<th>
								<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">自定销量<em class="triangle-up"></em></a>
							</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: center;"><input name="check" type="checkbox"></td>
							<td style="text-align:right;">1</td>
							<td>鬼爪炸钩 伊势尼鱼钩 爆炸钩炸弹钩8910号 海钓鱼钩鱼钩</td>
							<td style="text-align:right;">yuju000512</td>
							<td style="text-align:right;">95.00</td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-off"></b></td>
							<td style="text-align:right;">100</td>
							<td style="text-align:right;">123</td>
							<td style="text-align:right;">49</td>
							<td style="text-align:center;">
								<a href="javascript:;" class="btn btn-mini">编辑</a>
								<a href="javascript:;" class="btn btn-mini btn-danger">删除</a>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;"><input name="check" type="checkbox"></td>
							<td style="text-align:right;">1</td>
							<td>鬼爪炸钩 伊势尼鱼钩 爆炸钩炸弹钩8910号 海钓鱼钩鱼钩</td>
							<td style="text-align:right;">yuju000512</td>
							<td style="text-align:right;">95.00</td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-off"></b></td>
							<td style="text-align:right;">100</td>
							<td style="text-align:right;">123</td>
							<td style="text-align:right;">49</td>
							<td style="text-align:center;">
								<a href="" class="btn btn-mini">编辑</a>
								<a href="" class="btn btn-mini btn-danger">删除</a>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;"><input name="check" type="checkbox"></td>
							<td style="text-align:right;">1</td>
							<td>鬼爪炸钩 伊势尼鱼钩 爆炸钩炸弹钩8910号 海钓鱼钩鱼钩</td>
							<td style="text-align:right;">yuju000512</td>
							<td style="text-align:right;">95.00</td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-off"></b></td>
							<td style="text-align:right;">100</td>
							<td style="text-align:right;">123</td>
							<td style="text-align:right;">49</td>
							<td style="text-align:center;">
								<a href="javascript:;" class="btn btn-mini">编辑</a>
								<a href="javascript:;" class="btn btn-mini btn-danger">删除</a>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;"><input name="check" type="checkbox"></td>
							<td style="text-align:right;">1</td>
							<td>鬼爪炸钩 伊势尼鱼钩 爆炸钩炸弹钩8910号 海钓鱼钩鱼钩</td>
							<td style="text-align:right;">yuju000512</td>
							<td style="text-align:right;">95.00</td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-off"></b></td>
							<td style="text-align:right;">100</td>
							<td style="text-align:right;">123</td>
							<td style="text-align:right;">49</td>
							<td style="text-align:center;">
								<a href="javascript:;" class="btn btn-mini">编辑</a>
								<a href="javascript:;" class="btn btn-mini btn-danger">删除</a>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;"><input name="check" type="checkbox"></td>
							<td style="text-align:right;">1</td>
							<td>鬼爪炸钩 伊势尼鱼钩 爆炸钩炸弹钩8910号 海钓鱼钩鱼钩</td>
							<td style="text-align:right;">yuju000512</td>
							<td style="text-align:right;">95.00</td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-on"></b></td>
							<td style="text-align:center;"><b class="check-off"></b></td>
							<td style="text-align:right;">100</td>
							<td style="text-align:right;">123</td>
							<td style="text-align:right;">49</td>
							<td style="text-align:center;">
								<a href="javascript:;" class="btn btn-mini">编辑</a>
								<a href="javascript:;" class="btn btn-mini btn-danger">删除</a>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="15" style="text-align:right;">
								脚部，数据操作请谨慎！
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 数据列表 E -->
			<!-- 数据选择 S -->
			<div class="data-operate">
				<p class="list_select text-left lmargin20 middle">
					<input type="checkbox" class="check_all"><span>全选</span>
					<input type="checkbox" class="check_reverse"><span>反选</span>
					<input type="button" class="btn btn-danger" value="删除"> 当前已选中<b class="checked_count">0</b>条数据
				</p>
			</div>
			<!-- 数据选择 E -->
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
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" src="../js/jquery/2.1.3/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/dateTimePicker/lhgcalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
		<script type="text/javascript" src="../js/common/common.js"></script>
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