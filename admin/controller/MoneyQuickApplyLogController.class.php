<?php
/**
 * @doc   贷款快速申请数据存储操作记录控制器
 * @filesource MoneyQuickApplyLogController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class MoneyQuickApplyLogController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 10:10:19
	 */
	public function listOp(){
		$moneyQuickApplyLogModel=Model('money_quick_apply_log');
		$page=new Page(10);
		$moneyQuickApplyLog_list=$moneyQuickApplyLogModel->getList('',$page);

		$adminUserModel=Model('admin_user');
		foreach ($moneyQuickApplyLog_list as $key => $moneyQuickApplyLog) {
			if(!empty($moneyQuickApplyLog)){
				$adminUserInfo=$adminUserModel->getOneByID($moneyQuickApplyLog['actor_user_id']);
				$moneyQuickApplyLog_list[$key]['actor_user_name']=$adminUserInfo['user_name']; // 处理者用户ID
			}
		}
		Tpl::assign('moneyQuickApplyLog_list',$moneyQuickApplyLog_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','贷款快速申请操作记录列表');
		Tpl::display('moneyQuickApplyLog/list');
	}

	//查看
	public function lookOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$moneyQuickApplyLogModel=Model('money_quick_apply_log');
		$moneyQuickApplyLog_list = $moneyQuickApplyLogModel->getOneByID($id);
		// 处理者用户ID
		$adminUserModel=Model('admin_user');
		$adminUserInfo=$adminUserModel->getOneByID($moneyQuickApplyLog_list['actor_user_id']);
		$moneyQuickApplyLog_list['actor_user_name']=$adminUserInfo['user_name'];

		Tpl::assign('moneyQuickApplyLog_list',$moneyQuickApplyLog_list);
		Tpl::assign('page_title', '贷款快速申请操作记录列表');
		Tpl::display();
	}

}
