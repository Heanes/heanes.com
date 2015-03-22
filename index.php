<?php
/**
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-09 14:22:42
 * @doc 首页入口文件
 */
$site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/index/index.php');
@header('Location: '.$site_url);