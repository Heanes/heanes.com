<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=navigation&op=update';?>" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="navigation_id" readonly value="<?php echo $output['navigation']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['navigation']['sort'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>导航栏名称</th>
				<td><input type="text" name="navigation_name" value="<?php echo $output['navigation']['name'];?>" style="width:60%;"></td>
				<th>上级导航名称</th>
				<td>
					<select name="parent_id">
						<option value="0">顶级</option>
						<?php foreach ($output['navigationArr'] as $key => $navigationArr) {?>
							<option value ="<?php echo $navigationArr['id'];?>" <?php if($navigationArr["id"]==$output['navigation']['parent_id']) { ?> selected="selected"<?php  } ?> ><?php echo $navigationArr['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>导航链接</th>
				<td><input type="text" name="a_href" value="<?php echo $output['navigation']['a_href'];?>" style="width:60%;"></td>
				<th>链接title</th>
				<td><input type="text" name="a_title" value="<?php echo $output['navigation']['a_title'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>导航链接打开方式</th>
				<td>
					<input type="radio" name="a_target" value="1" <?php if($output['navigation']['a_target']=='1'){?>checked="checked" <?php }?>> 新窗口
					<input type="radio" name="a_target" value="0" <?php if($output['navigation']['a_target']=='0'){?>checked="checked" <?php }?>> 原窗口
				</td>
				<th>导航链接图标地址</th>
				<td><input type="text" name="img_src" value="<?php echo $output['navigation']['img_src'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>导航创建时间</th>
				<td><input type="text" name="navigation_create_time" id="navigation_create_time1" value="<?php echo to_date($output['navigation']['create_time']);?>" placeholder="选择创建时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>导航更新时间</th>
				<td><input type="text" name="navigation_update_time" id="navigation_create_time2" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>导航链接图标激活样式地址</th>
				<td><input type="text" name="img_src_hover" value="<?php echo $output['navigation']['img_src_hover'];?>" style="width:60%;"></td>
				<th>激活样式链接库(控制器名称)</th>
				<td><input type="text" name="href_in_hover" value="<?php echo $output['navigation']['href_in_hover'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['navigation']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['navigation']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['navigation']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['navigation']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=navigation';?>" class="btn btn-large">取消</a>
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
				"navigation_name":/[\w\W]+/,
				"a_href":/^(\w+:\/\/)?\w+(\.\w+)+.*$/
			}
		});
		demo.addRule([{
			ele:'input[name="navigation_name"]',
			datatype:"navigation_name",
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