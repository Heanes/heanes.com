<?php defined('InHeanes') or exit('Access Invalid!');?>
<form action="" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
		<tr>
			<td colspan="15"><?php echo $output['page_title'];?></td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>内部ID</th>
			<td><input type="text" name="pointsLog_id" readonly value="<?php echo $output['userRankLogList']['id'];?>"></td>
			<th>用户ID</th>
			<td><a href="<?php echo BASE_URL;?>index.php?act=UserRank&op=edit&id=<?php echo $output['userRankLogList']['user_rank_id'];?>"><?php echo $output['userRankLogList']['user_rank_id'];?></a></td>
		</tr>
		<tr>
			<th>积分变更标识</th>
			<td><input type="text" name="chang_sign" value="<?php echo $output['userRankLogList']['chang_sign'];?>"></td>
			<th>积分变更值</th>
			<td><input type="text" name="value" value="<?php echo $output['userRankLogList']['value'];?>"></td>
		</tr>
		<tr>
			<th>积分变更事件描述</th>
			<td colspan="3" style="height:460px;padding:0;margin:0;">
				<!-- KindEditor -->
				<!-- KindEditor是根据textarea的名称来实例化的 -->
				<textarea name="change_thing" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['userRankLogList']['change_thing']; ?></textarea>

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
							K.create('textarea[name="change_thing"]', {
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
</form>
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/dateTimePicker/lhgCalendar/3.0.0/lhgcalendar.min.js"></script><!-- 日期时间选择器 -->
<script type="text/javascript" src="<?php echo SYS_HOST;?>public/static/libs/js/colorPicker/jscolor/1.4.4/jscolor.js"></script><!-- 加载颜色选择器 -->