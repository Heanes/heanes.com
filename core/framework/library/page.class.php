<?php
/**
 * @doc 数据分页类
 * @filesource Page.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 18:20:10
 */
defined('InHeanes') or exit('Access Invalid!');

class Page {
	/**
	 * @var string url参数中页码参数名
	 */
	private $page_name = 'page';
	/**
	 * @var string url参数中页码大小参数名
	 */
	private $page_size_name='page_size';
	/**
	 * @var int 翻页时最后一条数据，防止用户在翻页时，有新数据插入时影响分页内容
	 */
	private $end_id=1;
	/**
	 * @var int 信息总数
	 */
	private $total_num = 1;
	/**
	 * @var string 页码链接
	 */
	private $page_url = '';
	/**
	 * @var int 每页信息数量，page_size
	 */
	private $page_size = 10;
	/**
	 * @var int 当前页码
	 */
	private $now_page = 1;
	/**
	 * @var int 设置页码总数
	 */
	private $total_page = 1;

	/**
	 * @var int ajax ajax 分页 预留，目前先不使用
	 * 0为不使用，1为使用，默认为0
	 */
	private $ajax = 0;
	/**
	 * @var string 首页
	 */
	private $first_page = 'first_page';
	/**
	 * @var string 末页
	 */
	private $last_page = 'last_page';
	/**
	 * @var string 上一页
	 */
	private $pre_page = 'pre_page';
	/**
	 * @var string 下一页
	 */
	private $next_page = 'next_page';

	/**
	 * @doc 构造函数
	 * @param int $page_size 分页大小
	 *  数据库使用到的方法：
	 *  $this->setTotalNum($total_num);
	 *  $this->getLimitStart();
	 *  $this->getLimitEnd();
	 * @author Heanes
	 * @time 2015-06-11 13:49:31
	 */
	public function __construct($page_size) {
		$this->first_page = 'first_page';
		$this->last_page = 'last_page';
		$this->pre_page = 'pre_page';
		$this->next_page = 'next_page';
		/**
		 * 设置当前页码
		 */
		if(isset($_REQUEST[$this->page_size_name])){
			$page_size=intval($_REQUEST[$this->page_size_name]);
		}
		$this->setPageSize($page_size);
		$this->setNowPage(isset($_GET[$this->page_name])?$_GET[$this->page_name]:0);
	}

	/**
	 * @doc 动态名称取得属性
	 * @param string $key 属性键值
	 * @return string 字符串类型的返回结果
	 */
	public function get($key) {
		return $this->$key;
	}

	/**
	 * @doc 设置属性
	 * @param string $key 属性键值
	 * @param string $value 属性值
	 * @return bool 布尔类型的返回结果
	 */
	public function set($key, $value) {
		return $this->$key = $value;
	}

	/**
	 * @doc 设置url页码参数名
	 * @param string $page_name url中传递页码的参数名
	 * @return bool 布尔类型的返沪结果
	 */
	public function setPageName($page_name) {
		$this->page_name = $page_name;
		return true;
	}

	/**
	 * @doc 设置当前页码
	 * @param int $page 当前页数
	 * @return bool 布尔类型的返回结果
	 */
	public function setNowPage($page) {
		$this->now_page = intval($page) > 0 ? intval($page) : 1;
		return true;
	}

	/**
	 * @doc 设置每页数量
	 * @param int $num 每页显示的信息数
	 * @return bool 布尔类型的返回结果
	 */
	public function setPageSize($num) {
		$this->page_size = intval($num) > 0 ? intval($num) : 10;
		return true;
	}

	/**
	 * @doc 设置信息总数
	 * @param int $total_num 信息总数
	 * @return bool 布尔类型的返回结果
	 */
	public function setTotalNum($total_num) {
		$this->total_num = $total_num;
		return true;
	}

	/**
	 * @doc 取当前页码
	 * @return int 整型类型的返回结果
	 */
	public function getNowPage() {
		return $this->now_page;
	}

	/**
	 * @doc 取页码总数
	 * @return int 整型类型的返回结果
	 */
	public function getTotalPage() {
		if ($this->total_page == 1) {
			$this->setTotalPage();
		}
		return $this->total_page;
	}

	/**
	 * @doc 取信息总数
	 * @return int 整型类型的返回结果
	 */
	public function getTotalNum() {
		return $this->total_num;
	}

	/**
	 * @doc 取每页信息数量
	 * @return int 整型类型的返回结果
	 */
	public function getPageSize() {
		return $this->page_size;
	}

	/**
	 * @doc 取数据库select开始值
	 * @return int 整型类型的返回结果
	 */
	public function getLimitStart() {
		if ($this->getNowPage() == 1) {
			$tmp = 0;
		} else {
			$this->setTotalPage();
			$this->now_page = $this->now_page > $this->total_page ? $this->total_page : $this->now_page;
			$tmp = ($this->getNowPage() - 1) * $this->getPageSize();
		}
		return $tmp;
	}

	/**
	 * @doc 取数据库select结束值
	 * @return int 整型类型的返回结果
	 */
	public function getLimitEnd() {
		$tmp = $this->getNowPage() * $this->getPageSize();
		if ($tmp > $this->getTotalNum()) {
			$tmp = $this->getTotalNum();
		}
		return $tmp;
	}

	/**
	 * @doc 设置页码总数
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function setTotalPage() {
		$this->total_page = ceil($this->getTotalNum() / $this->getPageSize());
	}
	
	/**
	 * @doc 生成分页表示数组
	 * @return array
	 * @author Heanes
	 * @time 2015-06-25 17:08:02
	 */
	public function getPager(){
		$this->setPageUrl();
		return array(
			'page_url'=>$this->page_url,
			'page_name'=>$this->page_name,
			'total_num'=>$this->getTotalNum(),
			'page_size'=>$this->page_size,
			'page_size_name'=>$this->page_size_name,
			'total_page'=>$this->getTotalPage(),
			'pre_page'=>(intval($this->now_page)-1) <= 0 ? 1 : intval($this->now_page)-1 ,
			'next_page'=>(intval($this->now_page)+1) > $this->total_page ? $this->total_page : intval($this->now_page)+1 ,
			'now_page'=>$this->now_page,
		);
	}

	/**
	 * @doc 取url地址，并将分页信息设置到分页中
	 * @return string 字符串类型的返回结果
	 */
	public function setPageUrl() {
		$uri = request_uri();
		//echo $uri.'<br/>';
		$_SERVER['REQUEST_URI'] = $uri;

		//不存在QUERY_STRING（请求参数）时
		if (empty($_SERVER['QUERY_STRING'])) {
			$this->page_url = $_SERVER['REQUEST_URI'] . "?" . $this->page_name . "=";
		}
		//存在请求参数，则判断是否已有分页参数
		else {
			if (stristr($_SERVER['QUERY_STRING'], $this->page_name . '=') || stristr($_SERVER['QUERY_STRING'], $this->page_size_name . '=')) {
				//地址存在页面参数
				//分页大小参数
				$page_size_pattern=$this->page_size_name.'=\d+';
				$this->page_url = preg_replace_callback('/&'.$page_size_pattern.'/', function($r){
					static $n = 0;
					return ! $n++ ? $r[0] : '';
				}, $_SERVER['REQUEST_URI']);
				//页码数参数
				$page_pattern=$this->page_name.'=\d+';
				$this->page_url = preg_replace('/&'.$page_pattern.'/', '', $this->page_url);
				$last = $this->page_url[strlen($this->page_url) - 1];
				if ($last == '?' || $last == '&') {
					$this->page_url .= $this->page_name . "=";
				} else {
					$this->page_url .= '&' . $this->page_name . "=";
				}
			} else {
				$last = $_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI']) - 1];
				if ($last == '?' || $last == '&') {
					$this->page_url .= $_SERVER['REQUEST_URI'] . $this->page_name . "=";
				} else {
					$this->page_url .= $_SERVER['REQUEST_URI'] . '&' . $this->page_name . "=";
				}
			}
		}
		//echo $_SERVER['QUERY_STRING'].'<br/>';
		//echo $this->page_url;
		return true;
	}
}