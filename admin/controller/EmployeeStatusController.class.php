<?php
/**
 * @doc 员工职位申请状态操作记录控制器类
 * @filesource EmployeeStatusController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:00:19
 */
defined('InHeanes') or exit('Access Invalid!');

class EmployeeStatusController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认操作，员工职位申请状态操作记录列表
	 * @author Heanes
	 * @time 2015-06-29 15:05:44
	 */
	public function indexOp(){
		$this->listOp();
	}

	public function listOp(){
		$employeeStatusLogModel=Model('employee_apply_status_log');
		$page=new Page(10);
		$employeeStatusLog_list=$employeeStatusLogModel->getList('',$page);
		
		$usersModel=Model('users');
		foreach ($employeeStatusLog_list as $key => $employeeStatusLog) {
			if(!empty($employeeStatusLog)){
				$usersActInfo=$usersModel->getOneByID($employeeStatusLog['actor_user_id']);
				$employeeStatusLog_list[$key]['actor_user_name']=$usersActInfo['user_name']; //操作用户名称
			}
		}

		Tpl::assign('page_title','员工职位申请状态操作记录列表');
		Tpl::assign('employeeStatusLog_list',$employeeStatusLog_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::display('employeeStatus/list');
	}
	
	//查看
	public function lookOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$employeeStatusLogModel=Model('employee_apply_status_log');
		$employeeStatusLog = $employeeStatusLogModel->getOneByID($id);
		
		$usersModel=Model('users');
		$actorUserInfo = $usersModel->getOneByID($employeeStatusLog['actor_user_id']);    //操作用户名称
		$employeeStatusLog['actor_user_name'] = $actorUserInfo['user_name'];
		
		Tpl::assign('employeeStatusLog',$employeeStatusLog);
		Tpl::assign('page_title', '员工职位申请状态操作记录列表');
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
		$employeeStatusLogModel=Model('employee_apply_status_log');
		if ($employeeStatusLogModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}
