<?php
/**
 * @doc 客户管理控制器
 * @filesource CustomerController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class CustomerController extends BaseAdminController{
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
		$customerModel=Model('customer');
		$page=new Page(10);
		$customer_list=$customerModel->getList('',$page);

		//客户名称
		$usersModel=Model('users');
		foreach ($customer_list as $key => $customer) {
			if(!empty($customer)){
				//关系人主
				$usersInfo=$usersModel->getOneByID($customer['uid_master']);
				$customer_list[$key]['uid_master_name']=$usersInfo['user_name'];
				//关系人客
				$usersInfo=$usersModel->getOneByID($customer['uid_slave']);
				$customer_list[$key]['uid_slave_name']=$usersInfo['user_name'];
			}
		}
		
		Tpl::assign('customer_list',$customer_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','客户列表');
		Tpl::display('customer/list');
	}

	/**
	 * @doc 添加客户
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$customerModel = Model('customer');
		//获取自增ID
		$lastID = $customerModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);

		//关系人主,关系人客
		$usersModel=Model('users');
		$users_list = $usersModel->getList();
		Tpl::assign('users_list',$users_list);

		Tpl::assign('page_title','添加客户');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		//根据关系人主名称查询对应users表id
		$uid_master=Filter::doFilter($_POST['uid_master'],'string');
		$usersModel=Model('users');
		$uid_masterIdParam['where'] = "`user_name`='".$uid_master."'";
		$uid_masterList=$usersModel->getList($uid_masterIdParam);
		foreach($uid_masterList as $uid_master_key=>$uidMaster){
			$newCustomer['uid_master'] = $uidMaster['id'];
		}
		//根据关系人客名称查询对应users表id
		$uid_slave=Filter::doFilter($_POST['uid_slave'],'string');
		$uid_slaveIdParam['where'] = "`user_name`='".$uid_slave."'";
		$uid_slaveList=$usersModel->getList($uid_slaveIdParam);
		foreach($uid_slaveList as $uid_slave_key=>$uidSlave){
			$newCustomer['uid_slave']= $uidSlave['id'];
		}
		$newCustomer['ship_type']=Filter::doFilter($_POST['ship_type'],'integer');
		$newCustomer['status']=Filter::doFilter($_POST['status'],'integer');
		$newCustomer['insert_time']=to_timespan(Filter::doFilter($_POST['customer_insert_time'],'string'));
		$newCustomer['update_time']=to_timespan(Filter::doFilter($_POST['customer_update_time'],'string'));
		$newCustomer['apply_now']=Filter::doFilter($_POST['apply_now'],'integer');
		$newCustomer['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newCustomer['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$customerModel=Model('customer');
		if($customerModel->insert($newCustomer)){
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
		$customerModel=Model('customer');
		$customer=$customerModel->getOneByID($id);
		//关系人主,关系人客
		$usersModel=Model('users');
		$users_list = $usersModel->getList();

		//根据关系人主id,查询用户名user_name
		$usersModel=Model('users');
		$uidMasterInfo=$usersModel->getOneByID($customer['uid_master']);
		$customer['uid_master_name']=$uidMasterInfo['user_name'];
		//根据关系人客id,查询用户名user_name
		$uidSlaveInfo=$usersModel->getOneByID($customer['uid_slave']);
		$customer['uid_slave_name']=$uidSlaveInfo['user_name'];

		Tpl::assign('customer',$customer);
		Tpl::assign('users_list',$users_list);
		Tpl::assign('page_title','修改客户');
		Tpl::display();
	}

	
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['customer_id'],'integer');
		//根据关系人主名称查询对应users表id
		$usersModel=Model('users');
		$uid_master=Filter::doFilter($_POST['uid_master'],'string');
		$uid_masterIdParam['where'] = "`user_name`='".$uid_master."'";
		$uid_masterList=$usersModel->getList($uid_masterIdParam);
		foreach($uid_masterList as $uid_master_key=>$uidMaster){
			$newCustomer['uid_master'] = $uidMaster['id'];
		}
		//根据关系人客名称查询对应users表id
		$uid_slave=Filter::doFilter($_POST['uid_slave'],'string');
		$uid_slaveIdParam['where'] = "`user_name`='".$uid_slave."'";
		$uid_slaveList=$usersModel->getList($uid_slaveIdParam);
		foreach($uid_slaveList as $uid_slave_key=>$uidSlave){
			$newCustomer['uid_slave']= $uidSlave['id'];
		}
		$newCustomer['ship_type']=Filter::doFilter($_POST['ship_type'],'integer');
		$newCustomer['status']=Filter::doFilter($_POST['status'],'integer');
		$newCustomer['insert_time']=to_timespan(Filter::doFilter($_POST['customer_insert_time'],'string'));
		$newCustomer['update_time']=getGMTime();
		$newCustomer['apply_now']=Filter::doFilter($_POST['apply_now'],'integer');
		$newCustomer['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newCustomer['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where="`id`=$id";
		$customerModel=Model('customer');
		if($customerModel->update($newCustomer,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

}
