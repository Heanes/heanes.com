<?php
/**
 * @doc 友情链接分类列表
 * @filesource FriendlinkCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 16:59:45
 */
defined('InHeanes') or exit('Access Invalid!');
class FriendlinkCategoryController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}
	
	/**
	 * @doc 友情链接分类列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		$friendlinkCategoryModel=Model('friend_link_category');
		$page=new Page(10);
		$friendlinkCategoryList=$friendlinkCategoryModel->getList('',$page);

		Tpl::assign('friendlinkCategoryList',$friendlinkCategoryList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','友情链接分类列表');
		Tpl::display('friendlinkCategory/list');
	}
	

	/**
	 * @doc 获取下拉框父分类ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父分类ID
		$friendlinkCategoryModel=Model('friend_link_category');
		$friendlinkCategoryList=$friendlinkCategoryModel->getList();
		return $friendlinkCategoryList;
	}

	/**
	 * @doc 添加申请列表
	 * @author Heanes
	 * @time 2015-07-07 14:50:15
	 */
	public function addOp(){
		$friendlinkCategoryModel=Model('friend_link_category');
		//获取自增ID
		$lastID = $friendlinkCategoryModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);

		//父分类ID
		$friendlinkCategoryList=$this->getSelectOption();
		Tpl::assign('friendlinkCategoryList',$friendlinkCategoryList);

		Tpl::assign('page_title','添加友情链接分类');
		Tpl::display();
	}

	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-07-07 14:50:44
	 */
	public function insertOp(){
		$newFriendlinkCategory['order']=Filter::doFilter($_POST['order'],'integer');
		$newFriendlinkCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newFriendlinkCategory['name']=Filter::doFilter($_POST['friendlinkCategory_name'],'string');
		$newFriendlinkCategory['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newFriendlinkCategory['img_title']=Filter::doFilter($_POST['img_title'],'string');
		$newFriendlinkCategory['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlinkCategory['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newFriendlinkCategory['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newFriendlinkCategory['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newFriendlinkCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newFriendlinkCategory['description']=Filter::doFilter($_POST['description'],'string');
		$friendlinkCategoryModel=Model('friend_link_category');
		if($friendlinkCategoryModel->insert($newFriendlinkCategory)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}

		print_r($newFriendlinkCategory);
	}

	/**
	 * @doc 修改友情链接分类列表
	 * @author Heanes
	 * @time 2015-07-07 14:51:01
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$friendlinkCategoryModel=Model('friend_link_category');
		$friendlinkCategory=$friendlinkCategoryModel->getOneByID($id);

		//父分类ID
		$friendlinkCategoryWhereParam['where']="`id` != '$id'";
		$friendlinkCategoryList=$friendlinkCategoryModel->getList($friendlinkCategoryWhereParam);
		Tpl::assign('friendlinkCategoryList',$friendlinkCategoryList);

		Tpl::assign('friendlinkCategory',$friendlinkCategory);
		Tpl::assign('page_title','修改友情链接分类');
		Tpl::display();
	}

	/**
	 * @doc 修改友情链接分类列表
	 * @author Heanes
	 * @time 2015-07-07 14:51:22
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['friendlinkCategory_id'],'integer');
		$newFriendlinkCategory['order']=Filter::doFilter($_POST['order'],'integer');
		$newFriendlinkCategory['parent_id'] = Filter::doFilter($_POST['parent_id'], 'integer');
		$newFriendlinkCategory['name']=Filter::doFilter($_POST['friendlinkCategory_name'],'string');
		$newFriendlinkCategory['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newFriendlinkCategory['img_title']=Filter::doFilter($_POST['img_title'],'string');
		$newFriendlinkCategory['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlinkCategory['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newFriendlinkCategory['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newFriendlinkCategory['update_time']=getGMTime();
		$newFriendlinkCategory['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newFriendlinkCategory['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$friendlinkCategoryModel=Model('friend_link_category');
		if($friendlinkCategoryModel->update($newFriendlinkCategory,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}



	/**
	 * @doc 统计页面
	 * @author Heanes
	 * @time 2015-07-07 14:51:46
	 */
	public function countOp(){
		;
	}
}