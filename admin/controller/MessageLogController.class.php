<?php
/**
 * @doc 消息操作日志控制器
 * @filesource messageLogController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class messageLogController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$messageLogModel = Model('message_log');
		$page = new Page(10);
		$messageLog_list = $messageLogModel->getList('', $page);
		//会员私信表
		$userMessageModel = Model('user_message');    
		foreach ($messageLog_list as $key => $messageLog) {
			//根据message_id对应会员私信表的id查询数据
			$messageLog_list[$key]['user_message'] = $userMessageModel->getOneByID($messageLog['message_id']);
		}
		//用户表
		$usersModel = Model('users');  
		foreach ($messageLog_list as $key => $messageLog) {
			if(!empty($messageLog)){
				$usersActInfo=$usersModel->getOneByID($messageLog['act_user_id']);
				$messageLog_list[$key]['act_user_name']=$usersActInfo['user_name']; //用户ID
			}
		}
		Tpl::assign('messageLog_list', $messageLog_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '消息操作日志列表');
		Tpl::display('messageLog/list');
	}
	
	public function showOp() {
		$id = Filter::doFilter($_GET['id'], 'integer');
		$messageLogModel = Model('message_log');
		$messageLog_list = $messageLogModel->getOneByID($id);
		
		//用户ID
		$usersModel = Model('users');
		$actUserInfo = $usersModel->getOneByID($messageLog_list['act_user_id']);   
		$messageLog_list['act_user_name'] = $actUserInfo['user_name'];
		
		Tpl::assign('messageLog_list', $messageLog_list);
		Tpl::assign('page_title', '消息操作日志列表');
		Tpl::display();
	}

	

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$messageLogModel = Model('message_log');
		if ($messageLogModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

