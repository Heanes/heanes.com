<?php
/**
 * @doc 验证码控制器
 * @filesource CaptchaController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015年6月8日下午3:31:01
 */
defined('InHeanes') or exit('Access Invalid!');
class CaptchaController{
	
	/**
	 * @doc 产生验证码
	 * @author Heanes
	 * @time 2015-06-08 16:01:58
	 */
	public function makeCaptchaOp(){
		//$refererHost = parse_url($_SERVER['HTTP_REFERER']);
		//$refererHost['host'] .= !empty($refererHost['port']) ? (':'.$refererHost['port']) : '';
	
		$captcha = makeCaptcha($_GET['hash'],4);
		//var_dump($captcha);exit;

		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
	
		$code = new Captcha();
		$code->code = $captcha;
		$code->width = $_GET['width'];
		$code->height = $_GET['height'];
		$code->background = 1;
		$code->adulterate = 1;
		$code->scatter = '';
		$code->color = 1;
		$code->size = 0;
		$code->shadow = 1;
		$code->animator = 0;
		$code->data_path =  PATH_ABS_BASE_DATA.'resource/captcha/';
		ob_clean();//清除缓冲区，避免显示不正常
		$code->display();
	}
	
	/**
	 * @doc AJAX验证
	 * @author Heanes
	 * @time 2015-06-08 16:02:19
	 */
	public function checkOp(){
		if (checkCaptcha($_GET['hash'],$_GET['captcha'])){
			exit('true');
		}else{
			exit('false');
		}
	}
}