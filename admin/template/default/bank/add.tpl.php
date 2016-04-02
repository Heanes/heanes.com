<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=bank&op=insert';?>" method="post" class="input-condensed" enctype="multipart/form-data">
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
			<th>排序</th>
			<td><input type="text" name="bank_order" value=""></td>
		</tr>
		<tr>
			<th><span class="need">*</span>银行名称</th>
			<td><input type="text" name="bank_name" value="" style="width:60%;"></td>
			<th>银行代码</th>
			<td><input type="text" name="bank_code" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>银行logo图标地址</th>
			<td><input type="text" name="img_url" value="" style="width:60%;"></td>
			<th><span class="need">*</span>银行链接地址</th>
			<td><input type="text" name="a_href" value="" style="width:60%;"></td>
		</tr>
		<tr>
			<th>上传时间</th>
			<td><input type="text" name="bank_insert_time" value="<?php echo to_date('now');?>" placeholder="选择上传时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			<th>更新时间</th>
			<td><input type="text" name="bank_update_time" value="<?php echo to_date('now');?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
		</tr>
		<tr>
			<th>是否推荐</th>
			<td>
				<input type="radio" name="is_commend" value="1" > 是
				<input type="radio" name="is_commend" value="0" checked> 否
			</td>
			<th>是否有效</th>
			<td>
				<input type="radio" name="is_enable" value="1" checked> 是
				<input type="radio" name="is_enable" value="0" > 否
			</td>
		</tr>
		<tr>
			<th>是否删除</th>
			<td colspan="4">
				<input type="radio" name="is_delete" value="1" > 是
				<input type="radio" name="is_delete" value="0" checked> 否
			</td>
		</tr>
		<tr>
			<th>银行信息描述</th>
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
					<script charset="utf-8" src="<?php echo SYS_HOST;?>public/static/libs/js/editor/kindEditor/kindeditor-min.js"></script>
					<script charset="utf-8" src="<?php echo SYS_HOST;?>public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
					<script>
						KindEditor.ready(function(K) {
							K.create('textarea[name="description"]', {
								afterChange : function() {
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
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=bank';?>" class="btn btn-large">取消</a>
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
				"bank_name":/^[\u4E00-\u9FA5\uf900-\ufa2d]{4,10}$/,
				"a_href":/^(\w+:\/\/)?\w+(\.\w+)+.*$/
			}
		});
		demo.addRule([{
			ele:'input[name="bank_name"]',
			datatype:"bank_name",
			nullmsg:'请输入银行名称！',
			errormsg:'银行名称为4~10个中文字符！'
		}]);
		demo.addRule([{
			ele:'input[name="a_href"]',
			datatype:"a_href",
			nullmsg:'请输入银行链接地址！',
			errormsg:'银行链接地址格式不对！'
		}]);
	});
</script>
