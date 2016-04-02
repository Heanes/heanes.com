<?php
/**
 * @doc 调试类
 * @filesource Debug.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-01 15:56:43
 */
class Debug {
	
	/**
	 * @doc 单例对象
	 * @var object
	 */
	private static $instance=null;
	
	/**
	 * @doc 被调试程序当前目录
	 * @var string
	 */

	private static $current_dir='';
	/**
	 * @doc 被调试程序当前模版主题名称
	 * @var string
	 */

	/**
	 * @var string 当前模版布局量
	 */
	private static $current_layout ='';

	/**
	 * @var string 当前模版名称
	 */
	private static $current_theme='';
	
	/**
	 * @doc 错误报告信息
	 * @var array
	 */
	private static $error_report=array();
	
	/**
	 * @doc 回调追踪信息存储
	 * @var string
	 */
	private static $debug_backtrace='';
	
	/**
	 * @doc 调试信息
	 * @var array
	 */
	private static $debug_info=array();
	/**
	 * @doc 抛出的异常信息
	 * @var array
	 */
	private static $exception=array();
	
	function __construct() {
		require_once PATH_ABS_BASE_DATA.'config/debug.cfg.php';
		//echo __METHOD__.'()<br/>';
	}
	
	/**
	 * @doc 构造单例对象
	 * @return object
	 */
	public static function getInstance(){
		if (self::$instance === null || !(self::$instance instanceof Debug)) {
			self::$instance=new Debug();
		}
		return self::$instance;
	}
	
	/**
	 * @doc debug初始化准备
	 * @author Heanes
	 * @time 2015-04-03 15:44:39
	 */
	private static function init() {
		//echo __METHOD__.'()<br/>';
		self::getInstance();
		//self::saveEnvironment();
	}
	
	/**
	 * @doc 错误报告功能
	 * @author Heanes
	 * @time 2015-04-03 16:03:40
	 */
	public static function error_report() {
		//echo __METHOD__.'()<br/>';
		self::getInstance();
		if (DEBUG_ON) {
			self::init();
			set_error_handler('Debug::php_error', E_ALL); //函数名，收集的错误级别
            return true;
		}else {
			return 'DEBUG_ON off';
		}
		//self::restoreEnvironment();
	}
	
	/**
	 * @doc 获取被调试程序当前目录路径
	 * @return string
	 * @author Heanes
	 * @time 2015年4月3日下午3:45:09
	 */
	public static function getCurrentDir() {
		self::getInstance();
		return self::$current_dir;
	}

	public static function getCurrentLayout(){
		self::getInstance();
		return self::$current_layout;
	}
	
	/**
	 * @doc 获取被调试程序当前模版名称
	 * @return string
	 * @author Heanes
	 * @time 2015年4月3日下午3:45:40
	 */
	public static function getCurrentTheme() {
		self::getInstance();
		return self::$current_theme;
	}

	/**
	 * @doc 设置模版环境为系统调试环境
	 * @author Heanes
	 * @time 2015-02-23 10:52:38
	 */
	private static function saveEnvironment() {
		//echo __METHOD__.'()<br/>';
		self::getInstance();
		self::$current_dir=Tpl::getCurrentDir();
		self::$current_layout=Tpl::getLayout();
		self::$current_theme = TPL::getThemeName();
		/*
		echo 'Debug:saveEnvironment()下self::$current_dir='.self::$current_dir.'<br/>';
		echo 'Debug:saveEnvironment()下self::$current_theme='.self::$current_theme.'<br/>';
		*/
		//更改文件路径以正常显示debug页面
		chdir(PATH_ABS_BASE_CORE);
		//Tpl::setCurrentDir();
		TPL::setTemplateDir('default');
		TPL::setLayout('layout/defaultCommonLayout');
		//TPL::setLayout('');
		/*
		echo 'chdir(PATH_ABS_BASE_CORE)之后:'.'<br/>';
		echo 'Debug:saveEnvironment()下self::$current_dir='.self::$current_dir.'<br/>';
		echo 'Debug:saveEnvironment()下self::$current_theme='.self::$current_theme.' set结束<br/>';
		*/
	}

	/**
	 * @doc 恢复调试前改变的环境配置
	 * @author Heanes
	 * @time 2015年4月3日下午3:47:09
	 */
	private static function restoreEnvironment() {
		self::getInstance();
		//echo __METHOD__.'()<br/>';
		chdir(self::$current_dir);
		/*
		echo 'Debug:restoreEnvironment()下self::$current_dir='.self::$current_dir.'<br/>';
		echo 'Debug:restoreEnvironment()下self::$current_theme='.self::$current_theme.' set结束<br/><br/><br/>';
		*/
		TPL::setTemplateDir(self::getCurrentTheme());
		//echo 'self::getCurrentLayout():'.self::getCurrentLayout().' endSymbol';
		TPL::setLayout(self::getCurrentLayout());
		if (DEBUG_ON) {
			//echo '所有耗时'.Timer::getTime('total_execution_time_start').'秒';
		}
        return true;
	}

    /**
     * @doc 记录sql语句
     * @param string $sql
     * @param string $time
     * @return bool|string
     * @author Heanes
     * @time 2015-04-01 16:18:44
     */
	public static function log_sql($sql,$time) {
		self::getInstance();
		if (SHOW_SQL) {
			self::$error_report['sql']['total']=0;
			$i= isset(self::$error_report['sql']['log']) ? count(self::$error_report['sql']['log']) : 0;
			self::$error_report['sql']['log'][$i]['sql']=$sql;
			self::$error_report['sql']['log'][$i]['time']=$time;
			$total=0;
			foreach (self::$error_report['sql']['log'] as $key => $value) {
				self::$error_report['sql']['total']+=(float)(self::$error_report['sql']['log'][$key]['time']);
				$total +=(float)(self::$error_report['sql']['log'][$key]['time']);
			}
			//var_dump(debug_backtrace());
			//TPL::display('debug.php');self::saveEnvironment();
            return true;
		}else {
			return 'SHOW_SQL off';
		}
	}

	/**
	 * @doc 自定义错误处理
	 * @param integer $errno 错误编号
	 * @param string $errstr 错误信息
	 * @param string $errfile 错误文件
	 * @param integer $errline 错误行号
	 * @author Heanes
	 * @time 2015-03-23 13:44:22
	 */
	public static function php_error($errno, $errstr, $errfile, $errline){ //错误编号，错误信息，错误文件，错误行号
		self::getInstance();
		$errortype = array(
				E_ERROR => 'Error',
				E_WARNING => 'Warning',
				E_PARSE => 'Parse',
				E_NOTICE => 'Notice',
				E_STRICT => 'Runtime Notice',
				E_CORE_ERROR => 'Core Error',
				E_CORE_WARNING => 'Core Warning',
				E_COMPILE_ERROR => 'Compile Error',
				E_COMPILE_WARNING => 'Compile Warning',
				E_USER_ERROR => 'User Error',
				E_USER_WARNING => 'User Warning',
				E_USER_NOTICE => 'User Notice'
		);
		//echo "<b style='color:red'>$errortype[$errno]: </b> $errstr <br/>\n<b style='color:red'>File ($errline):</b> $errfile <br>\n"; //输出错误信息
		self::$error_report['debug'][] = array(
			'errortype'	=>	$errortype[$errno],
			'errorstr'	=>	$errstr,
			'errline'	=>	$errline,
			'errfile'	=>	$errfile
		);
		//TPL::assign('error_report',self::$error_report);
	}
	
	/**
	 * @doc 获取调试数据
	 * @return array:
	 * @author Heanes
	 * @time 2015-03-18 10:01:58
	 */
	public static function get_error_report() {
		self::getInstance();
		return self::$error_report;
	}
	
	/**
	 * @doc 展示调试信息页面
	 * @author Heanes
	 * @time 2015-03-18 10:01:58
	 */
	public static function display_debug() {
		self::getInstance();
		self::show_included_files();
		self::show_defined_functions();
		self::show_defined_constants();
		self::get_caller_info();
		if (DEBUG_ON) {
			//define('TPL_DEBUG', Server::get_host().'core/template/default/');
			//var_dump(self::$error_report);
			self::saveEnvironment();
			TPL::assign('error_report',self::$error_report);
			TPL::assign('TPL',TPL::$TPL);
			if (!defined('TPL_DEBUG')) {
				//define('TPL_DEBUG', Server::get_host(false).PATH_BASE_CORE .Tpl::getTemplateDir());
				define('TPL_DEBUG', TPL::$TPL);
			}
			TPL::display('debug/error_report');
			self::restoreEnvironment();
		}
	}

    /**
     * @return bool
     */
	public static function insert_display() {
		return true;
	}
	
	/**
	 * @doc 抛出异常
	 * @param string $error 异常信息
	 * @param boolean $exit 异常信息
	 * @return boolean|string
	 * @author Heanes
	 * @time 2015-03-18 10:01:58
	 */
	public static function throw_exception($error,$exit=false){
		self::getInstance();
		if (SHOW_EXCEPTION) {
			self::$error_report['exception'][] = $error;
		}
		if ($exit){
			echo $error;
			exit();
		}else{
			if (IGNORE_EXCEPTION) {
				return false;
			}else {
				echo $error;
				exit();
			}
		}
	}
	
	/**
	 * @doc 显示运行时被包含的文件
	 * @return string
	 * @author Heanes
	 * @time 2015-04-25 00:49:13
	 */
	public static function show_included_files() {
		self::getInstance();
		if (SHOW_INCLUDED_FILE) {
			$included_files=get_included_files();
			foreach ($included_files as $key => $value) {
				self::$error_report['included_file'][]=$value;
			}
            return true;
		}else {
			return 'SHOW_INCLUDED_FILE off';
		}
	}
	/**
	 * @doc 显示已定义的用户函数
	 * @return string
	 * @author Heanes
	 * @time 2015-04-25 21:33:02
	 */
	public static function show_defined_functions() {
		self::getInstance();
		if (SHOW_DEFINED_FUNCTION) {
			$defined_function=get_defined_functions();
			//var_dump($defined_function['user']);
			foreach ($defined_function['user'] as $key => $value) {
				self::$error_report['defined_function'][]=$value;
			}
            return true;
		}else {
			return 'SHOW_DEFINED_FUNCTION off';
		}
	}
	
	/**
	 * @doc 显示已经被定义的用户常量
	 * @return string
	 * @author Heanes
	 * @time 2015-04-28 23:09:18
	 */
	public static  function show_defined_constants() {
		self::getInstance();
		if (SHOW_DEFINED_CONSTANT_USER) {
			$defined_constant=get_defined_constants(true);
			foreach ($defined_constant['user'] as $key => $value) {
				self::$error_report['defined_constant'][$key]=$value;
			}
            return true;
		}else {
			return 'SHOW_DEFINED_CONSTANT_USER off';
		}
	}
	
	/**
	 * @doc 显示函数调用追踪
     * @param integer $deep 显示深度
	 * @return string
	 * @author Heanes
	 * @time 2015-04-28 23:09:39
	 */
	public static function get_caller_info($deep=0) {
		self::getInstance ();
		$bt = debug_backtrace (DEBUG_BACKTRACE_PROVIDE_OBJECT,0);
		//var_dump($bt);
		//echo ('Backtrace (most recent call last):<br /><br />');
		$real_deep=count($bt);
		$html='';
		for($i = $real_deep-1; $i > 0; $i--) {
			if (isset($bt[$i]['file'])){
				if ($i==$real_deep-1) {
					$html.= 'File: ' . $bt[$i]['file'];
				}else{
					$space= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$html.= (str_repeat($space,$real_deep-$i-1).'File: ' . $bt[$i]['file']);
				}
			}else {
				$html.= '[PHP core called function]';
				}

			if (isset($bt[$i]['line'])){
				if ($i==$real_deep-1) {
					$html .= ' -> Line: ' . $bt[$i]['line'].'';
				}else {
					$tab='&nbsp;&nbsp;';
					$html.= ' -> Line: ' . $bt[$i]['line'];
				}
			}
			if ($i>0&&$i<$real_deep-1) {
				$html.= (' -> Call Function: '.$bt[$i+1]['function'].'(');
			}else {
				$html.=' ';
			}

			if ($bt[$i]['args']) {
				$args_num=count($bt[$i]['args']);
				for($j = 0; $j <= $args_num - 1; $j ++) {
					if (is_array ( $bt [$i]['args'] [$j] )) {
						$html.= gettype( $bt [$i]['args'] [$j] );
					} else{
						$html.= gettype($bt [$i]['args'] [$j]);
					}

					if ($j != count($bt[$i]['args'] ) - 1){
						$html.= (", ");
					}
				}
				$html.=')<br />';
			}else {
				$html.='<br />';
			}
			//echo 'aaaa'.$html;
			//self::$error_report['debug_backtrace']=$html;

/*
 D:\WEB\Workspace\Php\Work\heanes.com\index\index.php:(
 	D:\WEB\Workspace\Php\Work\heanes.com\core\framework\core\Base.class.php:run(
 		D:\WEB\Workspace\Php\Work\heanes.com\core\framework\core\Base.class.php:control(
 			D:\WEB\Workspace\Php\Work\heanes.com\index\controller\IndexController.class.php:indexOp(
 				D:\WEB\Workspace\Php\Work\heanes.com\data\model\ArticleModel.class.php:getArticleList(args: , )
 					D:\WEB\Workspace\Php\Work\heanes.com\core\framework\db\driver\mysqli\mysqli.class.php:query(
 						 args: SELECT * FROM `heanes.com`.`pre_article`, slave)

 */
			//echo ("<br /><br />");
		}
		//echo $html;
		
		$c = '';
		$file = '';
		$func = '';
		$class = '';
		$trace = debug_backtrace ();
		if (isset($trace[2])) {
			$file = $trace[1]['file'];
			$func = $trace[2]['function'];
			if ((substr($func, 0, 7 ) == 'include') || (substr($func, 0, 7 ) == 'require')) {
				$func = '';
			}
		} else if (isset($trace [1] )) {
			$file = $trace [1]['file'];
			$func = '';
		}
		if (isset($trace[3]['class'] )) {
			$class = $trace[3]['class'];
			$func = $trace[3]['function'];
			$file = $trace[2]['file'];
		} else if (isset($trace[2]['class'])) {
			$class = $trace[2]['class'];
			$func = $trace[2]['function'];
			$file = $trace[1]['file'];
		}
		if ($file != '')
			$file = basename( $file );
		$c = $file . ":";
		$c .= ($class != '') ? ":" . $class . "->" : "";
		$c .= ($func != '') ? $func . "(): " : "";
		return ($c);
	}
	
}