<?php
/**
 * @filesource heanes.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-13 10:05:48
 * @doc 前后连接核心文件
 */
defined('InHeanes') or exit('Access Invalid!');

/**
 * @doc 内核框架版本
 * @var string
 */
define('H_VERSION', '1.0.0');

/**
 * @doc 系统初始化时就开启调试功能
 * @time 2015-01-13 10:05:48
 */
require (PATH_ABS_BASE_CORE.'framework/core/Debug.class.php');
Debug::error_report();
//var_dump(Debug::get_caller_info());

/**
 * @doc 系统初始化时就开启计时器
 * @time 2015-01-13 10:05:48
 */
require (PATH_ABS_BASE_CORE.'framework/core/Timer.class.php');
Timer::mark('total_execution_time_start');

/**
 * @doc 系统初始化时就初始化php运行环境
 * @time 2015-01-13 10:05:48
 */
require (PATH_ABS_BASE_CORE.'framework/core/Runtime.class.php');
Runtime::set_environment();

