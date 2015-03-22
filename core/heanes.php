<?php
/**
 * @filesource heanes.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-13 10:05:48
 * @doc 前后连接核心文件
 */
defined('InHeanes') or exit('Access Invalid!');
if (!@include(PATH_ABS_BASE_DATA.'config/php.cfg.php')) exit('php.cfg.php isn\'t exists!');
if (!@include(PATH_ABS_BASE_DATA.'config/db.cfg.php')) exit('php.cfg.php isn\'t exists!');
global $_config;

define('DBPRE',($_config['db'][1]['dbname']).'`.`'.($_config['db']['1']['tablepre']));
//启用ZIP压缩
//if ($config['gzip'] == 1 && function_exists('ob_gzhandler') && $_GET['inajax'] != 1){
if (function_exists('ob_gzhandler') && $_GET['inajax'] != 1){
	ob_end_clean();//防止ob_gzhandler与zlib output compression发生冲突
	ob_start('ob_gzhandler');
}else {
	ob_start();
}
/**
 * 统一ACTION
 */
$_GET['act'] = preg_match('/^[\w]+$/i',$_GET['act']) ? $_GET['act'] : 'index';
$_GET['op'] = preg_match('/^[\w]+$/i',$_GET['op']) ? $_GET['op'] : 'index';

require (PATH_ABS_BASE_CORE.'framework/library/tpl.class.php');
require (PATH_ABS_BASE_CORE.'framework/core/base.class.php');
require_once(PATH_ABS_BASE_CORE.'/framework/function/core.func.php');
//require_once(PATH_ABS_BASE_CORE.'/framework/function/goods.func.php');

/**
 * 自动加载需要的类（按类名自动加载），通过Base类中的autoload()方法实现
 */
if(function_exists('spl_autoload_register')) {
	spl_autoload_register(array('Base', 'autoload'));
} else {
	function __autoload($class) {
		return Base::autoload($class);
	}
}