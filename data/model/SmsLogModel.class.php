<?php
/**
 * @doc 发送短信记录模块
 * @filesource SmsLogModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.19 019 9:46
 */
defined('InHeanes') or exit('Access Invalid!');

class SmsLogModel extends BaseModel{
	function __construct($table_name = 'sms_log'){
		parent::__construct($table_name);
	}

	/**
	 * @doc 添加一条外发消息记录
	 * @param array $new_sms_log_array 新外发消息记录数据数组
	 * @return bool|int|resource 插入结果
	 * @author Heanes
	 * @time 2015-06-19 10:25:55
	 */
	public function addSmsLog($new_sms_log_array){
		return DB::insert('sms_log', $new_sms_log_array);
	}

	/**
	 * @doc 检测是否发送太频繁
	 * @param string $receiver 信息接收人
	 * @param string $limit_time 限制时间
	 * @return bool
	 * @author Heanes
	 * @time 2015-06-24 16:05:38
	 */
	public function checkLastSendTime($receiver, $limit_time = '30min'){
		$param['table'] = 'sms_log';
		$param['where'] = "`receiver`='$receiver'";
		$param['order'] = 'order by `insert_time`';
		if (count(DB::getRow($param))) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * @doc 获取收信用户上次信息发送时间
	 * @param string $receiver 接收者
	 * @return array 结果
	 * @author Heanes
	 * @time 2015-06-24 17:29:30
	 */
	public function getLastSend($receiver){
		$param['table'] = 'sms_log';
		$param['where'] = "`receiver`='$receiver'";
		$param['order'] = array(
			'insert_time'=>'DESC',
		);
		return DB::getRow($param);
	}
	
}
