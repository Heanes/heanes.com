<?php
/**
 * @doc 工作职位控制器
 * @filesource JobController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.03 003
 */
defined('InHeanes') or exit('Access Invalid!');

class JobController extends BaseAdminController{

	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认展示列表
	 * @author Heanes
	 * @time 2015-07-03 14:10:51
	 */
	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 职位列表
	 * @author Heanes
	 * @time 2015-07-03 14:11:32
	 */
	public function listOp(){
		$jobModel = Model('job');
		$page = new Page(10);
		$job_list = $jobModel->getList('', $page);
		Tpl::assign('job_list', $job_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '职位列表');
		Tpl::display('job/list');
	}

	/**
	 * @doc 添加一个职位
	 * @author Heanes
	 * @time 2015-07-03 14:12:04
	 */
	public function addOp(){
		$jobModel = Model('job');
		//获取自增ID
		$lastID = $jobModel->getAutoIncrementId();
		Tpl::assign('lastID', $lastID);
		Tpl::assign('html_title', '添加职位');
		Tpl::display();
	}

	/**
	 * @doc 增加一个职位操作
	 * @author Heanes
	 * @time 2015-07-03 14:14:08
	 */
	public function insertOp(){
		$newJob['category_id'] = Filter::doFilter($_POST['job_category_id'], 'string');//职位分类
		$newJob['name'] = Filter::doFilter($_POST['job_name'], 'string');//职位名称
		$newJob['code'] = Filter::doFilter($_POST['job_code'], 'string'); //职位代码，一般即缩写
		$newJob['description'] = Filter::doFilter($_POST['job_description'], 'string');
		$newJob['order'] = Filter::doFilter($_POST['job_order'], 'string');
		$newJob['create_time'] = to_timespan(Filter::doFilter($_POST['job_create_time'], 'string'));
		$newJob['update_time'] = to_timespan(Filter::doFilter($_POST['job_update_time'], 'string'));
		$jobModel = Model('job');
		if ($jobModel->insert($newJob)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
		
	}

	/**
	 * @doc 修改一个职位
	 * @author Heanes
	 * @time 2015-07-03 14:12:39
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$jobModel = Model('job');
		$job = $jobModel->getOneByID($id);
		
		Tpl::assign('job', $job);
		Tpl::assign('page_title', '修改职位');
		Tpl::display();
	}

	/**
	 * @doc 修改职位操作
	 * @author Heanes
	 * @time 2015-07-03 14:13:11
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['job_id'], 'integer');
		print_r($id);
		$newJob['category_id'] = Filter::doFilter($_POST['job_category_id'], 'string');
		$newJob['name'] = Filter::doFilter($_POST['job_name'], 'string');
		$newJob['code'] = Filter::doFilter($_POST['job_code'], 'string');
		$newJob['order'] = Filter::doFilter($_POST['job_order'], 'string');
		$newJob['update_time'] = getGMTime();
		$newJob['description'] = Filter::doFilter($_POST['job_description'], 'string');
		$where = "`id`=$id";
		$jobModel = Model('job');
		if ($jobModel->update($newJob, $where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除一个职位
	 * @author Heanes
	 * @time 2015-07-03 14:13:37
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$where = "`id`=$id";
		$jobModel = Model('job');
		if ($jobModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}
