<?php
/**
 * @doc 发送记录列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=smslog&op=add" class="btn btn-primary btn-large">发送记录</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="<?php echo count(array_keys($output['smslog_list'][0]))+2;?>"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width:24px;">选择</th>
			<th style="min-width:40px;">
				<a href="javascript:sortBy('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('receiver', 'DESC');" title="点击对列表排序">接收人<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('content', 'DESC');" title="点击对列表排序">发送内容<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('type', 'DESC');" title="点击对列表排序">验证类型<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('insert_time', 'DESC');" title="点击对列表排序">插入时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('client_ip', 'DESC');" title="点击对列表排序">客户IP地址<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['smslog_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['smslog_list'] as $key=>$smslog) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:right;"><?php echo $smslog['id'];?></td>
			<td style="text-align:left;"><?php echo $smslog['receiver'];?></td>
			<td style="text-align:right;"><?php echo $smslog['content'];?></td>
			<td style="text-align:right;"><?php echo $smslog['type'];?></td>
			<td style="text-align:center;"><?php echo to_date($smslog['insert_time']);?></td>
			<td style="text-align:center;"><?php echo $smslog['client_ip'];?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=smslog&op=edit&id=<?php echo $smslog['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('sms_log', <?php echo $smslog['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

