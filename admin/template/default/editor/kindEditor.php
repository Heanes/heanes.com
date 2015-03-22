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
<title>kindEditor</title>
<link rel="stylesheet" href="../js/editor/kindeditor/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="../css/reset/reset.css"/>
<link rel="stylesheet" type="text/css" href="../css/base/base.css"/>
</head>
<body>
	<div class="padding0 border0">
		<!-- KindEditor是根据textarea的名称来实例化的 -->
		<textarea name="{$editor_name}" style="width:670px;height:400px;visibility:hidden;"></textarea>
		<p>
			您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br />
			您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
		</p>
	</div>
	<cite>
		<!-- js S -->
		<script charset="utf-8" src="../js/editor/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="../js/editor/kindeditor/lang/zh_CN.js"></script>
		<script>
			KindEditor.ready(function(K) {
				K.create('textarea[name="{$editor_name}"]', {
					afterChange : function() {
						K('.word_count1').html(this.count());
						K('.word_count2').html(this.count('text'));
					}
				});
			});
		</script>
		<!-- js E -->
	</cite>
</body>
</html>



