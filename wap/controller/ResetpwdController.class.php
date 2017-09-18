<?php
/**
 * @doc 密码重置,修改请控制器
 * @filesource ResetpwdController.class.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015-07-21 13:58:54
 */
defined('InHeanes') or exit('Access Invalid!');

class ResetpwdController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		Tpl::display('resetpwd/update');
	}

	/**
	 * @doc 短信验证码
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function smsOp(){
		$user_mobile = Filter::doFilter($_POST['user_mobile'], 'mobile');
		if (!isset($user_mobile) || empty($user_mobile)) {
			$result['status'] = 2;
			$result['msg'] = '手机号为空';
			ajax_return($result);
		}
		//验证此手机是否已经存在于用户表中

		$user_model = Model('users');
		$checkUserExistsParam = array(
			'where' => "`user_name`='$user_mobile' OR `mobile`='$user_mobile'",
		);
		if (count($user_model->getOne($checkUserExistsParam)) == 0) {
			$result['status'] = -2;
			$result['msg'] = '手机号输入错误，不是注册的手机号';
			ajax_return($result);
		}
		$sms_log_model = Model('SmsLog');
		$last_send_sms = $sms_log_model->getLastSend($user_mobile);
		if ((getGMTime() - $last_send_sms['create_time']) / (60) > 1) {
			//生成验证码相关数据
			$verify_data['verify_code'] = rand(111111, 999999);
			$verify_data['receiver'] = $user_mobile;
			$verify_data['type'] = VERIFY_MOBILE;
			$verify_data['create_time'] = getGMTime();
			$verify_data['client_ip'] = get_client_ip();
			$verifyCodeModel = Model('verify_code');
			try {
				$verifyCodeModel->beginTransaction();
				$send_sms_content = '您好，您在本网站进行（密码重置）操作的验证码是'.$verify_data['verify_code'].'，';
				$send_sms_content .= '此验证码三十分钟内有效，请勿将其转告或转发给他人。若非本人操作请及时联系我们。';
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
	 * @doc 判断手机号和验证码
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function update_pwdOP(){
		if ($_SERVER["HTTP_REFERER"] == BASE_URL.'index.php?act=resetpwd&op=edit') {
			Tpl::display('resetpwd/update_pwd');
		} else {

			//检测验证码
			$code = Filter::doFilter($_POST['mobile_verify_code'], 'string');
			$captcha_code = Filter::doFilter($_POST['captcha'], 'string');
			$mobile = Filter::doFilter($_POST['user_mobile'], 'string');
			/*
			if (!checkCaptcha('4a0bd59d', $captcha_code)) {
				showError('图形验证码填写错误');
				return false;
			}
			*/
			if ($code) {
				$verifyCodeModel = Model('verify_code');
				$param['where'] = "`receiver`='".$mobile."'";
				$code_count = $verifyCodeModel->getList($param);
				$sql = 'SELECT max(`id`) FROM `pre_verify_code` WHERE `receiver`='.$mobile;
				// echo $sql;
				$code_id = DB::execute($sql);
				//echo ($code_id['max(`id`)']);
				$code_time = $verifyCodeModel->getOneByID($code_id['max(`id`)']);
				//var_dump($code_time);
				$sum = count($code_count);
				$code_newtime = $code_time['create_time'] + '1800';
				//echo $code_newtime;
				$current_time = getGMTime();
				if ($current_time > $code_newtime) {
					showError('您输入的验证码已过期！不能重复使用。');
				} else {
					if ($sum >= 2) {
						$param['where'] = "`receiver`='".$mobile."' and `verify_code`='".$code."' and `create_time`= '".$code_time['create_time']."'";
					} else {
						$param['where'] = "`receiver`='".$mobile."' and `verify_code`='".$code."'";
					}
					$codelist = $verifyCodeModel->getList($param);
					if ($codelist) {
						$data = array(
							'create_time' => $code_time['create_time'] - '1800'
						);
						$verifyCodeModel->update($data);
						Tpl::assign('mobile_id', $mobile);
						Tpl::display('resetpwd/update_pwd');
					} else {
						showError('手机验证码填写错误');
						return false;
					}
				}

			} else {
				showError('请填写手机验证码！');
			}

		}
	}

	/**
	 * @doc 密码修改操作入库
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function editOp(){
		$mobile = Filter::doFilter($_POST['mobile'], 'string');
		$user_pwd = Filter::doFilter($_POST['user_pwd'], 'string');
		$user_pwd_repeat = Filter::doFilter($_POST['user_pwd_repeat'], 'string');
		if ($user_pwd != $user_pwd_repeat) {
			showError('两次密码输入不一致！');
			return false;
		} elseif ($user_pwd == '') {
			showError('密码不能为空！');
			return false;
		} else {
			$userModel = Model('user');
			$data['user_pwd'] = md5($user_pwd);
			$where = "`mobile`='".$mobile."'";
			$userupdate = $userModel->update($data, $where);
			if ($userupdate) {
				$result = array(
					'title'   => '提示',
					'message' => '密码重置成功！',
					'jump'    => array(
						'left'  => array('text' => '继续', 'href' => BASE_URL.'index.php?act=resetpwd&op=update_pwd'),
						'right' => array('text' => '个人中心', 'href' => BASE_URL.'index.php?act=member'),
					)

				);
				showSuccess($result);
			} else {
				showSuccess('密码重置失败！');
				return false;
			}
		}
	}

	/**
	 * @doc 修改密码
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function user_updateOp(){
		Tpl::display('resetpwd/user_update');
	}

	/**
	 * @doc 验证旧密码和验证码
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function user_pwdOp(){
		$captcha_code = Filter::doFilter($_POST['captcha'], 'string');
		if (!checkCaptcha('4a0bd59d', $captcha_code)) {
			showError('图形验证码填写错误');
			return false;
		}
		$id = Filter::doFilter($_SESSION['user_id'], 'string');
		$pwd = Filter::doFilter($_POST['user_pwd'], 'string');
		$user_pwd = md5($pwd);
		$userModel = Model('user');
		$param['where'] = "`id`='".$id."' and `user_pwd`='".$user_pwd."'";
		$userlist = $userModel->getList($param);
		if ($userlist) {
			Tpl::display('resetpwd/user_pwd');
		} else {
			showError('用户密码错误！');
			return false;
		}
	}

	/**
	 * @doc 修改密码执行入库
	 * @author Carr
	 * @time 2015-07-21 13:58:54
	 */
	public function user_editOp(){
		$id = Filter::doFilter($_SESSION['user_id'], 'string');
		$user_pwd = Filter::doFilter($_POST['user_pwd'], 'string');
		$user_pwd_repeat = Filter::doFilter($_POST['user_pwd_repeat'], 'string');
		if ($user_pwd != $user_pwd_repeat) {
			showError('两次密码输入不一致！');
			return false;
		} else if ($user_pwd == '') {
			showError('密码不能为空！');
			return false;
		} else {
			$userModel = Model('user');
			$data['user_pwd'] = md5($user_pwd);
			$where = "`id`='".$id."'";
			$userupdate = $userModel->update($data, $where);
			if ($userupdate) {
				showSuccess('密码重置成功！', BASE_URL.'index.php?act=member&op=login');
			} else {
				showSuccess('密码重置失败！');
				return false;
			}
		}
	}

}

