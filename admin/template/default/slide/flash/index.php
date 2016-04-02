<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>flash上传并裁剪头像-李明的博客http://www.com133.com/</title>
<style>
a{color:#3b5998;}
</style>
<script type="text/javascript">
		
		//保存缩略图的地址.
		var saveUrl = 'save_avatar.php';
		//保存摄象头白摄图片的地址.
		var cameraPostUrl = 'camera.php';
		//头像编辑器flash的地址.
		var editorFlaPath = 'up/swf/AvatarEditor.swf';

			//一下是flash无刷新上传

		//配置当前路径 例如:http://local.com/up
		var baseurl = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['SCRIPT_NAME'],'/')); ?>';

				
</script>
</head>
<link href="up/css/upload.css" rel="stylesheet" type="text/css" />
<script type="text/javaScript" src="up/js/jquery.min.js"></script>
<script type="text/javascript" src="up/js/swfobject.js"></script>

<body >
<input type="button" value="点击上传头像" onclick="$('#info').show();"/>
来源:<a href="http://www.com133.com/" target="_blank" >李明的博客</a>
<span style="color:red;display:none;" id="msg">保存成功!</span>
<div style="width:600px;margin:0 auto;display:none;" id="info">
	<div>
		
		<div style="padding:10px 0;color:#666;">
		上传本地图片,或者<a style="color:#cc3300;" href="javascript:void(0);" onclick="useCamera()">使用摄像头拍照</a>
		</div>
		
		
		
		<!-- 头像flash 无刷新上传开始 -->
		<input type="hidden" name="dosubmit" value="1" />
		<input type="hidden" name="fsize" id="fsize" value="">
		<input type="hidden" name="forward" value="">
		<input type="hidden" name="uuid" value="1">
		<input type="hidden" id="video_uploader" value="0">
	
				<table>
					<tr>
						<td><div id="uploadp"></div></td>
						<td><div id="upload_flash_video"></div>  </td>
						<td><div id="filesize"></div></td>
					</tr>
				</table>
		<!-- /头像flash 无刷新上传结束 -->
		
		
		<div id="avatar_editor"></div>
		
	</div>
</div>
<script type="text/javascript" src="up/js/upload.js"></script>
</body>

</html>
