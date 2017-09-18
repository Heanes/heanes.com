<?php
/**
 * @doc 前台幻灯WAP端管理控制器
 * @filesource SlideWapController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class SlideWapController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function listOp() {
		$slideWapModel=Model('slide_wap');
		$page=new Page(10);
		$slideWap_list=$slideWapModel->getList('',$page);
		Tpl::assign('slideWap_list',$slideWap_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','WAP端幻灯列表');
		Tpl::display('slideWap/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$slideWapModel = Model('slide_wap');
		//获取自增ID
		$lastID = $slideWapModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加幻灯WAP端');
		Tpl::display();
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function editOp() {
		$id=Filter::doFilter($_GET['id'],'integer');
		$slideWapModel=Model('slide_wap');
		$slideWap=$slideWapModel->getOneByID($id);
		Tpl::assign('slideWap',$slideWap);
		Tpl::assign('page_title','修改幻灯WAP端');
		Tpl::display();
	}

	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newSlideWap['order']=Filter::doFilter($_POST['order'],'integer');
		$newSlideWap['name']=Filter::doFilter($_POST['slide_wap_name'],'string');
		$newSlideWap['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newSlideWap['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newSlideWap['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newSlideWap['title']=Filter::doFilter($_POST['title'],'string');
		$newSlideWap['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newSlideWap['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newSlideWap['description']=Filter::doFilter($_POST['description'],'string');
		$newSlideWap['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newSlideWap['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');

		$slideWapModel=Model('slide_wap');
		if($slideWapModel->insert($newSlideWap)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function updateOp() {
		$id=Filter::doFilter($_POST['slideWap_id'],'integer');
		$newSlideWap['order']=Filter::doFilter($_POST['order'],'integer');
		$newSlideWap['name']=Filter::doFilter($_POST['slide_wap_name'],'string');
		$newSlideWap['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newSlideWap['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newSlideWap['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newSlideWap['title']=Filter::doFilter($_POST['title'],'string');
		$newSlideWap['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newSlideWap['update_time']=getGMTime();
		$newSlideWap['description']=Filter::doFilter($_POST['description'],'string');
		$newSlideWap['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newSlideWap['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where="`id`=$id";
		$slideWapModel=Model('slide_wap');
		if($slideWapModel->update($newSlideWap,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function deleteOp() {
		;
	}
}

