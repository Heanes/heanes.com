<?php
/**
 * @doc 手机端基础控制器
 * @filesource BaseWapController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.05.22 10:49:47
 */
defined('InHeanes') or exit('Access Invalid!');
class BaseWapController extends AuthController{

	public function __construct() {
		parent::__construct();
		//echo __METHOD__.'<br />';
		// 当前app下模版公共量
		Tpl::setTemplateDir('jinlehui');
		Tpl::setLayout('layout/defaultCommonLayout');
		//定义域名形式的资源文件路径，以供生成静态html文件
		//define('TPL', Server::get_host(false).PATH_BASE_ROOT .APP_ID.DS.Tpl::getTemplateDir());
		define('TPL', Tpl::getTemplateDir());
		define('TPL_HREF',Tpl::$TPL);
		$output['html_title'] = isset($output['html_title']) && $output['html_title']!='' ? $output['html_title'] : '金乐汇';
		$output['seo_keywords'] =  isset($output['seo_keywords']) && $output['seo_keywords']!='' ? $output['seo_keywords'] : '金乐汇';
		$output['seo_description'] =  isset($output['seo_description']) && $output['seo_description']!='' ? $output['seo_description'] : '金乐汇';
		Tpl::assign('html_title',$output['html_title']);
		Tpl::assign('seo_keywords',$output['seo_keywords']);
		Tpl::assign('seo_description',$output['seo_description']);
		//设置版本，添加到css及js文件后缀中去，强制用户刷新资源文件
		Tpl::assign('web_version','1.0.1.002_20050910');

		//Seo信息设置
		$seoModel=Model('Seo');
		$seoArray=$seoModel->getSEO();
		Tpl::setOutput($seoArray);

		//导航菜单
		Tpl::assign('wapNavigationList',$this->getWapNavigation());

		// 对目录下文件的处理：删去和创建空白index.html文件，处理模版后缀名
		$ignore_dir=array('.git','.svn','.settings','libs','js','css');
		//print_arr(File::getDirList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//print_arr(File::getFileList(PATH_ABS_BASE_ROOT,$ignore_dir));
		//File::deleteFile(PATH_ABS_BASE_ROOT,'index.html',$ignore_dir);
		//File::newFile(PATH_ABS_BASE_WAP,'index.html',$ignore_dir);
		
		$file_ignore=array('Index.html');
		//File::fileRename(TPL::getTemplateDir(),'html','tpl.php',$file_ignore,$ignore_dir);
		//File::fileRename(TPL::getTemplateDir(),'php','',$ignore_dir,$file_ignore,true);
		//File::fileRename(TPL::getTemplateDir(),'tpl','html',$ignore_dir,$file_ignore);
		//File::fileRename(TPL::getTemplateDir(),'html','',$ignore_dir,$file_ignore);
		if(isset($_GET['redirect'])){
			$_SESSION['redirect']=$_GET['redirect'];
		}
		if(!$this->checkBrowser()){
			//Tpl::display('layout/pleaseUseWebChat');
			//exit;
		}
	}

	/**
	 * @doc 获取手机端导航链接
	 * @author Heanes
	 * @time 2015-08-18 09:05:36
	 */
	protected function getWapNavigation() {
		$wapNavigationModel=Model('navigation_wap');
		$wapNavigationParam['where']="`is_enable`=1 AND `is_delete`=0";
		$wapNavigationParam['order']=array('order'=>'ASC');
		$wapNavigationParam['limit']=5;
		$wapNavigationList=$wapNavigationModel->getList($wapNavigationParam);
		//处理导航链接选中样式
		foreach ($wapNavigationList as $key => $wapNavigation) {
			$wapNavigationList[$key]['href_in_hover']=explode(',',$wapNavigation['href_in_hover']);
		}
		return $wapNavigationList;
	}

	/**
	 * @doc 检测登录状态
	 * @return bool
	 * @author Heanes
	 * @time 2015-06-24 17:08:40
	 */
	public function checkLogin(){
		if(isset($_SESSION['user_id']) && isset($_SESSION['is_login']) && $_SESSION['is_login']==1){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * @doc 需要登录及所需操作
	 * @author Heanes
	 * @time 2015-06-24 17:10:49
	 */
	protected function needLogin(){
		if(!$this->checkLogin() && $_SERVER['QUERY_STRING']!='act=member&op=login'  && $_SERVER['QUERY_STRING']!='act=member&op=reg'){
			$redirect=empty($_SERVER['HTTP_REFERER']) ? '' : '&redirect='.urlencode($_SERVER['HTTP_REFERER']);
			redirect_php_header('index.php?act=member&op=login'.$redirect);
		}
	}

	/**
	 * @doc 获取菜单
	 * @author Heanes
	 * @time 2015-06-18 09:04:54
	 */
	public function getMenuOp(){
		Tpl::display('menu/menuDefaultStyle');
	}

	/**
	 * @doc 检测浏览器
	 * @return bool
	 * @author Heanes
	 * @time 2015-08-01 11:22:27
	 */
	protected function checkBrowser(){
		if(is_weixin()){
			return true;
		}else{
			return false;
		}
	}
}

/**
 * @doc 权限控制器
 * @author Heanes
 * @time 2015-07-21 17:39:23
 */
class AuthController{
	public function __construct(){
		//parent::__construct();
	}

	/**
	 * @doc 角色权限检测
	 * @author Heanes
	 * @time 2015-07-20 15:48:44
	 */
	public function checkRoleOp(){
		//1.获取用户信息
		$userModel = Model('users');
		$userParam['where'] = "`id`='".$_SESSION['user_id']."'";
		$userInfo = $userModel->getOneByID($_SESSION['user_id']);
		//2.根据用户信息中的角色ID获取角色信息
		$userRoleModel = Model('user_role');
		$userRoleInfo = $userRoleModel->getOneByID($userInfo['role_id']);
		//3.根据角色ID获取所有权限
		$privilegeModel = Model('user_privilege');
		$privilegeParam['where'] = "`role_id`='".$userRoleInfo['id']."'";
		$privilegeList = $privilegeModel->getList($privilegeParam);
		//4.根据权限获取所有可操作URL
		$actClass = $_GET['act'];
		$opMethod = $_GET['op'];
		$actFlag=false;
		$opFlag=false;
		$privilegeUrlModel = Model('privilege_url');
		foreach ($privilegeList as $key => $privilege) {
			$privilegeUrl=$privilegeUrlModel->getOneByID($privilege['privilege_id']);
			$privilegeList[$key]['_url'] = $privilegeUrl;
			if($actClass==$privilegeUrl['class']){
				$actFlag=true;
				if($opMethod==$privilegeUrl['method'] || $opMethod=='index'){
					$opFlag=true;
				}
			}
		}
		if ($actFlag && $opFlag) {
			return true;
		}else {
			showError('权限不足');
			return false;
		}
	}

	/**
	 * @doc 返回允许的操作菜单
	 * @return mixed array|null
	 * @author Heanes
	 * @time 2015-07-22 09:27:13
	 */
	public function getAllowableMenuOp(){
		//1.获取用户信息
		$userModel = Model('users');
		$userParam['where'] = "`id`='".$_SESSION['user_id']."'";
		$userInfo = $userModel->getOneByID($_SESSION['user_id']);
		//2.根据用户信息中的角色ID获取角色信息
		$userRoleModel = Model('user_role');
		$userRoleInfo = $userRoleModel->getOneByID($userInfo['role_id']);
		//3.根据角色ID获取所有权限
		$privilegeModel = Model('user_privilege');
		$privilegeParam['where'] = "`role_id`='".$userRoleInfo['id']."'";
		$privilegeList = $privilegeModel->getList($privilegeParam);
		//4.根据权限获取所有可操作URL
		$privilegeUrlModel = Model('privilege_url');
		foreach ($privilegeList as $key => $privilege) {
			//$privilegeUrl=$privilegeUrlModel->getOneByID($privilege['privilege_id']);
			$privilegeList[$key]['_url'] = $privilegeUrlModel->getOneByID($privilege['privilege_id']);
		}
		return $privilegeList;
	}
}