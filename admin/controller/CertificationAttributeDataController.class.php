<?php
/**
 * @doc 认证属性映射控制器
 * @filesource CertificationAttributeDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class CertificationAttributeDataController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 认证属性映射列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$certificationFieldsDataModel = Model('user_certification_fields_data');
//		$certificationFieldsDataListParam=array();
//		$certificationFieldsDataListParam['where']= (empty($certificationFieldsDataListParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_deleted`=0";
		$page = new Page(10);
		$certificationFieldsData_list = $certificationFieldsDataModel->getList('', $page);
		//查询属性表的属性名称
		$certificationFieldsModel = Model('certification_type_fields');
		$certificationFields=$certificationFieldsModel->getList('',$page);
		
		//查询用户表的用户名称
		$usersModel = Model('users');
		$users=$usersModel->getList('',$page);
		
		foreach ($certificationFieldsData_list as $key => $certificationFieldsData) {
			if(!empty($certificationFieldsData)){
				$certificationFieldsInfo=$certificationFieldsModel->getOneByID($certificationFieldsData['fields_id']);
				$certificationFieldsData_list[$key]['fields_name']=$certificationFieldsInfo['name']; //属性ID
				
				$usersInfo=$usersModel->getOneByID($certificationFieldsData['user_id']);
				$certificationFieldsData_list[$key]['user_name']=$usersInfo['user_name']; //用户ID
			}
		}
		
		Tpl::assign('certificationFieldsData_list', $certificationFieldsData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '认证属性映射列表');
		Tpl::display('certificationAttributeData/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$certificationFieldsDataModel = Model('user_certification_fields_data');
		//获取自增ID
		$lastID = $certificationFieldsDataModel->getAutoIncrementId();
		
		//下拉框  获取认证属性表的     属性名称
		$certificationFieldsModel = Model('certification_type_fields');
		$certificationFieldsList=$certificationFieldsModel->getList();
		Tpl::assign('certificationFieldsList',$certificationFieldsList);
		//下拉框  获取用户表的     用户名称
		$usersModel = Model('users');
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加认证属性映射');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newcertificationFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newcertificationFieldsData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newcertificationFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newcertificationFieldsData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newcertificationFieldsData['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$certificationFieldsDataModel = Model('user_certification_fields_data');
		if ($certificationFieldsDataModel->insert($newcertificationFieldsData)) {
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
		$certificationFieldsDataModel = Model('user_certification_fields_data');
		$certificationFieldsData = $certificationFieldsDataModel->getOneByID($id);
		
		//下拉框  获取认证属性表的     属性名称
		$certificationFieldsModel = Model('certification_type_fields');
		$certificationFieldsList=$certificationFieldsModel->getList();
		Tpl::assign('certificationFieldsList',$certificationFieldsList);
		//下拉框  获取用户表的     用户名称
		$usersModel = Model('users');
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		
		Tpl::assign('certificationFieldsData', $certificationFieldsData);
		Tpl::assign('page_title', '修改认证属性映射');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attributeData_id'], 'integer');
		$newcertificationFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newcertificationFieldsData['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newcertificationFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newcertificationFieldsData['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newcertificationFieldsData['update_time'] = getGMTime();
		$where = "`id`=$id";
		$certificationFieldsDataModel = Model('user_certification_fields_data');
		if ($certificationFieldsDataModel->update($newcertificationFieldsData, $where)) {
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
		$certificationFieldsDataModel = Model('user_certification_fields_data');
		if ($certificationFieldsDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

