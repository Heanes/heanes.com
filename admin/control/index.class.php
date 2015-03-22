<?php
/**
 * @filesource index.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-18 15:25:08
 * @doc 后台起始页控制文件
 */
defined('InHeanes') or exit('Access Invalid!');
class indexControl extends control {
	
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
	}
	
	function indexOp() {
		//echo __METHOD__;
 		Tpl::showpage('index.php');
 	}
}