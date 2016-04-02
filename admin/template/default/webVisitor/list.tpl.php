<?php
/**
 * @doc
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">网站访问统计列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('access_url', 'DESC');" title="点击对列表排序">访客访问页面<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('refer_url', 'DESC');" title="点击对列表排序">来源页面<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('ip', 'DESC');" title="点击对列表排序">访客IP<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('os', 'DESC');" title="点击对列表排序">访客操作系统信息<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('come_time', 'DESC');" title="点击对列表排序">访问时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('visit_times', 'DESC');" title="点击对列表排序">访问次数<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['webWisitor_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['webWisitor_list'] as $key=>$webWisitor) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $webWisitor['id'];?></td>
			<td style="text-align:center;"><?php echo $webWisitor['access_url'];?></td>
			<td style="text-align:center;"><?php echo $webWisitor['refer_url'];?></td>
			<td style="text-align:center;"><?php echo $webWisitor['ip'];?></td>
			<td style="text-align:center;"><?php echo $webWisitor['os'];?></td>
			<td style="text-align:center;"><?php echo to_date($webWisitor['come_time']);?></td>
			<td style="text-align:center;"><?php echo $webWisitor['visit_times'];?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=WebVisitor&op=look&id=<?php echo $webWisitor['id'];?>" class="btn btn-mini">查看</a>
				<a href="javascript:del('web_visitor', <?php echo $webWisitor['id'];?>);" class="btn btn-mini btn-danger">删除</a>
			</td>
		</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="15" style="text-align:right;">数据操作请谨慎！</td>
		</tr>
		</tfoot>
	</table>
</div>
<!-- 列表下部操作 S -->
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
<?php include(TPL.'pager/pagerDefaultStyle.tpl.php'); ?>
<!-- 分页部分 E -->
<!-- 列表下部操作 E -->

