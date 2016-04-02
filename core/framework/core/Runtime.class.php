<?php
/**
 * @doc 运行环境类
 * @filesource Runtime.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-24 17:00:01
 */
class Runtime {
	
	
	function __construct() {
		//echo __METHOD__.'<br/>';
	}
	
	/**
	 * @doc 设置系统运行环境（php配置，数据库配置）
	 * @author Heanes
	 * @time 2015年4月24日下午5:28:24
	 */
	public static function set_environment() {
		
		/**
		 * @doc 载入配置
		 * @time 2015-01-13 10:05:48
		 */
		$_config=array();
		if (!@include(PATH_ABS_BASE_DATA.'config/php.cfg.php')) exit('php.cfg.php isn\'t exists!');
		if (!@include(PATH_ABS_BASE_DATA.'config/db.cfg.php')) exit('db.cfg.php isn\'t exists!');
		if (!@include(PATH_ABS_BASE_DATA.'config/constant.cfg.php')) exit('constant.cfg.php isn\'t exists!');
		$GLOBALS['_config']=$_config;
		
		/**
		 * @doc 数据库前缀定义
		 * @time 2015-01-13 10:05:48
		 */
		define('DB_PRE',($_config['db'][1]['dbname']).'`.`'.($_config['db']['1']['tablepre']));
		define('DBPRE',$_config['db']['1']['tablepre']);
		

		/**
		 * @doc 启用ZIP压缩
		 * @time 2015-01-13 10:05:48
		 */
		//if ($config['gzip'] == 1 && function_exists('ob_gzhandler') && $_GET['inajax'] != 1){
		if (function_exists('ob_gzhandler') &&(isset($_GET['inajax']) && $_GET['inajax'] != 1)){
			ob_end_clean();//防止ob_gzhandler与zlib output compression发生冲突
			ob_start('ob_gzhandler');
		}else {
			ob_start();
		}
		self::init();
		//定义当前系统的域名路径（可以将系统放置在子目录中，仍然可以正确载入资源文件和链接）
		define('SYS_HOST',get_host(false).PATH_BASE_ROOT);
		define('HOST',get_host());
		define('BASE_URL',get_base_url());
		define('CURRENT_URL',get_current_url());
	}
	
	/**
	 * @doc 核心初始化 
	 * @author Heanes
	 * @time 2015-04-24 17:28:20
	 */
	private static function init() {
		/**
		 * @doc 载入核心运行文件
		 * @time 2015-01-13 10:05:48
		 */
		Timer::mark('loading_time:_base_classes_start');
		require_once PATH_ABS_BASE_CORE.'framework/core/Base.class.php';
		require_once PATH_ABS_BASE_CORE.'framework/function/core.func.php';
		require_once PATH_ABS_BASE_CORE.'framework/function/htmlPage.func.php';
		session_start();
	}
}
