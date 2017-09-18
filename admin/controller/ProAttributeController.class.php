<?php
/**
 * @doc 产品属性名称字段控制器
 * @filesource ProAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class ProAttributeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 产品属性名称列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$productFieldsModel = Model('product_fields');
		$page = new Page(10);
		$productFields_list = $productFieldsModel->getList('', $page);
		
		//根据type_id查询类型表的类型名称
		$productTypeModel = Model('product_type');
		foreach ($productFields_list as $key => $productFields) {
			if(!empty($productFields)){
				$productTypeInfo=$productTypeModel->getOneByID($productFields['type_id']);
				$productFields_list[$key]['type_name']=$productTypeInfo['name']; //类型ID
			}
		}
		Tpl::assign('productFields_list', $productFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '产品属性名称列表');
		Tpl::display('proAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$productFieldsModel = Model('product_fields');
		//获取自增ID
		$lastID = $productFieldsModel->getAutoIncrementId();
		
		//下拉框  获取产品类型表的     类型名称
		$productTypeModel = Model('product_type');
		$arr=$productTypeModel->getList();
		Tpl::assign('info',$arr);

		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加产品属性名称');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newproFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newproFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newproFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newproFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newproFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newproFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newproFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newproFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newproFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newproFields['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newproFields['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newproFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newproFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newproFields['allow_read_role'] = implode(',',$allow_read_role);

		$productFieldsModel = Model('product_fields');
		if ($productFieldsModel->insert($newproFields)) {
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
		$productFieldsModel = Model('product_fields');
		$proFields = $productFieldsModel->getOneByID($id);
		Tpl::assign('proFields', $proFields);
		//下拉框  获取产品类型表的     类型名称
		$productTypeModel = Model('product_type');
		$arr=$productTypeModel->getList();
		Tpl::assign('type',$arr);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		//允许查看的角色ID,以逗号为分隔符
		$newAllowReadRole=explode(",",$proFields['allow_read_role']);
		Tpl::assign('newAllowReadRole', $newAllowReadRole);

		Tpl::assign('page_title', '修改产品属性名称');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newproFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newproFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newproFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newproFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newproFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newproFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newproFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newproFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newproFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newproFields['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newproFields['update_time']=getGMTime();
		$newproFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newproFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newproFields['allow_read_role'] = implode(',',$allow_read_role);

		$where = "`id`=$id";
		$productFieldsModel = Model('product_fields');
		if ($productFieldsModel->update($newproFields, $where)) {
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
		$productFieldsModel = Model('product_fields');
		if ($productFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

