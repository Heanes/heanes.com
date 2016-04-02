<?php
/**
 * @doc 
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-11 12:28:53
 */
defined('InHeanes') or exit('Access Invalid!');
class IndexController extends BaseCoreController {
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
	}
	function indexOp() {
		var_dump(TPL);
		Tpl::display('index');
	}
	function display_debugOp() {
		Debug::display_debug();
	}
}