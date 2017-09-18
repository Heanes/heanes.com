<?php
/**
 * @doc 友情链接分类列表
 * @filesource list.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.01 001
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="data-list-href">
	<div class="handle-field">
		<a href="<?php echo BASE_URL;?>index.php?act=friendlinkCategory&op=add" class="btn btn-primary btn-large">添加申请列表</a>
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
				<a href="javascript:sortBy('name', 'DESC');" title="点击对列表排序">分类名称<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('img_src', 'DESC');" title="点击对列表排序">分类图标地址<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('img_title', 'DESC');" title="点击对列表排序">分类图片title<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('a_href', 'DESC');" title="点击对列表排序">分类外链<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('a_title', 'DESC');" title="点击对列表排序">分类外链title<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('create_time', 'DESC');" title="点击对列表排序">分类添加时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('update_time', 'DESC');" title="点击对列表排序">分类最后更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:sortBy('is_enable', 'DESC');" title="点击对列表排序">是否启用<em class="triangle-down"></em></a>
			</th>
			
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['friendlinkCategoryList'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['friendlinkCategoryList'] as $key=>$friendlinkCategory) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=friendlinkCategory&op=edit&id=<?php echo $friendlinkCategory['id'];?>"><?php echo $friendlinkCategory['name'];?></a></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['img_src'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['img_title'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['a_href'];?></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['a_title'];?></td>
			<td style="text-align:center;"><?php echo to_date($friendlinkCategory['create_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($friendlinkCategory['update_time']);?></td>
			<td style="text-align:center;"><?php echo $friendlinkCategory['is_enable']==1?'显示':'不显示';?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=friendlinkCategory&op=edit&id=<?php echo $friendlinkCategory['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('friend_link_category', <?php echo $friendlinkCategory['id'];?>);" class="btn btn-mini btn-danger">删除</a>
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
