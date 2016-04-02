<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<div class="data-detail-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=borrow&op=updateCheck&id=<?php echo $output['borrow']['id'];?>" method="post">
			<!-- 贷款信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
						<span class="lap-title">贷款信息</span>
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
					<th>借款额度：</th>
					<td><span><?php echo $output['borrow']['total']; ?></span>万</td>
				</tr>
				<tr>
					<th>借款年限：</th>
					<td><?php echo $output['borrow']['year_limit']; ?>年</td>
				</tr>
				<tr>
					<th>利息：</th>
					<td><?php echo $output['borrow']['rate']; ?>%</td>
				</tr>
				<tr>
					<th>申请时间：</th>
					<td><?php echo to_date($output['borrow']['apply_time']); ?></td>
				</tr>
				<tr style="border:none;">
					<th colspan="2">借款用途备注</th>
				</tr>
				<tr>
					<th colspan="2"><span style="font-size:14px;"><?php echo $output['borrow']['usage_info']; ?></span></th>
				</tr>
				</tbody>
			</table>
			<!-- 业务员信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
						<span class="lap-title">业务员信息</span>
						<i class="td-inline-lap triangle-up"></i>
						<i class="td-inline-lap td-inline-lap-bottom"></i>
					</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<th>姓名：</th>
					<td><span><?php echo $output['borrow']['user_master']['user_name']; ?></span></td>
				</tr>
				<tr>
					<th>性别：</th>
					<td>
						<?php if (!isset($output['borrow']['user_master']['gender']) || empty($output['customer']['user_master']['gender'])) { ?>未知<?php } elseif ($output['customer']['user_master']['gender'] == 1) { ?>男<?php } elseif ($output['customer']['user_master']['gender'] == 0) { ?>女<?php } ?>
					</td>
				</tr>
				<tr>
					<th>联系电话：</th>
					<td><?php echo $output['borrow']['user_master']['mobile']; ?></td>
				</tr>
				<tr>
					<th>部门</th>
					<td><?php echo $output['borrow']['user_master']['department']['name']; ?></td>
				</tr>
				</tbody>
			</table>
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
					<td><span><?php echo $output['borrow']['user_slave']['user_name']; ?></span></td>
				</tr>
				<tr>
					<th>性别：</th>
					<td>
						<span><?php if ($output['borrow']['user_slave']['gender'] == 0) { ?>女<?php } elseif ($output['borrow']['user_slave']['gender'] == 1) { ?>男<?php } else { ?>保密<?php } ?></span>
					</td>
				</tr>
				<tr>
					<th>身份证号：</th>
					<td><?php echo $output['borrow']['user_slave']['idcard']; ?></td>
				</tr>
				</tbody>
			</table>
			<!-- 用户认证信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
						<span class="lap-title">用户认证信息</span>
						<i class="td-inline-lap triangle-up"></i>
						<i class="td-inline-lap td-inline-lap-bottom"></i>
					</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<?php foreach ($output['certificationTypeList'] as $key => $certificationType) { ?>
							<table class="data-detail-table folded" style="margin:0">
								<thead>
								<tr class="lap">
									<td colspan="2" class="lap-header">
										<span class="lap-title"><?php echo $certificationType['name']; ?>(<?php echo count($output['userCertificationList'][$key])>0 ? count($output['userCertificationList'][$key]):'无'; ?>)</span>
										<i class="td-inline-lap triangle-down"></i>
										<i class="td-inline-lap td-inline-lap-bottom"></i>
									</td>
								</tr>
								</thead>
								<tbody>
								<?php if (count($output['userCertificationList'][$key])) {
									foreach ($output['userCertificationList'][$key] as $userCertificationKey => $userCertification) { ?>
										<tr>
											<td>
												<table class="data-detail-table folded" style="margin:0">
													<thead>
													<tr class="lap">
														<td colspan="2" style="position:relative;text-align:left;padding:0">
															<span class="lap-title"><?php echo $certificationType['name']; ?></span>
															<div class="lap" style="position:absolute;display:inline-block;bottom:18px;margin-left:16px;">
																<i class="td-inline-lap triangle-down"></i>
																<i class="td-inline-lap td-inline-lap-bottom"></i>
															</div>
														</td>
													</tr>
													</thead>
													<tbody>
													<?php foreach ($userCertification['_fields'] as $fieldsKey => $fields) { ?>
														<?php if ($fields['input_type'] == 'file-image') { ?>
															<tr>
																<th colspan="2"><?php echo $fields['name']; ?></th>
															</tr>
															<tr>
																<td colspan="2" style="text-align:center;">
																	<a href="<?php echo isset($userCertification['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userCertification['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>" class="img-gallery">
																		<img class="upload-img-preview"
																			 alt="<?php echo isset($userCertification['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userCertification['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>"
																			 src="<?php echo isset($userCertification['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userCertification['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>">
																	</a>
																</td>
															</tr>
														<?php } else { ?>
															<tr>
																<th><?php echo $fields['name']; ?></th>
																<td><?php echo isset($userCertification['_fields_value'][$fieldsKey]) ? $userCertification['_fields_value'][$fieldsKey]['fields_value'] : ''; ?></td>
															</tr>
														<?php } ?>
													<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<th>无</th>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</td>
				</tr>
				</tbody>
			</table>
			<!-- 用户资产信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
						<span class="lap-title">用户资产信息</span>
						<i class="td-inline-lap triangle-up"></i>
						<i class="td-inline-lap td-inline-lap-bottom"></i>
					</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<?php foreach ($output['propertyList'] as $key => $property) { ?>
							<table class="data-detail-table folded" style="margin:0">
								<thead>
								<tr class="lap">
									<td colspan="2" class="lap-header">
										<span class="lap-title"><?php echo $property['name']; ?>(<?php echo count($output['userPropertyList'][$key])>0 ? count($output['userPropertyList'][$key]):'无'; ?>)</span>
										<i class="td-inline-lap triangle-down"></i>
										<i class="td-inline-lap td-inline-lap-bottom"></i>
									</td>
								</tr>
								</thead>
								<tbody>
								<?php if (count($output['userPropertyList'][$key])) {
									foreach ($output['userPropertyList'][$key] as $userPropertyKey => $userProperty) { ?>
										<tr>
											<td>
												<table class="data-detail-table folded" style="margin:0">
													<thead>
													<tr class="lap">
														<td colspan="2" style="position:relative;text-align:left;padding:0">
															<span class="lap-title"><?php echo $property['name']; ?></span>
															<div class="lap" style="position:absolute;display:inline-block;bottom:18px;margin-left:16px;">
																<i class="td-inline-lap triangle-down"></i>
																<i class="td-inline-lap td-inline-lap-bottom"></i>
															</div>
														</td>
													</tr>
													</thead>
													<tbody>
													<?php foreach ($userProperty['_fields'] as $fieldsKey => $fields) { ?>
														<?php if ($fields['input_type'] == 'file-image') { ?>
															<tr>
																<th colspan="2"><?php echo $fields['name']; ?></th>
															</tr>
															<tr>
																<td colspan="2" style="text-align:center;">
																	<a href="<?php echo isset($userProperty['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userProperty['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>" class="img-gallery">
																		<img class="upload-img-preview"
																			 alt="<?php echo isset($userProperty['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userProperty['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>"
																			 src="<?php echo isset($userProperty['_fields_value'][$fieldsKey]['fields_value']) ? PATH_BASE_FILE_UPLOAD.$userProperty['_fields_value'][$fieldsKey]['fields_value'] : PATH_BASE_PUBLIC.'static/image/common/image_not_found.png'; ?>">
																	</a>
																</td>
															</tr>
														<?php } else { ?>
															<tr>
																<th><?php echo $fields['name']; ?></th>
																<td><?php echo isset($userProperty['_fields_value'][$fieldsKey]) ? $userProperty['_fields_value'][$fieldsKey]['fields_value'] : ''; ?></td>
															</tr>
														<?php } ?>
													<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<th>无</th>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</td>
				</tr>
				</tbody>
			</table>
			<!-- 审核操作 -->
			<div class="order-check-handle" style="margin-bottom:20px;">
				<span><input type="radio" name="check_status" value="1" />通过</span>
				<span><input type="radio" name="check_status" value="-1" />拒绝</span>
			</div>
			<script type="text/javascript">
				$('input[name="check_status"]').on("click", function () {
					if ($(this).is(':checked')) {
						$('#operate_reason').show();
					} else {
						$('#operate_reason').hide();
					}
				});
			</script>
			<div class="data-edit-block" id="operate_reason" style="display:none;">
				<div class="data-edit-title">
					<p>请填写操作备注：</p>
				</div>
				<div class="data-edit-field">
					<textarea name="reason" class="data-textarea"></textarea>
				</div>
			</div>
			<div class="data-detail-handle">
				<div class="handle-left">
					<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
				</div>
				<div class="handle-right">
					<input type="submit" class="data-submit-button button-normal" value="提交" />
				</div>
			</div>
			<!-- 审核操作 -->
		</form>
	</div>
</div>
