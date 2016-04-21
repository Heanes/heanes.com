use `heanes.com`;
set FOREIGN_KEY_CHECKS = 0;

/**
 * @doc 导入管理员用户数据
 * @author Heanes
 * @time 2015-07-04 09:27:10
 */
truncate `heanes.com`.`pre_admin_user`;
insert into `heanes.com`.`pre_admin_user` (
	`user_name`, `user_pwd`, `user_email`, `create_time`)
values
	('admin', 'd6f19b13cc75b70cabe99ca6d92e5de7', 'heanes@163.com', '1425922473');

#================================================网站设置类数据导入=============================================#
truncate `heanes.com`.`pre_setting_common`;
insert into `heanes.com`.`pre_setting_common` (
	`parent_id`,`code`, `input_type`, `input_range`, `store_value`, `order`, `can_edit`)
values
	# 默认管理员
	('1','default_admin','text',null,'admin','1','0')
	#-------------------------------------------网站信息设置
	# 网站名称
	,('1','site_name','text',null,'金乐汇', '1','1')
	# 网站logo
	,('1','web_logo','file',null,'logo.jpg', '1','1')
	# 网站版权申明
	,('1','web_copyright','text',null,'<div style=\"text-align:center;\">\r\n<span style=\"line-height:1.5;\">版权所有&copy;宏超科技 京ICP备15019724</span> \r\n</div>',  '1', '1')
	# 网站关键字
	,('1','web_keywords','text',null,'金乐汇P2P|金乐汇|金乐汇金融超市|金乐汇金融|金乐汇理财|网络理财|理财|投资理财|P2P理财|互联网金融|债权转让|理财计划|网络贷款|网贷|企业贷|个人贷', '1', '1')
	# 网站描述
	,('1','web_description','textarea',null,'金乐汇打造互联网金融超市', '1', '1')
	# 网站名称
	,('1','web_name','text',null,'金乐汇', '1', '1')
	# 网站标题
	,('1','web_title','text',null,'网站名称，显示在浏览器标题栏', '1', '1')
	# 网站联系地址-国家
	,('1','web_country','text',null,'中国', '1', '1')
	# 网站联系地址-省
	,('1','web_province','text',null,'北京', '1', '1')
	# 网站联系地址-市
	,('1','web_city','text',null,'海淀', '1', '1')
	# 网站联系地址-区
	,('1','web_region','text',null,'花园桥', '1', '1')
	# 网站详细地址
	,('1','service_address','text',null,'北京市海淀区世纪经贸大厦A座2904室', '1', '1')
	# 网站服务邮箱
	,('1','service_email','text',null,'service@jinlehui.net', '1', '1')
	# 网站备案信息
	,('1','icp_number','text',null,'京ICP证 100953号', '1', '1')
	# 网站备案文件
	,('1','icp_file','file','网站备案的证书文件','cert.png', '1', '1')
	#-------------------------------------------网站功能设置
	# 是否支持注册
	,('1','enable_register','select','1,0','1', '1', '1')
	# 是否开启验证码
	,('1','captcha_enable','select','0,1','是否启用登录验证码', '1', '1')
	# 尝试多少次后验证验证码
	,('1','theme_web','text','网站主题','default', '1', '1')
	# 网站是否关闭
	,('1','web_close','select','0,1','0', '1', '1')
	# 网站关闭原因
	,('1','web_close_description','textarea',null,'网站暂时关闭，敬请耐心等待', '1', '1')
	# 网站语言
	,('1','lang','select','zh_cn,en_us','zh_cn', '1', '1')
	# 网站图片水印
	,('1','watermark','file',null,'watermark.png', '1', '1')
	# 网站水印位置
	,('1','watermark_place','text','0,1,2,3,4,5','水印位置', '1', '1')
	# 网站水印透明度
	,('1','watermark_alpha','text',null,'10', '1', '1')
	# rewrite重写功能
	,('1','rewrite','select','0,1,2','1', '1', '1')
	# 文件上传大小限制
	#------------------------------------------网站显示设置
	,('1','upload_size_limit','text','-1,0,64,128,256,512,1024,2048,4096','4096', '1', '1')
	# 首页文章显示条数
	,('1','home_article_num','text','5','首页文章显示条数', '1', '1')
	# 首页友情链接是否显示图片
	,('1','friendly_link_logo','text','0,1','尾部友情链接是否显示图片，0-不显示，1-显示', '1', '1')
	#-----------------------------------------网站开发信息
	# 网站安装时间
	,('1','web_install_time','text','','网站安装时间，不可更改，作为参考信息', '1', '1')
	# 网站运营时间
	,('1','web_run_time','text','2年','网站运营时间，可以更改，给浏览者信心', '1', '1')
	;

#================================================库类数据导入=============================================#
/**
 * @doc 银行卡库
 * @author Heanes
 * @time 2015-07-29 10:16:47
 */
truncate `heanes.com`.`pre_bank`;
insert into `heanes.com`.`pre_bank` (
	`name`, `code`, `img_url`, `a_href`, `insert_time`,`update_time`)
values
	('工商银行', 'ICBC', 'ICBC.jpg', 'http://www.icbc.com.cn/icbc/', '1436471342', '1436471342')
	, ('中国银行', 'BOC', 'BOC.jpg', 'http://www.boc.cn/', '1436471342', '1436471342')
	, ('中国农业银行', 'ABC', 'ABC.jpg', 'http://www.abchina.com/cn/', '1436471342', '1436471342')
	, ('中国建设银行', 'CCB', 'CCB.jpg', 'http://www.ccb.com/', '1436471342', '1436471342')
	, ('中国光大银行', 'CEB', 'CEB.jpg', 'http://www.cebbank.com/', '1436471342', '1436471342')
	, ('兴业银行', 'CIB', 'CIB.jpg', 'http://www.cib.com.cn/', '1436471342', '1436471342')
	, ('中信银行', 'CITIC', 'CITIC.jpg', 'http://bank.ecitic.com/', '1436471342', '1436471342')
	, ('招商银行', 'CMB', 'CMB.jpg', 'http://www.cmbchina.com/', '1436471342', '1436471342')
	, ('中国民生银行', 'CMBC', 'CMBC.jpg', 'http://www.cmbc.com.cn/', '1436471342', '1436471342')
	, ('交通银行', 'COMM', 'COMM.jpg', 'http://www.bankcomm.com/', '1436471342', '1436471342')
	, ('广发银行', 'GDB', 'GDB.jpg', 'http://www.cgbchina.com.cn/', '1436471342', '1436471342')
	, ('华夏银行', 'HXBANK', 'HXBANK.jpg', 'http://www.hxb.com.cn/', '1436471342', '1436471342')
	, ('中国邮政储蓄银行', 'PSBC', 'PSBC.jpg', 'http://www.psbc.com/', '1436471342', '1436471342')
	, ('平安银行', 'SPABANK', 'SPABANK.jpg', 'http://bank.pingan.com/', '1436471342', '1436471342')
	, ('浦发银行', 'SPDB', 'SPDB.jpg', 'http://www.spdb.com.cn/', '1436471342', '1436471342');