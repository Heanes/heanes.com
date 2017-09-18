<?php
/**
 * @doc 验证码相关处理类
 * @filesource VerifyCodeModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.18 16:34:28
 */
defined('InHeanes') or exit('Access Invalid!');

class VerifyCodeModel extends BaseModel {
	function __construct($table_name='verify_code'){
		parent::__construct($table_name);
	}
	
	public function addVerifyCode($insert_array){
		return DB::insert('verify_code',$insert_array);
	}

	/**
	 * @doc 验证用户输入的验证码是否正确，从数据库中进行验证
	 * @param string $receiver 验证码接收人
	 * @param string $verify_code 验证码
	 * @param string $type 验证类型
	 * @return bool 验证结果
	 * @author Heanes
	 * @time 2015-06-18 17:21:02
	 */
	public function checkVerifyCode($receiver,$verify_code,$type=VERIFY_MOBILE){
		$param['table']='verify_code';
		$param['where']="`receiver`='$receiver' and `verify_code`='$verify_code' and `type`='$type'";
		//var_dump(DB::getRow($param));
		//exit;
		return count(DB::getRow($param)) ? true : false;
	}

	/**
	 * @doc 获取指定期限内发送过的验证码
	 * @param string $receiver 接收者
	 * @param string $type 验证码发送类型
	 * @param int $time_limit 超时时间，分为单位，默认时间为30分钟
	 * @return array 结果数组
	 * @author Heanes
	 * @time 2015-06-25 09:20:14
	 */
	public function getLastVerifyCode($receiver,$type=VERIFY_MOBILE,$time_limit=30){
		$time_limit=getGMTime()-$time_limit*60;
		$param['table']='verify_code';
		$param['where']="`receiver`='$receiver' and `type`='$type' and `create_time`>='$time_limit'";
		$param['order']['create_time']='DESC';
		return DB::select($param);
	}
}
