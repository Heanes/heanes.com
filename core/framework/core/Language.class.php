<?php
/**
 * @doc 语言包类
 * @filesource Language.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-01-13 13:50:08
 * @todo 语言包类待完成
 */
final class Language{
	private static $language_content = array();

	/**
	 * @doc 得到数组变量的GBK编码
	 * @param array $key 数组
	 * @return array 数组类型的返回结果
	 */
	public static function getGBK($key){
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($key)){
			if (is_array($key)){
				$result = var_export($key, true);//变为字符串
				$result = iconv('UTF-8','GBK',$result);
				eval("\$result = $result;");//转换回数组
			}else {
				$result = iconv('UTF-8','GBK',$key);
			}
		}else{
			$result=null;
		}
		return $result;
	}
	/**
	 * @doc 得到数组变量的UTF-8编码
	 * @param array $key GBK编码数组
	 * @return array 数组类型的返回结果
	 */
	public static function getUTF8($key){
		/**
		 * 转码
		 */
		if (!empty($key)){
			if (is_array($key)){
				$result = var_export($key, true);//变为字符串
				$result = iconv('GBK','UTF-8',$result);
				eval("\$result = $result;");//转换回数组
			}else {
				$result = iconv('GBK','UTF-8',$key);
			}
		}else{
			$result=null;
		}
		return $result;
	}

	/**
	 * @doc 取指定下标的数组内容
	 * @param string $key 数组下标
	 * @param string $charset 编码方式
	 * @return string 字符串形式的返回结果
	 */
	public static function get($key,$charset = ''){
		$result = self::$language_content[$key] ? self::$language_content[$key] : '';
		if (strtoupper(CHARSET) == 'UTF-8' || strtoupper($charset) == 'UTF-8') return $result;//json格式时不转换
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($result)){
			$result = iconv('UTF-8','GBK',$result);
		}
		return $result;
	}
	/**
	 * @doc 设置指定下标的数组内容
	 * @param string $key 数组下标
	 * @param string $value 值
	 * @return bool 字符串形式的返回结果
	 */
	public static function set($key,$value){
		self::$language_content[$key] = $value;
		return true;
	}
	/**
	 * @doc 通过语言包文件设置语言内容
	 * @param string $file 语言包文件，可以按照逗号(,)分隔
	 * @return bool 布尔类型的返回结果
	 */
	public static function read($file){
		str_replace('，',',',$file);
		$tmp = explode(',',$file);
		foreach ($tmp as $v){
			$tmp_file = PATH_ABS_BASE_APP.'language/'.LANG_TYPE.DS.$v.'.language.php';
			if (file_exists($tmp_file)) {
				require($tmp_file);
				if (!empty($lang) && is_array($lang)) {
					self::$language_content = array_merge(self::$language_content, $lang);
				}
				unset($lang);
			}else{
				//echo $tmp_file.'语言包文件不存在';
			}
		}
		return true;
	}

	/**
	 * @doc 取语言包全部内容
	 * @param string $charset 编码方式
	 * @return array 数组类型的返回结果
	 */
	public static function getLangContent($charset = ''){
		$result = self::$language_content;
		if (strtoupper(CHARSET) == 'UTF-8' || strtoupper($charset) == 'UTF-8') return $result;//json格式时不转换
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($result)){
			if (is_array($result)){
				foreach ($result as $k => $v){
					$result[$k] = iconv('UTF-8','GBK',$v);
				}
			}
		}
		return $result;
	}

	/**
	 * @doc 附加语言数组数组
	 * @param array $lang 语言包数组
	 * @author Heanes
	 * @time 2015-06-11 14:06:01
	 */
	public static function appendLanguage($lang){
		if (!empty($lang) && is_array($lang)){
			self::$language_content = array_merge(self::$language_content,$lang);
		}
	}
}