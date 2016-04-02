<?php
/**
 * @doc 用户资料修改页
 * @filesource userBankInfo.tpl.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-11 17:22:06
 */
defined('InHeanes') or exit('Access Invalid!');
?>
<style type="text/css">
	.file_pic{
		width:210px;
	}
	img{
		margin:5px;
	}
</style>
<div class="main-content w-wrap">
	<div class="data-edit-block">
		<!-- 1.2银行卡信息 -->
		<div class="add-user-data">
			<div class="page-nav-tab">
				<ul>
					<li class="active"><a href="javascript:">用户信息修改</a></li>
				</ul>
			</div>
			<form action="<?php echo BASE_URL; ?>index.php?act=member&op=user_update" method="post" enctype="multipart/form-data">
				<table class="data-edit-table" rel="add_user_bank">
					<input type="hidden" name="id" value="<?php echo $output['user']['id']; ?>"/>
					<tbody>
					<tr>
						<th>头像：<i class="border-one"></i></th>
						<td>
							<span class="upload-button-text"><img src="<?php echo PATH_BASE_FILE_UPLOAD; ?><?php echo $output['user']['avatar_src']; ?>"
																  style="height:80px;border:1px solid #ccc;border-radius:6px;"></span>
							<input type="file" name="avatar_src" class="file_pic">
						</td>
					</tr>
					<tr>
						<th>姓名：<i class="border-one"></i></th>
						<td>
							<input type="text" name="real_name" class="input-data input-border-none" placeholder="请填写真实姓名"
								   value="<?php echo $output['user']['real_name']; ?>"/>
						</td>
					</tr>
					<tr>
						<th>用户名：<i class="border-one"></i></th>
						<td>
							<input type="text" name="user_name" class="input-data input-border-none" placeholder="用户昵称"
								   value="<?php echo $output['user']['user_name']; ?>"/>
						</td>
					</tr>
					<tr>
						<th>性别：<i class="border-one"></i></th>
						<td>
							<input type="radio" name="gender" placeholder="性别" value="1"/>男
							<input type="radio" name="gender" placeholder="性别" value="0"/>女
						</td>
					</tr>
					<tr>
						<th>地区：<i class="border-one"></i></th>
						<td class="td-input-select">
							<div id="live_address_select">
								<select name="province" class="province select-normal select-tight"></select>
								<select name="city" class="city select-normal select-tight"></select>
								<select name="region" class="area select-normal select-tight"></select>
							</div>
							<script src="<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/jquery.cxselect.js"></script>
							<script type="text/javascript">
								$('#live_address_select').cxSelect({
									url: '<?php echo PATH_BASE_PUBLIC; ?>static/libs/js/cxSelect/1.3.4/cityData.min.json',   // 提示：如果服务器不支持 .json 类型文件，请将文件改为 .js 文件
									selects: ['province', 'city', 'area'],
									nodata: 'none'
								});
							</script>
						</td>
					</tr>
					<tr>
						<th>详细地址：<i class="border-one"></i></th>
						<td>
							<input type="text" name="address" class="input-data input-border-none" placeholder="详细地址" value="<?php echo $output['user']['address']; ?>"/>
						</td>
					</tr>
					<tr>
						<th>个性签名：<i class="border-one"></i></th>
						<td>
							<input type="text" name="signature" class="input-data input-border-none" placeholder="签名"
								   value="<?php echo $output['user']['signature']; ?>"/>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="data-detail-handle">
					<div class="handle-left">
						<input type="reset" class="data-reset-button" value="清空"/>
					</div>
					<div class="handle-right">
						<input type="submit" class="data-submit-button sub" value="保存" name="bank_edit_form_submit"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


