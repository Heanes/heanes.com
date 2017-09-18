<?php
/**
 * @doc 认证审核控制器
 * @filesource CertificationCheckController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class CertificationCheckController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 认证审核列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$certificationCheckModel = Model('user_certification_check_log');
		$page = new Page(10);
		$certificationCheck_list = $certificationCheckModel->getList('', $page);
		//用户认证表
		$userCertificationModel = Model('user_certification'); 
		
		foreach ($certificationCheck_list as $key => $certificationCheck) {
			$certificationCheck_list[$key]['user_certification'] = $userCertificationModel->getOneByID($certificationCheck['user_certification_id']);
		}
		
		//admin_user表
		$adminUserModel = Model('admin_user');
		//用户表
		$usersModel = Model('users');
		//认证方式类别表
		$certificationTypeModel = Model('certification_type');

		foreach ($certificationCheck_list as $key => $certificationCheck) {
			if(!empty($certificationCheck)){
				$usersInfo=$usersModel->getOneByID($certificationCheck['user_certification']['user_id']);
				$certificationCheck_list[$key]['user_name']=$usersInfo['user_name']; //用户人ID
				
				$adminUserInfo=$adminUserModel->getOneByID($certificationCheck['actor_user_id']);
				$certificationCheck_list[$key]['action_user_name']=$adminUserInfo['user_name']; //操作人ID
				
				$certificationTypeInfo=$certificationTypeModel->getOneByID($certificationCheck['type_id']);
				$certificationCheck_list[$key]['type_name']=$certificationTypeInfo['name']; //类型ID
			}
		}
		
		Tpl::assign('certificationCheck_list', $certificationCheck_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '认证审核列表');
		Tpl::display('certificationCheck/list');
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$certificationCheckModel = Model('user_certification_check_log');
		$certificationCheck = $certificationCheckModel->getOneByID($id);
		//下拉框  admin_user表
		$adminUserModel = Model('admin_user');    //操作人ID  
		$adminUserList=$adminUserModel->getList();
		Tpl::assign('adminUser',$adminUserList);
		//下拉框 认证用户表
		$usersModel = Model('users');     //认证用户ID  
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		
		//用户认证表
		$userCertificationModel = Model('user_certification');
		$userCertification=$userCertificationModel->getOneByID($certificationCheck['user_certification_id']);
		
		Tpl::assign('userCertification', $userCertification);
		Tpl::assign('certificationCheck', $certificationCheck);
		Tpl::assign('page_title', '修改认证审核');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['check_id'], 'integer');
		$newcertificationCheck['user_certification_id'] = Filter::doFilter($_POST['user_certification_id'], 'string');
		$newcertificationCheck['actor_user_id'] = Filter::doFilter($_POST['actor_user_id'], 'string');
		$newcertificationCheck['reason'] = Filter::doFilter($_POST['reason'], 'string');
		$newcertificationCheck['status'] = Filter::doFilter($_POST['status'], 'string');
		$newcertificationCheck['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newcertificationCheck['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$certificationCheckModel = Model('user_certification_check_log');
		if ($certificationCheckModel->update($newcertificationCheck, $where)) {
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
		$certificationCheckModel = Model('user_certification_check_log');
		if ($certificationCheckModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

