<?php
/**
 * @doc 用户银行卡列表页
 * @filesource userBankList.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-11 17:22:18
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=userBank">银行卡列表</a></li>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=userBank&op=add">添加银行卡</a></li>
		</ul>
	</div>
	<div class="data-block-list">
		<?php if (!count($output['userBankList'])) { ?>
			<div class="result-block">
				<div class="no-result">暂无数据</div>
			</div>
		<?php } else {
			foreach ($output['userBankList'] as $key => $bank) { ?>
				<table onclick="window.location='<?php echo BASE_URL; ?>index.php?act=userBank&op=show&id=<?php echo $bank['id'];?>'" style="cursor:pointer;" class="data-block-table">
					<thead>
					<tr>
						<th>添加时间：</th>
						<td colspan="2"><?php echo to_date($bank['create_time']); ?></td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>银行：</th>
						<td style="width:100%;"><?php echo $bank['bank_name']; ?></td>
						<td rowspan="3">
							<span class="data-block-td-arrow">
								<i class="arrow-r"></i>
							</span>
						</td>
					</tr>
					<tr>
						<th>银行卡号：</th>
						<td style="width:100%;"><?php echo $bank['bank_no']; ?></td>
					</tr>
					<!--
					<tr class="tr-oneline-two-td">
						<th>开户行地点：</th>
						<td><?php echo $bank['account_bank_address']; ?></td>
					</tr>
					-->
					</tbody>
					<tfoot>
					<tr>
						<td colspan="3">
							<a href="<?php echo BASE_URL; ?>index.php?act=userBank&id=<?php echo $bank['id'];?>"><button class="button-normal button-show">查看</button></a>
						</td>
					</tr>
					</tfoot>
				</table>
			<?php }
		} ?>
	</div>
</div>

