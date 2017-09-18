<form action="<?php echo BASE_URL;?>index.php?act=Goods&op=update" method="post" class="input-condensed submitform" enctype="multipart/form-data">
	<div class="data-edit-tab">
	<dl id="data-edit-tab">
		<dt>基本信息</dt>
		<dd>
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改商品基本信息</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="goods_id" readonly value="<?php echo $output['goods']['id'];?>"></td>
				<th>排序</th>
				<td><input type="text" name="order" value="<?php echo $output['goods']['order'];?>"></td>
			</tr>
			<tr>
				<th><span class="need">*</span>商品名称</th>
				<td><input type="text" name="goods_name" value="<?php echo $output['goods']['name'];?>" datatype="s2-10" errormsg="商品名称至少2个字符,最多10个字符！" style="width:60%;"/>
					<span class="Validform_checktip"></span>
				</td>
				<th><span class="need">*</span>商品分类ID</th>
				<td>
					<select name="category_id" datatype="*" nullmsg="请选择商品分类ID！">
						<option value="">请选择</option>
						<?php foreach ($output['goodsCategoryList'] as $key => $goodsCategory) {?>
						<option value ="<?php echo $goodsCategory['id'];?>" <?php if($goodsCategory["id"]==$output['goods']['category_id']) { ?> selected="selected"<?php  } ?> ><?php echo $goodsCategory['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>商品短描述</th>
				<td><input type="text" name="short_desc" value="<?php echo $output['goods']['short_desc'];?>" style="width:60%;"></td>
				<th>商品序列号（平台）</th>
				<td><input type="text" name="serial" value="<?php echo $output['goods']['serial'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>店铺价格</th>
				<td><input type="text" name="shop_price" value="<?php echo $output['goods']['shop_price'];?>" style="width:60%;"></td>
				<th>成本价</th>
				<td><input type="text" name="cost_price" value="<?php echo $output['goods']['cost_price'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>市面价格</th>
				<td><input type="text" name="market_price" value="<?php echo $output['goods']['market_price'];?>" style="width:60%;"></td>
				<th>库存数目</th>
				<td><input type="text" name="store_num" value="<?php echo $output['goods']['store_num'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>已卖出总个数</th>
				<td><input type="text" name="total_sold_num" value="<?php echo $output['goods']['total_sold_num'];?>" style="width:60%;"></td>
				<th>商品封面图片</th>
				<td><input type="text" name="cover_img_src" value="<?php echo $output['goods']['cover_img_src'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>商品封面图片title值</th>
				<td><input type="text" name="cover_img_title" value="<?php echo $output['goods']['cover_img_title'];?>" style="width:60%;"></td>
				<th>商品可链接至外链</th>
				<td><input type="text" name="a_href" value="<?php echo $output['goods']['a_href'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>商品外链title值</th>
				<td><input type="text" name="a_title" value="<?php echo $output['goods']['a_title'];?>" style="width:60%;"/></td>
				<th>是否为新品</th>
				<td>
					<input type="radio" name="is_new" value="1" <?php if($output['goods']['is_new']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_new" value="0" <?php if($output['goods']['is_new']==0){?>checked="checked" <?php }?>/>否
				</td>
			</tr>
			<tr>
				<th>是否推荐</th>
				<td>
					<input type="radio" name="is_recommend" value="1" <?php if($output['goods']['is_recommend']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_recommend" value="0" <?php if($output['goods']['is_recommend']==0){?>checked="checked" <?php }?>/>否
				</td>
				<th>是否置顶</th>
				<td>
					<input type="radio" name="is_top" value="1" <?php if($output['goods']['is_top']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_top" value="0" <?php if($output['goods']['is_top']==0){?>checked="checked" <?php }?>/>否
				</td>
			</tr>
			<tr>
				<th>是否精品</th>
				<td>
					<input type="radio" name="is_great" value="1" <?php if($output['goods']['is_great']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="is_great" value="0" <?php if($output['goods']['is_great']==0){?>checked="checked" <?php }?>/>否
				</td>
				<th>是否允许评论</th>
				<td>
					<input type="radio" name="allow_comment" value="1" <?php if($output['goods']['allow_comment']==1){?>checked="checked" <?php }?>/>是
					<input type="radio" name="allow_comment" value="0" <?php if($output['goods']['allow_comment']==0){?>checked="checked" <?php }?>/>否
				</td>
			</tr>
			<tr>
				<th>评论数</th>
				<td><input type="text" name="comment_num" value="<?php echo $output['goods']['comment_num'];?>" style="width:60%;"></td>
				<th>平均评分值，允许为负分</th>
				<td><input type="text" name="comment_score" value="<?php echo $output['goods']['comment_score'];?>" style="width:60%;"/></td>
			</tr>
			<tr>
				<th>阅读次数</th>
				<td><input type="text" name="read_num" value="<?php echo $output['goods']['read_num'];?>" disabled="disabled" style="width:60%;"></td>
				<th>点击次数</th>
				<td><input type="text" name="click_count"  value="<?php echo $output['goods']['click_count'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>SEO标题</th>
				<td><input type="text" name="seo_title" value="<?php echo $output['goods']['seo_title'];?>" style="width:60%;"/></td>
				<th>SEO关键词</th>
				<td><input type="text" name="seo_keywords" value="<?php echo $output['goods']['seo_keywords'];?>" style="width:60%;"></td>
			</tr>
			<tr>
				<th>SEO描述</th>
				<td><input type="text" name="seo_description" value="<?php echo $output['goods']['seo_description'];?>" style="width:60%;"/></td>
				<th><span class="need">*</span>商品查看用户角色</th>
				<td>
					<select name="user_role_id" datatype="*" nullmsg="请选择用户角色！">
						<option value="">请选择</option>
						<?php foreach ($output['userRoleList'] as $key => $userRoleList) {?>
							<option value ="<?php echo $userRoleList['id'];?>" <?php if($userRoleList["id"]==$output['goods']['user_role_id']) { ?> selected="selected"<?php  } ?> ><?php echo $userRoleList['name'];?></option>
						<?php }?>
					</select>
					<span class="Validform_checktip"></span>
				</td>
			</tr>
			<tr>
				<th>商品查看用户积分</th>
				<td><input type="text" name="user_rank" value="<?php echo $output['goods']['user_rank'];?>" style="width:60%;"/></td>
				<th>查看密码</th>
				<td><input type="password" name="pwd" value="<?php echo $output['goods']['pwd'];?>" style="width:60%;height:30px;margin:0;"></td>
			</tr>
			<tr>
				<th>商品添加时间</th>
				<td><input type="text" name="create_time" value="<?php echo to_date($output['goods']['create_time']);?>" placeholder="选择添加时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>商品更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"></td>
			</tr>
			<tr>
				<th>是否启用</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['goods']['is_enable']==1){?>checked="checked" <?php }?>> 显示
					<input type="radio" name="is_enable" value="0" <?php if($output['goods']['is_enable']==0){?>checked="checked" <?php }?>> 不显示
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['goods']['is_delete']==1){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['goods']['is_delete']==0){?>checked="checked" <?php }?>> 否
				</td>
			</tr>
			<tr>
				<th>商品描述详情</th>
				<td colspan="3" style="height:460px;padding:0;margin:0;">
					<!-- KindEditor -->
					<!-- KindEditor是根据textarea的名称来实例化的 -->
					<textarea name="description" style="width:800px;height:400px;visibility:hidden;"><?php echo $output['goods']['description']; ?></textarea>
	
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
	</dd>
	<dt>属性信息</dt>
	<dd>
	<!-- 编辑其他附属信息 -->
		<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改属性信息</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><span class="need">*</span>类型ID</th>
				<td>
					<select name="fields_type_id" class="select-normal" id="selectid" onchange="checkOption();">
						<option value="">请选择</option>
						<?php foreach ($output['goodsTypeList'] as $key => $goodsType) {?>
						<option value ="<?php echo $goodsType['id'];?>" <?php if($goodsType["id"]==$output['goods']['type_id']) { ?> selected="selected"<?php  } ?> ><?php echo $goodsType['name'];?></option>
						<?php }?>
					</select>
				</td>
			</tr>
		</tbody>
		</table>
		<!-- 属性内容 -->
		<div id="ajax_fields">
			<div class="content"></div>
		</div>
		<script charset="utf-8" src="/public/static/libs/js/editor/kindEditor/kindeditor.js"></script>
		<script>
			var type_id=$("#selectid").val();
			if(type_id!=0){
				checkOption();
			}
			function checkOption(){
				var objVal=$("#selectid").val();  //拿到选中项的值
				if(objVal==""){
				 	$(".attr_list").css('display','none'); 
				 }else{
					 $(".attr_list").css('display','block'); 
				}


				//ajax取出数据
				var ajaxurl = "<?php echo BASE_URL;?>index.php?act=goods&op=ajaxGetFields";
				var query = {type_id: $("#selectid").val(),goods_id:$('input[name="goods_id"]').val()};

				$.ajax({
					url: ajaxurl,
					data: query,
					type: "post",
					dataType: "json",
					success: function (result) {
						var resultLength=result.length;
						var appendContent='<table class="table table-striped table-condensed table-data-edit">';

						for(var field in result){
							if(result[field].fields_value==null){
								result[field].fields_value='';
							}
							appendContent +='<tr>';
							appendContent +='<th>'+result[field].name+'</th>';
							switch (result[field].input_type){
								case 'text':
									appendContent +='<td><input type="text" name="attribute_name'+result[field].id+'" value="'+result[field].fields_value+'"></td>';
									break;
								case 'textarea':
									appendContent +='<td><textarea style="width:100px;height:30px;" class="editor_id2" name="attribute_name'+result[field].id+'">'+result[field].fields_value+'</textarea>';
									appendContent+='<script type="text/javascript">';
									appendContent+='var editor;KindEditor.ready(function(K){editor=K.create(".editor_id2",{resizeType:1,allowPreviewEmoticons:false,autoHeightMode:true,allowImageUpload:false,minWidth:465,minHeight:35,items:["source","fontname","fontsize","|","forecolor","hilitecolor","bold","italic","underline","removeformat","|","justifyleft","justifycenter","justifyright","insertorderedlist","insertunorderedlist","|","emoticons","image","link"]})});';
									appendContent+='<\/script>';
									appendContent+='</td>';
									break;
								case 'select':
									appendContent +='<td><select name="attribute_name'+result[field].id+'">';
									appendContent +='<option value="">请选择</option>';
									for(var i in result[field].input_value){
										appendContent +='<option value="'+result[field].input_value[i]+'"';
										if(result[field].input_value[i]==result[field].fields_value){
											appendContent +=' selected="selected" >';
										}else{
											appendContent +='>';
										}
										appendContent += result[field].input_value[i];
										appendContent +='</option>';
									}
									appendContent +='</select></td>';
									break;
							}
							appendContent +='</tr>';
						}
						appendContent +='</table>';
						$('#ajax_fields').html('');
						$('#ajax_fields').append(appendContent);
					}
				});
			} 
			</script>
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
// 	$(".submitform").Validform({
// 		tiptype:3
// 	});
	/* Tabs选项卡 */
	$("#data-edit-tab").KandyTabs({
		trigger:"click"
	});
});
</script>