<?php
/**
 * @doc 验证验证码控制器
 * @filesource CodeController.class.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015.07.27 019 11:20
 */
defined('InHeanes') or exit('Access Invalid!');

class CodeController extends BaseWapController{

	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 发送注册验证码
	 * @return string
	 * @author Carr
	 * @time 2015-07-27 16:50:18
	 */
	public function captcha_codeOp(){
		//检测验证码
		$captcha_code = Filter::doFilter($_POST['captcha'], 'string');
		if (!checkCaptcha('4a0bd59d', $captcha_code)) {
			//showError('图形验证码填写错误');
			$result['status'] = -1;
			$result['msg'] = '验证码填写错误，请重新填写。';
		} else {
			$result['status'] = 1;
		}
		ajax_return($result);
	}
}