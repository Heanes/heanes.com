<?php
/**
 * @doc 短信处理模块
 * @filesource MsgLogModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.18 16:29:23
 */
defined('InHeanes') or exit('Access Invalid!');

class MsgLogModel extends BaseModel {
	
	function __construct() {
		parent::__construct();
	}
	
	public function addMsg($insert_array){
		return DB::insert('msg_log',$insert_array);
	}
}
