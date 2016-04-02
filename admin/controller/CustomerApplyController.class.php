<?php
/**
 * @doc 客户关系申请管理
 * @filesource customerApplyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-12 12:21:37
 */
defined('InHeanes') or exit('Access Invalid!');

class customerApplyController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 10:10:19
	 */
	public function listOp() {
		$customerApplyModel = Model('customer_apply');
		$page = new Page(10);
		$customerApplyList = $customerApplyModel->getList('', $page);
		$usersModel = Model('users');
		foreach ($customerApplyList as $key => $customerApply) {
			$customerApplyList[$key]['user_master']=$usersModel->getOneByID($customerApply['uid_master']);
			$customerApplyList[$key]['user_slave']=$usersModel->getOneByID($customerApply['uid_slave']);
		}
		Tpl::assign('customerApplyList', $customerApplyList);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '客户申请列表');
		Tpl::display();
	}

	/**
	 * @doc 修改客户申请
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp() {
		$id = Filter::doFilter($_GET['id'], 'integer');
		$customerApplyModel = Model('customer_apply');
		$customerApply = $customerApplyModel->getOneByID($id);
		$usersModel = Model('users');
		$customerApply['user_master']=$usersModel->getOneByID($customerApply['uid_master']);
		$customerApply['user_slave']=$usersModel->getOneByID($customerApply['uid_slave']);
		Tpl::assign('customerApply', $customerApply);
		Tpl::assign('page_title', '客户申请详情');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp() {
		$id = Filter::doFilter($_POST['customerApply_id'], 'integer');
		$newCustomerApply['uid_master'] = Filter::doFilter($_POST['uid_master'], 'string');
		$newCustomerApply['uid_slave'] = Filter::doFilter($_POST['uid_slave'], 'string');
		$newCustomerApply['status'] = Filter::doFilter($_POST['status'], 'string');
		$newCustomerApply['update_time'] = getGMTime();
		$newCustomerApply['is_applying'] = Filter::doFilter($_POST['is_applying'], 'integer');
		$newCustomerApply['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$where = "`id`=$id";
		$customerApplyModel = Model('customer_apply');
		if ($customerApplyModel->update($newCustomerApply, $where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}
}

