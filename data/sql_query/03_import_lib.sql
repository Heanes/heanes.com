use `heanes.com`;
set FOREIGN_KEY_CHECKS = 0;

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