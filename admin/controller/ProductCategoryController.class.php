<?php
/**
 * @doc 产品分类控制器
 * @filesource ProductCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class ProductCategoryController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 产品分类列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$productCategoryModel = Model('product_category');
		$page = new Page(10);
		$productCategory_list = $productCategoryModel->getList('', $page);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');       //角色表
		foreach ($productCategory_list as $key => $productCategory) {
			if(!empty($productCategory)){
				$userRoleInfo=$userRoleModel->getOneByID($productCategory['user_role_id']);
				$productCategory_list[$key]['user_role_name']=$userRoleInfo['name']; //根据user_role_id查询角色名称
			}
		}
		Tpl::assign('productCategory_list', $productCategory_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '产品分类列表');
		Tpl::display('productCategory/list');
	}

	
	/**
	 * @doc 获取下拉框父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$productCategoryModel=Model('product_category');
		$productCategoryList=$productCategoryModel->getList();
		return $productCategoryList;

	}
	
	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$productCategoryModel = Model('product_category');
		//获取自增ID
		$lastID = $productCategoryModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);

		//父分类ID
		$productCategoryList=$this->getSelectOption();
		Tpl::assign('productCategoryList',$productCategoryList);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);

		Tpl::assign('page_title', '添加产品分类');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newproductCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproductCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newproductCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newproductCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newproductCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newproductCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newproductCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newproductCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'integer');
		$newproductCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$pwd = Filter::doFilter($_POST['pwd'], 'string');
		$newproductCategory['pwd'] = md5($pwd);
		$newproductCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newproductCategory['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newproductCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproductCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newproductCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$productCategoryModel = Model('product_category');
		if ($productCategoryModel->insert($newproductCategory)) {
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
		$productCategoryModel = Model('product_category');
		$productCategory = $productCategoryModel->getOneByID($id);
		
		//父分类ID
		$productCategoryWhereParam['where']="`id` != '$id'";
		$productCategoryList=$productCategoryModel->getList($productCategoryWhereParam);
		Tpl::assign('productCategoryList',$productCategoryList);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('productCategory', $productCategory);
		Tpl::assign('page_title', '修改产品分类');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['category_id'], 'integer');
		$newproductCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newproductCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newproductCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newproductCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newproductCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newproductCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newproductCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newproductCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'integer');
		$newproductCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$pwd = Filter::doFilter($_POST['pwd'], 'string');
		$newproductCategory['pwd'] = md5($pwd);
		$newproductCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newproductCategory['update_time'] = getGMTime();
		$newproductCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newproductCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newproductCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$productCategoryModel = Model('product_category');
		if ($productCategoryModel->update($newproductCategory, $where)) {
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
		$productCategoryModel = Model('product_category');
		if ($productCategoryModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

