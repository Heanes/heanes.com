<?php
/**
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-22 18:08:15
 * @doc 管理后台入口
 */
define('APP_ID','admin');
define('PATH_ABS_BASE_APP',str_replace('\\','/',dirname(__FILE__)).'/');
if (!include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
define('PATH_BASE_APP',PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'',PATH_ABS_BASE_APP));

if (!include(PATH_ABS_BASE_CORE.'/heanes.php')) exit('heanes.php isn\'t exists!');
if (!include(PATH_ABS_BASE_APP.'/controller/BaseAdminController.class.php')) exit('BaseAdminControl.class.php isn\'t exists!');
Base::run();
Debug::display_debug();