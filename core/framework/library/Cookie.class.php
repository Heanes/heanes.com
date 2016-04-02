<?php
/**
 * @doc 
 * @filesource Cookie.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-02 11:45:19
 */
defined('InHeanes') or exit('Access Invalid!');
class Cookie{
	/**
	 * @doc 判断Cookie是否存在
	 * @param string $name
	 * @author Heanes
	 * @time 2015-06-02 11:45:52
	 */
	public static function is_set($name) {
		return isset($_COOKIE[$name]);
	}

	/**
	 * @doc 获取某个Cookie值
	 * @param string $name
	 * @return array
	 * @author Heanes
	 * @time 2015-06-02 11:46:22
	 */
	public static function get($name) {
		$value   = $_COOKIE[$name];
		return $value;
	}

	/**
	 * @doc 设置某个Cookie值
	 * @param string $name
	 * @param string $value
	 * @param string $expire
	 * @param string $path
	 * @param string $domain
	 * @author Heanes
	 * @time 2015-06-02 11:46:49
	 */
	public static function set($name,$value,$expire='',$path='',$domain='') {
		$path = app_conf("COOKIE_PATH");
		$domain = app_conf("DOMAIN_ROOT");
		$expire =   !empty($expire)?TIME_UTC+$expire:0;
		setcookie($name, $value,$expire,$path,$domain);
	}

	/**
	 * @doc 删除某个Cookie值
	 * @param string $name
	 * @author Heanes
	 * @time 2015-06-02 11:47:24
	 */
	public static function delete($name) {
		Cookie::set($name,'',0);
	}

	/**
	 * @doc 清空Cookie值
	 * @author Heanes
	 * @time 2015-06-02 11:47:36
	 */
	public static function clear() {
		unset($_COOKIE);
	}
}