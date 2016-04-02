<?php
/**
 * @doc 核心函数库
 * @filesource core.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-17 18:02:08
 */
defined('InHeanes') or exit('Access Invalid!');

/* ---------------------------------------管理系统（程序）功能函数--------------------------------------- */
/**
 * @doc 取得系统配置信息
 * @param string $key 取得下标值
 * @return mixed
 * @author Heanes
 * @time 2015-03-18 10:02:09
 */
function get_config_sys($key){
	if (strpos($key, '.')) {
		$key = explode('.', $key);
		if (isset($key[2])) {
			return $GLOBALS['config_global'][$key[0]][$key[1]][$key[2]];
		} else {
			return $GLOBALS['config_global'][$key[0]][$key[1]];
		}
	} else {
		return $GLOBALS['config_global'][$key];
	}
}

/**
 * @doc 检查是否已经安装
 * @return bool true-已安装；false-未安装；
 * @author Heanes
 * @time 2015-05-08 11:14:11
 */
function isInstalled(){
	if (file_exists(get_real_path()."data/install.lock")) {
		echo '当前系统已安装，若要重新安装请删除目录下data/install.lock文件<br/>';

		return true;
	} else {
		//header('Location:'.'/install');
		return false;
	}
}

/**
 * @doc 获取当前根域名，此函数和/core/library/Server类中的get_host()方法功能相同
 * @param boolean $end_symbol 返回域名是否 带末尾的/符号，如http://www.heanes.com是不带末尾"/"的，http://www.heanes.com/是带末尾"/"的；
 * @return string 根域名
 * @author Heanes
 * @time 2015-05-05 11:38:47
 */
function get_host($end_symbol = true){
	
	if (isset($_SERVER['HTTP_HOST'])) {
		//检测是否为https安全链接
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
			$request_scheme = 'https';
		} else {
			$request_scheme = 'http';
		}
		$host = $request_scheme.'://'.$_SERVER['HTTP_HOST'];
	} else {
		$host = 'http://localhost';
	}
	if ($end_symbol) {
		$host .= '/';
	}
	
	return $host;
}

/**
 * @doc 获取当前第一级url，如http://heanes.com/article/show/3则返回http://heanes.com/article/show/
 * @param bool|string $end_symbol 返回域名是否 带末尾的/符号，如http://www.heanes.com是不带末尾"/"的，http://www.heanes.com/是带末尾"/"的；
 * @return string 当前级url结果
 * @author Heanes
 * @time 2015-05-27 14:27:48
 */
function get_base_url($end_symbol = true){
	if (isset($_SERVER['HTTP_HOST'])) {
		$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$base_url .= '://'.$_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	} else {
		$base_url = 'http://localhost/';
	}
	if (!$end_symbol) {
		$base_url = rtrim($base_url, '/');
		//$base_url=substr($base_url,0,strlen($base_url)-1);
	}
	
	return $base_url;
}

/**
 * @doc 获取当前页面URL
 * @return string URL地址
 * @author Heanes
 * @time 2015-06-24 12:49:00
 */
function get_current_url(){
	if (isset($_SERVER['HTTP_HOST'])) {
		$current_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$current_url .= '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	} else {
		$current_url = 'http://localhost/';
	}
	return $current_url;
}

/**
 * @doc 清除URL重复请求参数 @todo 待完成
 * @author Heanes
 * @time 2015-07-13 13:33:38
 */
function clearRepeatRequest($query_str){
	$query_pattern = $query_str.'';
	preg_replace_callback('/&'.$query_pattern.'/', function ($r){
		static $n = 0;
		return !$n++ ? $r[0] : '';
	}, $_SERVER['REQUEST_URI']);
}

/**
 * @doc 获取真实路径
 * @return string 真实路径
 * @author Heanes
 * @time 2015-05-08 11:13:45
 */
function get_real_path(){
	return PATH_ABS_BASE_ROOT;
}

/**
 * @doc 模型实例化入口
 * @param null $model 模型名称
 * @return object 对象形式的返回结果
 * @author Heanes
 * @time 2015-03-30 11:10:49
 */
function Model($model = null){
	static $_cache = array();
	if (!is_null($model) && isset($_cache[$model])) {
		return $_cache[$model];
	}
	$file_name = PATH_ABS_BASE_DATA.'model/'.ucfirst($model).'Model.class.php';
	//echo $file_name;
	$class_name = $model.'Model';
	//echo 'file_name='.$file_name.'</br>'.'class_name='.$class_name.'</br>';
	if (!file_exists($file_name)) {
		//var_dump($_cache);
		//echo $file_name;
		return $_cache[$model] = new Model($model);
	} else {
		require_once($file_name);
		if (!class_exists($class_name)) {
			//var_dump($_cache);
			$error = 'Model Error:  Class '.$class_name.' is not exists!';
			Debug::throw_exception($error);
			return false;
		} else {
			//var_dump(new $class_name());
			return $_cache[$model] = new $class_name();
		}
	}
}

/* ---------------------------------------系统发布相关功能函数--------------------------------------- */
/**
 * @doc 去除代码中的空白和注释
 * @param string $content 待压缩的内容
 * @return string 压缩后的内容
 * @author Heanes
 * @time 2015-06-08 13:32:08
 */
function compress_code($content){
	$stripStr = '';
	//分析php源码
	$tokens = token_get_all($content);
	$last_space = false;
	for ($i = 0, $j = count($tokens); $i < $j; $i++) {
		if (is_string($tokens[$i])) {
			$last_space = false;
			$stripStr .= $tokens[$i];
		} else {
			switch ($tokens[$i][0]) {
				case T_COMMENT:    //过滤各种PHP注释
				case T_DOC_COMMENT:
					break;
				case T_WHITESPACE:    //过滤空格
					if (!$last_space) {
						$stripStr .= ' ';
						$last_space = true;
					}
					break;
				default:
					$last_space = false;
					$stripStr .= $tokens[$i][1];
			}
		}
	}

	return $stripStr;
}


/* ---------------------------------------服务器相关功能函数--------------------------------------- */

/**
 * @doc 检测是否是微信
 * @return bool
 * @author Heanes
 * @time 2015-08-01 11:20:47
 */
function is_weixin(){
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
		return true;
	}
	return false;
}
/**
 * @doc 获取服务器操作系统
 * @return string 操作系统信息
 * @author Heanes
 * @time 2015-03-30 12:14:45
 */
function get_server_os(){
	//php_uname();//$para 可选s n r v m
	//PHP_OS 常量 WINNT
	return php_uname('s').' '.php_uname('v');
}

/**
 * @doc 获取php版本
 * @return string 版本信息
 * @author Heanes
 * @time 2015-03-30 12:14:51
 */
function get_php_version(){
	return PHP_VERSION;//常量方式
	//return phpversion();//函数方式
}

/**
 * @doc 获取服务器软件信息
 * @return string 服务器信息
 * @author Heanes
 * @time 2015年3月30日下午3:17:39
 */
function get_server_version(){
	if (function_exists('apache_get_version')) {
		return apache_get_version();
	} else {
		return $_SERVER['SERVER_SOFTWARE'];//通用
	}
	//return apache_get_version();//需做判断，若是Apache服务器则可使用此函数
}

/**
 * @doc 获取数据库版本信息
 * @return string 版本信息
 * @author Heanes
 * @time 2015-03-31 17:23:10
 */
function get_mysql_version(){
	return DB::getServerInfo();
}

/**
 * @doc 获取访客IP，获取用户的访问ip，后期将改进获得真实ip及物理地址
 * @return string ip地址字符串
 * @author Heanes
 * @time 2015-03-30 15:37:11
 */
function get_client_ip(){
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

//其他的几种方法
function get_client_ip2(){
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if (!empty($_SERVER["REMOTE_ADDR"]))
		$ip = $_SERVER["REMOTE_ADDR"];
	else
		$ip = "Unknow";

	return $ip;
}

function get_client_ip3(){
	$ip = null;
	if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif ($_SERVER["HTTP_CLIENT_IP"]) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	} elseif ($_SERVER["REMOTE_ADDR"]) {
		$ip = $_SERVER["REMOTE_ADDR"];
	} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} elseif (getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} elseif (getenv("REMOTE_ADDR")) {
		$ip = getenv("REMOTE_ADDR");
	} else {
		$ip = "Unknown";
	}

	return $ip;
}

function get_client_ip4(){
	$ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$ip = ($ip) ? $ip : $_SERVER["REMOTE_ADDR"];

	return $ip;
}

function get_client_ip5(){
	$ip = false;
	if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode(", ", $_SERVER ['HTTP_X_FORWARDED_FOR']);
		if ($ip) {
			array_unshift($ips, $ip);
			$ip = false;
		}
		for ($i = 0; $i < count($ips); $i++) {
			if (!preg_match("^(10|172\.16|192\.168)\.", $ips [$i])) {
				$ip = $ips [$i];
				break;
			}
		}
	}

	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

/**
 * @doc 获取访客ip所在地（百度开放数据API接口）
 * @param string $ip
 * @param string $field
 * @return string|null
 * @author Heanes
 * @time 2015年3月31日下午2:28:04
 */
function get_ip_ips($ip, $field = 'location'){
	$location = mb_convert_encoding(file_get_contents('http://opendata.baidu.com/api.php?resource_id=6006&format=json&query='.$ip.'\''), 'UTF-8', 'GBK');
	$result_arr = json_decode($location, true);
	if ($result_arr['status'] == '0') {
		switch ($field) {
			case 'location':
				return $result_arr['data'][0]['location'];
				break;
			default:
				return null;
				break;
		}
	} else {
		return null;
	}
}

/**
 * @doc 获取访客ip所在地（百度开放数据API接口）
 * @param string $ip ip字符
 * @param string $method 获取方法
 * @return string|null|array
 * @author Heanes
 * @time 2015年3月31日下午2:28:04
 */
function get_ip_location($ip, $method='taobao'){
	switch ($method) {
		case 'taobao':
			$queryString='http://ip.taobao.com//service/getIpInfo.php?ip='.$ip;
			$location = mb_convert_encoding(file_get_contents($queryString), 'UTF-8', 'GBK');
			//返回数据格式示例：
			/*
			{"code":0,"data":{"ip":"210.75.225.254",
			"country":"\u4e2d\u56fd","area":"\u534e\u5317",
			"region":"\u5317\u4eac\u5e02","city":"\u5317\u4eac\u5e02","county":"",
			"isp":"\u7535\u4fe1",
			"country_id":"86","area_id":"100000","region_id":"110000","city_id":"110000","county_id":"-1","isp_id":"100017"}}
			*/
			$result_arr = json_decode($location, true);
			if ($result_arr['code'] == '0') {
				return $result_arr;
			} else {
				return null;
			}
			break;
		case 'baidu':
			$queryString='http://api.map.baidu.com/location/ip?ak=E43126daeb8b5aebb1fbb51777d99a09&ip='.$ip;
			$location = mb_convert_encoding(file_get_contents($queryString), 'UTF-8', 'GBK');
			//返回结果示例
			/*
			{
				address: "CN|北京|北京|None|CHINANET|1|None",   #地址
				content:       #详细内容
				{
				address: "北京市",   #简要地址
				address_detail:      #详细地址信息
				{
				city: "北京市",        #城市
				city_code: 131,       #百度城市代码
				district: "",           #区县
				province: "北京市",   #省份
				street: "",            #街道
				street_number: ""    #门址
				},
				point:               #百度经纬度坐标值
				{
				x: "116.39564504",
				y: "39.92998578"
				}
				},
				status: 0     #返回状态码
			}
			 */
			$result_arr = $location;
			if ($result_arr['status'] == '0') {
				return $result_arr;
			} else {
				return null;
			}
			break;
		default:
			return null;
			break;
	}
}

/**
 *
 * 根据php的$_SERVER['HTTP_USER_AGENT'] 中各种浏览器访问时所包含各个浏览器特定的字符串来判断是属于PC还是移动端
 * @author discuz3x
 * @time 2014-04-09
 * @return  BOOL
 */
function checkmobile(){
	global $_G;
	$mobile = array();
	//各个触控浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
	static $touchbrowser_list = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
		'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
		'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
		'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
		'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
		'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
		'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
	//window手机浏览器数组【猜的】
	static $mobilebrowser_list = array('windows phone');
	//wap浏览器中$_SERVER['HTTP_USER_AGENT']所包含的字符串数组
	static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
		'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
		'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
	$pad_list = array('pad', 'gt-p1000');
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if (dstrpos($useragent, $pad_list)){
		return false;
	}
	if (($v = dstrpos($useragent, $mobilebrowser_list, true))){
		$_G['mobile'] = $v;
		return '1';
	}
	if (($v = dstrpos($useragent, $touchbrowser_list, true))){
		$_G['mobile'] = $v;
		return '2';
	}
	if (($v = dstrpos($useragent, $wmlbrowser_list))){
		$_G['mobile'] = $v;
		return '3'; //wml版
	}
	$brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	if (dstrpos($useragent, $brower)) return false;
	$_G['mobile'] = 'unknown';
	//对于未知类型的浏览器，通过$_GET['mobile']参数来决定是否是手机浏览器
	if (isset($_G['mobiletpl'][$_GET['mobile']])){
		return true;
	} else{
		return false;
	}
}

/**
 * @doc 判断$arr中元素字符串是否有出现在$string中
 * @param $string $_SERVER['HTTP_USER_AGENT']
 * @param array $arr 各中浏览器$_SERVER['HTTP_USER_AGENT']中必定会包含的字符串
 * @param boolean $returnvalue 返回浏览器名称还是返回布尔值，true为返回浏览器名称，false为返回布尔值【默认】
 * @return bool
 * @author discuz3x
 * @time 2014-04-09
 */
function dstrpos($string, $arr, $returnvalue = false) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			$return = $returnvalue ? $v : true;
			return $return;
		}
	}
	return false;
}

//echo get_client_ip().'<br/>'.get_client_ip2().'<br/>'.get_client_ip3().'<br/>'.get_client_ip4().'<br/>'.get_client_ip5().'<br/>';

/**
 * @doc 取上一步来源地址
 * @return string 字符串类型的返回结果
 * @author Heanes
 * @time 2015-06-09 17:07:24
 */
function getReferer(){
	if(isset($_GET['redirect']) && !empty($_SERVER['HTTP_REFERER'])){
		return $_GET['redirect'];
	}
	return empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
}

/**
 * @doc 重写$_SERVER['REQUEST_URI']
 * @return string 请求参数
 * @author Heanes
 * @time 2015-06-11 14:39:04
 */
function request_uri(){
	if (isset($_SERVER['REQUEST_URI'])) {
		$uri = $_SERVER['REQUEST_URI'];
	} else {
		if (isset($_SERVER['argv'])) {
			$uri = $_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0];
		} else {
			$uri = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
	}

	return $uri;
}

/* ---------------------------------------调试功能函数--------------------------------------- */
function phpinfo_array($return = false){
	ob_start();
	phpinfo(-1);
	$pi = preg_replace(
		array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
			'#<h1>Configuration</h1>#', "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
			"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
			'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
			.'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
			'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
			'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
			"# +#", '#<tr>#', '#</tr>#'),
		array('$1', '', '', '', '</$1>'."\n", '<', ' ', ' ', ' ', '', ' ',
			'<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
			"\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
			'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
			'<tr><td>Zend Engine</td><td>$2</td></tr>'."\n".
			'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
		ob_get_clean());
	$sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
	unset($sections[0]);
	$pi = array();
	foreach ($sections as $section) {
		$n = substr($section, 0, strpos($section, '</h2>'));
		preg_match_all('#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#', $section, $askapache, PREG_SET_ORDER);
		foreach ($askapache as $m) $pi[$n][$m[1]] = (!isset($m[3]) || $m[2] == $m[3]) ? $m[2] : array_slice($m, 2);
	}
	return ($return === false) ? print_r($pi) : $pi;
}

/* ---------------------------------------基础功能函数--------------------------------------- */
/**
 * @doc 获取GMTime当前格林威治时间的时间戳
 * @return int 获得当前格林威治时间的时间戳
 * @author Heanes
 * @time 2015-06-18 15:08:21
 */
function getGMTime(){
	return (time() - date('Z'));
}

/**
 * @doc GMTime时间转为格式化时间
 * @param string $utc_time 数值型GMT时间，为空则默认显示当前时间
 * @param string $format
 * @return bool|string
 * @author Heanes
 * @time 2015-06-23 18:33:16
 */
function to_date($utc_time = '', $format = 'Y-m-d H:i:s'){
	if (empty ($utc_time)) {
		return '';
	}
	if ($utc_time == 'now') {
		$utc_time = (time() - date('Z'));
	}
	$timezone = 8;
	$time = (integer)$utc_time + $timezone * 3600;

	return date($format, $time);
}

/**
 * @doc 返回GMTime时间
 * @param string $str 时间量字符串
 * @param string $format 格式化字符串
 * @return int GMTime时间
 * @author Heanes
 * @time 2015-07-03 17:03:02
 */
function to_timespan($str, $format = 'Y-m-d H:i:s'){
	$timezone = 8;
	$time = intval(strtotime($str));
	if ($time != 0)
		$time = $time - $timezone * 3600;

	return $time;
}

/**
 * 获取指定时间与当前时间的时间间隔
 * @access  public
 * @param   integer $time
 * @return  string
 */
function getBeforeTimeLag($time){
	if ($time == 0)
		return "";

	static $today_time = null,
	$before_lang = null,
	$before_day_lang = null,
	$today_lang = null,
	$yesterday_lang = null,
	$hours_lang = null,
	$minutes_lang = null,
	$months_lang = null,
	$date_lang = null,
	$s_date = 86400;

	if ($today_time === null) {
		$today_time = getGMTime();
		$before_lang = '前';
		$before_day_lang = '前天';
		$today_lang = '今天';
		$yesterday_lang = '昨天';
		$hours_lang = '小时';
		$minutes_lang = '分钟';
		$months_lang = '月';
		$date_lang = '日';
	}

	$now_day = to_timespan(to_date($today_time, "Y-m-d")); //今天零点时间
	$pub_day = to_timespan(to_date($time, "Y-m-d")); //发布期零点时间

	$time_lag = $now_day - $pub_day;

	$year_time = to_date($time, 'Y');
	$today_year = to_date($today_time, 'Y');

	if ($year_time < $today_year)
		return to_date($time, 'Y:m:d H:i');

	$time_lag_str = to_date($time, ' H:i');

	$day_time = 0;
	if ($time_lag / $s_date >= 1) {
		$day_time = floor($time_lag / $s_date);
		$time_lag = $time_lag % $s_date;
	}

	switch ($day_time) {
		case '0':
			$time_lag_str = $today_lang.$time_lag_str;
			break;

		case '1':
			$time_lag_str = $yesterday_lang.$time_lag_str;
			break;

		case '2':
			$time_lag_str = $before_day_lang.$time_lag_str;
			break;

		default:
			$time_lag_str = to_date($time, 'm'.$months_lang.'d'.$date_lang.' H:i');
			break;
	}

	return $time_lag_str;
}


/**
 * @doc 检测表单是否提交
 * @param string $form_name 表单名称
 * @return bool
 * @author Heanes
 * @time 2015-06-16 18:10:07
 */
function isSubmit($form_name){
	if (isset($_POST[$form_name])) {
		return true;
	} else {
		return false;
	}
}

//过滤注入
function filter_injection(&$request){
	$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])/i";
	foreach ($request as $k => $v) {
		if (preg_match($pattern, $k, $match)) {
			die("SQL Injection denied!");
		}

		if (is_array($v)) {
			filter_injection($v);
		} else {

			if (preg_match($pattern, $v, $match)) {
				die("SQL Injection denied!");
			}
		}
	}

}

/**
 * @doc 过滤请求
 * @param $request
 * @author Heanes
 * @time 2015-07-08 17:05:12
 */
function filter_request(&$request){
	if (get_magic_quotes_gpc()) {
		foreach ($request as $k => $v) {
			if (is_array($v)) {
				filter_request($request[$k]);
			} else {
				$request[$k] = stripslashes(trim($v));
			}
		}
	}
}

/**
 * @doc 递归对数组值字符前添加反斜杠
 * @param $request
 * @author Heanes
 * @time 2015-07-08 17:08:11
 */
function addDeepsLashes(&$request){
	foreach ($request as $k => $v) {
		if (is_array($v)) {
			addDeepsLashes($request[$k]);
		} else {
			$request[$k] = addslashes(trim($v));
		}
	}
}

/**
 * @doc 递归去掉数组值字符反斜杠
 * @param $request
 * @author Heanes
 * @time 2015-07-08 17:08:11
 */
function stripDeepsLashes(&$request){
	if (is_array($request)) {
		foreach ($request as $k => $v) {
			if (is_array($v)) {
				stripDeepsLashes($request[$k]);
			} else {
				$request[$k] = stripslashes(trim($v));
			}
		}
	} else
		$request = stripslashes($request);
}

/**
 * @doc 将不是UTF-8编码的请求转码成UTF-8编码
 * @param $req
 * @author Heanes
 * @time 2015-07-08 17:06:52
 */
function convert_req(&$req){
	foreach ($req as $k => $v) {
		if (is_array($v)) {
			convert_req($req[$k]);
		} else {
			if (!is_u8($v)) {
				$req[$k] = iconv("gbk", "utf-8", $v);
			}
		}
	}
}

/**
 * @doc 检测是否是UTF-8编码
 * @param $string
 * @return int
 * @author Heanes
 * @time 2015-07-08 17:06:14
 */
function is_u8($string){
	return preg_match('%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string);
}

/**
 *
 * function qrcode(){
 *     $filename='qrcode.png';
 *     $logo=SITE_PATH."\\Public\\Home\\images\\logo_80.png";
 *     qrcode('http://www.dellidc.com',$filename,false,$logo,8,'L',2,true);
 * }
 * @param string $data 二维码包含的文字内容
 * @param string $filename 保存二维码输出的文件名称，*.png
 * @param bool $picPath 二维码输出的路径
 * @param bool $logo 二维码中包含的LOGO图片路径
 * @param string $size 二维码的大小
 * @param string $level 二维码编码纠错级别：L、M、Q、H
 * @param int $padding 二维码边框的间距
 * @param bool $saveandprint 是否保存到文件并在浏览器直接输出，true:同时保存和输出，false:只保存文件
 * return string
 */
function qrcode($data,$filename,$picPath=false,$logo=false,$size='4',$level='L',$padding=2,$saveandprint=false){
	include("phpqrcode.phpqrcode");//引入工具包
	// 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
	$path = $picPath?$picPath:"\\Uploads\\Picture\\QRcode"; //图片输出路径
	mkdir($path);
	//在二维码上面添加LOGO
	if(empty($logo) || $logo=== false) { //不包含LOGO
		if ($filename==false) {
			QRcode::png($data, false, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
		}else{
			$filename=$path.'/'.$filename; //合成路径
			QRcode::png($data, $filename, $level, $size, $padding, $saveandprint); //直接输出到浏览器，不含LOGO
		}
	}else { //包含LOGO
		if ($filename==false){
			//$filename=tempnam('','').'.png';//生成临时文件
			die('参数错误');
		}else {
			//生成二维码,保存到文件
			$filename = $path . '\\' . $filename; //合成路径
		}
		QRcode::png($data, $filename, $level, $size, $padding);
		$QR = imagecreatefromstring(file_get_contents($filename));
		$logo = imagecreatefromstring(file_get_contents($logo));
		$QR_width = imagesx($QR);
		$QR_height = imagesy($QR);
		$logo_width = imagesx($logo);
		$logo_height = imagesy($logo);
		$logo_qr_width = $QR_width / 5;
		$scale = $logo_width / $logo_qr_width;
		$logo_qr_height = $logo_height / $scale;
		$from_width = ($QR_width - $logo_qr_width) / 2;
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		if ($filename === false) {
			Header("Content-type: image/png");
			imagepng($QR);
		} else {
			if ($saveandprint === true) {
				imagepng($QR, $filename);
				header("Content-type: image/png");//输出到浏览器
				imagepng($QR);
			} else {
				imagepng($QR, $filename);
			}
		}
	}
	return $filename;
}


/**
 * @doc 转置矩阵
 * @param $arr1
 * @return mixed
 * @author Heanes
 * @time 2015-07-06 18:26:51
 */
function transformArray($arr1){
	for ($i = 0; $i < count($arr1); $i++) {           //确定转置列数
		for ($j = 0; $j < count($arr1[$i]); $j++) {    //确定转置行数
			$arr2[$j][$i] = $arr1[$i][$j];      //将矩阵1的“第i行第j列”的值 赋给 矩阵2的“第j行第i列”
		}
	}
	return $arr2;
	/*
	for($j=0;$j<count($arr2);$j++){              //遍历数组2
		for($i=0;$i<count($arr2[$j]);$i++){
			echo $arr2[$j][$i].'&nbsp';
		}
	}
	*/
}

/**
 * @doc AJAX返回数据
 * @param mixed $data 要返回的数据
 * @author Heanes
 * @time 2015-06-18 16:55:23
 */
function ajax_return($data){
	header("Content-Type:text/html; charset=utf-8");
	ob_clean();
	echo(json_encode($data));
	exit;
}

/**
 * @doc 取得随机数
 * @param int $length 生成随机数的长度
 * @param int $numeric 是否只产生数字随机数 1是0否
 * @return string
 * @author Heanes
 * @time 2015-06-08 13:27:37
 */
function random($length, $numeric = 0){
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for ($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}

	return $hash;
}

/**
 * @doc 生成随机密码
 * @param int $pw_length
 * @return string
 * @author Heanes
 * @time 2015-07-11 16:24:26
 */
function createRandomPassword($pw_length = 4){
	$rand_pwd = '';
	for ($i = 0; $i < $pw_length; $i++) {
		$rand_pwd .= chr(mt_rand(33, 126));
	}
	return $rand_pwd;
}

/**
 * @doc 生成随机用户名(长度6-13)
 * @param int $length
 * @return string
 * @author Heanes
 * @time 2015-07-11 16:23:58
 */
function generateRandomString($length = 6){
	// 密码字符集，可任意添加你需要的字符
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';//!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
	$string = '';
	for ($i = 0; $i < $length; $i++) {
		// 这里提供两种字符获取方式
		// 第一种是使用substr 截取$chars中的任意一位字符；
		// 第二种是取字符数组$chars 的任意元素
		// $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		$string .= $chars[mt_rand(0, strlen($chars) - 1)];
	}
	return $string;
}

/**
 * @doc 生成随机颜色，十六进制
 * @return string
 * @author Heanes
 * @time 2015-07-09 09:08:07
 */
function randomColor(){
	$str = '#';
	for ($i = 0; $i < 6; $i++) {
		$randNum = rand(0, 15);
		switch ($randNum) {
			case 10:
				$randNum = 'A';
				break;
			case 11:
				$randNum = 'B';
				break;
			case 12:
				$randNum = 'C';
				break;
			case 13:
				$randNum = 'D';
				break;
			case 14:
				$randNum = 'E';
				break;
			case 15:
				$randNum = 'F';
				break;
		}
		$str .= $randNum;
	}
	return $str;
}

/**
 * @doc 通过Email显示Gravatar头像
 * @param string $email
 * @param int $scalar
 * @return string
 * @author Heanes
 * @time 2015-07-09 09:11:15
 */
function showGravatar($email = '', $scalar = 32){
	$gravatar_link = 'http://www.gravatar.com/avatar/'.md5($email).'?s='.$scalar;
	return $gravatar_link;
}

/**
 * @doc 编译密码字符
 * @param string $pass 欲被编译的密码
 * @return string md5编译后的字符串
 * @author Heanes
 * @time 2015-03-30 12:58:57
 */
function compile_password($pass){
	return md5($pass);
}

/**
 * @doc 输出定义的常量
 * @param string $key 内部常量键名
 * @author Heanes
 * @time 2015-03-18 13:14:03
 */
function print_constants($key = ''){
	if (empty($key)) {
		$constants_array = get_defined_constants(true);
		print_arr($constants_array);
	} else {
		$constants_array = get_defined_constants(true)[$key];
		print_arr(array('defined_constants['.$key.']' => $constants_array));
	}
}

/**
 * @doc 输出include的文件
 * @author Heanes
 * @time 2015-03-30 16:20:42
 */
function print_included_files(){
	print_arr(array('included_files' => get_included_files()));
}

/**
 * @doc 输出require的文件
 * @author Heanes
 * @time 2015-03-30 16:21:18
 */
function print_required_files(){
	print_arr(array('required_files' => get_required_files()));
}

/**
 * @doc 生成无限分级菜单数
 * @param array $items 源数据
 * @param string $main_id 数据主ID键名称
 * @param string $parent_id 数据父ID键名称
 * @param string $sub_key_name 子分级键名称
 * @return array: 分级菜单树
 * @author Heanes
 * @form 方法一：此方法由 @Tonton 提供 http://levi.cg.am
 * @time 2015-06-12 15:46:57
 */
function generateTree(array $items, $main_id = 'id', $parent_id = 'parent_id', $sub_key_name = 'sub'){
	foreach ($items as $item)
		$items[$item[$parent_id]][$sub_key_name][$item[$main_id]] = &$items[$item[$main_id]];

	return isset($items[0][$sub_key_name]) ? $items[0][$sub_key_name] : array();
}

/**
 * @doc 生成无限分级菜单数
 * @param array $items 源数据
 * @param string $main_id 数据主ID键名称
 * @param string $parent_id 数据父ID键名称
 * @param string $sub_key_name 子分级键名称
 * @return array: 分级菜单树
 * @author Heanes
 * @form 方法二：此方法由 @Xuefen.Tong 提供 http://levi.cg.am
 * @time 2015-06-12 15:46:57
 */
function generateTree2(array $items, $main_id = 'id', $parent_id = 'parent_id', $sub_key_name = 'sub'){
	$tree = array();    //格式化好的树
	foreach ($items as $item)
		if (isset($items[$item[$parent_id]]))
			$items[$item[$parent_id]][$sub_key_name][] = &$items[$item[$main_id]];
		else
			$tree[] = &$items[$item[$main_id]];

	return $tree;
}

/**
 * @doc 对多维数组按某项元素的值进行排序
 * @param array $multi_array 被排序的数组
 * @param string $sort_key 排序参考元素
 * @param int|string $sort_type SORT_ASC-从小到大（默认）|SORT_DESC|从大到小
 * @return array|bool 不是数组|返回排序后的数组
 * @author Heanes
 * @time 2015-06-12 18:25:56
 */
function multi_array_sort($multi_array, $sort_key, $sort_type = SORT_ASC){
	if (is_array($multi_array)) {
		foreach ($multi_array as $row_array) {
			if (is_array($row_array)) {
				$key_array[] = $row_array[$sort_key];
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
	array_multisort($key_array, $sort_type, $multi_array);

	return $multi_array;
}

/**
 * @doc 多维数组递归显示
 * @param array $array 要输出的数组
 * @return boolean
 * @author Heanes
 * @time 2015-03-18 13:13:23
 */
function print_arr($array){
	if (!is_array($array)) {
		echo $array.'is not an array'.'<br/>';

		return false;
	}
	if (is_array($array) && !empty($array)) {
		echo '<div style="width:800px;margin:0 auto;"><table style="border:1px solid #eee;border-spacing:0;border-collapse:collapse;font-size:12px;">';
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				echo '<div style="width:800px;margin:0 auto;"><span style="display:block;background-color:#daf3ff;border: 1px solid #d2e8fa;padding:5px 10px;">'.$key.'</span></div>';
				print_arr($value);
			} else {
				echo '<tr>'.
					'<td style="width:300px;border:1px solid #eee;padding:2px;word-break:break-all;">'.
					$key.
					'</td>'.
					'<td style="width:500px;border:1px solid #eee;padding:2px;word-break:break-all;">'.
					$value.
					'</td>'.
					'</tr>';
			}
		}
		echo '</table></div>';
		return true;
	} else {
		echo 'null';
		return true;
	}
}

/**
 * @doc 解析身份证号得到性别和出身年月
 * @param string $IDNum
 * @return array|null
 * @author Heanes
 * @time 2015-07-28 09:31:57
 */
function parseIDNum($IDNum){
	if (strlen($IDNum) !== 18) {
		echo "对不起，请输入18位身份证号码!";
		return false;
	} else if (preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/", $IDNum)) {
		$year = substr($IDNum, 6, 4);
		$month = substr($IDNum, 10, 2);
		$day = substr($IDNum, 12, 2);
		$date = array($year, $month, $day);
		$codeID = substr($IDNum, -2, -1);
		$man = array(1, 3, 5, 7, 9,);
		$year2 = date('Y');
		$age = $year2 - $year;
		if (in_array($codeID, $man)) {
			$gender = '1';
		} else {
			$gender = '0';
		}
		$info = array(
			'gender'   => $gender,
			'birthday' => $date,
			'age'      => $age
		);
		return $info;
	} else {
		echo "对不起，您输入的身份证号码不合法！";
		return false;
	}
}


/**
 * @doc 产生验证码字符
 * @param string $hash 哈希数
 * @param int $length 验证码字符长度，@todo 目前暂时只能产生4位，底层生成图片类还有问题
 * @return string 产生验证码字符
 * @author Heanes
 * @time 2015-06-17 17:04:35
 */
function makeCaptcha($hash, $length = 4){
	$captcha = random(intval($length) * 2, 1);
	//$format_str='%'.$length.'s';
	$s = sprintf('%04s', base_convert($captcha, 10, 23));
	$captchaUnits = 'ABCEFGHJKMPRTVXY2346789';
	if ($captchaUnits) {
		$captcha = '';
		for ($i = 0; $i < $length; $i++) {
			$unit = ord($s{$i});
			$captcha .= ($unit >= 0x30 && $unit <= 0x39) ? $captchaUnits[$unit - 0x30] : $captchaUnits[$unit - 0x57];
		}
	}
	setFgCookie('captcha'.$hash, encrypt(strtoupper($captcha)."\t".(time())."\t".$hash, MD5_KEY), 31536000);

	return $captcha;
}

/**
 * @doc 验证验证码
 * @param string $hash 哈希数
 * @param string $value 待验证值
 * @return boolean 验证结果
 * @author Heanes
 * @time 2015-06-17 17:04:47
 */
function checkCaptcha($hash, $value){
	list($checkValue, $checkTime, $checkIdHash) = explode("\t", decrypt(getCookie('captcha'.$hash), MD5_KEY));
	$return = $checkValue == strtoupper($value) && $checkIdHash == $hash;
	if (!$return) setFgCookie('captcha'.$hash, '', -3600);

	return $return;
}

/**
 * @doc 设置cookie
 * @param string $name cookie的名称
 * @param string $value cookie的值
 * @param integer $expire cookie有效周期
 * @param string $path cookie 的服务器路径 默认为 /
 * @param string $domain cookie 的域名
 * @param boolean $secure 是否通过安全的 HTTPS 连接来传输 cookie,默认为false
 * @return bool 设置cookie结果
 * @author Heanes
 * @time 2015-06-17 17:06:04
 */
function setFgCookie($name, $value, $expire = 3600, $path = '', $domain = '', $secure = false){
	if (empty($path)) $path = '/';
	if (empty($domain)) $domain = defined('SUBDOMAIN_SUFFIX') ? SUBDOMAIN_SUFFIX : '';
	$name = defined('COOKIE_PRE') ? COOKIE_PRE.$name : strtoupper(substr(md5(MD5_KEY), 0, 4)).'_'.$name;
	$expire = intval($expire) ? intval($expire) : (intval(SESSION_EXPIRE) ? intval(SESSION_EXPIRE) : 3600);
	$result = setcookie($name, $value, time() + $expire, $path, $domain, $secure);
	$_COOKIE[$name] = $value;

	return $result;
}

/**
 * @doc 取得COOKIE的值
 * @param string $name cookie名称
 * @return string cookie值
 * @author Heanes
 * @time 2015-06-17 17:06:18
 */
function getCookie($name = ''){
	$name = defined('COOKIE_PRE') ? COOKIE_PRE.$name : strtoupper(substr(md5(MD5_KEY), 0, 4)).'_'.$name;

	return $_COOKIE[$name];
}

/**
 * @doc 加密函数
 * @param string $txt 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 * @author Heanes
 * @time 2015-06-17 17:06:27
 */
function encrypt($txt, $key = ''){
	if (empty($txt)) return $txt;
	if (empty($key)) $key = md5(MD5_KEY);
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey = "-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
	$nh1 = rand(0, 64);
	$nh2 = rand(0, 64);
	$nh3 = rand(0, 64);
	$ch1 = $chars{$nh1};
	$ch2 = $chars{$nh2};
	$ch3 = $chars{$nh3};
	$nhnum = $nh1 + $nh2 + $nh3;
	$knum = 0;
	$i = 0;
	while (isset($key{$i})) $knum += ord($key{$i++});
	$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3), $nhnum % 8, $knum % 8 + 16);
	$txt = base64_encode(time().'_'.$txt);
	$txt = str_replace(array('+', '/', '='), array('-', '_', '.'), $txt);
	$tmp = '';
	$j = 0;
	$k = 0;
	$tlen = strlen($txt);
	$klen = strlen($mdKey);
	for ($i = 0; $i < $tlen; $i++) {
		$k = $k == $klen ? 0 : $k;
		$j = ($nhnum + strpos($chars, $txt{$i}) + ord($mdKey{$k++})) % 64;
		$tmp .= $chars{$j};
	}
	$tmplen = strlen($tmp);
	$tmp = substr_replace($tmp, $ch3, $nh2 % ++$tmplen, 0);
	$tmp = substr_replace($tmp, $ch2, $nh1 % ++$tmplen, 0);
	$tmp = substr_replace($tmp, $ch1, $knum % ++$tmplen, 0);

	return $tmp;
}

/**
 * @doc 解密函数
 * @param string $txt 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
function decrypt($txt, $key = '', $ttl = 0){
	if (empty($txt)) return $txt;
	if (empty($key)) $key = md5(MD5_KEY);

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey = "-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
	$knum = 0;
	$i = 0;
	$tlen = @strlen($txt);
	while (isset($key{$i})) $knum += ord($key{$i++});
	$ch1 = @$txt{$knum % $tlen};
	$nh1 = strpos($chars, $ch1);
	$txt = @substr_replace($txt, '', $knum % $tlen--, 1);
	$ch2 = @$txt{$nh1 % $tlen};
	$nh2 = @strpos($chars, $ch2);
	$txt = @substr_replace($txt, '', $nh1 % $tlen--, 1);
	$ch3 = @$txt{$nh2 % $tlen};
	$nh3 = @strpos($chars, $ch3);
	$txt = @substr_replace($txt, '', $nh2 % $tlen--, 1);
	$nhnum = $nh1 + $nh2 + $nh3;
	$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3), $nhnum % 8, $knum % 8 + 16);
	$tmp = '';
	$j = 0;
	$k = 0;
	$tlen = @strlen($txt);
	$klen = @strlen($mdKey);
	for ($i = 0; $i < $tlen; $i++) {
		$k = $k == $klen ? 0 : $k;
		$j = strpos($chars, $txt{$i}) - $nhnum - ord($mdKey{$k++});
		while ($j < 0) $j += 64;
		$tmp .= $chars{$j};
	}
	$tmp = str_replace(array('-', '_', '.'), array('+', '/', '='), $tmp);
	$tmp = trim(base64_decode($tmp));

	if (preg_match("/\d{10}_/s", substr($tmp, 0, 11))) {
		if ($ttl > 0 && (time() - substr($tmp, 0, 11) > $ttl)) {
			$tmp = null;
		} else {
			$tmp = substr($tmp, 11);
		}
	}

	return $tmp;
}

/* ---------------------------------------网页功能函数--------------------------------------- */
/**
 * 网页重定向方法
 * 方法一：header("Location: index.php");
 * 方法二：echo "<script>window.location =\"$PHP_SELF\";</script>";
 * 方法三：echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=index.php\">";
 * @param string $url 目的URL
 * @param int $wait_time 跳转前停留时间
 * @author Heanes
 * @time 2015-06-17 16:22:16
 */
function redirect_php_header($url, $wait_time = 0){
	if (!ob_start(!DEBUGMODE ? 'ob_gzhandler' : null)) {
		@ob_start();
	}
	sleep($wait_time);
	header("Location: $url");
}

/**
 * @doc js实现的页面定时跳转
 * @param string $url 目的URL
 * @param string $type 跳转方式，是后退还是替换，go-前进后退方式，replace-替换，浏览器将无法返回或前进
 * @param int $wait_time 跳转前停留时间
 * @author Heanes
 * @time 2015-06-17 16:25:10
 */
function redirect_js($url, $type = 'go', $wait_time = 2){
	$wait_time = intval($wait_time) * 1000;
	switch ($type) {
		case "go":
			echo '<script type="text/javascript">'.
				'window.setTimeout(\'window.location.href="'.$url.'"\','.$wait_time.');'.
				'</script>';
			break;
		case 'replace':
			echo '<script type="text/javascript">window.setTimeout(\'window.location.replace("'.$url.'")\','.$wait_time.');</script>';
			break;
	}
}

//re_url_js("index.php",3);

/**
 * @doc http meta 形式实现的页面定时跳转
 * @param string $url 目的URL
 * @param int $wait_time 跳转前停留时间
 * @author Heanes
 * @time 2015-06-17 16:28:14
 */
function redirect_http_refresh($url, $wait_time = 0){
	echo '<meta http-equiv="Refresh" content="'.$wait_time.'; url="'.$url.'">';

}

/**
 * @doc 插入Html文档类型定义
 * @param string $doctype 指定文档类型， 可以允许的值为：
 *            HTML 4.01 Strict;
 *            HTML 4.01 Transitional;
 *            HTML 4.01 Frameset;
 *            XHTML 1.0 Strict;
 *            XHTML 1.0 Transitional;
 *            XHTML 1.0 Frameset;
 *            XHTML 1.1;
 *            HTML 5;
 * e.g.: echo insert_doctype("HTML 4.01 Transitional");
 * @author Heanes
 * @time 2015-06-17 16:29:50
 */
function html_insert_doctype($doctype){
	$doctype_array = array(
		"HTML 4.01 Strict"       => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
		"HTML 4.01 Transitional" => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
		"HTML 4.01 Frameset"     => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
		"XHTML 1.0 Strict"       => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
		"XHTML 1.0 Transitional" => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
		"XHTML 1.0 Frameset"     => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
		"XHTML 1.1"              => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
		"HTML 5"                 => '<!DOCTYPE html>'
	);

	return $doctype_array[$doctype];
}

/**
 * @doc 向HTML页面插入head部门内容
 * @param string $type 插入类别
 * @param string $value 插入值
 * @return string|NULL 返回标准HTML标签字符串
 * @author Heanes
 * @time 2015-03-30 16:25:46
 */
function html_insert_head($type, $value){
	switch ($type) {
		// 标题
		case 'title':
			return '<title>'.$value.'</title>';
			break;
		// 字符集
		case 'charset':
			return '<meta http-equiv="Content-Type" content="text/html; charset="'.$value."/>";
			break;
		// 网页描述
		case 'description':
			return '<meta name="description" content="'.$value.'"/>';
			break;
		// 网页关键字
		case 'keywords':
			return '<meta name="keywords" content="'.$value.'"/>';
			break;
		// 网页作者
		case 'author':
			return '<meta name="author" content="'.$value.'"/>';
			break;
		//JS脚本资源文件
		case 'javascript_file':
			return '<script type="text/javascript" src='.$value.'"></script>';
			break;
		// JS内联脚本命令
		case 'javascript_inline':
			return '<script type="text/javascript" src='.$value.'"></script>';
			break;
		// CSS样式资源文件
		case 'css_file':
			return '<link rel="stylesheet" type="text/css" href="'.$value.'"/>';
			break;
		// CSS内联样式
		case 'css_inline':
			return '<style type="text/css">'.$value.'</style>';
			break;
		// CSS外联样式，最好不用此方法导入样式
		case 'css_import':
			return '<link rel="stylesheet" type="text/css">@import url("'.$value.'")'.'</style>';
			break;
		// 什么也不做
		default :
			return null;
			break;
	}
}

/**
 * @doc 插入标题
 * @param string $title 标题
 * @author Heanes
 * @time 2015-06-17 16:31:20
 */
function html_head_insert_title($title = 'title'){
	echo '<title>'.$title.'</title>';
}

/**
 * @doc 插入字符集
 * @param string $charset 字符集类型
 * @author Heanes
 * @time 2015-06-17 16:36:30
 */
function html_head_insert_charset($charset = 'utf-8'){
	echo '<meta http-equiv="Content-Type" content="text/html; charset="'.$charset."/>";
}

/**
 * @doc 插入网页描述
 * @param string $description
 * @author Heanes
 * @time 2015-06-17 16:36:59
 */
function html_head_insert_description($description = ''){
	echo '<meta name="description" content="'.$description.'"/>';
}

/**
 * @doc 插入网页关键字
 * @param string $keywords 关键字，多个以半角逗号","隔开
 * @author Heanes
 * @time
 */
function html_head_insert_keywords($keywords = ''){
	echo '<meta name="keywords" content="'.$keywords.'"/>';
}

/**
 * @doc 插入网页作者
 * @param string $author 作者名称
 * @author Heanes
 * @time 2015-06-17 16:38:13
 */
function html_head_insert_author($author){
	echo '<meta name="author" content="'.$author.'"/>';
}

/**
 * @doc 插入JavaScript脚本文件到网页中
 * @param string $js_src JavaScript资源文件路径
 * @author Heanes
 * @time 2015-06-17 16:39:16
 */
function html_insert_javascript_file($js_src){
	echo '<script type="text/javascript" src='.$js_src.'"></script>';
}

/**
 * @doc 插入JavaScript脚本命令到网页中
 * @param string $js_string JavaScript命令
 * @author Heanes
 * @time 2015-06-17 16:39:42
 */
function html_insert_javascript_string($js_string){
	echo '<script type="text/javascript">'.$js_string.'</script>';
}

/**
 * @doc 插入CSS样式表文件到网页中
 * @param string $css_src CSS样式表资源文件路径
 * @author Heanes
 * @time 2015-06-17 16:40:01
 */
function html_insert_css_file($css_src){
	echo '<link rel="stylesheet" type="text/css" href="'.$css_src.'"/>';
}

/**
 * @doc 插入CSS内联样式
 * @param string $css_style CSS内联样式
 * @author Heanes
 * @time 2015-06-17 16:40:19
 */
function html_insert_css_style($css_style){
	echo '<style type="text/css">'.$css_style.'</style>';
}

/**
 * @doc 插入CSS外联import样式资源文件，不推荐采用此方法导入样式
 * @param string $css_file CSS外联样式文件路径
 * @author Heanes
 * @time 2015-06-17 16:40:38
 */
function html_insert_css_file_import($css_file){
	echo '<link rel="stylesheet" type="text/css">@import url("'.$css_file.'")'.'</style>';
}
