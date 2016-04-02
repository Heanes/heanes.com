<?php
/**
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-18 15:25:08
 * @doc 后台起始页控制文件
 */
defined('InHeanes') or exit('Access Invalid!');

class IndexController extends BaseAdminController{
	
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认页面
	 * @author Heanes
	 * @time 2015-07-01 11:48:15
	 */
	public function indexOp(){
		Tpl::display('layout', 'adminFrameLayout');
	}

	/**
	 * @doc 头部
	 * @author Heanes
	 * @time 2015-07-01 11:47:28
	 */
	public function headerOp(){
		Tpl::display('layout/header', 'adminFrameNullLayout');
	}

	public function menuOp(){
		$menuArray=require(PATH_ABS_BASE_APP.'include/menu.php');
		//print_arr($menuArray);
		Tpl::assign('menuList',$menuArray);
		Tpl::display('layout/menu', 'adminFrameNullLayout');
	}
}