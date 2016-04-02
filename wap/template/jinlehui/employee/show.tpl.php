<?php
/**
 * @doc 职位审核页面
 * @filesource check.tpl.php
 * @author Heanes
 * @time 2015-07-07 13:41:12
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-detail-block">
		<!-- 用户信息 -->
		<table class="data-detail-table">
			<thead>
			<tr class="lap">
				<td colspan="2" style="position:relative;">
					<span class="lap-title">用户信息</span>
					<i class="td-inline-lap  triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>姓名：</th>
				<td>
					<?php echo $output['userInfo']['user_name']; ?>
				</td>
			</tr>
			<tr>
				<th>性别：</th>
				<td>
					<?php if(!isset($output['userInfo']['gender']) || empty($output['userInfo']['gender'])){?>未知<?php }
					elseif ($output['userInfo']['gender'] == 1) { ?>男<?php }
					elseif ($output['userInfo']['gender'] == 0) { ?>女<?php } ?>
				</td>
			</tr>
			<tr>
				<th>年龄：</th>
				<td><?php echo $output['userInfo']['age']; ?></td>
			</tr>
			<tr>
				<th>联系电话：</th>
				<td><?php echo $output['userInfo']['mobile']; ?></td>
			</tr>
			<tr>
				<th>身份证号：</th>
				<td><?php echo $output['userInfo']['idcard']; ?></td>
			</tr>
			<tr>
				<th>银行卡号：</th>
				<!-- 做成多个银行卡 -->
				<td><?php echo $output['userInfo']['bank_no']; ?></td>
			</tr>
			</tbody>
		</table>
		<!-- 申请职位信息 -->
		<table class="data-detail-table">
			<thead>
			<tr class="lap">
				<td colspan="2" style="position:relative;">
					<span class="lap-title">职位信息</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>入职时间</th>
				<td>
					<span><?php echo to_date($output['employee']['insert_time']); ?></span>
				</td>
			</tr>
			<tr>
				<th>职位名称</th>
				<td>
					<span><?php echo $output['jobInfo']['name']; ?></span>
				</td>
			</tr>
			<tr>
				<th>职位代码</th>
				<td>
					<span><?php echo $output['jobInfo']['code']; ?></span>
				</td>
			</tr>
			<tr>
				<th>职位介绍</th>
				<td>
					<span><?php echo $output['jobInfo']['description']; ?></span>
				</td>
			</tr>
			</tbody>
		</table>
		<!-- 分配部门 -->
		<table class="data-detail-table" id="choose_departmentInfo">
			<thead>
			<tr class="lap">
				<td colspan="2" style="position:relative;">
					<span class="lap-title">分配部门</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th style="width:25%">部门信息：</th>
				<td style="text-align:left;">
					<table class="data-detail-table folded" style="margin:0">
						<thead>
						<tr class="lap">
							<td colspan="2" style="position:relative;text-align:left;padding:0">
								<span class="lap-title" style="margin:0;"><?php echo $output['departmentInfo']['name']; ?></span>

								<div class="lap" style="position:absolute;display:inline-block;bottom:18px;margin-left:16px;">
									<i class="td-inline-lap triangle-down"></i>
									<i class="td-inline-lap td-inline-lap-bottom"></i>
								</div>
							</td>
						</tr>
						</thead>
						<tbody>
						<tr>
							<th>部门经理：</th>
							<td>
								<span><?php echo $output['departmentInfo']['manager']; ?></span>
							</td>
						</tr>
						<tr>
							<th colspan="2">部门介绍：</th>
						</tr>
						<tr>
							<td colspan="2" style="font-size:12px;text-align:left;">
								<?php echo $output['departmentInfo']['description']; ?>
							</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="data-detail-handle">
		<div class="handle-left">
			<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
		</div>
		<div class="handle-right">
			<a href="<?php echo BASE_URL; ?>index.php?act=employee&op=edit&id=<?php echo $output['employee']['id'];?>" class="button-normal button-edit">修改</a>
		</div>
	</div>
</div>
