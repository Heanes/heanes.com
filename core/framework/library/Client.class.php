<?php
/**
 * @doc 客户类
 * 获取访客信息的类：语言、浏览器、操作系统、IP、地理位置、ISP。  
 * 使用：  
 *      $obj = new class_guest_info;  
 *      $obj->GetLang();        //获取访客语言：简体中文、繁體中文、English。  
 *      $obj->GetBrowser();     //获取访客浏览器：MSIE、Firefox、Chrome、Safari、Opera、Other。  
 *      $obj->GetOS();          //获取访客操作系统：Windows、MAC、Linux、Unix、BSD、Other。  
 *      $obj->GetIP();          //获取访客IP地址。  
 *      $obj->GetAdd();         //获取访客地理位置，使用 Baidu 隐藏接口。  
 *      $obj->GetIsp();         //获取访客ISP，使用 Baidu 隐藏接口。  
 * @filesource Client.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-31 09:57:52
 */
defined('InHeanes') or exit('Access Invalid!');
class Client{
	
	
	
	/**
	 * @doc 取上一步来源地址
	 * @return string 字符串类型的返回结果
	 * @author Heanes
	 * @time 2015-06-08 13:12:55
	 */
	public static function getReferer(){
		return empty($_SERVER['HTTP_REFERER'])?'':$_SERVER['HTTP_REFERER'];
	}
	
	/**
	 * @doc 获取客户语言
	 * @return string
	 * @return string{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:12:55
	 */
	public static function getLang() {
		$Lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
		//使用substr()截取字符串，从 0 位开始，截取4个字符
		if (preg_match('/zh-c/i',$Lang)) {
			//preg_match()正则表达式匹配函数
			$Lang = '简体中文';
		}
		elseif (preg_match('/zh/i',$Lang)) {
			$Lang = '繁體中文';
		}
		else {
			$Lang = 'English';
		}
		return $Lang;
	}
	
	/**
	 * @doc 获取客户浏览器类型
	 * @return Ambigous <string, unknown>
	 * @return Ambigous <string, unknown>{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:13:18
	 */
	public static function getBrowser() {
		$Browser = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/MSIE/i',$Browser)) {
			$Browser = 'MSIE';
		}
		elseif (preg_match('/Firefox/i',$Browser)) {
			$Browser = 'Firefox';
		}
		elseif (preg_match('/Chrome/i',$Browser)) {
			$Browser = 'Chrome';
		}
		elseif (preg_match('/Safari/i',$Browser)) {
			$Browser = 'Safari';
		}
		elseif (preg_match('/Opera/i',$Browser)) {
			$Browser = 'Opera';
		}
		else {
			$Browser = 'Other';
		}
		return $Browser;
	}
	/**
	 * @doc 获取客户操作系统
	 * @return Ambigous <string, unknown>
	 * @return Ambigous <string, unknown>{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:13:37
	 */
	public static function getOS() {
		$OS = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/win/i',$OS)) {
			$OS = 'Windows';
		}
		elseif (preg_match('/mac/i',$OS)) {
			$OS = 'MAC';
		}
		elseif (preg_match('/linux/i',$OS)) {
			$OS = 'Linux';
		}
		elseif (preg_match('/unix/i',$OS)) {
			$OS = 'Unix';
		}
		elseif (preg_match('/bsd/i',$OS)) {
			$OS = 'BSD';
		}
		else {
			$OS = 'Other';
		}
		return $OS;
	}
	
	/**
	 * @doc 获取访客IP
	 * @return Ambigous <>
	 * @return Ambigous <>{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:14:17
	 */
	public static function getIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			//如果变量是非空或非零的值，则 empty()返回 FALSE。
			$IP = explode(',',$_SERVER['HTTP_CLIENT_IP']);
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$IP = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
		}
		elseif (!empty($_SERVER['REMOTE_ADDR'])) {
			$IP = explode(',',$_SERVER['REMOTE_ADDR']);
		}
		else {
			$IP[0] = 'None';
		}
		return $IP[0];
	}
	/**
	 * @doc 获取访客IP所在地理位置
	 * @return boolean|mixed
	 * @return boolean|mixed{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:14:24
	 */
	private static function getAddIsp() {
		$IP = self::GetIP();
		$AddIsp = mb_convert_encoding(file_get_contents('http://opendata.baidu.com/api.php?resource_id=6006&format=json&query='.$IP.'\''),'UTF-8','GBK');
		//http://ip.taobao.com/service/getIpInfo.php?ip=123.57.208.51 淘宝ip地址库
		//mb_convert_encoding() 转换字符编码。
		$result_arr=json_decode($AddIsp,true);
		if ($result_arr['status']!='0') {
			return false;
		}
		else {
			return $result_arr;
		}
	}
	/**
	 * @doc 获取访客IP所在地理位置
	 * @return Ambigous <>
	 * @return Ambigous <>{tags}
	 * @author Heanes
	 * @time 2015-06-08 13:17:40
	 */
	public static function getAdd() {
		$Add = self::GetAddIsp();
		return $Add[0];
	}
	public static function getIsp() {
		$Isp = self::GetAddIsp();
		if ($Isp['status'] == 0 && isset($Isp['data'])) {
			return $Isp['data'][0]['location'];
		}
		else {
			return 'Unknow';
		}
	}
}