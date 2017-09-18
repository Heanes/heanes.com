<?php
/**
 * @doc 财产类型控制器
 * @filesource PropertyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class PropertyController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 财产类型列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$propertyModel = Model('property');
		$page = new Page(10);
		$property_list = $propertyModel->getList('', $page);
		
		Tpl::assign('property_list', $property_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '财产类型列表');
		Tpl::display('property/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$propertyModel = Model('property');
		//获取自增ID
		$lastID = $propertyModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加财产类型');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newproperty['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproperty['name'] = Filter::doFilter($_POST['property_name'], 'string');
		$newproperty['reg_show'] = Filter::doFilter($_POST['reg_show'], 'string');
		$newproperty['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newproperty['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newproperty['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newproperty['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproperty['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$propertyModel = Model('property');
		if ($propertyModel->insert($newproperty)) {
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
		$propertyModel = Model('property');
		$property = $propertyModel->getOneByID($id);
		Tpl::assign('property', $property);
		Tpl::assign('page_title', '修改财产类型');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['property_id'], 'integer');
		$newproperty['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproperty['name'] = Filter::doFilter($_POST['property_name'], 'string');
		$newproperty['reg_show'] = Filter::doFilter($_POST['reg_show'], 'string');
		$newproperty['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newproperty['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newproperty['update_time'] = getGMTime();
		$newproperty['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproperty['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$propertyModel = Model('property');
		if ($propertyModel->update($newproperty, $where)) {
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
		$propertyModel = Model('property');
		if ($propertyModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

