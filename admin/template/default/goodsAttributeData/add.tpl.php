<form action="<?php echo BASE_URL;?>index.php?act=GoodsAttributeData&op=insert" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">添加商品属性映射</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></td>
				<th>属性价格</th>
				<td><input type="text" name="fields_price" value=""></td>
			</tr>
			<tr>
				<th>属性名称</th>
				<td>
					<select name="fields_id">
						<option value="">请选择</option>
						<?php foreach ($output['goodsFields'] as $key => $goodsFields) {?>
						<option value ="<?php echo $goodsFields['id'];?>"><?php echo $goodsFields['name'];?></option>
						<?php }?>
					</select>
				</td>
				<th>商品名称</th>
				<td>
					<select name="goods_id">
						<option value="">请选择</option>
						<?php foreach ($output['goods'] as $key => $goods) {?>
						<option value ="<?php echo $goods['id'];?>"><?php echo $goods['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<th>商品属性值</th>
				<td colspan="4">
					<textarea class="editor_id1" name="fields_value"></textarea>
					<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor.js"></script>
					<script>
						var editor;
						KindEditor.ready(function(K) {
							editor = K.create('.editor_id1', {
								resizeType : 1,
								allowPreviewEmoticons : false,
								autoHeightMode : true,
								allowImageUpload : false,
								minWidth : 465,
								minHeight : 35,
								items : [
									"source","fontname", "fontsize", "|", "forecolor", "hilitecolor", "bold", "italic", "underline",
									"removeformat", "|", "justifyleft", "justifycenter", "justifyright", "insertorderedlist",
									"insertunorderedlist", "|", "emoticons", "image", "link"]
							});
						});
					</script>
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
				"fields_price":/^\d+$/
			}
		});
		demo.addRule([{
			ele:'input[name="fields_price"]',
			datatype:"fields_price",
			errormsg:'价格必须为数字！',
			ignore:'ignore'
		}]);
	});
</script>