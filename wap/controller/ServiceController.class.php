<?php
/**
 * @doc 服务中心
 * @filesource ServiceController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-13 16:43:02
 */
class ServiceController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 联系我们
	 * @author Heanes
	 * @time 2015-08-12 16:14:45
	 */
	public function contactUsOp() {
		Tpl::assign('html_title','联系我们');
		Tpl::display('service/contactUs');
	}

	/**
	 * @doc 投诉建议
	 * @author Heanes
	 * @time 2015-08-14 16:06:51
	 */
	public function suggestOp() {
		if(isSubmit('suggest_form_submit')){
			$this->_insertSuggest();
		}else{
			Tpl::assign('html_title','投诉建议');
			Tpl::display('service/suggest');
		}
	}

	/**
	 * @doc 插入投诉建议数据
	 * @author Heanes
	 * @time 2015-08-14 16:10:00
	 */
	protected function _insertSuggest() {
		//插入数据到意见反馈表中
		$msgBoardModel=Model('msg_board');
		$newMsgBoard['content']=Filter::doFilter($_POST['suggest_content'],'string');
		$newMsgBoard['title']='投诉建议';
		$newMsgBoard['create_time']=getGMTime();
		$newMsgBoard['send_time']=getGMTime();
		$newMsgBoard['sender_ip']=get_client_ip();
		$newMsgBoard['sender_user_id']=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0';
		if($msgBoardModel->insert($newMsgBoard)){
			$result = array(
				'title'   => '提示',
				'message' => '提交成功！',
				'jump'    => array(
					'left'  => array('text' => '确定', 'href' => 'javascript:history.go(-2);'),
				)
			);
			showSuccess($result);
		}else{
			showError('抱歉，提交失败');
		}
	}
}