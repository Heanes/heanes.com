<?php
/**
 * @doc 银行存储库控制器
 * @filesource BankController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-08 22:34:49
 */
defined('InHeanes') or exit('Access Invalid!');

class BankController extends BaseAdminController {
	public function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		$this->listOp();
	}

	/**
	 * @doc 银行列表
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function listOp() {
		$bankModel=Model('bank');
		$bankParam=array();
		$bankParam['where']= (empty($bankParam['where'])? '' : 'AND')."`is_enable`=1 AND `is_deleted`=0";
		$page=new Page(10);
		$bank_list=$bankModel->getList($bankParam,$page);
		Tpl::assign('bank_list',$bank_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','银行列表');
		Tpl::display('bank/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function addOp() {
		$bankModel = Model('bank');
		//获取自增ID
		$lastID = $bankModel->getAutoIncrementId();
		Tpl::assign('lastID',$lastID);
		Tpl::assign('page_title','添加银行');
		Tpl::display();
	}
	
	/**
	 * @doc 插入
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function insertOp(){
		$newBank['order']=Filter::doFilter($_POST['bank_order'],'integer');
		$newBank['name']=Filter::doFilter($_POST['bank_name'],'string');
		$newBank['code']=Filter::doFilter($_POST['bank_code'],'string');
		$newBank['img_url']=Filter::doFilter($_POST['img_url'],'string');
		$newBank['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newBank['create_time']=to_timespan(Filter::doFilter($_POST['bank_create_time'],'string'));
		$newBank['update_time']=to_timespan(Filter::doFilter($_POST['bank_update_time'],'string'));
		$newBank['is_commend']=Filter::doFilter($_POST['is_commend'],'integer');
		$newBank['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBank['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBank['description']=Filter::doFilter($_POST['description'],'string');
		$bankModel=Model('bank');
		if($bankModel->insert($newBank)){
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
		$bankModel=Model('bank');
		$bank=$bankModel->getOneByID($id);
		Tpl::assign('bank',$bank);
		Tpl::assign('page_title','修改银行');
		Tpl::display();
	}

	

	/**
	 * @doc 更新
	 * @author Heanes
	 * @time 2015-07-08 22:35:27
	 */
	public function updateOp() {
		$id=Filter::doFilter($_POST['bank_id'],'integer');
		$newBank['order']=Filter::doFilter($_POST['bank_order'],'integer');
		$newBank['name']=Filter::doFilter($_POST['bank_name'],'string');
		$newBank['code']=Filter::doFilter($_POST['bank_code'],'string');
		$newBank['img_url']=Filter::doFilter($_POST['img_url'],'string');
		$newBank['a_href']=Filter::doFilter($_POST['a_href'],'string');
		$newBank['create_time']=to_timespan(Filter::doFilter($_POST['bank_create_time'],'string'));
		$newBank['update_time']=getGMTime();
		$newBank['is_commend']=Filter::doFilter($_POST['is_commend'],'integer');
		$newBank['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newBank['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$newBank['description']=Filter::doFilter($_POST['description'],'string');
		$where="`id`=$id";
		$bankModel=Model('bank');
		if($bankModel->update($newBank,$where)){
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

