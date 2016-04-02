<?php
/**
 * @doc 部门列表
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
				<a href="javascript:sortBy('link_apply_id', 'DESC');" title="点击对列表排序">链接申请ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('act_user_id', 'DESC');" title="点击对列表排序">操作用户ID<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('act_comment', 'DESC');" title="点击对列表排序">处理备注信息<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('act_time', 'DESC');" title="点击对列表排序">处理时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('act_status', 'DESC');" title="点击对列表排序">申请状态处理结果<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['friendlinkOperateList'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['friendlinkOperateList'] as $key=>$friendlinkOperate) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $friendlinkOperate['id'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkOperate['apply_name'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkOperate['user_name'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkOperate['act_comment'];?></td>
			<td style="text-align:center;"><?php echo to_date($friendlinkOperate['act_time']);?></td>
			<td style="text-align:center;"><?php echo $friendlinkOperate['act_status']==1?'启用':'不启用';?></td>
			<td style="text-align:center;">
				<a href="javascript:del('friend_link_apply_act_log', <?php echo $friendlinkOperate['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
