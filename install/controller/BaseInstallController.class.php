<?php
/**
 * @doc 安装程序基础控制类
 * @filesource BaseInstallController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-11 22:59:59
 */
defined('InHeanes') or exit('Access Invalid!');
class BaseInstallController {
	function __construct() {
		//echo __METHOD__.'</br>';
		//从数据库中获取模版设置，并设置到模版中
		Tpl::setTemplateDir('default');
		Tpl::setLayout('layout/defaultCommonLayout');
		//print_arr(get_defined_constants());
		//定义域名形式的资源文件路径，以供生成静态html文件
		//define('TPL', Server::get_host(false).PATH_BASE_ROOT .APP_ID.DS.Tpl::getTemplateDir());
		// 当前app下模版公共量
		//设置模版常量，方便模版中获取路径
		define('TPL', TPL::$TPL);
		// 对目录下文件的处理：删去和创建空白index.html文件，处理模版后缀名
		//$ignore_dir=array('.git','.svn','.settings','libs');
		//print_arr(File::getDirList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//print_arr(File::getFileList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//File::deleteFile(PATH_ABS_BASE_ROOT,'index.html',$ignore_dir);
		//File::newFile(PATH_ABS_BASE_WAP,'index.html',$ignore_dir);

		$file_ignore=array('Index.html');
		//File::fileRename(TPL::getTemplateDir(),'html','tpl.php',$file_ignore,$ignore_dir);
		//File::fileRename(TPL::getTemplateDir(),'php','',$ignore_dir,$file_ignore,true);
		//File::fileRename(TPL::getTemplateDir(),'tpl','html',$ignore_dir,$file_ignore);
		//File::fileRename(TPL::getTemplateDir(),'html','',$ignore_dir,$file_ignore);
	}
	
	function __destruct() {
		//echo __METHOD__.'</br>';
	}
}