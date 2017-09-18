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
		<form action="<?php echo BASE_URL;?>index.php?act=employee&op=updateCheck&id=<?php echo to_date($output['employeeApplyInfo']['id']);?>" method="post">
			<!-- 用户信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
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
						<span><?php echo $output['userInfo']['user_name'];?></span>
					</td>
				</tr>
				<tr>
					<th>性别：</th>
					<td>
						<span><?php if($output['userInfo']['gender']==1){?>男<?php }?>
							<?php if($output['userInfo']['gender']==0){?>女<?php }?>
							<?php if($output['userInfo']['gender']!=1 && $output['userInfo']['gender']!=0){?>未知<?php }?>
						</span>
					</td>
				</tr>
				<tr>
					<th>年龄：</th>
					<td><?php echo $output['userInfo']['age'];?></td>
				</tr>
				<tr>
					<th>联系电话：</th>
					<td><?php echo $output['userInfo']['mobile'];?></td>
				</tr>
				<tr>
					<th>身份证号：</th>
					<td><?php echo $output['userInfo']['idcard'];?></td>
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
										<span class="lap-title"><?php echo $certificationType['name']; ?></span>
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
			<!-- 申请职位信息 -->
			<table class="data-detail-table">
				<thead>
				<tr class="lap">
					<td colspan="2" class="lap-header">
						<span class="lap-title">申请职位</span>
						<i class="td-inline-lap triangle-up"></i>
						<i class="td-inline-lap td-inline-lap-bottom"></i>
					</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<th>申请时间</th>
					<td>
						<span><?php echo to_date($output['employeeApplyInfo']['create_time']);?></span>
					</td>
				</tr>
				<tr>
					<th>职位名称</th>
					<td>
						<span><?php echo $output['jobInfo']['job_name'];?></span>
					</td>
				</tr>
				<tr>
					<th>职位代码</th>
					<td>
						<span><?php echo $output['jobInfo']['job_code'];?></span>
					</td>
				</tr>
				<tr>
					<th>职位介绍</th>
					<td>
						<span><?php echo $output['jobInfo']['description'];?></span>
					</td>
				</tr>
				</tbody>
			</table>
			<!-- 审核操作 -->
			<div class="order-check-handle" style="margin-bottom:20px;">
				<input type="hidden" name="employee_apply_id" value="<?php echo $output['employeeApplyInfo']['id'];?>" />
				<span><input type="radio" name="check_status" value="1" />通过</span>
				<span><input type="radio" name="check_status" value="-1" />拒绝</span>
			</div>
			<script type="text/javascript">
				$('input[name="check_status"]').on("click", function (){
					if($(this).is(':checked')){
						$('#operate_reason').show();
						if($(this).val()==1){
							$('#choose_department').show();
						}else{
							$('#choose_department').hide();
						}
					}else{
						$('#operate_reason').hide();
					}
				});
			</script>
			<!-- 分配部门 -->
			<table class="data-detail-table" id="choose_department" style="display:none;">
				<thead>
				<tr class="lap">
					<td colspan="2"  class="lap-header">
						<span class="lap-title">分配部门</span>
						<i class="td-inline-lap triangle-up"></i>
						<i class="td-inline-lap td-inline-lap-bottom"></i>
					</td>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($output['departmentList'] as $key => $department) {?>
				<tr>
					<th style="width:20%"><input type="radio" name="department_distribute_id" value="<?php echo $department['id'];?>" /></th>
					<td style="text-align:left;">
						<table class="data-detail-table folded" style="margin:0">
							<thead>
							<tr class="lap">
								<td colspan="2" class="lap-header">
									<span class="lap-title"><?php echo $department['name'];?></span>
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
									<span><?php echo $department['manager'];?></span>
								</td>
							</tr>
							<tr>
								<th colspan="2">部门介绍：</th>
							</tr>
							<tr>
								<td colspan="2" style="font-size:12px;text-align:left;">
									<?php echo $department['description'];?>
								</td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<?php }?>
				</tbody>
			</table>
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
		</form>
	</div>
</div>
