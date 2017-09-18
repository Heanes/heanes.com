<?php
/**
 * @doc 客户管理
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=customer&op=add" class="btn btn-primary btn-large">添加客户</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="20"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width:24px;">选择</th>
			<th style="min-width:40px;">
				<a href="javascript:sortBy('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('uid_master', 'DESC');" title="点击对列表排序">关系人主<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('uid_slave', 'DESC');" title="点击对列表排序">关系人客<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('ship_type', 'DESC');" title="点击对列表排序">关系类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('status', 'DESC');" title="点击对列表排序">关系状态<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('create_time', 'DESC');" title="点击对列表排序">插入时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('apply_now', 'DESC');" title="点击对列表排序">是否递交申请<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_delete', 'DESC');" title="点击对列表排序">是否删除<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['customer_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['customer_list'] as $key=>$customer) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $customer['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=customer&op=edit&id=<?php echo $customer['id'];?>"><?php echo $customer['uid_master_name'];?></a></td>
			<td style="text-align:center;"><?php echo $customer['uid_slave_name'];?></td>
			<td style="text-align:center;">
				<?php if($customer['ship_type'] == "1"){ ?>
					<?php echo $customer['ship_type'] = "好友";?>
				<?php } ?>
				<?php if($customer['ship_type'] == "2"){ ?>
					<?php echo $customer['ship_type'] = "客户/业务";?>
				<?php } ?>
				<?php if($customer['ship_type'] == "3"){ ?>
					<?php echo $customer['ship_type'] = "客户/兼职";?>
				<?php } ?>
			</td>
			<td style="text-align:center;">
				<?php if($customer['status'] == "0"){ ?>
					<?php echo $customer['status'] = "审核中";?>
				<?php } ?>
				<?php if($customer['status'] == "1"){ ?>
					<?php echo $customer['status'] = "已通过";?>
				<?php } ?>
				<?php if($customer['status'] == "2"){ ?>
					<?php echo $customer['status'] = "已拒绝";?>
				<?php } ?>
			</td>
			<td style="text-align:center;"><?php echo to_date($customer['create_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($customer['update_time']);?></td>
			<td style="text-align:center;"><?php echo $customer['apply_now']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $customer['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=customer&op=edit&id=<?php echo $customer['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('customer', <?php echo $customer['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
