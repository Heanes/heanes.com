<?php
/**
 * @filesource base.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-13 13:04:06
 * @doc 核心初始化文件 不允许继承
 */
defined('InHeanes') or exit('Access Invalid!');
final class Base {
	
	function __construct() {
		//echo __METHOD__.'()</br>';
	}
	
	/**
	 * 初始化类
	 */
	public static function init() {
		//echo __METHOD__.'()</br>';
		global $congfig_global;
		self::parse_config($congfig_global);
		Tpl::output('congfig_global',$congfig_global);
	}
	
	/**
	 * 解析配置数组变量
	 * @param array $config
	 */
	private static function parse_config(&$config) {
		$n_config=$GLOBALS['_config'];
		if(is_array($n_config['db']['slave']) && !empty($n_config['db']['slave'])){
			$dbslave = $n_config['db']['slave'];
			$sid     = array_rand($dbslave);
			$n_config['db']['slave'] = $dbslave[$sid];
		}else{
			$n_config['db']['slave'] = $n_config['db'][1];
		}
		$n_config['db']['master'] = $n_config['db'][1];
		$config = $n_config;
	}
	
	/**
	 * 核心控制类，私有属性，控制单一入口参数进行控制器调度
	 */
	private static function control() {
		//echo __METHOD__.'()</br>';
		/* 规定act行为对应的class类处理文件 */
		$act_file = realpath(PATH_ABS_BASE_APP.'/control/'.$_GET['act'].'.class.php');
		$class_name = $_GET['act'].'Control';
		//echo 'act_file='.$act_file.'</br>'.'class_name='.$class_name.'</br>';
		if (!@include $act_file) {
			throw_exception("Base Error: $act_file file isn't exists!");
		}
		
		if (class_exists($class_name)) {
			$main=new $class_name;
			$method=$_GET['op'].'Op';
			if (method_exists($main, $method)) {
				$main->$method();
			}elseif (method_exists($main, 'indexOp')) {
				$main->$method();
			}else {
				$error="Base Error: function $method not in $class_name!";
			}
		}else {
			$error="Base Error: class $class_name isn't exists!";
			throw_exception($error);
		}
	}
	
	/**
	 * 框架运行类
	 */
	public static function run() {
		//echo __METHOD__.'()</br>';
		self::cp();
		self::init();
		self::control();
	}
	
	/**
	 * 自动加载类
	 * @param string $class
	 */
	public static function autoload($class) {
		$class = strtolower($class);
		if (ucwords(substr($class,-5)) == 'Class' ){
			if (!@include_once(PATH_ABS_BASE_CORE.'framework/library/'.substr($class,0,-5).'.class.php')){
				exit("normalClass Error: {$class}.isn't exists!");
			}
		}elseif (ucwords(substr($class,0,5)) == 'Cache' && $class != 'cache'){
			if (!@include_once(PATH_ABS_BASE_CORE.'framework/cache/'.substr($class,0,5).'.'.substr($class,5).'.php')){
				exit("cacheClass Error: {$class}.isn't exists!");
			}
		}elseif ($class == 'db'){
			if (!@include_once(PATH_ABS_BASE_CORE.'framework/db/driver/mysql/mysqli.class.php')){
				exit("dbClass Error: {$class}.isn't exists!");
			}
		}elseif (ucwords(substr($class,0,5)) == 'Model'){
			if (!@include_once(PATH_ABS_BASE_DATA.'model/'.substr($class,0,5).'.class.php')){
				exit("modelClass Error: {$class}.isn't exists!");
			}
		}else{
			if (!@include_once(PATH_ABS_BASE_CORE.'framework/library/'.$class.'.class.php')){
				exit("otherClass Error: {$class}.isn't exists!");
			}
		};
	}
	/**
	 * 核心权限验证类 @todo 待完成
	 */
	private static function cp() {
		//echo __METHOD__.'()</br>';
	}
}
 