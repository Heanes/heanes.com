<?php
/**
 * @doc 特别专题控制器
 * @filesource SpecialController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-08-18 10:08:00
 */
defined('InHeanes') or exit('Access Invalid!');

class SpecialController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$this->showOp();
		}else{
			$this->defaultOp();
		}
	}

	/**
	 * @doc 专题列表页面
	 * @author Heanes
	 * @time 2015-08-27 11:32:04
	 */
	public function listOp(){
		$specialModel=Model('special');
		$specialParam['where']="`is_enable`=1 AND `is_deleted`=0";
		$special=$specialModel->getList($specialParam);
		Tpl::assign('html_title','专题列表');
		Tpl::display();
	}

	/**
	 * @doc 显示某个专题页面
	 * @author Heanes
	 * @time 2015-08-27 11:32:12
	 */
	public function showOp(){
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$id=Filter::doFilter($_GET['id'],'integer');
			$specialModel=Model('special');
			$specialParam['where']="`is_enable`=1 AND `is_deleted`=0";
			$special=$specialModel->getOneByID($id);
			if($special){
				Tpl::assign('html_title',$special['title']);
				Tpl::display('special'.DS.$special['template_path'].DS.$special['template_file'],'nullContent');
			}else{
				showError('该专题文章不存在！');
			}
		}else{
			showError('参数错误！');
		}
	}

	/**
	 * @doc 专题显示默认页面
	 * @author Heanes
	 * @time 2015-08-27 11:30:06
	 */
	public function defaultOp(){
		Tpl::assign('html_title','专题页默认页面');
		Tpl::display('layout/commingSoon');
	}
}