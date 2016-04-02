<?php
/**
 * @doc 商品属性映射管理控制器
 * @filesource GoodsAttributeDataController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:15:21
 */
defined('InHeanes') or exit('Access Invalid!');

class GoodsAttributeDataController extends BaseAdminController {
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
		$goodsFieldsDataModel = Model('goods_fields_data');
		$page = new Page(10);
		$goodsFieldsData_list = $goodsFieldsDataModel->getList('', $page);

		$goodsFieldsModel = Model('goods_fields');
		$goodsModel = Model('goods');
		foreach ($goodsFieldsData_list as $key => $goodsFieldsData) {
			if(!empty($goodsFieldsData)){
				$goodsFieldsInfo=$goodsFieldsModel->getOneByID($goodsFieldsData['fields_id']);
				$goodsFieldsData_list[$key]['fields_name']=$goodsFieldsInfo['name']; //属性ID

				$goodsInfo=$goodsModel->getOneByID($goodsFieldsData['goods_id']);
				$goodsFieldsData_list[$key]['goods_name']=$goodsInfo['name']; //商品ID
			}
		}
		Tpl::assign('goodsFieldsData_list', $goodsFieldsData_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '商品属性映射列表');
		Tpl::display('goodsAttributeData/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$goodsFieldsDataModel = Model('goods_fields_data');
		//获取自增ID
		$lastID = $goodsFieldsDataModel->getAutoIncrementId();
		//下拉框 属性名称
		$goodsFieldsModel = Model('goods_fields');
		$goodsFields=$goodsFieldsModel->getList();
		Tpl::assign('goodsFields',$goodsFields);
		//下拉框 商品名称
		$goodsModel = Model('goods');
		$goods=$goodsModel->getList();
		Tpl::assign('goods',$goods);

		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加商品属性映射');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newGoodsFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'integer');
		$newGoodsFieldsData['goods_id'] = Filter::doFilter($_POST['goods_id'], 'integer');
		$newGoodsFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newGoodsFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$goodsFieldsDataModel = Model('goods_fields_data');
		if ($goodsFieldsDataModel->insert($newGoodsFieldsData)) {
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
		$goodsFieldsDataModel = Model('goods_fields_data');
		$goodsFieldsData = $goodsFieldsDataModel->getOneByID($id);
		//下拉框 属性名称
		$goodsFieldsModel = Model('goods_fields');
		$goodsFields=$goodsFieldsModel->getList();
		Tpl::assign('goodsFields',$goodsFields);
		//下拉框 商品名称
		$goodsModel = Model('goods');
		$goods=$goodsModel->getList();
		Tpl::assign('goods',$goods);

		Tpl::assign('goodsFieldsData', $goodsFieldsData);
		Tpl::assign('page_title', '修改商品属性映射');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attributeData_id'], 'integer');
		$newGoodsFieldsData['fields_id'] = Filter::doFilter($_POST['fields_id'], 'integer');
		$newGoodsFieldsData['goods_id'] = Filter::doFilter($_POST['goods_id'], 'integer');
		$newGoodsFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'], 'string');
		$newGoodsFieldsData['fields_price'] = Filter::doFilter($_POST['fields_price'], 'string');
		$where = "`id`=$id";
		$goodsFieldsDataModel = Model('goods_fields_data');
		if ($goodsFieldsDataModel->update($newGoodsFieldsData, $where)) {
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
		$goodsFieldsDataModel = Model('goods_fields_data');
		if ($goodsFieldsDataModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}



}

