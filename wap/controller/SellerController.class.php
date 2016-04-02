<?php
/**
 * @doc 业务员控制器
 * @filesource SellerController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-23 11:11:32
 */
defined('InHeanes') or exit('Access Invalid!');

class SellerController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		if (isset($_REQUEST['id'])) {
			$this->showOp();
		} else {
			showError('参数错误！');
		}
	}

	/**
	 * @doc 显示业务员详情
	 * @author Heanes
	 * @time 2015-07-23 11:17:10
	 */
	public function showOp(){
		$user_id=Filter::doFilter($_GET['id'],'integer');
		if($user_id>0){
			$userModel=Model('users');
			$user=$userModel->getOneByID($user_id);
			if(count($user)){
				//用户头像路径的处理
				if($user['avatar_src']){
					$user['avatar_src']=PATH_BASE_FILE_UPLOAD.'user'.DS.$user_id.DS.'avatar'.DS.$user['avatar_src'];
				}
				Tpl::assign('user',$user);
				Tpl::assign('html_title','金乐汇-中国领先的移动互联网金融超市震撼上线，引领贷款行业新潮流，8大亮点邀你来赚。');
				Tpl::display('seller/userNameCard');
			}else{
				showError('不存在此用户！');
			}
		}else{
			showError('参数错误！');
		}
	}
}
