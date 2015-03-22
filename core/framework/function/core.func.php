<?php
/**
 * @filesource core.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-17 18:02:08
 * @doc 核心函数库
 */
defined('InHeanes') or exit('Access Invalid!');

/* 管理系统功能函数 */
/**
 * 取得系统配置信息
 * @param string $key 取得下标值
 * @return mixed
 * @time 2015-03-18 10:02:09
 */
function C($key){
	if (strpos($key,'.')){
		$key = explode('.',$key);
		if (isset($key[2])){
			return $GLOBALS['congfig_global'][$key[0]][$key[1]][$key[2]];
		}else{
			return $GLOBALS['congfig_global'][$key[0]][$key[1]];
		}
	}else{
		return $GLOBALS['congfig_global'][$key];
	}
}

/**
 * 模型实例化入口
 * @param string $model_name 模型名称
 * @return obj 对象形式的返回结果
 */
function Model($model = null){
	static $_cache = array();
	if (!is_null($model) && isset($_cache[$model])) return $_cache[$model];
	$file_name = PATH_ABS_BASE_DATA.'model/'.$model.'.class.php';
	$class_name = $model.'Model';
	//echo 'file_name='.$file_name.'</br>'.'class_name='.$class_name.'</br>';
	if (!file_exists($file_name)){
		//var_dump($_cache);
		return $_cache[$model] =  new Model($model);
	}else{
		require_once($file_name);
		if (!class_exists($class_name)){
			//var_dump($_cache);
			$error = 'Model Error:  Class '.$class_name.' is not exists!';
			throw_exception($error);
		}else{
			//var_dump(new $class_name());
			return $_cache[$model] = new $class_name();
		}
	}
}

/* 调试功能函数 */

/**
 * 抛出异常
 * @param string $error 异常信息
 * @time 2015-03-18 10:01:58
 */
function throw_exception($error){
	if (!defined('IGNORE_EXCEPTION')){
		//showMessage($error,'','exception');
		echo $error;
	}else{
		echo $error;
		exit();
	}
}

/* 基础功能函数 */

/**
 * @doc 打印定义的常量
 * @param string $key
 * @time 2015-03-18 13:14:03
 */
function print_constants($key='') {
	if (empty($key)) {
		$constants_user=get_defined_constants(true);
		//var_dump($constants_user=get_defined_constants(true));
		foreach_arr($constants_user);
	}else {
		$constants_user=get_defined_constants(true)[$key];
		foreach_arr($constants_user);
		//var_dump($constants_user=get_defined_constants(true)[$key]);
	}
}

/**
 * @doc 多维数组递归显示
 * @param array $array
 * @return boolean
 * @time 2015-03-18 13:13:23
 */
function foreach_arr($array) {
	if (!is_array($array)) {
		return false;
	}
	if (is_array($array) && !empty($array)) {
		echo '<div style="width:800px;margin:0 auto;"><table style="border:1px solid #eee;border-spacing:0;border-collapse:collapse;font-size:12px;">';
		foreach ($array as $key=>$value) {
			if (is_array($value)) {
				echo '<div style="width:800px;margin:0 auto;"><span style="display:block;background-color:#daf3ff;border: 1px solid #d2e8fa;padding:5px 10px;">'.$key.'</span></div>';
				foreach_arr($value);
			}else {
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
	}
}