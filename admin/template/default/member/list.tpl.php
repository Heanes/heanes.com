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
		<a href="<?php echo BASE_URL;?>index.php?act=member&op=add" class="btn btn-primary btn-large">添加会员</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">会员列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_name', 'DESC');" title="点击对列表排序">用户名<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('role_id', 'DESC');" title="点击对列表排序">用户角色名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_email', 'DESC');" title="点击对列表排序">Email<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('mobile', 'DESC');" title="点击对列表排序">手机号<em class="triangle-down"></em></a>
			</th>
			<th style="width: auto;">
				<a href="javascript:listTable.sort('idcard', 'DESC');" title="点击对列表排序">身份证号<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('real_name', 'DESC');" title="点击对列表排序">真实姓名<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('reg_time', 'DESC');" title="点击对列表排序">注册时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('update_time', 'DESC');" title="点击对列表排序">用户资料最后更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('last_login_time', 'DESC');" title="点击对列表排序">最后登陆时间<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['member_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['member_list'] as $key=>$member) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $member['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=member&op=edit&id=<?php echo $member['id'];?>"><?php echo $member['user_name'];?></a></td>
			<td style="text-align:center;"><?php echo $member['role_name'];?></td>
			<td style="text-align:center;"><?php echo $member['user_email'];?></td>
			<td style="text-align:center;"><?php echo $member['mobile'];?></td>
			<td style="text-align:center;"><?php echo $member['idcard'];?></td>
			<td style="text-align:center;"><?php echo $member['real_name'];?></td>
			<td style="text-align:center;"><?php echo to_date($member['reg_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($member['update_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($member['last_login_time']);?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=member&op=edit&id=<?php echo $member['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('users', <?php echo $member['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

