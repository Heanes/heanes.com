<?php

/**
 * @doc 上海创明网络科技短信接口
 * @filesource transport.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-04 10:11:04
 */
class transport {
	
	/**
	 * @doc 脚本执行时间。－1表示采用PHP的默认值。
	 * @access private
	 * @var integer $time_limit
	 */
	private $time_limit = -1;
	
	/**
	 * @doc 在多少秒之内，如果连接不可用，脚本就停止连接。－1表示采用PHP的默认值。
	 * @access private
	 * @var integer $connect_timeout
	 */
	private $connect_timeout = -1;
	
	/**
	 * @doc 连接后，限定多少秒超时。－1表示采用PHP的默认值。此项仅当采用CURL库时启用。
	 * @access private
	 * @var integer $stream_timeout
	 */
	private $stream_timeout = -1;
	
	/**
	 * @doc 是否使用CURL库来连接。false表示采用fsockopen进行连接。
	 * @access private
	 * @var boolean $use_curl
	 */
	private $use_curl = false;

	private $OpenApi = 'http://smsapi.c123.cn/OpenPlatform/OpenApi';

	private $ac = '1001@501114870001';
	
	private $authkey = 'F332CCF6CCAA7DDA69C09694BEAB620E';
	
	private $cgid = '4298';
	
	private $csid = '101';
	
	var $c = '来自短信接口的测试 By Heanes';
	
	function __construct($params) {
		$params_array = json_decode($params, true);
		if(isset($params_array['user_name']) && isset($params_array['password'])){
			$this->ac = $params_array['user_name'];
			$this->authkey = $params_array['password'];
		}
	}
	
	/**
	 * http://smsapi.c123.cn/OpenPlatform/OpenApi //发送接口
	 * ?action=sendOnce  //发送类型
	 * &ac=1001@501114870001 //账户
	 * &authkey=F332CCF6CCAA7DDA69C09694BEAB620E  //密码
	 * &cgid=52  //通道组编号
	 * &csid=101  //签名编号
	 * &c=%e8%bf%99%e9%87%8c%e6%98%af%e9%87%91%e4%b9%90%e6%b1%87%e7%9f%ad%e4%bf%a1%e5%b9%b3%e5%8f%b0%5b%e9%87%91%e4%b9%90%e6%b1%87%5d  //urlencode()函数，短信内容
	 * &m=15010691715  //接收的手机号
	 * 这里是金乐汇短信平台[金乐汇]
	 * @param string $mobile 电话号码
	 * @param string $content 短信内容
	 * @param string $method 发送方式
	 * @return array 结果数组
	 */
	public function send($mobile, $content, $method = 'POST') {
		
		if (!empty($content)) {
			$this->c = $content;
		}
		
		if (empty($mobile)) {
			return '号码不能为空';
		}
		

		if($method=='POST'){
			$data = array(
				'action'  => 'sendOnce',
				'ac'      => $this->ac,
				'authkey' => $this->authkey,
				'cgid'    => $this->cgid,
				'csid'    => $this->csid,
				'c'       => $this->c,
				'm'       => $mobile,
			);
			$result_string = $this->postData($this->OpenApi, $data);
		}elseif($method=='GET') {
			//拼接短信发送接口
			$api_url =
				$this->OpenApi . '?'
				. 'action=' . 'sendOnce'//$this->aciton
				. '&ac=' . $this->ac
				. '&authkey=' . $this->authkey
				. '&cgid=' . $this->cgid
				. '&csid=' . $this->csid
				. '&c=' . $this->c
				. '&m=' . $mobile;
			//echo $api_url;
			$result_string = $this->getData($api_url);
		}else{
			return '请选择是post还是get方式！';
		}
		//var_dump($result_string);
		
		$result_object = simplexml_load_string($result_string);
		$result = $this->XML2Array($result_object);
		
		return $result;
	}
	
	
	/**
	 * @doc 获取账户余额
	 * @param string $method 请求数据方式
	 * @return array|string 返回
	 * @author Heanes
	 * @time 2015-05-04 16:32:05
	 */
	function get_count_fee($method = 'GET') {
		if($method=='POST'){
			$data = array(
				'action'  => 'getBalance',
				'ac'      => $this->ac,
				'authkey' => $this->authkey,
			);
			$result_string = $this->postData($this->OpenApi, $data);
		}elseif($method=='GET') {
			//拼接查询账户余额接口
			$api_url =
				$this->OpenApi . '?'
				. 'action=' . 'getBalance'
				. '&ac=' . $this->ac
				. '&authkey=' . $this->authkey;
			//echo $api_url;
			$result_string = $this->getData($api_url);
		}else{
			return '请选择是post还是get方式！';
		}

		$result_object = simplexml_load_string($result_string);
		$result_info = $this->XML2Array($result_object);
		
		//对结果进行处理
		$result=array();
		foreach ($result_info as $key => $value) {
			if ($key == 'Item') {
				foreach ($value as $k => $v) {
					$result = $v['remain'];
				}
			}
		}
		return $result;
		
	}
	
	/**
	 * @doc POST方式提交数据
	 * @param string $url 链接
	 * @param array $data 提交数据
	 * @return string 响应字符串
	 * @author Heanes
	 * @time 2015-05-04 17:12:16
	 */
	function postData($url, $data) {
		$crlf = $this->generate_crlf();
		$data = http_build_query($data);
		$opts = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded' . $crlf .
					'Content-Length: ' . strlen($data) . $crlf,
				'content' => $data
			)
		);
		
		$context = stream_context_create($opts);
		$html = file_get_contents($url, false, $context);
		
		return $html;
	}

	/**
	 * @doc get方式请求数据
	 * @param string $url url链接地址
	 * @return string 返回内容
	 * @author Heanes
	 * @time 2015-06-17 09:55:34
	 */
	function getData($url){
		$content = file_get_contents($url);
		return $content;
	}
	
	/**
	 * @doc 从对象中生成数组
	 * @param object $object 对象
	 * @return array array 数组
	 * @author Heanes
	 * @time 2015-06-16 19:05:01
	 */
	function generate_array_from_object($object) {
		$result=array();
		if (is_object($object)) {
			$result = get_object_vars($object);
		}
		foreach ($result as $key => $value) {
			if (is_object($value)) {
				$result[$key] = $this->generate_array_from_object($value);
			}
		}
		return $result;
	}
	
	
	/**
	 * @doc 功能函数，将xml转换为Array
	 * @param string $xml xml字符串
	 * @param boolean $recursive 是否遍历
	 * @return array 结果数组
	 * @author Heanes
	 * @time 2015-05-04 16:16:40
	 */
	function XML2Array($xml, $recursive = true) {
		if (!$recursive) {
			$array = simplexml_load_string($xml);
		} else {
			$array = $xml;
		}

		$newArray = array();
		$array = ( array )$array;
		foreach ($array as $key => $value) {
			$value = ( array )$value;
			if (isset ($value [0])) {
				$newArray [$key] = trim($value [0]);
			} else {
				$newArray [$key] = $this->XML2Array($value, true);
			}
		}
		return $newArray;
	}
	
	
	/**
	 * @doc 产生一个换行符，不同的操作系统会有不同的换行符
	 * @return string 用双引号引用的换行符
	 * @author Heanes
	 * @time 2015-06-17 09:46:37
	 */
	function generate_crlf() {
		if (strtoupper(substr(PHP_OS, 0, 3) === 'WIN')) {
			$crlf = "\r\n";
		} elseif (strtoupper(substr(PHP_OS, 0, 3) === 'MAC')) {
			$crlf = "\r";
		} else {
			$crlf = "\n";
		}
		return $crlf;
	}
	
	
}
