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
	<div>
		<p style="line-height:30px;font-size:18px;color:#409E1E;text-align:center;"><span style="color:red;">请使用微信访问</span>，扫描下方二维码即可关注公众号</p>
	</div>
	<div class="Center-Block Absolute-Center is-Fixed" style="width:320px;padding-bottom:100px;">
		<div id="qrcode_user" class="Center-Content"><a href="<?php echo SYS_HOST;?>public/static/image/wap/QRCode/QR-code.jpg" class="img-gallery"><img src="<?php echo SYS_HOST;?>public/static/image/wap/QRCode/QR-code.jpg" style="max-width:100%;"/></a></div>
	</div>
</div>
