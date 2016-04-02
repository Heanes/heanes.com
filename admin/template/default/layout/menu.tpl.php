<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/reset/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo SYS_HOST ?>public/static/libs/css/base/base.css" />
	<base href="<?php echo TPL; ?>" />
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<title>左侧菜单</title>
</head>
<body>
<div class="menu_ul">
	<ul id="list">
		<?php foreach ($output['menuList'] as $key => $menu) {?>
		<li <?php if($key==0) echo 'class="li_current"';?>><p><img src="image/layout/menu/fire.jpg" /><?php echo $menu['menu_name'];?></p></li>
		<?php }?>
	</ul>
</div>
<div class="menu_list">
	<div class="menu_content" id="menu_content">
		<?php foreach ($output['menuList'] as $key => $sub1_menu) {?>
		<div class="fct">
			<div class="head"><?php echo $sub1_menu['menu_name'];?><em class="lap" title="折叠全部"></em></div>
			<?php foreach ($sub1_menu['sub_menu'] as $sub1_key => $sub2_menu) {?>
			<div class="box">
				<dl class="box_dl">
					<dt><a title=""><?php echo $sub2_menu['menu_name'];?></a></dt>
					<?php foreach ($sub2_menu['sub_menu'] as $sub2_key => $sub3_menu) {?>
					<dd><a href="<?php echo BASE_URL.'index.php?act='.$sub3_menu['menu_action'].'&op='.$sub3_menu['menu_op'];?>" target="conframe"><?php echo $sub3_menu['menu_name'];?></a></dd>
					<?php }?>
				</dl>
			</div>
			<?php }?>
		</div>
		<?php }	?>
	</div>
</div>
<!-- js S -->
<script type="text/javascript" src="<?php echo SYS_HOST ?>public/static/libs/js/jquery/2.1.4/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<!-- js E -->
</body>
</html>