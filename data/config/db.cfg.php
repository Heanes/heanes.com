<?php
/**
 * @doc 主要配置文件，数据库配置，时区配置
 * @author 方刚
 * @time 2014.06.03 13:31:08
 */
defined('InHeanes') or exit('Access Denied');

$_config=array();

/** 
 * 数据库配置部分
 */
// database host 数据库主机地址
$_config['db']['1']['dbhost']	= 'localhost';
// database username 数据库账户用户名
$_config['db']['1']['dbuser']	= 'web_user_heanes.com';
// database password 数据库账户密码
$_config['db']['1']['dbpwd']	= 'p()P]aHqCEfwVY@7';
// database name 数据库名称
$_config['db']['1']['dbname']	= 'heanes.com';
// database port 数据库端口
$_config['db']['1']['dbport']	= '3306';
// table prefix 数据库表前缀，此设计是考虑到一个数据库中安装多个网站系统避免冲突
$_config['db']['1']['tablepre'] = 'pre_';
// 数据库编码
$_config['db'][1]['dbcharset']  = 'UTF-8';
// 主从数据库配置
$_config['db']['slave'] = array();
