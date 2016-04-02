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
		<a href="<?php echo BASE_URL;?>index.php?act=userMessage&op=add" class="btn btn-primary btn-large">添加会员私信</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">会员私信列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('recvier_user_id', 'DESC');" title="点击对列表排序">接收人用户名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('sender_user_id', 'DESC');" title="点击对列表排序">发送人用户名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('title', 'DESC');" title="点击对列表排序">私信标题<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('content', 'DESC');" title="点击对列表排序">私信内容<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('send_time', 'DESC');" title="点击对列表排序">发送时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_read', 'DESC');" title="点击对列表排序">是否已读<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('read_time', 'DESC');" title="点击对列表排序">阅读时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_delete', 'DESC');" title="点击对列表排序">是否已删除<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_top', 'DESC');" title="点击对列表排序">是否置顶<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_enable', 'DESC');" title="点击对列表排序">是否有效<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['userMessage_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['userMessage_list'] as $key=>$userMessage) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $userMessage['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=userMessage&op=edit&id=<?php echo $userMessage['id'];?>"><?php echo $userMessage['recvier_user_name'];?></a></td>
			<td style="text-align:center;"><?php echo $userMessage['sender_user_name'];?></td>
			<td style="text-align:center;"><?php echo $userMessage['title'];?></td>
			<td style="text-align:center;"><?php echo $userMessage['content'];?></td>
			<td style="text-align:center;"><?php echo to_date($userMessage['send_time']);?></td>
			<td style="text-align:center;"><?php echo $userMessage['is_read']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo to_date($userMessage['read_time']);?></td>
			<td style="text-align:center;"><?php echo $userMessage['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $userMessage['is_top']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $userMessage['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=userMessage&op=edit&id=<?php echo $userMessage['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('user_message', <?php echo $userMessage['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

