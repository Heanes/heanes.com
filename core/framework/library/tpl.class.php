<?php
/**
 * @filesource tpl.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-09 14:17:41
 * @doc 模版类
 */
defined('InHeanes') or exit('Access Invalid!');
class Tpl {
	/**
	 * 单例对象
	 * @var boject
	 */
	private static $instance=null;
	
	/**
	 * 模版路径
	 * @var string
	 */
	private static $tpl_dir='';
	
	/**
	 * 模版内的所有值数组，传入以在页面显示数据
	 * @var array
	 */
	private static $output_value=array();
	
	/**
	 * 构造函数
	 */
	private function __construct(){
		//echo __METHOD__.'</br>';
	}
	
	/**
	 * 构造单例对象
	 * @return boject
	 */
	public static function getInstance(){
		if (self::$instance === null || !(self::$instance instanceof Tpl)) {
			self::$instance=new Tpl();
		}
		return self::$instance;
	}
	/**
	 * 传入赋值
	 * @param mixed $output 向模版输出的值
	 * @param string $input 赋值源变量或数组
	 */
	public static function output($output,$input=''){
		self::getInstance();
		self::$output_value[$output]=$input;
	}
	
	/**
	 * 设置模版路径
	 * @param string $dirStr 模版路径
	 */
	public static function setTemplateDir($dirStr) {
		//if (!defined('TPL_NAME')) define('TPL_NAME', 'default');
		$templateDir = 'template'.DS.$dirStr.DS;
		//echo $templateDir;
		if (!is_dir($templateDir)) {
			echo '该路径不存在！将使用默认(default)路径';
			$templateDir = 'template'.DS.'default'.DS;
		}
		self::$tpl_dir=$templateDir;
		//echo self::$tpl_dir;
	}
	
	/**
	 * 获取模版路径
	 * @return string self::$tpl_dir 模版路径
	 */
	public static function getTemplateDir() {
		return self::$tpl_dir;
	}
	
	/**
	 * 显示页面
	 * @param string $pageName 模版文件名称
	 * @param int $time 自动跳转时间，暂时未用上 TODO:后期加上自动跳转功能
	 * @param string $layout
	 */
	public static function showpage($pageName,$layout='') {
		//如果未定义模版路径，则使用默认模版
		//if (!defined('TPL_NAME')) define('TPL_NAME', 'default');
		//self::$tpl_dir='default';
		//echo self::$tpl_dir;
		
		if (empty(self::$tpl_dir)) {
			echo '请设置正确的模版路径';
			self::$tpl_dir='default';
		}
		$tpl_file=self::$tpl_dir.$pageName;
		//echo $tpl_file;
		@header("Content-type: text/html; charset=UTF-8");
		if (file_exists($tpl_file)) {
			//对模板变量进行赋值
			$output = self::$output_value;
			@include_once($tpl_file);
		}else {
			echo $tpl_file.'文件不存在';
		}
	}
	
	/**
	 * 生成静态Html文件
	 * @param string $pageName 模版文件名称
	 * @param string $storeDir 存储Html文件的文件夹
	 * TODO 强制缓存模式|已缓存则不再缓存模式
	 */
	public static function makeHtml($pageName,$storeDir='dynamic/html/') {
		//如果未定义模版路径，则使用默认模版
		if (!defined('TPL_NAME')) define('TPL_NAME', 'default');
		self::$tpl_dir='default';
		if (!empty(self::$tpl_dir)){
			$tpl_dir = self::$tpl_dir.DS;
		}
		$tpl_file='template/'.self::$tpl_dir.'/'.$pageName;
		@header("Content-type: text/html; charset=".CHARSET);
		if (file_exists($tpl_file)) {
			ob_end_clean();
			ob_start();
			@include_once($tpl_file);
			$length = ob_get_length();
			$buffer = ob_get_contents();
			ob_end_clean();
			$fp = fopen($storeDir.'index.html',"w+");
			fwrite($fp,$buffer);
			fclose($fp);
			echo '生成缓存文件成功，存储在'.$storeDir.'中';
		}else {
			echo $tpl_file.'文件不存在';
		}
	}
 }