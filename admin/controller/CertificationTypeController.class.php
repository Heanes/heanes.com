<?php
/**
 * @doc 认证方式类别控制器
 * @filesource CertificationTypeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class CertificationTypeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 认证方式类别列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$certificationTypeModel = Model('certification_type');
		$page = new Page(10);
		$certificationType_list = $certificationTypeModel->getList('', $page);
		
		Tpl::assign('certificationType_list', $certificationType_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '认证方式类别列表');
		Tpl::display('certificationType/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$certificationTypeModel = Model('certification_type');
		//获取自增ID
		$lastID = $certificationTypeModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加认证方式类别');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newcertificationType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newcertificationType['name'] = Filter::doFilter($_POST['type_name'], 'string');
		$newcertificationType['code'] = Filter::doFilter($_POST['code'], 'string');
		$newcertificationType['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newcertificationType['img_alt'] = Filter::doFilter($_POST['img_alt'], 'string');
		$newcertificationType['requirement'] = Filter::doFilter($_POST['requirement'], 'string');
		$newcertificationType['tips'] = Filter::doFilter($_POST['tips'], 'string');
		$newcertificationType['point'] = Filter::doFilter($_POST['point'], 'string');
		$newcertificationType['add_show'] = Filter::doFilter($_POST['add_show'], 'string');
		$newcertificationType['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newcertificationType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newcertificationType['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newcertificationType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newcertificationType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newcertificationType['description'] = Filter::doFilter($_POST['description'], 'string');
		$certificationTypeModel = Model('certification_type');
		if ($certificationTypeModel->insert($newcertificationType)) {
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
		$certificationTypeModel = Model('certification_type');
		$certificationType = $certificationTypeModel->getOneByID($id);
		Tpl::assign('certificationType', $certificationType);
		Tpl::assign('page_title', '修改认证方式类别');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['type_id'], 'integer');
		$newcertificationType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newcertificationType['name'] = Filter::doFilter($_POST['type_name'], 'string');
		$newcertificationType['code'] = Filter::doFilter($_POST['code'], 'string');
		$newcertificationType['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newcertificationType['img_alt'] = Filter::doFilter($_POST['img_alt'], 'string');
		$newcertificationType['requirement'] = Filter::doFilter($_POST['requirement'], 'string');
		$newcertificationType['tips'] = Filter::doFilter($_POST['tips'], 'string');
		$newcertificationType['point'] = Filter::doFilter($_POST['point'], 'string');
		$newcertificationType['add_show'] = Filter::doFilter($_POST['add_show'], 'string');
		$newcertificationType['is_required'] = Filter::doFilter($_POST['is_required'], 'string');
		$newcertificationType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newcertificationType['update_time'] = getGMTime();
		$newcertificationType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newcertificationType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newcertificationType['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$certificationTypeModel = Model('certification_type');
		if ($certificationTypeModel->update($newcertificationType, $where)) {
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
		$certificationTypeModel = Model('certification_type');
		if ($certificationTypeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

