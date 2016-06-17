<?php
/**
 * @doc 员工控制器类
 * @filesource EmployeeController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:00:19
 */
defined('InHeanes') or exit('Access Invalid!');

class EmployeeController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认操作，员工列表
	 * @author Heanes
	 * @time 2015-06-29 15:05:44
	 */
	public function indexOp(){
		$this->needLogin();
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-07 09:27:50
	 */
	public function listOp(){
		$this->needLogin();
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		//获取以自己为推荐人的金鹰用户
		$employeeModel = Model('Employee');
		$employeeParam['where']="`recommend_eid`=$user_id";
		$page = new Page(8);
		$employee_list = $employeeModel->getList($employeeParam, $page);

		$userModel = Model('users');
		$departmentModel = Model('department');
		$jobModel = Model('job');
		foreach ($employee_list as $key => &$employee) {
			//获取员工名称
			$userInfo = $userModel->getOneByID($employee['user_id']);
			$employee_list[$key]['user_name'] = $userInfo['user_name'];
			//获取职位名称
			$jobInfo = $jobModel->getOneByID($employee['job_id']);
			$employee_list[$key]['job_name'] = $jobInfo['name'];
			//获取部门名称
			$departmentInfo = $departmentModel->getOneByID($employee['department_id']);
			$employee_list[$key]['department_name'] = $departmentInfo['name'];
		}
		Tpl::assign('employee_list', $employee_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title', '员工列表');
		Tpl::display('employee/list');
	}

	/**
	 * @doc 添加员工
	 * @author Heanes
	 * @time 2015-06-29 15:06:25
	 */
	public function addOp(){
		$this->needLogin();
		Tpl::assign('html_title', '添加兼职');
		Tpl::display('employee/add');
	}

	/**
	 * @doc 从已有用户中添加
	 * @author Heanes
	 * @time 2015-07-13 09:42:17
	 */
	public function addFromExistsUserOp(){
		$this->needLogin();
		if (isset($_GET['keywords'])) {
			$keywords = Filter::doFilter($_GET['keywords'], 'string');
			$userModel = Model('users');
			$userParam['where'] = "`user_name` = '$keywords' OR `real_name`='$keywords' OR `mobile` = '$keywords' OR `idcard` = '$keywords'";
			$page = new Page(10);
			$userList = $userModel->getList($userParam, $page);
			Tpl::assign('keywords', $_GET['keywords']);
			Tpl::assign('userList', $userList);
			Tpl::assign('pager', $page->getPager());
			Tpl::assign('html_title', '搜索结果');
			Tpl::display('employee/searchUser');
		} elseif (isset($_GET['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$uid_slave = Filter::doFilter($_GET['user_id'], 'integer');
			//1、先检查是否已经存在此
			$employeeModel = Model('employee');
			$employeeParam['where'] = "`user_id`='$uid_slave'";
			if (count($employeeModel->getOne($employeeParam))) {
				showError('此用户已经是兼职');
			} else {
				//2、不是则询问是否申请为客户关系
				$userModel = Model('users');
				$user = $userModel->getOneByID($uid_slave);
				Tpl::assign('user', $user);
				Tpl::assign('html_title', '确定将此用户添加为兼职吗？');
				Tpl::display('employee/confirmAddFromExistsUser');
			}
			Tpl::assign('html_title', '添加兼职');
			Tpl::display('employee/addFromExistsUser');
		} else {
			Tpl::assign('html_title', '搜索用户');
			Tpl::display('employee/searchUser');
		}
	}

	/**
	 * @doc 申请添加已有用户为客户关系操作
	 * @author Heanes
	 * @time 2015-07-13 11:35:31
	 */
	public function _addFromExistsUserOp(){
		$this->needLogin();
		$user_id = $_SESSION['user_id'];
		$uid_slave = Filter::doFilter($_POST['uid_slave'], 'integer');
		//1、先检查是否已经是员工
		$employeeModel = Model('employee');
		$selfEmployeeParam['where'] = "`user_id`='$user_id'";
		$selfEmployeeInfo = $employeeModel->getOne($selfEmployeeParam);
		$checkEmployeeParam['where'] = "`user_id`='$uid_slave' AND `department_id`='".$selfEmployeeInfo['department_id']."' AND `is_deleted`=1";
		if (count($employeeModel->getOne($checkEmployeeParam))) {
			showError('此用户已经是兼职了');
		} else {
			//2、不是则询问是否申请为兼职关系
			$newEmployee['user_id'] = $uid_slave;
			$newEmployee['department_id'] = $selfEmployeeInfo['department_id'];
			$newEmployee['job_id'] = 1;
			$newEmployee['insert_time'] = getGMTime();
			$newEmployee['status'] = 0;
			if ($employeeModel->insert($newEmployee)) {
				showSuccess('添加成功');
			} else {
				showError('抱歉，添加失败');
			}
		}
	}

	/**
	 * @doc 添加新客户
	 * @author Heanes
	 * @time 2015-07-13 09:42:57
	 */
	public function addFromNewUserOp(){
		$this->needLogin();
		if (isSubmit('user_add_form_submit')) {
			$this->_insertNewUser();
		} else {
			//1.查询需要注册的字段信息
			$userFields = Model('user_fields');
			$userFieldsParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$userFieldsParam['order'] = array('order' => 'DESC');
			$userFieldsList = $userFields->getList($userFieldsParam);
			Tpl::assign('userFieldsList', $userFieldsList);
			//2.银行卡信息
			$bankModel = Model('bank');
			$bankList = $bankModel->getList();
			Tpl::assign('bankList', $bankList);
			//3.查询需要添加的用户认证信息
			$certificationTypeModel = Model('certification_type');
			$certificationTypeParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
			$certificationTypeList = $certificationTypeModel->getList($certificationTypeParam);
			//3.1 查询添加认证需要填写的字段
			$certificationTypeFieldsModel = Model('certification_type_fields');
			foreach ($certificationTypeList as $key => $certificationType) {
				$certificationTypeFieldsParam['where'] = "`type_id`='".$certificationType['id']."' AND `add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
				$certificationTypeList[$key]['certificationTypeFields'] = $certificationTypeFieldsModel->getList($certificationTypeFieldsParam);
			}
			Tpl::assign('certificationTypeList', $certificationTypeList);
			Tpl::assign('html_title', '添加兼职');
			Tpl::display('employee/addFromNewUser');
		}
	}

	/**
	 * @doc 修改员工
	 * @author Heanes
	 * @time 2015-06-29 15:07:20
	 */
	public function editOp(){
		$this->needLogin();
		$id = Filter::doFilter($_GET['id'], 'integer');
		$employeeModel = Model('Employee');
		$employee = $employeeModel->getOneByID($id);
		$userModel = Model('users');
		$departmentModel = Model('department');
		//获取员工名称
		$userInfo = $userModel->getOneByID($employee['user_id']);
		$employee['user_name'] = $userInfo['user_name'];
		//获取部门名称
		$departmentInfo = $departmentModel->getOneByID($employee['department_id']);
		$employee['department_name'] = $departmentInfo['name'];
		//获取部门信息
		$departmentModel = Model('department');
		$departmentList = $departmentModel->getList();
		//获取职位信息
		$jobModel = Model('job');
		$jobList = $jobModel->getList();
		Tpl::assign('employee', $employee);
		Tpl::assign('departmentList', $departmentList);
		Tpl::assign('jobList', $jobList);
		Tpl::assign('html_title', '修改员工');
		Tpl::display('employee/edit');
	}

	/**
	 * @doc 添加新用户并简历兼职关系
	 * @author Heanes
	 * @time 2015-07-15 17:09:33
	 */
	public function _insertNewUser(){
		$this->needLogin();
		//检查权限
		$this->checkRoleOp();
		$user_id = intval($_SESSION['user_id']);
		//1.1用户基本数据
		$newUser['user_name'] = generateRandomString(12);
		$newUser['nickname'] = $newUser['user_name'];
		$new_user_pwd = generateRandomString(8);
		$newUser['user_pwd'] = md5($new_user_pwd);
		$newUser['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
		$newUser['mobile'] = Filter::doFilter($_POST['user_mobile'], 'string');
		$newUser['idcard'] = Filter::doFilter($_POST['idcard'], 'string');
		$newUser['province'] = Filter::doFilter($_POST['province'], 'string');
		$newUser['city'] = Filter::doFilter($_POST['city'], 'string');
		$newUser['region'] = Filter::doFilter($_POST['region'], 'string');
		$newUser['address'] = Filter::doFilter($_POST['address'], 'string');
		//1.2用户其他字段的信息
		//2.1、先将用户数据插入到数据库中，并得到新用户的ID
		$userModel = Model('users');
		if ($newUserId = $userModel->insert($newUser)) {
			//2.用户认证信息
			//2.1添加用户认证记录
			$userCertificationModel = Model('user_certification');
			$CertificationTypeModel = Model('certification_type');
			$userCertificationTypeFieldsModel = Model('certification_type_fields');
			$CertificationTypeParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$CertificationTypeList = $CertificationTypeModel->getList($CertificationTypeParam);
			$userCertificationFieldsDataModel = Model('user_certification_fields_data');
			foreach ($CertificationTypeList as $key => $CertificationType) {
				//用户是否添加此认证
				$isSubmitCertificationType = Filter::doFilter($_POST['has_certificationType'.$CertificationType['id']], 'integer');
				if ($isSubmitCertificationType) {
					$newUserCertification['user_id'] = $newUserId;
					$newUserCertification['type_id'] = $CertificationType['id'];
					$newUserCertification['insert_time'] = getGMTime();
					$newUserCertification['message'] = Filter::doFilter($_POST['message'.$CertificationType['id']], 'string');
					$newUserCertification['status'] = 0;
					//添加认证记录
					if ($userCertificationModel->insert($newUserCertification)) {
						//再获取提交的信息
						$userCertificationTypeFieldsParam['where'] = "`type_id`='".$CertificationType['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
						$userCertificationTypeFieldsList = $userCertificationTypeFieldsModel->getList($userCertificationTypeFieldsParam);
						foreach ($userCertificationTypeFieldsList as $fields_key => $userCertificationTypeFields) {
							$newUserCertificationFieldsData['user_id'] = $newUserId;
							$newUserCertificationFieldsData['fields_id'] = $userCertificationTypeFields['id'];
							if (Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string') != '') {
								//如果是上传文件类型
								if ($userCertificationTypeFields['input_type'] == 'file-image') {
									//上传文件操作
									/*
									$upload = new UploadFile();
									$upload->setPath('user'.DS.$newUserId.DS.'certification');
									$upload->set('max_size', 10240);
									if ($_FILES['certification_type_fields_value'.$userCertificationTypeFields['id']]['size'] <= 1024 * 1024 * 10) {
										$FieldsUploadResult = $upload->upload('certification_type_fields_value'.$userCertificationTypeFields['id']);
										if ($FieldsUploadResult) {
											$certificationTypeFieldsUploadResult = $upload->getUploadResult();
											$newUserCertificationTypeFieldsData['fields_value'] = $certificationTypeFieldsUploadResult['save_path'].$certificationTypeFieldsUploadResult['save_name'];
										} else {
											showError('文件上传出现错误');
										}
									}
									*/
									//@todo 用此方式创建不存在的目录，并不是最优解
									$upload = new UploadFile();
									$upload->setPath('user'.DS.$newUserId.DS.'certification');
									$newCertificationFieldsValue=Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string');
									$newUserCertificationFieldsData['fields_value'] = 'user'.DS.$newUserId.DS.'certification'.DS.$newCertificationFieldsValue;
									//将临时目录文件下的文件移动到保存目录
									rename(PATH_ABS_SYS_FILE_UPLOAD.'temp'.DS.$newCertificationFieldsValue,PATH_ABS_SYS_FILE_UPLOAD.$newUserCertificationFieldsData['fields_value']);
								} else {
									$newUserCertificationFieldsData['fields_value'] = Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string');
								}
								$newUserCertificationFieldsData['insert_time'] = getGMTime();
								$userCertificationFieldsDataModel->insert($newUserCertificationFieldsData);
								unset($newUserCertificationFieldsData);
							}
						}
					}
				}
			}
			//2.2添加用户银行卡
			$newUserBank['bank_no'] = Filter::doFilter($_POST['bank_no'], 'string');
			$userBankModel = Model('user_bank');
			$newUserBank['user_id'] = $newUserId;
			if ($newUserBank['bank_no'] != '') {
				$newUserBank['real_name'] = Filter::doFilter($_POST['bank_real_name'], 'string');
				$newUserBank['bank_id'] = Filter::doFilter($_POST['bank_id'], 'string');
				$newUserBank['insert_time'] = getGMTime();
				//上传文件操作
				$upload = new UploadFile();
				//1.1先上传银行卡正面照片
				$upload->setPath('user'.DS.$newUserId.DS.'bank');
				$upload->set('max_size', 10240);
				if ($_FILES['bank_front_pic_src']['size'] <= 1024 * 1024 * 10) {
					$bankPicResult = $upload->upload('bank_front_pic_src');
					if ($bankPicResult) {
						//插入用户银行卡数据
						$userBankUploadResult = $upload->getUploadResult();
						$newUserBank['front_pic_src'] = $userBankUploadResult['save_path'].$userBankUploadResult['save_name'];
						$userBankModel = Model('user_bank');
						$userBankModel->insert($newUserBank);
					} else {
						showError('文件上传出现错误');
					}
				}
				$userBankInsertResult = $userBankModel->insert($newUserBank);
				if (!$userBankInsertResult) {
					showError('银行卡插入失败');
				}
				//2.3添加兼职关系记录
				//2.3.1、先检查是否已经是客户关系
				$employeeModel = Model('employee');
				$selfEmployeeParam['where'] = "`user_id`='$user_id'";
				$selfEmployeeInfo = $employeeModel->getOne($selfEmployeeParam);
				$employeeParam['where'] = "`user_id`='$newUserId' AND `department_id`='".$selfEmployeeInfo['department_id']."' AND `is_deleted`=1";
				if (count($employeeModel->getOne($employeeParam))) {
					showError('此用户已经是你的兼职');
				} else {
					//2.3.2 不是则插入客户关系
					$newEmployee['user_id'] = $newUserId;
					$newEmployee['department_id'] = $selfEmployeeInfo['department_id'];
					$newEmployee['job_id'] = 1;
					$newEmployee['insert_time'] = getGMTime();
					$newEmployee['apply_status'] = 0;
					if ($employeeModel->insert($newEmployee)) {
						showSuccess('兼职添加成功！');
					} else {
						showError('抱歉，兼职添加失败！');
					}
				}
			}
		}
	}

	/**
	 * @doc 添加操作
	 * @author Heanes
	 * @time 2015-06-29 17:48:43
	 */
	public function insertOp(){
		$this->needLogin();
		$newEmployee['user_id'] = Filter::doFilter($_POST['user_id'], 'integer');
		$newEmployee['department_id'] = Filter::doFilter($_POST['department_id'], 'integer');
		$newEmployee['job_id'] = Filter::doFilter($_POST['job_id'], 'integer');
		$newEmployee['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newEmployee['insert_time'] = getGMTime();
		$newEmployee['update_time'] = getGMTime();
		$employeeModel = Model('Employee');
		if ($employeeModel->insert($newEmployee)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}

	/**
	 * @doc 更新操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:18
	 */
	public function updateOp(){
		$this->needLogin();
		$id = Filter::doFilter($_POST['employee_id'], 'integer');
		$newEmployee['department_id'] = Filter::doFilter($_POST['department_id'], 'integer');
		$newEmployee['job_id'] = Filter::doFilter($_POST['job_id'], 'integer');
		$newEmployee['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newEmployee['update_time'] = getGMTime();
		$where = "`id`=$id";
		$employeeModel = Model('Employee');
		if ($employeeModel->update($newEmployee, $where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}

	/**
	 * @doc 金鹰推广
	 * @author Heanes
	 * @time 2015-08-14 17:40:54
	 */
	public function inviteOp() {
		Tpl::assign('html_title','金鹰推广');
		Tpl::display('layout/commingSoon');
	}

	/**
	 * @doc 申请介绍展示
	 * @author Heanes
	 * @time 2015-06-24 14:21:53
	 */
	public function introduceOp(){
		require_once PATH_ABS_BASE_CORE.'framework/function/tools.func.php';
		if(isset($_GET['invite'])){
			$invite=Filter::doFilter($_GET['invite'],'string');
			$_SESSION['_employee_invite']=$invite;
			Tpl::assign('invite',$invite);
		}
		Tpl::assign('html_title', '加入我们');
		Tpl::display('employee/applyIntroduce', 'introduceLayout');
	}

	/**
	 * @doc 兼职信息上传
	 * @author Heanes
	 * @time 2015-06-24 14:34:00
	 */
	public function joinInOp(){
		$this->needLogin();
		if (isSubmit('partjober_apply_submit')) {
			$this->_apply();
		} else {
			//检测是否已经申请过
			$employeeModel = Model('employee');
			$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
			$employeeParam['where'] = "`user_id`='$user_id' AND `is_enable`='1' AND `is_deleted`='0'";
			if ($employeeModel->getOne($employeeParam)) {
				//显示申请详情页面
				$result=array(
					'title'=>'提示',
					'message'=>'你已经申请过了，是否查看申请记录？',
					'jump'=>array(
						'left'=>array('text'=>'是','href'=>BASE_URL.'index.php?act=employee&op=applyLog'),
						'right'=>array('text'=>'否','href'=>BASE_URL),
					),
				);
				showError($result);
			} else {
				if (isset($_GET['invite'])) {
					$inviteUserID = Filter::doFilter($_GET['invite'], 'integer');
					$userModel = Model('users');
					$inviteUserParam['where'] = "`id`='$inviteUserID'";
					$inviteUser = $userModel->getOne($inviteUserParam);
					Tpl::assign('inviteUser', $inviteUser);
				}
				//1.添加银行卡
				$bankModel = Model('bank');
				$bankList = $bankModel->getList();
				Tpl::assign('bankList', $bankList);
				//2.查询需要注册的字段信息
				$userFields = Model('user_fields');
				$userFieldsParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
				$userFieldsParam['order'] = array('order' => 'DESC');
				$userFieldsList = $userFields->getList($userFieldsParam);
				Tpl::assign('userFieldsList', $userFieldsList);
				//3查询需要添加的用户认证信息
				$certificationTypeModel = Model('certification_type');
				$certificationTypeParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
				$certificationTypeList = $certificationTypeModel->getList($certificationTypeParam);
				//3.1 查询添加认证需要填写的字段
				$certificationTypeFieldsModel = Model('certification_type_fields');
				foreach ($certificationTypeList as $key => $certificationType) {
					$certificationTypeFieldsParam['where'] = "`type_id`='".$certificationType['id']."' AND `add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
					$certificationTypeList[$key]['certificationTypeFields'] = $certificationTypeFieldsModel->getList($certificationTypeFieldsParam);
				}
				Tpl::assign('certificationTypeList', $certificationTypeList);
				Tpl::assign('html_title', '资料上传');
				Tpl::display('employee/applyPartjober');
			}
		}
	}

	/**
	 * @doc 兼职申请记录
	 * @author Heanes
	 * @time 2015-08-01 10:10:17
	 */
	public function applyLogOp(){
		$user_id=$_SESSION['user_id'];
		//先获取
		$employeeModel=Model('employee');
		$employeeParam['where']="`user_id`='$user_id'";
		$employee=$employeeModel->getOne($employeeParam);
		Tpl::assign('employee',$employee);
		$employeeApplyStatusLogModel=Model('employee_apply_status_log');
		$employeeApplyStatusLogParam['where']="`employee_id`='".$employee['id']."'";
		$employeeApplyStatusLog=$employeeApplyStatusLogModel->getList($employeeApplyStatusLogParam);
		Tpl::assign('employeeApplyLog',$employeeApplyStatusLog);
		Tpl::assign('html_title','申请记录');
		Tpl::display('employee/applyLog');
	}

	/**
	 * @doc 兼职信息上传操作
	 * @author Heanes
	 * @time 2015-06-24 14:43:15
	 */
	protected function _apply(){
		$this->needLogin();
		//用户属性数据
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$newUser['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
		//职位申请数据
		$newEmployeeApply['user_id'] = $user_id;
		$newEmployeeApply['recommend_eid'] = Filter::doFilter($_POST['recommend_eid'], 'integer');
		$newEmployeeApply['job_id'] = 1;//职位ID，后台配置申请职位的ID，目前死，作为快速开发
		$newEmployeeApply['department_id'] = 0;//部门ID，自主申请的置为0，之后在审核操作时分配部门
		$newEmployeeApply['apply_status'] = 0;
		$newEmployeeApply['insert_time'] = getGMTime();

		try {
			//更新用户表，更改实际姓名和年龄
			$userModel = Model('users');
			$whereUser = "`id`='$user_id'";
			$userResult = $userModel->update($newUser, $whereUser);
			$userModel->beginTransaction();
			$userModel->commit();
			//插入职位申请表
			$employeeModel = Model('employee');
			$employeeParam['where'] = "`user_id`='$user_id'";
			if (count($employeeModel->getOne($employeeParam))) {
				showError('你已经申请过了！');
			} else {
				$employeeApplyResult = $employeeModel->insert($newEmployeeApply);
				$employeeModel->beginTransaction();
				$employeeModel->commit();
				if (!$userResult) {
					throw new Exception('用户数据更新错误');
				}
				if (!$employeeApplyResult) {
					throw new Exception('职位申请数据插入错误');
				}
				//2.2添加用户银行卡
				//银行卡数据
				$newUserBank['bank_no'] = Filter::doFilter($_POST['bank_card_num'], 'string');
				$userBankModel = Model('user_bank');
				$newUserBank['user_id'] = $user_id;
				if ($newUserBank['bank_no'] != '') {
					$newUserBank['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
					$newUserBank['bank_id'] = Filter::doFilter($_POST['bank_id'], 'integer');
					$newUserBank['insert_time'] = getGMTime();
					//@todo 用此方式创建不存在的目录，并不是最优解
					$upload = new UploadFile();
					$upload->setPath('user'.DS.$user_id.DS.'bank');
					$newUserBankImgName = Filter::doFilter($_POST['bank_front_pic_src'], 'string');
					$newUserBank['front_pic_src'] = 'user'.DS.$user_id.DS.'bank'.DS.$newUserBankImgName;
					//将临时目录文件下的文件移动到保存目录
					rename(PATH_ABS_SYS_FILE_UPLOAD.'temp'.DS.$newUserBankImgName, PATH_ABS_SYS_FILE_UPLOAD.$newUserBank['front_pic_src']);
					$userBankInsertResult = $userBankModel->insert($newUserBank);
					if (!$userBankInsertResult) {
						showError('银行卡插入失败');
					}
				}
				//2.用户认证信息
				//2.1添加用户认证记录
				$userCertificationModel = Model('user_certification');
				$CertificationTypeModel = Model('certification_type');
				$userCertificationTypeFieldsModel = Model('certification_type_fields');
				$CertificationTypeParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
				$CertificationTypeList = $CertificationTypeModel->getList($CertificationTypeParam);
				$userCertificationFieldsDataModel = Model('user_certification_fields_data');
				foreach ($CertificationTypeList as $key => $CertificationType) {
					//用户是否添加此认证
					$newUserCertification['user_id'] = $user_id;
					$newUserCertification['type_id'] = $CertificationType['id'];
					$newUserCertification['insert_time'] = getGMTime();
					$newUserCertification['message'] = Filter::doFilter($_POST['message'.$CertificationType['id']], 'string');
					$newUserCertification['status'] = 0;
					//添加认证记录
					if ($userCertificationModel->insert($newUserCertification)) {
						//再获取提交的信息
						$userCertificationTypeFieldsParam['where'] = "`type_id`='".$CertificationType['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
						$userCertificationTypeFieldsList = $userCertificationTypeFieldsModel->getList($userCertificationTypeFieldsParam);
						foreach ($userCertificationTypeFieldsList as $fields_key => $userCertificationTypeFields) {
							$newUserCertificationFieldsData['user_id'] = $user_id;
							$newUserCertificationFieldsData['fields_id'] = $userCertificationTypeFields['id'];
							if (Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string') != '') {
								//如果是上传文件类型
								if ($userCertificationTypeFields['input_type'] == 'file-image') {
									//@todo 用此方式创建不存在的目录，并不是最优解
									$upload = new UploadFile();
									$upload->setPath('user'.DS.$user_id.DS.'certification');
									$newCertificationFieldsValue = Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string');
									$newUserCertificationFieldsData['fields_value'] = 'user'.DS.$user_id.DS.'certification'.DS.$newCertificationFieldsValue;
									//将临时目录文件下的文件移动到保存目录
									rename(PATH_ABS_SYS_FILE_UPLOAD.'temp'.DS.$newCertificationFieldsValue, PATH_ABS_SYS_FILE_UPLOAD.$newUserCertificationFieldsData['fields_value']);
								} else {
									$newUserCertificationFieldsData['fields_value'] = Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string');
								}
								$newUserCertificationFieldsData['insert_time'] = getGMTime();
								$userCertificationFieldsDataModel->insert($newUserCertificationFieldsData);
								unset($newUserCertificationFieldsData);
							}
						}
					}
				}
			}
			$result=array(
				'title'=>'提示',
				'message'=>'申请成功，请等待管理员审核！',
				'jump'=>array(
					'left'=>array('text'=>'返回个人中心','href'=>BASE_URL.'index.php?act=member'),
				),
			);
			showError($result);
		} catch (Exception $e) {
			$userModel->rollback();
			//$certificationModel->rollback();
			$employeeModel->rollback();
			showError($e->getMessage());
		}
	}

	/**
	 * @doc 兼职审核操作
	 * @author Heanes
	 * @time 2015-07-06 18:14:13
	 */
	public function checkListOp(){
		$this->needLogin();
		$user_id = $_SESSION['user_id'];
		/*
		//获取根据用户自身ID获取自身所在部门
		//获取操作人自身员工信息
		$employeeModel = Model('employee');
		$employeeParam['where'] = "`user_id`='".$user_id."'";
		$employeeInfo = $employeeModel->getOne($employeeParam);

		//根据部门获取该部门职位的所有申请
		$employeeApplyParam['where'] = "`department_id`='".$employeeInfo['department_id']."'";
		*/
		$employeeModel = Model('employee');
		$employeeApplyParam['where']="`is_enable`=1 AND `is_deleted`=0";
		$employeeApplyParam['order']=array('insert_time'=>'DESC');
		//如果设置了查询状态
		if (isset($_REQUEST['apply_status'])) {
			$apply_status = intval(Filter::doFilter($_REQUEST['apply_status'], 'integer'));
			$employeeApplyParam['where'] .= " AND `apply_status`='$apply_status'";
		}
		$page = new Page(8);
		$employeeApplyList = $employeeModel->getList($employeeApplyParam, $page);
		//根据申请列表获取用户信息
		$userModel = Model('users');
		foreach ($employeeApplyList as $key => $employeeApply) {
			$employeeApplyList[$key]['user'] = $userModel->getOneByID($employeeApply['user_id']);
		}
		//根据申请列表获取申请职位
		$jobModel = Model('job');
		foreach ($employeeApplyList as $key => $employeeApply) {
			$employeeApplyList[$key]['job_name'] = $jobModel->getOneByID($employeeApply['job_id'])['name'];
		}
		Tpl::assign('employeeApplyList', $employeeApplyList);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title', '审核列表');
		Tpl::display('employee/checkList');
	}

	/**
	 * @doc 显示详情页
	 * @author Heanes
	 * @time 2015-07-12 14:32:40
	 */
	public function showOp(){
		$this->needLogin();
		if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
			showError('参数错误');
		} else {
			//根据获取用户ID
			$employee_id = intval(Filter::doFilter($_REQUEST['id'], 'integer'));
			$employeeModel = Model('employee');
			$employee = $employeeModel->getOneByID($employee_id);
			Tpl::assign('employee', $employee);
			//根据用户ID获取用信息;
			$userModel = Model('users');
			$userInfo = $userModel->getOneByID($employee['user_id']);
			Tpl::assign('userInfo', $userInfo);
			//获取职位信息
			$jobModel = Model('job');
			$employeeParam['where'] = "`id`='".$employee['job_id']."'";
			$jobInfo = $jobModel->getOne($employeeParam);
			Tpl::assign('jobInfo', $jobInfo);
			//获取部门信息；
			$departmentModel = Model('department');
			$departmentInfo = $departmentModel->getOneByID($employee['department_id']);
			Tpl::assign('departmentInfo', $departmentInfo);
			Tpl::assign('html_title', '审核');
			Tpl::display('employee/show');
		}
	}

	/**
	 * @doc 审核操作
	 * @author Heanes
	 * @time 2015-07-08 14:50:05
	 */
	public function checkOp(){
		$this->needLogin();
		if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
			showError('参数错误');
		} else {
			//根据申请ID获取用户ID
			$employee_id = intval(Filter::doFilter($_REQUEST['id'], 'integer'));
			$employeeModel = Model('employee');
			$employeeInfo = $employeeModel->getOneByID($employee_id);
			Tpl::assign('employeeApplyInfo', $employeeInfo);
			//根据用户ID获取用信息;
			$userModel = Model('users');
			$userInfo = $userModel->getOneByID($employeeInfo['user_id']);
			Tpl::assign('userInfo', $userInfo);
			//2.用户认证信息
			//2.1所有要显示的用户认证信息
			$certificationTypeModel=Model('certification_type');
			$certificationTypeParam['where']="`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
			$certificationTypeList=$certificationTypeModel->getList($certificationTypeParam);
			//2.2查找用户是否有该认证信息
			$userCertificationModel=Model('user_certification');
			$userCertificationList = array();
			foreach ($certificationTypeList as $key => $certificationType) {
				$userCertificationParam['where'] = "`user_id`='".$userInfo['id']."' AND `type_id`='".$certificationType['id']."'";
				$userCertificationList[$key] = $userCertificationModel->getList($userCertificationParam);
			}
			Tpl::assign('certificationTypeList', $certificationTypeList);
			//2.3获取用户认证属性信息
			//2.3.1获取认证属性字段
			$certificationTypeFieldsModel=Model('certification_type_fields');
			foreach ($userCertificationList as $key => $userCertification) {
				if (count($userCertification)) {
					foreach ($userCertification as $userCertificationKey => $certification) {
						$certificationTypeFieldsParam['where'] = "`type_id`='".$certification['type_id']."'";
						$userCertificationList[$key][$userCertificationKey]['_fields'] = $certificationTypeFieldsModel->getList($certificationTypeFieldsParam);
					}
				}
			}
			//2.3.2用户认证属性值
			$userCertificationFieldsDataModel = Model('user_certification_fields_data');
			foreach ($userCertificationList as $key => $userCertification) {
				if (count($userCertification)) {
					foreach ($userCertification as $userCertificationKey => $certification) {
						if (count($certification['_fields'])) {
							foreach ($certification['_fields'] as $fieldsKey => $fields) {
								$userCertificationFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$userInfo['id']."'";
								$userCertificationList[$key][$userCertificationKey]['_fields_value'][$fieldsKey] = $userCertificationFieldsDataModel->getOne($userCertificationFieldsDataParam);
							}
						}
					}
				}
			}
			Tpl::assign('userCertificationList', $userCertificationList);
			//获取职位信息
			$jobModel = Model('job');
			$employeeParam['where'] = "`id`='".$employeeInfo['job_id']."'";
			$jobInfo = $jobModel->getOne($employeeParam);
			Tpl::assign('jobInfo', $jobInfo);
			//获取部门信息；
			$departmentModel = Model('department');
			$departmentList = $departmentModel->getList();
			Tpl::assign('departmentList', $departmentList);
			Tpl::assign('html_title', '审核');
			Tpl::display('employee/check');
		}
	}

	/**
	 * @doc 更新操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:18
	 */
	public function updateCheckOp(){
		$this->needLogin();
		//先检查权限
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		//0、先获取提交的数据
		$id = Filter::doFilter($_POST['employee_apply_id'], 'integer');
		//欲分配部门ID
		$department_distribute_id = Filter::doFilter($_POST['department_distribute_id'], 'integer');
		//审核操作结果
		$check_status = Filter::doFilter($_POST['check_status'], 'integer');

		//1、获取职位申请数据
		$employeeModel = Model('employee');
		//2、检查员工表中是否已存在此用户
		$newEmployee['update_time'] = getGMTime();
		$newEmployee['apply_status'] = $check_status;
		$newEmployee['department_id'] = $department_distribute_id;
		$where = "`id`=$id";
		if ($employeeModel->update($newEmployee, $where)) {
			//插入审核记录
			$newEmployeeStatus['employee_id'] = $id;
			$newEmployeeStatus['actor_user_id'] = $user_id;
			$newEmployeeStatus['apply_status'] = $check_status;
			$newEmployeeStatus['check_status'] = Filter::doFilter($_POST['reason'], 'string');
			$newEmployeeStatus['insert_time'] = getGMTime();
			//更新用户权限
			$employee=$employeeModel->getOneByID($id);
			$userModel=Model('users');
			$newUser['role_id']=2;
			$userWhere="`id`='".$employee['user_id']."'";
			if($userModel->update($newUser,$userWhere)){
				showSuccess('操作成功');
			}
		} else {
			showError('抱歉，操作失败');
		}
	}

	/**
	 * @doc 员工统计
	 * @author Heanes
	 * @time 2015-07-07 14:41:33
	 */
	public function countOp(){
		$this->needLogin();
		Tpl::assign('html_title', '统计');
		Tpl::display('employee/count');
	}

}
