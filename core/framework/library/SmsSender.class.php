<?php
/**
 * @doc 短信发送插件
 * @filesource SmsSender.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.17 10:39:28
 */
defined('InHeanes') or exit('Access Invalid!');

class SmsSender {
	var $sms;

	public function __construct() {
		//echo '<br/>'.__CLASS__.'->'.__FUNCTION__.'<br/>';
		require_once PATH_ABS_BASE_CORE . "framework/thirdparty/sms/ChuangMing/SMS.implement.class.php";
		//var_dump($sms_info);
		$sms_info = '';
		$this->sms = new ChuangMing_sms($sms_info);
	}

	/**
	 * @doc 短信发送
	 * @param string $mobiles 手机号，多个，以半角逗号隔开
	 * @param string $content 短信内容 前一天
	 * @param string $sendTime 发送时间
	 * @return array 发送结果数组
	 * @author Heanes
	 * @time 2015-06-17 10:45:53
	 */
	public function sendSms($mobiles, $content, $sendTime = '') {
		$result['status'] = 0;
		if(empty($mobiles) || !isset($mobiles)){
			$result['msg'] = "手机号为空";
		}
		if (!is_array($mobiles) && !empty($mobiles)){
			$mobiles = preg_split("/[ ,]/i", $mobiles);
		}
		if (count($mobiles) > 0) {
			if (!$this->sms) {
				$result['status'] = 0;
			} else {
				$sms_log_model=Model('SmsLog');
				foreach ($mobiles as $key => $mobile) {
					$new_sms_log_array=array(
						'receiver'=>$mobile,
						'content'=>$content,
						'type'=>VERIFY_MOBILE,
						'insert_time'=>getGMTime(),
						'client_ip'=>get_client_ip(),
					);
					$result = $this->sms->sendSms($mobiles, $content, $sendTime);
					//插入日志记录
					if($result['status']==1){
						$sms_log_model->addSmsLog($new_sms_log_array);
					}
				}
			}
		} else {
			$result['status'] = 0;
			$result['msg'] = "手机号为空";
		}
		return $result;
	}

	public function checkFee($method='GET'){
		return $this->sms->checkFee($method);
	}
}
