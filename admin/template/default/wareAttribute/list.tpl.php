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
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=WareAttribute&op=add" class="btn btn-primary btn-large">添加物品属性</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">物品属性列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('type_id', 'DESC');" title="点击对列表排序">类型名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('name', 'DESC');" title="点击对列表排序">属性名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('input_type', 'DESC');" title="点击对列表排序">属性输入类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('as_filter', 'DESC');" title="点击对列表排序">是否作为筛选条件<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_show', 'DESC');" title="点击对列表排序">是否显示在详细页<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_enable', 'DESC');" title="点击对列表排序">是否启用<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_delete', 'DESC');" title="点击对列表排序">是否删除<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['wareFields_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['wareFields_list'] as $key=>$wareFields) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $wareFields['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=WareType&op=edit&id=<?php echo $wareFields['type_id'];?>"><?php echo $wareFields['type_name'];?></a></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=WareAttribute&op=edit&id=<?php echo $wareFields['id'];?>"><?php echo $wareFields['name'];?></a></td>
			<td style="text-align:center;"><?php echo $wareFields['input_type'];?></td>
			<td style="text-align:center;"><?php echo $wareFields['as_filter']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $wareFields['is_show']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $wareFields['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $wareFields['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=WareAttribute&op=edit&id=<?php echo $wareFields['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('ware_fields', <?php echo $wareFields['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

