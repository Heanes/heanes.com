<?php
/**
 * @doc 部门控制器
 * @filesource DepartmentController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.25 13:51:34
 */
defined('InHeanes') or exit('Access Invalid!');

class DepartmentController extends BaseWapController{
	function __construct(){
		parent::__construct();
		$this->needLogin();
		$this->checkRoleOp();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 默认操作，列表展示页
	 * @author Heanes
	 * @time 2015-06-29 09:36:50
	 */
	public function listOp(){
		$departmentModel=Model('Department');
		$page=new Page(10);
		$departmentList=$departmentModel->getList('',$page);

		$employeeModel=Model('employee');
		$userModel=Model('users');
		$jobModel=Model('job');
		foreach ($departmentList as $key => $department) {
			//获取部门下员工人数
			$departmentList[$key]['employee_count']=$employeeModel->getCountInDepartment($department['id']);
			//获取部门管理
			//1.获取员工表里该部门下与部门管理职位ID相等的员工
			$employeeManagerParam['where']="`job_id`='".$department['manager_job_id']."' AND `department_id`='".$department['id']."'";
			$employeeManagerList=$employeeModel->getList($employeeManagerParam);
			foreach ($employeeManagerList as $k => $employeeManager) {
				//2.获取该员工用户信息
				$departmentList[$key]['manager'][$k]=$userModel->getOneByID($employeeManager['user_id']);
			}
		}
		Tpl::assign('departmentList',$departmentList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('html_title','部门列表');
		Tpl::display('department/list');
	}

	/**
	 * @doc 添加部门
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$departmentModel=Model('Department');
		$departmentList=$departmentModel->getList();
		Tpl::assign('departmentList',$departmentList);
		$jobModel=Model('job');
		$jobList=$jobModel->getList();
		Tpl::assign('jobList',$jobList);
		Tpl::assign('html_title','添加部门');
		Tpl::display('department/add');
	}

	/**
	 * @doc 修改部门
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$departmentModel=Model('Department');
		$department=$departmentModel->getOneByID($id);
		$departmentList=$departmentModel->getList();
		Tpl::assign('department',$department);
		Tpl::assign('departmentList',$departmentList);
		$jobModel=Model('job');
		$jobList=$jobModel->getList();
		Tpl::assign('jobList',$jobList);
		Tpl::assign('html_title','修改部门');
		Tpl::display('department/edit');
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newDepartment['name']=Filter::doFilter($_POST['department_name'],'string');
		$newDepartment['pid']=Filter::doFilter($_POST['department_pid'],'integer');
		$newDepartment['english_name']=Filter::doFilter($_POST['department_english_name'],'string');
		$newDepartment['manager_job_id']=Filter::doFilter($_POST['manager_job_id'],'integer');
		$newDepartment['short_name']=Filter::doFilter($_POST['short_name'],'string');
		$newDepartment['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newDepartment['description']=Filter::doFilter($_POST['department_description'],'string');
		$departmentModel=Model('department');
		if($departmentModel->insert($newDepartment)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['department_id'],'integer');
		$newDepartment['name']=Filter::doFilter($_POST['department_name'],'string');
		$newDepartment['pid']=Filter::doFilter($_POST['department_pid'],'string');
		$newDepartment['english_name']=Filter::doFilter($_POST['department_english_name'],'string');
		$newDepartment['manager_job_id']=Filter::doFilter($_POST['manager_job_id'],'integer');
		$newDepartment['short_name']=Filter::doFilter($_POST['short_name'],'string');
		$newDepartment['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newDepartment['description']=Filter::doFilter($_POST['department_description'],'string');
		$where="`id`=$id";
		$departmentModel=Model('Department');
		if($departmentModel->update($newDepartment,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}
}
