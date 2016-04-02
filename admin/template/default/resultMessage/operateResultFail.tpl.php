<div class="message_result">
	<div class="margin10"></div>
	<div class="message_result_failed">
		<h3><?php echo $output['message'];?></h3>
		<hr/>
		<fieldset>
			<legend>失败原因</legend>
			<em>某某原因</em>
		</fieldset>
		<p>接下来请选择跳转，若不做选择将自动返回…
			<a href="<?php echo $output['ref_url'];?>">返回</a><b style="border-right:1px solid #888;margin:0 5px;"></b><a href="javascript:;">继续编辑</a>
		</p>
	</div>
</div>