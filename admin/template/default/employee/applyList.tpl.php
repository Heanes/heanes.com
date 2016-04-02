<?php
/**
 * @doc 员工列表
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
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">员工<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">部门<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">职位<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">添加时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('add_time', 'DESC');" title="点击对列表排序">是否有效<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['employee_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['employee_list'] as $key=>$employee) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:right;"><?php echo $employee['id'];?></td>
			<td><a href="<?php echo BASE_URL;?>index.php?act=articleCategory&op=edit&id=<?php echo $employee['category_id'];?>"><?php echo $employee['user_name'];?></a></td>
			<td style="text-align:left;"><a href="<?php echo BASE_URL;?>index.php?act=articleCategory&op=edit&id=<?php echo $employee['category_id'];?>"><?php echo $employee['department_name'];?></a></td>
			<td style="text-align:right;"><a href="<?php echo BASE_URL;?>index.php?act=articleCategory&op=edit&id=<?php echo $employee['category_id'];?>"><?php echo $employee['job_name'];?></a></td>
			<td style="text-align:center;"><?php echo to_date($employee['insert_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($employee['update_time']);?></td>
			<td style="text-align:right;"><?php echo $employee['enable']==1?'有效':'无效';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=article&op=edit&id=<?php echo $employee['id'];?>" class="btn btn-mini">编辑</a>
				<a href="<?php echo BASE_URL;?>index.php?act=article&op=del&id=<?php echo $employee['id'];?>" class="btn btn-mini btn-danger">删除</a>
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
<!-- 列表下部操作 E -->

