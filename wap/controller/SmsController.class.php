<?php
/**
 * @doc 消息发送控制器
 * @filesource SmsController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.19 11:20
 */
defined('InHeanes') or exit('Access Invalid!');

class SmsController extends BaseWapController {

	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 发送注册验证码
	 * @return string
	 * @author Heanes
	 * @time 2015-06-18 16:50:18
	 */
	public function sendRegCaptchaSmsOp() {
		$user_mobile = Filter::doFilter($_POST['user_mobile'], 'mobile');
		if (!isset($user_mobile) || empty($user_mobile)) {
			$result['status'] = 2;
			$result['msg'] = '手机号为空';
			//ajax_return($result);
		}
		//验证此手机是否已经存在于用户表中

		$user_model = Model('user');
		$checkUserExistsParam=array(
			'where'=>"`user_name`='$user_mobile' OR `mobile`='$user_mobile'",
		);
		if(count($user_model->getUser($checkUserExistsParam))>0){
			$result['status'] = -2;
			$result['msg'] = '此手机号已经注册过！';
			ajax_return($result);
		}
		$sms_log_model=Model('SmsLog');
		$last_send_sms=$sms_log_model->getLastSend($user_mobile);
		if((getGMTime()-$last_send_sms['create_time'])/(60)>1){
			//生成验证码相关数据
			$verify_data['verify_code'] = rand(111111, 999999);
			$verify_data['receiver'] = $user_mobile;
			$verify_data['type'] = VERIFY_MOBILE;
			$verify_data['create_time'] = getGMTime();
			$verify_data['client_ip'] = get_client_ip();
			$verifyCodeModel=Model('verify_code');
			try {
				$verifyCodeModel->beginTransaction();
				$send_sms_content = '您好，您在本网站(注册)的验证码是' . $verify_data['verify_code'] . '，';
				$send_sms_content .= '此验证码三十分钟内有效，请勿将其转告或转发给他人。';
				//手动添加包含文件，不是最优解
				//require_once PATH_ABS_BASE_CORE.'framework/library/SmsSender.class.php';
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
		}else{
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
		$user_mobile=Filter::doFilter($_REQUEST['user_mobile'],'string');
		$send_sms_content=Filter::doFilter($_REQUEST['send_sms_content'],'string');
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
}