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
		<a href="<?php echo BASE_URL;?>index.php?act=UserCertification&op=add" class="btn btn-primary btn-large">添加用户认证</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">用户认证列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_id', 'DESC');" title="点击对列表排序">用户ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('type_id', 'DESC');" title="点击对列表排序">验证类型ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('message', 'DESC');" title="点击对列表排序">申请审核留言<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('create_time', 'DESC');" title="点击对列表排序">申请添加时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('status', 'DESC');" title="点击对列表排序">认证状态<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['Usercertification_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['Usercertification_list'] as $key=>$Usercertification) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $Usercertification['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=UserCertification&op=edit&id=<?php echo $Usercertification['id'];?>"><?php echo $Usercertification['user_name'];?></a></td>
			<td style="text-align:center;"><?php echo $Usercertification['type_name'];?></td>
			<td style="text-align:center;"><?php echo $Usercertification['message'];?></td>
			<td style="text-align:center;"><?php echo to_date($Usercertification['create_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($Usercertification['update_time']);?></td>
			<td style="text-align:center;">
				<?php if($Usercertification['status'] == "0"){ ?>
					<?php echo $Usercertification['status'] = "审核中";?>
				<?php } ?>
				<?php if($Usercertification['status'] == "1"){ ?>
					<?php echo $Usercertification['status'] = "已通过验证";?>
				<?php } ?>
				<?php if($Usercertification['status'] == "-1"){ ?>
					<?php echo $Usercertification['status'] = "未通过验证";?>
				<?php } ?>
			</td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=UserCertification&op=edit&id=<?php echo $Usercertification['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('user_certification', <?php echo $Usercertification['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

