<?php
/**
 * @doc 短信接口实现
 * @filesource SMS.implement.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.17 09:19:28
 */
defined('InHeanes') or exit('Access Invalid!');
require_once PATH_ABS_BASE_CORE."framework/thirdparty/sms/iSMS.class.php";  //引入接口
require_once PATH_ABS_BASE_CORE."framework/thirdparty/sms/ChuangMing/transport.class.php";  //引入传输类
class ChuangMing_sms implements SMS{

	/**
	 * @var string 短信内容
	 */
	public $sms;

	public function __construct($smsInfo = '') {
		if (!empty($smsInfo)) {
			$this->sms = $smsInfo;
		}
	}


	/**
	 * @doc 发送短信
	 * @param string $phone_number 电话号码
	 * @param string $sms_content 短信内容
	 * @param string $method 请求方式，GET或POST
	 * @return array 返回发送结果状态码
	 * @author Heanes
	 * @time 2015-06-16 18:48:22
	 */
	function sendSMS($phone_number,$sms_content,$method='POST') {
		if(is_array($phone_number)){
			$phone_number = implode(",",$phone_number);
		}

		$this->sms['mobile'] = $phone_number;
		$this->sms['content'] = urlencode($sms_content);
		$params = json_encode($this->sms);
		$sms = new transport($params);
		$result_info = $sms->send($phone_number,$sms_content,'POST');
		//var_dump($result_info);

		//对结果进行处理
		$return=array();
		foreach ($result_info as $key => $value) {
			if ($key == '@attributes') {
				//var_dump($value);
				$return['status'] = $value['result'];
				$return['name'] = $value['name'];
			}
			if (is_array($value) && $key == 'Item') {
				foreach ($value as $k => $v) {
					$return['remain']=$v['remain'];
				}
			}
		}

		//var_dump($result_info);
		//var_dump($return);
		//echo '<br/>'.$result_status . 'aaaa<br/>';

		$result['status'] = $return['status'];
		$result['name'] = $return['name'];
		$result['remain'] = $return['remain'];
		return $result;
	}
	/*获取该短信接口的相关数据*/
	function getSmsInfo() {
		return "上海创明网络科技 By Heanes";
	}

	/**
	 * @doc 检查短信剩余费用
	 * @param string $method 请求方式，GET或POST
	 * @return mixed
	 * @author Heanes
	 * @time 2015-06-16 18:49:38
	 */
	function checkFee($method='GET') {
		$params = json_encode($this->sms);
		$sms = new transport($params);
		return '余额还剩'.$sms->get_count_fee($method).'元';
	}

	/**
	 * @doc 接收短信
	 * @param string $phone_number 电话号码
	 * @param string $sms_content 短信内容
	 * @return mixed
	 * @author Heanes
	 * @time 2015-06-17 09:35:52
	 */
	public function receiveSMS($phone_number, $sms_content) {
		// TODO: Implement receiveSMS() method.
	}
}
