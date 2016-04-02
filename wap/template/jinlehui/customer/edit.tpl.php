<?php
/**
 * @doc 添加客户页面
 * @filesource add.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-09 16:44:39
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap">
	<div class="data-detail-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=customer&op=update" method="post" enctype="multipart/form-data">
			<!-- 用户信息 -->
			<?php foreach ($output['upload'] as $key => $result) { ?>
				<input type="hidden" name="id" value="<?php echo $result['id']; ?>" />
				<table class="data-detail-table folded">
					<thead>
					<tr class="lap">
						<td colspan="2" style="position:relative;">
							<span class="lap-title">用户信息</span>
							<i class="td-inline-lap triangle-down"></i>
							<i class="td-inline-lap td-inline-lap-bottom"></i>
						</td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>姓名：</th>
						<td>
							<span><input type="text" name="user_name" value="<?php echo $result['user_name']; ?>"></span>
						</td>
					</tr>
					<tr>
						<th>性别：</th>
						<td>
							<span>
								<?php if ($result['gender'] == 1) { ?>
									<input type="radio" name="gender" value="1" checked="checked">男
								<input type="radio" name="gender" value="0">女
								<?php } else { ?>
									<input type="radio" name="gender" value="1">男
								<input type="radio" name="gender" value="0" checked="checked">女
								<?php } ?>
							</span>
						</td>
					</tr>
					<tr>
						<th>联系电话：</th>
						<td>
							<input type="text" name="mobile" value="<?php echo $result['mobile']; ?>">
						</td>
					</tr>
					<tr>
						<th>身份证号：</th>
						<td>
							<input type="text" name="idcard" value="<?php echo $result['idcard']; ?>">
						</td>
					</tr>
					</tbody>
				</table>
				<!-- 用户资产信息 -->
				<table class="data-detail-table folded">
					<thead>
					<tr class="lap">
						<td colspan="2" style="position:relative;">
							<span class="lap-title">用户资产信息</span>
							<i class="td-inline-lap triangle-down"></i>
							<i class="td-inline-lap td-inline-lap-bottom"></i>
						</td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>房产信息：</th>
						<td>
							<span>
								 <?php if ($result['has_house'] == 1) { ?>
									 <input type="radio" name="has_house" value="1" checked="checked">有
										  <input type="radio" name="has_house" value="0">无
								 <?php } else { ?>
									 <input type="radio" name="has_house" value="1">有
										  <input type="radio" name="has_house" value="0" checked="checked">无
								 <?php } ?>

							</span>
						</td>
					</tr>
					<?php if ($result['has_house'] == 1) { ?>
					<tr>
						<th>所处地域：</th>
						<td>
							<span>
								<p class="contact-input">
									<label for="select" class="select-one">
										<select name="territory" id="select-one" class="input-data input-border-none" style="width: 200px;text-align: center">
											<option value="海淀" selected>海淀</option>
											<option value="朝阳">朝阳</option>
											<option value="东城">东城</option>
											<option value="崇文">崇文</option>
											<option value="宣武">宣武</option>
											<option value="丰台">丰台</option>
											<option value="石景山">石景山</option>
											<option value="昌平">昌平</option>
											<option value="通州">通州</option>
											<option value="大兴">大兴</option>
											<option value="顺义">顺义</option>
											<option value="门头沟">门头沟</option>
											<option value="房山">房山</option>
											<option value="密云">密云</option>
											<option value="怀柔">怀柔</option>
											<option value="平谷">平谷</option>
											<option value="延庆">延庆</option>
											<option value="燕郊">燕郊</option>
											<option value="北京周边">北京周边</option>

										</select>
									</label>
								</p>
							</span>
						</td>
					</tr>
					<tr>
						<th>房产类型：</th>
						<td>
							<span><p class="contact-input">
									<label for="select" class="select-one">
										<select name="residence" id="select-one" class="input-data input-border-none" style="width: 200px;text-align: center">
											<option value="住宅房" selected>住宅房</option>
											<option value="商业房">商业房</option>

										</select>
									</label>
								</p></span>
						</td>
					</tr>
					<tr>
						<th>住房面积：</th>
						<td>
							<input type="text" name="area" value="<?php echo $result['area']; ?>">
						</td>
					</tr>
					<tr>
						<th>是否在抵押：</th>
						<td>
							<?php if ($result['pledge'] == 1) { ?>
					<input type="radio" name="pledge" value="1" checked="checked">是
					<input type="radio" name="pledge" value="0">否
				<?php } else { ?>
					<input type="radio" name="pledge" value="1">是
					<input type="radio" name="pledge" value="0" checked="checked">否
				<?php } ?>
						</td>
					</tr>
					<tr>
						<th>房产证明：</th>
						<td>
							<?php if ($result['pichome1'] !== '') { ?>
					<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['pichome1'] ?>" width="50px" height="50px" /></span>
				<?php } else {
				} ?>
					<?php if ($result['pichome2'] !== '') { ?>
						<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['pichome2'] ?>" width="50px" height="50px" /></span>
					<?php } else {
					} ?>
					<?php if ($result['pichome3'] !== '') { ?>
						<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['pichome3'] ?>" width="50px" height="50px" /></span>
					<?php } else {
					} ?>

						</td>
						<tr class="butone">
								<th style="width: 200px">请上传新的相关证明文件：</th>
							</tr>

						<tr class="butone">
								<th>房产证明1页：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
										   <input type="file" name="pichome1" />
											<input type="button" value="增加" id="but">
										</label>
									</p>
								</td>

							</tr>

							<tr class="but butone">
								<th>房产证明2页：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
										   <input type="file" name="pichome2" />

										</label>
									</p>
								</td>

							</tr>
							<tr class="but butone">
								<th>房产证明3页：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
										   <input type="file" name="pichome3" />

										</label>
									</p>
								</td>

							</tr>
					</tr>
					<?php } else {
					} ?>
					<tr>
						<th>车辆信息：</th>
						<td>
								<span>
									 <?php if ($result['has_car'] == 1) { ?>
										 <input type="radio" name="has_car" value="1" checked="checked">是
											  <input type="radio" name="has_car" value="0">否
									 <?php } else { ?>
										 <input type="radio" name="has_car" value="1">是
											  <input type="radio" name="has_car" value="0" checked="checked">否
									 <?php } ?>
									</span>
						</td>
					</tr>
					<?php if ($result['piccar'] !== '') { ?>
						<tr>
							<th>行驶证明：</th>
							<td>
								<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['piccar'] ?>" width="50px" height="50px"/></span>
							</td>
							 <tr class="butone">
									<th style="width: 200px">请上传新的相关证明文件：</th>
								</tr>
							<tr class="car">
									<th>车辆行驶证：<i class="border-one1"></i></th>
									<td>
										<p class="contact-input">
											<label for="select" class="select-one">
												<input type="file" name="piccar" />

											</label>
										</p>
									</td>
								</tr>
						</tr>
					<?php } else {
					} ?>
					</tbody>
				</table>
				<!-- 贷款信息 -->
				<table class="data-detail-table">
					<thead>
					<tr class="lap">
						<td colspan="2" style="position:relative;">
							<span class="lap-title">公司信息</span>
							<i class="td-inline-lap triangle-down"></i>
							<i class="td-inline-lap td-inline-lap-bottom"></i>
						</td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>名下公司：</th>
						<td>
							<span>
								<?php if ($result['has_company'] == 1) { ?>
									<input type="radio" name="has_company" value="1" checked="checked">是
											  <input type="radio" name="has_company" value="0">否
								<?php } else { ?>
									<input type="radio" name="has_company" value="1">是
											  <input type="radio" name="has_company" value="0" checked="checked">否
								<?php } ?>
							</span>
						</td>
					</tr>
					<?php if ($result['has_company'] == 1) { ?>
						<?php if ($result['company_a'] !== '') { ?>
							<tr>
								<th>营业执照</th>
								<td>
									<span> <img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['company_a'] ?>" width="50px" height="50px" /></span>
								</td>
							</tr>
						<?php } else {
						} ?>
						<?php if ($result['company_b'] !== '') { ?>
							<tr>
								<th>组织机构代码证</th>
								<td>
									<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['company_b'] ?>" width="50px" height="50px" /></span>
								</td>
							</tr>
						<?php } else {
						} ?>
						<?php if ($result['company_c'] !== '') { ?>
							<tr>
								<th>税务登记证</th>
								<td>
									<span><img src="<?php echo PATH_BASE_FILE_UPLOAD;?><?php echo $result['company_c'] ?>" width="50px" height="50px" /></span>
								</td>
							</tr>
							<tr class="butone">
								<th style="width: 200px">请上传新的相关证明文件：</th>
							</tr>
							<tr>
								<th>营业执照：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
											<input type="file" name="company_a" />

										</label>
									</p>
								</td>
							</tr>
							<tr>
								<th>组织机构代码证：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
											<input type="file" name="company_b" />
										</label>
									</p>
								</td>
							</tr>
							<tr>
								<th>事物登记证：<i class="border-one1"></i></th>
								<td>
									<p class="contact-input">
										<label for="select" class="select-one">
											<input type="file" name="company_c" />

										</label>
									</p>
								</td>
							</tr>
						<?php } else {
						} ?>
					<?php } else {
					} ?>
					</tbody>
				</table>
			<?php } ?>
			<div class="data-detail-handle">
				<div class="handle-left">
					<a href="<?php echo BASE_URL; ?>index.php?act=staff&op=default&id=<?php echo $result['id'] ?>"><img src="./image/fanhui.png" title=”返回上一页”/></a>
				</div>
				<div class="handle-right">
					<input type="submit" class="data-submit-button button-normal" value="完成" />
				</div>
			</div>
			<!-- 审核操作 -->
		</form>
	</div>
</div>

<script type="text/javascript">
	$('#but').click(function () {
		var but = $('.but');
		if (but.css('display') == 'none') {
			$(this).val('隐藏');
			but.css('display', 'table-row');
		} else {
			$(this).val('增加');
			but.css('display', 'none');
		}

	});
	var has_house = $("input[name='has_house']").val();
	if (has_house == '0') {
		$('.butone').css('display', 'none');
	}
	var has_car = $("input[name='has_car']").val();
	if (has_car == '0') {
		$('.car').css('display', 'none');
	}
	var has_company = $("input[name='has_company']").val();

	if (has_company == '0') {
		$('.has_c').css('display', 'none');
		$('.has_o').css('display', 'inline');
		$('.data-edit-block').css('padding-left', '137px');
	}
</script>
