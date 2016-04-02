<?php
/**
 * @filesource Base.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-13 13:04:06
 * @doc 核心初始化文件 不允许继承
 */
final class Base {
	
	function __construct() {
		//echo __METHOD__.'()</br>';
	}
	
	/**
	 * @doc 初始化类
	 * @author Heanes
	 * @time 2014-10-24 14:38:30
	 */
	public static function init() {
		//echo __METHOD__.'()</br>';
		global $config_global;
		self::parse_config($config_global);
		//Tpl::assign('config_global',$config_global);
	}
	
	/**
	 * @doc 解析配置数组变量
	 * @param array &$config 配置的引用
	 * @author Heanes
	 * @time 2014-10-24 14:38:05
	 */
	private static function parse_config(&$config) {
		$_config=$GLOBALS['_config'];
		if(is_array($_config['db']['slave']) && !empty($_config['db']['slave'])){
			$dbslave = $_config['db']['slave'];
			$sid     = array_rand($dbslave);
			$_config['db']['slave'] = $dbslave[$sid];
		}else{
			$_config['db']['slave'] = $_config['db'][1];
		}
		$_config['db']['master'] = $_config['db'][1];
		$config = $_config;
	}
	
	/**
	 * @doc 核心控制类，私有属性，控制单一入口参数进行控制器调度
	 * @author Heanes
	 * @time 2014-10-24 14:37:01
	 */
	private static function control() {
		//echo __METHOD__.'()</br>';
		/**
		 * @doc 自动加载需要的类（按类名自动加载），通过Base类中的autoload()方法实现
		 * @author 方刚
		 * @times 2014-12-23 10:42:11
		 */
		if(function_exists('spl_autoload_register')) {
			spl_autoload_register(array('Base', 'autoload'));
		} else {
			function __autoload($class) {
				Base::autoload($class);
			}
		}
		
		/**
		 * @doc 统一ACTION
		 * @time 2015-01-13 10:05:48
		 */
		//echo 'act='.$_GET[REQUEST_CONTROLLER].'<br/>'.'op='.$_GET[REQUEST_METHOD].'<br/>';
		$_GET[REQUEST_CONTROLLER] = ucfirst(preg_match('/^[\w]+$/i',isset($_GET[REQUEST_CONTROLLER])? $_GET[REQUEST_CONTROLLER] : null) ? $_GET[REQUEST_CONTROLLER] : 'index');
		//echo 'act='.$_GET[REQUEST_CONTROLLER].'<br/>'.'op='.$_GET[REQUEST_METHOD].'<br/>';
		$_GET[REQUEST_METHOD] = ucfirst(preg_match('/^[\w]+$/i',isset($_GET[REQUEST_METHOD])? $_GET[REQUEST_METHOD] : null) ? $_GET[REQUEST_METHOD] : 'index');
		//echo 'act='.$_GET[REQUEST_CONTROLLER].'<br/>'.'op='.$_GET[REQUEST_METHOD].'<br/>';

		/* 规定act行为对应的class类处理文件 */
		$act_file = PATH_ABS_BASE_APP.'controller'.DS.$_GET[REQUEST_CONTROLLER].'Controller.class.php';
		$class_name = $_GET[REQUEST_CONTROLLER].'Controller';
		//echo 'act_file='.$act_file.'</br>'.'class_name='.$class_name.'</br>';
		if (!@include $act_file) {
			//不存在则路由跳转规则
			Router::setHttpStatusCode('404');
			Router::show404('404/404_style1');
			Debug::throw_exception("Base Error: $act_file file isn't exists!");
			//@header('Location: '.'/index');
		}
		if (class_exists($class_name)) {
			Timer::mark('controller_execution_time_( LoadClass : '.$class_name.'  )_start');
			$main=new $class_name;
			Timer::mark('controller_execution_time_( LoadClass : '.$class_name.'  )_end');
			Timer::getTime('controller_execution_time_( LoadClass : '.$class_name.'  )_start','controller_execution_time_( LoadClass : '.$class_name.'  )_end');
			/* 规定op行为对应的class类处理文件中的Op方法 */
			$method=$_GET[REQUEST_METHOD].'Op';
			if (method_exists($main, $method)) {
				Timer::mark('controller_execution_time_( '.$class_name.' / '.$method.' )_start');
				$main->$method();
				Timer::mark('controller_execution_time_( '.$class_name.' / '.$method.' )_end');
				TIMER::getTime('controller_execution_time_( '.$class_name.' / '.$method.' )_start','controller_execution_time_( '.$class_name.' / '.$method.' )_end');
			}elseif (method_exists($main, 'indexOp')) {
				Timer::mark('controller_execution_time_( '.$class_name.' / '.$method.' )_start');
				Router::goHome();
				$_GET[REQUEST_METHOD]='index';
				$main->indexOp();
				Timer::mark('controller_execution_time_( '.$class_name.' / '.$method.' )_end');
			}else {
				$error="Base Error: function $method not in $class_name!";
				Debug::throw_exception($error);
			}
		}else {
			$error="Base Error: class $class_name isn't exists!";
			Debug::throw_exception($error);
		}
		
		
	}
	
	/**
	 * @doc 框架运行类
	 * @author Heanes
	 * @time 2014-10-24 14:36:14
	 */
	public static function run() {
		//echo __METHOD__.'()</br>';
		self::cp();
		self::init();
		Timer::mark('loading_time:_base_classes_end');
		Timer::getTime('loading_time:_base_classes_start','loading_time:_base_classes_end');
		self::control();
		self::stop();
		
		/**
		 * @doc 此处计时结束不准确，因为系统结束是在所有的页面被TPL展示完毕之后才结束
		 */
		//Timer::mark('total_execution_time_end');
		//Timer::printTime('total_execution_time_start','total_execution_time_end');
		//TPL::assign('total_elapsed_time',Timer::getTime('total_execution_time_start','total_execution_time_end'));
		//var_dump(Timer::$marker);
	}
	
	public static function stop() {
		DB::close();
		//exit;
	}
	
	/**
	 * @doc 自动加载类
	 * @param string $class
	 * @author Heanes
	 * @time 2014-10-24 14:40:19
	 */
	public static function autoload($class) {
		//echo __METHOD__.'('.$class.')</br>';
		//$class = strtolower($class);
		//echo __METHOD__.'('.$class.')</br>';
		Timer::mark('controller_execution_time_( LoadClass : '.$class.'  )_start');
		if (ucwords(substr($class,-5)) == 'Class' ){
			if (!@include_once PATH_ABS_BASE_CORE.'framework/library/'.substr($class,0,-5).'.class.php'){
				exit("normalClass Error: {$class}.isn't exists!");
			}
		}elseif (ucwords(substr($class,0,5)) == 'Cache' && $class != 'cache'){
			if (!@include_once PATH_ABS_BASE_CORE.'framework/cache/'.substr($class,0,5).'.'.substr($class,5).'.php'){
				exit("cacheClass Error: {$class}.isn't exists!");
			}
		}elseif ($class == 'DB'){
			if (!@include_once PATH_ABS_BASE_CORE.'framework/db/driver/mysqli/mysqli.class.php'){
				exit("dbClass Error: {$class}.isn't exists!");
			}
		}elseif (ucwords(substr($class,-5)) == 'Model' && ucwords($class)!='Model'){
			if (!@include_once(PATH_ABS_BASE_DATA.'model/'.ucwords(substr($class,0,-5)).'Model.class.php')){
				exit("modelClass Error: {$class}.isn't exists!");
			}
		}else{
			if (is_file(PATH_ABS_BASE_CORE.'framework/core/'.ucwords($class).'.class.php')) {
				if ( !@include_once PATH_ABS_BASE_CORE.'framework/core/'.ucwords($class).'.class.php') {
					exit('otherClass Error: '.ucwords($class).".isn't exists!");
				}
			}
			if (is_file(PATH_ABS_BASE_CORE.'framework/library/'.ucwords($class).'.class.php')) {
				if ( !@include_once PATH_ABS_BASE_CORE.'framework/library/'.ucwords($class).'.class.php' ) {
					exit('otherClass Error: '.ucwords($class).".isn't exists!");
				}
			}
		};
		Timer::mark('controller_execution_time_( LoadClass : '.$class.'  )_end');
		Timer::getTime('controller_execution_time_( LoadClass : '.$class.'  )_start','controller_execution_time_( LoadClass : '.$class.'  )_end');
	}
	/**
	 * @doc 核心权限验证类 
	 * @time 2015-04-24 14:36:06
	 * @todo 核心权限验证类，待补充
	 */
	private static function cp() {
		//echo __METHOD__.'()</br>';
		//self::isInstalled();
		
	}
	
	private static function isInstalled() {
		//echo __METHOD__.'()</br>';
		if(!file_exists(PATH_ABS_BASE_ROOT."data/install.lock")){
			@header('Location:'.'/install/');
			exit;
		}
	}
}
 