<?php
/**
 * @doc 贷款快速申请列表
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
			<td colspan="20"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width:24px;">选择</th>
			<th style="min-width:40px;">
				<a href="javascript:sortBy('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('product_id', 'DESC');" title="点击对列表排序">产品名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('real_name', 'DESC');" title="点击对列表排序">姓名<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('phone', 'DESC');" title="点击对列表排序">联系电话<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('money_want', 'DESC');" title="点击对列表排序">贷款额度<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('loan_type', 'DESC');" title="点击对列表排序">贷款类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_handle', 'DESC');" title="点击对列表排序">处理状态<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('handle_user_id', 'DESC');" title="点击对列表排序">处理人用户名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('handle_result', 'DESC');" title="点击对列表排序">处理结果<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('insert_time', 'DESC');" title="点击对列表排序">添加时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_enable', 'DESC');" title="点击对列表排序">是否有效<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_delete', 'DESC');" title="点击对列表排序">是否删除<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['moneyQuickApply_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['moneyQuickApply_list'] as $key=>$moneyQuickApply) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=Product&op=edit&id=<?php echo $moneyQuickApply['id'];?>"><?php echo $moneyQuickApply['product_name'];?></a></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['real_name'];?></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['phone'];?></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['money_want'];?></td>
			<td style="text-align:center;">
				<?php if($moneyQuickApply['loan_type'] == "1"){ ?>
					<?php echo $moneyQuickApply['loan_type'] = "抵押贷款";?>
				<?php } ?>
				<?php if($moneyQuickApply['loan_type'] == "2"){ ?>
					<?php echo $moneyQuickApply['loan_type'] = "信用贷款";?>
				<?php } ?>
			</td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['is_handle']==1?'已处理':'未处理';?></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['handle_user_name'];?></td>
			<td style="text-align:center;">
				<?php if($moneyQuickApply['handle_result'] == "0"){ ?>
					<?php echo $moneyQuickApply['handle_result'] = "未知";?>
				<?php } ?>
				<?php if($moneyQuickApply['handle_result'] == "1"){ ?>
					<?php echo $moneyQuickApply['handle_result'] = "符合要求";?>
				<?php } ?>
				<?php if($moneyQuickApply['handle_result'] == "2"){ ?>
					<?php echo $moneyQuickApply['handle_result'] = "不符合要求";?>
				<?php } ?>
			</td>
			<td style="text-align:center;"><?php echo to_date($moneyQuickApply['insert_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($moneyQuickApply['update_time']);?></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $moneyQuickApply['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=moneyQuickApply&op=edit&id=<?php echo $moneyQuickApply['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('money_quick_apply', <?php echo $moneyQuickApply['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
