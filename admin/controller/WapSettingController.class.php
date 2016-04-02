<?php
/**
 * @doc WAP版面设置控制器
 * @filesource WapSettingController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-08 17:34:15
 */
defined('InHeanes') or exit('Access Invalid!');
class WapSettingController extends BaseAdminController {
	
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
	}
	
	function indexOp() {
		//echo __METHOD__;
 		Tpl::display('index');
 	}
}