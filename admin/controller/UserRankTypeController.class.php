<?php
/**
 * @doc 用户积分类型控制器
 * @filesource UserRankTypeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class UserRankTypeController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 用户积分类型列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$userRankTypeModel = Model('user_rank_type');
		$page = new Page(10);
		$userRankType_list = $userRankTypeModel->getList('', $page);
		Tpl::assign('userRankType_list', $userRankType_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户积分类型列表');
		Tpl::display('userRankType/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$userRankTypeModel = Model('user_rank_type');
		//获取自增ID
		$lastID = $userRankTypeModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户积分类型');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$userRankType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$userRankType['name'] = Filter::doFilter($_POST['points_name'], 'string');
		$userRankType['code'] = Filter::doFilter($_POST['code'], 'string');
		$userRankType['unit'] = Filter::doFilter($_POST['unit'], 'string');
		$userRankType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$userRankType['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$userRankType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$userRankType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$userRankTypeModel = Model('user_rank_type');
		if ($userRankTypeModel->insert($userRankType)) {
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
		$userRankTypeModel = Model('user_rank_type');
		$userRankType = $userRankTypeModel->getOneByID($id);
		Tpl::assign('userRankType', $userRankType);
		Tpl::assign('page_title', '修改用户积分类型');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['ranktype_id'], 'integer');
		$userRankType['order'] = Filter::doFilter($_POST['order'], 'integer');
		$userRankType['name'] = Filter::doFilter($_POST['points_name'], 'string');
		$userRankType['code'] = Filter::doFilter($_POST['code'], 'string');
		$userRankType['unit'] = Filter::doFilter($_POST['unit'], 'string');
		$userRankType['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$userRankType['update_time'] = getGMTime();
		$userRankType['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$userRankType['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$userRankTypeModel = Model('user_rank_type');
		if ($userRankTypeModel->update($userRankType, $where)) {
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
		$userRankTypeModel = Model('user_rank_type');
		if ($userRankTypeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

