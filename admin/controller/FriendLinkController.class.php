<?php
/**
 * @doc 友情链接列表
 * @filesource FriendLinkController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 16:59:45
 */
defined('InHeanes') or exit('Access Invalid!');

class FriendLinkController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}
	
	/**
	 * @doc 友情链接列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		$friendLinkModel=Model('friend_link');
		$page=new Page(10);
		$friendLink_list=$friendLinkModel->getList('',$page);
		Tpl::assign('friendLink_list',$friendLink_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','友情链接列表');
		Tpl::display('friendlink/list');
	}
	

	/**
	 * @doc 添加友情链接
	 * @author Heanes
	 * @time 2015-07-07 14:50:15
	 */
	public function addOp(){
		$friendLinkModel = Model('friend_link');
		//获取自增ID
		$lastID = $friendLinkModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加友情链接');
		Tpl::display();
	}

	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-07-07 14:50:44
	 */
	public function insertOp(){
		$newFriendlink['name']=Filter::doFilter($_POST['friendLink_name'],'string');
		$newFriendlink['email']=Filter::doFilter($_POST['friendLink_email'],'string');
		$newFriendlink['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlink['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newFriendlink['a_target']=Filter::doFilter($_POST['a_target'],'string');
		$newFriendlink['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newFriendlink['img_title']=Filter::doFilter($_POST['img_title'],'string');
		$newFriendlink['insert_time']=to_timespan(Filter::doFilter($_POST['friendLink_insert_time'],'string'));
		$newFriendlink['update_time']=to_timespan(Filter::doFilter($_POST['friendLink_update_time'],'string'));
		$newFriendlink['order']=Filter::doFilter($_POST['friendLink_order'],'string');
		$newFriendlink['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newFriendlink['description']=Filter::doFilter($_POST['friendLink_description'],'string');
		$friendLinkModel=Model('friend_link');
		if($friendLinkModel->insert($newFriendlink)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改友情链接
	 * @author Heanes
	 * @time 2015-07-07 14:51:01
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$friendLinkModel=Model('friend_link');
		$friendLink=$friendLinkModel->getOneByID($id);
		Tpl::assign('friendLink',$friendLink);
		Tpl::assign('page_title','修改友情链接');
		Tpl::display();
	}

	/**
	 * @doc 修改友情链接操作
	 * @author Heanes
	 * @time 2015-07-07 14:51:22
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['friendLink_id'],'integer');
		$newFriendlink['name']=Filter::doFilter($_POST['friendLink_name'],'string');
		$newFriendlink['email']=Filter::doFilter($_POST['friendLink_email'],'string');
		$newFriendlink['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlink['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newFriendlink['a_target']=Filter::doFilter($_POST['a_target'],'string');
		$newFriendlink['insert_time']=to_timespan(Filter::doFilter($_POST['friendLink_insert_time'],'string'));
		$newFriendlink['update_time']=getGMTime();
		$newFriendlink['order']=Filter::doFilter($_POST['friendLink_order'],'string');
		$newFriendlink['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newFriendlink['description']=Filter::doFilter($_POST['friendLink_description'],'string');
		$where="`id`=$id";
		$friendLinkModel=Model('friend_link');
		if($friendLinkModel->update($newFriendlink,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

	/**
	 * @doc 审核页面
	 * @author Heanes
	 * @time 2015-07-07 14:49:30
	 */
	public function checkOp(){
		;
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

