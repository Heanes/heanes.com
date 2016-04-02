<?php
/**
 * @doc 用户空间控制器
 * @filesource ZoneController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-20 12:42:20
 */
defined('InHeanes') or exit('Access Invalid!');

class ZoneController extends BaseWapController{
	function __construct(){
		parent::__construct();
		$this->needLogin();
	}

	/**
	 * @doc 用户空间
	 * @author Heanes
	 * @time 2015-06-24 17:00:31
	 */
	public function indexOp(){
		$this->needLogin();
		$userModel = Model('users');
		$user = $userModel->getOneByID($_SESSION['user_id']);
		Tpl::assign('user', $user);
		Tpl::assign('html_title', '用户空间');
		Tpl::display('layout/commingSoon');
	}
}