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
		<a href="<?php echo BASE_URL;?>index.php?act=bank&op=add" class="btn btn-primary btn-large">添加银行</a>
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
				<a href="javascript:sortBy('name', 'DESC');" title="点击对列表排序">银行名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('code', 'DESC');" title="点击对列表排序">银行代码<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('img_url', 'DESC');" title="点击对列表排序">银行logo地址<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('a_href', 'DESC');" title="点击对列表排序">银行链接地址<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('create_time', 'DESC');" title="点击对列表排序">上传时间<em class="triangle-up"></em></a>
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
		<?php if(empty($output['bank_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['bank_list'] as $key=>$bank) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $bank['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=bank&op=edit&id=<?php echo $bank['id'];?>"><?php echo $bank['name'];?></a></td>
			<td style="text-align:center;"><?php echo $bank['code'];?></td>
			<td style="text-align:center;"><?php echo $bank['img_url'];?></td>
			<td style="text-align:center;"><a href="<?php echo $bank['a_href'];?>"><?php echo $bank['a_href'];?></a></td>
			<td style="text-align:center;"><?php echo to_date($bank['create_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($bank['update_time']);?></td>
			<td style="text-align:center;"><?php echo $bank['is_enable']==1?'是':'否';?></td>
			<td style="text-align:center;"><?php echo $bank['is_delete']==1?'是':'否';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=bank&op=edit&id=<?php echo $bank['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('bank', <?php echo $bank['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
