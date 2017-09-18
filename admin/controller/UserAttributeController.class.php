<?php
/**
 * @doc 用户额外属性库控制器
 * @filesource UserAttributeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserAttributeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户额外属性列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userFieldsModel = Model('user_fields');
		$page = new Page(10);
		$userFields_list = $userFieldsModel->getList('', $page);
		Tpl::assign('userFields_list', $userFields_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户额外属性列表');
		Tpl::display('userAttribute/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userFieldsModel = Model('user_fields');
		//获取自增ID
		$lastID = $userFieldsModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户额外属性');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newUserFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newUserFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newUserFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newUserFields['add_show'] = Filter::doFilter($_POST['add_show'], 'integer');
		$newUserFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newUserFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newUserFields['update_time'] = getGMTime();
		$newUserFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$userFieldsModel = Model('user_fields');
		if ($userFieldsModel->insert($newUserFields)) {
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
		$userFieldsModel = Model('user_fields');
		$userFields = $userFieldsModel->getOneByID($id);
		Tpl::assign('userFields', $userFields);
		Tpl::assign('page_title', '修改会员');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['attribute_id'], 'integer');
		$newUserFields['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newUserFields['name'] = Filter::doFilter($_POST['attribute_name'], 'string');
		$newUserFields['input_type'] = Filter::doFilter($_POST['input_type'], 'string');
		$newUserFields['add_show'] = Filter::doFilter($_POST['add_show'], 'integer');
		$newUserFields['is_required'] = Filter::doFilter($_POST['is_required'], 'integer');
		$newUserFields['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newUserFields['update_time'] = getGMTime();
		$newUserFields['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$where = "`id`=$id";
		$userFieldsModel = Model('user_fields');
		if ($userFieldsModel->update($newUserFields, $where)) {
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
		$userFieldsModel = Model('user_fields');
		if ($userFieldsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

