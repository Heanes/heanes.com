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
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">消息操作日志列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('messageLog_id', 'DESC');" title="点击对列表排序">被操作消息ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('act_user_id', 'DESC');" title="点击对列表排序">用户名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('act_type', 'DESC');" title="点击对列表排序">操作类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('actor_ip', 'DESC');" title="点击对列表排序">操作者IP<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('actor_browser', 'DESC');" title="点击对列表排序">操作者浏览器<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('actor_os', 'DESC');" title="点击对列表排序">操作者操作系统<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('actor_country', 'DESC');" title="点击对列表排序">操作者国家<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('actor_province', 'DESC');" title="点击对列表排序">操作者省<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('act_time', 'DESC');" title="点击对列表排序">操作时间<em class="triangle-down"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['messageLog_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['messageLog_list'] as $key=>$messageLog) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $messageLog['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=userMessage&op=edit&id=<?php echo $messageLog['message_id'];?>"><?php echo $messageLog['message_id'];?></a></td>
			<td style="text-align:center;"><?php echo $messageLog['act_user_name'];?></td>
			<td style="text-align:center;">
				<?php if($messageLog['act_type'] == "0"){ ?>
					<?php echo $messageLog['act_type'] = "是否发送";?>
				<?php } ?>
				<?php if($messageLog['act_type'] == "1"){ ?>
					<?php echo $messageLog['act_type'] = "是否阅读";?>
				<?php } ?>
				<?php if($messageLog['act_type'] == "2"){ ?>
					<?php echo $messageLog['act_type'] = "是否删除";?>
				<?php } ?>
			</td>
			<td style="text-align:center;"><?php echo $messageLog['actor_ip'];?></td>
			<td style="text-align:center;"><?php echo $messageLog['actor_browser'];?></td>
			<td style="text-align:center;"><?php echo $messageLog['actor_os'];?></td>
			<td style="text-align:center;"><?php echo $messageLog['actor_country'];?></td>
			<td style="text-align:center;"><?php echo $messageLog['actor_province'];?></td>
			<td style="text-align:center;"><?php echo to_date($messageLog['act_time']);?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=messageLog&op=show&id=<?php echo $messageLog['id'];?>" class="btn btn-mini">查看</a>
				<a href="javascript:del('message_log', <?php echo $messageLog['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

