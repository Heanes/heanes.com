<?php
/**
 * @doc 调试配置
 * @filesource debug.cfg.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-01 15:59:32
 */

/**
 * @doc Debug调试开关
 * @var boolean
 */
!defined('DEBUG_ON') ? define('DEBUG_ON', true) : null;

/**
 * @doc 是否显示系统错误报告提示信息
 * @var boolean
 */
define('SHOW_ERROR_REPORT', true);

/**
 * @doc 是否显示抛出的异常语句
 * @var boolean
 */
define('SHOW_EXCEPTION', true);

/**
 * @doc 出现异常是否直接退出
 * @var boolean
 */
define('IGNORE_EXCEPTION', true);

/**
 * @doc 是否显示数据库操作语句
 * @var boolean
 */
define('SHOW_SQL', true);

/**
 * @doc 是否显示包含文件
 * @var boolean
 */
define('SHOW_INCLUDED_FILE', true);


/**
 * @doc 是否显示定义过的用户函数
 * @var boolean
 */
define('SHOW_DEFINED_FUNCTION', false);

/**
 * @doc 是否显示定义过的常量
 * @var boolean
 */
define('SHOW_DEFINED_CONSTANT_USER', true);

//set_error_handler('php_error', E_ALL); //函数名，收集的错误级别
/*
function php_error($errno, $errstr, $errfile, $errline){ //错误编号，错误信息，错误文件，错误行号
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
	echo "<b>$errortype[$errno]: </b> $errstr <br/>\n<b>File ($errline):</b> $errfile <br>\n"; //输出错误信息
}
*/