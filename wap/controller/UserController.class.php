<?php
/**
 * @doc 用户管理控制器
 * @filesource UserController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-20 11:40:55
 */
defined('InHeanes') or exit('Access Invalid!');

class UserController extends BaseWapController{
	function __construct(){
		parent::__construct();
		$this->needLogin();
	}

	/**
	 * @doc 默认控制器
	 * @author Heanes
	 * @time 2015-08-20 13:54:41
	 */
	public function indexOp(){
		$this->detailOp();
	}

	/**
	 * @doc 显示用户资料页面
	 * @author Heanes
	 * @time 2015-08-20 14:18:17
	 */
	public function showOp(){
		$this->needLogin();
		Tpl::assign('html_title','个人资料');
		Tpl::display('user/detail');
	}

	/**
	 * @doc 显示用户基本信息
	 * @author Heanes
	 * @time 2015-07-11 17:12:28
	 */
	public function detailOp(){
		$this->needLogin();
		$userModel = Model('users');
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		$user = $userModel->getOneByID($user_id);
		if($user['avatar_src']){
			$user['avatar_src']=PATH_BASE_FILE_UPLOAD.'user'.DS.$user_id.DS.'avatar'.DS.$user['avatar_src'];
		}
		Tpl::assign('user', $user);
		//检测用户名片权限
		$allowableMenuList = $this->getAllowableMenuOp();
		foreach ($allowableMenuList as $key => $allowableMenu) {
			if ($allowableMenu['_url']['class'] == 'seller') {
				$defaultMenuArray[0] = array(
					'act'  => 'seller',
					'op'   => '',
					'href' => BASE_URL.'index.php?act=seller&id='.$_SESSION['user_id'],
					'text' => '我的名片',
					'icon' => 'image/menu-icon/money.png',
				);
				Tpl::assign('defaultMenuArray', $defaultMenuArray);
			}
		}
		Tpl::assign('html_title', '我的资料');
		Tpl::display('user/detail');
	}
	/**
	 * @doc 用户信息修改
	 * @author Heanes
	 * @time 2015-08-20 13:51:52
	 */
	public function editOp(){
		$this->needLogin();
		//单个字段修改
		if(isset($_GET['field']) && !empty($_GET['field'])){
			if(isSubmit('user_edit_form_submit')){
				$this->updateField();
			}else{
				$field = Filter::doFilter($_GET['field'], 'string');
				$legalFields = array(
					'userName'  => '用户名',
					'avatar'  => '头像',
					'realName'  => '姓名',
					'gender'    => '性别',
					'location'   => '地址',
					'signature' => '个性签名',
					'password'  => '密码',
				);
				//检测是否是合法的字段
				if(array_key_exists($field,$legalFields)){
					Tpl::assign('legalFields',$legalFields);
					$userModel = Model('users');
					$id = $_SESSION['user_id'];
					$user = $userModel->getOneByID($id);
					Tpl::assign('user', $user);
					Tpl::assign('_field', $field);
					Tpl::assign('html_title', '修改个人资料');
					Tpl::display('user/editField');
				}else{
					showError('参数错误！');
				}
			}
		}else{
			if(isSubmit('user_edit_form_submit')){
				$this->update();
			}else{
				//整体修改
				$userModel = Model('users');
				$user = $userModel->getOneByID($_SESSION['user_id']);
				Tpl::assign('user', $user);
				Tpl::assign('html_title', '修改个人资料');
				Tpl::display('user/edit');
			}
		}
	}

	/**
	 * @doc 更新用户资料
	 * @author Heanes
	 * @time 2015-08-20 14:50:10
	 */
	protected function update(){
		$userModel=Model('users');
		$newUser['user_name']=Filter::doFilter($_POST['user_name'],'string');
		$newUser['real_name']=Filter::doFilter($_POST['real_name'],'string');
		$newUser['gender']=Filter::doFilter($_POST['gender'],'integer');
		$newUser['province']=Filter::doFilter($_POST['province'],'string');
		$newUser['city']=Filter::doFilter($_POST['city'],'string');
		$newUser['region']=Filter::doFilter($_POST['region'],'string');
		$newUser['address']=Filter::doFilter($_POST['address'],'string');
		$newUser['signature']=Filter::doFilter($_POST['signature'],'string');
		$userWhere="`id`='".$_SESSION['user_id']."'";
		if($userModel->update($newUser,$userWhere)){
			showSuccess('修改成功！');
		}else{
			showError('抱歉，修改失败！');
		}
	}

	/**
	 * @doc 更新用户某个字段资料
	 * @author Heanes
	 * @time 2015-08-20 14:52:29
	 */
	protected function updateField(){
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		$userModel=Model('users');
		$user=$userModel->getOneByID($user_id);
		if($user){
			$newUser=array();
			$field = Filter::doFilter($_GET['field'], 'string');
			//用户名修改策略，设计为允许修改次数
			if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
				$newUser['user_name'] = Filter::doFilter($_POST['user_name'], 'string');
			}
			//手机号修改，不允许重复
			if (isset($_POST['mobile']) && !empty($_POST['mobile'])) {
				$newUser['mobile'] = Filter::doFilter($_POST['mobile'], 'string');
			}
			//真实姓名
			if (isset($_POST['real_name']) && !empty($_POST['real_name'])) {
				$newUser['real_name']=Filter::doFilter($_POST['real_name'], 'string');
			}
			//性别
			if (isset($_POST['gender']) && $_POST['gender']!='') {
				$newUser['gender'] = Filter::doFilter($_POST['gender'], 'integer');
			}
			//地址信息
			if (isset($_POST['province']) && !empty($_POST['province'])) {
				$newUser['province'] = Filter::doFilter($_POST['province'], 'string');
			}
			if (isset($_POST['city']) && !empty($_POST['city'])) {
				$newUser['city'] = Filter::doFilter($_POST['city'], 'string');
			}
			if (isset($_POST['region']) && !empty($_POST['region'])) {
				$newUser['region'] = Filter::doFilter($_POST['region'], 'string');
			}
			if (isset($_POST['address']) && !empty($_POST['address'])) {
				$newUser['address'] = Filter::doFilter($_POST['address'], 'string');
			}
			//个性签名
			if (isset($_POST['signature']) && !empty($_POST['signature'])) {
				$newUser['signature'] = Filter::doFilter($_POST['signature'], 'string');
			}
			//密码
			if(isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password']) && isset($_POST['new_password_repeat']) && !empty($_POST['new_password_repeat']) && $_POST['new_password']==$_POST['new_password_repeat']) {
				if($user['user_pwd'] == compile_password(Filter::doFilter($_POST['old_password'], 'string'))){
					if($_POST['old_password']==$_POST['new_password']){
						showError('新密码不能和原始密码相同！');
					}else{
						$newUser['user_pwd'] = compile_password(Filter::doFilter($_POST['new_password'], 'string'));
					}
				}else{
					showError('原始密码不对！');
				}
			}
			//修改操作
			if(count($newUser)){
				$userWhere = "`id`='$user_id'";
				if ($userModel->update($newUser, $userWhere)) {
					//如果是修改密码，则给出友好提示信息
					if($field=='password'){
						$result=array(
							'title'=>'提示',
							'message'=>'密码已修改成功，请牢记修改后的密码！',
							'jump'=>array(
								'left'=>array('text'=>'确定','href'=>BASE_URL.'index.php?act=user&op=detail'),
							),
						);
						showSuccess($result);
					}else{
						@header("Location:".BASE_URL."index.php?act=user&op=detail");
					}
				} else {
					showError('对不起！修改失败，请重试');
				}
			}
		}else{
			showError('此用户不存在！');
		}
	}

	/**
	 * @doc 头像文件上传处理
	 * @author Heanes
	 * @time 2015-08-22 23:37:01
	 */
	public function uploadAvatarOp() {
		$this->needLogin();
		$user_id=$_SESSION['user_id'];
		$userModel=Model('users');
		if(count($userModel->getOneByID($user_id))){
			$save_path = 'user'.DS.$user_id.DS.'avatar';
			$field_name = $_POST['field_name'];
			$upload = new UploadFile();
			$upload->setPath($save_path);
			$upload->set('max_size', 10240);
			if ($_FILES[$field_name]['size'] <= 1024 * 1024 * 10) {
				$FileUploadResult = $upload->upload($field_name);
				if ($FileUploadResult) {
					$UploadResult = $upload->getUploadResult();
					$size = round($_FILES[$field_name]['size'] / 1024, 2);
					//上传成功后将数据更新到用户表中
					$userWhere="`id`='$user_id'";
					$updateUser['avatar_src']=$UploadResult['save_name'];
					if($userModel->update($updateUser,$userWhere)){
						ajax_return(array('status'    => 1,
										  'save_path' => $UploadResult['save_path'],
										  'save_name' => $UploadResult['save_name'],
										  'msg'       => '上传成功',
										  'name'      => $_FILES[$field_name]['name'],
										  'pic'       => $UploadResult['save_name'],
										  'size'      => $size)
						);
					}else{
						ajax_return(array('status' => 0, 'msg' => '数据更新错误'));
					}
				} else {
					ajax_return(array('status' => 0, 'msg' => $upload->getError()));
				}
			}
		}else{
			ajax_return(array('status'=>'-1','msg'=>'此用户不存在！'));
		}
	}


	/**
	 * @doc 找回密码页面
	 * @author Heanes
	 * @time 2015-08-20 14:06:48
	 */
	public function findPasswordOp(){
		Tpl::assign('html_title','找回密码');
		Tpl::display();
	}

	/**
	 * @doc 添加新用户操作
	 * @author Heanes
	 * @time 2015-07-14 17:17:13
	 */
	public function addOp(){
		if (isSubmit('user_add_form_submit')) {
			if ($result = $this->_insert()) {
				showSuccess('添加成功');
			}
		} else {
			//1.添加银行卡
			$bankModel = Model('bank');
			$bankList = $bankModel->getList();
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
			foreach ($propertyList as $key => $property) {
				//3.2查询添加资产需要填写的字段
				$propertyFieldsModel = Model('property_fields');
				$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
				$propertyFieldsParam['order'] = array('order_number' => 'ASC');
				$propertyList[$key]['propertyFields'] = $propertyFieldsModel->getList($propertyFieldsParam);
			}
			Tpl::assign('propertyList', $propertyList);

			Tpl::assign('bankList', $bankList);
			Tpl::assign('html_title', '添加新用户');
			Tpl::display('member/add');
		}
	}

	/**
	 * @doc 外部控制器添加数据接口
	 * @author Heanes
	 * @time 2015-07-14 17:22:40
	 */
	public function _insert(){
		//检查权限
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
		//2.资产信息
		//2.1、先将用户数据插入到数据库中，并得到新用户的ID
		$userModel = Model('users');
		if ($newUserId = $userModel->insert($newUser)) {
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
					} else {
						showError('文件上传出现错误');
					}
				}
				$userBankModel = Model('user_bank');
				$userBankInsertResult = $userBankModel->insert($newUserBank);
				if (!$userBankInsertResult) {
					showError('银行卡插入失败');
				}
				//2.3添加用户资产信息
				$propertyModel = Model('property');
				$propertyParam['where'] = "`add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
				$propertyList = $propertyModel->getList($propertyParam);
				$userPropertyFieldsDataModel = Model('user_property_fields_data');
				foreach ($propertyList as $key => $property) {
					//是否有此资产
					$isHaveProperty = Filter::doFilter($_POST['has_property'.$property['id']], 'integer');
					if ($isHaveProperty == 1) {
						//获取要添加字段
						$propertyFieldsModel = Model('property_fields');
						$propertyFieldsParam['where'] = "`property_id`='".$property['id']."' AND `add_show`='1' AND `is_enable`='1' AND `is_deleted`='0'";
						$propertyFieldsList = $propertyFieldsModel->getList($propertyFieldsParam);
						foreach ($propertyFieldsList as $fields_key => $propertyFields) {
							$newUserPropertyFieldsData['user_id'] = $newUserId;
							$newUserPropertyFieldsData['fields_id'] = $propertyFields['id'];
							//如果是上传文件类型
							if ($propertyFields['input_type'] == 'file-image') {
								//上传文件操作
								$upload = new UploadFile();
								//1.1先上传银行卡正面照片
								$upload->setPath('user'.DS.$newUserId.DS.'property');
								$upload->set('max_size', 10240);
								if ($_FILES['fields_value'.$propertyFields['id']]['size'] <= 1024 * 1024 * 10) {
									$FieldsUploadResult = $upload->upload('fields_value'.$propertyFields['id']);
									if ($FieldsUploadResult) {
										//插入用户银行卡数据
										$propertyFieldsUploadResult = $upload->getUploadResult();
										$newUserPropertyFieldsData['fields_value'] = $propertyFieldsUploadResult['save_path'].$propertyFieldsUploadResult['save_name'];
									} else {
										showError('文件上传出现错误');
									}
								}
							} else {
								$newUserPropertyFieldsData['fields_value'] = Filter::doFilter($_POST['fields_value'.$propertyFields['id']], 'string');
							}
							$newUserPropertyFieldsData['insert_time'] = getGMTime();
							if (!$userPropertyFieldsDataModel->insert($newUserPropertyFieldsData)) {
								showError('抱歉，用户资产数据插入失败！');
							}
						}
					}
				}
			}
			return $newUserId;
			//showSuccess('新用户添加成功！');
		} else {
			return false;
		}
	}

	/**
	 * @doc 插入新用户
	 * @author Heanes
	 * @time 2015-07-14 17:17:40
	 */
	public function insertOp(){
		//1、接收和过滤数据
		//用户基本数据
		$newUser['user_name'] = generateRandomString(12);
		$new_user_pwd = generateRandomString(8);
		$newUser['user_pwd'] = md5($new_user_pwd);
		$newUser['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
		$newUser['mobile'] = Filter::doFilter($_POST['user_mobile'], 'string');
		$newUser['idcard'] = Filter::doFilter($_POST['idcard'], 'string');
		$newUser['province'] = Filter::doFilter($_POST['province'], 'string');
		$newUser['city'] = Filter::doFilter($_POST['city'], 'string');
		$newUser['region'] = Filter::doFilter($_POST['region'], 'string');
		$newUser['address'] = Filter::doFilter($_POST['address'], 'string');
		$newUser['has_house'] = Filter::doFilter($_POST['has_house'], 'string');
		$newUser['has_car'] = Filter::doFilter($_POST['has_car'], 'string');
		$newUser['has_company'] = Filter::doFilter($_POST['has_company'], 'string');
		//银行卡信息
		$newUserBank['real_name'] = Filter::doFilter($_POST['bank_real_name'], 'string');
		$newUserBank['bank_no'] = Filter::doFilter($_POST['bank_no'], 'string');
		$newUserBank['bank_id'] = Filter::doFilter($_POST['bank_id'], 'string');
		//资产信息
		//2.1、先将用户数据插入到数据库中，并得到新用户的ID
		$userModel = Model('users');
		if ($newUserId = $userModel->insert($newUser)) {
			//2.2添加用户银行卡
			$userBankModel = Model('user_bank');
			$newUserBank['user_id'] = $newUserId;
			if ($newUserBank['bank_no'] != '') {
				$userBankModel->insert($newUserBank);
			}
			//2.3发送短信
			if ($newUserId) {
				try {
					$send_sms_content = '尊敬的用户您好，您已成为本网站会员，用户名是'.$newUser['real_name'].'，密码是'.$new_user_pwd.'，您也可以使用手机号作为用户名登录，请妥善保管您的密码(本条信息发送时间是'.date('Y-m-d H:i:s', time()).' )';
					$sms = new SmsSender();
					$result = $sms->sendSms($newUser['mobile'], $send_sms_content);
					if (!$result['status']) {
						throw new Exception('发送用户信息短信失败！');
					} else {
						showSuccess('添加用户成功！');
					}
					//插入数据库中等待验证
				} catch (Exception $e) {
					showError($e->getMessage());
				}
			} else {
				showError('抱歉！添加用户失败');
			}
		}
	}
}