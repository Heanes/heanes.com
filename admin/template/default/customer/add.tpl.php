<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=customer&op=insert';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="customer_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th><span class="need">*</span>关系人主</th>
			<td><input type="text" name="uid_master" id="master-name" value="请选择关系人主" onclick="popMaster()">
				<div id="choose-box-wrapper1" onmouseover='Move_obj("choose-box-wrapper1")'>
					<div id="choose-box1">
						<div class="choose-box-title"><span>选择关系人主</span></div>
						<div id="choose-a-name1"></div>
						<div class="choose-box-bottom">
							<input type="botton" onclick="hide1()" value="关闭" />
						</div>
					</div>
				</div>
				<script type="text/javascript">
					//DIV弹框
					function initUidMaster()
					{
						var html='';
						html+='<?php foreach ($output["users_list"] as $key => $users) {?>';
						html+='<a class="user-item1" user-id1="<?php echo $users["id"]?>"><?php echo $users["user_name"]?></a>';
						html+='<?php }?>';
						$('#choose-a-name1').append(html);
						//添加关系人主列表项的click事件
						$('.user-item1').bind('click', function(){
								var item=$(this);
								var uid_master = item.attr('user-id1');
								//更新选择关系人主文本框中的值
								$('#master-name').val(item.text());
								//关闭弹窗
								hide1();
							}
						);
					}
				</script>
			</td>
		</tr>
		<tr>
			<th><span class="need">*</span>关系人客</th>
			<td><input type="text" name="uid_slave" id="slave-name" value="请选择关系人客" onclick="popSlave()">
				<div id="choose-box-wrapper2" onmouseover='Move_obj("choose-box-wrapper2")'>
					<div id="choose-box2">
						<div class="choose-box-title"><span>选择关系人客</span></div>
						<div id="choose-a-name2"></div>
						<div class="choose-box-bottom">
							<input type="botton" onclick="hide2()" value="关闭" />
						</div>
					</div>
				</div>
				<script type="text/javascript">
					//DIV弹框
					function initUidSlave()
					{
						var html='';
						html+='<?php foreach ($output["users_list"] as $key => $users) {?>';
						html+='<a class="user-item2" user-id2="<?php echo $users["id"]?>"><?php echo $users["user_name"]?></a>';
						html+='<?php }?>';
						$('#choose-a-name2').append(html);
						//添加关系人主列表项的click事件
						$('.user-item2').bind('click', function(){
								var item=$(this);
								var uid_slave = item.attr('user-id2');
								//更新选择关系人主文本框中的值
								$('#slave-name').val(item.text());
								//关闭弹窗
								hide2();
							}
						);
					}
				</script>
			</td>
			<th>关系类型</th>
			<td>
				<select name="ship_type">
					<option value="">请选择</option>
					<option value="1">好友</option>
					<option value="2">客户/业务</option>
					<option value="3">客户/兼职</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>关系状态</th>
			<td>
				<select name="status">
					<option value="">请选择</option>
					<option value ="0">审核中</option>
					<option value ="1">已通过</option>
					<option value ="2">已拒绝</option>
				</select>
			</td>
			<th>插入时间</th>
			<td><input type="text" name="customer_insert_time" id="customer_insert_time1" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>更新时间</th>
			<td><input type="text" name="customer_update_time" id="customer_update_time2" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>是否立即递交申请</th>
			<td>
				<input type="radio" name="apply_now" value="1"> 是
				<input type="radio" name="apply_now" value="0" checked="checked"> 否
			</td>
		</tr>
		<tr>
			<th>是否有效</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked="checked"> 是
				<input type="radio" name="is_enable" value="0"> 否
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1"> 是
				<input type="radio" name="is_delete" value="0" checked="checked"> 否
			</td>
		</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=customer';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>admin/template/default/js/mouseDrag.js"></script><!-- DIV弹框和鼠标拖拽事件 -->