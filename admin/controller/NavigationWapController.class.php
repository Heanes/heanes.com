<?php
/**
 * @doc WAP版面网站导航控制器
 * @filesource NavigationWapController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class NavigationWapController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc WAP版面网站导航列表
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function listOp() {
		$navigationWapModel=Model('navigation_wap');
		$page=new Page(10);
		$navigationWap_list=$navigationWapModel->getList('',$page);
		Tpl::assign('navigationWap_list',$navigationWap_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','WAP版面导航列表');
		Tpl::display('navigationWap/list');
	}

	/**
	 * @doc 获取下拉框父导航ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父导航ID
		$navigationWapModel=Model('navigation_wap');
		$navigationWapArr=$navigationWapModel->getList();
		return $navigationWapArr;
	}
		
	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$navigationWapModel = Model('navigation_wap');
		//获取自增ID
		$lastID = $navigationWapModel->getAutoIncrementId();
		$navigationWapArr=$this->getSelectOption(); //获取下拉框值
		Tpl::assign('navigationWapArr',$navigationWapArr);
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加WAP版面导航');
		Tpl::display();
	}
	
	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newNavigationWap['order']=Filter::doFilter($_POST['order'],'integer');
		$newNavigationWap['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newNavigationWap['name']=Filter::doFilter($_POST['navigation_wap_name'],'string');
		$newNavigationWap['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newNavigationWap['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newNavigationWap['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newNavigationWap['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newNavigationWap['img_src_hover']=Filter::doFilter($_POST['img_src_hover'],'string');
		$newNavigationWap['href_in_hover']=Filter::doFilter($_POST['href_in_hover'],'string');
		$newNavigationWap['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newNavigationWap['update_time']=to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newNavigationWap['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newNavigationWap['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$navigationWapModel=Model('navigation_wap');
		if($navigationWapModel->insert($newNavigationWap)){
			showSuccess('添加成功');
		}else{
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function editOp() {
		$id=Filter::doFilter($_GET['id'],'integer');
		$navigationWapModel=Model('navigation_wap');
		$navigationWap=$navigationWapModel->getOneByID($id);
		//父导航ID
		$navigationWapWhereParam['where']="`id` != '$id'";
		$navigationWapArr=$navigationWapModel->getList($navigationWapWhereParam);
		//array_unshift($navigationWapArr, "0");
		Tpl::assign('navigationWapArr',$navigationWapArr);
		
		Tpl::assign('navigationWap',$navigationWap);
		Tpl::assign('page_title','修改导航栏');
		Tpl::display();
	}

	

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function updateOp() {
		$id=Filter::doFilter($_POST['wap_id'],'integer');
		$newNavigationWap['order']=Filter::doFilter($_POST['order'],'integer');
		$newNavigationWap['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newNavigationWap['name']=Filter::doFilter($_POST['navigation_wap_name'],'string');
		$newNavigationWap['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newNavigationWap['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newNavigationWap['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newNavigationWap['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newNavigationWap['img_src_hover']=Filter::doFilter($_POST['img_src_hover'],'string');
		$newNavigationWap['href_in_hover']=Filter::doFilter($_POST['href_in_hover'],'string');
		$newNavigationWap['create_time']=to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newNavigationWap['update_time']=getGMTime();
		$newNavigationWap['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newNavigationWap['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where="`id`=$id";
		$navigationWapModel=Model('navigation_wap');
		if($navigationWapModel->update($newNavigationWap,$where)){
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

