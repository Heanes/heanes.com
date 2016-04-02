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
		<a href="<?php echo BASE_URL;?>index.php?act=Goods&op=add" class="btn btn-primary btn-large">添加商品基本信息</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15">商品属性名称列表</td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('name', 'DESC');" title="点击对列表排序">商品名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('category_id', 'DESC');" title="点击对列表排序">商品分类ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('type_id', 'DESC');" title="点击对列表排序">类型ID<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('shop_price', 'DESC');" title="点击对列表排序">店铺价格<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('market_price', 'DESC');" title="点击对列表排序">市面价格<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('store_num', 'DESC');" title="点击对列表排序">库存数目<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('total_sold_num', 'DESC');" title="点击对列表排序">已卖出总个数<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_role_id', 'DESC');" title="点击对列表排序">查看用户角色<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_rank', 'DESC');" title="点击对列表排序">查看用户积分<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('insert_time', 'DESC');" title="点击对列表排序">添加时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_enable', 'DESC');" title="点击对列表排序">是否启用<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['goods_list'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['goods_list'] as $key=>$goods) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $goods['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=Goods&op=edit&id=<?php echo $goods['id'];?>"><?php echo $goods['name'];?></a></td>
			<td style="text-align:center;"><?php echo $goods['category_name'];?></td>
			<td style="text-align:center;"><?php echo $goods['type_name'];?></td>
			<td style="text-align:center;"><?php echo $goods['shop_price'];?></td>
			<td style="text-align:center;"><?php echo $goods['market_price'];?></td>
			<td style="text-align:center;"><?php echo $goods['store_num'];?></td>
			<td style="text-align:center;"><?php echo $goods['total_sold_num'];?></td>
			<td style="text-align:center;"><?php echo $goods['user_role_name'];?></td>
			<td style="text-align:center;"><?php echo $goods['user_rank'];?></td>
			<td style="text-align:center;"><?php echo to_date($goods['insert_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($goods['update_time']);?></td>
			<td style="text-align:center;"><?php echo $goods['is_enable']==1?'显示':'不显示';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=Goods&op=edit&id=<?php echo $goods['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('goods', <?php echo $goods['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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

