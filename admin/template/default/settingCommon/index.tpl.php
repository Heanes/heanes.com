<?php
/**
 * @doc 网站设置模版文件
 * @filesource index.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-03 16:27:32
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<form action="<?php echo BASE_URL;?>index.php?act=settingCommon&op=insert" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<!-- Tab样式编辑修改 -->
	<div class="data-edit-tab">
		<dl id="data-edit-tab">
			<dt>基本信息</dt>
			<dd>
				<table class="table table-striped table-condensed table-data-edit">
					<tbody>
					<tr>
						<th>内部ID</th>
						<td>
							<label><input type="text" disabled="disabled" value="<?php echo $output['lastID'];?>"></label>
						</td>
					</tr>
					</tbody>
				</table>
			</dd>
			<dt>属性信息</dt>
			<dd>
				<!-- 编辑其他附属信息 -->
				<table class="table table-striped table-condensed table-data-edit">
					<tbody>
					<tr>
						<th><span class="need">*</span>类型ID</th>
						<td>
							<select name="fields_type_id" class="select-normal" id="selectid" onchange="checkOption();">
								<option value="">请选择</option>
								<?php foreach ($output['productTypeList'] as $key => $productType) {?>
									<option value ="<?php echo $productType['id'];?>"><?php echo $productType['name'];?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					</tbody>
				</table>
			</dd>
		</dl>
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
		/* Tabs选项卡 */
		$("#data-edit-tab").KandyTabs({
			trigger:"click"
		});
	});
</script>

