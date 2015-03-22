<?php
/**
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-13 15:49:02
 * @doc 前台首页入口
 */
define('APP_ID','index');
define('PATH_ABS_BASE_APP',str_replace('\\','/',dirname(__FILE__)).'/');
if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!@include(PATH_ABS_BASE_CORE.'heanes.php')) exit('heanes.php isn\'t exists!');
if (!@include(PATH_ABS_BASE_APP.'control/control.class.php')) exit('control.class.php isn\'t exists!');
//print_constants('user');
//foreach_arr($_GET);
//foreach_arr(get_required_files());
//foreach_arr(get_included_files());
Base::run(); 