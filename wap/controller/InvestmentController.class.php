<?php
/**
 * @doc 理财
 * @filesource InvestmentController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-11 18:05:09
 */
defined('InHeanes') or exit('Access Invalid!');

class InvestmentController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		Tpl::assign('html_title','理财中心');
		Tpl::display('layout/commingSoon');
	}
}

