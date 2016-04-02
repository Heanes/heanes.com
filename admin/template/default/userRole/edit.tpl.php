<form action="<?php echo BASE_URL;?>index.php?act=UserRole&op=update" method="post" class="input-condensed" onsubmit="javascript:return chk();" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改用户角色</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="role_id" readonly value="<?php echo $output['userRole']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['userRole']['order'];?>"></td>
			</tr>
			<tr>
				<th>角色名称</th>
				<td colspan='4'><input type="text" name="role_name" value="<?php echo $output['userRole']['name'];?>"></td>
			</tr>
			<tr>
				<th>添加时间</th>
				<td><input type="text" name="insert_time" value="<?php echo to_date($output['userRole']['insert_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['userRole']['is_enable']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['userRole']['is_enable']==0){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['userRole']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['userRole']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>备注介绍</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['userRole']['description']; ?></textarea>
	
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
	<!-- 选择权限 -->
	<style>
	#list-table{width:100%;}
	#list-table td{line-height: 22px;border:1px solid #ddd;}
	#list-div{width:100%;}
	#list-table th.first-cell {font-weight: bold;}
	</style>
	<table id="list-table"  cellspacing="1">
		<tr>
			<th width="9%" valign="top" class="first-cell" style="border:0;">选择权限</th>
		</tr> 
		<?php foreach ($output['privilegeUrl_list'] as $key => $privilegeUrl) {?>
		<tr class="chosen_tr">
			<td style="width:800px;">
				<div style="width:150px;float:left;">
					<input class="checkbox" type="checkbox" value="" name="">
					<?php echo $privilegeUrl['_class']?>
				</div>
			</td>
			<td style="width:800px;">
			<?php foreach ($privilegeUrl['_method'] as $sub_key => $sub_privilege) {?>
				<div style="width:180px;float:left;">
					<input class="checkbox" type="checkbox" <?php if(in_array($sub_privilege['id'],$output['userPrivilegeId_list'])){?> checked <?php }?> value="<?php echo $sub_privilege['id']?>" name="action_code[]">
					<?php echo $sub_privilege['name']?>
				</div>
			<?php }?>
			</td>
		</tr>
		<?php }?>
		<tr><td colspan='4'><input class="checkbox" id="all" type="checkbox" onclick="checkAll();" value="checkbox" name="chkGroup">全选</td></tr>
	</table>
	<br/>
	<script>
	function chk(){
		  var obj=document.getElementsByName("action_code[]");  //选择所有name对象，返回数组
		  //取到对象数组后，我们来循环检测它是不是被选中
		  var s='';
		  for(var i=0; i<obj.length; i++){
		    if(obj[i].checked) s+=obj[i].value+',';  //如果选中，将value添加到变量s中
		  }
		  //那么现在来检测s的值就知道选中的复选框的值了
		  if(s==''){
		      alert('您还没有选择任何权限！');
		      return false;
		  }
		  //alert(s==''?'你还没有选择任何内容！':s);
	}
	</script>
	<script>
		//选中类的当前行
		var array = new Array();
		$(function(){
			$(".chosen_tr").find("td:eq(0)").find(".checkbox").click(function(){
				var oInputClass = $(this).parent().parent().nextAll().children().children("input[type=checkbox]");//获取checkbox
				for(var i=0;i<oInputClass.length;i++){
					var chosenObj = $(".chosen_tr").find("td:eq(0)").find(".checkbox");
					//判断当前checkbox是否为选中状态
					if($(this).is(":checked")){
						array[i] = oInputClass[i].value;
						oInputClass[i].checked=true;
					}else{
						array = "";
						oInputClass[i].checked=false;
					}
				}
			})
		})

		//全选取消按钮函数
		var arr = new Array();
		function checkAll(){
			var oInput=document.getElementsByName("action_code[]");
			for(var i=0;i<oInput.length;i++){
				if(document.getElementById("all").checked==true){
					arr[i] = oInput[i].value;
					oInput[i].checked=true;

				}else{
					arr = "";
					oInput[i].checked=false;
				}
			}

		}
	</script>
	
	
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
