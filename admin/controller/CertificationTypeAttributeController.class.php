<?php
/**
 * @doc 认证属性控制器
 * @filesource CertificationTypeAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class CertificationTypeAttributeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 认证属性列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$certificationFieldsModel = Model('certification_type_fields');
		$page = new Page(10);
		$certificationFields_list = $certificationFieldsModel->getList('', $page);
		
		//认证类型表
		$certificationTypeModel = Model('certification_type');
		foreach ($certificationFields_list as $key => $certificationFields) {
			if(!empty($certificationFields)){
				$certificationTypeInfo=$certificationTypeModel->getOneByID($certificationFields['type_id']);
				$certificationFields_list[$key]['type_name']=$certificationTypeInfo['name']; //认证类型ID
			}
		}
		
		Tpl::assign('certificationFields_list', $certificationFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '认证属性列表');
		Tpl::display('certificationTypeAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$certificationFieldsModel = Model('certification_type_fields');
		//获取自增ID
		$lastID = $certificationFieldsModel->getAutoIncrementId();
		
		//下拉框    认证方式类别表
		$certificationTypeModel = Model('certification_type');  //认证类型ID
		$certificationTypeList=$certificationTypeModel->getList();
		Tpl::assign('certificationTypeList',$certificationTypeList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加认证属性');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newcertificationFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newcertificationFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newcertificationFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newcertificationFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newcertificationFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newcertificationFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newcertificationFields['add_show'] = Filter::doFilter($_POST['add_show'], 'string');
		$newcertificationFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newcertificationFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newcertificationFields['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newcertificationFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newcertificationFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$certificationFieldsModel = Model('certification_type_fields');
		if ($certificationFieldsModel->insert($newcertificationFields)) {
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
		$certificationFieldsModel = Model('certification_type_fields');
		$certificationFields = $certificationFieldsModel->getOneByID($id);
		
		//下拉框    认证方式类别表
		$certificationTypeModel = Model('certification_type');  //认证类型ID
		$certificationTypeList=$certificationTypeModel->getList();
		Tpl::assign('certificationTypeList',$certificationTypeList);
		
		Tpl::assign('certificationFields', $certificationFields);
		Tpl::assign('page_title', '修改认证属性');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newcertificationFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newcertificationFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newcertificationFields['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newcertificationFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newcertificationFields['input_value'] = Filter::doFilter($_POST['input_value'], 'string');
		$newcertificationFields['value_unit'] = Filter::doFilter($_POST['value_unit'], 'string');
		$newcertificationFields['add_show'] = Filter::doFilter($_POST['add_show'], 'string');
		$newcertificationFields['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newcertificationFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newcertificationFields['update_time'] = getGMTime();
		$newcertificationFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newcertificationFields['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$certificationFieldsModel = Model('certification_type_fields');
		if ($certificationFieldsModel->update($newcertificationFields, $where)) {
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
		$certificationFieldsModel = Model('certification_type_fields');
		if ($certificationFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

