<?php
/**
 * @doc 贷款详情展示页
 * @filesource show.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 00:28:31
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-detail-block">
		<!-- 3.贷款进度 -->
		<table class="data-detail-table order-progress-list">
			<thead>
			<tr class="lap">
				<td colspan="3" class="lap-header">
					<span class="lap-title">申请记录</span>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo to_date($output['employee']['create_time']); ?></td>
				<td><i class="order-finish"></i></td>
				<td>开始申请</td>
			</tr>
			<!-- 申请记录 -->
			<?php foreach ($output['employeeApplyLog'] as $key => $employeeApply) { ?>
				<tr>
					<td><?php echo to_date($employeeApply['create_time']); ?></td>
					<td><i class="order-finish"></i></td>
					<td>
						<?php if ($borrowApply['status'] == 1) { ?>完成资料审核<?php } ?>
						<?php if ($borrowApply['status'] == -1) { ?>申请被拒绝<?php } ?>
						<?php if ($borrowApply['status'] == 0) { ?>申请重设为未审核状态<?php } ?>
					</td>
				</tr>
			<?php } ?>
			<!-- 3.2贷款操作进度 -->
			<?php if (!count($output['employeeApplyLog'])) { ?>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>等待审核</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="data-detail-handle">
		<a href="javascript:history.go(-2);" class="button-normal button-show">返回</a>
	</div>
</div>