<?php
/**
 * @doc 贷款相关控制器
 * @filesource MoneyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-17 14:21:14
 */
defined('InHeanes') or exit('Access Invalid!');

class MoneyController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认控制器
	 * @author Heanes
	 * @time 2015-08-17 14:25:27
	 */
	public function indexOp() {
		$this->introduceOp();
	}

	/**
	 * @doc 介绍页面
	 * @author Heanes
	 * @time 2015-08-17 14:24:23
	 */
	public function introduceOp() {
		Tpl::assign('html_title','贷款介绍');
		Tpl::display('money/introduce');
	}

	/**
	 * @doc 申请页面
	 * @author Heanes
	 * @time 2015-07-20 14:07:27
	 */
	public function applyOp(){
		//分为登录和未登录情况
		//1.已登录
		if($this->checkLogin()){
			if(isSubmit('apply_money_form_submit')){
				$this->_apply_hasLogin();
			}else{
				$this->apply_hasLogin();
			}
		}else{
			//2.未登录
			if(isSubmit('apply_money_form_submit')){
				$this->_apply_notLogin();
			}else{
				Tpl::assign('html_title', '快捷申请贷款');
				Tpl::display('money/apply_notLogin');
			}
		}
	}

	/**
	 * @doc 处理申请请求（未登录情况）
	 * @author Heanes
	 * @time 2015-07-20 14:07:27
	 */
	public function _apply_notLogin(){
		//1.验证手机短信验证码
		//数据为空验证
		if (empty($_POST['user_mobile'])) {
			showError('请填写手机号');
		}
		//检测验证码
		/*
		$captcha_code = Filter::doFilter($_POST['captcha'], 'string');
		if (!checkCaptcha('4a0bd59d', $captcha_code)) {
			showError('图形验证码填写错误');
			return false;
		}
		*/
		//验证发送的验证码是否正确
		$checkVerifyCodeStatus = $this->_checkVerifySendCode(30);
		switch ($checkVerifyCodeStatus) {
			case -1:
				showError('手机验证码填写错误！', '', 20);
				break;
			case -2:
				showError('手机验证码已超时!');
				break;
			case 1:
				break;
			case 0:
				showError('还未发送验证码!');
				break;
			default:
				showError('未知错误!');
				break;
		}
		if ($checkVerifyCodeStatus == 1) {
			$newBorrowQuickApply = array(
				'real_name'   => Filter::doFilter($_POST['real_name'], 'string'),
				'phone'       => Filter::doFilter($_POST['user_mobile'], 'string'),
				'money_want'  => Filter::doFilter($_POST['money_want'], 'string'),
				'loan_type'   => Filter::doFilter($_POST['loan_type'], 'integer'),
				'product_id'  => Filter::doFilter($_GET['id'], 'integer'),
				'insert_time' => getGMTime(),
				'user_ip'     => get_client_ip(),
			);
			$borrowQuickApplyModel = Model('money_quick_apply');
			$insertResult = $borrowQuickApplyModel->insert($newBorrowQuickApply);
			if ($insertResult) {
				$result = array(
					'title'   => '提示',
					'message' => '您的贷款已申请成功，稍后信贷经理会与您联系',
					'jump'    => array(
						'left' => array('text' => '返回首页', 'href' => BASE_URL),
					)
				);
				showSuccess($result);
			} else {
				showError('很抱歉，申请出现错误，请稍后重试');
			}
		} else {
			showError('非常抱歉，未知错误,暂时无法注册');
		}
	}

	/**l
	 * @doc 已登录是的申请页面
	 * @author Heanes
	 * @time 2015-08-24 13:31:47
	 */
	protected function apply_hasLogin(){
		//2.查询需要填写的用户字段信息
		$userFields = Model('user_fields');
		$userFieldsParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
		$userFieldsParam['order'] = array('order' => 'DESC');
		$userFieldsList = $userFields->getList($userFieldsParam);
		Tpl::assign('userFieldsList', $userFieldsList);
		//3.1查询需要添加的资产信息
		$propertyModel = Model('property');
		$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
		$propertyParam['order'] = array('order' => 'ASC');
		$propertyList = $propertyModel->getList($propertyParam);
		//3.2查询添加资产需要填写的字段
		$propertyFieldsModel = Model('property_fields');
		foreach ($propertyList as $key => $property) {
			$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
			$propertyFieldsParam['order'] = array('order' => 'ASC');
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
		Tpl::assign('certificationTypeList', '');
		Tpl::assign('propertyList', $propertyList);
		Tpl::assign('html_title', '申请贷款');
		Tpl::display('money/apply_hasLogin');
	}

	/**
	 * @doc 处理申请请求（已登录情况）
	 * @author Heanes
	 * @time 2015-08-17 16:12:14
	 */
	protected function _apply_hasLogin() {
		$user_id = intval($_SESSION['user_id']);
		//1.1用户基本数据
		//1.2用户其他字段的信息
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
								$newCertificationFieldsValue=Filter::doFilter($_POST['certification_type_fields_value'.$userCertificationTypeFields['id']], 'string');
								$newUserCertificationFieldsData['fields_value'] = 'user'.DS.$user_id.DS.'certification'.DS.$newCertificationFieldsValue;
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
		$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
		$propertyList = $propertyModel->getList($propertyParam);
		$UserPropertyFieldsDataModel = Model('user_property_fields_data');
		foreach ($propertyList as $key => $property) {
			//是否有此资产
			$isHaveProperty = Filter::doFilter($_POST['has_property'.$property['id']], 'integer');
			if ($isHaveProperty == 1) {
				$newUserProperty['user_id'] = $user_id;
				$newUserProperty['property_id'] = $property['id'];
				$newUserProperty['insert_time'] = getGMTime();
				if ($userPropertyModel->insert($newUserProperty)) {
					//获取要添加字段
					$propertyFieldsModel = Model('property_fields');
					$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
					$propertyFieldsList = $propertyFieldsModel->getList($propertyFieldsParam);
					foreach ($propertyFieldsList as $fields_key => $propertyFields) {
						$newUserPropertyFieldsData['user_id'] = $user_id;
						$newUserPropertyFieldsData['fields_id'] = $propertyFields['id'];
						if (Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string') != '') {
							//如果是上传文件类型
							if ($propertyFields['input_type'] == 'file-image') {
								//@todo 用此方式创建不存在的目录，并不是最优解
								$upload = new UploadFile();
								$upload->setPath('user'.DS.$user_id.DS.'property');
								$newUserPropertyFieldsValue=Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string');
								$newUserPropertyFieldsData['fields_value'] = 'user'.DS.$user_id.DS.'property'.DS.Filter::doFilter($_POST['property_fields_value'.$propertyFields['id']], 'string');
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
		//5.1添加贷款数据
		$newBorrow = array(
			'uid_master'   => '0',//用户主动申请，信贷经理用户ID设为0
			'uid_slave'    => $user_id,
			'usage_id'     => Filter::doFilter($_POST['usage_id'], 'integer'),
			'usage_info'   => Filter::doFilter($_POST['usage_info'], 'string'),
			'total'        => Filter::doFilter($_POST['total'], 'integer'),
			'year_limit'   => Filter::doFilter($_POST['year_limit'], 'integer'),
			'insert_time'  => getGMTime(),
			'apply_time'   => getGMTime(),
			'apply_status' => 0,
		);
		$borrowModel = Model('borrow');
		$newBorrowInsertResult = $borrowModel->insert($newBorrow);
		if ($newBorrowInsertResult) {
			$result=array(
				'title'=>'提示',
				'message'=>'贷款添加成功！请耐心等待系统审核',
				'jump'=>array(
					'left'=>array('text'=>'返回首页','href'=>BASE_URL),
				),
			);
			showSuccess($result);
		} else {
			showError('对不起，贷款信息输入有误，请重新输入。');
		}
	}

		/**
	 * @doc 发送手机验证码
	 * @author Carr
	 * @time 2015-07-20 14:07:27
	 */
	public function sendRegCaptchaSmsOp(){
		$user_mobile = Filter::doFilter($_POST['user_mobile'], 'mobile');
		if (!isset($user_mobile) || empty($user_mobile)) {
			$result['status'] = 2;
			$result['msg'] = '手机号为空';
			ajax_return($result);
		}
		$sms_log_model = Model('SmsLog');
		$last_send_sms = $sms_log_model->getLastSend($user_mobile);
		if ((getGMTime() - $last_send_sms['insert_time']) / (60) > 1) {
			//生成验证码相关数据
			$verify_data['verify_code'] = rand(111111, 999999);
			$verify_data['receiver'] = $user_mobile;
			$verify_data['type'] = VERIFY_MOBILE;
			$verify_data['insert_time'] = getGMTime();
			$verify_data['client_ip'] = get_client_ip();
			$verifyCodeModel = Model('verify_code');
			try {
				$verifyCodeModel->beginTransaction();
				$send_sms_content = '您的验证码是'.$verify_data['verify_code'].'，';
				$send_sms_content .= '此验证码三十分钟内有效，请勿将其转告或转发给他人。如果不是本人操作，请忽略此短信';
				$sms = new SmsSender();
				$result = $sms->sendSms($user_mobile, $send_sms_content);
				if (!$result['status']) {
					throw new Exception('发送验证码失败！');
				}
				//插入数据库中等待验证
				$verifyCodeModel->insert($verify_data);
				$verifyCodeModel->commit();
			} catch (Exception $e) {
				$verifyCodeModel->rollback();
				$result['status'] = 0;
				$result['msg'] = '发送失败';
				showError($e->getMessage());
			}
		} else {
			$result['status'] = 2;
			$result['msg'] = "发送太频繁，一分钟内只能发送一次，请稍后再试";
		}
		ajax_return($result);
	}

	/**
	 * @doc 发送信息
	 * @author Heanes
	 * @time 2015-06-25 10:30:15
	 */
	public function sendSmsOp(){
		$user_mobile = Filter::doFilter($_REQUEST['user_mobile'], 'string');
		$send_sms_content = Filter::doFilter($_REQUEST['send_sms_content'], 'string');
		try {
			$sms = new SmsSender();
			$result = $sms->sendSms($user_mobile, $send_sms_content);
			if (!$result['status']) {
				throw new Exception('发送验证码失败！');
			}
			//插入数据库中等待验证
		} catch (Exception $e) {
			showError($e->getMessage());
		}
	}

	/**
	 * @doc 验证用户填写的验证码是否正确
	 * @param int $time_limit 超时限制，分为单位
	 * @return bool|int 不同的验证状态
	 * @author Heanes
	 * @time 2015-06-18 17:07:22
	 */
	public function _checkVerifySendCode($time_limit = 30){
		$user_mobile = Filter::doFilter($_POST['user_mobile'], 'mobile');
		$mobile_verify_code = Filter::doFilter($_POST['mobile_verify_code'], 'string');
		$reg_verify_type = Filter::doFilter($_POST['reg_verify_type'], 'string');
		$status = 0;
		$verify_code_model = Model('VerifyCode');
		$sentVerifyCode = $verify_code_model->getLastVerifyCode($user_mobile, $reg_verify_type, $time_limit);
		if (!count($sentVerifyCode) > 0) {
			$status = 0;//还未发送验证码
		} else if ($mobile_verify_code == $sentVerifyCode[0]['verify_code'] && (getGMTime() - $sentVerifyCode[0]['insert_time']) / (60) < $time_limit) {
			$status = 1;//正确验证
		} else {
			foreach ($sentVerifyCode as $key => $value) {
				if ($mobile_verify_code == $value['verify_code']) {
					$status = -2;//填写正确但不是最新的
					break;
				}
				if ($mobile_verify_code != $value['verify_code']) {
					$status = -1;//验证码填写错误
					break;
				}
			}
		}
		return $status;
	}
}