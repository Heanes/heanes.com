<?php
/**
 * @doc 快速申请页面
 * @author Heanes
 * @time 2015-08-17 10:45:24
 */
?>
<div class="main-content w-wrap">
	<div class="page-introduce-img">
		<img src="image/introduce/introduce-product-apply.png" class="introduce-img">
	</div>
	<div class="product-apply">
		<form action="<?php echo BASE_URL; ?>index.php?act=money&op=quickApply" method="post" name="reg_form" id="reg_form">
			<table class="data-edit-table data-apply-table">
				<tbody>
				<tr>
					<th>贷款类型<i class="border-one"></i></th>
					<td class="td-input-select">
						<select name="loan_type" id="select-one" class="select-normal">
							<option value="" selected>请选择</option>
							<option value="1">抵押贷款</option>
							<option value="2">信用贷款</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>贷款金额<i class="border-one"></i></th>
					<td class="input-width-unit">
						<span class="text-right"><input id="select-two" type="text" name="money_want" class="input-data input-border-none text-right" placeholder="请填写所需贷款金额" required value=""/></span>
						<span class="input-data-decorate">万</span>
					</td>
				</tr>
				<tr>
					<th>联系电话<i class="border-one"></i></th>
					<td>
						<input id="phone" type="text" name="phone" class="input-data input-border-none" placeholder="请填联系电话"/>
					</td>
				</tr>
				<tr>
					<th>姓名<i class="border-one"></i></th>
					<td class="input-width-unit">
						<span><input id="name" type="text" name="real_name" class="input-data input-border-none " placeholder="您的称呼？"/></span>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-detail-handle">
				<div class="handle-center">
					<input type="submit" id="mit" name="quick_apply_form_submit" class="button-large-super-long button-show" value="立即申请"/>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$('#mit').click(function () {
		var h = /^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
		var x = /^[0-9]{1,7}$/;
		var ok1 = true;
		var ok2 = true;
		var ok3 = true;
		var ok4 = true;
		if ($('#select-one').val() == '') {
			alert('请选择贷款类型！');
			ok1 = false;
		} else if (x.test($('#select-two').val()) == false) {
			alert('贷款金额不能为空且为数字！');
			ok2 = false;
		} else if ($('#phone').val() == '') {
			alert('请输入手机号码，便于我们联系您。');
			ok3 = false;
		} else if (h.test($('#phone').val()) == false) {
			alert('请输入正确的手机号！');
			ok4 = false;
		}
		if (ok1 && ok2 && ok3 && ok4) {
			$('form').submit();
		} else {
			return false;
		}
	});
</script>