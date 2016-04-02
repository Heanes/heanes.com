<?php
/**
 * @doc 物品属性映射控制器
 * @filesource WareAttributeDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class WareAttributeDataController extends BaseAdminController {
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
		$wareFieldsDataModel = Model('ware_fields_data');
		$page = new Page(10);
		$wareFieldsData_list = $wareFieldsDataModel->getList('', $page);
		
		//物品属性名称表
		$wareFieldsModel = Model('ware_fields');
		//物品基本信息表
		$wareModel = Model('ware');
		foreach ($wareFieldsData_list as $key => $wareFieldsData) {
			if(!empty($wareFieldsData)){
				$wareFieldsInfo=$wareFieldsModel->getOneByID($wareFieldsData['fields_id']);
				$wareFieldsData_list[$key]['fields_name']=$wareFieldsInfo['name']; //属性名称
				
				$wareInfo=$wareModel->getOneByID($wareFieldsData['ware_id']);
				$wareFieldsData_list[$key]['ware_name']=$wareInfo['name']; //物品名称
			}
		}
		Tpl::assign('wareFieldsData_list', $wareFieldsData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '物品属性映射列表');
		Tpl::display('wareAttributeData/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$wareFieldsDataModel = Model('ware_fields_data');
		//获取自增ID
		$lastID = $wareFieldsDataModel->getAutoIncrementId();
		
		//下拉框 物品属性名称字段表  属性名称
		$wareFieldsModel = Model('ware_fields');
		$wareFieldsList=$wareFieldsModel->getList();
		Tpl::assign('wareFieldsList',$wareFieldsList);
		//下拉框    物品基本信息表    物品名称
		$wareModel = Model('ware');
		$wareList=$wareModel->getList();
		Tpl::assign('wareList',$wareList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加物品属性映射');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newwareFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'integer');
		$newwareFieldsData['ware_id'] = Filter::doFilter($_POST['ware_id'], 'integer');
		$newwareFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newwareFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$wareFieldsDataModel = Model('ware_fields_data');
		if ($wareFieldsDataModel->insert($newwareFieldsData)) {
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
		$wareFieldsDataModel = Model('ware_fields_data');
		$wareFieldsData = $wareFieldsDataModel->getOneByID($id);
		
		//下拉框 物品属性名称字段表  属性名称
		$wareFieldsModel = Model('ware_fields');
		$wareFieldsList=$wareFieldsModel->getList();
		Tpl::assign('wareFieldsList',$wareFieldsList);
		//下拉框    物品基本信息表    物品名称
		$wareModel = Model('ware');
		$wareList=$wareModel->getList();
		Tpl::assign('wareList',$wareList);
		
		Tpl::assign('wareFieldsData', $wareFieldsData);
		Tpl::assign('page_title', '修改物品属性映射');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newwareFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'integer');
		$newwareFieldsData['ware_id'] = Filter::doFilter($_POST['ware_id'], 'integer');
		$newwareFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newwareFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$where = "`id`=$id";
		$wareFieldsDataModel = Model('ware_fields_data');
		if ($wareFieldsDataModel->update($newwareFieldsData, $where)) {
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
		$wareFieldsDataModel = Model('ware_fields_data');
		if ($wareFieldsDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

