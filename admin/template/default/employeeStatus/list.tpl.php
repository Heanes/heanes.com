<?php
/**
 * @doc 员工职位申请状态操作记录列表
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
			<td colspan="9"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width:24px;">选择</th>
			<th style="min-width:40px;">
				<a href="javascript:sortBy('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('employee_id', 'DESC');" title="点击对列表排序">员工ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('actor_user_id', 'DESC');" title="点击对列表排序">操作用户名称<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('status', 'DESC');" title="点击对列表排序">审核状态<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('reason', 'DESC');" title="点击对列表排序">处理原因<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('insert_time', 'DESC');" title="点击对列表排序">添加时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_enable', 'DESC');" title="点击对列表排序">是否有效<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['employeeStatusLog_list'])){ ?>
			<tr><td colspan="9">暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['employeeStatusLog_list'] as $key=>$employeeStatusLog) { ?>
			<tr>
				<td style="text-align:center;"><input name="check" type="checkbox"></td>
				<td style="text-align:center;"><?php echo $employeeStatusLog['id'];?></td>
				<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=Employee&op=edit&id=<?php echo $employeeStatusLog['employee_id'];?>"><?php echo $employeeStatusLog['employee_id'];?></a></td>
				<td style="text-align:center;"><?php echo $employeeStatusLog['actor_user_name'];?></td>
				<td style="text-align:center;">
					<?php if($employeeStatusLog['status'] == "0"){ ?>
					<?php echo $employeeStatusLog['status'] = "审核中";?>
					<?php } ?>
					<?php if($employeeStatusLog['status'] == "1"){ ?>
						<?php echo $employeeStatusLog['status'] = "通过";?>
					<?php } ?>
					<?php if($employeeStatusLog['status'] == "-1"){ ?>
						<?php echo $employeeStatusLog['status'] = "拒绝";?>
					<?php } ?>
				</td>
				<td style="text-align:center;"><?php echo $employeeStatusLog['reason'];?></td>
				<td style="text-align:center;"><?php echo to_date($employeeStatusLog['insert_time']);?></td>
				<td style="text-align:center;"><?php echo $employeeStatusLog['is_enable']==1?'有效':'无效';?></td>
				<td style="text-align:center;">
					<a href="<?php echo BASE_URL;?>index.php?act=EmployeeStatus&op=look&id=<?php echo $employeeStatusLog['id'];?>" class="btn btn-mini">查看</a>
					<a href="javascript:del('employee_apply_status_log', <?php echo $employeeStatusLog['id'];?>);" class="btn btn-mini btn-danger">删除</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="9" style="text-align:right;">数据操作请谨慎！</td>
		</tr>
		</tfoot>
	</table>
</div>
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

