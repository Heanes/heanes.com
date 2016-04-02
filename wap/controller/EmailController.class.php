<?php
/**
 * @doc email控制器
 * @filesource EmailController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-24 15:59:00
 */
defined('InHeanes') or exit('Access Invalid!');

class EmailController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 发送电子邮件
	 * @author Heanes
	 * @time 2015-06-24 16:00:38
	 */
	public function sendEmailOp(){
		return true;
	}
}
