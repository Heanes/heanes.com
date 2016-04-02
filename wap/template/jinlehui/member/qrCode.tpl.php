<?php
/**
 * @doc js生成二维码
 * @filesource qrCode.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.23 023
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<style type="text/css">
	.Center-Block {
		color: #FFF;
	}
	.Absolute-Center{
		height:50%;
		width:50%;
		margin:auto;
		position:absolute;
		top:0;
		left:0;
		bottom:0;
		right:0;
	}
	.Absolute-Center.is-Fixed {
		position: fixed;
		z-index: 999;
	}
	.Center-Content{
		text-align:center;
	}
</style>
<div class="main-content w-wrap">
	<div class="Center-Block Absolute-Center is-Fixed" style="width:300px;padding-bottom:100px;">
		<div id="qrcode_user" class="Center-Content"></div>
	</div>
</div>

<script type="text/javascript" src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/jQuery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script>
	jQuery('#qrcode_user').qrcode({
		text: "<?php echo $output['targetUrl']?>",
		width: '250',
		height: '250'
	});
</script>
