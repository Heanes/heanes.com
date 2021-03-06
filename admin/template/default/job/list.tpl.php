<?php
/**
 * @doc 职位列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL; ?>index.php?act=job&op=add" class="btn btn-primary btn-large">添加职位</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="20"><?php echo $output['page_title']; ?></td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('name', 'DESC');" title="职位名称">职位名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('category_id', 'DESC');" title="职位分类">职位分类<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('order', 'DESC');" title="排序">排序<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if (empty($output['job_list'])) { ?>
			<tr>
				<td>暂无内容</td>
			</tr>
		<?php } ?>
		<?php foreach ($output['job_list'] as $key => $job) { ?>
			<tr>
				<td style="text-align:center;"><input name="check" type="checkbox"></td>
				<td style="text-align:center;"><?php echo $job['id']; ?></td>
				<td style="text-align:center;"><a href="<?php echo BASE_URL; ?>index.php?act=job&op=edit&id=<?php echo $job['id']; ?>"><?php echo $job['name']; ?></a></td>
				<td><?php echo $job['category_id']; ?></td>
				<td><?php echo $job['order']; ?></td>
				<td style="text-align:center;">
					<a href="<?php echo BASE_URL; ?>index.php?act=job&op=edit&id=<?php echo $job['id']; ?>" class="btn btn-mini">编辑</a>
					<a href="javascript:del('job', <?php echo $job['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
<!-- 数据列表 E -->

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
