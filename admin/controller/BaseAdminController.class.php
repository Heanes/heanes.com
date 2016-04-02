<?php
/**
 * @filesource BaseAdminController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-13 16:28:09
 * @doc 管理后台总调度文件
 */
defined('InHeanes') or exit('Access Invalid!');
@include_once PATH_ABS_BASE_CORE.'framework/core/Controller.class.php';
class BaseAdminController extends Controller{
	function __construct($modelName=''){
		parent::__construct($modelName='');
		//echo __METHOD__.'</br>';

		//parent::__construct($model_name='');

		//从数据库中获取模版设置，并设置到模版中
		Tpl::setTemplateDir('default');
		Tpl::setLayout('layout/adminFrameMainContentLayout');
		//设置模版常量，方便模版中获取路径
		define('TPL', Tpl::getTemplateDir());
		//define('TPL', Server::get_host(false).PATH_BASE_ROOT .APP_ID.DS.Tpl::getTemplateDir());
		define('TPL_HREF',Tpl::$TPL);
		$output['html_title'] = isset($output['html_title']) && $output['html_title'] != '' ? $output['html_title'] : '后台管理-金乐汇';
		$output['seo_keywords'] = isset($output['seo_keywords']) && $output['seo_keywords'] != '' ? $output['seo_keywords'] : '后台管理-金乐汇';
		$output['seo_description'] = isset($output['seo_description']) && $output['seo_description'] != '' ? $output['seo_description'] : '后台管理-金乐汇';
		Tpl::assign('html_title', $output['html_title']);
		Tpl::assign('seo_keywords', $output['seo_keywords']);
		Tpl::assign('seo_description', $output['seo_description']);

		// 对目录下文件的处理：删去和创建空白index.html文件，处理模版后缀名
		$ignore_dir = array('.git', '.svn', '.settings', 'libs', 'js', 'css');
		//print_arr(File::getDirList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//print_arr(File::getFileList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//File::deleteFile(PATH_ABS_BASE_ROOT,'index.html',$ignore_dir);
		//File::newFile(PATH_ABS_BASE_WAP,'index.html',$ignore_dir);

		$file_ignore = array('Index.html');
		//File::fileRename(TPL::getTemplateDir(),'html','tpl.php',$file_ignore,$ignore_dir);
		//File::fileRename(TPL::getTemplateDir(),'php','',$ignore_dir,$file_ignore,true);
		//File::fileRename(TPL::getTemplateDir(),'tpl','html',$ignore_dir,$file_ignore);
		//File::fileRename(TPL::getTemplateDir(),'html','',$ignore_dir,$file_ignore);
		$this->needLogin();
	}

	/**
	 * @doc 检测登录状态
	 * @return bool
	 * @author Heanes
	 * @time 2015-06-24 17:08:40
	 */
	public function checkLogin(){
		if (isset($_SESSION['admin_user_id']) && isset($_SESSION['admin_is_login']) && $_SESSION['admin_is_login'] == 1) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @doc 需要登录及所需操作
	 * @author Heanes
	 * @time 2015-06-24 17:10:49
	 */
	public function needLogin(){
		if (!$this->checkLogin() && $_SERVER['QUERY_STRING']!='act=AdminUser&op=login') {
			redirect_php_header('index.php?act=AdminUser&op=login');
		}
	}

	/**
	 * @doc 编辑器文件上传处理函数
	 * @author Heanes
	 * @time 2015-07-05 18:37:01
	 */
	public function editorUploadOp(){
		require(PATH_ABS_BASE_PUBLIC.'include/editor/kindEditor/php/upload_json.php');
	}

	/**
	 * @doc 编辑器文件管理函数
	 * @author Heanes
	 * @time 2015-07-05 18:37:27
	 */
	public function editorFileManagerJsonOp(){
		require(PATH_ABS_BASE_PUBLIC.'include/editor/kindEditor/php/file_manager_json.php');
	}

}