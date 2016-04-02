<?php
/**
 * @doc 提交数据过滤器
 * @filesource Filter.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.18 018 14:18
 */
defined('InHeanes') or exit('Access Invalid!');
class Filter{
	private $filter_type=array();

	/**
	 * @doc 数据过滤
	 * @param string|array $data 过滤字数据
	 * @param string $type 过滤类型
	 * @return string 处理后符合规则的数据
	 * @author Heanes
	 * @time 2015-06-18 14:20:21
	 */
	public static function doFilter($data ,$type){
		if(is_array($data)){
			foreach ($data as $eky => $value) {
				Filter::doFilter($value ,$type);
			}
		}else{
			switch($type){
				case 'integer':
					return intval($data);
					break;
				case 'string':
					return stripslashes($data);
				case 'mobile':
					return stripslashes($data);
				default:
					return null;
					break;
			}
		}
	}
}
