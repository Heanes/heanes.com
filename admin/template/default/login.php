<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap/3.2.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/base/base.css"/>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
<title>{$title}</title>
</head>
<body>
	<div id="clouds" class="stage"></div>
	<input type="hidden" id="user_name" value="image/chur/"/><!-- 蒲公英漂浮图片路径 -->
    <div class="loginmain"></div>
	<form action="login.php?act=login" method="post">
	    <div class="admin_login_box">
	        <h1>百兴贷后台管理系统</h1>
	        <!-- 
	        <table>
	        	<thead>
	        		<tr>
	        			<td colspan="2">百兴贷后台管理系统</td>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr>
	        			<td>帐号：</td>
	        			<td><input type="text"></td>
	        		</tr>
	        		<tr>
	        			<td>密码：</td>
	        			<td><input type="text"></td>
	        		</tr>
	        		<tr>
	        			<td>验证码：</td>
	        			<td style="vertical-align: middle;">
	        				<input type="text" style="width: 50px">
	        				<img style="vertical-align: middle; height:25px " src="../source/include/captcha.php" id="code" onclick="changeCode('code')"/>
	        			</td>
	        		</tr>
	        	</tbody>
	        </table>
	         -->
	        <p>
	            <label>帐&nbsp;&nbsp;&nbsp;号：<input type="text" id="admin_keyword" name="user_name" value="请输入管理员账号" /></label>
	        </p>
	        <p>
	            <label>密&nbsp;&nbsp;&nbsp;码：<input type="text" id="keypwd" name="user_pass" value="请输入密码" /></label>
	        </p>
	        <p>
	            <label>
	            	验证码：
	            	<input type="text" id="captcha_code" name="captcha_code" maxlength="4" class="code"/>
		            <img src="/source/instance/captcha.inst.php" id="code" onclick="changeCaptchaCode('code')"/>
	            </label>
	        </p>
	        <!--<p class="tip" id="note_info">&nbsp;</p>-->
			<p>
			<label><span id="note_info" style="color: red"></span></label>
	        </p>
	        <hr />
	        <input type="submit" value=" 登 录 " class="btn btn-primary btn-large login" id="login" />&nbsp;&nbsp;&nbsp;
	        <input type="button" value=" 取 消 " class="btn btn-large" />
	    </div>
    </form>
    <!-- js S -->
	<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="js/jquery.spritely-0.6.8.js"></script><!-- 云层效果 -->
	<script type="text/javascript" src="js/effect.js"></script><!--  -->
	<script type="text/javascript" src="js/chur.min.js"></script><!-- 蒲公英漂浮效果 -->
	<script type="text/javascript" src="js/common/common.js"></script>
	<script type="text/javascript" src="js/input.js"></script>
	<!-- js E -->
</body>
</html>