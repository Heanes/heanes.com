<?php
/**
 * @doc
 * @filesource commingSoon.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.10 010
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<div class="main-content w-wrap" style="background:#fff;">
	<style type="text/css">
		body{margin:0;padding:0;font-family: "微软雅黑", Arial, "Trebuchet MS", Helvetica, Verdana, serif;font-size:16px}
		.button a{text-decoration:none;color:#1064A0}
		.button a:hover{color:#0078D2}
		.introduce img{border:none}
		h1,h2,h3,h4{margin:0;font-weight:normal;font-family: "微软雅黑", Arial, "Trebuchet MS", Helvetica, Verdana, serif}
		h1{line-height:60px;font-size:44px;color:#0188DE;padding:20px 0 10px 0}
		h2{color:#0188DE;font-size:16px;padding:10px 0 40px 0}
		.button{margin-top:10px;text-align:center;padding-bottom:30px;}
		.button a{width:180px;height:28px;line-height:28px;display:inline-block;font-size:14px;color:#fff;background:#009CFF;border-bottom:4px solid #0188DE;}
		.button a:hover{background:#5BBFFF}
		.introduce,.button{text-align:center;}
		@media screen and (min-width:320px) and (max-width:374px){}
		@media screen and (min-width:375px) and (max-width:413px){}
		@media screen and (min-width:414px) and (max-width:479px){}
		@media screen and (min-width:480px) and (max-width:639px){.w-wrap{max-width:600px}}
		@media screen and (min-width:640px) and (max-width:767px){.w-wrap{max-width:600px}}
		@media screen and (min-width:767px) and (max-width:1139px){.w-wrap{max-width:600px}}
		@media screen and (min-width:1139px) and (max-width:1366px){.w-wrap{max-width:600px}}
		@media screen and (min-width:1366px){.w-wrap{max-width:600px}}
	</style>
	<div class="introduce">
		<img src="<?php echo SYS_HOST;?>public/static/image/common/comming-soon.png">
	</div>
	<div class="button">
		<a href="javascript:history.go(-1)" title="返回" target="_self">敬请期待</a>
	</div>
</div>
