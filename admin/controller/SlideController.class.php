<?php
/**
 * @doc 前台幻灯管理控制器
 * @filesource SlideController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class SlideController extends BaseAdminController {
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
		$slideModel=Model('slide');
		$page=new Page(10);
		$slide_list=$slideModel->getList('',$page);
		Tpl::assign('slide_list',$slide_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','幻灯列表');
		Tpl::display('slide/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$slideModel = Model('slide');
		//获取自增ID
		$lastID = $slideModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加幻灯');
		Tpl::display();
	}
	

	/**
	 * @doc 文件上传
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */

	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function editOp() {
		$id=Filter::doFilter($_GET['id'],'integer');
		$slideModel=Model('slide');
		$slide=$slideModel->getOneByID($id);
		Tpl::assign('slide',$slide);
		Tpl::assign('page_title','修改幻灯');
		Tpl::display();
	}

	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newSlide['order']=Filter::doFilter($_POST['order'],'integer');
		$newSlide['name']=Filter::doFilter($_POST['slide_name'],'string');
		//$newSlide['img_src']=Filter::doFilter($_POST['uploader_video'],'string');

		$newSlide['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newSlide['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newSlide['title']=Filter::doFilter($_POST['title'],'string');
		$newSlide['create_time']=to_timespan(Filter::doFilter($_POST['slide_create_time'],'string'));
		$newSlide['update_time']=to_timespan(Filter::doFilter($_POST['slide_update_time'],'string'));
		$newSlide['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newSlide['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newSlide['description']=Filter::doFilter($_POST['description'],'string');

		$slideModel=Model('slide');
		if($slideModel->insert($newSlide)){
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
		$id=Filter::doFilter($_POST['slide_id'],'integer');
		$newSlide['order']=Filter::doFilter($_POST['order'],'integer');
		$newSlide['name']=Filter::doFilter($_POST['slide_name'],'string');
		$newSlide['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newSlide['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newSlide['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newSlide['title']=Filter::doFilter($_POST['title'],'string');
		$newSlide['create_time']=to_timespan(Filter::doFilter($_POST['slide_create_time'],'string'));
		$newSlide['update_time']=getGMTime();
		$newSlide['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newSlide['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newSlide['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$slideModel=Model('slide');
		if($slideModel->update($newSlide,$where)){
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

