<?php
/**
 * @filesource control.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-13 15:48:45
 * @doc 前台控制器
 */
class control {
	function __construct() {
		//echo __METHOD__.'</br>';
		
		/* 当前app下模版公共量 */
		Tpl::setTemplateDir('banjia');
		define(TPL, Tpl::getTemplateDir());
		//print_constants('user');
	}
}