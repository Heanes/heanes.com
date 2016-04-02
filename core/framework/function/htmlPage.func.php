<?php
/**
 * @doc 页面相关功能函数
 * @filesource htmlPage.func.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.17 017 16:01
 */
defined('InHeanes') or exit('Access Invalid!');
/**
 * @doc 显示成功界面
 * @param string $result 信息内容
 * @param string $redirect 跳转地址，为空则不跳转
 * @param int $time 跳转前停留时间，秒为单位
 * @param bool $is_in_page 是否是弹出层
 * @author Heanes
 * @time 2015-06-17 16:06:18
 */
function showMessage($result,$redirect='',$time=3000,$is_in_page=true){
	Tpl::assign('result',$result);
	Tpl::display('resultMessage/operateResultSuccess');
	if($redirect==''){
		if(isset($_GET['redirect']) && !empty($_GET['redirect'])){
			$redirect=Filter::doFilter($_GET['redirect'],'string');
			redirect_js($redirect,'go',$time);
		}else{
			redirect_js(getReferer(),'go',$time);
		}
	}else{
		redirect_js($redirect,'go',$time);
	}
	if($is_in_page){
		;//@TODO 增加页内弹出层
	}
}

/**
 * @doc 显示成功界面
 * @param array $result 信息内容
 * @param string $redirect 跳转地址，为空则不跳转
 * @param int $time 跳转前停留时间，秒为单位
 * @param bool $is_in_page 是否是弹出层
 * @author Heanes
 * @time 2015-06-17 16:06:18
 */
function showSuccess($result,$redirect='',$time=3000,$is_in_page=true){
	Tpl::assign('result',$result);
	Tpl::display('resultMessage/operateResultSuccess');
	if($redirect==''){
		if(isset($_GET['redirect']) && !empty($_GET['redirect'])){
			$redirect=Filter::doFilter($_GET['redirect'],'string');
			redirect_js($redirect,'go',$time);
		}else{
			redirect_js(getReferer(),'go',$time);
		}
	}else{
		redirect_js($redirect,'go',$time);
	}
	if($is_in_page){
		;//@TODO 增加页内弹出层
	}
}

/**
 * @doc 显示错误界面
 * @param array $result 信息内容数组
 * @param string $redirect 跳转地址，为空则不跳转
 * @param int $time 跳转前停留时间，秒为单位
 * @param bool $is_in_page 是否是弹出层
 * @author Heanes
 * @time 2015-06-17 16:06:18
 */
function showError($result,$redirect='',$time=3000,$is_in_page=true){
	Tpl::assign('result',$result);
	Tpl::display('resultMessage/operateResultFail');
	if($redirect==''){
		if(isset($_GET['redirect']) && !empty($_GET['redirect'])){
			$redirect=Filter::doFilter($_GET['redirect'],'string');
			redirect_js($redirect,'go',$time);
		}else{
			redirect_js(getReferer(),'go',$time);
		}
	}else{
		redirect_js($redirect,'go',$time);
	}
	if($is_in_page){
		;//@TODO 增加页内弹出层
	}
}

/**
 * @doc 显示弹出层信息
 * @param string $type ，success-成功/fail-失败/notice-警告/error-错误/confirm-确认询问/waiting-等待/
 * @param int $time_limit 停留时间
 * @author Heanes
 * @time 2015-06-25 10:07:12
 */
function showPopup($message = '', $url = '',$type='notice',$time_limit=5){
	Tpl::display('resultMessage/operateResultFail');
}
