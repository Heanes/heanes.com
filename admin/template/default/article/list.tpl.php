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
		<a href="<?php echo BASE_URL; ?>index.php?act=article&op=add" class="btn btn-primary btn-large">添加文章</a>
	</div>
</div>
<!-- 数据列表 S -->
<div class="data-list-table">
	<table class="table table-striped table-bordered table-condensed table-data-list">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		<tr>
			<th style="min-width: 24px;">选择</th>
			<th style="min-width: 40px;">
				<a href="javascript:listTable.sort('id', 'DESC');" title="点击对列表排序">编号<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('title', 'DESC');" title="点击对列表排序">文章标题<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('user_id', 'DESC');" title="点击对列表排序">作者<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('category_id', 'DESC');" title="点击对列表排序">分类<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('is_enable', 'DESC');" title="点击对列表排序">是否显示<em class="triangle-down"></em></a>
			</th>
			<th style="width: auto;">
				<a href="javascript:listTable.sort('is_great', 'DESC');" title="点击对列表排序">是否精品<em class="triangle-up"></em></a>
			</th>
			<th style="width: auto;">
				<a href="javascript:listTable.sort('is_new', 'DESC');" title="点击对列表排序">是否为新发布文章<em class="triangle-down"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('insert_time', 'DESC');" title="点击对列表排序">添加时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('update_time', 'DESC');" title="点击对列表排序">更新时间<em class="triangle-up"></em></a>
			</th>
			<th>
				<a href="javascript:listTable.sort('click_count', 'DESC');" title="点击对列表排序">点击数<em class="triangle-up"></em></a>
			</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($output['articleList'])){ ?>
		<tr><td>暂无内容</td></tr>
		<?php } ?>
		<?php foreach ($output['articleList'] as $key=>$article) { ?>
		<tr>
			<td style="text-align:center;"><input name="check" type="checkbox"></td>
			<td style="text-align:center;"><?php echo $article['id'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=article&op=edit&id=<?php echo $article['id'];?>"><?php echo $article['title'];?></a></td>
			<td style="text-align:center;"><?php echo $article['user_name'];?></td>
			<td style="text-align:center;"><a href="<?php echo BASE_URL;?>index.php?act=articleCategory&op=edit&id=<?php echo $article['category_id'];?>"><?php echo $article['category_name'];?></a></td>
			<td style="text-align:center;"><?php echo $article['is_enable']==1?'显示':'不显示';?></td>
			<td style="text-align:center;"><b class="<?php if($article['is_great']==1){?>check-on<?php }else{?>check-off<?php }?>"></b></td>
			<td style="text-align:center;"><b class="<?php if($article['is_new']==1){?>check-on<?php }else{?>check-off<?php }?>"></b></td>
			<td style="text-align:center;"><?php echo to_date($article['insert_time']);?></td>
			<td style="text-align:center;"><?php echo to_date($article['update_time']);?></td>
			<td style="text-align:center;"><?php echo $article['click_count'];?></td>
			<td style="text-align:center;">
				<a href="<?php echo BASE_URL;?>index.php?act=article&op=edit&id=<?php echo $article['id'];?>" class="btn btn-mini">编辑</a>
				<a href="javascript:del('article', <?php echo $article['id'];?>);" class="btn btn-mini btn-danger del">删除</a>
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