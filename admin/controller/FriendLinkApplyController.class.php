<?php
/**
 * @doc 申请列表
 * @filesource FriendLinkApplyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 16:59:45
 */
defined('InHeanes') or exit('Access Invalid!');
class FriendLinkApplyController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}
	
	/**
	 * @doc 申请列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		$friendLinkApplyModel=Model('friend_link_apply');
		$page=new Page(10);
		$friendLinkApplyList=$friendLinkApplyModel->getList('',$page);
		Tpl::assign('friendLinkApplyList',$friendLinkApplyList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','申请列表');
		Tpl::display('friendlinkApply/list');
	}
	

	/**
	 * @doc 添加申请列表
	 * @author Heanes
	 * @time 2015-07-07 14:50:15
	 */
	public function addOp(){
		$friendLinkApplyModel = Model('friend_link_apply');
		//获取自增ID
		$lastID = $friendLinkApplyModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加申请');
		Tpl::display();
	}

	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-07-07 14:50:44
	 */
	public function insertOp(){
		$newFriendlinkApply['ip']=Filter::doFilter($_POST['ip'],'string');
		$newFriendlinkApply['name']=Filter::doFilter($_POST['friendLinkapply_name'],'string');
		$newFriendlinkApply['email']=Filter::doFilter($_POST['friendLinkapply_email'],'string');
		$newFriendlinkApply['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlinkApply['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newFriendlinkApply['insert_time']=to_timespan(Filter::doFilter($_POST['friendLinkapply_insert_time'],'string'));
		$newFriendlinkApply['update_time']=to_timespan(Filter::doFilter($_POST['friendLinkapply_update_time'],'string'));
		$newFriendlinkApply['status']=Filter::doFilter($_POST['status'],'integer');
		$newFriendlinkApply['description']=Filter::doFilter($_POST['friendLinkapply_description'],'string');
		$friendLinkApplyModel=Model('friend_link_apply');
		if($friendLinkApplyModel->insert($newFriendlinkApply)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改申请列表
	 * @author Heanes
	 * @time 2015-07-07 14:51:01
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$friendLinkApplyModel=Model('friend_link_apply');
		$friendLinkApply=$friendLinkApplyModel->getOneByID($id);
		Tpl::assign('friendLinkApply',$friendLinkApply);
		Tpl::assign('page_title','修改申请');
		Tpl::display();
	}

	/**
	 * @doc 修改申请列表
	 * @author Heanes
	 * @time 2015-07-07 14:51:22
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['friendLinkapply_id'],'integer');
		$newFriendlinkApply['ip']=Filter::doFilter($_POST['ip'],'string');
		$newFriendlinkApply['name']=Filter::doFilter($_POST['friendLinkapply_name'],'string');
		$newFriendlinkApply['email']=Filter::doFilter($_POST['friendLinkapply_email'],'string');
		$newFriendlinkApply['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newFriendlinkApply['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newFriendlinkApply['insert_time']=to_timespan(Filter::doFilter($_POST['friendLinkapply_insert_time'],'string'));
		$newFriendlinkApply['update_time']=getGMTime();
		$newFriendlinkApply['status']=Filter::doFilter($_POST['status'],'integer');
		$newFriendlinkApply['description']=Filter::doFilter($_POST['friendLinkapply_description'],'string');
		$where="`id`=$id";
		$friendLinkApplyModel=Model('friend_link_apply');
		if($friendLinkApplyModel->update($newFriendlinkApply,$where)){
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