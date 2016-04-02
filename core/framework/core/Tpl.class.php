<?php

/**
 * @doc 模版类
 * @filesource Tpl.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-09 14:17:41
 */
class Tpl{
	
	
	/**
	 * @var object 单例对象
	 */
	private static $instance = null;
	
	/**
	 * @var string 当前调用模版目录环境（使用模版的环境目录）
	 */
	public static $current_dir = '';
	
	/**
	 * @var string 欲设置模版路径
	 */
	private static $tpl_dir = '';
	
	/**
	 * @var string 欲设置模版名称
	 */
	private static $theme = 'default';

	/**
	 * @var string 模版文件默认后缀名
	 */
	private static $template_file_extension='.tpl.php';
	
	/**
	 * @var array 模版内的所有值数组，传入以在页面显示数据
	 */
	private static $output_value = array();

	/**
	 * @var string 默认layout
	 */
	private static $layout_file = '';

	/**
	 * @var string 带域名路径的模版路径常量
	 */
	public static $TPL = '';

	final private function __construct(){
		//echo __METHOD__.'</br>';
	}
	
	/**
	 * @doc 构造单例对象
	 * @return object
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function getInstance(){
		if (self::$instance === null || !(self::$instance instanceof self)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @doc 不覆盖形式设置输出值
	 * @param $valueArray
	 * @author Heanes
	 * @time 2015-06-29 10:00:34
	 */
	public static function setOutput($valueArray){
		foreach ($valueArray as $key => $value) {
			self::$output_value[$key] = $value;
		}
	}
	
	/**
	 * @doc 传入赋值
	 * @param mixed $output 向模版输出的值
	 * @param string $input 赋值源变量或数组
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function assign($output, $input = ''){
		self::getInstance();
		self::$output_value[$output] = $input;
	}
	
	/**
	 * @doc 显示页面
	 * @param string $pageName 模版文件名称，需加上后缀
	 * @param string $layout 公共布局文件，需加上后缀
	 * TODO:后期加上自动跳转功能 param int $time 自动跳转时间，暂时未用上
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function display($pageName='', $layout = ''){
		self::getInstance();
		//echo __METHOD__.'</br>';
		if (empty(self::$tpl_dir)) {
			echo '请设置正确的模版路径';
			self::setTemplateDir('default');
		}
		//自动根据控制器名称和方法名找到同名模版
		if(empty($pageName)){
			$pageName=lcfirst(Filter::doFilter($_GET[REQUEST_CONTROLLER],'string'));
			$pageName.=DS.lcfirst(Filter::doFilter($_GET[REQUEST_METHOD],'string'));
		}
		$tpl_file = self::getTemplateDir().$pageName;
		/*echo 'Tpl:display()下$pageName='.$pageName.'<br/>';
		echo 'Tpl:display()下Tpl:getCurrentDir()='.self::getCurrentDir().'<br/>';
		echo 'Tpl:display()下Tpl:getTemplateDir()='.self::getTemplateDir().'<br/>';
		echo 'Tpl:display()下Tpl:getThemeName()='.self::getThemeName().'<br/>';
		echo 'Tpl:display()下Tpl:$tpl_file='.$tpl_file.'<br/>';
		echo 'Tpl:display()下Tpl:getLayout()='.self::getLayout().'<br/>';*/

		//默认由布局文件（即公共头部脚部）
		if (empty($layout) && empty(self::getLayout())) {
			//echo '0<br/>';
			$layout = 'layout'.DS.self::$layout_file;
		} elseif (empty($layout) && !empty(self::getLayout())) {
			//echo '1<br/>';
			$layout = self::$layout_file;
		} else {
			//echo '2<br/>';
			$layout = 'layout'.DS.$layout;
		}
		$layout_file = self::getTemplateDir().$layout.self::getTemplateFileExtension();
		$tpl_file.=self::getTemplateFileExtension();
		/*
		echo 'Tpl:display()下Tpl:getLayout()='.self::getLayout().'<br/>';
		echo 'Tpl:display()下$layout='.$layout.'<br/>';
		echo 'Tpl:display()下$layout_file='.$layout_file.'<br/>';
		*/

		@header("Content-type: text/html; charset=UTF-8");
		@header('X-Powered-By:HeanesFramework');
		if (file_exists($tpl_file)) {
			//对模板变量进行赋值
			$output = self::$output_value;

			//页头公共信息

			$output['html_title'] = isset($output['html_title']) && $output['html_title'] != '' ? $output['html_title'] : '海利系统';
			$output['seo_keywords'] = isset($output['seo_keywords']) && $output['seo_keywords'] != '' ? $output['seo_keywords'] : 'Heanes';
			$output['seo_description'] = isset($output['seo_description']) && $output['seo_description'] != '' ? $output['seo_description'] : '海利系统';
			$output['ref_url'] = getReferer();

			Timer::mark('total_display_time_end');
			$output['system_core_report']['total_elapsed_time'] = Timer::getTime('total_execution_time_start', 'total_display_time_end');
			// Timer::printTime('total_execution_time_start','total_execution_time_end');
			// var_dump(Timer::$marker);

			// 判断是否使用布局方式输出模板，如果是，那么包含布局文件，并且在布局文件中包含模板文件
			if (!empty($layout)) {
				if (file_exists($layout_file)) {
					//echo 'file_exists($layout_file)<br/>';
					include_once($layout_file);
				} else {
					$error = '<p><b style="color:red">Tpl ERROR:'.'template'.DS.$layout.' is not exists</b></p>';
					echo $error;
				}
			} else {
				include_once($tpl_file);
				//@include($tpl_file); //include() vs include_once() allows for multiple views with the same name
			}
		} else {
			echo '<p><b style="color:red">'.$tpl_file.'文件不存在</b></p>';
		}
	}
	
	
	/**
	 * @doc 设置模版路径
	 * @param string $dirStr 模版路径
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function setTemplateDir($dirStr){
		self::getInstance();
		$templateDir = 'template'.DS.$dirStr.DS;
		/*
		echo '在Tpl:setTemplateDir()下getcwd()='.getcwd().'<br/>';
		echo 'Tpl::setTemplateDir()下$templateDir='.$templateDir.'<br/>';
		*/
		if (!is_dir($templateDir)) {
			echo '该路径不存在！将使用默认(default)路径</br>';
			$templateDir = 'template'.DS.'default'.DS;
		} else {
			self::$current_dir = getcwd();
			self::$theme = $dirStr;
		}
		self::$tpl_dir = $templateDir;
		
		/*
		echo PATH_ABS_BASE_ROOT.'<br/>';
		echo getcwd().'<br/>';
		echo str_replace(DS_S, DS, getcwd()).'<br/>';
		echo str_replace(PATH_ABS_BASE_ROOT, '', str_replace(DS_S, DS, getcwd())).'<br/>';
		*/
		
		//设置带域名路径的模版路径常量
		//echo getcwd().'<br/>';
		//self::$TPL=SYS_HOST.str_replace(PATH_ABS_BASE_ROOT, '', str_replace(DS_S, DS, getcwd())) .DS.$templateDir;
		self::$TPL = BASE_URL.$templateDir;
		
		/*
		echo 'Tpl:self::$current_dir:'.self::$current_dir.'<br/>';
		echo 'Tpl:self::$tpl_dir='.self::$tpl_dir.'<br/>';
		echo 'Tpl:self::$theme:'.self::$theme.'<br/>';
		*/
	}
	
	/**
	 * @doc 获取模版路径
	 * @return string self::$tpl_dir 模版路径
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function getTemplateDir(){
		self::getInstance();
		return self::$tpl_dir;
	}
	
	/**
	 * @doc 设置当前路径
	 * @param string $currentDirStr
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function setCurrentDir($currentDirStr){
		self::getInstance();
		if ($currentDirStr != '') {
			self::$current_dir = $currentDirStr;
		}
		self::$current_dir = getcwd();
	}
	
	/**
	 * @doc 获取当前路径
	 * @return string
	 * @author Heanes
	 * @time 2015-04-23 13:08:09
	 */
	public static function getCurrentDir(){
		self::getInstance();
		if (self::$current_dir != '') {
			return self::$current_dir;
		} else {
			return getcwd();
		}
	}

	/**
	 * @doc 获取模版文件默认后缀名
	 * @author Heanes
	 * @return string
	 * @time 2015-08-17 15:24:01
	 */
	public static function getTemplateFileExtension() {
		return self::$template_file_extension;
	}

	/**
	 * @doc 设置模版文件默认后缀名
	 * @author Heanes
	 * @param $file_extension
	 * @time 2015-08-17 15:25:14
	 */
	public static function setTemplateFileExtension($file_extension) {
		self::$template_file_extension=$file_extension;
	}

	/**
	 * @doc 设置布局
	 * @param string $layout 布局文件名称
	 * @return bool 设置结果，true-成功，false-失败
	 * @author Heanes
	 * @time 2015-06-09 15:16:55
	 */
	public static function setLayout($layout){
		self::getInstance();
		//echo __METHOD__.'<br/>';
		self::$layout_file = $layout;
		//echo 'layout:'.self::$layout_file.' endSymbol<br/>';
		return true;
	}

	/**
	 * @doc 获取布局文件
	 * @return string
	 * @author Heanes
	 * @time 2015-06-09 17:55:25
	 */
	public static function getLayout(){
		self::getInstance();
		return self::$layout_file;
	}

	/**
	 * @doc 获取模版名称
	 * @return string
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function getThemeName(){
		self::getInstance();

		//echo 'Tpl:getThemeName()下self::$theme='.self::$theme.'<br/>';
		return self::$theme;
	}
	
	
	/**
	 * @doc 编译生成静态Html文件
	 * @param string $pageName 模版文件名称
	 * @param string $storeName 存储html文件名称
	 * @param string $storeDir 存储Html文件的文件夹名称
	 * TODO 强制缓存模式|已缓存则不再缓存模式
	 * @author Heanes
	 * @time 2015-04-23 12:58:09
	 */
	public static function makeHtml($pageName, $storeName, $storeDir = 'index'){
		self::getInstance();
		//如果未定义模版路径，则使用默认模版
		if (!empty(self::$tpl_dir)) {
			$tpl_dir = self::$tpl_dir.DS;
		} else {
			echo '路径不存在';
		}
		$tpl_file = self::getTemplateDir().$pageName;
		@header("Content-type: text/html; charset=UTF-8");
		if (file_exists($tpl_file)) {
			$output = self::$output_value;
			ob_end_clean();
			ob_start();
			@include($tpl_file);
			$length = ob_get_length();
			$buffer = ob_get_contents();
			ob_end_clean();
			$storeDir = 'public/html/'.APP_ID.DS.$storeDir.DS;
			if ($fp = fopen(PATH_ABS_BASE_ROOT.$storeDir.$storeName, "w+")) {
				if (fwrite($fp, $buffer)) {
					echo '生成缓存文件成功，存储在'.$storeDir.'中';
					fclose($fp);
				} else {
					echo '写入文件失败';
				}
			} else {
				echo '打开文件失败';
			}
		} else {
			echo $tpl_file.'文件不存在';
		}
	}
}