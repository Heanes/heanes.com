<?php
/**
 * @doc 全局公用常量定义文件（多应用模式）
 * @filesource global.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-14:07:47
 */

//定义此常量，判定是正常流程访问；
define('InHeanes',true);

/*
//APP应用文件路径
define('PATH_APP_ADMIN',		'admin');		//定义【系统admin管理后台】APP路径
define('PATH_APP_MOBILE',		'wap');			//定义【系统mobile/wap手机端】APP路径
define('PATH_APP_MEMBER',		'member');		//定义【系统member/user会员中心】APP路径
define('PATH_APP_CMS',			'cms');			//定义【系统CMS文章】APP路径
define('PATH_APP_CIRCLE',		'circle');		//定义【系统circle圈子】APP路径
define('PATH_APP_SNS',			'sns');			//定义【系统SNS短动态发布】APP路径
define('PATH_APP_BLOG',			'blog');		//定义【系统blog博客】APP路径
define('PATH_APP_INDEX',		'index');		//定义【系统index起始内容】APP路径
define('PATH_APP_DEFAULT',		PATH_APP_INDEX);//定义【系统默认起始APP】绝对路径
*/
/**
 * ---------------------------定义系统相关环境常量-----------------------------
 * @doc定义系统相关环境常量 2015-06-29 22:30:33
 * @author 方刚
 * @time 2015-02-13 14:09:46重写此文件
 */
define('DS','/');								//定义【跨平台常量，简化文件夹路径分隔符，windows特有的分隔符为‘\’，浏览器端为‘/’】符号
//define('DS_WINDOWS','\\');					//定义【跨平台常量，操作系统路径分隔符，Windows特有路径分隔符‘\’,两个\\为前面一个为转义】符号
define('DS_S',DIRECTORY_SEPARATOR);				//定义【跨平台常量，操作系统路径分隔符，Windows特有路径分隔符‘\’,Linux为‘/’】符号
//资源文件存放路径设置
define('PATH_SYS_CORE',			'core');		//定义【系统核心资源文件】路径
define('PATH_SYS_DATA',			'data');		//定义【系统数据存储】路径
define('PATH_SYS_PUBLIC',		'public');		//定义【系统数据存储】路径

/*
define('PATH_SYS_LANGUAGE',		'language');	//定义【系统语言包存储】路径
define('PATH_SYS_INSTALL',		'install');		//定义【系统初始安装文件】路径
define('PATH_SYS_STATIC',		'static');		//定义【系统静态资源存放】路径
define('PATH_SYS_DYNAMIC',		'dynamic');		//定义【系统动态资源存放】路径
define('PATH_SYS_API',			'api');			//定义【系统API出入口】路径
*/
/**
 * ---------------------------定义路径常量-----------------------------
 * @doc定义目录路径，带PATH的常量表示路径，PATH_ABS前缀的为绝对路径，PATH前缀的为相对路径，所有路径常量都必须以/结尾
 * @author 方刚
 * @time 2015-02-13 14:09:46重写此文件
 * @time 2015-05-09 14:37:55重写此文件
 */
/******************************绝对路径形式******************************/
//--初始网站路径相关
define('PATH_ABS_GLOBAL_FILE',		str_replace(DS_S , DS , __FILE__));					//定义【global文件完整路径】绝对路径
define('PATH_ABS_GLOBAL_DIR',		str_replace(DS_S , DS , dirname(__FILE__)) 	.DS);	//定义【global文件】绝对路径
define('PATH_ABS_BASE_ROOT',		str_replace(DS_S , DS , dirname(__FILE__)) 	.DS);	//定义【当前文件，此时为网站根目录】绝对路径
define('PATH_ABS_BASE_DIR',			dirname(PATH_ABS_BASE_ROOT)					.DS);	//定义【存放网站全部文件】绝对路径
//--|--代码资源
define('PATH_ABS_BASE_CORE',		PATH_ABS_BASE_ROOT. PATH_SYS_CORE			.DS);	//定义【系统核心文件夹】绝对路径
define('PATH_ABS_BASE_DATA',		PATH_ABS_BASE_ROOT. PATH_SYS_DATA			.DS);	//定义【系统数据文件夹】绝对路径
define('PATH_ABS_SYS_FILE_UPLOAD',	PATH_ABS_BASE_DATA.'upload'					.DS);	//定义【系统文件上传存储】路径
define('PATH_ABS_BASE_PUBLIC',		PATH_ABS_BASE_ROOT. PATH_SYS_PUBLIC			.DS);	//定义【系统数据文件夹】绝对路径


/*
define('PATH_ABS_BASE_INSTALL',		PATH_ABS_BASE_ROOT.	PATH_SYS_INSTALL	.DS);	//定义【网站初始安装程序文件】绝对路径
define('PATH_ABS_BASE_STATIC',		PATH_ABS_BASE_ROOT.	PATH_SYS_STATIC		.DS);	//定义【网站静态资源文件】绝对路径
define('PATH_ABS_BASE_DYNAMIC',		PATH_ABS_BASE_ROOT.	PATH_SYS_DYNAMIC	.DS);	//定义【网站动态资源文件所在目录（做缓存用）】绝对路径
*/
/*
//--|--|--APP层次目录
define('PATH_ABS_BASE_INDEX',		PATH_ABS_BASE_ROOT.	PATH_APP_INDEX		.DS);	//定义【网站主前端页面程序文件】绝对路径
define('PATH_ABS_BASE_WAP',			PATH_ABS_BASE_ROOT.	PATH_APP_MOBILE		.DS);	//定义【网站手机端页面程序文件】绝对路径
define('PATH_ABS_BASE_ADMIN',		PATH_ABS_BASE_ROOT.	PATH_APP_ADMIN		.DS);	//定义【网站后台管理程序文件】绝对路径
define('PATH_ABS_BASE_MEMBER',		PATH_ABS_BASE_ROOT.	PATH_APP_MEMBER		.DS);	//定义【网站会员中心程序文件】绝对路径
define('PATH_ABS_BASE_CMS',			PATH_ABS_BASE_ROOT.	PATH_APP_CMS		.DS);	//定义【网站CMS程序文件】绝对路径
define('PATH_ABS_BASE_CIRCLE',		PATH_ABS_BASE_ROOT.	PATH_APP_CIRCLE		.DS);	//定义【网站cirlce圈子程序文件】绝对路径
*/
/*
//--|--|--|--APP模版主题存储路径相关
define('PATH_ABS_BASE_TPL',			PATH_ABS_BASE_INDEX		.'template/');			//定义【网站存放前台所有主题文件夹】绝对路径
define('PATH_ABS_BASE_TPL_ADMIN',	PATH_ABS_BASE_ADMIN		.'template/');			//定义【网站存放admin后台所有主题文件夹】绝对路径
define('PATH_ABS_BASE_TPL_MEMBER',	PATH_ABS_BASE_MEMBER	.'template/');			//定义【网站存放member会员所有主题文件夹】绝对路径
define('PATH_ABS_BASE_TPL_CMS',		PATH_ABS_BASE_CMS		.'template/');			//定义【网站存放cms内容管理所有主题文件夹】绝对路径
define('PATH_ABS_BASE_TPL_CIRCLE',	PATH_ABS_BASE_CIRCLE	.'template/');			//定义【网站存放圈子circle所有主题文件夹】绝对路径
*/

/******************************相对路径形式******************************/
//--初始网站路径相关
//define('PATH_BASE_FOLDER',		DS.substr(dirname(__FILE__),strrpos(dirname(__FILE__),"\\")+1,strlen(dirname(__FILE__))-strrpos(dirname(__FILE__),"\\")).DS);//定义【当前文件自身所在的实际目录】相对路径，方式一
define('PATH_BASE_FOLDER',			DS.str_replace(PATH_ABS_BASE_DIR ,'', PATH_ABS_BASE_ROOT));					//定义【当前文件自身所在的实际目录】相对路径，方式二
define('PATH_CURRENT_DIR', 			str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']));//定义【系统当前资源目录（根据PHP内部常量获取），网站根目录路径】相对路径
define('PATH_BASE_ROOT',			str_replace(APP_ID.DS ,'', PATH_CURRENT_DIR));								//定义【系统根目录】相对形式
define('PATH_BASE_DATA',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_DATA));	//定义【系统数据文件夹】相对路径
define('PATH_BASE_FILE_UPLOAD',		PATH_BASE_DATA.'upload'					.DS);	//定义【系统文件上传存储】路径
define('PATH_BASE_PUBLIC',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_PUBLIC));	//定义【系统文件上传存储】路径













/*
//--|--代码资源
define('PATH_BASE_CORE',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_CORE));	//定义【系统核心文件夹】相对路径
define('PATH_BASE_INSTALL',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_INSTALL));	//定义【网站初始安装程序文件】相对路径
define('PATH_BASE_STATIC',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_STATIC));	//定义【网站静态资源文件】相对路径
define('PATH_BASE_DYNAMIC',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_DYNAMIC));	//定义【网站动态资源文件（做缓存用）】相对路径
*/
/*
//--|--|--APP层次目录
define('PATH_BASE_INDEX',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_INDEX));	//定义【网站主前端页面程序文件】相对路径
define('PATH_BASE_WAP',				PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_WAP));		//定义【网站手机端页面程序文件】相对路径
define('PATH_BASE_ADMIN',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_ADMIN));	//定义【网站后台管理程序文件】相对路径
define('PATH_BASE_MEMBER',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_MEMBER));	//定义【网站会员中心程序文件】相对路径
define('PATH_BASE_CMS',				PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_CMS));		//定义【网站CMS程序文件】相对路径
define('PATH_BASE_CIRCLE',			PATH_BASE_ROOT.str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_CIRCLE));	//定义【网站circle圈子程序文件】相对路径
//--|--|--|--APP模版主题相关
define('PATH_BASE_TPL_INDEX',		str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_TPL));					//定义【网站存放前台所有主题文件夹】相对路径
define('PATH_BASE_TPL_ADMIN',		str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_TPL_ADMIN));				//定义【网站存放admin后台所有主题文件夹】相对路径
define('PATH_BASE_TPL_MEMBER',		str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_TPL_MEMBER));				//定义【网站存放member会员所有主题文件夹】相对路径
define('PATH_BASE_TPL_CMS',			str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_TPL_CMS));				//定义【网站存放cms内容管理所有主题文件夹】相对路径
define('PATH_BASE_TPL_CIRCLE',		str_replace(PATH_ABS_BASE_ROOT ,'', PATH_ABS_BASE_TPL_CIRCLE));				//定义【网站存放圈子circle所有主题文件夹】相对路径
*/


/*
//--|--|--|--|--APP模版主题默认配置
define('NAME_TPL_INDEX_DEFAULT',	'default');													//定义【前台默认模版】模版名称
define('NAME_TPL_ADMIN_DEFAULT',	'default');													//定义【管理后台默认模版】模版名称
define('NAME_TPL_MEMBER_DEFAULT',	'default');													//定义【会员中心默认模版】模版名称
define('PATH_TPL_INDEX_DEFAULT',	PATH_BASE_TPL_INDEX	.NAME_TPL_INDEX_DEFAULT		.DS);		//定义【前台默认模版】绝对路径
define('PATH_TPL_ADMIN_DEFAULT',	PATH_BASE_TPL_ADMIN	.NAME_TPL_ADMIN_DEFAULT		.DS);		//定义【管理后台默认模版】绝对路径
define('PATH_TPL_MEMBER_DEFAULT',	PATH_BASE_TPL_MEMBER.NAME_TPL_MEMBER_DEFAULT	.DS);		//定义【会员中心默认模版】绝对路径
*/