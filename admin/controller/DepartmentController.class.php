<?php
/**
 * @doc 部门控制器
 * @filesource DepartmentController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-02 10:05:17
 */
defined('InHeanes') or exit('Access Invalid!');

class DepartmentController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认操作，列表展示页
	 * @author Heanes
	 * @time 2015-06-29 09:36:50
	 */
	public function indexOp(){
		$this->listOp();
	}
	
	public function listOp(){
		$departmentModel=Model('department');
		$page=new Page(10);
		$department_list=$departmentModel->getList('',$page);
		Tpl::assign('department_list',$department_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','部门列表');
		Tpl::display('department/list');
	}

	/**
	 * @doc 添加部门
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$departmentModel = Model('department');
		//获取自增ID
		$lastID = $departmentModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加部门');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newDepartment['name']=Filter::doFilter($_POST['department_name'],'string');
		$newDepartment['pid']=Filter::doFilter($_POST['department_pid'],'string');
		$newDepartment['order']=Filter::doFilter($_POST['department_order'],'string');
		$newDepartment['english_name']=Filter::doFilter($_POST['department_english_name'],'string');
		$newDepartment['insert_time']=to_timespan(Filter::doFilter($_POST['department_insert_time'],'string'));
		$newDepartment['update_time']=to_timespan(Filter::doFilter($_POST['department_update_time'],'string'));
		$newDepartment['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newDepartment['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newDepartment['description']=Filter::doFilter($_POST['department_description'],'string');
		$departmentModel=Model('department');
		if($departmentModel->insert($newDepartment)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 修改部门
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$departmentModel=Model('department');
		$department=$departmentModel->getOneByID($id);
		Tpl::assign('department',$department);
		Tpl::assign('page_title','修改部门');
		Tpl::display();
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['department_id'],'integer');
		$newDepartment['name']=Filter::doFilter($_POST['department_name'],'string');
		//$newDepartment['pid']=Filter::doFilter($_POST['department_pid'],'string');
		$newDepartment['order']=Filter::doFilter($_POST['department_order'],'string');
		$newDepartment['english_name']=Filter::doFilter($_POST['department_english_name'],'string');
		$newDepartment['insert_time']=to_timespan(Filter::doFilter($_POST['department_insert_time'],'string'));
		$newDepartment['update_time']=getGMTime();
		$newDepartment['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newDepartment['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newDepartment['description']=Filter::doFilter($_POST['department_description'],'string');
		$where="`id`=$id";
		$departmentModel=Model('department');
		if($departmentModel->update($newDepartment,$where)){
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
		$departmentModel = Model('department');
		if ($departmentModel->delete($where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}
}
