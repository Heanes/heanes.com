<?php
/**
 * @doc 文件分类控制器
 * @filesource FileCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class FileCategoryController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 文件分类列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$fileCategoryModel = Model('file_category');
		$page = new Page(10);
		$fileCategory_list = $fileCategoryModel->getList('', $page);
		//允许访问角色
		$userRoleModel = Model('user_role');       //角色表
		$fileTypeModel = Model('file_type');       //文件类型表
		foreach ($fileCategory_list as $key => $fileCategory) {
			if(!empty($fileCategory)){
				$userRoleInfo=$userRoleModel->getOneByID($fileCategory['user_role_id']);
				$fileCategory_list[$key]['user_role_name']=$userRoleInfo['name']; //根据user_role_id查询角色名称
				
				$fileTypeInfo=$fileTypeModel->getOneByID($fileCategory['file_type']);
				$fileCategory_list[$key]['type_name']=$fileTypeInfo['name']; //根据file_type查询文件类型名称
			}
		}
		
		Tpl::assign('fileCategory_list', $fileCategory_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '文件分类列表');
		Tpl::display('fileCategory/list');
	}
	
	/**
	 * @doc 父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$fileCategoryModel = Model('file_category');
		$fileCategory=$fileCategoryModel->getList();
		array_unshift($fileCategory, "0"); 
		Tpl::assign('fileCategory',$fileCategory);
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$fileCategoryModel = Model('file_category');
		//获取自增ID
		$lastID = $fileCategoryModel->getAutoIncrementId();
		
		//允许存储文件的类型的下拉框
		$fileTypeModel = Model('file_type');
		$fileType_List = $fileTypeModel->getList();
		Tpl::assign('fileType_List',$fileType_List);
		
		//父分类ID
		$this->getSelectOption(); 
		
		//允许访问角色
		$userRoleModel = Model('user_role');
		$userRole_List = $userRoleModel->getList();
		Tpl::assign('userRole_List',$userRole_List);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加文件分类');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newfileCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newfileCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newfileCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newfileCategory['desc'] = Filter::doFilter($_POST['desc'], 'string');
		$newfileCategory['path'] = Filter::doFilter($_POST['path'], 'string');
		$newfileCategory['file_type'] = Filter::doFilter($_POST['file_type'], 'string');
		$newfileCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newfileCategory['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newfileCategory['pwd'] = md5($newfileCategory['pwd']);
		$newfileCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newfileCategory['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newfileCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newfileCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$fileCategoryModel = Model('file_category');
		if ($fileCategoryModel->insert($newfileCategory)) {
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
		$fileCategoryModel = Model('file_category');
		$fileCategory = $fileCategoryModel->getOneByID($id);
		
		//允许存储文件的类型的下拉框
		$fileTypeModel = Model('file_type');
		$fileType_List = $fileTypeModel->getList();
		Tpl::assign('fileType_List',$fileType_List);
		
		//父分类ID
		$fileCategoryWhereParam['where']="`id` != '$id'";
		$fileCategoryArr=$fileCategoryModel->getList($fileCategoryWhereParam);
		array_unshift($fileCategoryArr, "0"); 
		Tpl::assign('fileCategoryArr',$fileCategoryArr);
		
		//允许访问角色
		$userRoleModel = Model('user_role');
		$userRole_List = $userRoleModel->getList();
		Tpl::assign('userRole_List',$userRole_List);
		
		Tpl::assign('fileCategory', $fileCategory);
		Tpl::assign('page_title', '修改文件分类');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['category_id'], 'integer');
		$newfileCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newfileCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newfileCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newfileCategory['desc'] = Filter::doFilter($_POST['desc'], 'string');
		$newfileCategory['path'] = Filter::doFilter($_POST['path'], 'string');
		$newfileCategory['file_type'] = Filter::doFilter($_POST['file_type'], 'string');
		$newfileCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newfileCategory['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newfileCategory['pwd'] = md5($newfileCategory['pwd']);
		$newfileCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'], 'string'));
		$newfileCategory['update_time'] = getGMTime();
		$newfileCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newfileCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$fileCategoryModel = Model('file_category');
		if ($fileCategoryModel->update($newfileCategory, $where)) {
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
		$fileCategoryModel = Model('file_category');
		if ($fileCategoryModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

