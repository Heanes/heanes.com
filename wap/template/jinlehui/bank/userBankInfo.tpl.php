<?php
/**
 * @doc 用户银行卡详情页
 * @filesource userBankInfo.tpl.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015-07-11 17:22:06
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-detail-block">
		<table class="data-detail-table">
			<tbody>
			<tr>
				<th>姓名:</th>
				<td>
					<span><?php echo $output['userBank']['real_name']; ?></span>
				</td>
			</tr>
			<tr>
				<th>银行：</th>
				<td><?php echo $output['userBank']['bank_name']; ?></td>
			</tr>
			<tr>
				<th>银行卡号：</th>
				<td><?php echo $output['userBank']['bank_no']; ?></td>
			</tr>
			<tr>
				<th>添加时间：</th>
				<td><?php echo to_date($output['userBank']['create_time']); ?></td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="upload-field" style="width:220px;text-align:center;margin:0 auto;">
						<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
							<span class="upload-button-text">银行卡正面照片</span>
						</div>
						<a href="<?php echo PATH_BASE_FILE_UPLOAD; ?><?php echo $output['userBank']['front_pic_src'] ?>" class="img-gallery">
							<img class="upload-img-preview" alt="" src="<?php echo PATH_BASE_FILE_UPLOAD; ?><?php echo $output['userBank']['front_pic_src'] ?>" style="width:100%;">
						</a>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
		<div class="data-detail-handle">
			<div class="handle-left">
				<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
			</div>
			<div class="handle-right">
				<a href="<?php echo BASE_URL; ?>index.php?act=userBank&op=edit&id=<?php echo $output['userBank']['id']; ?>" class="button-normal button-edit">修改</a>
			</div>
		</div>
	</div>
</div>


