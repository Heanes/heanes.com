<?php
/**
 * @doc 物品分类控制器
 * @filesource WareCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class WareCategoryController extends BaseAdminController {
	function __construct() {
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
		$wareCategoryModel = Model('ware_category');
		$page = new Page(10);
		$wareCategory_list = $wareCategoryModel->getList('', $page);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');       //角色表
		foreach ($wareCategory_list as $key => $wareCategory) {
			if(!empty($wareCategory)){
				$userRoleInfo=$userRoleModel->getOneByID($wareCategory['user_role_id']);
				$wareCategory_list[$key]['user_role_name']=$userRoleInfo['name']; //根据user_role_id查询角色名称
			}
		}

		Tpl::assign('wareCategory_list', $wareCategory_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '物品分类列表');
		Tpl::display('wareCategory/list');
	}

	
	/**
	 * @doc 获取下拉框父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$wareCategoryModel = Model('ware_category');
		$wareCategoryList=$wareCategoryModel->getList();
		return $wareCategoryList;
	}
	
	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$wareCategoryModel = Model('ware_category');
		//获取自增ID
		$lastID = $wareCategoryModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);

		//父分类ID
		$wareCategoryList=$this->getSelectOption();
		Tpl::assign('wareCategoryList',$wareCategoryList);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('page_title', '添加物品分类');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newwareCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newwareCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newwareCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newwareCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newwareCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newwareCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newwareCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newwareCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'integer');
		$newwareCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$pwd = Filter::doFilter($_POST['pwd'], 'string');
		$newwareCategory['pwd'] = md5($pwd);
		$newwareCategory['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newwareCategory['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newwareCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newwareCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newwareCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$wareCategoryModel = Model('ware_category');
		if ($wareCategoryModel->insert($newwareCategory)) {
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
		$wareCategoryModel = Model('ware_category');
		$wareCategory = $wareCategoryModel->getOneByID($id);

		//父分类ID
		$wareCategoryWhereParam['where']="`id` != '$id'";
		$wareCategoryList=$wareCategoryModel->getList($wareCategoryWhereParam);
		Tpl::assign('wareCategoryList',$wareCategoryList);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('wareCategory', $wareCategory);
		Tpl::assign('page_title', '修改物品分类');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['category_id'], 'integer');
		$newwareCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newwareCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newwareCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newwareCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newwareCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newwareCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newwareCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newwareCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'integer');
		$newwareCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$pwd = Filter::doFilter($_POST['pwd'], 'string');
		$newwareCategory['pwd'] = md5($pwd);
		$newwareCategory['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newwareCategory['update_time'] = getGMTime();
		$newwareCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newwareCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newwareCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$wareCategoryModel = Model('ware_category');
		if ($wareCategoryModel->update($newwareCategory, $where)) {
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
		$wareCategoryModel = Model('ware_category');
		if ($wareCategoryModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

