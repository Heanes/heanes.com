<?php
/**
 * @doc 
 * @filesource Session.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-02 12:17:52
 */
defined('InHeanes') or exit('Access Invalid!');
class Session{
	
	public static function id(){
		return session_id();
	}
	
	public static function start(){
		session_set_cookie_params(0,app_conf("COOKIE_PATH"),app_conf("DOMAIN_ROOT"),false,true);
		@session_start();
	}

	/**
	 * @doc 判断session是否存在
	 * @param string $name
	 * @return string
	 * @author Heanes
	 * @time 2015-06-02 12:20:26
	 */
	public static function is_set($name) {
		self::start();
		$tag = isset($_SESSION[app_conf("AUTH_KEY").$name]);
		self::close();
		return $tag;
	}

	/**
	 * @doc 获取某个session值
	 * @param string $name
	 * @return string
	 * @author Heanes
	 * @time 2015-06-02 12:21:02
	 */
	public static function get($name) {
		self::start();
		$value   = $_SESSION[app_conf("AUTH_KEY").$name];
		self::close();
		return $value;
	}

	/**
	 * @doc 设置某个session值
	 * @param string $name
	 * @param string $value
	 * @author Heanes
	 * @time 2015-06-02 12:21:55
	 */
	public static function set($name,$value){
		self::start();
		$_SESSION[app_conf("AUTH_KEY").$name]  =   $value;
		self::close();
	}

	/**
	 * @doc 删除某个session值
	 * @param string $name
	 * @author Heanes
	 * @time 2015-06-02 12:22:12
	 */
	public static function delete($name){
		self::start();
		unset($_SESSION[app_conf("AUTH_KEY").$name]);
		self::close();
	}

	/**
	 * @doc 清空session
	 * @author Heanes
	 * @time 2015-06-02 12:24:10
	 */
	public static function clear(){
		session_destroy();
	}

	/**
	 * @doc 关闭session的读写
	 * @author Heanes
	 * @time 2015-06-02 12:25:03
	 */
	public static function close(){
		@session_write_close();
	}
	
	/**
	 * @doc 
	 * @return boolean
	 * @author Heanes
	 * @time 2015-06-02 12:25:46
	 */
	public static function  is_expired(){
		self::start();
		if (isset($_SESSION[app_conf("AUTH_KEY")."expire"]) && $_SESSION[app_conf("AUTH_KEY")."expire"] < NOW_TIME) {
			$tag =  true;
		} else {
			$_SESSION[app_conf("AUTH_KEY")."expire"] = NOW_TIME+(intval(app_conf("EXPIRED_TIME"))*60);
			$tag = false;
		}
		return $tag;
		self::close();
	}
}