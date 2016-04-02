<?php
/**
 * @doc 积分变更记录控制器
 * @filesource UserRankLogController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserRankLogController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	public function indexOp(){
		$this->listOp();
	}
	
	/**
	 * @doc 积分变更记录列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userRankLogModel = Model('user_rank_log');
		$page = new Page(10);
		$userRankLog_list = $userRankLogModel->getList('', $page);
		//根据    积分变更记录表中的用户积分ID(user_rank_id) 与    用户积分表ID (id) 相对应进行 查询,如果user_rank_id不存在用户积分表ID中页面不显示
		$usersRankModel = Model('user_rank');
		foreach ($userRankLog_list as $key => $userRankLog) {
			if(!empty($userRankLog)){
				$usersRankInfo=$usersRankModel->getOneByID($userRankLog['user_rank_id']);
				$userRankLog_list[$key]['user_rank_id']=$usersRankInfo['id']; //用户积分表ID
			}
		}
		Tpl::assign('userRankLog_list', $userRankLog_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '积分变更记录列表');
		Tpl::display('userRankLog/list');
	}

	
	//查看
	public function lookOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$userRankLogModel = Model('user_rank_log');
		$userRankLogList = $userRankLogModel->getOneByID($id);
		//点击查看进入详细页面
		$usersRankModel = Model('user_rank');
		$usersRankInfo = $usersRankModel->getOneByID($userRankLogList['user_rank_id']);    //用户积分表ID
		$userRankLogList['user_rank_id'] = $usersRankInfo['id'];
		
		Tpl::assign('userRankLogList',$userRankLogList);
		Tpl::assign('page_title', '积分变更记录列表');
		Tpl::display();
	}
	
	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$userRankLogModel = Model('user_rank_log');
		if ($userRankLogModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

