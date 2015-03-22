<?php
/**
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-22 18:08:15
 * @doc 管理后台入口
 */
define('PATH_ABS_BASE_APP',str_replace('\\','/',dirname(__FILE__)).'/');
if (!include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!include(PATH_ABS_BASE_CORE.'/heanes.php')) exit('heanes.php isn\'t exists!');
if (!include(PATH_ABS_BASE_APP.'/control/control.class.php')) exit('control.class.php isn\'t exists!');
Base::run();