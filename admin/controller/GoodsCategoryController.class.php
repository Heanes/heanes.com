<?php
/**
 * @doc 商品分类控制器
 * @filesource GoodsCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class GoodsCategoryController extends BaseAdminController {
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
		$goodsCategoryModel = Model('goods_category');
		$page = new Page(10);
		$goodsCategory_list = $goodsCategoryModel->getList('', $page);
		//分类访问用户组权限
		$userRoleModel = Model('user_role');       //角色表
		foreach ($goodsCategory_list as $key => $goodsCategory) {
			if(!empty($goodsCategory)){
				$userRoleInfo=$userRoleModel->getOneByID($goodsCategory['user_role_id']);
				$goodsCategory_list[$key]['user_role_name']=$userRoleInfo['name']; //根据user_role_id查询角色名称
			}
		}
		Tpl::assign('goodsCategory_list', $goodsCategory_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '商品分类列表');
		Tpl::display('goodsCategory/list');
	}

	
	/**
	 * @doc 获取下拉框父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$goodsCategoryModel=Model('goods_category');
		$goodsCategoryList=$goodsCategoryModel->getList();
		return $goodsCategoryList;
	}
	
	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$goodsCategoryModel = Model('goods_category');
		//获取自增ID
		$lastID = $goodsCategoryModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);

		//父分类ID
		$goodsCategoryList=$this->getSelectOption(); 
		Tpl::assign('goodsCategoryList',$goodsCategoryList);
		
		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		
		Tpl::assign('page_title', '添加商品分类');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newGoodsCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'string');
		$newGoodsCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newGoodsCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newGoodsCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newGoodsCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newGoodsCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newGoodsCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newGoodsCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newGoodsCategory['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newGoodsCategory['pwd'] = md5($newGoodsCategory['pwd']);
		$newGoodsCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newGoodsCategory['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newGoodsCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoodsCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newGoodsCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$goodsCategoryModel = Model('goods_category');
		if ($goodsCategoryModel->insert($newGoodsCategory)) {
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
		$goodsCategoryModel = Model('goods_category');
		$goodsCategory = $goodsCategoryModel->getOneByID($id);
		
		//父分类ID
		$goodsCategoryWhereParam['where']="`id` != '$id'";
		$goodsCategoryList=$goodsCategoryModel->getList($goodsCategoryWhereParam);
		Tpl::assign('goodsCategoryList',$goodsCategoryList);

		//分类访问用户组权限
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('goodsCategory', $goodsCategory);
		Tpl::assign('page_title', '修改商品分类');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['category_id'], 'integer');
		$newGoodsCategory['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'string');
		$newGoodsCategory['name'] = Filter::doFilter($_POST['category_name'], 'string');
		$newGoodsCategory['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newGoodsCategory['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newGoodsCategory['img_src'] = Filter::doFilter($_POST['img_src'], 'string');
		$newGoodsCategory['img_title'] = Filter::doFilter($_POST['img_title'], 'string');
		$newGoodsCategory['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newGoodsCategory['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newGoodsCategory['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newGoodsCategory['pwd'] = md5($newGoodsCategory['pwd']);
		$newGoodsCategory['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newGoodsCategory['update_time'] = getGMTime();
		$newGoodsCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoodsCategory['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newGoodsCategory['description'] = Filter::doFilter($_POST['description'], 'string');
		$where = "`id`=$id";
		$goodsCategoryModel = Model('goods_category');
		if ($goodsCategoryModel->update($newGoodsCategory, $where)) {
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
		$goodsCategoryModel = Model('goods_category');
		if ($goodsCategoryModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

