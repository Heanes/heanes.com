<?php
/**
 * @filesource branch.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 17:35:39
 * @doc 分支机构控制类
 */
defined('InHeanes') or exit('Access Invalid!');
class branchControl extends control {
	function indexOp() {
		Tpl::showpage('branch.php');
	}
}