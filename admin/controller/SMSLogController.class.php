<?php
/**
 * @doc 短信记录
 * @filesource SMSLogController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 16:59:45
 */
defined('InHeanes') or exit('Access Invalid!');

class SMSLogController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		$smslogModel=Model('sms_log');
		$page=new Page(10);
		$smslog_list=$smslogModel->getList('',$page);
		Tpl::assign('smslog_list',$smslog_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','发送记录列表');
		Tpl::display('smslog/list');
	}


	/**
	 * @doc 统计页面
	 * @author Heanes
	 * @time 2015-07-07 14:51:46
	 */
	public function countOp(){
		;
	}
}

