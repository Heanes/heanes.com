<?php
/**
 * @doc 客户控制器
 * @filesource CustomerController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-07 14:39:25
 */
defined('InHeanes') or exit('Access Invalid!');

class CustomerController extends BaseWapController{
	public function __construct(){
		parent::__construct();
		$this->needLogin();
		//$this->checkRoleOp();
	}

	public function indexOp(){
		if (isset($_REQUEST['id'])) {
			$this->showOp();
		} else {
			$this->listOp();
		}
	}

	/**
	 * @doc 客户列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function listOp(){
		$customerModel = Model('customer');
		$customerParam['where'] = "`uid_master`='".$_SESSION['user_id']."'";
		//如果设置了查询状态
		if (isset($_REQUEST['status'])) {
			$status = intval(Filter::doFilter($_REQUEST['status'], 'integer'));
			$customerParam['where'] .= " AND `status`='$status'";
		}
		$page = new Page(10);
		$customerList = $customerModel->getList($customerParam, $page);
		$userModel = Model('users');
		foreach ($customerList as $key => $customer) {
			//获取用户信息
			$customerList[$key]['user'] = $userModel->getOneByID($customer['uid_slave']);
		}
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title','贷款列表');
		Tpl::assign('customerList', $customerList);
		Tpl::display('customer/list');
	}

	/**
	 * @doc 显示客户详细信息
	 * @author Heanes
	 * @time 2015-07-06 16:04:03
	 */
	public function showOp(){
		$customer_id = Filter::doFilter($_GET['id'], 'integer');
		$customerModel = Model('customer');
		$customer = $customerModel->getOneByID($customer_id);
		//1客户自身数据信息
		$userModel = Model('users');
		$userInfo = $userModel->getOneByID($customer['uid_slave']);
		Tpl::assign('userInfo', $userInfo);
		//2用户资产信息
		//2.1所有要显示的资产信息
		$propertyModel = Model('property');
		$propertyParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
		$propertyList = $propertyModel->getList($propertyParam);
		$userPropertyModel = Model('user_property');
		//2.2查找用户是否有该资产数据
		$userPropertyList = array();
		foreach ($propertyList as $key => $property) {
			$userPropertyParam['where'] = "`user_id`='".$userInfo['id']."' AND `property_id`='".$property['id']."'";
			$userPropertyParam['order'] = array('order_number' => 'ASC');
			$userPropertyList[$key] = $userPropertyModel->getList($userPropertyParam);
		}
		Tpl::assign('propertyList', $propertyList);
		//2.3获取用户资产属性信息
		//2.3.1获取资产属性字段
		$propertyFieldsModel = Model('property_fields');
		foreach ($userPropertyList as $key => $userProperty) {
			if (count($userProperty)) {
				foreach ($userProperty as $propertyKey => $property) {
					$propertyFieldsParam['where'] = "`property_id`='".$property['property_id']."'";
					$userPropertyList[$key][$propertyKey]['_fields'] = $propertyFieldsModel->getList($propertyFieldsParam);
				}
			}
		}
		//2.3.2获取资产属性值
		$userPropertyFieldsDataModel = Model('user_property_fields_data');
		foreach ($userPropertyList as $key => $userProperty) {
			if (count($userProperty)) {
				foreach ($userProperty as $propertyKey => $property) {
					if (count($property)) {
						foreach ($property['_fields'] as $fieldsKey => $fields) {
							$userPropertyFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$userInfo['id']."'";
							$userPropertyList[$key][$propertyKey]['_fields_value'][$fieldsKey] = $userPropertyFieldsDataModel->getOne($userPropertyFieldsDataParam);
						}
					}
				}
			}
		}
		//var_dump($userPropertyList);
		Tpl::assign('userPropertyList', $userPropertyList);
		Tpl::assign('html_title','贷款详情');
		Tpl::assign('customer', $customer);
		Tpl::display('customer/show');
	}

	/**
	 * @doc 显示会员录入的第一页add信息,判断添加信息的逻辑流程
	 * @author Carr
	 * @time 2015-07-3 16:04:03
	 */
	public function addOp(){
		Tpl::assign('html_title', '添加新客户');
		Tpl::display('customer/add');
	}

	/**
	 * @doc 从已有用户中选择一个成为客户
	 * @author Heanes
	 * @time 2015-07-13 00:16:15
	 */
	public function addFromExistsUserOp(){
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
			Tpl::display('customer/searchUser');
		} elseif (isset($_GET['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$uid_slave = Filter::doFilter($_GET['user_id'], 'integer');
			//1、先检查是否已经是客户关系
			$customerModel = Model('customer');
			$customerParam['where'] = "`uid_slave`='$uid_slave' && `uid_master`='$user_id'";
			if (count($customerModel->getOne($customerParam))) {
				showError('此用户已经是你的客户');
			} else {
				//2、不是则询问是否申请为客户关系
				$userModel = Model('users');
				$user = $userModel->getOneByID($uid_slave);
				Tpl::assign('user', $user);
				Tpl::assign('html_title', '确定将此用户添加为客户吗？');
				Tpl::display('customer/confirmAddFromExistsUser');
			}
		} else {
			Tpl::assign('html_title', '搜索用户');
			Tpl::display('customer/searchUser');
		}
	}

	/**
	 * @doc 申请添加已有用户为客户关系操作
	 * @author Heanes
	 * @time 2015-07-13 11:35:31
	 */
	public function _addFromExistsUserOp(){
		$user_id = $_SESSION['user_id'];
		$uid_slave = Filter::doFilter($_POST['uid_slave'], 'integer');
		//1、先检查是否已经是客户关系
		$customerModel = Model('customer');
		$customerParam['where'] = "`uid_slave`='$uid_slave' && `uid_master`='$user_id'";
		if (count($customerModel->getOne($customerParam))) {
			showError('此用户已经是你的客户');
		} else {
			//2、不是则询问是否申请为客户关系
			$newCustomer['uid_slave'] = $uid_slave;
			$newCustomer['uid_master'] = $user_id;
			$newCustomer['create_time'] = getGMTime();
			$newCustomer['status'] = 0;
			$newCustomer['apply_now'] = 1;
			if ($customerModel->insert($newCustomer)) {
				showSuccess('添加成功');
			} else {
				showError('抱歉，添加失败');
			}
		}
	}

	/**
	 * @doc 添加新的用户
	 * @author Heanes
	 * @time 2015-07-13 00:16:44
	 */
	public function addFromNewUserOp(){
		if (isSubmit('user_add_form_submit')) {
			$this->_insertNewUser();
		} else {
			/*
			//1.添加银行卡
			$bankModel = Model('bank');
			$bankList = $bankModel->getList();
			Tpl::assign('bankList', $bankList);
			*/
			//2.查询需要注册的字段信息
			$userFields = Model('user_fields');
			$userFieldsParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$userFieldsParam['order'] = array('order_number' => 'DESC');
			$userFieldsList = $userFields->getList($userFieldsParam);
			Tpl::assign('userFieldsList', $userFieldsList);
			//3.1查询需要添加的资产信息
			$propertyModel = Model('property');
			$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$propertyParam['order'] = array('order_number' => 'ASC');
			$propertyList = $propertyModel->getList($propertyParam);
			//3.2查询添加资产需要填写的字段
			$propertyFieldsModel = Model('property_fields');
			foreach ($propertyList as $key => $property) {
				$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
				$propertyFieldsParam['order'] = array('order_number' => 'ASC');
				$propertyList[$key]['propertyFields'] = $propertyFieldsModel->getList($propertyFieldsParam);
			}
			//4查询需要添加的用户认证信息
			$certificationTypeModel = Model('certification_type');
			$certificationTypeParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
			$certificationTypeList = $certificationTypeModel->getList($certificationTypeParam);
			//4.1 查询添加认证需要填写的字段
			$certificationTypeFieldsModel = Model('certification_type_fields');
			foreach ($certificationTypeList as $key => $certificationType) {
				$certificationTypeFieldsParam['where'] = "`type_id`='".$certificationType['id']."' AND `add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
				$certificationTypeList[$key]['certificationTypeFields'] = $certificationTypeFieldsModel->getList($certificationTypeFieldsParam);
			}
			Tpl::assign('certificationTypeList', $certificationTypeList);
			Tpl::assign('propertyList', $propertyList);

			Tpl::assign('html_title', '添加新客户');
			Tpl::display('customer/addFromNewUser');
		}
	}

	/**
	 * @doc 执行数据入库程序
	 * @author Carr
	 * @time 2015-07-3 16:04:03
	 */
	public function _insertNewUser(){
		//检查权限
		$user_id = intval($_SESSION['user_id']);
		//1.1用户基本数据
		$newUser['user_name'] = generateRandomString(8);
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
		$newUser['reg_ip'] = get_client_ip();
		$newUser['reg_time'] = getGMTime();
		//1.2用户其他字段的信息
		//2.0先将用户数据插入到数据库中，并得到新用户的ID
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
					$newUserCertification['create_time'] = getGMTime();
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
								$newUserCertificationFieldsData['create_time'] = getGMTime();
								$userCertificationFieldsDataModel->insert($newUserCertificationFieldsData);
								unset($newUserCertificationFieldsData);
							}
						}
					}
				}
			}
			//3.资产信息
			//3.1添加用户资产信息
			$userPropertyModel = Model('user_property');
			//3.2添加用户资产属性信息
			$propertyModel = Model('property');
			$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$propertyList = $propertyModel->getList($propertyParam);
			$UserPropertyFieldsDataModel = Model('user_property_fields_data');
			foreach ($propertyList as $key => $property) {
				//是否有此资产
				$isHaveProperty = Filter::doFilter($_POST['has_property'.$property['id']], 'integer');
				if ($isHaveProperty == 1) {
					$newUserProperty['user_id'] = $newUserId;
					$newUserProperty['property_id'] = $property['id'];
					$newUserProperty['create_time'] = getGMTime();
					if ($userPropertyModel->insert($newUserProperty)) {
						//获取要添加字段
						$propertyFieldsModel = Model('property_fields');
						$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
						$propertyFieldsList = $propertyFieldsModel->getList($propertyFieldsParam);
						foreach ($propertyFieldsList as $fields_key => $propertyFields) {
							$newUserPropertyFieldsData['user_id'] = $newUserId;
							$newUserPropertyFieldsData['fields_id'] = $propertyFields['id'];
							if (Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string') != '') {
								//如果是上传文件类型
								if ($propertyFields['input_type'] == 'file-image') {
									//上传文件操作
									/*
									$upload = new UploadFile();
									$upload->setPath('user'.DS.$newUserId.DS.'property');
									$upload->set('max_size', 10240);
									if ($_FILES['property_fields_value'.$propertyFields['id']]['size'] <= 1024 * 1024 * 10) {
										$FieldsUploadResult = $upload->upload('property_fields_value'.$propertyFields['id']);
										if ($FieldsUploadResult) {
											$propertyFieldsUploadResult = $upload->getUploadResult();
											$newUserPropertyFieldsData['fields_value'] = $propertyFieldsUploadResult['save_path'].$propertyFieldsUploadResult['save_name'];
										} else {
											showError('文件上传出现错误');
										}
									}
									*/
									//@todo 用此方式创建不存在的目录，并不是最优解
									$upload = new UploadFile();
									$upload->setPath('user'.DS.$newUserId.DS.'property');
									$newUserPropertyFieldsValue=Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string');
									$newUserPropertyFieldsData['fields_value'] = 'user'.DS.$newUserId.DS.'property'.DS.Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string');
									//将临时目录文件下的文件移动到保存目录
									rename(PATH_ABS_SYS_FILE_UPLOAD.'temp'.DS.$newUserPropertyFieldsValue,PATH_ABS_SYS_FILE_UPLOAD.$newUserPropertyFieldsData['fields_value']);
								} else {
									$newUserPropertyFieldsData['fields_value'] = Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string');
								}
								$newUserPropertyFieldsData['create_time'] = getGMTime();
								$UserPropertyFieldsDataModel->insert($newUserPropertyFieldsData);
								unset($newUserPropertyFieldsData);
							}
						}
					}
				}
			}
			//4.1添加客户关系记录
			//4.1.1、先检查是否已经是客户关系
			$customerModel = Model('customer');
			$customerParam['where'] = "`uid_slave`='$newUserId' AND `uid_master`='$user_id' AND `is_deleted`=1";
			if (count($customerModel->getOne($customerParam))) {
				showError('此用户已经是你的客户');
			} else {
				//4.1.2 不是则插入客户关系
				$newCustomer['uid_master'] = $user_id;
				$newCustomer['uid_slave'] = $newUserId;
				$newCustomer['create_time'] = getGMTime();
				$newCustomer['status'] = 0;
				$newCustomer['apply_now'] = 1;
				if ($customerModel->insert($newCustomer)) {
					$result=array(
						'title'=>'提示',
						'message'=>'添加成功',
						'jump'=>array(
							'left'=>array('text'=>'继续添加','href'=>BASE_URL.'index.php?act=customer&op=addFromNewUser'),
							'right'=>array('text'=>'确定','href'=>BASE_URL.'index.php?act=customer')
						),
					);
					showSuccess($result);
				} else {
					$result=array(
						'title'=>'提示',
						'message'=>'抱歉，客户添加失败！',
						'jump'=>array(
							'left'=>array('text'=>'继续添加','href'=>BASE_URL.'index.php?act=customer&op=addFromNewUser'),
							'right'=>array('text'=>'确定','href'=>BASE_URL.'index.php?act=customer')
						),
					);
					showSuccess($result);
				}
			}
		}
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-07 14:51:01
	 */
	public function editOp(){
		showError('客户信息修改功能稍后开发');
	}

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-07 14:51:22
	 */
	public function updateOp(){
		;
	}

	/**
	 * @doc 客户列表
	 * @author Heanes
	 * @time 2015-07-07 16:04:03
	 */
	public function checkListOp(){
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$customerModel = Model('customer');
		$customerParam['where'] = "`uid_master`='".$user_id."'";
		//如果设置了查询状态
		if (isset($_REQUEST['status'])) {
			$status = intval(Filter::doFilter($_REQUEST['status'], 'integer'));
			$customerParam['where'] .= " AND `status`='$status'";
		}
		$page = new Page(10);
		$customerList = $customerModel->getList($customerParam, $page);
		$userModel = Model('users');
		foreach ($customerList as $key => $customer) {
			//获取用户信息
			$customerList[$key]['user_master'] = $userModel->getOneByID($customer['uid_master']);
			$customerList[$key]['user_slave'] = $userModel->getOneByID($customer['uid_slave']);
		}
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('customerList', $customerList);
		Tpl::display('customer/checkList');
	}

	/**
	 * @doc 审核操作
	 * @author Heanes
	 * @time 2015-07-07 16:04:03
	 */
	public function checkOp(){
		$customer_id = Filter::doFilter($_GET['id'], 'integer');
		$customerModel = Model('customer');
		$customer = $customerModel->getOneByID($customer_id);
		$userModel = Model('users');
		//1.业务员自身信息和客户自身信息
		$customer['user_master'] = $userModel->getOneByID($customer['uid_master']);
		$customer['user_slave'] = $userModel->getOneByID($customer['uid_slave']);
		//1.2业务员部门信息
		$employeeModel=Model('employee');
		$departmentModel=Model('department');
		$employeeParam['where']="`user_id`='".$customer['uid_master']."'";
		$employeeInfo=$employeeModel->getOne($employeeParam);
		$departmentParam['where']="`id`='".$employeeInfo['department_id']."'";
		$customer['user_master']['department']=$departmentModel->getOne($departmentParam);
		//2.用户认证信息
		//2.1所有要显示的用户认证信息
		$certificationTypeModel=Model('certification_type');
		$certificationTypeParam['where']="`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
		$certificationTypeList=$certificationTypeModel->getList($certificationTypeParam);
		//2.2查找用户是否有该认证信息
		$userCertificationModel=Model('user_certification');
		$userCertificationList = array();
		foreach ($certificationTypeList as $key => $certificationType) {
			$userCertificationParam['where'] = "`user_id`='".$customer['user_slave']['id']."' AND `type_id`='".$certificationType['id']."'";
			$userCertificationList[$key] = $userCertificationModel->getList($userCertificationParam);
		}
		Tpl::assign('certificationTypeList', $certificationTypeList);
		//2.3获取用户认证属性信息
		//2.3.1获取认证属性字段
		$certificationTypeFieldsModel=Model('certification_type_fields');
		foreach ($userCertificationList as $key => $userCertification) {
			if (count($userCertification)) {
				foreach ($userCertification as $userCertificationKey => $certification) {
					$certificationTypeFieldsParam['where'] = "`type_id`='".$certification['type_id']."' AND `add_show`=1";
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
							$userCertificationFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$customer['user_slave']['id']."'";
							$userCertificationList[$key][$userCertificationKey]['_fields_value'][$fieldsKey] = $userCertificationFieldsDataModel->getOne($userCertificationFieldsDataParam);
						}
					}
				}
			}
		}
		//var_dump($userCertificationList);
		Tpl::assign('userCertificationList', $userCertificationList);
		//3用户资产信息
		//3.1所有要显示的资产信息
		$propertyModel = Model('property');
		$propertyParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_deleted`=0";
		$propertyList = $propertyModel->getList($propertyParam);
		$userPropertyModel = Model('user_property');
		//3.2查找用户是否有该资产数据
		$userPropertyList = array();
		foreach ($propertyList as $key => $property) {
			$userPropertyParam['where'] = "`user_id`='".$customer['user_slave']['id']."' AND `property_id`='".$property['id']."'";
			$userPropertyParam['order'] = array('order_number' => 'ASC');
			$userPropertyList[$key] = $userPropertyModel->getList($userPropertyParam);
		}
		Tpl::assign('propertyList', $propertyList);
		//3.3获取用户资产属性信息
		//3.3.1获取资产属性字段
		$propertyFieldsModel = Model('property_fields');
		foreach ($userPropertyList as $key => $userProperty) {
			if (count($userProperty)) {
				foreach ($userProperty as $propertyKey => $property) {
					$propertyFieldsParam['where'] = "`property_id`='".$property['property_id']."'";
					$userPropertyList[$key][$propertyKey]['_fields'] = $propertyFieldsModel->getList($propertyFieldsParam);
				}
			}
		}
		//3.3.2获取资产属性值
		$userPropertyFieldsDataModel = Model('user_property_fields_data');
		foreach ($userPropertyList as $key => $userProperty) {
			if (count($userProperty)) {
				foreach ($userProperty as $propertyKey => $property) {
					if (count($property['_fields'])) {
						foreach ($property['_fields'] as $fieldsKey => $fields) {
							$userPropertyFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$customer['user_slave']['id']."'";
							$userPropertyList[$key][$propertyKey]['_fields_value'][$fieldsKey] = $userPropertyFieldsDataModel->getOne($userPropertyFieldsDataParam);
						}
					}
				}
			}
		}
		//var_dump($userPropertyList);
		Tpl::assign('userPropertyList', $userPropertyList);
		Tpl::assign('customer', $customer);
		Tpl::display('customer/check');
	}

	/**
	 * @doc 执行审核状态提交控制
	 * @author Carr
	 * @time 2015-07-07 16:04:03
	 */
	public function updateCheckOp(){
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$id = Filter::doFilter($_GET['id'], 'integer');
		$check_status_result = Filter::doFilter($_POST['check_status'], 'integer');
		$customerModel = Model('customer');
		$customerParamWhere = "`id`='".$id."'";
		$updateCustomer['status'] = $check_status_result;
		$updateCustomer['update_time'] = getGMTime();
		if ($customerModel->update($updateCustomer, $customerParamWhere)) {
			//添加审核记录
			$customerStatusLogModel = Model('customer_status_log');
			$newCustomerStatusLog['customer_id'] = $id;
			$newCustomerStatusLog['actor_user_id'] = $user_id;
			$newCustomerStatusLog['create_time'] = getGMTime();
			$newCustomerStatusLog['status'] = $check_status_result;
			$customerStatusLogModel->insert($newCustomerStatusLog);
			$result = array(
				'title' => '提示',
				'message' => '审核成功',
				'jump' => array(
					'left' => array('text' =>'继续' , 'href' => BASE_URL.'index.php?act=customer&op=checkList&status=0' ),
					'right'=> array('text' =>'确定' , 'href' => BASE_URL.'index.php?act=customer&op=checkList&status=1')
				)
			);
			showSuccess($result);
		} else {
			$result = array(
				'title' => '提示',
				'message' => '抱歉，操作失败',
				'jump' => array(
					'left' => array('text' =>'继续' , 'href' => BASE_URL.'index.php?act=customer&op=checkList&status=0' ),
					'right'=> array('text' =>'确定' , 'href' => BASE_URL.'index.php?act=customer&op=checkList&status=1')
				)
			);
			showError($result);
		}
	}

	/**
	 * @doc 统计页面
	 * @author Heanes
	 * @time 2015-07-07 14:51:46
	 */
	public function countOp(){
		Tpl::assign('html_title', '客户统计');
		Tpl::display('customer/count');
	}

	/**
	 * @doc 查询客户列表
	 * @author Heanes
	 * @time 2015-07-07 14:49:57
	 */
	public function searchOp(){
		$keywords = Filter::doFilter($_GET['keywords'], 'string');
		$customerModel = Model('customer');
		$customerParam['where'] = "`uid_master`='".$_SESSION['user_id']."'";
		$customerParam['order'] = array('create_time' => 'DESC');
		$customerList = $customerModel->getList($customerParam);
		if (count($customerList)) {
			$customerUserIdString=implode("','",array_column($customerList,'uid_slave'));
			$page = new Page(10);
			$userModel = Model('users');
			$userParam['where'] = "`id` in('$customerUserIdString') AND (`user_name` = '$keywords' OR `real_name`='$keywords' OR `mobile` = '$keywords' OR `idcard` = '$keywords')";
			$userList = $userModel->getList($userParam, $page);
			Tpl::assign('pager', $page->getPager());
		} else {
			$userList = array();
		}
		Tpl::assign('keywords', $_GET['keywords']);
		Tpl::assign('customerList', $customerList);
		Tpl::assign('userList', $userList);
		Tpl::assign('html_title', '搜索结果');
		Tpl::display('customer/search');
	}
}
