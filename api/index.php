<?php
/**
 * @doc 前台首页入口
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2016-06-07 14:14:10 周二
 */
define('REQUEST_TIME', microtime(true));
define('APP_ID','api');
define('PATH_ABS_BASE_APP',str_replace('\\','/',dirname(__FILE__)).'/');
if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');

define('PATH_BASE_APP',PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'',PATH_ABS_BASE_APP));

if (!@include(PATH_ABS_BASE_CORE.'heanes.php')) exit('heanes.php isn\'t exists!');
if (!@include(PATH_ABS_BASE_APP.'controller/BaseAPIController.class.php')) exit('BaseIndexController.class.php isn\'t exists!');

Base::run();
//Debug::display_debug();