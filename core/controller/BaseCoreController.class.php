<?php
/**
 * @doc 基础控制器
 * @filesource BaseCoreController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-11 12:27:51
 */
defined('InHeanes') or exit('Access Invalid!');
class BaseCoreController {
	function __construct() {
		//echo __METHOD__.'</br>';
		
		//从数据库中获取模版设置，并设置到模版中
		Tpl::setTemplateDir('default');
		Tpl::setLayout('layout/defaultCommonLayout');
		//设置模版常量，方便模版中获取路径
		define('TPL', TPL::$TPL);
	}
	
	function __destruct() {
		//echo __METHOD__.'</br>';
	}
}