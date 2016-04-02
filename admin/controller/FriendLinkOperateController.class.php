<?php
/**
 * @doc 申请操作列表
 * @filesource FriendlinkOperateController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 16:59:45
 */
defined('InHeanes') or exit('Access Invalid!');
class FriendlinkOperateController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}
	
	/**
	 * @doc 申请操作列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		// 查询友情链接申请表
		$friendlinkApplyModel=Model('friend_link_apply');
		$page=new Page(10);
		$friendlinkApplyList=$friendlinkApplyModel->getList('',$page);
		// 查询友情链接操作表
		$friendlinkOperateModel=Model('friend_link_apply_act_log');
		$friendlinkOperateList=$friendlinkOperateModel->getList('',$page);
		// 查询用户表
		$adminUserModel=Model('admin_user');
		$adminUserList=$adminUserModel->getList('',$page);
		
		foreach ($friendlinkOperateList as $key => $operate) {
			if(!empty($operate)){
				$friendLinkApplyInfo=$friendlinkApplyModel->getOneByID($operate['link_apply_id']);
				$friendlinkOperateList[$key]['apply_name']=$friendLinkApplyInfo['name']; //链接申请ID对应的申请名称
				
				$adminUserInfo=$adminUserModel->getOneByID($operate['act_user_id']);
				$friendlinkOperateList[$key]['user_name']=$adminUserInfo['user_name']; //链接操作用户ID对应的用户名
			}
		}
		
		Tpl::assign('friendlinkOperateList',$friendlinkOperateList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','申请操作记录');
		Tpl::display('friendlinkOperate/list');
			
	}
	

	/**
	 * @doc 审核页面
	 * @author Heanes
	 * @time 2015-07-07 14:49:30
	 */
	public function checkOp(){
		;
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