<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- 让IE8在新模式下渲染（禁止兼容模式） -->
<meta name="renderer" content="webkit"><!-- 让360等多核模式浏览器默认用极速模式打开 -->
<meta name="author" content="Heanes heanes.com email(heanes@163.com)">
<meta name="keywords" content="软件,商务,HTML,tutorials,source codes">
<meta name="description" content="描述">
<link rel="shortcut icon" href="/data/upload/image/web/favicon.ico"/>
<link rel="bookmark" href="/data/upload/image/web/favicon.ico"/>
<title>uEditor</title>
<link rel="stylesheet" type="text/css" href="../css/reset/reset.css"/>
<link rel="stylesheet" type="text/css" href="../css/base/base.css"/>
</head>
<body class="padding0 margin0">
	<div class="padding0 margin0">
		<textarea name="{$editor_name}" id="editor" style="width:780px;height:330px;">{$editor_value}</textarea>
	</div>
	<cite>
		<!-- js S -->
		<script type="text/javascript" charset="utf-8" src="../js/editor/ueditor/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="../js/editor/ueditor/ueditor.all.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="../js/editor/ueditor/lang/zh-cn/zh-cn.js"></script>
		<script type="text/javascript">
		    //实例化编辑器
		    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
		    var ue = UE.getEditor('editor');
		</script>
		<!-- js E -->
	</cite>
</body>
</html>