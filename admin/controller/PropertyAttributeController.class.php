<?php
/**
 * @doc 财产类型属性存储控制器
 * @filesource ProAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class PropertyAttributeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc财产类型属性存储列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$propertyFieldsModel = Model('property_fields');
		$page = new Page(10);
		$propertyFields_list = $propertyFieldsModel->getList('', $page);
		
		//财产类型库存储表
		$propertyModel = Model('property');
		$property=$propertyModel->getList('',$page);
		
		foreach ($propertyFields_list as $key => $propertyFields) {
			if(!empty($propertyFields)){
				$propertyInfo=$propertyModel->getOneByID($propertyFields['property_id']);
				$propertyFields_list[$key]['property_name']=$propertyInfo['name']; //资产类型ID
			}
		}
		
		Tpl::assign('propertyFields_list', $propertyFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '财产类型属性列表');
		Tpl::display('propertyAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$propertyFieldsModel = Model('property_fields');
		//获取自增ID
		$lastID = $propertyFieldsModel->getAutoIncrementId();
		
		//下拉框  获取财产类型库存储表的     资产类型名称
		$propertyModel = Model('property');
		$arr=$propertyModel->getList();
		Tpl::assign('info',$arr);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加财产类型属性');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newpropertyFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newpropertyFields['property_id'] = Filter::doFilter($_POST['property_id'], 'string');
		$newpropertyFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newpropertyFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newpropertyFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newpropertyFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newpropertyFields['reg_show'] = Filter::doFilter($_POST['reg_show'], 'integer');
		$newpropertyFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newpropertyFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newpropertyFields['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newpropertyFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newpropertyFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$propertyFieldsModel = Model('property_fields');
		if ($propertyFieldsModel->insert($newpropertyFields)) {
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
		$propertyFieldsModel = Model('property_fields');
		$propertyFields = $propertyFieldsModel->getOneByID($id);
		
		//下拉框  获取财产类型库存储表的     资产类型名称
		$propertyModel = Model('property');
		$arr=$propertyModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('propertyFields', $propertyFields);
		Tpl::assign('page_title', '修改产财产类型属性');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newpropertyFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newpropertyFields['property_id'] = Filter::doFilter($_POST['property_id'], 'string');
		$newpropertyFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newpropertyFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newpropertyFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newpropertyFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newpropertyFields['reg_show'] = Filter::doFilter($_POST['reg_show'], 'integer');
		$newpropertyFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newpropertyFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newpropertyFields['update_time'] = getGMTime();
		$newpropertyFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newpropertyFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$propertyFieldsModel = Model('property_fields');
		if ($propertyFieldsModel->update($newpropertyFields, $where)) {
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
		$propertyFieldsModel = Model('property_fields');
		if ($propertyFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

