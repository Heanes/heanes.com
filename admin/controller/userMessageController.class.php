<?php
/**
 * @doc 会员私信控制器
 * @filesource userMessageController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class userMessageController extends BaseAdminController{
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
		$userMessageModel = Model('user_message');
		$page = new Page(10);
		$userMessage_list = $userMessageModel->getList('', $page);
		
		$usersModel = Model('users');  //用户表
		foreach ($userMessage_list as $key => $userMessage) {
			if(!empty($userMessage)){
				$recvierInfo=$usersModel->getOneByID($userMessage['recvier_user_id']);
				$userMessage_list[$key]['recvier_user_name']=$recvierInfo['user_name']; //接收人用户ID
				
				$senderInfo=$usersModel->getOneByID($userMessage['sender_user_id']);
				$userMessage_list[$key]['sender_user_name']=$senderInfo['user_name']; //发送人用户ID
			}
		}
		Tpl::assign('userMessage_list', $userMessage_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '会员私信列表');
		Tpl::display('userMessage/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userMessageModel = Model('user_message');
		//获取自增ID
		$lastID = $userMessageModel->getAutoIncrementId();
		
		//下拉框  用户表
		$usersModel = Model('users');     //接收人用户ID  recvier_user_id
		$recvierUsersList=$usersModel->getList();
		Tpl::assign('recvierUsersList',$recvierUsersList);
		//下拉框  用户表
		$senderUsersList=$usersModel->getList(); //发送人用户ID  sender_user_id
		Tpl::assign('senderUsersList',$senderUsersList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加会员私信');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$userMessageModel = Model('user_message');
		$userMessage = $userMessageModel->getOneByID($id);
		
		//下拉框  用户表
		$usersModel = Model('users');     //接收人用户ID  recvier_user_id
		$recvierUsersList=$usersModel->getList();
		Tpl::assign('recvierUsersList',$recvierUsersList);
		//下拉框  用户表
		$senderUsersList=$usersModel->getList(); //发送人用户ID  sender_user_id
		Tpl::assign('senderUsersList',$senderUsersList);
		
		Tpl::assign('userMessage', $userMessage);
		Tpl::assign('page_title', '修改会员私信');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newuserMessage['recvier_user_id'] = Filter::doFilter($_POST['recvier_user_id'], 'string');
		$newuserMessage['sender_user_id'] = Filter::doFilter($_POST['sender_user_id'], 'string');
		$newuserMessage['title'] = Filter::doFilter($_POST['title'], 'string');
		$newuserMessage['content'] = Filter::doFilter($_POST['content'], 'string');
		$newuserMessage['send_time'] = to_timespan(Filter::doFilter($_POST['send_time'], 'string'));
		$newuserMessage['is_read'] = Filter::doFilter($_POST['is_read'], 'integer');
		$newuserMessage['read_time'] = to_timespan(Filter::doFilter($_POST['read_time'], 'string'));
		$newuserMessage['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newuserMessage['delete_time'] = to_timespan(Filter::doFilter($_POST['delete_time'], 'string'));
		$newuserMessage['is_recycle'] = Filter::doFilter($_POST['is_recycle'], 'integer');
		$newuserMessage['recycle_time'] = to_timespan(Filter::doFilter($_POST['recycle_time'], 'string'));
		$newuserMessage['is_emergency'] = Filter::doFilter($_POST['is_emergency'], 'integer');
		$newuserMessage['is_timing_auto'] = Filter::doFilter($_POST['is_timing_auto'], 'integer');
		$newuserMessage['auto_send_time'] = to_timespan(Filter::doFilter($_POST['auto_send_time'], 'string'));
		$newuserMessage['is_time_limit'] = Filter::doFilter($_POST['is_time_limit'], 'integer');
		$newuserMessage['limit_time_end'] = to_timespan(Filter::doFilter($_POST['limit_time_end'], 'string'));
		$newuserMessage['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newuserMessage['top_time_start'] = to_timespan(Filter::doFilter($_POST['top_time_start'], 'string'));
		$newuserMessage['top_time_end'] = to_timespan(Filter::doFilter($_POST['top_time_end'], 'string'));
		$newuserMessage['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$userMessageModel = Model('user_message');
		if ($userMessageModel->insert($newuserMessage)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['message_id'], 'integer');
		$newuserMessage['recvier_user_id'] = Filter::doFilter($_POST['recvier_user_id'], 'string');
		$newuserMessage['sender_user_id'] = Filter::doFilter($_POST['sender_user_id'], 'string');
		$newuserMessage['title'] = Filter::doFilter($_POST['title'], 'string');
		$newuserMessage['content'] = Filter::doFilter($_POST['content'], 'string');
		$newuserMessage['send_time'] = to_timespan(Filter::doFilter($_POST['send_time'], 'string'));
		$newuserMessage['is_read'] = Filter::doFilter($_POST['is_read'], 'integer');
		$newuserMessage['read_time'] = to_timespan(Filter::doFilter($_POST['read_time'], 'string'));
		$newuserMessage['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newuserMessage['delete_time'] = to_timespan(Filter::doFilter($_POST['delete_time'], 'string'));
		$newuserMessage['is_recycle'] = Filter::doFilter($_POST['is_recycle'], 'integer');
		$newuserMessage['recycle_time'] = to_timespan(Filter::doFilter($_POST['recycle_time'], 'string'));
		$newuserMessage['is_emergency'] = Filter::doFilter($_POST['is_emergency'], 'integer');
		$newuserMessage['is_timing_auto'] = Filter::doFilter($_POST['is_timing_auto'], 'integer');
		$newuserMessage['auto_send_time'] = to_timespan(Filter::doFilter($_POST['auto_send_time'], 'string'));
		$newuserMessage['is_time_limit'] = Filter::doFilter($_POST['is_time_limit'], 'integer');
		$newuserMessage['limit_time_end'] = to_timespan(Filter::doFilter($_POST['limit_time_end'], 'string'));
		$newuserMessage['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newuserMessage['top_time_start'] = to_timespan(Filter::doFilter($_POST['top_time_start'], 'string'));
		$newuserMessage['top_time_end'] = to_timespan(Filter::doFilter($_POST['top_time_end'], 'string'));
		$newuserMessage['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$where = "`id`=$id";
		$userMessageModel = Model('user_message');
		if ($userMessageModel->update($newuserMessage, $where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$userMessageModel = Model('user_message');
		if ($userMessageModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

