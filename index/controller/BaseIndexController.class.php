<?php
/**
 * @doc 前台控制器基础类
 * @filesource BaseIndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-13 15:48:45
 */
defined('InHeanes') or exit('Access Invalid!');
class BaseIndexController {
	function __construct() {
		//echo __METHOD__.'</br>';
		
		// 当前app下模版公共量
		Tpl::setTemplateDir('default');
		Tpl::setLayout('layout/defaultCommonLayout');
		//print_arr(get_defined_constants(true)['user']);
		//定义域名形式的资源文件路径，以供生成静态html文件
		//define('TPL', Server::get_host(false).PATH_BASE_ROOT .APP_ID.DS.Tpl::getTemplateDir());
		define('TPL', TPL::$TPL);
	}
	
	function __destruct() {
		//echo __METHOD__.'</br>';
	}
}