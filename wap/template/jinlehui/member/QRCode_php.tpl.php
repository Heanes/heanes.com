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
		color:#FFF;
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
	<div class="Center-Block Absolute-Center is-Fixed clearfix" style="width:100%;padding-bottom:100px;">
		<!--<div id="qrcode_user" class="Center-Content"><a href="<?php /*echo $output['QRCode_src'];*/?>" class="_img-gallery qr-code"><img src="<?php /*echo $output['QRCode_src'];*/?>" /></a></div>-->
		<div id="qrcode_user" class="Center-Content"><img src="<?php echo $output['QRCode_src'];?>" /></div>
	</div>
</div>
