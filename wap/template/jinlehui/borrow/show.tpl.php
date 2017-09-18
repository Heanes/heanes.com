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
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=borrow">贷款列表</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=borrow&op=show&id=<?php echo $_GET['id'] ?>">贷款详情</a></li>
		</ul>
	</div>
	<div class="data-detail-block">
		<!-- 用户信息 -->
		<table class="data-detail-table">
			<thead>
			<tr class="lap">
				<td colspan="2" class="lap-header">
					<span class="lap-title">客户信息</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>姓名：</th>
				<td><span><?php echo $output['userInfo']['real_name']; ?></span></td>
			</tr>
			<tr>
				<th>性别：</th>
				<td>
					<?php if (!isset($output['userInfo']['gender']) || empty($output['userInfo']['gender'])) { ?>未知<?php } elseif ($output['userInfo']['gender'] == 1) { ?>男<?php } elseif ($output['userInfo']['gender'] == 0) { ?>女<?php } ?>
				</td>
			</tr>
			<tr>
				<th>联系电话：</th>
				<td><?php if(isset($output['userInfo']['mobile']) && !empty($output['userInfo']['mobile'])){echo $output['userInfo']['mobile'];}else{ ?>（未填写）<?php }?></td>
			</tr>
			<tr>
				<th>身份证号：</th>
				<td><?php if(isset($output['userInfo']['idcard']) && !empty($output['userInfo']['idcard'])){echo $output['userInfo']['idcard'];}else{ ?>（未填写）<?php }?></td>
			</tr>
			</tbody>
		</table>
		<!-- 贷款详情 -->
		<table class="data-detail-table">
			<thead>
			<tr class="lap">
				<td colspan="2" class="lap-header">
					<span class="lap-title">贷款详情</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>贷款用途：</th>
				<td><span><?php echo $output['borrow']['_product']['name']; ?></span></td>
			</tr>
			<tr>
				<th>贷款额度：</th>
				<td><?php echo $output['borrow']['total']; ?>万</td>
			</tr>
			<tr>
				<th>贷款年限：</th>
				<td><?php echo $output['borrow']['year_limit']; ?>年</td>
			</tr>
			<!--
			<tr>
				<th>利息：</th>
				<td><?php echo $output['borrow']['rate']; ?>%</td>
			</tr>
			-->
			</tbody>
		</table>
		<!-- 3.贷款进度 -->
		<table class="data-detail-table order-progress-list">
			<thead>
			<tr class="lap">
				<td colspan="3" class="lap-header">
					<span class="lap-title">贷款进度</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td class="borrow-log-time"><?php echo to_date($output['borrow']['apply_time']); ?></td>
				<td><i class="order-finish"></i></td>
				<td>申请贷款</td>
			</tr>
			<!-- 3.1贷款申请进度 -->
			<?php foreach ($output['borrowApplyLog'] as $key => $borrowApply) { ?>
				<tr>
					<td class="borrow-log-time"><?php echo to_date($borrowApply['create_time']); ?></td>
					<td><i class="order-finish"></i></td>
					<td>
						<?php if ($borrowApply['status'] == 1) { ?>完成资料审核<?php } ?>
						<?php if ($borrowApply['status'] == -1) { ?>申请被拒绝<?php } ?>
						<?php if ($borrowApply['status'] == 0) { ?>申请重设为未审核状态<?php } ?>
					</td>
				</tr>
			<?php } ?>
			<!-- 3.2贷款操作进度 -->
			<?php if (!count($output['borrowProgressLog'])) { ?>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>下户</td>
				</tr>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>评级</td>
				</tr>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>做卷</td>
				</tr>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>银行审核资料</td>
				</tr>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>批贷函</td>
				</tr>
				<tr>
					<td>未完成</td>
					<td><i class="order-unfinished"></i></td>
					<td>贷后管理（开始放款）</td>
				</tr>
			<?php } ?>
			<?php foreach ($output['borrowProgressLog'] as $key => $borrowProgress) { ?>
				<?php if ($borrowProgress['status'] == 1) { ?>
					<tr>
						<td class="borrow-log-time"><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>下户</td>
					</tr>
				<?php } elseif ($borrowProgress['status'] == 2) { ?>
					<tr>
						<td><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>评级</td>
					</tr>
				<?php } elseif ($borrowProgress['status'] == 3) { ?>
					<tr>
						<td><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>做卷</td>
					</tr>
				<?php } elseif ($borrowProgress['status'] == 4) { ?>
					<tr>
						<td><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>资料审核</td>
					</tr>
				<?php } elseif ($borrowProgress['status'] == 5) { ?>
					<tr>
						<td><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>批贷函</td>
					</tr>
				<?php } elseif ($borrowProgress['status'] == 6) { ?>
					<tr>
						<td><?php echo to_date($borrowProgress['create_time']); ?></td>
						<td><i class="order-finish"></i></td>
						<td>贷后管理（开始放款）</td>
					</tr>
				<?php } ?>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<!--
	<div class="data-detail-handle">
		<div class="handle-left">
			<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
		</div>
		<div class="handle-right">
			<a href="<?php echo BASE_URL ?>index.php?act=borrow&op=edit" class="button-normal button-edit">修改</a>
		</div>
	</div>
	-->
</div>