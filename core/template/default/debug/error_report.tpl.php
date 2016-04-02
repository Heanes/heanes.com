<?php
/**
 * @doc 显示error_report信息
 * @filesource error_report.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-01 16:58:50
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<html>
<head>
<title>error_report页面-核心框架页面</title>
<style type="text/css">
.sys-fix-debug{
	position:fixed;left:0;bottom:0;font:12px/1.3 sans-serif;
	z-index:100;opacity:1;filter:Alpha(opacity=60);_background-color:rgba(200,225,226,0.5);_background:rgba(241,247,253,0.5);
	border-bottom-right-radius:5px;border-top-right-radius:5px;_border:1px solid rgba(4,26,253,0.17);
}
.sys-fix-debug-hide{left:-300px;overflow:hidden;background-color:rgba(0,23,255,0.22);cursor:pointer;}
.sys-fix-debug table{border-spacing:0;border-collapse:collapse;}
.sys-fix-debug table td{padding:0;text-align:left;}
.sys-debug-content::-webkit-scrollbar{width:5px;}
.sys-debug-content::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.3);_-webkit-border-radius:10px;_border-radius:10px}
.sys-debug-content::-webkit-scrollbar-thumb{background:rgba(0,23,255,0.31);_-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.5);_-webkit-border-radius:10px;_border-radius:10px;}
.sys-debug-content{float:left;padding:6px;margin:0;overflow:auto;max-height:655px;background:rgba(241,247,253,0.5);font-size:12px;}
.sys-debug-content ul,.sys-debug-content ul li{padding:0;margin:0;list-style:none;}
.sys-debug-content p{padding:2px;margin:0;}
.debug-control-show p{margin:2px 0;}
.debug-control-show p:last-child{margin:0;}
.debug-no-transparency,
.debug-transparency-switch,
.debug-transparency,
.sys-lap-debug{
	width:10px;display:inline-block;text-align:center;
	cursor:pointer;border:1px solid rgba(31,199,58,0.3);
	font-size:12px;font-weight:normal;
	_border-bottom-right-radius:5px;_border-top-right-radius:5px;
}
.debug-no-transparency{background:rgba(10,44,107,0.5);}
.debug-transparency{background:rgba(149,218,171,0.3);}
.debug-transparency-switch{background:rgba(145,128,9,0.3);}
.debug-title{font-weight:bold;}
.sys-lap-debug{height:35px;line-height:35px;background:rgba(12,137,42,0.3);}
.sys-lap-debug-off{left:0}
.notice,.warning,.error{border:1px solid;}
.notice{color:#062398;background:#E8E8E8;border-color:#EABFBF;}
.warning{color:rgb(173,98,98);background:#F4DFDF;border-color:#ABABAB;}
.error{color:red;background:red;border-color:#EABFBF;}
.p-sub{padding-left:50px;}
</style>
</head>
<body>
	<div class="sys-fix-debug" id="sys_fix_debug">
		<table>
			<tbody>
				<tr>
					<td>
						<div class="sys-debug-content" id="sys_debug_content" style="display:none;">
							<?php if (count($output['error_report']['debug'])) {?>
							<!-- S debug信息输出 S -->
							<div class="sys-error-report-info">
								<p class="debug-title">error_report信息</p>
								<ul>
									<?php
									foreach ($output['error_report']['debug'] as $error) {
										foreach ($error as $key => $value) {
											if ($key=='errortype'&&$value=='Notice') {?>
										<li class="notice">
											<p><span style="color:blue;"><?php echo $value;?></span>：<?php echo $error['errorstr'];?></p>
											<p class="p-sub">line <?php echo $error['errline'];?> on <?php echo $error['errfile'];?></p>
										</li>
											<?php }else if ($key=='errortype'&&$value=='Warning') {?>
										<li class="warning">
											<p><?php echo $value;?>：<?php echo $error['errorstr'];?></p>
											<p class="p-sub"><?php echo $error['errline'];?> on <?php echo $error['errfile'];?></p>
										</li>
											<?php }else if ($key=='errortype'&&$value=='Error') {?>
										<li class="Error">
											<p><?php echo $value;?>：<?php echo $error['errorstr'];?></p>
											<p class="p-sub"><?php echo $error['errline'];?> on <?php echo $error['errfile'];?></p>
										</li>
											<?php }else if ($key=='errortype'&&$value=='Runtime Notice') {?>
										<li class="Runtime Notice">
											<p><?php echo $value;?>：<?php echo $error['errorstr'];?></p>
											<p class="p-sub"><?php echo $error['errline'];?> on <?php echo $error['errfile'];?></p>
										</li>
											<?php }?>
										<?php }?>
									<?php }?>
								</ul>
							</div>
							<!-- E debug信息输出 E -->
							<?php }?>
							<?php if (count($output['error_report']['exception'])) {?>
							<!-- S exception信息输出 S -->
							<div class="sys-exception-info">
								<p class="debug-title">Exception信息</p>
								<ul>
									<?php foreach ($output['error_report']['exception'] as $key => $exception) {?>
										<li class="notice">
											<p><?php echo sprintf('%02d',$key+1);?>. <span style="color:blue;"><?php echo $exception;?></span></p>
										</li>
									<?php }?>
								</ul>
							</div>
							<!-- E exception信息输出 E -->
							<?php }?>
							<?php if (count($output['error_report']['sql'])) {?>
								<!-- S 运行过的SQL语句 S -->
								<div class="sys-sql-list">
									<p class="debug-title">SQL语句</p>
									<p>共执行<strong><?php echo count($output['error_report']['sql']['log']);?></strong>条SQL，总共耗时 <?php echo sprintf('%.4f',$output['error_report']['sql']['total']);?>秒</p>
									<ul>
										<?php foreach ($output['error_report']['sql']['log'] as $key => $sql) {?>
												<li class="">
													<p><?php echo sprintf('%02d',$key+1);?>. <span style="color:blue;"><?php echo $sql['sql'];?></span>
														耗时 <?php echo sprintf('%.4f',$sql['time']);?>秒</p>
												</li>
										<?php }?>
									</ul>
								</div>
								<!-- E 运行过的SQL语句 E -->
							<?php }?>
							<?php if (count($output['error_report']['included_file'])) {?>
							<!-- S included_file信息输出 S -->
							<div class="sys-exception-info">
								<p class="debug-title">Included_file信息</p>
								<ul>
									<?php foreach ($output['error_report']['included_file'] as $key => $included_file) {?>
										<li class="">
											<p><?php echo sprintf('%02d',$key+1);?>. <span style="color:blue;"><?php echo $included_file;?></span></p>
										</li>
									<?php }?>
								</ul>
							</div>
							<!-- E included_file信息输出 E -->
							<?php }?>
							<?php if (count($output['error_report']['defined_constant'])) {?>
							<!-- S defined_constant信息输出 S -->
							<div class="sys-exception-info">
								<p class="debug-title">Defined_constant_user信息</p>
								<ul>
									<?php $i=0;foreach ($output['error_report']['defined_constant'] as $key => $defined_constant) {?>
										<li class="">
											<p><?php echo sprintf('%02d',++$i);?>. <?php echo $key;?> = <span style="color:blue;"><?php echo $defined_constant;?></span></p>
										</li>
									<?php }?>
								</ul>
							</div>
							<!-- E defined_constant信息输出 E -->
							<?php }?>
							<?php if (count($output['error_report']['defined_function'])) {?>
							<!-- S defined_function信息输出 S -->
							<div class="sys-exception-info">
								<p class="debug-title">Defined_function信息</p>
								<ul>
									<?php foreach ($output['error_report']['defined_function'] as $key => $defined_function) {?>
										<li class="">
											<p><?php echo sprintf('%02d',$key+1);?>. <span style="color:blue;"><?php echo $defined_function;?></span></p>
										</li>
									<?php }?>
								</ul>
							</div>
							<!-- E Defined_function信息输出 E -->
							<?php }?>
							<?php if ($output['error_report']['debug_backtrace']) {?>
							<!-- S 运行过的Debug_backtrace信息 S -->
							<div class="sys-sql-list">
								<p class="debug-title">debug_backtrace信息</p>
								<ul>
									<li class="">
										<p><?php var_dump($output['error_report']['debug_backtrace']);?></p>
									</li>
								</ul>
							</div>
							<!-- E 运行过的Debug_backtrace新年系 E -->
							<?php }?>
							<!-- 总体耗时 -->
							<p>系统总共耗时<?php echo $output['system_core_report']['total_elapsed_time']?>秒</p>
						</div>			
					</td>
					<td class="debug-control-show">
						<p><b class="debug-no-transparency" id="debug_no_transparency">+</b></p>
						<p><b class="debug-transparency" id="debug_transparency">-</b></p>
						<p><b class="debug-transparency-switch" id="debug_transparency_switch">/</b></p>
						<p><b class="sys-lap-debug sys-lap-debug-off" id="sys_lap_debug">></b></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		//点击隐藏
		var fixDebug=document.getElementById('sys_lap_debug');
		fixDebug.onclick=function(){
			var showContent=document.getElementById('sys_debug_content');
			if(this.className == 'sys-lap-debug'){
				showContent.style.display='none';
				this.className = 'sys-lap-debug sys-lap-debug-off';
				this.innerHTML='>';
			}else if(this.className == 'sys-lap-debug sys-lap-debug-off'){
				showContent.style.display='block';
				this.className = 'sys-lap-debug';
				this.innerHTML='<';
			}
		};

		//透明度点击渐变
		var transparency=5;
		var debug_no_transparency=document.getElementById('debug_no_transparency');
		debug_no_transparency.onclick=function(){
			var value=transparency/10;
			document.getElementById('sys_debug_content').style.background='rgba(241,247,253,'+value+')';
			if(transparency<10){
				transparency++;
			}
		};
		//双击迅速不透明
		debug_no_transparency.ondblclick=function(){
			document.getElementById('sys_debug_content').style.background='rgba(241,247,253,1)';
			transparency=10;
		};
		var debug_transparency=document.getElementById('debug_transparency');
		debug_transparency.onclick=function(){
			var value=transparency/10;
			document.getElementById('sys_debug_content').style.background='rgba(241,247,253,'+value+')';
			if(transparency>0){
				transparency--;
			}
		};
		//双击迅速透明
		debug_transparency.ondblclick=function(){
			document.getElementById('sys_debug_content').style.background='rgba(241,247,253,0.5)';
			transparency=1;
		};
		//单击透明度切换
		var debug_transparency_switch=document.getElementById('debug_transparency_switch');
		debug_transparency_switch.onclick=function(){
			var original_style=document.getElementById('sys_debug_content').style.background;
			var transparentcy_style='rgba(241,247,253,0)';
			var un_transparentcy_style='rgb(241, 247, 253)';
			//console.log(original_style);
			if(original_style != un_transparentcy_style){
				document.getElementById('sys_debug_content').style.background=un_transparentcy_style;
				transparency=10;
			}else{
				document.getElementById('sys_debug_content').style.background=transparentcy_style;
				transparency=1;
			}
			//console.log(transparency);
		}
	</script>
</body>
</html>