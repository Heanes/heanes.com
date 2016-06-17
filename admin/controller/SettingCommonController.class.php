<?php
/**
 * @doc 网站通用设置控制器
 * @filesource SettingCommonController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-03 10:41:06
 */
defined('InHeanes') or exit('Access Invalid!');
class SettingCommonController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		//加载语言包
		Language::read('settingCommon');
		$settingCommonModel=Model('setting_common');
		$settingCommonParam['where']="`is_enable`=1 AND `is_deleted`=0";
		$settingCommonList=$settingCommonModel->getList($settingCommonParam);
		Tpl::assign('html_title','网站通用设置');
		Tpl::display('settingCommon/index.tpl.php');
	}
}

