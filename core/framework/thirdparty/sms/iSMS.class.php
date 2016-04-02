<?php
/**
 * @doc 短信接口
 * @filesource iSMS.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-16 18:44:30
 */
defined('InHeanes') or exit('Access Invalid!');
interface SMS{

	/**
	 * @doc 发送短信
	 * @param string $phone_number 电话号码
	 * @param string $sms_content 短信内容
	 * @param string $method 请求方式，GET或POST
	 * @return array 返回发送结果状态码
	 * @author Heanes
	 * @time 2015-06-16 18:48:22
	 */
	public function sendSMS($phone_number,$sms_content,$method='POST');

	/**
	 * @doc 接收短信
	 * @param string $phone_number 电话号码
	 * @param string $sms_content 短信内容
	 * @return mixed
	 * @author Heanes
	 * @time 2015-06-16 18:52:45
	 */
	public function receiveSMS($phone_number,$sms_content);

	/**
	 * @doc 获取该短信接口的相关数据
	 * @return mixed
	 * @author Heanes
	 * @time 2015-06-16 18:49:01
	 */
	public function getSmsInfo();

	/**
	 * @doc 检查短信剩余费用
	 * @param string $method 请求方式，GET或POST
	 * @return mixed
	 * @author Heanes
	 * @time 2015-06-16 18:49:38
	 */
	public function checkFee($method='GET');
}