<?php
/**
 * @filesource global.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-1314:07:47
 * @doc 全局公用文件
 */

//定义此常量，判定是正常流程访问；
define('InHeanes',true);
/**
 * ---------------------------定义环境常量-----------------------------
 * @doc定义服务器相关环境常量
 * @author 方刚
 * @time 2015-02-13 14:09:46重写此文件
 */
define('DS','/');//简化文件夹路径分隔符，windows特有的分隔符为‘\’，浏览器端为‘/’
define('DS_W','\\');//Windows特有路径分隔符‘\’,两个\\为前面一个为转义
/**
 * ---------------------------定义路径常量-----------------------------
 * @doc定义目录路径，带PATH的常量表示路径，PATH_ABS前缀的为绝对路径，PATH前缀的为相对路径，所有路径常量都必须以/结尾
 * @author 方刚
 * @time 2015-02-13 14:09:46重写此文件
 */
/***********绝对形式**********/
//--初始网站路径相关
define('PATH_ABS_BASE_ROOT',str_replace(DS_W,DS,dirname(__FILE__)).DS);//当前文件所在目录，此时为网站根目录
define('PATH_ABS_BASE_CORE',PATH_ABS_BASE_ROOT.'core/');//核心文件夹所在目录
define('PATH_ABS_BASE_DATA',PATH_ABS_BASE_ROOT.'data/');//数据文件夹所在目录
//----非必要定义
define('PATH_ABS_BASE_DIR',dirname(PATH_ABS_BASE_ROOT).DS);//网站总文件夹所在目录
//----代码资源
define('PATH_ABS_BASE_INSTALL',PATH_ABS_BASE_ROOT.'install/');//网站初始安装程序文件所在目录
define('PATH_ABS_BASE_STATIC',PATH_ABS_BASE_ROOT.'static/');//网站静态资源文件所在目录
define('PATH_ABS_BASE_DYNAMIC',PATH_ABS_BASE_ROOT.'dynamic/');//网站动态资源文件所在目录（做缓存用）
//层次目录
define('PATH_ABS_BASE_WAP',PATH_ABS_BASE_ROOT.'wap/');//网站手机端页面程序文件所在目录
define('PATH_ABS_BASE_ADMIN',PATH_ABS_BASE_ROOT.'admin/');//网站后台管理程序文件所在目录
define('PATH_ABS_BASE_MEMBER',PATH_ABS_BASE_ROOT.'member/');//网站会员中心程序文件所在目录
define('PATH_ABS_BASE_CMS',PATH_ABS_BASE_ROOT.'cms/');//网站CMS程序文件所在目录
define('PATH_ABS_BASE_CIRCLE',PATH_ABS_BASE_ROOT.'circle/');//网站用户圈子程序文件所在目录
//----主题相关
define('PATH_ABS_BASE_THEME',PATH_ABS_BASE_ROOT.'template/');//网站存放前台所有主题文件夹所在目录
define('PATH_ABS_BASE_THEME_ADMIN',PATH_ABS_BASE_ADMIN.'template/');//网站存放admin后台所有主题文件夹所在目录
define('PATH_ABS_BASE_THEME_MEMBER',PATH_ABS_BASE_MEMBER.'template/');//网站存放member会员所有主题文件夹所在目录
define('PATH_ABS_BASE_THEME_CMS',PATH_ABS_BASE_CMS.'template/');//网站存放cms内容管理所有主题文件夹所在目录
define('PATH_ABS_BASE_THEME_CIRCLE',PATH_ABS_BASE_CIRCLE.'template/');//网站存放圈子circle所有主题文件夹所在目录

/***********相对对形式**********/
//--初始网站路径相关
define('PATH_FOLDER',substr(dirname(__FILE__),strrpos(dirname(__FILE__),"\\")+1,strlen(dirname(__FILE__))-strrpos(dirname(__FILE__),"\\")).DS);//当前文件自身所在的实际目录，方式一
define('PATH_BASE_ROOT',str_replace(PATH_ABS_BASE_DIR,'',PATH_ABS_BASE_ROOT));//当前文件自身所在的实际目录，网站根目录路径的相对形式，方式二
define('PATH_BASE_CORE',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_CORE));//当前文件自身所在的实际目录，网站根目录路径的相对形式，方式二
define('PATH_BASE_DATA',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_DATA));//当前文件自身所在的实际目录，网站根目录路径的相对形式，方式二
//----代码资源
define('PATH_BASE_INSTALL',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_INSTALL));//网站初始安装程序文件所在目录
define('PATH_BASE_STATIC',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_STATIC));//网站静态资源文件所在目录
define('PATH_BASE_DYNAMIC',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_DYNAMIC));//网站动态资源文件所在目录（做缓存用）
//层次目录
define('PATH_BASE_WAP',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_WAP));//网站手机端页面程序文件所在目录
define('PATH_BASE_ADMIN',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_ADMIN));//网站后台管理程序文件所在目录
define('PATH_BASE_MEMBER',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_MEMBER));//网站会员中心程序文件所在目录
define('PATH_BASE_CMS',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_CMS));//网站CMS程序文件所在目录
define('PATH_BASE_CIRCLE',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_CIRCLE));//网站用户圈子程序文件所在目录
//----主题相关
define('PATH_BASE_THEME',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_THEME));//网站存放前台所有主题文件夹所在目录
define('PATH_BASE_THEME_ADMIN',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_THEME_ADMIN));//网站存放后台admin所有主题文件夹所在目录
define('PATH_BASE_THEME_MEMBER',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_THEME_MEMBER));//网站存放会员member所有主题文件夹所在目录
define('PATH_BASE_THEME_CMS',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_THEME_CMS));//网站存放cms内容管理所有主题文件夹所在目录
define('PATH_BASE_THEME_CIRCLE',str_replace(PATH_ABS_BASE_ROOT,'',PATH_ABS_BASE_THEME_CIRCLE));//网站存放圈子circle管理所有主题文件夹所在目录
//默认配置
define('PATH_TPL_INDEX_DEFAULT',PATH_BASE_THEME.'default/');//前台默认模版
define('PATH_TPL_ADMIN_DEFAULT',PATH_BASE_THEME.'default/');//管理后台默认模版
define('PATH_TPL_MEMBER_DEFAULT',PATH_BASE_THEME.'default/');//会员中心默认模版
