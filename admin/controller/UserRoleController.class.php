<?php
/**
 * @doc 用户角色控制器
 * @filesource UserRoleController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class UserRoleController extends BaseAdminController{
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
		$userRoleModel = Model('user_role');
		$page = new Page(10);
		$userRole_list = $userRoleModel->getList('', $page);
		Tpl::assign('userRole_list', $userRole_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户角色列表');
		Tpl::display('userRole/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userRoleModel = Model('user_role');
		//获取自增ID
		$lastID = $userRoleModel->getAutoIncrementId();
		
		//获取 功能权限存储库表  的 控制器类名字段
		$privilegeUrlModel = Model('privilege_url');
		$privilegeUrl_list = $privilegeUrlModel->getList();

		//去掉数组中某个字段的的重复项
		$class_noRepeat=array();
		foreach($privilegeUrl_list as $privilegeUrl){
			$id=$privilegeUrl['class'];
			if(!in_array($id, $class_noRepeat)){
				$class_noRepeat[]=$id;
			}
		}
		$privilegeUrlList=array();
		foreach ($class_noRepeat as $key => $class) {
			$privilegeUrlList[$key]['_class']=$class;
		}
		foreach ($privilegeUrlList as $key => $class){
			$privilegeUrlParam['where']="`class`='".$class['_class']."'";
			$privilegeUrlList[$key]['_method']= $privilegeUrlModel->getList($privilegeUrlParam);
		}
		Tpl::assign('privilegeUrl_list', $privilegeUrlList);
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户角色');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$userRoleModel = Model('user_role');
		$id = Filter::doFilter($_GET['id'], 'integer');
		$userRole = $userRoleModel->getOneByID($id);
		
		//获取 功能权限存储库表  的 控制器类名字段
		$privilegeUrlModel = Model('privilege_url');
		$privilegeUrl_list = $privilegeUrlModel->getList();
		
		//去掉数组中某个字段的的重复项
		$class_noRepeat=array();
		foreach($privilegeUrl_list as $privilegeUrl){
			$idClass=$privilegeUrl['class'];
			if(!in_array($idClass, $class_noRepeat)){
				$class_noRepeat[]=$idClass;
			}
		}
		$privilegeUrlList=array();
		foreach ($class_noRepeat as $key => $class) {
			$privilegeUrlList[$key]['_class']=$class;
		}
		foreach ($privilegeUrlList as $key => $class){
			$privilegeUrlParam['where']="`class`='".$class['_class']."'";
			$privilegeUrlList[$key]['_method']= $privilegeUrlModel->getList($privilegeUrlParam);
		}
		Tpl::assign('privilegeUrl_list', $privilegeUrlList);
		
		$userPrivilegeModel = Model('user_privilege');
		$userPrivilegeParam['where']="`role_id`='$id'";
		$userPrivilege_list = $userPrivilegeModel->getList($userPrivilegeParam);
		Tpl::assign('userPrivilege_list', $userPrivilege_list);
		$userPrivilegeId_list=(array_column($userPrivilege_list,'privilege_id'));  //array_column()获取二维数组中某个key的集合
		
		Tpl::assign('userPrivilegeId_list', $userPrivilegeId_list);
		Tpl::assign('userRole', $userRole);
		Tpl::assign('page_title', '修改用户角色');
		Tpl::display();
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$userRoleModel = Model('user_role');
		$userPrivilegeModel = Model('user_privilege'); //用户权限表
		$privilegeUrlModel = Model('privilege_url');  //功能权限存储库表
		
		$action_code=$_POST['action_code']; //复选框选择权限功能   一个数组；
		$id = Filter::doFilter($_POST['role_id'], 'integer');
		$newuserRole['order'] = Filter::doFilter($_POST['order'], 'string');
		$newuserRole['name'] = Filter::doFilter($_POST['role_name'], 'string');
		$newuserRole['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserRole['update_time'] = getGMTime();
		$newuserRole['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newuserRole['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newuserRole['description']=Filter::doFilter($_POST['description'],'string');
		$where = "`id`=$id";
		//选择权限功能
		if ($userRoleModel->update($newuserRole, $where)){
			$userPrivilegeModel = Model('user_privilege');
			$userPrivilegeParam['where']="`role_id`='$id'";
			
			$userPrivilege_list = $userPrivilegeModel->getList($userPrivilegeParam);
			$userPrivilegeId_list=(array_column($userPrivilege_list,'privilege_id'));
			//第一种情况：如果权限为空（一个权限也没有选择）
			if(empty($userPrivilege_list)){
				//添加新的权限
				$newUserPrivilege['privilege_id'] =$action_code;
				$newUserPrivilege['insert_time'] = to_timespan(to_date('now'));
				$newUserPrivilege['update_time'] = to_timespan(to_date('now'));
				//获取role_id写入到用户权限表
				$newUserPrivilege['role_id'] = $id;
				if($userPrivilegeModel->insert($newUserPrivilege)){
					$flag=true;
				}else {
					$flag=false;
					showError('向用户权限表修改失败');
				}
					
			}
			//第二中情况：如果原来有选择权限
			if(!empty($userPrivilege_list)){
				$flag=false;
				//反向判断是否去掉原拥先有的权限
				foreach ($userPrivilege_list as $key => $userPrivilege) {
					if (!in_array($userPrivilege['privilege_id'],$action_code)) {
						//删除原有权限
						$deleteUserPrivilegeWhere="`role_id`='$id' AND `privilege_id`='".$userPrivilege['privilege_id']."'";
						$userPrivilegeModel->delete($deleteUserPrivilegeWhere);
						$flag=true;
					};
				}
				//@warn 此两步顺序不可改变
				foreach ($action_code as $value){
					//1.未改变的权限
					if(in_array($value,$userPrivilegeId_list)){
						;
					}else {
						//2.添加新的权限
						$newUserPrivilege['privilege_id'] =$value;
						$newUserPrivilege['insert_time'] = to_timespan(to_date('now'));
						$newUserPrivilege['update_time'] = to_timespan(to_date('now'));
						//获取role_id写入到用户权限表
						$newUserPrivilege['role_id'] = $id;
						if($userPrivilegeModel->insert($newUserPrivilege)){
							$flag=true;
						}else {
							$flag=false;
							showError('向用户权限表修改失败');
						}
					}
				}
			}
			if($flag){
				showSuccess('修改成功');
			}else {
				showError('向用户权限表修改失败');
			}
		} else {
			showError('修改失败');
		}
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$userRoleModel = Model('user_role');//用户角色表
		$userPrivilegeModel = Model('user_privilege'); //用户权限表
		$privilegeUrlModel = Model('privilege_url');  //功能权限存储库表
		$action_code=$_POST['action_code']; //复选框选择权限功能   一个数组；
		
		$newuserRole['order'] = Filter::doFilter($_POST['order'], 'string');
		$newuserRole['name'] = Filter::doFilter($_POST['role_name'], 'string');
		$newuserRole['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserRole['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newuserRole['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newuserRole['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newuserRole['description']=Filter::doFilter($_POST['description'],'string');
		if ($newUserRoleInsertID=$userRoleModel->insert($newuserRole)){
			//选择权限功能
			//将用户选择的权限id写入用户表privilege_id字段里
			$flag=false;
			foreach ($action_code as $value){
				$newUserPrivilege['privilege_id'] =$value;
				$newUserPrivilege['insert_time'] = to_timespan(to_date('now'));
				$newUserPrivilege['update_time'] = to_timespan(to_date('now'));
				//获取role_id写入到用户权限表
				$newUserPrivilege['role_id'] = $newUserRoleInsertID;
				if($userPrivilegeModel->insert($newUserPrivilege)){
					$flag=true;
				}else {
					$flag=false;
					showError('向用户权限表添加失败');
				}
			}
			if($flag){
				showSuccess('添加成功');
			}else {
				showError('向用户权限表添加失败');
			}
		} else {
			showError('添加失败');
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
		$userRoleModel = Model('user_role');
		if ($userRoleModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

