<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=userBank&op=insert';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="bank_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th><span class="need">*</span>用户ID</th>
			<td>
			<select name="user_id" datatype="*" nullmsg="请选择用户名称！">
				<option value="">请选择</option>
				<?php foreach ($output['info'] as $key => $value) {?>
				<option value ="<?php echo $value['id'];?>"><?php echo $value['user_name'];?></option>
				<?php }?>
			</select>
			<span class="Validform_checktip"></span>
			</td>
		</tr>
		<tr>
			<th><span class="need">*</span>真实姓名</th>
			<td><input type="text" name="real_name" value="" datatype="z2-4" nullmsg="请输入真实姓名！" errormsg="真实姓名为2~4个中文字符！" style="width: 60%;">
				<span class="Validform_checktip">真实姓名为2~4个中文字符</span>
			</td>
			<th><span class="need">*</span>银行卡类型</th>
			<td>
			<select name="bank_id" datatype="*" nullmsg="请选择银行卡类型！">
				<option value="">请选择</option>
				<?php foreach ($output['type'] as $key => $value) {?>
				<option value ="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
				<?php }?>
			</select>
			<span class="Validform_checktip"></span>
			</td>
		</tr>
		<tr>
			<th><span class="need">*</span>银行卡号</th>
			<td><input type="text" name="bank_no" value="" class="inputxt" datatype="n16-19" nullmsg="请输入银行卡号！" errormsg="银行卡号为16~19位数字！" style="width: 60%;">
				<span class="Validform_checktip">银行卡号为16~19位数字</span>
			</td>
			<th>开户行地点</th>
			<td><input type="text" name="account_bank_address" value="" style="width: 60%;"></td>
		</tr>
		<tr>
			<th>上传时间</th>
			<td><input type="text" name="userbank_create_time" id="userbank_create_time1" value="<?php echo to_date('now');?>" placeholder="选择上传时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>更新时间</th>
			<td><input type="text" name="userbank_update_time" id="userbank_create_time2" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否有效</th>
			<td colspan="3">
				<input type="radio" name="is_enable" value="1" checked> 是
				<input type="radio" name="is_enable" value="0" > 否
			</td>
		</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=userBank';?>" class="btn btn-large">取消</a>
		</div>
		<div class="handle-field">
			<input type="submit" value="保存" class="btn btn-primary btn-large" />
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->
<script type="text/javascript">
$(function(){
	var demo=$(".submitform").Validform({
		tiptype:3,
		datatype:{//传入自定义datatype类型【方式二】;
			"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/
		}
	});
	demo.addRule([{
		ele:".inputxt:eq(3)",
		datatype:"n16-19"
	}]);
	
});
</script>