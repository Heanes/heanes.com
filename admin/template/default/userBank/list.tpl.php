<?php
/**
 * @doc 银行列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=userBank&op=add" class="btn btn-primary btn-large">添加用户银行</a>
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
				<a href="javascript:sortBy('user_id', 'DESC');" title="点击对列表排序">用户ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('real_name', 'DESC');" title="点击对列表排序">真实姓名<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('bank_id', 'DESC');" title="点击对列表排序">银行卡类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('bank_no', 'DESC');" title="点击对列表排序">银行卡号<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('account_bank_address', 'DESC');" title="点击对列表排序">开户行地点<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('insert_time', 'DESC');" title="点击对列表排序">上传时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_enable', 'DESC');" title="点击对列表排序">是否有效<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['userBankList'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['userBankList'] as $key=>$userBank) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $userBank['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=userBank&op=edit&id=<?php echo $userBank['id'];?>"><?php echo $userBank['user_name'];?></a></td>
			<td style="text-align:center;"><?php echo $userBank['real_name'];?></td>
			<td style="text-align:center;"><?php echo $userBank['name'];?></td>
			<td style="text-align:center;"><?php echo $userBank['bank_no'];?></td>
			<td style="text-align:center;"><?php echo $userBank['account_bank_address'];?></td>
			<td style="text-align:center;"><?php echo to_date($userBank['insert_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($userBank['update_time']);?></td>
			<td style="text-align:center;"><?php echo $userBank['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=userBank&op=edit&id=<?php echo $userBank['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('user_bank', <?php echo $userBank['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
