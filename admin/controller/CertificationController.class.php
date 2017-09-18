<?php
/**
 * @doc 用户认证控制器
 * @filesource CertificationController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class CertificationController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$certificationModel = Model('certification');
		$page = new Page(10);
		$certification_list = $certificationModel->getList('', $page);
		Tpl::assign('certification_list', $certification_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '部门列表');
		Tpl::display();
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$certificationModel = Model('certification');
		//获取自增ID
		$lastID = $certificationModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加部门');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$certificationModel = Model('certification');
		$certification = $certificationModel->getOneByID($id);
		Tpl::assign('certification', $certification);
		Tpl::assign('page_title', '修改部门');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newCertification['name'] = Filter::doFilter($_POST['certification_name'], 'string');
		$newCertification['pid'] = Filter::doFilter($_POST['certification_pid'], 'string');
		$newCertification['order'] = Filter::doFilter($_POST['certification_order'], 'string');
		$newCertification['english_name'] = Filter::doFilter($_POST['certification_english_name'], 'string');
		$newCertification['create_time'] = to_timespan(Filter::doFilter($_POST['certification_create_time'], 'string'));
		$newCertification['update_time'] = to_timespan(Filter::doFilter($_POST['certification_update_time'], 'string'));
		$newCertification['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newCertification['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newCertification['description'] = Filter::doFilter($_POST['certification_description'], 'string');
		$certificationModel = Model('certification');
		if ($certificationModel->insert($newCertification)) {
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
		$id = Filter::doFilter($_POST['certification_id'], 'integer');
		$newCertification['name'] = Filter::doFilter($_POST['certification_name'], 'string');
		$newCertification['pid'] = Filter::doFilter($_POST['certification_pid'], 'string');
		$newCertification['order'] = Filter::doFilter($_POST['certification_order'], 'string');
		$newCertification['english_name'] = Filter::doFilter($_POST['certification_english_name'], 'string');
		$newCertification['create_time'] = to_timespan(Filter::doFilter($_POST['certification_create_time'], 'string'));
		$newCertification['update_time'] = to_timespan(Filter::doFilter($_POST['certification_update_time'], 'string'));
		$newCertification['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newCertification['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newCertification['description'] = Filter::doFilter($_POST['certification_description'], 'string');
		$where = "`id`=$id";
		$certificationModel = Model('certification');
		if ($certificationModel->update($newCertification, $where)) {
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
		$certificationModel = Model('certification');
		if ($certificationModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

