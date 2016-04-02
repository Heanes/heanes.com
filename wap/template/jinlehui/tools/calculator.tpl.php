<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<link rel="stylesheet" type="text/css" href="css/calculator.css"/>
<div class="main-content w-wrap" style="background-color:#fff">
	<div class="calculator-block">
		<div class="calculator-type-block">
			<h1 class="type-title current">借款计算器</h1>
		</div>
		<div class="calculator-input-block">
			<table class="data-edit-table data-apply-table">
				<tr>
					<th style="width:30%">借款金额：</th>
					<td class="input-width-unit">
						<span><input type="text" name="borrowamount" id="borrowAmount" class="input-data input-border-none text-right" placeholder="请填写借款额度"></span>
						<span class="input-data-decorate">万</span>
					</td>
				</tr>
				<tr>
					<th>年 利 率：</th>
					<td class="input-width-unit">
						<span><input type="text" name="apr" id="apr" class="input-data input-border-none text-right" placeholder="请填写年利率"></span>
						<span class="input-data-decorate">%</span>
					</td>
				</tr>
				<tr>
					<th>借款期限：</th>
					<td class="input-width-unit">
						<span><input type="text" name="repaytime" id="repayTime" class="input-data input-border-none text-right" placeholder="请填写借款期限"></span>
						<span class="input-data-decorate">月</span>
					</td>
				</tr>
				<tr>
					<th>还款方式：</th>
					<td class="td-input-select">
						<select name="repayType" class="select-normal">
							<option value="1">等额本息</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div class="input-tip-block">
			<p id="T_error" class="text-center calculator-input-error"></p>
		</div>
		<div class="data-detail-handle">
			<div class="handle-center">
				<input class="button-normal button-large-super-long button-show" id="calculateBtn" type="button" value="计算"/>
			</div>
		</div>
		<div id="calculate_result" class="calculate-result">
			<div id="Loans-to-describe" class="Loans-to-describe">
				<div class="result-title-block">
					<h1 class="result-title current">计算结果</h1>
				</div>
				<div class="result-content-block">
					<p class="result-p">
						<span>您将在</span><span class="text-red" id="refund"></span> 个月后还清贷款
					</p>
					<p class="result-p">
						<span>月利率为</span><span class="text-red" id="monthly"></span>
						<span>利息总额：</span>
						<span class="text-red" id="totalinterest"></span>万元
					</p>
					<p class="result-p">
						<span>每月付款： </span><span class="text-red" id="payment"></span>万元
					</p>
					<p class="result-p">
						<span>您需还本息共 </span><span class="text-red" id="total"></span>万元
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#calculateBtn").click(function () {
		$("#T_error").html("");
		if ($.trim($("#borrowAmount").val()) == "" || $("#borrowAmount").val() % 1 != 0) {
			$("#T_error").html("借款金额必须为正整数!");
			return false;
		}
		if ($.trim($("#apr").val()) == "" || isNaN($.trim($("#apr").val()))) {
			$("#T_error").html("年利率必须为数字类型!");
			return false;
		}
		if ($.trim($("#repayTime").val()) == "" || isNaN($.trim($("#repayTime").val()))) {
			$("#T_error").html("月份格必须为数字类型!");
			return false;
		}
		if ($.trim($("#repayTime").val()) > 120) {
			$("#T_error").html("月份必须在120以内!");
			return false;
		}
		var amount = $('#borrowAmount');//贷款金额
		var apr = $('#apr');            //贷款利率
		var payments = $('#repayTime');//贷款期限
		var payment = $('#payment');
		var total = $('#total');
		var monthly_total = $('#monthly');
		var totalinterest = $('#totalinterest');
		var refund = $('#refund');
		if (amount.val() && apr.val() && payments.val()) {
			$('.calculate-result').show();
			var counter_array = {};
			var amount_money = amount.val() * 10000;
			var monthly = apr.val() / 12;//月利率
			var monthly_interest = monthly / 100;//月利息
			var rental_interest = monthly_interest * amount_money * payments.val();//利息总额
			var month_money = (monthly_interest * amount_money) + (amount_money / payments.val());//每月本息
			var gross = month_money * payments.val();//本息总金额
			counter_array['payment'] = (month_money / 10000).toFixed(4);
			counter_array['total'] = (gross / 10000).toFixed(4);
			counter_array['monthly_total'] = monthly.toFixed(2);
			counter_array['totalinterest'] = (rental_interest / 10000).toFixed(4);
			counter_array['refund'] = payments.val();
			if (counter_array) {
				payment.html('￥' + counter_array['payment']);
				total.html('￥' + counter_array['total']);
				monthly_total.html(counter_array['monthly_total'] + '%');
				totalinterest.html('￥' + counter_array['totalinterest']);
				refund.html(counter_array['refund']);
			} else {
				return false;
			}
		} else {
			$("#T_error").html("请输入合法的相应参数！");
		}
	});
</script>
