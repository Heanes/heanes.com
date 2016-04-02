<?php
/**
 * @doc 商品属性名称字段控制器
 * @filesource GoodsAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class GoodsAttributeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 商品属性名称列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$goodsFieldsModel = Model('goods_fields');
		$page = new Page(10);
		$goodsFields_list = $goodsFieldsModel->getList('', $page);
		
		//根据type_id查询类型表的类型名称
		$goodsTypeModel = Model('goods_type');
		foreach ($goodsFields_list as $key => $goodsFields) {
			if(!empty($goodsFields)){
				$goodsTypeInfo=$goodsTypeModel->getOneByID($goodsFields['type_id']);
				$goodsFields_list[$key]['type_name']=$goodsTypeInfo['name']; //类型ID
			}
		}
		
		Tpl::assign('goodsFields_list', $goodsFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '商品属性名称列表');
		Tpl::display('goodsAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$goodsFieldsModel = Model('goods_fields');
		//获取自增ID
		$lastID = $goodsFieldsModel->getAutoIncrementId();
		//下拉框 获取商品类型表的类型名称
		$goodsTypeModel = Model('goods_type');
		$goodsTypeArr=$goodsTypeModel->getList();
		Tpl::assign('goodsTypeArr',$goodsTypeArr);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加商品属性名称');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newGoodsFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newGoodsFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newGoodsFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newGoodsFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newGoodsFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newGoodsFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newGoodsFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newGoodsFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newGoodsFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newGoodsFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoodsFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newGoodsFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newGoodsFields['allow_read_role'] = implode(',',$allow_read_role);

		$goodsFieldsModel = Model('goods_fields');
		if ($goodsFieldsModel->insert($newGoodsFields)) {
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
		$goodsFieldsModel = Model('goods_fields');
		$goodsFields = $goodsFieldsModel->getOneByID($id);
		
		//下拉框 获取商品类型表的类型名称
		$goodsTypeModel = Model('goods_type');
		$goodsTypeArr=$goodsTypeModel->getList();
		Tpl::assign('goodsTypeArr',$goodsTypeArr);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		//允许查看的角色ID,以逗号为分隔符
		$newAllowReadRole=explode(",",$goodsFields['allow_read_role']);
		Tpl::assign('newAllowReadRole', $newAllowReadRole);
		
		Tpl::assign('goodsFields', $goodsFields);
		Tpl::assign('page_title', '修改商品属性名称');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newGoodsFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newGoodsFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newGoodsFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newGoodsFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newGoodsFields['accept_type'] = Filter::doFilter($_POST['accept_type'], 'string');
		$newGoodsFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newGoodsFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newGoodsFields['as_filter'] = Filter::doFilter($_POST['as_filter'], 'string');
		$newGoodsFields['is_show'] = Filter::doFilter($_POST['is_show'], 'string');
		$newGoodsFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoodsFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		//允许查看的最小角色ID
		$newGoodsFields['allow_read_min_role_level'] = Filter::doFilter($_POST['allow_read_min_role_level'], 'string');
		//允许查看的角色ID,以逗号为分隔符
		$allow_read_role=$_POST['allow_read_role'];
		$newGoodsFields['allow_read_role'] = implode(',',$allow_read_role);

		$where = "`id`=$id";
		$goodsFieldsModel = Model('goods_fields');
		if ($goodsFieldsModel->update($newGoodsFields, $where)) {
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
		$goodsFieldsModel = Model('goods_fields');
		if ($goodsFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

