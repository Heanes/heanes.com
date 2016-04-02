<?php
/**
 * @doc 工具类控制器
 * @filesource ToolsController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.08.02 002
 */
defined('InHeanes') or exit('Access Invalid!');
class ToolsController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		$settingMenuArray = array(
			0=>array(
				array(
					'text' => '计算器',
					'href' => BASE_URL.'index.php?act=tools&op=calculator',
				),
			),
			1=>array(
				array(
					'text' => '备忘录',
					'href' => BASE_URL.'index.php?act=tools&op=note',
				),
			),
		);
		Tpl::assign('menuArray', $settingMenuArray);
		Tpl::assign('html_title','工具箱');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 计算器页面
	 * @author Carr
	 * @time 2015-08-02 15:04:51
	 */
	public function calculatorOp(){
		Tpl::assign('html_title','计算器');
		Tpl::display('tools/calculator');
	}
	
	public function noteOp(){
		Tpl::assign('html_title','备忘录');
		Tpl::display('layout/commingSoon');
	}
}
