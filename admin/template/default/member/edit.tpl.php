<form action="<?php echo BASE_URL;?>index.php?act=member&op=update" method="post" class="input-condensed" enctype="multipart/form-data">
	<table class="table table-striped table-condensed table-data-edit">
		<thead>
			<tr>
				<td colspan="4">修改会员</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>内部ID</th>
				<td><input type="text" name="user_id" readonly value="<?php echo $output['member']['id'];?>"></td>
				<th>用户昵称</th>
				<td><input type="text" name="nickname" value="<?php echo $output['member']['nickname'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th><span class="need">*&nbsp;</span>用户名</th>
				<td><input type="text" name="user_name" value="<?php echo $output['member']['user_name'];?>" style="width: 60%;"></td>
				<th><span class="need">*</span>密码</th>
				<td><input type="password" name="user_pwd" value="<?php echo $output['member']['user_pwd'];?>" style="width: 60%;height:30px;margin:0;"/></td>
			</tr>
			<tr>
				<th>用户角色ID</th>
				<td>
					<select name="role_id" class="select-normal">
						<option value="">请选择</option>
						<?php foreach ($output['roleUrl_List'] as $key => $roleUrl) {?>
							<option value="<?php echo $roleUrl['id']?>" <?php if($roleUrl['id']==$output['member']['role_id']){?>selected<?php }?>><?php echo $roleUrl['name']?></option>
						<?php }?>
					</select>
				</td>
				<th>Email</th>
				<td><input type="text" name="user_email" value="<?php echo $output['member']['user_email'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>手机号</th>
				<td><input type="text" name="mobile" value="<?php echo $output['member']['mobile'];?>" style="width: 60%;"></td>
				<th>固定电话</th>
				<td><input type="text" name="telephone" value="<?php echo $output['member']['telephone'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>年龄</th>
				<td><input type="text" name="age" value="<?php echo $output['member']['age'];?>" style="width: 60%;"></td>
				<th>用户性别</th>
				<td>
					<input id="man" type="radio" name="gender" value="1" <?php if($output['member']['gender']=="1"){?> checked="checked" <?php }?>/>男 &nbsp;
					<input id="woman" type="radio"  name="gender" value="2" <?php if($output['member']['gender']=="2"){?> checked="checked" <?php }?> />女 &nbsp;
					<input type="radio"  name="gender" value="3" <?php if($output['member']['gender']=="3"){?> checked="checked" <?php }?> />未知 &nbsp;
				</td>
			</tr>
			<tr>
				<th>身份证号</th>
				<td><input type="text" name="idcard" value="<?php echo $output['member']['idcard'];?>" style="width: 60%;"></td>
				<th>真实姓名</th>
				<td><input type="text" name="real_name" value="<?php echo $output['member']['real_name'];?>" style="width: 60%;"></td>
			</tr>
			
			<tr>
				<th>注册时间</th>
				<td><input type="text" name="reg_time" value="<?php echo to_date($output['member']['reg_time']);?>" placeholder="选择注册时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
				<th>更新时间</th>
				<td><input type="text" name="update_time" value="<?php echo to_date(getGMTime());?>" placeholder="选择更新时间" onclick="$.calendar({format:'yyyy-MM-dd HH:mm:ss'});" class="date_time_picker"/></td>
			</tr>
			<tr>
				<th>用户注册IP</th>
				<td><input type="text" name="reg_ip" value="<?php echo $output['member']['reg_ip'];?>" style="width: 60%;"></td>
				<th>用户当前登陆IP</th>
				<td><input type="text" name="current_login_ip" value="<?php echo $output['member']['current_login_ip'];?>" readonly style="width: 60%;"></td>
			</tr>
			<tr>
				<th>用户最后登陆时间</th>
				<td><input type="text" name="last_login_time" value="<?php echo to_date($output['member']['last_login_time']);?>" readonly style="width: 60%;"></td>
				<th>用户登录次数</th>
				<td><input type="text" name="login_times" readonly value="<?php echo $output['member']['login_times'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>用户生日</th>
				<td><input type="text" name="birthday_year" value="<?php echo $output['member']['birthday_year'].'-'.$output['member']['birthday_month'].'-'.$output['member']['birthday_day'];?>" onclick="$.calendar({format:'yyyy-MM-dd'});" class="date_time_picker"></td>
				<th>婚姻状况</th>
				<td>
					<select name="has_married">
						<option value="请选择">请选择</option>
						<option value="1" <?php if($output['member']['has_married']=="1") { ?> selected="selected"<?php  } ?>>未知</option>
						<option value="2" <?php if($output['member']['has_married']=="2") { ?> selected="selected"<?php  } ?>>未婚</option>
						<option value="3" <?php if($output['member']['has_married']=="3") { ?> selected="selected"<?php  } ?>>已婚</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>用户QQ号</th>
				<td><input type="text" name="qq" value="<?php echo $output['member']['qq'];?>" style="width: 60%;"></td>
				<th>用户微信</th>
				<td><input type="text" name="webchat" value="<?php echo $output['member']['webchat'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>用户教育水平</th>
				<td><input type="text" name="user_edu" value="<?php echo $output['member']['user_edu'];?>" style="width: 60%;"></td>
				<th>月收入</th>
				<td><input type="text" name="monthly_income" value="<?php echo $output['member']['monthly_income'];?>" style="width: 60%;"></td>
			</tr>
			<tr>
				<th>是否有效</th>
				<td>
					<input type="radio" name="is_enable" value="1" <?php if($output['member']['is_enable']=='1'){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_enable" value="0" <?php if($output['member']['is_enable']=='0'){?>checked="checked" <?php }?>> 否
				</td>
				<th>是否删除</th>
				<td>
					<input type="radio" name="is_delete" value="1" <?php if($output['member']['is_delete']=='1'){?>checked="checked" <?php }?>> 是
					<input type="radio" name="is_delete" value="0" <?php if($output['member']['is_delete']=='0'){?>checked="checked" <?php }?>> 否
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
		datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;
			
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			
				if (gets.length == 15) {   
					return isValidityBrithBy15IdCard(gets);   
				}else if (gets.length == 18){   
					var a_idCard = gets.split("");// 得到身份证数组   
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
						return true;   
					}   
					return false;
				}
				return false;
				
				function isTrueValidateCodeBy18IdCard(a_idCard) {   
					var sum = 0; // 声明加权求和变量   
					if (a_idCard[17].toLowerCase() == 'x') {   
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
					}   
					for ( var i = 0; i < 17; i++) {   
						sum += Wi[i] * a_idCard[i];// 加权求和   
					}   
					valCodePosition = sum % 11;// 得到验证码所位置   
					if (a_idCard[17] == ValideCode[valCodePosition]) {   
						return true;   
					}
					return false;   
				}
				
				function isValidityBrithBy18IdCard(idCard18){   
					var year = idCard18.substring(6,10);   
					var month = idCard18.substring(10,12);   
					var day = idCard18.substring(12,14);   
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 这里用getFullYear()获取年份，避免千年虫问题   
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;   
				}
				
				function isValidityBrithBy15IdCard(idCard15){   
					var year =  idCard15.substring(6,8);   
					var month = idCard15.substring(8,10);   
					var day = idCard15.substring(10,12);
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
					if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;
				}
				
			},
			"real_name":/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
			'user_name':/^[\u4E00-\u9FA5\uF900-\uFA2D\w]{2,20}$/,
			'user_pwd':/^[\w\W]{6,32}$/,
			'mobile':/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/,
			'telephone':/^\d{4,11}$/,
			'age':/^\d{1,3}$/,
			'user_email':/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
		}
	});
	demo.addRule([{
		ele:'input[name="idcard"]',
		datatype:"idcard",
		errormsg:'您填写的身份证号码不对,请填写真实的！',
		ignore:'ignore'
	}]);
	demo.addRule([{
		ele:'input[name="real_name"]',
		datatype:"real_name",
		errormsg:'真实姓名为2~4个中文字符！',
		ignore:'ignore'
	}]);
	demo.addRule([{
		ele:'input[name="user_name"]',
		datatype:"user_name",
		errormsg:'由英文字母、数字、中文组成，长度2－10个！',
		nullmsg:'请填写用户名！'
	}]);
	demo.addRule([{
		ele:'input[name="user_pwd"]',
		datatype:"user_pwd",
		errormsg:'密码范围在6~32位之间！',
		nullmsg:'请设置密码！'
	}]);
	demo.addRule([{
		ele:'input[name="mobile"]',
		datatype:"mobile",
		errormsg:'手机号格式不对！',
		ignore:'ignore'
	}]);
	demo.addRule([{
		ele:'input[name="telephone"]',
		datatype:"telephone",
		errormsg:'固定电话格式不对！',
		ignore:'ignore'
	}]);
	demo.addRule([{
		ele:'input[name="age"]',
		datatype:"age",
		errormsg:'年龄为 1~3 位数字！',
		ignore:'ignore'
	}]);
	demo.addRule([{
		ele:'input[name="user_email"]',
		datatype:"user_email",
		errormsg:'邮箱地址格式不对！',
		ignore:'ignore'
	}]);

	$(".input-condensed").submit(function(){
		if(!demo.check){
			alert("表单项正在检测或存在错误！");
			return false;
		}
		return true;
	});
});
</script>
