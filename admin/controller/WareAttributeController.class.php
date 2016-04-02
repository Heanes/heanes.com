<?php
/**
 * @doc 物品属性控制器
 * @filesource WareAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class WareAttributeController extends BaseAdminController {
	function __construct() {
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
		$wareFieldsModel = Model('ware_fields');
		$page = new Page(10);
		$wareFields_list = $wareFieldsModel->getList('', $page);
		
		//查询类型表的类型名称
		$wareTypeModel = Model('ware_type');
		foreach ($wareFields_list as $key => $wareFields) {
			if(!empty($wareFields)){
				$wareTypeInfo=$wareTypeModel->getOneByID($wareFields['type_id']);
				$wareFields_list[$key]['type_name']=$wareTypeInfo['name']; //类型名称
			}
		}
		Tpl::assign('wareFields_list', $wareFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '物品属性列表');
		Tpl::display('wareAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$wareFieldsModel = Model('ware_fields');
		//获取自增ID
		$lastID = $wareFieldsModel->getAutoIncrementId();
		
		//下拉框  物品类型名称
		$wareTypeModel = Model('ware_type');
		$wareTypeList=$wareTypeModel->getList();
		Tpl::assign('wareTypeList',$wareTypeList);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);

		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加物品属性');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newwareFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newwareFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newwareFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newwareFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newwareFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newwareFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newwareFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newwareFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newwareFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newwareFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newwareFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newwareFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newwareFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newwareFields['allow_read_role'] = implode(',',$allow_read_role);

		$wareFieldsModel = Model('ware_fields');
		if ($wareFieldsModel->insert($newwareFields)) {
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
		$wareFieldsModel = Model('ware_fields');
		$wareFields = $wareFieldsModel->getOneByID($id);
		
		//下拉框  物品类型名称
		$wareTypeModel = Model('ware_type');
		$wareTypeList=$wareTypeModel->getList();
		Tpl::assign('wareTypeList',$wareTypeList);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		//允许查看的角色ID,以逗号为分隔符
		$newAllowReadRole=explode(",",$wareFields['allow_read_role']);
		Tpl::assign('newAllowReadRole', $newAllowReadRole);

		Tpl::assign('wareFields', $wareFields);
		Tpl::assign('page_title', '修改物品属性');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newwareFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newwareFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newwareFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newwareFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newwareFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newwareFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newwareFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newwareFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newwareFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newwareFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newwareFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newwareFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newwareFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newwareFields['allow_read_role'] = implode(',',$allow_read_role);

		$where = "`id`=$id";
		$wareFieldsModel = Model('ware_fields');
		if ($wareFieldsModel->update($newwareFields, $where)) {
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
		$wareFieldsModel = Model('ware_fields');
		if ($wareFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

