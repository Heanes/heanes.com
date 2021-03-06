<?php
/**
 * @doc 贷款申请列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=borrowApply&op=add" class="btn btn-primary btn-large">添加贷款申请</a>
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
				<a href="javascript:sortBy('uid_master', 'DESC');" title="点击对列表排序">业务主ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('uid_slave', 'DESC');" title="点击对列表排序">业务客ID<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('usage_id', 'DESC');" title="点击对列表排序">贷款用途<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('total', 'DESC');" title="点击对列表排序">贷款额度<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('year_limit', 'DESC');" title="点击对列表排序">贷款年限<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('rate', 'DESC');" title="点击对列表排序">利息<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('get_money_limit_time', 'DESC');" title="点击对列表排序">贷款成功截止期限<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('get_money_time', 'DESC');" title="点击对列表排序">放款时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('repay_money_time', 'DESC');" title="点击对列表排序">还款时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('create_time', 'DESC');" title="点击对列表排序">贷款申请时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('update_time', 'DESC');" title="点击对列表排序">贷款更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('status', 'DESC');" title="点击对列表排序">贷款申请状态<em class="triangle-up"></em></a>
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
		
		
		
		
		<?php if(empty($output['jiekuanApplyList'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['jiekuanApplyList'] as $key=>$jiekuanApply) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=borrow&op=edit&id=<?php echo $jiekuanApply['id'];?>"><?php echo $jiekuanApply['master_name'];?></a></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['slave_name'];?></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['usage_name'];?></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['total'];?></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['year_limit'];?></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['rate'];?></td>
			<td style="text-align:center;"><?php echo $jiekuanApply['get_money_limit_time'];?></td>
			<td style="text-align:center;"><?php echo to_date($jiekuanApply['get_money_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($jiekuanApply['repay_money_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($jiekuanApply['create_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($jiekuanApply['update_time']);?></td>
			<td style="text-align:center;">
				<?php if($jiekuan['status'] == "0"){ ?>
					<?php echo $jiekuan['status'] = "审核中";?>
				<?php } ?>
				<?php if($jiekuan['status'] == "1"){ ?>
					<?php echo $jiekuan['status'] = "已通过";?>
				<?php } ?>
				<?php if($jiekuan['status'] == "2"){ ?>
					<?php echo $jiekuan['status'] = "已拒绝";?>
				<?php } ?>
			</td>
			<td style="text-align:center;"><?php echo $jiekuan['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $jiekuan['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=borrowApply&op=edit&id=<?php echo $jiekuanApply['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('borrow', <?php echo $jiekuanApply['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
