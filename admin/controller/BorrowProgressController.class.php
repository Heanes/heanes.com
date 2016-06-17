<?php
/**
 * @doc 借款进度控制器
 * @filesource BorrowProgressController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class BorrowProgressController extends BaseAdminController{
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
		//查询进度表
		$borrowProgressModel=Model('borrow_progress');
		$borrowProgressParam=array();
		$borrowProgressParam['where']= (empty($borrowProgressParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_deleted`=0";
		$page=new Page(10);
		$borrowProgressList=$borrowProgressModel->getList($borrowProgressParam,$page);
		
		//查询用户表
		$usersModel=Model('users');
		foreach ($borrowProgressList as $key => $borrowProgress) {
			if(!empty($borrowProgress)){
				$jk_listInfo=$usersModel->getOneByID($borrowProgress['jk_id']);
				$borrowProgressList[$key]['jk_name']=$jk_listInfo['user_name']; // 业务主ID
				
				$actor_user_listInfo=$usersModel->getOneByID($borrowProgress['actor_user_id']);
				$borrowProgressList[$key]['actor_name']=$actor_user_listInfo['user_name']; //操作人ID
			}
		}
		Tpl::assign('borrowProgressList',$borrowProgressList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','贷款进度列表');
		Tpl::display('borrowProgress/list');
	}

	/**
	 * @doc 添加贷款申请
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$borrowProgressModel = Model('borrow_progress');
		//获取自增ID
		$lastID = $borrowProgressModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加贷款进度');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newBorrowProgress['jk_id']=Filter::doFilter($_POST['jk_id'],'string');
		$newBorrowProgress['actor_user_id']=Filter::doFilter($_POST['actor_user_id'],'string');
		$newBorrowProgress['reason']=Filter::doFilter($_POST['reason'],'string');
		$newBorrowProgress['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newBorrowProgress['status']=Filter::doFilter($_POST['status'],'string');
		$newBorrowProgress['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrowProgress['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrowProgress['description']=Filter::doFilter($_POST['description'],'string');
		
		$borrowProgressModel=Model('borrow_progress');
		if($borrowProgressModel->insert($newBorrowProgress)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改进度
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$borrowProgressModel=Model('borrow_progress');
		$borrowProgress=$borrowProgressModel->getOneByID($id);
		Tpl::assign('borrowProgress',$borrowProgress);
		Tpl::assign('page_title','修改进度');
		Tpl::display();
	}

	
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['progress_id'],'integer');
		$newBorrowProgress['jk_id']=Filter::doFilter($_POST['jk_id'],'string');
		$newBorrowProgress['actor_user_id']=Filter::doFilter($_POST['actor_user_id'],'string');
		$newBorrowProgress['reason']=Filter::doFilter($_POST['reason'],'string');
		$newBorrowProgress['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newBorrowProgress['status']=Filter::doFilter($_POST['status'],'string');
		$newBorrowProgress['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrowProgress['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrowProgress['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$borrowProgressModel=Model('borrow_progress');
		if($borrowProgressModel->update($newBorrowProgress,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

}
