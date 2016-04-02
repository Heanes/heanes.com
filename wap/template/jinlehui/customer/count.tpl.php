<?php
/**
 * @doc 客户统计页面
 * @filesource count.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-12 22:47:14
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<?php
/**
 * @doc
 * @filesource commingSoon.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.10 010
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap" style="background:#fff;">
	<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
	<div id="count_main" style="height:300px"></div>
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
			'echarts/chart/pie' // 使用柱状图就加载bar模块，按需加载
		],
		function (ec) {
			// 基于准备好的dom，初始化echarts图表
			var myChart = ec.init(document.getElementById('count_main'));
			var option = {
				title: {
					text: '客户统计',
					subtext: '中企永宏',
					x: 'center'
				},
				tooltip: {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: 'vertical',
					x: 'left',
					data: ['其他', '客户1', '客户2', '客户3', '客户4', '客户5']
				},
				toolbox: {
					show: true,
					feature: {
						mark: {show: true},
						magicType: {

							type: ['pie', 'funnel'],
							option: {
								funnel: {
									x: '25%',
									width: '50%',
									funnelAlign: 'left',
									max: 1548
								}
							}
						},
						restore: {show: true},
						saveAsImage: {show: true}
					}
				},
				calculable: true,
				series: [
					{
						name: '客户统计',
						type: 'pie',
						radius: '55%',
						center: ['50%', '60%'],
						data: [
							{value: 2000, name: '其他'},
							{value: 0, name: '客户1'},
							{value: 0, name: '客户2'},
							{value: 0, name: '客户3'},
							{value: 0, name: '客户4'},
							{value: 0, name: '客户5'}
						]
					}
				]
			};
			// 为echarts对象加载数据
			myChart.setOption(option);
		}
	);
</script>
