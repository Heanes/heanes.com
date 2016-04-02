<?php
/**
 * @doc 服务器工具类
 * @filesource Server.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-05 11:24:15
 */
defined('InHeanes') or exit('Access Invalid!');
class Server {
	function __construct() {
		;
	}
	
	/**
	 * @doc 获取当前根域名
	 * @param boolean $end_symbol 返回域名是否 带末尾的/符号，如http://www.heanes.com是不带末尾"/"的，http://www.heanes.com/是带末尾"/"的；
	 * @return string
	 * @author Heanes
	 * @time 2015-05-05 11:38:47
	 */
	public static function get_host($end_symbol=true){
		
		//检测是否为https安全链接
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on') {
			$request_scheme='https';
		}else {
			$request_scheme='http';
		}
		$host=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
		if ($end_symbol) {
			$host.='/';
		}
		return $host;
	}
}