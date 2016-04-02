<?php
/**
 * @filesource apply_hasLogin.tpl.php
 * @doc 申请页面（已登录）
 * @author Heanes
 * @time 2015-08-17 11:07:49
*/
defined('InHeanes') or exit('Access Invalid!');
?>
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/jquery.cxselect.js"></script>
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/jquery.form/3.51/jquery.form.js"></script><!-- ajax提交数据 -->
<div class="main-content w-wrap">
	<div class="data-edit-block">
		<!-- 带输入验证的步骤提交 -->
		<form action="<?php echo BASE_URL; ?>index.php?act=money&op=apply" method="post" id="add_borrow_data_form" enctype="multipart/form-data">
			<!-- 1.1基本文字型输入数据 -->
			<div class="add-user-data">
				<div class="page-nav-tab">
					<ul>
						<li class="active"><a href="javascript:">我的信息</a></li>
					</ul>
				</div>
				<p class="text-right" style="color:red;font-size:12px;">注：带*为必填项</p>
				<table class="data-edit-table" id="add_user_base">
					<tbody>
					<tr>
						<th><span class="must">*</span>姓名：<i class="border-one"></i></th>
						<td>
							<input type="text" name="real_name" class="input-data input-border-none" placeholder="请填写真实姓名" autofocus />
<!--							<p class="input-tip input-error-notice">请填写真实姓名</p>-->
						</td>
					</tr>
					<tr>
						<th>身份证号：<i class="border-one"></i></th>
						<td>
							<input type="text" name="idcard" class="input-data input-border-none" placeholder="请填写身份证号" />
						</td>
					</tr>
					<tr>
						<th>联系电话：<i class="border-one"></i></th>
						<td>
							<input type="text" name="user_mobile" class="input-data input-border-none" placeholder="请填写联系电话" />
							<p class="input-tip input-error-notice">联系电话不正确</p>
						</td>
					</tr>
					<tr>
						<th>居住地址：<i class="border-one"></i></th>
						<td class="td-input-select">
							<div id="live_address_select">
								<select name="province" class="province select-normal select-tight"></select>
								<select name="city" class="city select-normal select-tight"></select>
								<select name="region" class="area select-normal select-tight"></select>
							</div>
							<script type="text/javascript">
								$('#live_address_select').cxSelect({
									// 提示：如果服务器不支持 .json 类型文件，请将文件改为 .js 文件
									url: '<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/cityData.min.json',
									selects: ['province', 'city', 'area'],
									nodata: 'none'
								});
							</script>
						</td>
					</tr>
					<tr>
						<th>详细地址：<i class="border-one"></i></th>
						<td>
							<input type="text" name="address" class="input-data input-border-none" placeholder="请填写详细地址" />
						</td>
					</tr>
					<?php if (count($output['userFieldsList'])) {
						foreach ($output['userFieldsList'] as $key => $userFields) { ?>
							<tr>
								<th><?php echo $userFields['name'] ?>：<i class="border-one"></i></th>
								<td>
									<?php if ($userFields['input_type'] == 'text') { ?>
										<input type="text" name="fields_data[<?php echo $userFields['id'] ?>]" class="input-data input-border-none"
											   placeholder="请填写<?php echo $userFields['name']; ?>" />
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
					</tbody>
				</table>
				<div class="page-nav-tab">
					<ul>
						<li class="active"><a href="javascript:">贷款信息</a></li>
					</ul>
				</div>
				<table class="data-edit-table">
					<tbody>
					<tr>
						<th><span class="must">*</span>贷款类型：<i class="border-one"></i></th>
						<td class="td-input-select">
							<select name="usage_id" id="select-one" class="select-normal">
									<option value="1">抵押</option>
									<option value="2">信贷</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span class="must">*</span>借款额度：<i class="border-one"></i></th>
						<td class="input-width-unit">
							<span><input type="text" name="total" class="input-data input-border-none text-right" placeholder="请填写借款额度，列如：100"></span>
							<span class="input-data-decorate">万</span>
						</td>
					</tr>
					<tr>
						<th><span class="must">*</span>借款年限：<i class="border-one"></i></th>
						<td class="td-input-select">
							<!--<span><input type="text" name="year_limit" class="input-data input-border-none text-right" placeholder="请填写借款年限，列如：5" /></span>-->
							<select name="year_limit" class="select-normal">
								<option value="10d">10天</option>
								<option value="1m">1个月</option>
								<option value="3m">3个月</option>
								<option value="6m">6个月</option>
								<option value="1y" selected>1年</option>
								<option value="3y">3年</option>
								<option value="5y">5年</option>
								<option value="10y">10年</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>借款用途备注：<i class="border-one"></i></th>
						<td>
							<textarea name="usage_info" class="data-textarea" placeholder="备注信息"></textarea>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- 认证数据填写分支 -->
			<?php if (is_array($output['certificationTypeList']) && count($output['certificationTypeList'])) {
				foreach ($output['certificationTypeList'] as $key => $certificationType) { ?>
					<div class="add-user-data">
						<div class="page-nav-tab">
							<ul>
								<li class="active"><a href="javascript:"><?php echo $certificationType['name'] ?>信息</a></li>
							</ul>
						</div>
						<table class="data-edit-table" id="add_user_house">
							<tbody>
							<tr>
								<th><img src="<?php echo PATH_BASE_PUBLIC.'static/image/certification/'.$certificationType['img_src']; ?>"
										 class="inline-img"><?php echo $certificationType['name'] ?><i class="border-one"></i></th>
								<td>
									<span>(请提交正确的资料图片)</span>
								</td>
							</tr>
							</tbody>
						</table>
						<?php if (count($certificationType['certificationTypeFields'])) { ?>
							<table class="data-edit-table" id="certificationType<?php echo $certificationType['id'] ?>">
								<tbody>
								<?php foreach ($certificationType['certificationTypeFields'] as $k => $certificationTypeFields) { ?>
									<tr>
										<!-- 文本框输入类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'text') { ?>
											<th><?php echo $certificationTypeFields['name'] ?>：<i class="border-one"></i></th>
											<td <?php if ($certificationTypeFields['value_unit'] != '') { ?> class="input-width-unit" <?php } ?>>
												<span><input type="text" name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>"
															 class="input-data input-border-none <?php if ($certificationTypeFields['value_unit'] != '') { ?>text-right<?php } ?>"
															 placeholder="请填写<?php echo $certificationTypeFields['name']; ?>" /></span>
												<?php if ($certificationTypeFields['value_unit'] != '') { ?>
													<span class="input-data-decorate"><?php echo $certificationTypeFields['value_unit']; ?></span>
												<?php } ?>
											</td>
										<?php } ?>
										<!-- 图片上传类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'file-image') { ?>
											<td colspan="2">
												<div class="upload-field" style="width:360px;text-align:center;margin:0 auto;">
													<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
														<span class="upload-button-text">点我上传<?php echo $certificationTypeFields['name'] ?></span>
														<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
														<input type="hidden" name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>" class="certification-img" value="">
														<input type="file" name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>"
															   class="upload-file-filed">
													</div>
													<!--
													<div class="upload-progress" style="display:block;">
														<span class="bar"></span><span class="percent">0%</span>
													</div>
													<div class="uploaded-files"></div>
													-->
													<img class="upload-img-preview img-gallery" alt="" href="<?php if ($certificationTypeFields['input_value'] != '') {
														echo PATH_BASE_PUBLIC.'static/image/'.$certificationTypeFields['input_value'];
													} else { ?>image/common/image_upload_default.png<?php } ?>" src="<?php if ($certificationTypeFields['input_value'] != '') {
														echo PATH_BASE_PUBLIC.'static/image/'.$certificationTypeFields['input_value'];
													} else { ?>image/common/image_upload_default.png<?php } ?>" style="width:100%;">
												</div>
											</td>
										<?php } ?>
										<!-- 下拉选择类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'select') { ?>
											<th class="td-input-select"><?php echo $certificationTypeFields['name'] ?>：<i class="border-one"></i></th>
											<td>
												<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>" class="select-normal">
													<?php foreach (explode(',', $certificationTypeFields['input_value']) as $option_key => $option) { ?>
														<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
													<?php } ?>
												</select>
											</td>
										<?php } ?>
										<!-- 地理位置选择类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'select-area') { ?>
											<th class="td-input-select"><?php echo $certificationTypeFields['name'] ?>：<i class="border-one"></i></th>
											<td>
												<div name="certification_type_fields<?php echo $certificationTypeFields['id'] ?>">
													<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>_province"
															class="province select-normal select-tight"></select>
													<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>_city"
															class="city select-normal select-tight"></select>
													<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>_region"
															class="area select-normal select-tight"></select>
												</div>
												<script type="text/javascript">
													$('div[name="certification_type_fields<?php echo $certificationTypeFields['id']?>"]').cxSelect({
														url: '<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/cityData.min.json',   // 提示：如果服务器不支持 .json 类型文件，请将文件改为 .js 文件
														selects: ['province', 'city', 'area'],
														nodata: 'none'
													});
												</script>
											</td>
										<?php } ?>
										</td>
									</tr>
								<?php } ?>
								<tr>
									<td colspan="2" style="text-align:center;">备注信息</td>
								</tr>
								<tr>
									<td colspan="2">
										<textarea name="message<?php echo $certificationType['id'] ?>" class="data-textarea" placeholder="有备注信息则填写此项"></textarea>
									</td>
								</tr>
								</tbody>
							</table>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<!-- 资产数据填写分支 -->
			<?php if (count($output['propertyList'])) {
				foreach ($output['propertyList'] as $key => $property) { ?>
					<div class="add-user-data">
						<div class="page-nav-tab">
							<ul>
								<li class="active"><a href="javascript:"><?php echo $property['name'] ?>信息</a></li>
							</ul>
						</div>
						<table class="data-edit-table" id="add_user_house">
							<tbody>
							<tr>
								<th><?php echo $property['name'] ?>：<i class="border-one"></i></th>
								<td>
									<input type="radio" name="has_property<?php echo $property['id'] ?>" value="1"
										   onclick="$('#property<?php echo $property['id'] ?>').show()">是
									<input type="radio" name="has_property<?php echo $property['id'] ?>" value="0"
										   onclick="$('#property<?php echo $property['id'] ?>').hide()" checked>否
								</td>
							</tr>
							</tbody>
						</table>
						<?php if (count($property['propertyFields'])) { ?>
							<table class="data-edit-table" id="property<?php echo $property['id'] ?>" style="display:none;">
								<tbody>
								<?php foreach ($property['propertyFields'] as $k => $propertyFields) { ?>
									<tr>
										<!-- 文本框输入类型 -->
										<?php if ($propertyFields['input_type'] == 'text') { ?>
											<th><?php echo $propertyFields['name'] ?>：<i class="border-one"></i></th>
											<td <?php if ($propertyFields['value_unit'] != '') { ?> class="input-width-unit" <?php } ?>>
												<span><input type="text" name="property_fields_value<?php echo $propertyFields['id'] ?>"
															 class="input-data input-border-none <?php if ($propertyFields['value_unit'] != '') { ?>text-right<?php } ?>"
															 placeholder="请填写<?php echo $propertyFields['name']; ?>" /></span>
												<?php if ($propertyFields['value_unit'] != '') { ?>
													<span class="input-data-decorate"><?php echo $propertyFields['value_unit']; ?></span>
												<?php } ?>
											</td>
										<?php } ?>
										<!-- 图片上传类型 -->
										<?php if ($propertyFields['input_type'] == 'file-image') { ?>
											<td colspan="2">
												<div class="upload-field" style="width:220px;text-align:center;margin:0 auto;">
													<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
														<span class="upload-button-text">点我上传<?php echo $propertyFields['name'] ?></span>
														<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
														<input type="file" name="property_fields_value<?php echo $propertyFields['id'] ?>" class="upload-file-filed">
													</div>
													<img class="upload-img-preview" alt="" src="<?php if ($propertyFields['input_value'] != '') {
														echo PATH_BASE_FILE_UPLOAD.$certificationTypeFields['input_value'];
													} else { ?>image/common/image_upload_default.png<?php } ?>" style="width:100%;">
												</div>
											</td>
										<?php } ?>
										<!-- 下拉选择类型 -->
										<?php if ($propertyFields['input_type'] == 'select') { ?>
											<th class="td-input-select"><?php echo $propertyFields['name'] ?>：<i class="border-one"></i></th>
											<td>
												<select name="property_fields_value<?php echo $propertyFields['id'] ?>" class="select-normal">
													<?php foreach (explode(',', $propertyFields['input_value']) as $option_key => $option) { ?>
														<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
													<?php } ?>
												</select>
											</td>
										<?php } ?>
										<!-- 地理位置选择类型 -->
										<?php if ($propertyFields['input_type'] == 'select-area') { ?>
											<th class="td-input-select"><?php echo $propertyFields['name'] ?>：<i class="border-one"></i></th>
											<td>
												<div name="property_fields<?php echo $propertyFields['id'] ?>">
													<select name="property_fields_value<?php echo $propertyFields['id'] ?>_province"
															class="province select-normal select-tight"></select>
													<select name="property_fields_value<?php echo $propertyFields['id'] ?>_city"
															class="city select-normal select-tight"></select>
													<select name="property_fields_value<?php echo $propertyFields['id'] ?>_region"
															class="area select-normal select-tight"></select>
												</div>
												<script type="text/javascript">
													$('div[name="property_fields<?php echo $propertyFields['id']?>"]').cxSelect({
														url: '<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/cityData.min.json',   // 提示：如果服务器不支持 .json 类型文件，请将文件改为 .js 文件
														selects: ['province', 'city', 'area'],
														nodata: 'none'
													});
												</script>
											</td>
										<?php } ?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="data-edit-handle">
				<div class="handle-left">
					<a href="javascript:" class="button-normal button-show" name="pre_step" style="visibility:hidden">上一步</a>
				</div>
				<div class="handle-right">
					<a href="javascript:" class="button-normal button-edit disabled" name="next_step">下一步</a>
					<input type="submit" name="apply_money_form_submit" class="data-submit-button" style="display:none;" value="保存" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- js E -->
<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Validform/5.3.2/Validform_Datatype.js"></script>
<script type="text/javascript">
	$(function () {
		var borrow_validate = $("#add_borrow_data_form").Validform({
			tiptype: 3,
			label: "th",
			showAllError: false,
			ignoreHidden:false,
			datatype: {
				"zh2-6": /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
				"file":function(gets,obj,curform,datatype) {
				}
			},
			ajaxPost: false
		});
		borrow_validate.tipmsg.w["zh2-6"] = "请输入2到6个中文字符！";
		borrow_validate.addRule([
			{
				ele: 'input[name="real_name"]',
				datatype: 'zh2-6'
			},
			{
				ele: 'input[name="idcard"]',
				datatype: 'idcard',
				ignore:'ignore'
			},
			{
				ele: 'input[name="user_mobile"]',
				datatype: 'm',
				ignore:'ignore'
			},
			//贷款验证
			{
				ele: 'select[name="usage_id"]',
				datatype: 'n',
				nullmsg:"请选择贷款用途！",
				errormsg:"请选择贷款用途"
			},
			{
				ele: 'input[name="total"]',
				datatype: 'n',
				nullmsg:"请填写贷款额度！",
				errormsg:"贷款额度为整数"
			},
			{
				ele:'input.certification-img1',
				datatype:'*',
				nullmsg:'请上传文件!'
			}
		]);
		$('input').on('blur',function(){
			var next_step=$('a[name="next_step"]');
			var valid=borrow_validate.check(true,'input[name="real_name"]')
				&& borrow_validate.check(true,'input[name="idcard"]')
				&& borrow_validate.check(true,'input[name="user_mobile"]')
				&& borrow_validate.check(true,'select[name="usage_id"]')
				&& borrow_validate.check(false,'input[name="total"]')
				;
			if(valid){
				next_step.removeClass('disabled');
				next_step.attr('disabled',false);
			}else{
				next_step.addClass('disabled');
				next_step.attr('disabled',true);
			}
			next_step.on('click',function(){
				if(!valid){
					borrow_validate.check();
					return false;
				}
			});
		});

	});
	function setStepAvailable(form,step_button){
		alert(getFormCheckStatus(form));
		if(getFormCheckStatus(form)){
			$('input[type="submit"]').attr('disabled',false);
			$(step_button).removeClass('disabled');
			$(step_button).attr('disabled',false);
		}else{
			$('input[type="submit"]').attr('disabled',true);
			$(step_button).addClass('disabled');
			$(step_button).attr('disabled',true);
		}
	}
	/**
	 * @doc 获取表单的验证状态
	 * @param Validform form 表单对象
	 * @returns boolean
	 */
	function getFormCheckStatus(form){
		return form.check(true);
	}
</script>
<script type="text/javascript">
	$(function () {
		var bar = $('.upload-progress .bar');
		var percent = $('.upload-progress .percent');
		var progress = $('.upload-progress');
		var files = $('.uploaded-files');
		$('input[type="file"]').change(function () {
			var this_input=$(this);
			$(this).wrap("<form id='my_upload' method='post' enctype='multipart/form-data'></form>");
			$("#my_upload").ajaxSubmit({
				url:'<?php echo BASE_URL;?>'+'index.php?act=AjaxResponse&op=fileUpload',
				target:$(this),
				dataType: 'json',
				data:{field_name:$(this).attr('name'),save_path:'temp'},
				beforeSend: function () {
					progress.show();
					var percentVal = '0%';
					bar.width(percentVal);
					percent.html(percentVal);
				},
				uploadProgress: function (event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal);
					percent.html(percentVal);
				},
				success: function (data) {
					files.html("<b>" + data.name + "(" + data.size + "k)</b> <span class='delimg' rel='" + data.pic + "'>删除</span>");
					this_input.parent().parent().parent().find('img.upload-img-preview').attr('src', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
					this_input.parent().parent().parent().find('img.upload-img-preview').attr('href', '<?php echo PATH_BASE_FILE_UPLOAD;?>'+data.save_path + data.pic);
					//this_input.after('<input type="hidden" name="'+this_input.attr('name')+'" value="'+data.pic+'">');
					$('input[name="'+this_input.attr('name')+'"]').val(data.pic);
				},
				error: function (xhr) {
					bar.width('0');
					files.html(xhr.responseText);
					alert(xhr.responseText);
				}
			});
			$(this).unwrap();//拆掉form包裹，则可以多个上传
		});
	});
</script>
<script type="text/javascript">
	//银行卡增加按钮
	$('a[name="add_more_user_bank"]').on('click', function () {
		$(this).parent().before($('table[rel="add_user_bank"]').clone(true));
	});

	//点击“上一步”、“下一步”操作在界面上的变化效果
	var data_edit_queue = $('div.add-user-data');
	//先把除第一个输入区域之外的填写区域隐藏
	var step_count = data_edit_queue.length;
	for (var i = 1; i < step_count; i++) {
		$(data_edit_queue[i]).hide();
	}
	var next_step=$('a[name="next_step"]');
	var pre_step=$('a[name="pre_step"]');
	var step = 1;
	next_step.attr('rel',step);
	if (step == 1) {
		pre_step.css("visibility", "hidden");
	}
	if (step == step_count) {
		next_step.hide();
		$('input[type="submit"]').show();
	}
	//“下一步”点击操作
	next_step.on('click', function () {
		if ($(this).hasClass('disabled') || $(this).attr('disabled')==true) {
			return false;
		} else {
			pre_step.css("visibility", "visible");
			$(data_edit_queue[step-1]).hide();
			step++;
			$(this).attr('rel',step);
			$(data_edit_queue[step-1]).show();
			if (step == step_count) {
				$(this).hide();
				$('input[type="submit"]').show();
			}
		}
	});
	//“上一步”点击操作
	pre_step.on('click', function () {
		if (step > 0) {
			$(data_edit_queue[step-1]).hide();
			step--;
			$(this).attr('rel',step);
			$(data_edit_queue[step-1]).show();
			//保存按钮和下一步按钮交换显示
			$('input[type="submit"]').hide();
			next_step.show();
			if (step <= 0) {
				$(this).css("visibility", "hidden");
			}
		} else {
			return false;
		}
	});

	//离开此页时提示信息
	$(window).bind('beforeunload', function () {
		//return '你确定不保存数据就离开本页面吗？';
	});
</script>
