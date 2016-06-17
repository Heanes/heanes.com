<?php
/**
 * @doc 贷款管理控制器
 * @filesource BorrowController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class BorrowController extends BaseAdminController{
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
		//查询借款记录表
		$borrowModel=Model('borrow');
		$borrowParam=array();
		$borrowParam['where']= (empty($borrowParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_deleted`=0";
		$page=new Page(10);
		$borrow_list=$borrowModel->getList($borrowParam,$page);
		//查询申请表
		$borrowApplyModel=Model('borrow_apply_status_log');
		
		
		/*
		$param['where'] = '`status`=1';
		$borrow_list = $borrowApplyModel->getList($param,$page);
		//print_r($borrow_list);
		foreach ($borrowApply_list as $key => $borrowApply) {
			$borrow_list["uid_master"] = $borrowApply["uid_master"];
			$borrow_list["uid_slave"] = $borrowApply["uid_slave"];
			$borrow_list["usage_id"] = $borrowApply["usage_id"];
			$borrow_list["usage_info"] = $borrowApply["usage_info"];
			$borrow_list["total"] = $borrowApply["total"];
			$borrow_list["year_limit"] = $borrowApply["year_limit"];
			$borrow_list["rate"] = $borrowApply["rate"];
			$borrow_list["get_money_limit_time"] = $borrowApply["get_money_limit_time"];
			$borrow_list["get_money_time"] = $borrowApply["get_money_time"];
			$borrow_list["repay_money_time"] = $borrowApply["repay_money_time"];
			$borrow_list["has_colleague"] = $borrowApply["has_colleague"];
			$borrow_list["apply_time"] = $borrowApply["insert_time"];
			$borrow_list["apply_update_time"] = $borrowApply["update_time"];
			$borrow_list["apply_status"] = $borrowApply["status"];
			
			$borrow_list = $borrowModel->insert($borrow_list);
		}
		if($borrow_list){
			$borrow_list=$borrowModel->getList('',$page);
		}
		*/
		
		
		
		
		//查询用户表
		$usersModel=Model('users');
		$users_list = $usersModel->getList('',$page);
		//实例化进程表
		$borrowProgressModel=Model('borrow_progress');
		//$borrowprogress_list = $borrowProgressModel->getList('',$page);
		//查询借款用途表
		$borrowUsageModel=Model('borrow_usage');
		foreach ($borrow_list as $key => $borrow) {
			if(!empty($borrow)){
				$uid_master_listInfo=$usersModel->getOneByID($borrow['uid_master']);
				$borrow_list[$key]['master_name']=$uid_master_listInfo['user_name']; // 根据uid_master查询业务员
				
				$uid_slave_listInfo=$usersModel->getOneByID($borrow['uid_slave']);
				$borrow_list[$key]['slave_name']=$uid_slave_listInfo['user_name']; //根据uid_slave查询客户名字
				
				$borrowUsage_listInfo=$borrowUsageModel->getOneByID($borrow['usage_id']);
				$borrow_list[$key]['usage_name']=$borrowUsage_listInfo['name']; //贷款用途（标识ID），从借款用途表中取得
				
				$borrowProgress_listInfo=$borrowProgressModel->getOneByID($borrow['progress_status']);
				$borrow_list[$key]['progress_status']=$borrowProgress_listInfo['status']; //进程状态
			}
		}
		
		Tpl::assign('borrow_list',$borrow_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','贷款列表');
		Tpl::display('borrow/list');
	}

	/**
	 * @doc 添加贷款
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$borrowModel = Model('borrow');
		//获取自增ID
		$lastID = $borrowModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		
		//下拉列表查询(贷款用途（标识ID），从借款用途表中取得)
		$borrowUsageModel=Model('borrow_usage');
		$arr=$borrowUsageModel->getList();
		Tpl::assign('info',$arr);
		//贷款进行状态
		$borrowProgressModel=Model('borrow_progress');
		$arr=$borrowProgressModel->getList();
		Tpl::assign('type',$arr);
		
		Tpl::assign('page_title','添加贷款');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newBorrow['order']=Filter::doFilter($_POST['order'],'integer');
		$newBorrow['uid_master']=Filter::doFilter($_POST['uid_master'],'string');
		$newBorrow['uid_slave']=Filter::doFilter($_POST['uid_slave'],'string');
		$newBorrow['usage_id']=Filter::doFilter($_POST['usage_id'],'string');
		$newBorrow['total']=Filter::doFilter($_POST['total'],'string');
		
		$newBorrow['year_limit']=Filter::doFilter($_POST['year_limit'],'integer');
		$newBorrow['rate']=Filter::doFilter($_POST['rate'],'string');
		
		$newBorrow['get_money_limit_time']=to_timespan(Filter::doFilter($_POST['get_money_limit_time'],'string'));
		$newBorrow['get_money_time']=to_timespan(Filter::doFilter($_POST['get_money_time'],'string'));
		$newBorrow['repay_money_time']=to_timespan(Filter::doFilter($_POST['repay_money_time'],'string'));
		$newBorrow['has_colleague']=Filter::doFilter($_POST['has_colleague'],'string');
		$newBorrow['apply_time']=to_timespan(Filter::doFilter($_POST['apply_time'],'string'));
		$newBorrow['apply_status']=Filter::doFilter($_POST['apply_status'],'integer');
		$newBorrow['apply_update_time']=to_timespan(Filter::doFilter($_POST['apply_update_time'],'string'));
		$newBorrow['progress_status']=Filter::doFilter($_POST['progress_status'],'integer');
		$newBorrow['progress_update_time']=to_timespan(Filter::doFilter($_POST['progress_update_time'],'integer'));
		$newBorrow['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newBorrow['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newBorrow['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrow['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrow['usage_info']=Filter::doFilter($_POST['usage_info'],'string');
		$borrowModel=Model('borrow');
		if($borrowModel->insert($newBorrow)){
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
		$borrowModel=Model('borrow');
		$usersModel=Model('users');
		$borrow=$borrowModel->getOneByID($id);
		
		//下拉列表查询(贷款用途（标识ID），从借款用途表中取得)
		$borrowUsageModel=Model('borrow_usage');
		$arr=$borrowUsageModel->getList();
		Tpl::assign('info',$arr);
		//贷款进行状态
		$borrowProgressModel=Model('borrow_progress');
		$arr=$borrowProgressModel->getList();
		Tpl::assign('type',$arr);
		
		$borrow['user_master']=$usersModel->getOneByID($borrow['uid_master']);//关系人主名称
		$borrow['user_slave']=$usersModel->getOneByID($borrow['uid_slave']);  //关系人客名称
		$borrow['usage_name']=$usersModel->getOneByID($borrow['usage_id']);  //用途
		
		Tpl::assign('borrow',$borrow);
		Tpl::assign('page_title','修改贷款');
		Tpl::display();
	}

	
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['borrow_id'],'integer');
		$newBorrow['order']=Filter::doFilter($_POST['order'],'integer');
		$newBorrow['uid_master']=Filter::doFilter($_POST['uid_master'],'string');
		$newBorrow['uid_slave']=Filter::doFilter($_POST['uid_slave'],'string');
		$newBorrow['usage_id']=Filter::doFilter($_POST['usage_id'],'string');
		
		$newBorrow['total']=Filter::doFilter($_POST['total'],'string');
		$newBorrow['year_limit']=Filter::doFilter($_POST['year_limit'],'integer');
		$newBorrow['rate']=Filter::doFilter($_POST['rate'],'string');
		
		$newBorrow['get_money_limit_time']=to_timespan(Filter::doFilter($_POST['get_money_limit_time'],'string'));
		$newBorrow['get_money_time']=to_timespan(Filter::doFilter($_POST['get_money_time'],'string'));
		$newBorrow['repay_money_time']=to_timespan(Filter::doFilter($_POST['repay_money_time'],'string'));
		$newBorrow['has_colleague']=Filter::doFilter($_POST['has_colleague'],'string');
		$newBorrow['apply_time']=to_timespan(Filter::doFilter($_POST['apply_time'],'string'));
		$newBorrow['apply_status']=Filter::doFilter($_POST['apply_status'],'integer');
		$newBorrow['apply_update_time']=to_timespan(Filter::doFilter($_POST['apply_update_time'],'string'));
		$newBorrow['progress_status']=Filter::doFilter($_POST['progress_status'],'integer');
		$newBorrow['progress_update_time']=to_timespan(Filter::doFilter($_POST['progress_update_time'],'integer'));
		$newBorrow['insert_time']=to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newBorrow['update_time']=getGMTime();
		$newBorrow['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBorrow['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBorrow['usage_info']=Filter::doFilter($_POST['usage_info'],'string');
		$where="`id`=$id";
		$borrowModel=Model('borrow');
		if($borrowModel->update($newBorrow,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

}
