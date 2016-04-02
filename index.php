<?php
/**
 * @doc 首页入口文件
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-09 14:22:42
 */


/**
 * ---------------------------定义系统相关环境常量-----------------------------
 * @doc定义系统相关环境常量
 * @author 方刚
 * @time 2015-02-13 14:09:46重写此文件
 */
define('DS','/');								//定义【跨平台常量，简化文件夹路径分隔符，windows特有的分隔符为‘\’，浏览器端为‘/’】符号
//define('DS_WINDOWS','\\');					//定义【跨平台常量，操作系统路径分隔符，Windows特有路径分隔符‘\’,两个\\为前面一个为转义】符号
define('DS_S',DIRECTORY_SEPARATOR);				//定义【跨平台常量，操作系统路径分隔符，Windows特有路径分隔符‘\’,Linux为‘/’】符号
//资源文件存放路径设置
define('PATH_SYS_CORE',			'core');		//定义【系统核心资源文件】路径
define('PATH_SYS_DATA',			'data');		//定义【系统数据存储】路径





$site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/wap/index.php');
@header('Location: '.$site_url);