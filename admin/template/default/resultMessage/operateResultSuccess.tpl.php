<div class="message_result">
	<div class="message_result_success">
		<?php if (is_array($output['result'])) { ?>
		<?php } else { ?>
			<h3><?php echo $output['result']; ?></h3>
			<hr/>
			<p>接下来请选择跳转，若不做选择将自动返回…
				<a href="<?php echo $output['ref_url']; ?>">返回</a><b
					style="border-right:1px solid #888;margin:0 5px;"></b><a href="javascript:"></a>
			</p>
		<?php } ?>
	</div>
	<div class="margin10"></div>
</div>