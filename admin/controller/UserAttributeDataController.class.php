<?php
/**
 * @doc 用户额外属性字段数据映射控制器
 * @filesource UserAttributeDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserAttributeDataController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户额外属性字段数据映射列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userFieldsDataModel = Model('user_fields_data');
		$page = new Page(10);
		$userFieldsData_list = $userFieldsDataModel->getList('', $page);
		
		//查询用户表
		$usersModel = Model('users');
		$usersList=$usersModel->getList('',$page);
		//查询用户额外属性字段表
		$userFieldsModel = Model('user_fields');
		$userFieldsList=$userFieldsModel->getList('',$page);
		
		foreach ($userFieldsData_list as $key => $userFieldsData) {
			if(!empty($userFieldsData)){
				$usersInfo=$usersModel->getOneByID($userFieldsData['user_id']);
				$userFieldsData_list[$key]['user_name']=$usersInfo['user_name']; //用户名
				
				$userFieldsInfo=$userFieldsModel->getOneByID($userFieldsData['fields_id']);
				$userFieldsData_list[$key]['name']=$userFieldsInfo['name']; //注册项名称
			}
		}
		
		Tpl::assign('userFieldsData_list', $userFieldsData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户额外属性字段数据映射列表');
		Tpl::display('userAttributeData/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userFieldsDataModel = Model('user_fields_data');
		//获取自增ID
		$lastID = $userFieldsDataModel->getAutoIncrementId();
		
		//下拉框注册项名称
		$userFieldsModel = Model('user_fields');
		$arr=$userFieldsModel->getList();
		Tpl::assign('info',$arr);
		//下拉框用户ID
		$usersModel=Model('Users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户额外属性字段数据映射');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newUserFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newUserFieldsData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newUserFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newUserFieldsData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newUserFieldsData['update_time'] = getGMTime();
		$userFieldsDataModel = Model('user_fields_data');
		if ($userFieldsDataModel->insert($newUserFieldsData)) {
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
		$userFieldsDataModel = Model('user_fields_data');
		$userFieldsData = $userFieldsDataModel->getOneByID($id);
		
		//下拉框注册项名称
		$userFieldsModel = Model('user_fields');
		$arr=$userFieldsModel->getList();
		Tpl::assign('info',$arr);
		//下拉框用户ID
		$usersModel=Model('users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('userFieldsData', $userFieldsData);
		Tpl::assign('page_title', '修改用户额外属性字段数据映射');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attributeData_id'], 'integer');
		$newUserFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newUserFieldsData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newUserFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newUserFieldsData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newUserFieldsData['update_time'] = getGMTime();
		$where = "`id`=$id";
		$userFieldsDataModel = Model('user_fields_data');
		if ($userFieldsDataModel->update($newUserFieldsData, $where)) {
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
		$userFieldsDataModel = Model('user_fields_data');
		if ($userFieldsDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
}

