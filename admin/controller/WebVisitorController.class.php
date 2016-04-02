<?php
/**
 * @doc 网站访问统计控制器
 * @filesource WebVisitorController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class WebVisitorController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @doc 网站访问统计列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$webWisitorModel = Model('web_visitor');
		$page = new Page(10);
		$webWisitor_list = $webWisitorModel->getList('', $page);
		Tpl::assign('webWisitor_list', $webWisitor_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '网站访问统计列表');
		Tpl::display();
	}

	
	//查看
	public function lookOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$webWisitorModel = Model('web_visitor');
		$webWisitorList = $webWisitorModel->getOneByID($id);
		Tpl::assign('webWisitorList',$webWisitorList);
		Tpl::assign('page_title', '网站访问统计列表');
		Tpl::display();
	}
	
	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$webWisitorModel = Model('web_visitor');
		if ($webWisitorModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

