<?php
/**
 * @doc 文件类型控制器
 * @filesource FileTypeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class FileTypeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 文件类型列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$fileTypeModel = Model('file_type');
		$page = new Page(10);
		$fileType_list = $fileTypeModel->getList('', $page);
		Tpl::assign('fileType_list', $fileType_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '文件类型列表');
		Tpl::display('fileType/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$fileTypeModel = Model('file_type');
		//获取自增ID
		$lastID = $fileTypeModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加文件类型');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newfileType['type'] = Filter::doFilter($_POST['type_name'], 'string');
		$newfileType['name'] = Filter::doFilter($_POST['type_des'], 'string');
		$newfileType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newfileType['description'] = Filter::doFilter($_POST['description'], 'string');
		$fileTypeModel = Model('file_type');
		if ($fileTypeModel->insert($newfileType)) {
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
		$fileTypeModel = Model('file_type');
		$fileType = $fileTypeModel->getOneByID($id);
		Tpl::assign('fileType', $fileType);
		Tpl::assign('page_title', '修改文件类型');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['type_id'], 'integer');
		$newfileType['type'] = Filter::doFilter($_POST['type_name'], 'string');
		$newfileType['name'] = Filter::doFilter($_POST['type_des'], 'string');
		$newfileType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newfileType['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$fileTypeModel = Model('file_type');
		if ($fileTypeModel->update($newfileType, $where)) {
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
		$fileTypeModel = Model('file_type');
		if ($fileTypeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

