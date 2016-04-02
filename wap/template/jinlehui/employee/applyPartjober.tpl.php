<?php
/**
 * @doc 兼职上传资料页面
 * @filesource applyPartjober.tpl.php
 * @author Heanes
 * @time 2015-07-07 13:41:12
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/jquery.cxselect.js"></script>
<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/jquery.form/3.51/jquery.form.js"></script><!-- ajax提交数据 -->
<div class="main-content w-wrap">
	<div class="page-introduce-img">
		<img alt="" src="image/introduce/introduce-apply.png" class="introduce-img">
	</div>
	<div class="apply-part-jober">
		<form action="" method="post" id="partjober_apply_form" enctype="multipart/form-data">
			<table class="apply-part-jober-table">
				<tbody>
				<tr>
					<th>真实姓名</th>
					<td><input name="real_name" type="text" class="input-data input-apply" placeholder="请填写真实姓名" /></td>
				</tr>
				<tr>
					<th>身份证号</th>
					<td><input name="idcard" type="text" class="input-data input-apply" placeholder="请填写身份证号" /></td>
				</tr>
				<tr>
					<th>推荐人ID</th>
					<td><input name="recommend_eid" type="text" class="input-data input-apply" placeholder="请填写推荐人编号, 无则留空"
							   <?php if (isset($_SESSION['_employee_invite'])){ ?>value="<?php echo $_SESSION['_employee_invite']; ?>"<?php } ?> />
					</td>
				</tr>
				<tr>
					<th>银行</th>
					<td>
						<select name="bank_id" class="select-apply">
							<option value="">请选择银行</option>
							<?php foreach ($output['bankList'] as $key => $bank) { ?>
								<option value="<?php echo $bank['id']; ?>"><?php echo $bank['name']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<th>银行卡号</th>
					<td><input name="bank_card_num" type="text" class="input-data input-apply" placeholder="请填写银行卡号" /></td>
				</tr>
				<!--
				<tr>
					<td colspan="2">
						<div class="upload-field" style="text-align:center;margin:0 auto;">
							<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
								<span class="upload-button-text">点我上传银行卡正面照片</span>
								<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
								<input type="file" name="bank_front_pic_src" class="upload-file-filed" />
							</div>
							-->
							<!--
							<div class="upload-progress" style="display:block;">
								<span class="bar"></span><span class="percent">0%</span>
							</div>
							<div class="uploaded-files"></div>
							-->
				<!--
							<img class="upload-img-preview img-gallery" alt="" src="<?php echo PATH_BASE_PUBLIC;?>static/image/bankCard/demo_front.jpg" href="<?php echo PATH_BASE_PUBLIC;?>static/image/bankCard/demo_front.jpg" style="width:100%;">
						</div>
					</td>
				</tr>
				-->
				</tbody>
			</table>
			<!-- 1.2银行卡信息 -->
			<!-- 认证数据填写分支 -->
			<?php if (count($output['certificationTypeList'])) {
				foreach ($output['certificationTypeList'] as $key => $certificationType) { ?>
					<div class="add-user-data">
						<?php if (count($certificationType['certificationTypeFields'])) { ?>
							<table class="apply-part-jober-table" id="certificationType<?php echo $certificationType['id'] ?>">
								<tbody>
								<?php foreach ($certificationType['certificationTypeFields'] as $k => $certificationTypeFields) { ?>
									<tr>
										<!-- 文本框输入类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'text') { ?>
											<th><?php echo $certificationTypeFields['name'] ?>：<i class="border-one"></i></th>
											<td <?php if ($certificationTypeFields['value_unit'] != '') { ?> class="input-width-unit" <?php } ?>>
												<span><input type="text" name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>"
															 class="input-data input-apply <?php if ($certificationTypeFields['value_unit'] != '') { ?>text-right<?php } ?>"
															 placeholder="请填写<?php echo $certificationTypeFields['name']; ?>" /></span>
												<?php if ($certificationTypeFields['value_unit'] != '') { ?>
													<span class="input-data-decorate"><?php echo $certificationTypeFields['value_unit']; ?></span>
												<?php } ?>
											</td>
										<?php } ?>
										<!-- 图片上传类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'file-image') { ?>
											<td colspan="2">
												<div class="upload-field" style="text-align:center;margin:0 auto;">
													<div class="file-upload-wrap" style="margin:15px auto;width:200px;">
														<span class="upload-button-text">点我上传<?php echo $certificationTypeFields['name'] ?></span>
														<input type="hidden" name="MAX_FILE_SIZE" value="1024000">
														<input type="file" name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>" class="upload-file-filed">
													</div>
													<!--
													<div class="upload-progress" style="display:block;">
														<span class="bar"></span><span class="percent">0%</span>
													</div>
													<div class="uploaded-files"></div>
													-->
													<img class="upload-img-preview img-gallery" alt="" href="<?php if ($certificationTypeFields['input_value'] != '') {
														echo PATH_BASE_PUBLIC.'static/image/'.$certificationTypeFields['input_value'];
													} else { ?>image/common/image_upload_default.png<?php } ?>"
														 src="<?php if ($certificationTypeFields['input_value'] != '') {
															 echo PATH_BASE_PUBLIC.'static/image/'.$certificationTypeFields['input_value'];
														 } else { ?>image/common/image_upload_default.png<?php } ?>" style="width:100%;">
												</div>
											</td>
										<?php } ?>
										<!-- 下拉选择类型 -->
										<?php if ($certificationTypeFields['input_type'] == 'select') { ?>
											<th class="td-input-select"><?php echo $certificationTypeFields['name'] ?>：<i class="border-one"></i></th>
											<td>
												<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>" class="select-apply">
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
															class="province select-apply"></select>
													<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>_city"
															class="city select-apply"></select>
													<select name="certification_type_fields_value<?php echo $certificationTypeFields['id'] ?>_region"
															class="area select-apply"></select>
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
										<textarea name="message<?php echo $certificationType['id'] ?>" class="data-textarea" style="height:100px;" placeholder="有备注信息则填写此项"></textarea>
									</td>
								</tr>
								</tbody>
							</table>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="upload-notice">
				<div class="notice-wrap">
					<p>注：1、姓名、银行卡姓名、上传身份证姓名要保持一致</p>
					<p>2、请勿上传信用卡，否则会影响你提现</p>
					<p>3、提交之前请仔细检查好银行卡号信息</p>
				</div>
			</div>
			<div class="check-clause upload-clause">
				<p class="text-center">
					<input type="checkbox" name="accept_law" checked="checked" />我已阅读并同意<a href="javascript:" class="law-href">《金乐汇交易条款》</a>
				</p>
			</div>
			<div class="upload-handle">
				<input type="submit" name="partjober_apply_submit" class="button-normal apply-button" value="立即申请" />
			</div>
		</form>
	</div>
</div>
<!-- js E -->
<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/Validform/5.3.2/Validform_Datatype.js"></script>
<script type="text/javascript">
	$(function () {
		var partjober_apply_validate = $("#partjober_apply_form").Validform({
			tiptype: 3,
			label: "th",
			showAllError: false,
			ignoreHidden:false,
			datatype: {
				"zh2-6": /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
				"file":function(gets,obj,curform,datatype) {
				},
				'n16-19':/^\d{16,19}$/
			},
			ajaxPost: false
		});
		partjober_apply_validate.tipmsg.w["zh2-6"] = "请输入2到6个中文字符！";
		partjober_apply_validate.addRule([
			{
				ele: 'input[name="real_name"]',
				datatype: 'zh2-6'
			},
			{
				ele: 'input[name="idcard"]',
				datatype: 'idcard'
			},
			{
				ele: 'input[name="recommend_eid"]',
				datatype: 'n',
				ignore:'ignore',
				nullmsg:"请填写推荐人ID！",
				errormsg:"推荐人ID不正确！"
			},
			{
				ele: 'select[name="bank_id"]',
				datatype: 'n',
				nullmsg:"请选择银行！",
				errormsg:"请选择银行！"
			},
			{
				ele: 'input[name="bank_card_num"]',
				datatype: 'n16-19',
				nullmsg:"请填写银行卡号，获取收益后会打到你填写的账户！",
				errormsg:"请填写正确的银行卡号"
			},
			{
				ele:'input[name="accept_law"]',
				datatype:'*',
				nullmsg:'请同意金乐汇法律条款'
			}
		]);
		$('input').on('blur',function(){
			var next_step=$('a[name="next_step"]');
			var valid=partjober_apply_validate.check(true,'input[name="real_name"]')
					&& partjober_apply_validate.check(true,'input[name="idcard"]')
					&& partjober_apply_validate.check(true,'input[name="recommend_eid"]')
					&& partjober_apply_validate.check(true,'select[name="bank_id"]')
					&& partjober_apply_validate.check(false,'input[name="bank_card_num"]')
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
					partjober_apply_validate.check();
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
<!-- E js E -->
<script type="text/javascript">
	//ajax修改图片显示
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
					this_input.after('<input type="hidden" name="'+this_input.attr('name')+'" value="'+data.pic+'">');
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