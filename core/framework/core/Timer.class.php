<?php
/**
 * @doc 系统计时器类
 * @filesource Timer.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-04-06 16:36:40
 */
class Timer {
	
	
	public static $i=0;
	
	/**
	 * @doc 计时器标记名数组
	 * @var array
	 */
	public static  $marker = array();

	/**
	 * @doc 单例对象
	 * @var object
	 */
	private static $instance=null;
	
	public function __construct() {
		//echo __METHOD__.'<br/>';
	}
	
/**
	 * @doc 构造单例对象
	 * @return object
	 */
	public static function getInstance(){
		if (self::$instance === null || !(self::$instance instanceof self)) {
			self::$instance=new self();
		}
		return self::$instance;
	}
	
	/**
	 * @doc 获取当前时间
	 * @return number
	 * @author Heanes
	 * @time 2015-04-25 22:44:49
	 */
	public static function now() {
		self::getInstance();
		list($usec,$sec) = explode(" ", microtime());
		return ((float)$usec+(float)$sec);
	}
	
	/**
	 * @doc 计时器标记
	 * @param string $markName
	 * @author Heanes
	 * @time 2015年4月25日下午10:44:55
	 */
	public static function mark($markName) {
		self::getInstance();
		self::$marker[$markName] = self::now();
	}
	/**
	 * @doc 获取计时器间隔时间
	 * @param string $point1 起始点
	 * @param string $point2 结束点
	 * @param number $decimals 数据保留小数点位数
	 * @return string 计时器时间
	 * @author Heanes
	 * @time 2015-04-25 22:46:19
	 */
	public static function getTime($point1 = '', $point2 = '', $decimals = 4) {
		self::getInstance();
		self::$i++;
		if ($point1 === '')
		{
			return '{elapsed_time}';
		}
		
		if ( ! isset(self::$marker[$point1]))
		{
			return 'had not set this timer:'.$point1;
		}
		
		if ( ! isset(self::$marker[$point2]))
		{
			$point2=self::$marker[$point1].'_Auto_end';
			self::$marker[$point2] = self::now();
		}
		
		/*
		self::$i++;
		echo 'self::$i:'.self::$i.'--'.var_dump(self::$marker).'<br/>';
		*/
		self::$marker[self::$i.'_elapsed_time_From : '.$point1.' To '.$point2 ]=self::$marker[$point2] - self::$marker[$point1];
		return number_format(self::$marker[$point2] - self::$marker[$point1], $decimals);
	}
	
	/**
	 * @doc 输出时间
	 * @param string $point1 起始点
	 * @param string $point2 结束点
	 * @param number $decimals 数据保留小数点位数
	 * @author Heanes
	 * @time 2015-04-26 12:42:11
	 */
	public static function printTime($point1 = '', $point2 = '', $decimals = 4) {
		self::getInstance();
		printf("Program run use time: %fs\n" , self::getTime($point1, $point2, $decimals));
	}
}
