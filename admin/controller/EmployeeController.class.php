<?php
/**
 * @doc 员工控制器类
 * @filesource EmployeeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:00:19
 */
defined('InHeanes') or exit('Access Invalid!');

class EmployeeController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认操作，员工列表
	 * @author Heanes
	 * @time 2015-06-29 15:05:44
	 */
	public function indexOp(){
		$this->listOp();
	}

	public function listOp(){
		$employeeModel=Model('employee');
		$page=new Page(10);
		$employee_list=$employeeModel->getList('',$page);
		$usersModel=Model('users');
		$departmentModel=Model('department');
		$jobModel=Model('job');
		foreach ($employee_list as $key => $employee) {
			//处理用户名称
			$users_list=$usersModel->getOneByID($employee['user_id']);
			$employee_list[$key]['user_name']=$users_list['user_name'];
			//处理部门名称
			$department_list=$departmentModel->getOneByID($employee['department_id']);
			$employee_list[$key]['department_name'] = $department_list['name'];
			//处理职位名称
			$job_list=$jobModel->getOneByID($employee['job_id']);
			$employee_list[$key]['job_name'] = $job_list['name'];
		}
		Tpl::assign('page_title','员工列表');
		Tpl::assign('employee_list',$employee_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::display('employee/list');
	}

	/**
	 * @doc 添加员工
	 * @author Heanes
	 * @time 2015-06-29 15:06:25
	 */
	public function addOp(){
		$employeeModel=Model('employee');
		//获取自增ID
		$lastID = $employeeModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		//下拉列表查询(用户名称)
		$usersModel=Model('users');
		$users=$usersModel->getList();
		Tpl::assign('users',$users);
		//下拉列表查询(部门名称)
		$departmentModel=Model('department');
		$department=$departmentModel->getList();
		Tpl::assign('department',$department);
		//下拉列表查询(职位名称)
		$jobModel=Model('job');
		$job=$jobModel->getList();
		Tpl::assign('job',$job);
		
		Tpl::assign('html_title','添加员工');
    	Tpl::display();
	}
	
	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-06-29 17:48:43
	 */
	public function insertOp(){
		$newEmployee['user_id']=Filter::doFilter($_POST['employee_name'],'string');
		$newEmployee['department_id']=Filter::doFilter($_POST['department_name'],'string');
		$newEmployee['job_id']=Filter::doFilter($_POST['job_name'],'string');
		$newEmployee['apply_status']=Filter::doFilter($_POST['status'],'integer');
		$newEmployee['insert_time']=to_timespan(Filter::doFilter($_POST['employee_insert_time'],'string'));
		$newEmployee['update_time']=to_timespan(Filter::doFilter($_POST['employee_update_time'],'string'));
		$newEmployee['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newEmployee['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$employeeModel=Model('employee');
		if($employeeModel->insert($newEmployee)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
		
	}
	
	/**
	 * @doc 修改员工
	 * @author Heanes
	 * @time 2015-06-29 15:07:20
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$employeeModel=Model('employee');
		$employee=$employeeModel->getOneByID($id);
		//下拉列表查询(用户名称)
		$usersModel=Model('users');
		$users=$usersModel->getList();
		Tpl::assign('users',$users);
		//下拉列表查询(部门名称)
		$departmentModel=Model('department');
		$department=$departmentModel->getList();
		Tpl::assign('department',$department);
		//下拉列表查询(职位名称)
		$jobModel=Model('job');
		$job=$jobModel->getList();
		Tpl::assign('job',$job);
		
		Tpl::assign('employee',$employee);
		Tpl::assign('page_title','修改员工');
		Tpl::display();
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:18
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['employee_id'],'integer');
		$newEmployee['user_id']=Filter::doFilter($_POST['employee_name'],'string');
		$newEmployee['department_id']=Filter::doFilter($_POST['department_name'],'string');
		$newEmployee['job_id']=Filter::doFilter($_POST['job_name'],'string');
		$newEmployee['apply_status']=Filter::doFilter($_POST['status'],'integer');
		$newEmployee['insert_time']=to_timespan(Filter::doFilter($_POST['employee_insert_time'],'string'));
		$newEmployee['update_time']=getGMTime();
		$newEmployee['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newEmployee['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where="`id`=$id";
		$employeeModel=Model('employee');
		if($employeeModel->update($newEmployee,$where)){
			showSuccess('修改成功');
		}else{
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
		$employeeModel = Model('employee');
		if ($employeeModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}
