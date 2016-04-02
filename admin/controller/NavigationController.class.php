<?php
/**
 * @doc 前台网站导航栏表控制器
 * @filesource NavigationController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class NavigationController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 前台网站导航栏表列表
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function listOp() {
		$navigationModel=Model('navigation');
		$page=new Page(10);
		$navigation_list=$navigationModel->getList('',$page);
		Tpl::assign('navigation_list',$navigation_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','导航栏列表');
		Tpl::display('navigation/list');
	}

	/**
	 * @doc 获取下拉框父导航ID
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function getSelectOption(){
		//父导航ID
		$navigationModel=Model('navigation');
		$navigationArr=$navigationModel->getList();
		return $navigationArr;

	}
		
	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$navigationModel = Model('navigation');
		//获取自增ID
		$lastID = $navigationModel->getAutoIncrementId();
		//获取下拉框值
		$navigationArr = $this->getSelectOption();
		Tpl::assign('navigationArr',$navigationArr);

		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加导航栏');
		Tpl::display();
	}
	
	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newNavigation['name']=Filter::doFilter($_POST['navigation_name'],'string');
		$newNavigation['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newNavigation['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newNavigation['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newNavigation['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newNavigation['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newNavigation['img_src_hover']=Filter::doFilter($_POST['img_src_hover'],'string');
		$newNavigation['href_in_hover']=Filter::doFilter($_POST['href_in_hover'],'string');
		$newNavigation['insert_time']=to_timespan(Filter::doFilter($_POST['navigation_insert_time'],'string'));
		$newNavigation['update_time']=to_timespan(Filter::doFilter($_POST['navigation_update_time'],'string'));
		$newNavigation['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newNavigation['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newNavigation['order']=Filter::doFilter($_POST['order'],'integer');
		$navigationModel=Model('navigation');
		if($navigationModel->insert($newNavigation)){
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
		$navigationModel=Model('navigation');
		$navigation=$navigationModel->getOneByID($id);
		//父导航ID
		$navigationWhereParam['where']="`id` != '$id'";
		$navigationArr=$navigationModel->getList($navigationWhereParam);
		Tpl::assign('navigationArr',$navigationArr);
		
		Tpl::assign('navigation',$navigation);
		Tpl::assign('page_title','修改导航栏');
		Tpl::display();
	}

	

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function updateOp() {
		$id=Filter::doFilter($_POST['navigation_id'],'integer');
		$newNavigation['name']=Filter::doFilter($_POST['navigation_name'],'string');
		$newNavigation['parent_id']=Filter::doFilter($_POST['parent_id'],'integer');
		$newNavigation['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newNavigation['a_title']=Filter::doFilter($_POST['a_title'],'string');
		$newNavigation['a_target']=Filter::doFilter($_POST['a_target'],'integer');
		$newNavigation['img_src']=Filter::doFilter($_POST['img_src'],'string');
		$newNavigation['img_src_hover']=Filter::doFilter($_POST['img_src_hover'],'string');
		$newNavigation['href_in_hover']=Filter::doFilter($_POST['href_in_hover'],'string');
		$newNavigation['insert_time']=to_timespan(Filter::doFilter($_POST['navigation_insert_time'],'string'));
		$newNavigation['update_time']=getGMTime();
		$newNavigation['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newNavigation['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newNavigation['order']=Filter::doFilter($_POST['order'],'integer');
		$where="`id`=$id";
		$navigationModel=Model('navigation');
		if($navigationModel->update($newNavigation,$where)){
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

