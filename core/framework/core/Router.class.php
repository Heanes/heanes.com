<?php

/**
 * @doc URL路由
 * @filesource Router.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-26 16:37:24
 * @todo 路由待完成
 */
class Router{

	private static $httpStatusCode='200';

	function __construct(){
		//echo __METHOD__.'()</br>';
	}

	/**
	 * @doc 设置http状态码
	 * @param string $code
	 * @author Heanes
	 * @time 2015-07-07 15:59:57
	 */
	public static function setHttpStatusCode($code='200'){
		self::$httpStatusCode=$code;
	}

	/**
	 * @doc 获取http状态码
	 * @return string
	 * @author Heanes
	 * @time 2015-07-07 16:01:28
	 */
	public static function getHttpStatusCode(){
		return self::$httpStatusCode;
	}
	
	/**
	 * @doc 显示404页面
	 * @author Heanes
	 * @time 2015-05-11 17:26:49
	 */
	public static function show404($page){
		Tpl::setTemplateDir('default');
		Tpl::setLayout('layout/defaultCommonLayout');
		Tpl::display($page);
		//从数据库读取404模版页面，再显示出来
	}
	
	/**
	 * @doc 回首页
	 * @author Heanes
	 * @time 2015-05-11 17:26:16
	 */
	public static function goHome(){
		
	}
}