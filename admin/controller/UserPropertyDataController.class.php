<?php
/**
 * @doc 用户额外注册项数据映射控制器
 * @filesource UserPropertyDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserPropertyDataController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户额外注册项数据列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userPropertyDataModel = Model('user_property_fields_data');
		$page = new Page(10);
		$userPropertyData_list = $userPropertyDataModel->getList('', $page);
		
		//查询用户表
		$usersModel = Model('users');
		$usersList=$usersModel->getList('',$page);
		//财产类型属性存储表
		$propertyFieldsModel = Model('property_fields');
		$propertyFieldsList=$propertyFieldsModel->getList('',$page);
		
		foreach ($userPropertyData_list as $key => $userPropertyData) {
			if(!empty($userPropertyData)){
				$usersInfo=$usersModel->getOneByID($userPropertyData['user_id']);
				$userPropertyData_list[$key]['user_name']=$usersInfo['user_name']; //用户名
				
				$propertyFieldsInfo=$propertyFieldsModel->getOneByID($userPropertyData['fields_id']);
				$userPropertyData_list[$key]['mapped_name']=$propertyFieldsInfo['name']; //资产类型属性名称
			}
		}
		
		Tpl::assign('userPropertyData_list', $userPropertyData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户额外注册项数据列表');
		Tpl::display('userPropertyData/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userPropertyDataModel = Model('user_property_fields_data');
		//获取自增ID
		$lastID = $userPropertyDataModel->getAutoIncrementId();
		
		//用户ID
		$usersModel=Model('users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		
		//下拉框  获取财产类型属性存储表的     资产类型属性名称
		$propertyFieldsModel = Model('property_fields');
		$arr=$propertyFieldsModel->getList();
		Tpl::assign('info',$arr);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用用户额外注册项数据');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newuserPropertyData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserPropertyData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newuserPropertyData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newuserPropertyData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserPropertyData['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$userPropertyDataModel = Model('user_property_fields_data');
		if ($userPropertyDataModel->insert($newuserPropertyData)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$userPropertyDataModel = Model('user_property_fields_data');
		$userPropertyData = $userPropertyDataModel->getOneByID($id);
		
		//用户ID
		$usersModel=Model('users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		//下拉框  获取财产类型属性存储表的     资产类型属性名称
		$propertyFieldsModel = Model('property_fields');
		$arr=$propertyFieldsModel->getList();
		Tpl::assign('info',$arr);
		
		Tpl::assign('userPropertyData', $userPropertyData);
		Tpl::assign('page_title', '修改用户额外注册项数据');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['mapped_id'], 'integer');
		$newuserPropertyData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserPropertyData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newuserPropertyData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newuserPropertyData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserPropertyData['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$where = "`id`=$id";
		$userPropertyDataModel = Model('user_property_fields_data');
		if ($userPropertyDataModel->update($newuserPropertyData, $where)) {
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
		$userPropertyDataModel = Model('user_property_fields_data');
		if ($userPropertyDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

