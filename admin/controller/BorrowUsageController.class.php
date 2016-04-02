<?php
/**
 * @doc 贷款用途管理控制器
 * @filesource BorrowUsageController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class BorrowUsageController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 10:10:19
	 */
	public function listOp(){
		$borrowUsageModel=Model('borrow_usage');
		$borrowUsageListParam=array();
		$borrowUsageListParam['where']= (empty($borrowUsageListParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_delete`=0";
		$page=new Page(10);
		$borrowUsageList=$borrowUsageModel->getList($borrowUsageListParam,$page);
		Tpl::assign('borrowUsageList',$borrowUsageList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','贷款用途列表');
		Tpl::display('borrowUsage/list');
	}

	/**
	 * @doc 添加贷款
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$borrowUsageModel = Model('borrow_usage');
		//获取自增ID
		$lastID = $borrowUsageModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加贷款');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newBorrowUsage['name']=Filter::doFilter($_POST['usage_name'],'string');
		$newBorrowUsage['code']=Filter::doFilter($_POST['code'],'string');
		$newBorrowUsage['order']=Filter::doFilter($_POST['order'],'integer');
		$newBorrowUsage['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrowUsage['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrowUsage['description']=Filter::doFilter($_POST['description'],'string');
		$borrowUsageModel=Model('borrow_usage');
		if($borrowUsageModel->insert($newBorrowUsage)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改客户
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$borrowUsageModel=Model('borrow_usage');
		$borrowUsage=$borrowUsageModel->getOneByID($id);
		Tpl::assign('borrowUsage',$borrowUsage);
		Tpl::assign('page_title','修改贷款');
		Tpl::display();
	}

	
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['usage_id'],'integer');
		$newBorrowUsage['name']=Filter::doFilter($_POST['usage_name'],'string');
		$newBorrowUsage['code']=Filter::doFilter($_POST['code'],'string');
		$newBorrowUsage['order']=Filter::doFilter($_POST['order'],'integer');
		$newBorrowUsage['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrowUsage['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrowUsage['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$borrowUsageModel=Model('borrow_usage');
		if($borrowUsageModel->update($newBorrowUsage,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

}
