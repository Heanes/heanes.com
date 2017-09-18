<?php
/**
 * @doc 用户财产存储控制器
 * @filesource UserPropertyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserPropertyController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户财产存储列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userPropertyModel = Model('user_property');
		$page = new Page(10);
		$userProperty_list = $userPropertyModel->getList('', $page);
		
		//查询用户表
		$usersModel = Model('users');
		$usersList=$usersModel->getList('',$page);
		//财产类型库存储表
		$propertyModel = Model('property');
		$propertyList=$propertyModel->getList('',$page);
		
		foreach ($userProperty_list as $key => $userProperty) {
			if(!empty($userProperty)){
				$usersInfo=$usersModel->getOneByID($userProperty['user_id']);
				$userProperty_list[$key]['user_name']=$usersInfo['user_name']; //用户名
				
				$propertInfo=$propertyModel->getOneByID($userProperty['property_id']);
				$userProperty_list[$key]['property_name']=$propertInfo['name']; //资产类型名称
			}
		}
		
		Tpl::assign('userProperty_list', $userProperty_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户财产列表');
		Tpl::display('userProperty/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userPropertyModel = Model('user_property');
		//获取自增ID
		$lastID = $userPropertyModel->getAutoIncrementId();
		
		//用户ID
		$usersModel=Model('Users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		
		//下拉框  获取财产类型库存储表的     资产类型名称
		$propertyModel = Model('property');
		$arr=$propertyModel->getList();
		Tpl::assign('info',$arr);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户财产');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newuserProperty['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newuserProperty['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserProperty['property_id'] = Filter::doFilter($_POST['property_id'], 'string');
		$newuserProperty['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newuserProperty['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newuserProperty['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newuserProperty['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$userPropertyModel = Model('user_property');
		if ($userPropertyModel->insert($newuserProperty)) {
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
		$userPropertyModel = Model('user_property');
		$userProperty = $userPropertyModel->getOneByID($id);
		
		//用户ID
		$usersModel=Model('users');
		$arr=$usersModel->getList();
		Tpl::assign('type',$arr);
		//下拉框  获取财产类型库存储表的     资产类型名称
		$propertyModel = Model('property');
		$arr=$propertyModel->getList();
		Tpl::assign('info',$arr);
		
		Tpl::assign('userProperty', $userProperty);
		Tpl::assign('page_title', '修改用户财产');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['user_property_id'], 'integer');
		$newuserProperty['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newuserProperty['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserProperty['property_id'] = Filter::doFilter($_POST['property_id'], 'string');
		$newuserProperty['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newuserProperty['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newuserProperty['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newuserProperty['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$userPropertyModel = Model('user_property');
		if ($userPropertyModel->update($newuserProperty, $where)) {
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
		$userPropertyModel = Model('user_property');
		if ($userPropertyModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

