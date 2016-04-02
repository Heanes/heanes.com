<?php
/**
 * @doc 用户权限控制器
 * @filesource UserPrivilegeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class UserPrivilegeController extends BaseAdminController{
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
		$userPrivilegeModel = Model('user_privilege');
		$page = new Page(10);
		$userPrivilege_list = $userPrivilegeModel->getList('', $page);
		
		$privilegeUrlModel = Model('privilege_url');  //功能权限存储库表 
		$userRoleModel = Model('user_role');       //角色表
		foreach ($userPrivilege_list as $key => $userPrivilege) {
			if(!empty($userPrivilege)){
				$privilegeUrlInfo=$privilegeUrlModel->getOneByID($userPrivilege['privilege_id']);
				$userPrivilege_list[$key]['privilege_name']=$privilegeUrlInfo['name']; // 根据privilege_id查询权限名称
				
				$userRoleInfo=$userRoleModel->getOneByID($userPrivilege['role_id']);
				$userPrivilege_list[$key]['role_name']=$userRoleInfo['name']; //根据role_id查询角色名称
			}
		}
		
		Tpl::assign('userPrivilege_list', $userPrivilege_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户权限列表');
		Tpl::display('userPrivilege/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userPrivilegeModel = Model('user_privilege');
		//获取自增ID
		$lastID = $userPrivilegeModel->getAutoIncrementId();
		
		//权限ID
		$privilegeUrlModel = Model('privilege_url');
		$privilegeUrl_List = $privilegeUrlModel->getList();
		Tpl::assign('privilegeUrl_List',$privilegeUrl_List);
		//角色ID
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户权限');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$userPrivilegeModel = Model('user_privilege');
		$userPrivilege = $userPrivilegeModel->getOneByID($id);
		//权限ID
		$privilegeUrlModel = Model('privilege_url');
		$privilegeUrl_List = $privilegeUrlModel->getList();
		Tpl::assign('privilegeUrl_List',$privilegeUrl_List);
		//角色ID
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('userPrivilege', $userPrivilege);
		Tpl::assign('page_title', '修改用户权限');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newuserPrivilege['privilege_id'] = Filter::doFilter($_POST['privilege_id'], 'string');
		$newuserPrivilege['role_id'] = Filter::doFilter($_POST['role_id'], 'string');
		$newuserPrivilege['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserPrivilege['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newuserPrivilege['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newuserPrivilege['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$userPrivilegeModel = Model('user_privilege');
		if ($userPrivilegeModel->insert($newuserPrivilege)) {
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
		$id = Filter::doFilter($_POST['id'], 'integer');
		$newuserPrivilege['privilege_id'] = Filter::doFilter($_POST['privilege_id'], 'string');
		$newuserPrivilege['role_id'] = Filter::doFilter($_POST['role_id'], 'string');
		$newuserPrivilege['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserPrivilege['update_time'] = getGMTime();
		$newuserPrivilege['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newuserPrivilege['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where = "`id`=$id";
		$userPrivilegeModel = Model('user_privilege');
		if ($userPrivilegeModel->update($newuserPrivilege, $where)) {
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
		$userPrivilegeModel = Model('user_privilege');
		if ($userPrivilegeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

