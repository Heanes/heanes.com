<?php
/**
 * @doc 默认分页样式模版
 * @filesource pagerDefaultStyle.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-25 17:26:09
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<?php if(isset($output['pager'])  && $output['pager']['total_page']>1){?>
<div class="news-list-page">
	<span class="pager">
		<!-- 上一页、首页导航 -->
		<?php if($output['pager']['now_page']>0 && $output['pager']['now_page']!=1){?>
		<a href="<?php echo $output['pager']['page_url'].$output['pager']['pre_page'];?>" class="turn-page pre-page-button">上一页</a>
		<a href="<?php echo $output['pager']['page_url'].'1';?>" <?php if($output['pager']['now_page']==1){?>class="pager-current"<?php }?>>1</a>
		<?php } ?>
		<!--  页码导航 -->
		<?php if($output['pager']['now_page']>=1 && $output['pager']['now_page']<=$output['pager']['total_page']){?>
			<?php if($output['pager']['now_page']>4){ ?>
		<em>...</em>
			<?php } ?>
			<?php if($output['pager']['now_page']==4){ ?>
		<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']-2);?>"><?php echo $output['pager']['now_page']-2;?></a>
			<?php } ?>
			<?php if($output['pager']['now_page']-1>1){ ?>
		<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']-1);?>"><?php echo $output['pager']['now_page']-1;?></a>
			<?php } ?>
		<a href="javascript:" class="pager-current"><?php echo $output['pager']['now_page'];?></a>
			<?php if($output['pager']['now_page']+1<$output['pager']['total_page']){ ?>
		<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']+1);?>"><?php echo $output['pager']['now_page']+1;?></a>
			<?php } ?>
			<?php if($output['pager']['now_page']+3==$output['pager']['total_page']){ ?>
		<a href="<?php echo $output['pager']['page_url'].($output['pager']['now_page']+2);?>"><?php echo $output['pager']['now_page']+2;?></a>
			<?php } ?>
			<?php if($output['pager']['now_page']+3<$output['pager']['total_page']){ ?>
		<em>...</em>
			<?php } ?>
		<?php }?>
		<!-- 下一页、末页导航 -->
		<?php if($output['pager']['now_page']>=1 && $output['pager']['now_page']<$output['pager']['total_page']){?>
		<a href="<?php echo $output['pager']['page_url'].$output['pager']['total_page'];?>" <?php if($output['pager']['now_page']==$output['pager']['total_page']){?>class="pager-current"<?php }?>><?php echo $output['pager']['total_page'];?></a>
		<a href="<?php echo $output['pager']['page_url'].$output['pager']['next_page'];?>" class="turn-page next-page-button">下一页</a>
		<?php }?>
	</span>
</div>
<?php }?>