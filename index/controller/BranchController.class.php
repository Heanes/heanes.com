<?php
/**
 * @filesource BranchController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 17:35:39
 * @doc 分支机构控制类
 */
defined('InHeanes') or exit('Access Invalid!');
class BranchController extends BaseIndexController {
	function indexOp() {
		echo $_GET['id'];
		Tpl::display('branch');
	}
}