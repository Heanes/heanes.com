<?php
/**
 * @doc 用户认证控制器
 * @filesource UserCertificationController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');

class UserCertificationController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$UsercertificationModel = Model('user_certification');
		$page = new Page(10);
		$Usercertification_list = $UsercertificationModel->getList('', $page);
		
		$usersModel = Model('users');  //用户表
		$certificationTypeModel = Model('certification_type'); //认证方式类别表
		//认证类型表
		$certificationTypeModel = Model('certification_type');
		foreach ($Usercertification_list as $key => $Usercertification) {
			if(!empty($Usercertification)){
				$userInfo=$usersModel->getOneByID($Usercertification['user_id']);
				$Usercertification_list[$key]['user_name']=$userInfo['user_name']; //用户ID
				
				$certificationTypeInfo=$certificationTypeModel->getOneByID($Usercertification['type_id']);
				$Usercertification_list[$key]['type_name']=$certificationTypeInfo['name']; //认证类型ID
			}
		}
		Tpl::assign('Usercertification_list', $Usercertification_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '用户认证列表');
		Tpl::display('userCertification/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$UsercertificationModel = Model('user_certification');
		//获取自增ID
		$lastID = $UsercertificationModel->getAutoIncrementId();
		
		//下拉框  用户表
		$usersModel = Model('users');     //用户ID
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		//下拉框  认证方式类别表
		$certificationTypeModel = Model('certification_type');    //验证类型ID
		$certificationTypeList=$certificationTypeModel->getList();
		Tpl::assign('certificationTypeList',$certificationTypeList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加用户认证');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$UsercertificationModel = Model('user_certification');
		$Usercertification = $UsercertificationModel->getOneByID($id);
		
		//下拉框  用户表
		$usersModel = Model('users');     //用户ID
		$usersList=$usersModel->getList();
		Tpl::assign('usersList',$usersList);
		//下拉框  认证方式类别表
		$certificationTypeModel = Model('certification_type');    //验证类型ID
		$certificationTypeList=$certificationTypeModel->getList();
		Tpl::assign('certificationTypeList',$certificationTypeList);
		
		Tpl::assign('Usercertification', $Usercertification);
		Tpl::assign('page_title', '修改用户认证');
		Tpl::display();
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newuserCertification['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserCertification['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newuserCertification['message'] = Filter::doFilter($_POST['message'], 'string');
		$newuserCertification['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserCertification['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
		$newuserCertification['status'] = Filter::doFilter($_POST['status'], 'string');
		$UsercertificationModel = Model('user_certification');
		if ($UsercertificationModel->insert($newuserCertification)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}

	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['usercer_id'], 'integer');
		$newuserCertification['user_id'] = Filter::doFilter($_POST['user_id'], 'string');
		$newuserCertification['type_id'] = Filter::doFilter($_POST['type_id'], 'string');
		$newuserCertification['message'] = Filter::doFilter($_POST['message'], 'string');
		$newuserCertification['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'], 'string'));
		$newuserCertification['update_time'] = getGMTime();
		$newuserCertification['status'] = Filter::doFilter($_POST['status'], 'string');
		$where = "`id`=$id";
		$UsercertificationModel = Model('user_certification');
		if ($UsercertificationModel->update($newuserCertification, $where)) {
			showSuccess('修改成功');
		} else {
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
		$UsercertificationModel = Model('user_certification');
		if ($UsercertificationModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

