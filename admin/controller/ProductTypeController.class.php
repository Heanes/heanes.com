<?php
/**
 * @doc 产品类型表，将产品属性归为一类控制器
 * @filesource ProductTypeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class ProductTypeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 产品类型列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$productTypeModel = Model('product_type');
		$page = new Page(10);
		$productType_list = $productTypeModel->getList('', $page);
		Tpl::assign('productType_list', $productType_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '产品类型列表');
		Tpl::display('productType/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$productTypeModel = Model('product_type');
		//获取自增ID
		$lastID = $productTypeModel->getAutoIncrementId();
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);

		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加产品类型');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		//添加类型
		$newProductType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newProductType['name'] = Filter::doFilter($_POST['type_name'], 'string');
		$newProductType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newProductType['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newProductType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newProductType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newProductType['description'] = Filter::doFilter($_POST['description'], 'string');
		$productTypeModel = Model('product_type');
		if ($newProductTypeID=$productTypeModel->insert($newProductType)) {
			//添加多个属性
			if( isset($_POST['data']) && count($_POST['data']['fields_attribute_name'])){
				$add_count=count($_POST['data']['fields_attribute_name']);
				$flag=true;
				for($i=0; $i<$add_count; $i++){
					$fields_attribute_name = Filter::doFilter($_POST['data']['fields_attribute_name'][$i], 'string');
					//如果属性名称为空就不插入数据库
					if(!empty($fields_attribute_name)) {
						$newFields['type_id'] = $newProductTypeID;
						$newFields['name'] = $fields_attribute_name;
						$newFields['input_type'] = Filter::doFilter($_POST['data']['fields_input_type'][$i], 'string');
						$newFields['input_value'] = Filter::doFilter($_POST['data']['fields_input_value'][$i], 'string');
						$newFields['value_unit'] = Filter::doFilter($_POST['data']['fields_value_unit'][$i], 'string');
						$newFields['as_filter'] = Filter::doFilter($_POST['data']['fields_as_filter'][$i], 'integer');
						$newFields['is_show'] = Filter::doFilter($_POST['data']['fields_is_show'][$i], 'integer');
						$newFields['allow_read_min_role_level'] = Filter::doFilter($_POST['data']['allow_read_min_role_level'][$i], 'string');
						$allow_read_role = $_POST['data']['allow_read_role'][$i];  //允许查看的角色ID
						$newFields['allow_read_role'] = implode(',',$allow_read_role);
						$productFieldsModel = Model('product_fields');
						$flag=$productFieldsModel->insert($newFields);
						unset($newFields);
					}
				}
				if ($flag) {
					showSuccess('添加成功');
				} else {
					showError('添加失败');
				}
			}else {
				showSuccess('添加成功');
			}
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
		//编辑类型
		$id = Filter::doFilter($_GET['id'], 'integer');
		$productTypeModel = Model('product_type');
		$productType = $productTypeModel->getOneByID($id);
		//编辑属性
		$productFieldsModel = Model('product_fields');
		$productFieldsParam['where']="`type_id`='$id'";
		$productFieldsList=$productFieldsModel->getList($productFieldsParam);
		//查看角色
		$userRoleModel = Model('user_role');
		$userRole=$userRoleModel->getList();
		Tpl::assign('userRole',$userRole);
		//允许查看的角色ID,以逗号为分隔符
		foreach($productFieldsList as $key => $productFields){
			$productFieldsList[$key]['allowReadRole'] = explode(',',$productFields['allow_read_role']);
		}
		Tpl::assign('productFieldsList', $productFieldsList);
		Tpl::assign('productType', $productType);
		Tpl::assign('page_title', '修改产品类型');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		//修改类型
		$id = Filter::doFilter($_POST['type_id'], 'integer');
		$newProductType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newProductType['name'] = Filter::doFilter($_POST['type_name'], 'string');
		$newProductType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newProductType['update_time'] = getGMTime();
		$newProductType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newProductType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newProductType['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$productTypeModel = Model('product_type');
		$productFieldsModel = Model('product_fields');
		
		if ($productType_flag = $productTypeModel->update($newProductType, $where)) {
			//修改多个属性
			$productFieldsParam['where']="`type_id`='$id'";
			$productFieldsList=$productFieldsModel->getList($productFieldsParam);
			
			$oldProductFieldsList=$productFieldsList;//原先有的属性字段列表
			$newProductFieldsList = $_POST['data'];//新提交的属性字段列表
			//修改和删除
			foreach ($oldProductFieldsList as $key => $oldProductFields) {
				//1.1纯修改；
				if(in_array($oldProductFields['id'],$newProductFieldsList['fields_attribute_id'])){
					$fields_one_id = $newProductFieldsList['fields_attribute_id'][$key];
					$update_where ="`id`='$fields_one_id'";
					$newFields['order'] = Filter::doFilter($_POST['data']['fields_order'][$key], 'integer');
					$newFields['name'] = Filter::doFilter($_POST['data']['fields_attribute_name'][$key], 'string');
					$newFields['input_type'] = Filter::doFilter($_POST['data']['fields_input_type'][$key], 'string');
					$newFields['input_value'] = Filter::doFilter($_POST['data']['fields_input_value'][$key], 'string');
					$newFields['value_unit'] = Filter::doFilter($_POST['data']['fields_value_unit'][$key], 'string');
					$newFields['as_filter'] = Filter::doFilter($_POST['data']['fields_as_filter'][$key], 'string');
					$newFields['is_show'] = Filter::doFilter($_POST['data']['fields_is_show'][$key], 'string');
					$newFields['allow_read_min_role_level'] = Filter::doFilter($_POST['data']['allow_read_min_role_level'][$key], 'string');
					//允许查看的角色ID,以逗号为分隔符，根据隐藏的属性ID
					$allow_read_role=$_POST['data']['allow_read_role'][$fields_one_id];
					$newFields['allow_read_role'] = implode(',',$allow_read_role);

					$fields_update_flag=$productFieldsModel->update($newFields,$update_where);
					unset($newFields);
					if(!$fields_update_flag){
						showError('修改失败');
					}
				}else {
					$delete_Id_where ="`id`='".$oldProductFields['id']."'";
					$fields_delete_flag=$productFieldsModel->delete($delete_Id_where);
					if(!$fields_delete_flag){
						showError('删除失败');
					}
				}
			}
			
			//有添加新数据
			if(isset($_POST['data']['new_fields_attribute_name']) && count($_POST['data']['new_fields_attribute_name'])){
				foreach ($_POST['data']['new_fields_attribute_name'] as $key => $newInsertFildsValue) {
					$fields_attribute_name = Filter::doFilter($_POST['data']['new_fields_attribute_name'][$key], 'string');
					if(!empty($fields_attribute_name)){
						$newInsertFields['type_id'] = $id;
						$newInsertFields['order'] = Filter::doFilter($_POST['data']['new_fields_order'][$key], 'integer');
						$newInsertFields['name'] = $fields_attribute_name;
						$newInsertFields['input_type'] = Filter::doFilter($_POST['data']['new_fields_input_type'][$key], 'string');
						$newInsertFields['input_value'] = Filter::doFilter($_POST['data']['new_fields_input_value'][$key], 'string');
						$newInsertFields['value_unit'] = Filter::doFilter($_POST['data']['new_fields_value_unit'][$key], 'string');
						$newInsertFields['as_filter'] = Filter::doFilter($_POST['data']['new_fields_as_filter'][$key], 'string');
						$newInsertFields['is_show'] = Filter::doFilter($_POST['data']['new_fields_is_show'][$key], 'string');
						$newInsertFields['allow_read_min_role_level'] = Filter::doFilter($_POST['data']['new_allow_read_min_role_level'][$key], 'string');
						//允许查看的角色ID
						$allow_read_role = $_POST['data']['new_allow_read_role'][$key];
						$newInsertFields['allow_read_role'] = implode(',',$allow_read_role);

						$fields_insert_flag=$productFieldsModel->insert($newInsertFields);
						unset($newInsertFields);
						if(!$fields_insert_flag){
							showError('添加失败失败');
						}
					}
				}
			}
			$flag=isset($productType_flag)? $productType_flag :true;
			$flag =$flag && isset($fields_update_flag)? $fields_update_flag :true;
			$flag =$flag && isset($fields_delete_flag)? $fields_delete_flag :true;
			$flag =$flag && isset($fields_insert_flag)? $fields_insert_flag :true;
			if($flag){
				showSuccess('修改成功');
			}else {
				showError('修改失败');
			}
     	}else {
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
		$productTypeModel = Model('product_type');
		if ($productTypeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

