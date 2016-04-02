<?php
/**
 * @filesource index.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-09 14:39:18
 * @doc 默认模版首页
 */
?>
<?php defined('InHeanes') or exit('Access Invalid!');?>
<html>
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" href="<?php echo SYS_HOST;?>data/upload/image/web/favicon.ico" />
<link rel="bookmark" href="<?php echo SYS_HOST;?>data/upload/image/web/favicon.ico" />
<title>默认首页</title>
</head>
<body>
	<header>
		<div>
			<p>头部<?php //var_dump($output);?></p>
			<p><?php echo $output['from_behind'];?></p>
			<p><?php echo json_decode($output['from_behind_json'],true);?></p>
			<form enctype="application/json" action="index.php?act=index&op=accept_post" method="post" id="submit1">
				<input name="inpupt_data" type="text" value="请输入数据" />
				<input type="submit" />
			</form>
		</div>
		<script type="text/javascript">
			var submit1=document.getElementById('submit1');
			submit1.onsubmit=function(){
				console.log('aaa');
			}
		</script>
	</header>
</body>
</html>