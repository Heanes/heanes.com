<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div class="main-content w-wrap">
	<div id="count_main" style="height:300px;"></div>
</div>
<!-- ECharts单文件引入 -->
<script src="<?php echo SYS_HOST ?>public/static/libs/ECharts/2.2.6/echarts.js"></script>
<script type="text/javascript">

	// 路径配置
	require.config({
		paths: {
			echarts: '<?php echo SYS_HOST?>public/static/libs/ECharts/2.2.6'
		}
	});

	require(
		[
			'echarts',
			'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
		],
		function (ec) {
			// 基于准备好的dom，初始化echarts图表
			var myChart = ec.init(document.getElementById('count_main'));
			var option = {
				title: {
					text: '贷款统计',
					subtext: '贷款业务统计'
				},
				tooltip: {
					trigger: 'axis'
				},
				legend: {
					data: ['目标量', '实际量']
				},
				toolbox: {
					show: true,
					feature: {


						saveAsImage: {show: true}
					}
				},
				calculable: true,
				xAxis: [
					{
						type: 'category',
						data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
					}
				],
				yAxis: [
					{
						type: 'value'
					}
				],
				series: [
					{
						name: '目标量',
						type: 'bar',
						data: [0, 0.0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
						markPoint: {
							data: [
								{type: 'max', name: '最大值'},
								{type: 'min', name: '最小值'}
							]
						},
						markLine: {
							data: [
								{type: 'average', name: '平均值'}
							]
						}
					},
					{
						name: '实际量',
						type: 'bar',
						data: [0, 0.0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
						markPoint: {
							data: [
								{name: '年最高', value: 2, xAxis: 7, yAxis: 183, symbolSize: 18},
								{name: '年最低', value: 2.3, xAxis: 11, yAxis: 3}
							]
						},
						markLine: {
							data: [
								{type: 'average', name: '平均值'}
							]
						}
					}
				]
			};
			// 为echarts对象加载数据
			myChart.setOption(option);
		}
	);
</script>
