<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="<?php echo BASE_URL.'index.php?act=borrow&op=update';?>" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="15"><?php echo $output['page_title'];?></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="borrow_id" readonly value="<?php echo $output['borrow']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['borrow']['order'];?>"></td>
			</tr>
			<tr>
				<th>业务主ID</th>
				<td><input type="text" name="uid_master" value="<?php echo $output['borrow']['uid_master'];?>" style="width:60%;"></td>
				<th>业务客ID</th>
				<td><input type="text" name="uid_slave" value="<?php echo $output['borrow']['uid_slave'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>贷款用途（标识ID）</th>
				<td>
					<select name="usage_id" datatype="*" nullmsg="请选择贷款用途！">
						<option value="">请选择</option>
						<?php foreach ($output['info'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['borrow']['usage_id']) { ?> selected="selected"<?php  } ?> ><?php echo $value['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				<th>贷款额度</th>
				<td><input type="text" name="total" value="<?php echo $output['borrow']['total'];?>"></td>
			</tr>
			<tr>
				<th>贷款年限</th>
				<td><input type="text" name="year_limit" value="<?php echo $output['borrow']['year_limit'];?>" style="width:60%;"></td>
				<th>利息</th>
				<td><input type="text" name="rate" value="<?php echo $output['borrow']['rate'];?>"></td>
			</tr>
			<tr>
				<th>贷款成功截止期限</th>
				<td><input type="text" name="get_money_limit_time" value="<?php echo to_date($output['borrow']['get_money_limit_time']);?>" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>放款时间</th>
				<td><input type="text" name="get_money_time" value="<?php echo to_date($output['borrow']['get_money_time']);?>" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>还款时间</th>
				<td><input type="text" name="repay_money_time" value="<?php echo to_date($output['borrow']['repay_money_time']);?>" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>是否有同行</th>
				<td>
					<input type="radio" name="has_colleague" value="1" <?php if($output['borrow']['has_colleague']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="has_colleague" value="0" <?php if($output['borrow']['has_colleague']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>贷款申请时间（发布时间）</th>
				<td><input type="text" name="apply_time" value="<?php echo to_date($output['borrow']['apply_time']);?>" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
				<th>贷款申请状态</th>
				<td>
					<select name="apply_status">
						<option value="">请选择</option>
						<option value ="0" <?php if($output['borrow']['apply_status']=="0") { ?> selected="selected"<?php  } ?>>审核中</option>
						<option value ="1" <?php if($output['borrow']['apply_status']=="1") { ?> selected="selected"<?php  } ?>>已通过</option>
						<option value ="2" <?php if($output['borrow']['apply_status']=="2") { ?> selected="selected"<?php  } ?>>已拒绝</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>贷款申请最后更新时间</th>
				<td><input type="text" name="apply_update_time" id="apply_update_time" value="<?php echo to_date($output['borrow']['apply_update_time']);?>" placeholder="选择插入时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th><span class="need">*</span>进程状态</th>
				<td>
					<select name="progress_status" datatype="*" nullmsg="请选择进程状态！">
						<option value="">请选择</option>
						<?php foreach ($output['type'] as $key => $value) {?>
						<option value ="<?php echo $value['id'];?>" <?php if($value["id"]==$output['borrow']['progress_status']) { ?> selected="selected"<?php  } ?> ><?php echo $value['status'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>进行状态最后更新时间</th>
				<td colspan='4'><input type="text" name="progress_update_time" id="progress_update_time" value="<?php echo to_date($output['borrow']['progress_update_time']);?>" placeholder="选择插入时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>插入时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date($output['borrow']['create_time']);?>" placeholder="选择插入时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['borrow']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['borrow']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['borrow']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['borrow']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>借款用途备注</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="usage_info" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['borrow']['usage_info']; ?></textarea>
	
					<p style="font-size:12px;">
						您当前输入了 <span class="word_count1">0</span> 个文字。（字数统计包含HTML代码。）<br />
						您当前输入了 <span class="word_count2">0</span> 个文字。（字数统计包含纯文本、IMG、EMBED，不包含换行符，IMG和EMBED算一个文字。）
					</p>
					<cite>
						<!-- js S -->
						<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor-min.js"></script>
						<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/lang/zh_CN.js"></script>
						<script>
							KindEditor.ready(function (K) {
								K.create('textarea[name="usage_info"]', {
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
	<div class="edit-form-handle">
		<div class="handle-field">
			<a href="<?php echo BASE_URL.'index.php?act=borrow';?>" class="btn btn-large">取消</a>
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