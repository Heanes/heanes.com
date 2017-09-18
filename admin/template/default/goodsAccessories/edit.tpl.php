<form action="<?php echo BASE_URL;?>index.php?act=GoodsAccessories&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改商品配件</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="accessories_id" readonly value="<?php echo $output['goodsAccessories']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['goodsAccessories']['order'];?>"></td>
			</tr>
			<tr>
				<th>商品名称</th>
				<td>
					<select name="goods_id">
						<option value="">请选择</option>
						<?php foreach ($output['goodsList'] as $key => $goods) {?>
							<option value ="<?php echo $goods['id'];?>" <?php if($goods["id"]==$output['goodsAccessories']['goods_id']) { ?> selected="selected"<?php  } ?> ><?php echo $goods['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th><span class="need">*&nbsp;</span>配件名称</th>
				<td><input type="text" name="accessories_name" value="<?php echo $output['goodsAccessories']['name'];?>"></td>
			</tr>

			<tr>
				<th>添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date($output['goodsAccessories']['create_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td colspan="4">
					<input type="radio" name="is_enable" value="1" <?php if($output['goodsAccessories']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['goodsAccessories']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
		</tbody>
	</table>
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="javascript:history.go(-1)" class="btn btn-large">取消</a>
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
			datatype:{
				"accessories_name":/[\w\W]+/
			}
		});
		demo.addRule([{
			ele:'input[name="accessories_name"]',
			datatype:"accessories_name",
			nullmsg:'配件名称不能为空！'
		}]);
	});
</script>