<?php
/**
 * @doc 投诉建议页面
 * @author Heanes
 * @time 2015-08-14 14:20:22
 */
defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<!-- 投诉建议 -->
	<div class="data-edit-block">
		<div class="data-edit-title">
			<p><span style="color:#DD6F16">你+我们，改变一切。</span>请留下您宝贵的建议:</p>
		</div>
		<form action="" method="post" id="loan_refuse_form" name="loan_refuse_form">
			<div class="data-edit-field">
				<textarea name="suggest_content" rows="8" class="data-textarea"></textarea>
				<p class="input-error-notice">不通过原因至少5个字符</p>
			</div>
			<div class="data-edit-handle">
				<div class="handle-left">
					<input type="reset" class="data-reset-button" value="清空" />
				</div>
				<div class="handle-right">
					<input type="submit" class="data-submit-button" name="suggest_form_submit" value="提交" />
				</div>
			</div>
		</form>
	</div>
</div>
