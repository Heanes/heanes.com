<?php
/**
 * @doc 后台管理员控制器
 * @filesource AdminUserController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-30 15:54:13
 */
defined('InHeanes') or exit('Access Invalid!');

class AdminUserController extends BaseAdminController{
	function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		if (!$this->checkLogin()) {
			$this->loginOp();
		}else{
			redirect_php_header('index.php');
			showSuccess('您已经登录');
		}
	}

	/**
	 * @doc 登录（展示）
	 * @author Heanes
	 * @time 2015-05-25 12:06:20
	 */
	public function loginOp(){
		if (isSubmit('login_form_submit')) {
			//数据为空验证
			if(empty($_POST['admin_user_name']) || empty($_POST['admin_user_pwd']) || empty($_POST['captcha'])){
				showError('请填写完整的登录信息');
			}
			//检测验证码
			$captcha_code=Filter::doFilter($_POST['captcha'],'string');
			if(!checkCaptcha('4a0bd59d',$captcha_code)){
				showError('图形验证码填写错误');
			}else{
				$this->_doLogin();//登录操作
			}
		} else {
			if ($this->checkLogin()) {
				$this->indexOp();
			} else {
				Tpl::display('login','adminFrameNullLayout');
			}
		}
	}


	/**
	 * @doc 登录操作相关数据更新
	 * @author Heanes
	 * @time 2015-06-10 16:04:03
	 */
	protected function _doLogin(){
		$user_name = Filter::doFilter($_POST['admin_user_name'], 'string');
		$user_pwd = Filter::doFilter($_POST['admin_user_pwd'], 'string');
		$user_pwd = md5($user_pwd);
		$param['where'] = "(`user_name`='$user_name' or `mobile` ='$user_name' or `user_email`='$user_name') and `user_pwd`='$user_pwd'";
		$adminUserModel = Model('AdminUser');
		$login_check = $adminUserModel->checkLogin($param);
		if ($login_check) {
			$logged_user=array(
				'admin_user_id'=>$login_check['id'],
				'admin_user_name'=>$user_name,
			);
			if($this->_loginIn($logged_user)){
				showSuccess('登录成功！');
			}else{
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
		try{
			$_SESSION['admin_is_login'] = 1;
			$_SESSION['admin_user_name'] = $logged_user['admin_user_name'];
			$_SESSION['admin_user_id'] = $logged_user['admin_user_id'];
			//登录后用户相关数据更新
			$adminUserModel = Model('admin_user');
			$updateUserArray=array(
				'current_login_ip'=>get_client_ip(),
				'current_login_time'=>getGMTime(),
				'login_times'=>array(
					'sign'=>'increase',
					'value'=>1,
				),
			);
			$updateUserWhere="`id`='".$logged_user['admin_user_id']."'";
			$adminUserModel->update($updateUserArray,$updateUserWhere);
			return true;
		}catch (Exception $e){
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
		$logged_user=array(
			'admin_user_id'=>$_SESSION['admin_user_id'],
			'admin_user_name'=>$_SESSION['admin_user_name'],
		);
		if($this->_doLoginOut($logged_user)){
			showSuccess('已退出！');
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
			try{
				unset($_SESSION['admin_is_login']);
				unset($_SESSION['admin_user_id']);
				unset($_SESSION['admin_user_name']);

				//退出登录后用户相关数据更新
				$adminUserModel = Model('admin_user');
				$updateUserArray=array(
					'last_login_ip'=>get_client_ip(),
					'last_login_time'=>'current_login_time',
				);
				$updateUserWhere="`id`='".$logged_user['admin_user_id']."'";
				$adminUserModel->update($updateUserArray,$updateUserWhere);
				return true;
			}catch (Exception $e){
				showError($e->getMessage());
				return false;
			}
		}else{
			showError('你还未登录！');
			return true;
		}
	}

}
