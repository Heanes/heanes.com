<?php
/**
 * @doc 产品属性映射控制器
 * @filesource ProductFieldsDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class ProductFieldsDataController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @doc 产品属性映射列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$productFieldsDataModel = Model('product_fields_data');
		$page = new Page(10);
		$productFieldsData_list = $productFieldsDataModel->getList('', $page);
		
		//产品属性名称字段表
		$productFieldsModel = Model('product_fields');
		//产品基本信息表
		$productModel = Model('product');
		
		foreach ($productFieldsData_list as $key => $productFieldsData) {
			if(!empty($productFieldsData)){
				$productFieldsInfo=$productFieldsModel->getOneByID($productFieldsData['fields_id']);
				$productFieldsData_list[$key]['fields_name']=$productFieldsInfo['name']; //属性ID
				
				$productInfo=$productModel->getOneByID($productFieldsData['product_id']);
				$productFieldsData_list[$key]['product_name']=$productInfo['name']; //产品ID
			}
		}
		
		
		Tpl::assign('productFieldsData_list', $productFieldsData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '产品属性映射列表');
		Tpl::display();
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$productFieldsDataModel = Model('product_fields_data');
		//获取自增ID
		$lastID = $productFieldsDataModel->getAutoIncrementId();
		
		//下拉框  产品属性名称字段表  属性ID
		$productFieldsModel = Model('product_fields');
		$arr=$productFieldsModel->getList();
		Tpl::assign('info',$arr);
		//下拉框    产品基本信息表    产品ID
		$productModel = Model('product');
		$arr=$productModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加产品属性映射');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newproFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newproFieldsData['product_id'] = Filter::doFilter($_POST['product_id'], 'string');
		$newproFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newproFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$productFieldsDataModel = Model('product_fields_data');
		if ($productFieldsDataModel->insert($newproFieldsData)) {
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
		$productFieldsDataModel = Model('product_fields_data');
		$proFieldsData = $productFieldsDataModel->getOneByID($id);
		
		//下拉框  产品属性名称字段表  属性ID
		$productFieldsModel = Model('product_fields');
		$arr=$productFieldsModel->getList();
		Tpl::assign('info',$arr);
		//下拉框    产品基本信息表    产品ID
		$productModel = Model('product');
		$arr=$productModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('proFieldsData', $proFieldsData);
		Tpl::assign('page_title', '修改产品属性映射');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newproFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'string');
		$newproFieldsData['product_id'] = Filter::doFilter($_POST['product_id'], 'string');
		$newproFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newproFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$where = "`id`=$id";
		$productFieldsDataModel = Model('product_fields_data');
		if ($productFieldsDataModel->update($newproFieldsData, $where)) {
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
		$productFieldsDataModel = Model('product_fields_data');
		if ($productFieldsDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

