<?php
/**
 * @doc 用户相关控制器
 * @filesource MemberController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-25 12:02:34
 */
defined('InHeanes') or exit('Access Invalid!');

class MemberController extends BaseWapController{

	function __construct(){
		parent::__construct();
	}
	
	/**
	 * @doc 默认登录
	 * @author Heanes
	 * @time 2015-05-26 17:52:23
	 */
	public function indexOp(){
		if ($this->checkLogin()) {
			$this->userCenterDefaultOp();
		} else {
			$this->loginOp();
		}
	}

	/**
	 * @doc 用户中心起始页
	 * @author Heanes
	 * @time 2015-06-10 11:34:51
	 */
	public function userCenterDefaultOp(){
		$this->needLogin();
		if ($this->checkLogin()) {
			$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
			$userModel = Model('users');
			$user = $userModel->getOneByID($user_id);
			if($user['avatar_src']){
				$user['avatar_src']=PATH_BASE_FILE_UPLOAD.'user'.DS.$user_id.DS.'avatar'.DS.$user['avatar_src'];
			}
			//用户角色信息
			$userRoleModel = Model('user_role');
			$user['_role'] = $userRoleModel->getOneByID($user['role_id']);
			//用户积分信息
			$userRankModel = Model('user_rank');
			$userRankParam['where'] = "`user_id`='".$user['id']."'";
			$user['_rank'] = $userRankModel->getOne($userRankParam);
			Tpl::assign('user', $user);
			$allowableMenuList = $this->getAllowableMenuOp();
			$defaultMenuArray = array();
			foreach ($allowableMenuList as $key => $allowableMenu) {
				#功能链接
				if ($allowableMenu['_url']['class'] == 'borrow' && $allowableMenu['_url']['method'] == 'apply') {
					$defaultMenuArray[0][0] = array(
						'act'  => 'product',
						'op'   => '',
						'text' => '申请贷款',
						'icon' => 'image/menu-icon/style2/loan-apply.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'borrow' && $allowableMenu['_url']['method'] == 'mine') {
					$defaultMenuArray[0][1] = array(
						'act'  => 'borrow',
						'op'   => 'mine',
						'text' => '我的贷款',
						'icon' => 'image/menu-icon/style2/edit.png',
					);
				}
				//操作菜单
				if ($allowableMenu['_url']['class'] == 'menu' && $allowableMenu['_url']['method'] == 'borrow') {
					$defaultMenuArray[1][0] = array(
						'act'  => 'menu',
						'op'   => 'borrow',
						'text' => '贷款管理',
						'icon' => 'image/menu-icon/style2/loan-manage.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'menu' && $allowableMenu['_url']['method'] == 'customer') {
					$defaultMenuArray[1][1] = array(
						'act'  => 'menu',
						'op'   => 'customer',
						'text' => '客户管理',
						'icon' => 'image/menu-icon/style2/customer.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'menu' && $allowableMenu['_url']['method'] == 'employee') {
					$defaultMenuArray[1][2] = array(
						'act'  => 'menu',
						'op'   => 'employee',
						'text' => '金鹰管理',
						'icon' => 'image/menu-icon/style2/employee.png',
					);
				}
				#功能链接
				if ($allowableMenu['_url']['class'] == 'employee' && $allowableMenu['_url']['method'] == 'apply') {
					$defaultMenuArray[2][0] = array(
						'act'  => 'employee',
						'op'   => 'introduce',
						'text' => '申请金鹰',
						'icon' => 'image/menu-icon/style2/employee-apply.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'menu' && $allowableMenu['_url']['method'] == 'performance') {
					$defaultMenuArray[2][2] = array(
						'act'  => 'menu',
						'op'   => 'performance',
						'text' => '我的业绩',
						'icon' => 'image/menu-icon/style2/count.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'employee' && $allowableMenu['_url']['method'] == 'myLeader') {
					$defaultMenuArray[2][3] = array(
						'act'  => 'employee',
						'op'   => 'myLeader',
						'text' => '我的上级',
						'icon' => 'image/menu-icon/style2/leader.png',
					);
				}
				if ($allowableMenu['_url']['class'] == 'employee' && $allowableMenu['_url']['method'] == 'invite') {
					$defaultMenuArray[2][4] = array(
						'act'  => 'employee',
						'op'   => 'invite',
						'text' => '金鹰推广',
						'icon' => 'image/menu-icon/style2/announce.png',
					);
				}
			}
			$defaultMenuArray[4][0] = array(
				'act'  => 'wareShop',
				'op'   => '',
				'text' => '金宝街',
				'icon' => 'image/menu-icon/style2/gift.png',
			);
			$defaultMenuArray[4][1] = array(
				'act'  => 'menu',
				'op'   => 'tools',
				'text' => '工具',
				'icon' => 'image/menu-icon/style2/tools.png',
				'is_new_function'=>true,
			);
			Tpl::assign('defaultMenuArray', $defaultMenuArray);
			Tpl::assign('html_title', '用户中心');
			Tpl::display('member/userCenterDefault');
		} else {
			$this->loginOp();
		}
	}

	/**
	 * @doc 登录（展示）
	 * @author Heanes
	 * @time 2015-05-25 12:06:20
	 */
	public function loginOp(){
		$_SESSION['redirect']=$_SERVER['HTTP_REFERER'];
		//$url=CURRENT_URL.'&redirect='.$_SERVER['HTTP_REFERER'];
		//@header('Location:'.$url);
		if (isSubmit('login_form_submit')) {
			//数据为空验证
			if (empty($_POST['user_name']) || empty($_POST['user_pwd'])) {//|| empty($_POST['captcha'])) {
				showError('请填写完整的登录信息');
			}
			$this->_doLogin();//登录操作
			//检测验证码
			/*
			$captcha_code = Filter::doFilter($_POST['captcha'], 'string');
			if (!checkCaptcha('4a0bd59d', $captcha_code)) {
				showError('图形验证码填写错误');
			} else {
				$this->_doLogin();//登录操作
			}
			*/
		} else {
			if ($this->checkLogin()) {
				$this->userCenterDefaultOp();
			} elseif (isset($_GET['style']) && $_GET['style'] == 'mini') {
				Tpl::display('member/loginMini');
			} else {
				Tpl::assign('html_title', '登录');
				Tpl::display('member/login');
			}
		}
	}

	/**
	 * @doc 登录操作相关数据更新
	 * @author Heanes
	 * @time 2015-06-10 16:04:03
	 */
	protected function _doLogin(){
		$user_name = Filter::doFilter($_POST['user_name'], 'string');
		$user_pwd = Filter::doFilter($_POST['user_pwd'], 'string');
		$user_pwd = md5($user_pwd);
		$param['where'] = "(`user_name`='$user_name' or `mobile` ='$user_name' or `user_email`='$user_name') and `user_pwd`='$user_pwd'";
		$user_model = Model('user');
		$login_check = $user_model->checkLogin($param);
		if ($login_check) {
			$logged_user = array(
				'user_id'   => $login_check['id'],
				'user_name' => $user_name,
			);
			if ($this->_loginIn($logged_user)) {
				$result = array(
					'title'   => '提示',
					'message' => '登录成功',
					'jump'    => array(
						'left'  => array('text' => '上一页', 'href' => getReferer()),
						'right' => array('text' => '个人中心', 'href' => BASE_URL.'index.php?act=member')
					)
				);
				showSuccess($result);
			} else {
				showError('登录失败！');
			}
		} else {
			showError('密码错误！');
		}
	}

	/**
	 * @doc 登录系统相关操作
	 * @param array $logged_user 登录用户相关信息，user_id-用户ID,user_name-用户名
	 * @return bool 登录成功|失败
	 * @author Heanes
	 * @time 2015-06-24 16:22:34
	 */
	protected function _loginIn($logged_user){
		try {
			$_SESSION['is_login'] = 1;
			$_SESSION['user_name'] = $logged_user['user_name'];
			$_SESSION['user_id'] = $logged_user['user_id'];
			//登录后用户相关数据更新
			$userModel = Model('user');
			$updateUserArray = array(
				'current_login_ip' => get_client_ip(),
				'login_times'      => array(
					'sign'  => 'increase',
					'value' => 1,
				),
			);
			$updateUserWhere = "`id`='".$logged_user['user_id']."'";
			$userModel->updateUser($updateUserArray, $updateUserWhere);
			return true;
		} catch (Exception $e) {
			showError($e->getMessage());
			return false;
		}
	}

	/**
	 * @doc 注销操作
	 * @author Heanes
	 * @time 2015-06-10 15:29:25
	 */
	public function loginOutOp(){
		$logged_user = array(
			'user_id'   => $_SESSION['user_id'],
			'user_name' => $_SESSION['user_name'],
		);
		if ($this->_doLoginOut($logged_user)) {
			//显示申请详情页面
			$result = array(
				'title'   => '提示',
				'message' => '已退出！',
				'jump'    => array(
					'left' => array('text' => '返回'),
				),
			);
			showSuccess($result);
		}
	}

	/**
	 * @doc 注销操作相关数据更新
	 * @param array $logged_user 已登录用户的用户信息
	 * @return bool 注销成功|失败
	 * @author Heanes
	 * @time 2015-06-10 16:04:50
	 */
	public function _doLoginOut($logged_user){
		if ($this->checkLogin()) {
			try {
				unset($_SESSION['is_login']);
				unset($_SESSION['user_id']);
				unset($_SESSION['user_name']);

				//退出登录后用户相关数据更新
				$userModel = Model('user');
				$updateUserArray = array(
					'last_login_ip' => get_client_ip(),
				);
				$updateUserWhere = "`id`='".$logged_user['user_id']."'";
				$userModel->updateUser($updateUserArray, $updateUserWhere);
				return true;
			} catch (Exception $e) {
				showError($e->getMessage());
				return false;
			}
		} else {
			showError('你还未登录！');
			return true;
		}
	}

	/**
	 * @doc 注册
	 * @author Heanes
	 * @time 2015-05-25 12:06:20
	 */
	public function regOp(){
		if (isSubmit('reg_form_submit')) {
			//数据为空验证
			if (empty($_POST['user_mobile']) || empty($_POST['user_pwd'])) {//} || empty($_POST['captcha'])) {
				showError('请填写完整的注册信息');
				return false;
			}
			//重复输入密码验证
			$user_pwd = Filter::doFilter($_POST['user_pwd'], 'string');
			$user_pwd_repeat = Filter::doFilter($_POST['user_pwd_repeat'], 'string');
			if ($user_pwd != $user_pwd_repeat) {
				showError('两次密码输入不一致！');
				return false;
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
				$this->_doReg();
			} else {
				showError('非常抱歉，未知错误,暂时无法注册');
			}

		} else {
			if (isset($_GET['style']) && $_GET['style'] == 'mini') {
				Tpl::display('member/regMini');
			} else {
				Tpl::assign('html_title', '注册');
				Tpl::display('member/reg');
			}
		}

		return false;
	}

	/**
	 * @doc 注册是用户填写资料ajax验证数据库中是否已经存在 @todo 不紧急，以后再做
	 * @author Heanes
	 * @time 2015-06-25 09:55:30
	 */
	public function checkFiledOp(){
		$value = Filter::doFilter($_POST['user_name'], 'string');
		$userModel = Model('users');
		$userParam['where'] = "`user_name`='$value' OR `mobile`='$value'";
		$user = $userModel->getOne($userParam);
		if (count($user)) {
			$data = array(
				'status' => '-1',
				'msg'    => '此用户已经存在',
			);
		} else {
			$data = array(
				'status' => '1',
				'msg'    => '可以注册',
			);
		}
		ajax_return($data);

		//结合ValidForm前端插件来验证
		$value = Filter::doFilter($_POST['param'], 'string');
		$userModel = Model('users');
		$userParam['where'] = "`user_name`='$value' OR `mobile`='$value'";
		$user = $userModel->getOne($userParam);
		if (count($user)) {
			$data = array(
				'status' => 'n',
				'info'   => '此用户已经存在',
			);
		} else {
			$data = array(
				'status' => 'y',
				'info'   => '可以注册',
			);
		}
		ajax_return($data);
	}

	/**
	 * @doc 注册用户（操作）
	 * @return bool 插入新用户成功|失败
	 * @author Heanes
	 * @time 2015-06-10 15:49:27
	 */
	protected function _doReg(){
		$user_mobile = Filter::doFilter($_POST['user_mobile'], 'mobile');
		$user_pwd = Filter::doFilter($_POST['user_pwd'], 'string');
		$user_pwd = md5($user_pwd);
		$new_user = array(
			'user_name' => $user_mobile,
			'mobile'    => $user_mobile,
			'user_pwd'  => $user_pwd,
			'role_id'   => '1',//此处改成后台设置项
			'reg_ip'    => get_client_ip(),
			'reg_time'  => getGMTime(),
		);
		$user_model = Model('user');
		$userModel = Model('users');
		$checkUserExistsParam = array(
			'where' => "`user_name`='$user_mobile' OR `mobile`='$user_mobile'",
		);
		if (count($user_model->getUser($checkUserExistsParam)) > 0) {
			showError('非常抱歉，'.$user_mobile.'用户已存在，注册失败！');
			return false;
		}
		//插入数据
		if ($newUserID = $userModel->insert($new_user)) {
			//添加积分操作
			$userRankModel = Model('user_rank');
			$newUserRank = array(
				'user_id'     => $newUserID,
				'type_id'     => 1,
				'value'       => 10,
				'insert_time' => getGMTime(),
			);
			$flag = $userRankModel->insert($newUserRank);
			$logged_user = array(
				'user_id'   => $newUserID,
				'user_name' => $user_mobile,
			);
			$this->_loginIn($logged_user);
			$result = array(
				'title'   => '提示',
				'message' => '注册成功！',
				'jump'    => array(
					//'left' => array('text' =>'上一页' , 'href' => 'javascript:history.go(-2)'),
					'right' => array('text' => '个人中心', 'href' => BASE_URL.'index.php?act=member')
				)
			);
			showSuccess($result);
			return true;
		} else {
			showError('非常抱歉，注册失败！');
			return false;
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
		//return $verify_code_model->checkVerifyCode($user_mobile, $mobile_verify_code, $reg_verify_type);
	}

	/**
	 * @doc 用户二维码
	 * @author Heanes
	 * @time 2015-07-23 16:46:54
	 */
	public function qrCode1Op(){
		$user_id = isset($_GET['id']) ? Filter::doFilter($_GET['id'], 'integer') : Filter::doFilter($_SESSION['user_id'], 'integer');
		$targetUrl = WEB_HOST.'/wap/index.php?act=seller&id='.$user_id;
		Tpl::assign('targetUrl', $targetUrl);
		Tpl::assign('html_title', '我的二维码');
		Tpl::display('member/qrCode');
	}

	/**
	 * @doc 用户二维码生成
	 * @author Carr
	 * @time 2015-07-23 17:00:31
	 */
	public function qrCodeOp(){
		//1.引入核心库文件
		include PATH_ABS_BASE_DATA."resource/phpqrcode/phpqrcode.php";
		//1.1容错级别
		$errorCorrectionLevel = 'L';
		//1.2生成图片大小
		$matrixPointSize = 9;
		//2.准备存储文件夹
		$user_id = isset($_GET['id']) ? Filter::doFilter($_GET['id'], 'integer') : Filter::doFilter($_SESSION['user_id'], 'integer');
		echo '11';
		$upload = new UploadFile();
		echo '22';
		$upload->setPath('user'.DS.$user_id.DS.'QRCode');
		//二维码内容，目标链接
		$targetUrl = WEB_HOST.'/wap/index.php?act=seller&id='.$user_id;
		//存储路径
		$targetImg = PATH_ABS_SYS_FILE_UPLOAD.'user'.DS.$user_id.DS.'QRCode'.DS.$user_id.'.png';
		//3.生成二维码图片
		echo $targetImg;
		QRcode::png($targetUrl, $targetImg, $errorCorrectionLevel, $matrixPointSize, 2);
		//$logo = PATH_ABS_SYS_FILE_UPLOAD.'image'.DS.'QRCode'.DS.'logo.jpg';//准备好的logo图片
		//获取用户上传的头像
		$userModel = Model('users');
		$user = $userModel->getOneByID($user_id);
		if (empty($user['avatar_src'])) {
			$logo = PATH_ABS_SYS_FILE_UPLOAD.'wap'.DS.'image'.DS.'logo'.DS.'logo-for-QRCode.png';//准备好的logo图片
		} else {
			$logo = PATH_ABS_SYS_FILE_UPLOAD.'user'.DS.$user_id.DS.'avatar'.DS.$user['avatar_src'];//准备好的logo图片
		}
		$QR = $targetImg;//已经生成的原始二维码图
		ob_clean();

		if (is_file($QR) && is_file($logo)) {
			$QR = imagecreatefromstring(file_get_contents($QR));
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);//二维码图片宽度
			$QR_height = imagesy($QR);//二维码图片高度
			$logo_width = imagesx($logo);//logo图片宽度
			$logo_height = imagesy($logo);//logo图片高度
			$logo_qr_width = $QR_width / 5;
			$scale = $logo_width / $logo_qr_width;
			$logo_qr_height = $logo_height / $scale;
			$logo_qr_height = $logo_qr_width;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			//重新组合图片并调整大小
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
			//输出图片
			imagepng($QR, $targetImg);
		}
		$QRCode_src = PATH_BASE_FILE_UPLOAD.'user'.DS.$user_id.DS.'QRCode'.DS.$user_id.'.png';
		Tpl::assign('QRCode_src', $QRCode_src);
		Tpl::assign('html_title', '中国领先的移动互联网金融超市震撼上线，引领贷款行业新潮流，8大亮点邀你来赚。');
		Tpl::display('member/QRCode_php');
	}

}
