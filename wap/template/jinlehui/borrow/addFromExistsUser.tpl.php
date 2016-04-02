<?php defined('InHeanes') or exit('Access Invalid!'); ?>
<div class="main-content w-wrap">
	<div class="page-nav-step">
		<ul>
			<li class="active"><a href="javascript:">第二步，填写贷款信息</a></li>
		</ul>
	</div>
	<div class="data-edit-block">
		<form action="<?php echo BASE_URL; ?>index.php?act=borrow&op=_addFromExistsCustomer&user_id=<?php echo $_GET['user_id']?>" method="post" id="data_insert_form">
			<table class="data-edit-table">
				<tbody>
				<tr>
					<th>用户姓名：<i class="border-one"></i></th>
					<td>
						<input type="text" name="uid_slave" class="input-data input-border-none" value="<?php echo $output['user']['real_name'];?>" readonly/>
					</td>
				</tr>
				<tr>
					<th>贷款用途：<i class="border-one"></i></th>
					<td class="td-input-select">
						<select name="usage_id" id="select-one" class="select-normal">
							<?php foreach ($output['productList'] as $key => $product) {?>
								<option value="<?php echo $product['id']?>"><?php echo $product['name']?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th>借款额度：<i class="border-one"></i></th>
					<td class="input-width-unit">
						<span><input type="text" name="total" class="input-data input-border-none text-right" placeholder="请填写借款额度，列如：100"></span>
						<span class="input-data-decorate">万</span>
					</td>
				</tr>
				<tr>
					<th>借款年限：<i class="border-one"></i></th>
					<td class="input-width-unit">
						<span><input type="text" name="year_limit" class="input-data input-border-none text-right" placeholder="请填写借款年限，列如：5" /></span>
						<span class="input-data-decorate">年</span>
					</td>
				</tr>
				<tr>
					<th>借款用途备注：<i class="border-one"></i></th>
					<td>
						<textarea name="usage_info" class="data-textarea" placeholder="备注信息"></textarea>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="data-edit-handle">
				<div class="handle-left">
					<input type="reset" class="data-reset-button" value="清空" />
				</div>
				<div class="handle-right">
					<input type="submit" class="data-submit-button" value="保存" />
				</div>
			</div>
		</form>
	</div>
</div>
