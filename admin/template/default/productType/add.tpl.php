<form action="<?php echo BASE_URL;?>index.php?act=ProductType&op=insert" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">添加产品类型</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value=""></td>
			</tr>
			<tr>
				<th><span class="need">*</span>类型名称</th>
				<td colspan="4"><input type="text" name="type_name" value="" datatype="s2-18" errormsg="类型名称至少2个字符,最多18个字符！">
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date('now');?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" checked="checked"/>显示
					<input type="radio" name="is_enable" value="0" />不显示
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1"/>是
					<input type="radio" name="is_delete" value="0" checked="checked" />否
				</td>
			</tr>
			<tr>
			<th>类型备注</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="description" style="width:800px;height:400px;visibility:hidden;"></textarea>

				<p style="font-size:12px;">
					您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br />
					您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
				</p>
				<cite>
					<!-- js S -->
					<script charset="utf-8" src="<?php echo SYS_HOST; ?>public/static/libs/js/editor/kindEditor/kindeditor-min.js"></script>
					<script charset="utf-8" src="<?php echo SYS_HOST; ?>public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
					<script>
						KindEditor.ready(function (K) {
							K.create('textarea[name="description"]', {
								afterChange: function () {
									K('.word_count1').html(this.count());
									K('.word_count2').html(this.count('text'));
								}
							});
						});
					</script>
					<!-- js E -->
				</cite>
			</td>
		</tr>
		</tbody>
	</table>
	<!-- start 添加属性 -->
	<div class="data-list-table">
		<table class="table table-striped table-bordered table-condensed table-data-list" id="tab">
			<thead>
			<tr>
				<td colspan="15">添加产品属性</td>
			</tr>
			<tr>
				<th style="min-width: 24px;">选择</th>
				<th>
					<a href="javascript:listTable.sort('name', 'DESC');" title="点击对列表排序">属性名称<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('input_type', 'DESC');" title="点击对列表排序">属性输入类型<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('input_value', 'DESC');" title="点击对列表排序">输入备选值<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('value_unit', 'DESC');" title="点击对列表排序">值的单位<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('as_filter', 'DESC');" title="点击对列表排序">是否作为筛选条件<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('is_show', 'DESC');" title="点击对列表排序">是否显示在详细页<em class="triangle-down"></em></a>
				</th>
				<th>
					<a href="javascript:listTable.sort('allow_read_min_role_level', 'DESC');" title="点击对列表排序">允许查看的最小角色ID<em class="triangle-down"></em></a>
				</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<tr class="itme">
				<td style="text-align:center;" rowspan="2"><input name="check" type="checkbox"></td>
				<td style="text-align:center;height:76px;width:465px;"><textarea class="editor_id1" name="data[fields_attribute_name][]"></textarea>
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
				<td style="text-align:center;">
					<select name="data[fields_input_type][]">
						<option value="">请选择</option>
						<option value="text">text</option>
						<option value="select">select</option>
						<option value="textarea">textarea</option>
					</select>
				</td>
				<td style="text-align:center;"><input type="text" name="data[fields_input_value][]" value=""></td>
				<td style="text-align:center;"><input type="text" name="data[fields_value_unit][]" value=""></td>
				<td style="text-align:center;">
					<select name="data[fields_as_filter][]" style="width:54px;">
						<option value="1">是</option>
						<option value="0" selected>否</option>
					</select>
				</td>
				<td style="text-align:center;">
					<select name="data[fields_is_show][]" style="width:54px;">
						<option value="1" selected>是</option>
						<option value="0">否</option>
					</select>
				</td>
				<td style="text-align:center;">
					<select name="data[allow_read_min_role_level][]" style="width:120px;">
						<option value="">请选择</option>
						<?php foreach ($output['userRole'] as $userRole_key => $userRole) {?>
							<option value ="<?php echo $userRole['id'];?>"><?php echo $userRole['id'];?>—<?php echo $userRole['name'];?></option>
						<?php }?>
					</select>
				</td>
				<td style="text-align:center;" rowspan="2"><button class="btn btn-mini btn-danger" name="del">删除</button></td>
			</tr>
			<tr class="itme">
				<td style="text-align:left;" colspan="7">
					<div style="width: 120px; float: left; margin-right:-120px;"><strong>允许查看的角色:</strong></div>
					<?php foreach ($output['userRole'] as $key => $userRole) {?>
						<div style="float: left; width: 120px; margin-left:120px; ">
								<input class="checkbox" type="checkbox" value="<?php echo $userRole['id']?>" name="data[allow_read_role][0][]">
								<?php echo $userRole['name']?>
						</div>
					<?php }?>
				</td>
			</tr>
			</tbody>
		</table>
		<div><input type="button" name="add" class="btn-add" value="增加">&nbsp;&nbsp;<input type="button" name="delall" value="全部删除"></div>
	</div>
	<script type="text/javascript">
		$(function(){
			var insert_tr=1;
		    $(':button[name=add]').click(function(){
		        insertTr(insert_tr);
				insert_tr++;
		    });
			$('button[name=del]').click(function(){
				$(this).parents().parents().next().remove();  //注意执行先后顺序
				$(this).parents('tr').remove();
			});
		    $(':button[name=delall]').click(function(){
		        $('.itme').remove();
		    })
		});
		var gradeI=1;
		function insertTr(i){
		    var html='';
		    html+='<tr class="itme"><td style="text-align:center;" rowspan="2"><input name="check" type="checkbox"></td>';
		    html+='<td style="text-align:center;height:76px;width:465px;"><textarea class="editor_id2" name="data[fields_attribute_name][]"></textarea>';
			html+='<script type="text/javascript">';
			html+='var editor;KindEditor.ready(function(K){editor=K.create(".editor_id2",{resizeType:1,allowPreviewEmoticons:false,autoHeightMode:true,allowImageUpload:false,minWidth:465,minHeight:35,items:["source","fontname","fontsize","|","forecolor","hilitecolor","bold","italic","underline","removeformat","|","justifyleft","justifycenter","justifyright","insertorderedlist","insertunorderedlist","|","emoticons","image","link"]})});';
			html+='<\/script>';
			html+='</td>';
			html+='<td style="text-align:center;">';
				html+='<select name="data[fields_input_type][]">';
					html+='<option value="">请选择</option>';
					html+='<option value="text">text</option>';
					html+='<option value="select">select</option>';
					html+='<option value="textarea">textarea</option>';
				html+='</select>';
			html+='</td>';
			html+='<td style="text-align:center;"><input type="text" name="data[fields_input_value][]" value=""></td>';
		    html+='<td style="text-align:center;"><input type="text" name="data[fields_value_unit][]" value=""></td>';
			html+='<td style="text-align:center;"><select name="data[fields_as_filter][]" style="width:54px;"><option value="1">是</option><option value="0" selected>否</option></select></td>';
			html+='<td style="text-align:center;"><select name="data[fields_is_show][]" style="width:54px;"><option value="1" selected>是</option><option value="0">否</option></select></td>';
			html+='<td style="text-align:center;">';
				html+='<select name="data[allow_read_min_role_level][]" style="width:120px;">';
					html+='<option value="">请选择</option>';
					html+='<?php foreach ($output["userRole"] as $userRole_key => $userRole) {?>';
						html+='<option value ="<?php echo $userRole['id'];?>"><?php echo $userRole["id"];?>—<?php echo $userRole['name'];?></option>';
					html+='<?php }?>';
				html+='</select>';
			html+='</td>';
		    html+='<td style="text-align:center;" rowspan="2"><button class="btn btn-mini btn-danger" name="del">删除</button></td></tr>';
			html+='<tr class="itme"><td style="text-align:left;" colspan="7">';
				html+='<div style="width: 120px; float: left; margin-right:-120px;"><strong>允许查看的角色:</strong></div>';
				html+='<?php foreach ($output["userRole"] as $key => $userRole) {?>';
					html+='<div style="float: left; width: 120px; margin-left:120px;">';
						html+='<input class="checkbox" type="checkbox" value="<?php echo $userRole['id']?>" name="data[allow_read_role]['+i+'][]">';
						html+='<?php echo $userRole["name"]?>';
					html+='</div>';
				html+='<?php }?>';
			html+='</td>';
			html+='</tr>';
		    $('#tab').append(html);
		    $('button[name=del]').click(function(){
				$(this).parents().parents().next().remove();  //注意执行先后顺序
				$(this).parents('tr').remove();
			});
		    gradeI++;
		}
	</script>
	<!-- end 添加属性 -->
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
	$(".submitform").Validform({
		tiptype:3
	});
});
</script>
<style>
	.btn-add {
	    background: url("image/formstyle/bg_position.gif") no-repeat scroll 0 -718px;
	    float: left;
	    padding-left: 19px;
	    margin-left:20px;
	    color: #09c;
	    font-weight: 700;
	    border:1px solid #ccc;
	    height:21px;
	}
</style>
	