<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=navigationWap&op=insert';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="4"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="wap_id" readonly value="<?php echo $output['lastID'];?>"></td>
			<th>排序</th>
			<td><input type="text" name="order" value=""></td>
		</tr>
		<tr>
			<th>父导航名称</th>
			<td>
				<select name="parent_id">
					<option value="0">顶级</option>
					<?php foreach ($output['navigationWapArr'] as $key => $navigationWapArr) {?>
						<option value ="<?php echo $navigationWapArr['id'];?>"><?php echo $navigationWapArr['name'];?></option>
					<?php }?>
				</select>
			</td>
			<th><span class="need">*</span>导航栏名称</th>
			<td><input type="text" name="navigation_wap_name" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>导航链接</th>
			<td><input type="text" name="a_href" value="" style="width:60%;"></td>
			<th>链接title</th>
			<td><input type="text" name="a_title" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>导航链接打开方式</th>
			<td>
				<input type="radio" name="a_target" value="1" checked> 新窗口
				<input type="radio" name="a_target" value="0"> 原窗口
			</td>
			<th>导航链接图标地址</th>
			<td><input type="text" name="img_src" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>链接图标激活样式地址</th>
			<td><input type="text" name="img_src_hover" value="" style="width:60%;"></td>
			<th>激活样式链接库(控制器名称)</th>
			<td><input type="text" name="href_in_hover" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>导航创建时间</th>
			<td><input type="text" name="create_time" id="create_time1" value="<?php echo to_date('now');?>" placeholder="选择创建时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>导航更新时间</th>
			<td><input type="text" name="update_time" id="update_time2" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否启用</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked> 显示
				<input type="radio" name="is_enable" value="0" > 不显示
			</td>
			<th>是否删除</th>
			<td>
				<input type="radio" name="is_delete" value="1"> 是
				<input type="radio" name="is_delete" value="0" checked> 否
			</td>
		</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=navigationWap';?>" class="btn btn-large">取消</a>
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
		var demo=$(".input-condensed").Validform({
			tiptype:3,
			datatype:{//传入自定义datatype类型【方式二】;
				"navigation_wap_name":/[\w\W]+/,
				"a_href":/^(\w+:\/\/)?\w+(\.\w+)+.*$/
			}
		});
		demo.addRule([{
			ele:'input[name="navigation_wap_name"]',
			datatype:"navigation_wap_name",
			nullmsg:'导航栏名称不能为空！'
		}]);
		demo.addRule([{
			ele:'input[name="a_href"]',
			datatype:"a_href",
			errormsg:'导航链接格式不对！',
			ignore:'ignore'
		}]);
	});
</script>
