<?php
/**
 * PHP环境配置文件
 * @author Heanes
 * @time 2014-8-29 09:37:50
 * config_php.php UTF-8 PHP
 */

/* 初始化设置-针对php配置文件的修改 */
@header('Content-Type:text/html;charset=utf-8');
@ini_set('memory_limit',          '128M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
//压缩级别
if(extension_loaded('zlib')) {
	@ini_set('zlib.output_compression', 'On');
	@ini_set('zlib.output_compression_level', '7');
}
// 错误提示信息
@ini_set('display_errors', 0);
// error_reporting(E_ALL & ~E_NOTICE);

//默认时区配置
date_default_timezone_set('PRC');
//显示前一天时间
//echo date('Y-m-d H:i:s', strtotime('-1day')).'<br/>';
//echo date('Y-m-d H:i:s', time()-24*60*60);