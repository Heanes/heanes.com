<?php
/**
 * @doc  贷款快速申请数据存储控制器
 * @filesource MoneyQuickApplyController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-06 10:06:46
 */
defined('InHeanes') or exit('Access Invalid!');

class MoneyQuickApplyController extends BaseAdminController{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 10:10:19
	 */
	public function listOp(){
		$moneyQuickApplyModel=Model('money_quick_apply');
		$page=new Page(10);
		$moneyQuickApply_list=$moneyQuickApplyModel->getList('',$page);
		//产品表
		$productModel=Model('product');
		$adminUserModel=Model('admin_user');
		foreach ($moneyQuickApply_list as $key => $moneyQuickApply) {
			if(!empty($moneyQuickApply)){
				$productInfo=$productModel->getOneByID($moneyQuickApply['product_id']);
				$moneyQuickApply_list[$key]['product_name']=$productInfo['name']; // 产品ID

				$adminUserInfo=$adminUserModel->getOneByID($moneyQuickApply['handle_user_id']);
				$moneyQuickApply_list[$key]['handle_user_name']=$adminUserInfo['user_name']; // 处理人用户ID
			}
		}
		Tpl::assign('moneyQuickApply_list',$moneyQuickApply_list);
		Tpl::assign('pager',$page->getPager());
		Tpl::assign('page_title','贷款快速申请列表');
		Tpl::display('moneyQuickApply/list');
	}

	


	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id=Filter::doFilter($_GET['id'],'integer');
		$moneyQuickApplyModel=Model('money_quick_apply');
		$moneyQuickApply = $moneyQuickApplyModel->getOneByID($id);
		//产品ID
		$productModel=Model('product');
		$product=$productModel->getList();
		Tpl::assign('product',$product);
		//处理人用户ID
		$adminUserModel=Model('admin_user');
		$adminUser=$adminUserModel->getList();
		Tpl::assign('adminUser',$adminUser);

		Tpl::assign('moneyQuickApply',$moneyQuickApply);
		Tpl::assign('page_title','修改贷款快速申请');
		Tpl::display();
	}

	
	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id=Filter::doFilter($_POST['moneyQuickApply_id'],'integer');
		$newQuickApply['order']=Filter::doFilter($_POST['order'],'integer');
		$newQuickApply['product_id']=Filter::doFilter($_POST['product_id'],'string');
		$newQuickApply['real_name']=Filter::doFilter($_POST['real_name'],'string');
		$newQuickApply['phone']=Filter::doFilter($_POST['phone'],'string');
		$newQuickApply['money_want']=Filter::doFilter($_POST['money_want'],'string');
		$newQuickApply['loan_type']=Filter::doFilter($_POST['loan_type'],'integer');
		$newQuickApply['user_ip']=Filter::doFilter($_POST['user_ip'],'string');
		$newQuickApply['is_read']=Filter::doFilter($_POST['is_read'],'string');
		$newQuickApply['read_time']=to_timespan(Filter::doFilter($_POST['read_time'],'string'));
		$newQuickApply['had_contact']=Filter::doFilter($_POST['had_contact'],'string');
		$newQuickApply['is_handle']=Filter::doFilter($_POST['is_handle'],'integer');
		$newQuickApply['handle_user_id']=Filter::doFilter($_SESSION['admin_user_id'],'integer');
		$newQuickApply['handle_result']=Filter::doFilter($_POST['handle_result'],'integer');
		$newQuickApply['handle_desc']=Filter::doFilter($_POST['handle_desc'],'string');
		$newQuickApply['handle_time']=to_timespan(Filter::doFilter($_POST['handle_time'],'string'));
		$newQuickApply['is_recycle']=Filter::doFilter($_POST['is_recycle'],'integer');
		$newQuickApply['is_top']=Filter::doFilter($_POST['is_top'],'string');
		$newQuickApply['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newQuickApply['update_time'] = getGMTime();
		$newQuickApply['is_enable']=Filter::doFilter($_POST['is_enable'],'integer');
		$newQuickApply['is_delete']=Filter::doFilter($_POST['is_delete'],'integer');
		$where="`id`=$id";
		$moneyQuickApplyModel=Model('money_quick_apply');
		if($moneyQuickApplyModel->update($newQuickApply,$where)){
			showSuccess('修改成功');
		}else{
			showError('修改失败');
		}
	}

}
