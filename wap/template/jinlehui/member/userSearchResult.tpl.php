<?php defined('InHeanes') or exit('Access Invalid!');?>
<div class="main-content w-wrap">
	<!-- S 搜索关键词输入 S -->
	<div class="search-input-block">
		<form action="" method="get">
			<table class="search-input-table">
				<tbody>
					<tr>
						<th>查询类型：</th>
						<td class="td-input-select">
							<select class="select-normal">
								<option value="0">客户</option>
								<option value="0">业务</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="search-input-table">
				<tbody>
					<tr>
						<th>客户名称：</th>
						<td>
							<input type="text" class="input-data input-border-none" placeholder="请填写客户名称" />
						</td>
					</tr>
				</tbody>
			</table>
			<div class="search-input-handle">
				<input type="submit" class="data-submit-button" value="查询">
			</div>
		</form>
	</div>
	<!-- E 搜索关键词输入 E -->
	<!-- S 搜索结果 S -->
	<div class="search-result-list-block">
		<div class="result-block">
			<ul class="result-block-ul default-background">
				<li>
					<table class="result-list-table">
						<tbody>
							<tr>
								<td>
									<div style="background-image: url(../data/upload/image/user-avatar/default.png);" class="user-center-avatar"></div>
								</td>
								<td>
									<table class="result-list-table-in-td">
										<tbody>
											<tr>
												<th>姓名：</th>
												<td>蒲常莹</td>
											</tr>
											<tr>
												<th>手机号：</th>
												<td>15010691715</td>
											</tr>
											<tr>
												<th>身份证号：</th>
												<td>421******91</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
									<i class="arrow-r"></i>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
				<li>
					<table class="result-list-table">
						<tbody>
							<tr>
								<td>
									<div style="background-image:url(../data/upload/image/user-avatar/default.png);" class="user-center-avatar"></div>
								</td>
								<td>
									<table class="result-list-table-in-td">
										<tbody>
											<tr>
												<th>姓名：</th>
												<td>蒲常莹</td>
											</tr>
											<tr>
												<th>手机号：</th>
												<td>15010691715</td>
											</tr>
											<tr>
												<th>身份证号：</th>
												<td>421******91</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
									<i class="arrow-r"></i>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
			</ul>
		</div>
	</div>
	<!-- E 搜索结果 E -->
</div>
