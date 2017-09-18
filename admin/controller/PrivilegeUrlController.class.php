<?php
/**
 * @doc 功能权限存储库控制器
 * @filesource PrivilegeUrlController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class PrivilegeUrlController extends BaseAdminController{
	public function __construct(){
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
		$privilegeUrlModel = Model('privilege_url');
		$page = new Page(10);
		$privilegeUrl_list = $privilegeUrlModel->getList('', $page);
		Tpl::assign('privilegeUrl_list', $privilegeUrl_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '功能权限存储库列表');
		Tpl::display('privilegeUrl/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$privilegeUrlModel = Model('privilege_url');
		//获取自增ID
		$lastID = $privilegeUrlModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加功能权限存储库');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$privilegeUrlModel = Model('privilege_url');
		$privilegeUrl = $privilegeUrlModel->getOneByID($id);
		Tpl::assign('privilegeUrl', $privilegeUrl);
		Tpl::assign('page_title', '修改功能权限存储库');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newprivilegeUrl['name'] = Filter::doFilter($_POST['privilege_name'], 'string');
		$newprivilegeUrl['class'] = Filter::doFilter($_POST['class_name'], 'string');
		$newprivilegeUrl['method'] = Filter::doFilter($_POST['method'], 'string');
		$newprivilegeUrl['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newprivilegeUrl['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newprivilegeUrl['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newprivilegeUrl['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newprivilegeUrl['description']=Filter::doFilter($_POST['description'],'string');
		$privilegeUrlModel = Model('privilege_url');
		if ($privilegeUrlModel->insert($newprivilegeUrl)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['privilege_id'], 'integer');
		$newprivilegeUrl['name'] = Filter::doFilter($_POST['privilege_name'], 'string');
		$newprivilegeUrl['class'] = Filter::doFilter($_POST['class_name'], 'string');
		$newprivilegeUrl['method'] = Filter::doFilter($_POST['method'], 'string');
		$newprivilegeUrl['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newprivilegeUrl['update_time'] = getGMTime();
		$newprivilegeUrl['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newprivilegeUrl['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newprivilegeUrl['description']=Filter::doFilter($_POST['description'],'string');
		$where = "`id`=$id";
		$privilegeUrlModel = Model('privilege_url');
		if ($privilegeUrlModel->update($newprivilegeUrl, $where)) {
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
		$privilegeUrlModel = Model('privilege_url');
		if ($privilegeUrlModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

