<?php
/**
 * @doc 用户银行存储库控制器
 * @filesource UserBankController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class UserBankController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function listOp() {
		//查询用户-银行表
		$userBankModel=Model('user_bank');
		$page=new Page(10);
		$userBankList=$userBankModel->getList('',$page);
		//查询用户表
		$usersModel = Model('users');
		$usersList=$usersModel->getList('',$page);
		//查询银行表
		$bankModel = Model('bank');
		$bankList=$bankModel->getList('',$page);
		
		foreach ($userBankList as $key => $userBank) {
			if(!empty($userBank)){
				$usersInfo=$usersModel->getOneByID($userBank['user_id']);
				$userBankList[$key]['user_name']=$usersInfo['user_name']; //用户银行表里用户ID对应用户表里的id的用户名
				
				$bankInfo=$bankModel->getOneByID($userBank['bank_id']);
				$userBankList[$key]['name']=$bankInfo['name']; //银行卡类型 对应银行卡名称
			}
		}
		
		Tpl::assign('userBankList',$userBankList);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','银行列表');
		Tpl::display('userBank/list');
	}
	
	/**
	 * @doc 获取下拉框用户ID,银行卡类型
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//用户ID
		$usersModel=Model('Users');
		$arr=$usersModel->getList();
		Tpl::assign('info',$arr);
		//银行卡类型
		$bankModel=Model('bank');
		$arr=$bankModel->getList();
		Tpl::assign('type',$arr);
	}
	

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$userBankModel = Model('user_bank');
		//获取自增ID
		$lastID = $userBankModel->getAutoIncrementId();
		$this->getSelectOption();  // 下拉框
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加银行');
		Tpl::display();
	}

	
	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newuserBank['user_id']=Filter::doFilter($_POST['user_id'],'string');
		$newuserBank['real_name']=Filter::doFilter($_POST['real_name'],'string');
		$newuserBank['bank_id']=Filter::doFilter($_POST['bank_id'],'string');
		$newuserBank['bank_no']=Filter::doFilter($_POST['bank_no'],'string');
		$newuserBank['account_bank_address']=Filter::doFilter($_POST['account_bank_address'],'string');
		$newuserBank['create_time']=to_timespan(Filter::doFilter($_POST['userbank_create_time'],'string'));
		$newuserBank['update_time']=to_timespan(Filter::doFilter($_POST['userbank_update_time'],'string'));
		$newuserBank['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$userBankModel=Model('user_bank');
		if($userBankModel->insert($newuserBank)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function editOp() {
		$id=Filter::doFilter($_GET['id'],'integer');
		$userBbankModel=Model('user_bank');
		$userbank=$userBbankModel->getOneByID($id);
		$this->getSelectOption();  // 下拉框
		Tpl::assign('userbank',$userbank);
		Tpl::assign('page_title','修改银行');
		Tpl::display();
	}

	

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function updateOp() {
		$id=Filter::doFilter($_POST['userbank_id'],'integer');
		$newuserBank['user_id']=Filter::doFilter($_POST['user_id'],'string');
		$newuserBank['real_name']=Filter::doFilter($_POST['real_name'],'string');
		$newuserBank['bank_id']=Filter::doFilter($_POST['bank_id'],'string');
		$newuserBank['bank_no']=Filter::doFilter($_POST['bank_no'],'string');
		$newuserBank['account_bank_address']=Filter::doFilter($_POST['account_bank_address'],'string');
		$newuserBank['create_time']=to_timespan(Filter::doFilter($_POST['userbank_create_time'],'string'));
		$newuserBank['update_time']=getGMTime();
		$newuserBank['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$where="`id`=$id";
		$userBankModel=Model('user_bank');
		if($userBankModel->update($newuserBank,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function deleteOp() {
		;
	}
}

