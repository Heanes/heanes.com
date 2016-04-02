<?php
/**
 * @doc 显示客户信息
 * @filesource show.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.09 009
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="page-nav-tab">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>index.php?act=customer">客户列表</a></li>
			<li class="active"><a href="<?php echo BASE_URL; ?>index.php?act=customer&op=add">用户信息</a></li>
		</ul>
	</div>
	<div class="data-detail-block">
		<!-- 用户信息 -->
		<input type="hidden" name="user_id" value="<?php echo $output['customer']['uid_master']; ?>" />
		<table class="data-detail-table">
			<thead>
			<tr class="lap">
				<td colspan="2" class="lap-header">
					<span class="lap-title">用户信息</span>
					<i class="td-inline-lap triangle-up"></i>
					<i class="td-inline-lap td-inline-lap-bottom"></i>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<th>姓名：</th>
				<td><span><?php echo $output['userInfo']['user_name']; ?></span></td>
			</tr>
			<tr>
				<th>性别：</th>
				<td>
					<?php if (!isset($output['userInfo']['gender']) || empty($output['userInfo']['gender'])) { ?>未知<?php } elseif ($output['userInfo']['gender'] == 1) { ?>男<?php } elseif ($output['userInfo']['gender'] == 0) { ?>女<?php } ?>
				</td>
			</tr>
			<tr>
				<th>联系电话：</th>
				<td><?php echo $output['userInfo']['mobile']; ?></td>
			</tr>
			<tr>
				<th>身份证号：</th>
				<td><?php echo $output['userInfo']['idcard']; ?></td>
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
	</div>
	<div class="data-detail-handle">
		<div class="handle-left">
			<a href="javascript:history.go(-1);" class="button-normal button-show">返回</a>
		</div>
		<div class="handle-right">
			<a href="<?php echo BASE_URL ?>index.php?act=customer&op=edit" class="button-normal button-edit">修改</a>
		</div>
	</div>
</div>
