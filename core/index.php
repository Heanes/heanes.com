<?php
/**
 * @doc 
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-11 12:26:48
 */

define('APP_ID','core');
define('PATH_ABS_BASE_APP',str_replace('\\','/',dirname(__FILE__)).'/');
if (!@include(PATH_ABS_BASE_APP.'global.php')) exit('global.php isn\'t exists!');

var_dump(get_defined_constants(true)['user']);
define('PATH_BASE_APP',PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'',PATH_ABS_BASE_APP));

if (!@include(PATH_ABS_BASE_CORE.'heanes.php')) exit('heanes.php isn\'t exists!');
if (!@include(PATH_ABS_BASE_APP.'controller/BaseCoreController.class.php')) exit('BaseCoreController.class.php isn\'t exists!');
Base::run();
Debug::display_debug();
