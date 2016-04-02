<?php
/**
 * @doc 后台布局控制器
 * @filesource BaseLayoutController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-28 20:12:43adminFrameLayout
 */
defined('InHeanes') or exit('Access Invalid!');

class BaseLayoutController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认欢迎页面
	 * @author Heanes
	 * @time 2015-06-28 20:19:26
	 */
	public function defaultOp(){
		//$page=Filter::doFilter($_GET['page'],'string');
		Tpl::display('default', 'adminFrameMainContentLayout');
	}

	public function rightOp(){
		Tpl::display('layout/right');
	}

}

