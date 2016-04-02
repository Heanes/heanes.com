<?php
/**
 * @doc 设置控制器
 * @filesource SettingController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-23 22:32:48
 */
defined('InHeanes') or exit('Access Invalid!');

class SettingController extends BaseWapController {
	function __construct() {
		parent::__construct();
		$this->needLogin();
	}

	/**
	 * @doc 默认控制器
	 * @author Heanes
	 * @time 2015-08-23 22:33:26
	 */
	public function indexOp() {
		Tpl::assign('html_title','设置');
		Tpl::display();
	}

	/**
	 * @doc 账户设置页面
	 * @author Heanes
	 * @time 2015-08-23 22:41:02
	 */
	public function accountOp() {
		Tpl::assign('html_title','账户与安全');
		Tpl::display('layout/commingSoon');
	}

	/**
	 * @doc 软件关于信息
	 * @author Heanes
	 * @time 2015-08-23 22:35:30
	 */
	public function systemAboutOp() {
		Tpl::assign('html_title','关于');
		Tpl::display('setting/systemAbout','bodyNoContent');
	}

}
