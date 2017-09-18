<?php
/**
 * @doc 用户积分列表控制器
 * @filesource UserRankController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserRankController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户积分列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userRankModel = Model('user_rank');
		$page = new Page(10);
		$userRank_list = $userRankModel->getList('', $page);
		
		$usersModel = Model('users');
		$userRankTypeModel = Model('user_rank_type');
		foreach ($userRank_list as $key => $userRank) {
			if(!empty($userRank)){
				$usersInfo=$usersModel->getOneByID($userRank['user_id']);
				$userRank_list[$key]['user_name']=$usersInfo['user_name']; //用户ID
				
				$userRankTypeInfo=$userRankTypeModel->getOneByID($userRank['type_id']);
				$userRank_list[$key]['type_name']=$userRankTypeInfo['name']; //用户积分类型名称
			}
		}
		
		Tpl::assign('userRank_list', $userRank_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户积分列表');
		Tpl::display('userRank/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userRankModel = Model('user_rank');
		//获取自增ID
		$lastID = $userRankModel->getAutoIncrementId();
		
		//下拉框 用户ID
		$usersModel = Model('users');     
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		//下拉框 用户积分类型
		$userRankTypeModel = Model('user_rank_type');     
		$userRankTypeList=$userRankTypeModel->getList();
		Tpl::assign('userRankTypeList',$userRankTypeList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户积分');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$userRank['user_id'] = Filter::doFilter($_POST['user_id'], 'integer');
		$userRank['type_id'] = Filter::doFilter($_POST['type_id'], 'integer');
		$userRank['value'] = Filter::doFilter($_POST['value'], 'string');
		$userRank['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$userRank['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$userRankModel = Model('user_rank');
		if ($userRankModel->insert($userRank)) {
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
		$userRankModel = Model('user_rank');
		$userRank = $userRankModel->getOneByID($id);
		
		//下拉框 用户ID
		$usersModel = Model('users');     
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		//下拉框 用户积分类型
		$userRankTypeModel = Model('user_rank_type');     
		$userRankTypeList=$userRankTypeModel->getList();
		Tpl::assign('userRankTypeList',$userRankTypeList);
		
		Tpl::assign('userRank', $userRank);
		Tpl::assign('page_title', '修改用户积分');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['points_id'], 'integer');
		$userRank['user_id'] = Filter::doFilter($_POST['user_id'], 'integer');
		$userRank['type_id'] = Filter::doFilter($_POST['type_id'], 'integer');
		$userRank['value'] = Filter::doFilter($_POST['value'], 'string');
		$userRank['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$userRank['update_time'] = getGMTime();
		$where = "`id`=$id";
		$userRankModel = Model('user_rank');
		if ($userRankModel->update($userRank, $where)) {
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
		$userRankModel = Model('user_rank');
		if ($userRankModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

