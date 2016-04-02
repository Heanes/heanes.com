<?php
/**
 * @doc 贷款控制器
 * @filesource BorrowController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-12 23:22:48
 */
defined('InHeanes') or exit('Access Invalid!');

class BorrowController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认控制器
	 * @author Heanes
	 * @time 2015-07-17 16:54:53
	 */
	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-17 16:55:09
	 */
	public function listOp(){
		$borrowModel = Model('borrow');
		$borrowParam['where'] = "`uid_slave`='".$_SESSION['user_id']."'";
		//如果设置了查询状态
		if (isset($_REQUEST['applyStatus'])) {
			$applyStatus = intval(Filter::doFilter($_REQUEST['applyStatus'], 'integer'));
			$borrowParam['where'] .= " AND `apply_status`='$applyStatus'";
		}
		$page = new Page(10);
		$borrowList = $borrowModel->getList($borrowParam, $page);
		$userModel = Model('users');
		foreach ($borrowList as $key => $borrow) {
			//获取用户信息
			$borrowList[$key]['user'] = $userModel->getOneByID($borrow['uid_slave']);
		}
		Tpl::assign('borrowList', $borrowList);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title', '借款列表');
		Tpl::display('borrow/list');
	}

	/**
	 * @doc 显示贷款详情
	 * @author Heanes
	 * @time 2015-07-13 00:24:17
	 */
	public function showOp(){
		if (isset($_GET['id'])) {
			$id = Filter::doFilter($_GET['id'], 'integer');
			//1.获取贷款表中原始数据
			$borrowModel = Model('borrow');
			$borrow = $borrowModel->getOneByID($id);
			//1.2获取贷款产品（用途）信息
			$productModel = Model('product');
			$borrow['_product'] = $productModel->getOneByID($borrow['usage_id']);
			Tpl::assign('borrow', $borrow);
			//1.3获取客户自身信息
			$userModel = Model('users');
			$userInfo = $userModel->getOneByID($borrow['uid_slave']);
			Tpl::assign('userInfo', $userInfo);
			//2.获取贷款进度
			//2.1审核进度
			$borrowApplyModel = Model('borrow_apply_status_log');
			$borrowApplyParam['where'] = "`jk_id`='$id'";
			$borrowApplyLog = $borrowApplyModel->getList($borrowApplyParam);
			Tpl::assign('borrowApplyLog', $borrowApplyLog);
			//2.2贷款进程
			$borrowProgressModel = Model('borrow_progress');
			$borrowProgressParam['where'] = "`jk_id`='$id'";
			$borrowProgressLog = $borrowProgressModel->getList($borrowProgressParam);
			Tpl::assign('borrowProgressLog', $borrowProgressLog);
			Tpl::assign('html_title', '贷款详情');
			Tpl::display('borrow/show');
		} else {
			showError('参数错误');
		}
	}

	/**
	 * @doc 添加贷款
	 * @author Heanes
	 * @time 2015-07-13 00:18:13
	 */
	public function addOp(){
		$this->addFromExistsCustomerOp();
	}

	/**
	 * @doc 从已有客户中选择一个来添加贷款
	 * @author Heanes
	 * @time 2015-07-13 00:18:54
	 */
	public function addFromExistsCustomerOp(){
		$this->needLogin();
		if (isset($_GET['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$uid_slave = Filter::doFilter($_GET['user_id'], 'integer');
			//1、先检查此客户是不是客户关系
			$customerModel = Model('customer');
			$customerParam['where'] = "`uid_master`='$user_id' AND `uid_slave`='$uid_slave'";
			if (count($customerModel->getOne($customerParam))) {
				$userModel = Model('users');
				$user = $userModel->getOneByID($uid_slave);
				Tpl::assign('user', $user);
				//获取贷款产品
				$productModel = Model('product');
				$productParam['where'] = "`is_enable`=1 AND `is_delete`=0";
				$productList = $productModel->getList($productParam);
				Tpl::assign('productList', $productList);
				Tpl::assign('html_title', '添加贷款');
				Tpl::display('borrow/addFromExistsUser');
			} else {
				showError('Ta还不是你的客户！');
			}
		} else {
			$user_id = $_SESSION['user_id'];
			//1.先查找该用户的所有客户
			$customerModel = Model('customer');
			$customerParam['where'] = "`uid_master`='$user_id' AND `status`=1 AND `is_enable`=1 AND `is_delete`=0";
			$customerParam['order'] = array('insert_time' => 'DESC');
			$customerList = $customerModel->getList($customerParam);
			if (count($customerList)) {
				$customerUserIdString = '';
				foreach ($customerList as $key => $customer) {
					$customerUserIdString .= "'".$customer['uid_slave']."'";
					if ($key < count($customerList) - 1) {
						$customerUserIdString .= ',';
					}
				}
				$keywords = Filter::doFilter($_GET['keywords'], 'string');
				$page = new Page(10);
				$userModel = Model('users');
				$userParam['where'] = "`id` in($customerUserIdString)";
				Tpl::assign('html_title', '我的客户');
				if (isset($_GET['keywords'])) {
					$userParam['where'] .= " AND (`user_name` = '$keywords' OR `real_name`='$keywords' OR `mobile` = '$keywords' OR `idcard` = '$keywords')";
					Tpl::assign('keywords', $_GET['keywords']);
					Tpl::assign('html_title', '搜索结果');
				}
				$userList = $userModel->getList($userParam, $page);
				Tpl::assign('pager', $page->getPager());
			} else {
				$userList = array();
			}
			Tpl::assign('userList', $userList);
			Tpl::display('borrow/searchUser');
		}
	}

	/**
	 * @doc 插入已有用户到贷款数据中
	 * @author Heanes
	 * @time 2015-07-17 16:56:13
	 */
	public function _addFromExistsCustomerOp(){
		$this->needLogin();
		//1、先检查此客户是不是客户关系
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$uid_slave = Filter::doFilter($_GET['user_id'], 'integer');
		$customerModel = Model('customer');
		$customerParam['where'] = "`uid_master`='$user_id' AND `uid_slave`='$uid_slave'";
		if (count($customerModel->getOne($customerParam))) {
			$newBorrow = array(
				'uid_master'   => $user_id,
				'uid_slave'    => $uid_slave,
				'usage_id'     => Filter::doFilter($_POST['usage_id'], 'integer'),
				'usage_info'   => Filter::doFilter($_POST['usage_info'], 'string'),
				'total'        => Filter::doFilter($_POST['total'], 'integer'),
				'year_limit'   => Filter::doFilter($_POST['year_limit'], 'integer'),
				'rate'         => Filter::doFilter($_POST['rate'], 'string'),
				'insert_time'  => getGMTime(),
				'apply_time'  => getGMTime(),
				'apply_status' => 0,
			);
			$borrowModel = Model('borrow');
			$newBorrowInsertResult = $borrowModel->insert($newBorrow);
			if ($newBorrowInsertResult) {
				showSuccess('贷款申请成功！');
			} else {
				showError('对不起，贷款信息输入有误，请重新输入。');
			}
		} else {
			showError('Ta还不是你的客户！');
		}
	}

	/**
	 * @doc 添加新贷款、新客户
	 * @author Heanes
	 * @time 2015-08-04 11:46:17
	 */
	public function addFromNewUserOp(){
		if (isSubmit('add_borrow_data_form')) {
			$this->_insertWithNewCustomer();
		} else {
			/*
			//1.添加银行卡
			$bankModel = Model('bank');
			$bankList = $bankModel->getList();
			Tpl::assign('bankList', $bankList);
			*/
			//2.查询需要注册的字段信息
			$userFields = Model('user_fields');
			$userFieldsParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
			$userFieldsParam['order'] = array('order' => 'DESC');
			$userFieldsList = $userFields->getList($userFieldsParam);
			Tpl::assign('userFieldsList', $userFieldsList);
			//3.1查询需要添加的资产信息
			$propertyModel = Model('property');
			$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
			$propertyParam['order'] = array('order' => 'ASC');
			$propertyList = $propertyModel->getList($propertyParam);
			//3.2查询添加资产需要填写的字段
			$propertyFieldsModel = Model('property_fields');
			foreach ($propertyList as $key => $property) {
				$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
				$propertyFieldsParam['order'] = array('order' => 'ASC');
				$propertyList[$key]['propertyFields'] = $propertyFieldsModel->getList($propertyFieldsParam);
			}
			//4查询需要添加的用户认证信息
			$certificationTypeModel = Model('certification_type');
			$certificationTypeParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_delete`=0";
			$certificationTypeList = $certificationTypeModel->getList($certificationTypeParam);
			//4.1 查询添加认证需要填写的字段
			$certificationTypeFieldsModel = Model('certification_type_fields');
			foreach ($certificationTypeList as $key => $certificationType) {
				$certificationTypeFieldsParam['where'] = "`type_id`='".$certificationType['id']."' AND `add_show`=1 AND `is_enable`=1 AND `is_delete`=0";
				$certificationTypeList[$key]['certificationTypeFields'] = $certificationTypeFieldsModel->getList($certificationTypeFieldsParam);
			}
			Tpl::assign('certificationTypeList', '');
			Tpl::assign('propertyList', $propertyList);

			Tpl::assign('html_title', '添加贷款');
			Tpl::display('borrow/addFromNewUser');
		}
	}

	/**
	 * @doc 插入贷款数据以及新用户数据
	 * @author Heanes
	 * @time 2015-08-05 13:39:50
	 */
	protected function _insertWithNewCustomer(){
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
			$CertificationTypeParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
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
						$userCertificationTypeFieldsParam['where'] = "`type_id`='".$CertificationType['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
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
			//3.资产信息
			//3.1添加用户资产信息
			$userPropertyModel = Model('user_property');
			//3.2添加用户资产属性信息
			$propertyModel = Model('property');
			$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
			$propertyList = $propertyModel->getList($propertyParam);
			$UserPropertyFieldsDataModel = Model('user_property_fields_data');
			foreach ($propertyList as $key => $property) {
				//是否有此资产
				$isHaveProperty = Filter::doFilter($_POST['has_property'.$property['id']], 'integer');
				if ($isHaveProperty == 1) {
					$newUserProperty['user_id'] = $newUserId;
					$newUserProperty['property_id'] = $property['id'];
					$newUserProperty['insert_time'] = getGMTime();
					if ($userPropertyModel->insert($newUserProperty)) {
						//获取要添加字段
						$propertyFieldsModel = Model('property_fields');
						$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_delete`='0'";
						$propertyFieldsList = $propertyFieldsModel->getList($propertyFieldsParam);
						foreach ($propertyFieldsList as $fields_key => $propertyFields) {
							$newUserPropertyFieldsData['user_id'] = $newUserId;
							$newUserPropertyFieldsData['fields_id'] = $propertyFields['id'];
							if (Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string') != '') {
								//如果是上传文件类型
								if ($propertyFields['input_type'] == 'file-image') {
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
								$newUserPropertyFieldsData['insert_time'] = getGMTime();
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
			$customerParam['where'] = "`uid_slave`='$newUserId' AND `uid_master`='$user_id' AND `is_delete`=1";
			if (count($customerModel->getOne($customerParam))) {
				showError('此用户已经是你的客户');
			} else {
				//4.1.2 不是则插入客户关系
				$newCustomer['uid_master'] = $user_id;
				$newCustomer['uid_slave'] = $newUserId;
				$newCustomer['insert_time'] = getGMTime();
				$newCustomer['status'] = 0;
				$newCustomer['apply_now'] = 1;
				if ($customerModel->insert($newCustomer)) {
					//5.1添加贷款数据
					$newBorrow = array(
						'uid_master'   => $user_id,
						'uid_slave'    => $newUserId,
						'usage_id'     => Filter::doFilter($_POST['usage_id'], 'integer'),
						'usage_info'   => Filter::doFilter($_POST['usage_info'], 'string'),
						'total'        => Filter::doFilter($_POST['total'], 'integer'),
						'year_limit'   => Filter::doFilter($_POST['year_limit'], 'integer'),
						'rate'         => Filter::doFilter($_POST['rate'], 'string'),
						'insert_time'  => getGMTime(),
						'apply_time'  => getGMTime(),
						'apply_status' => 0,
					);
					$borrowModel = Model('borrow');
					$newBorrowInsertResult = $borrowModel->insert($newBorrow);
					if ($newBorrowInsertResult) {
						$result=array(
							'title'=>'提示',
							'message'=>'贷款添加成功！请耐心等待系统审核',
							'jump'=>array(
								'left'=>array('text'=>'继续添加','href'=>BASE_URL.'index.php?act=borrow&op=addFromNewUser'),
								'right'=>array('text'=>'确定','href'=>BASE_URL.'index.php?act=member')
							),
						);
						showSuccess($result);
					} else {
						showError('对不起，贷款信息输入有误，请重新输入。');
					}
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
	 * @doc 贷款审核列表
	 * @author Heanes
	 * @time 2015-07-13 00:21:47
	 */
	public function checkListOp(){
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$borrowModel = Model('borrow');
		$borrowParam['where'] = "`uid_master`='".$user_id."'";
		//如果设置了查询状态
		if (isset($_REQUEST['apply_status'])) {
			$apply_status = intval(Filter::doFilter($_REQUEST['apply_status'], 'integer'));
			$borrowParam['where'] .= " AND `apply_status`='$apply_status'";
		}
		$page = new Page(10);
		$borrowList = $borrowModel->getList($borrowParam, $page);
		$userModel = Model('users');
		foreach ($borrowList as $key => $borrow) {
			//获取用户信息
			$borrowList[$key]['user_master'] = $userModel->getOneByID($borrow['uid_master']);
			$borrowList[$key]['user_slave'] = $userModel->getOneByID($borrow['uid_slave']);
		}
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('borrowList', $borrowList);
		Tpl::display('borrow/checkList');
	}

	/**
	 * @doc 贷款审核页面
	 * @author Heanes
	 * @time 2015-07-13 00:22:09
	 */
	public function checkOp(){
		$borrow_id = Filter::doFilter($_GET['id'], 'integer');
		//1.贷款自身信息
		$borrowModel = Model('borrow');
		$borrow = $borrowModel->getOneByID($borrow_id);
		//2.借款用途信息
		$productModel=Model('product');
		$borrow['_product']=$productModel->getOneByID($borrow['usage_id']);
		$userModel = Model('users');
		//1.业务员自身信息和客户自身信息
		$borrow['user_master'] = $userModel->getOneByID($borrow['uid_master']);
		$borrow['user_slave'] = $userModel->getOneByID($borrow['uid_slave']);
		//1.2业务员部门信息
		$employeeModel=Model('employee');
		$departmentModel=Model('department');
		$employeeParam['where']="`user_id`='".$borrow['uid_master']."'";
		$employeeInfo=$employeeModel->getOne($employeeParam);
		$departmentParam['where']="`id`='".$employeeInfo['department_id']."'";
		$borrow['user_master']['department']=$departmentModel->getOne($departmentParam);
		//2.用户认证信息
		//2.1所有要显示的用户认证信息
		$certificationTypeModel=Model('certification_type');
		$certificationTypeParam['where']="`add_show`=1 AND `is_enable`=1 AND `is_delete`=0";
		$certificationTypeList=$certificationTypeModel->getList($certificationTypeParam);
		//2.2查找用户是否有该认证信息
		$userCertificationModel=Model('user_certification');
		$userCertificationList = array();
		foreach ($certificationTypeList as $key => $certificationType) {
			$userCertificationParam['where'] = "`user_id`='".$borrow['user_slave']['id']."' AND `type_id`='".$certificationType['id']."'";
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
							$userCertificationFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$borrow['user_slave']['id']."'";
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
		$propertyParam['where'] = "`add_show`=1 AND `is_enable`=1 AND `is_delete`=0";
		$propertyList = $propertyModel->getList($propertyParam);
		$userPropertyModel = Model('user_property');
		//3.2查找用户是否有该资产数据
		$userPropertyList = array();
		foreach ($propertyList as $key => $property) {
			$userPropertyParam['where'] = "`user_id`='".$borrow['user_slave']['id']."' AND `property_id`='".$property['id']."'";
			$userPropertyParam['order'] = array('order' => 'ASC');
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
							$userPropertyFieldsDataParam['where'] = "`fields_id`='".$fields['id']."' AND `user_id`='".$borrow['user_slave']['id']."'";
							$userPropertyList[$key][$propertyKey]['_fields_value'][$fieldsKey] = $userPropertyFieldsDataModel->getOne($userPropertyFieldsDataParam);
						}
					}
				}
			}
		}
		Tpl::assign('userPropertyList', $userPropertyList);
		Tpl::assign('borrow', $borrow);
		Tpl::display('borrow/check');
	}

	/**
	 * @doc 贷款审核操作
	 * @author Heanes
	 * @time 2015-07-13 00:23:06
	 */
	public function updateCheckOp(){
		$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
		$id = Filter::doFilter($_GET['id'], 'integer');
		$check_status_result = Filter::doFilter($_POST['check_status'], 'integer');
		//1.贷款自身信息
		$borrowModel = Model('borrow');
		$borrowParamWhere = "`id`='".$id."'";
		$updateBorrow['apply_status'] = $check_status_result;
		$updateCustomer['update_time'] = getGMTime();
		if ($borrowModel->update($updateBorrow, $borrowParamWhere)) {
			//添加审核记录
			$borrowApplyStatusLogModel = Model('customer_status_log');
			$newBorrowApplyStatusLog['customer_id'] = $id;
			$newBorrowApplyStatusLog['actor_user_id'] = $user_id;
			$newBorrowApplyStatusLog['insert_time'] = getGMTime();
			$newBorrowApplyStatusLog['status'] = $check_status_result;
			$borrowApplyStatusLogModel->insert($newBorrowApplyStatusLog);
			showSuccess('操作成功');
		} else {
			showError('操作失败');
		}
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-07 14:51:01
	 */
	public function editOp(){
		showError('贷款信息修改功能稍后开放');
	}

	/**
	 * @doc 更新数据
	 * @author Heanes
	 * @time 2015-07-13 00:20:25
	 */
	public function updateOp(){
		;
	}

	/**
	 * @doc 删除数据
	 * @author Heanes
	 * @time 2015-07-13 00:21:14
	 */
	public function deleteOp(){
		;
	}

	/**
	 * @doc 贷款统计
	 * @author Heanes
	 * @time 2015-07-14 16:25:13
	 */
	public function countOp(){
		Tpl::assign('html_title', '贷款统计');
		Tpl::display('borrow/count');
	}

	/**
	 * @doc 搜索
	 * @author Heanes
	 * @time 2015-07-23 16:06:29
	 */
	public function searchOp(){
		if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
			$keywords = Filter::doFilter($_GET['keywords'], 'string');
			$borrowModel = Model('borrow');
			$borrowParam['where'] = "`uid_master`='".$_SESSION['user_id']."'";
			$borrowParam['order'] = array('insert_time' => 'DESC');
			$borrowList = $borrowModel->getList($borrowParam);
			if (count($borrowList)) {
				$borrowUserIdString=implode("','",array_column($borrowList,'uid_slave'));
				$userModel = Model('users');
				$page = new Page(10);
				$userParam['where'] = "`id` in('$borrowUserIdString') AND (`user_name` = '$keywords' OR `real_name`='$keywords' OR `mobile` = '$keywords' OR `idcard` = '$keywords')";
				$userList = $userModel->getList($userParam, $page);
				Tpl::assign('pager', $page->getPager());
			} else {
				$userList = array();
			}
			Tpl::assign('keywords', $_GET['keywords']);
			Tpl::assign('borrowList', $borrowList);
			Tpl::assign('userList', $userList);
			Tpl::assign('html_title', '搜索结果');
		}
		Tpl::assign('html_title', '贷款查询');
		Tpl::display('borrow/search');
	}

}

