<?php
/**
 * @doc 用户银行卡修改页
 * @filesource userBankInfo.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-11 17:22:06
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-edit-block">
		<!-- 1.2银行卡信息 -->
		<div class="add-user-data">
			<div class="page-nav-tab">
				<ul>
					<li class="active"><a href="javascript:">银行卡信息修改</a></li>
				</ul>
			</div>
			<?php foreach ($output['userBank'] as $key => $result) { ?>
			<form action="<?php echo BASE_URL; ?>index.php?act=userBank&op=edit_update" method="post" enctype="multipart/form-data">
				<table class="data-edit-table" rel="add_user_bank">
					<input type="hidden" name="id" value="<?php echo $result['id']; ?>" />
					<tbody>
					<tr>
						<th>持卡人：<i class="border-one"></i></th>
						<td>
							<input type="text" name="real_name" class="input-data input-border-none" placeholder="请填写真实姓名" value="<?php echo $result['real_name']; ?>" />
						</td>
					</tr>
					<tr>
						<th>银行卡号：<i class="border-one"></i></th>
						<td>
							<input type="text" name="bank_no" class="input-data input-border-none" placeholder="银行卡号" value="<?php echo $result['bank_no']; ?>" />
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th>银行：<i class="border-one"></i></th>
						<td class="td-input-select">
							<select name="bank_id" class="select-normal">
								<option value="0">请选择</option>
								<?php foreach ($output['bankList'] as $key => $bank) { ?>
									<option value="<?php echo $bank['id']; ?>"><?php echo $bank['name']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="upload-field" style="width:220px;text-align:center;margin:0 auto;">
								<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
									<span class="upload-button-text">点我上传银行卡正面</span>
									<input type="file" name="front_pic_src" class="upload-file-filed">
								</div>
								<img class="upload-img-preview img-gallery" alt="" src="<?php echo PATH_BASE_FILE_UPLOAD; ?><?php echo $result['front_pic_src'] ?>" href="<?php echo PATH_BASE_FILE_UPLOAD; ?><?php echo $result['front_pic_src'] ?>" style="width:100%;">
							</div>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="data-detail-handle">
					<div class="handle-left">
						<input type="reset" class="data-reset-button" value="清空" />
					</div>
					<div class="handle-right">
						<input type="submit" class="data-submit-button sub" value="保存" name="bank_edit_form_submit" />
					</div>
				</div>
			</form>
		</div>

	</div>


