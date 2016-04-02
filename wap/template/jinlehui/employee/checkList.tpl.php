<?php
/**
 * @doc 员工信息审核列表页面
 * @filesource check.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 13:41:12
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li <?php if(!isset($_REQUEST['apply_status'])){?>class="active" <?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=employee&op=checkList">全部</a></li>
			<li <?php if(isset($_REQUEST['apply_status']) && $_REQUEST['apply_status']==0){?>class="active" <?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=employee&op=checkList&apply_status=0">待审核</a></li>
			<li <?php if(isset($_REQUEST['apply_status']) && $_REQUEST['apply_status']==1){?>class="active" <?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=employee&op=checkList&apply_status=1">已通过</a></li>
			<li <?php if(isset($_REQUEST['apply_status']) && $_REQUEST['apply_status']==-1){?>class="active" <?php }?>><a href="<?php echo BASE_URL; ?>index.php?act=employee&op=checkList&apply_status=-1">已拒绝</a></li>
		</ul>
	</div>
	<div class="data-block-list">
		<?php if(count($output['employeeApplyList'])){?>
			<?php foreach ($output['employeeApplyList'] as $key => $employeeApply) { ?>
				<table onclick="window.location='<?php echo BASE_URL;?>index.php?act=employee&op=<?php if($employeeApply['apply_status']==0){?>check<?php }else{?>show<?php }?>&id=<?php echo $employeeApply['id'];?>'" style="cursor:pointer;" class="data-block-table">
					<thead>
					<tr>
						<th>申请时间：</th>
						<td colspan="2"><?php echo to_date($employeeApply['insert_time']); ?></td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>姓名：</th>
						<td style="width:100%;"><?php echo $employeeApply['user']['real_name'];?></td>
						<td rowspan="2">
						<span class="data-block-td-arrow">
							<i class="arrow-r"></i>
						</span>
						</td>
					</tr>
					<tr>
						<th>申请职位：</th>
						<td><?php echo $employeeApply['job_name'];?></td>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<td colspan="5">
							<?php if($employeeApply['apply_status']==0){?>
							<a href="<?php echo BASE_URL; ?>index.php?act=employee&op=check&id=<?php echo $employeeApply['id'];?>"><button class="button-normal turn-to-check">去审核</button></a>
							<?php }else{?>
							<a href="<?php echo BASE_URL; ?>index.php?act=employee&op=show&id=<?php echo $employeeApply['id'];?>"><button class="button-normal button-show">查看</button></a>
							<?php } ?>
						</td>
					</tr>
					</tfoot>
				</table>
			<?php } ?>
		<?php }else{?>
			<div class="result-block">
				<div class="no-result">暂无数据</div>
			</div>
		<?php } ?>
		<!-- S 分页 S -->
		<?php include(TPL.'pager/pagerDefaultStyle.tpl.php'); ?>
		<!-- E 分页 E -->
	</div>
</div>

