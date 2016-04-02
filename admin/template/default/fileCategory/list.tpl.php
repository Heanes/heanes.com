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
		<a href="<?php echo BASE_URL;?>index.php?act=FileCategory&op=add" class="btn btn-primary btn-large">添加文件分类</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">文件分类列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('name', 'DESC');" title="点击对列表排序">分类名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('path', 'DESC');" title="点击对列表排序">分类存储路径<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('file_type', 'DESC');" title="点击对列表排序">允许存储文件的类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_role_id', 'DESC');" title="点击对列表排序">允许访问角色<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('update_time', 'DESC');" title="点击对列表排序">插入时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_enable', 'DESC');" title="点击对列表排序">是否启用<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['fileCategory_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['fileCategory_list'] as $key=>$fileCategory) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $fileCategory['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=FileCategory&op=edit&id=<?php echo $fileCategory['id'];?>"><?php echo $fileCategory['name'];?></a></td>
			<td style="text-align:center;"><?php echo $fileCategory['path'];?></td>
			<td style="text-align:center;"><?php echo $fileCategory['type_name'];?></td>
			<td style="text-align:center;"><?php echo $fileCategory['user_role_name'];?></td>
			<td style="text-align:center;"><?php echo to_date($fileCategory['update_time']);?></td>
			<td style="text-align:center;"><?php echo $fileCategory['is_enable']==1?'启用':'不启用';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=FileCategory&op=edit&id=<?php echo $fileCategory['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('file_category', <?php echo $fileCategory['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

