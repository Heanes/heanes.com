<?php
/**
 * @doc 商品配件基本信息控制器
 * @filesource GoodsAccessoriesController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class GoodsAccessoriesController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 认证方式类别列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$goodsAccessoriesModel = Model('goods_accessories');
		$page = new Page(10);
		$goodsAccessories_list = $goodsAccessoriesModel->getList('', $page);
		//商品名称
		$goodsModel = Model('goods');
		foreach ($goodsAccessories_list as $key => $goodsAccessories) {
			if(!empty($goodsAccessories)){
				$goodsInfo=$goodsModel->getOneByID($goodsAccessories['goods_id']);
				$goodsAccessories_list[$key]['goods_name']=$goodsInfo['name']; //商品ID
			}
		}
		Tpl::assign('goodsAccessories_list', $goodsAccessories_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '商品配件列表');
		Tpl::display('goodsAccessories/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$goodsAccessoriesModel = Model('goods_accessories');
		//获取自增ID
		$lastID = $goodsAccessoriesModel->getAutoIncrementId();
		//商品名称
		$goodsModel = Model('goods');
		$goodsList=$goodsModel->getList();
		Tpl::assign('goodsList',$goodsList);

		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加商品配件');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newGoodsAccessories['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsAccessories['goods_id'] = Filter::doFilter($_POST['goods_id'], 'string');
		$newGoodsAccessories['name'] = Filter::doFilter($_POST['accessories_name'], 'string');
		$newGoodsAccessories['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newGoodsAccessories['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newGoodsAccessories['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$goodsAccessoriesModel = Model('goods_accessories');
		if ($goodsAccessoriesModel->insert($newGoodsAccessories)) {
			showSuccess('添加成功');
		} else {
			showError('添加失败');
		}
	}
	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$goodsAccessoriesModel = Model('goods_accessories');
		$goodsAccessories = $goodsAccessoriesModel->getOneByID($id);
		//商品名称
		$goodsModel = Model('goods');
		$goodsList=$goodsModel->getList();
		Tpl::assign('goodsList',$goodsList);

		Tpl::assign('goodsAccessories', $goodsAccessories);
		Tpl::assign('page_title', '修改商品配件');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['accessories_id'], 'integer');
		$newGoodsAccessories['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoodsAccessories['goods_id'] = Filter::doFilter($_POST['goods_id'], 'string');
		$newGoodsAccessories['name'] = Filter::doFilter($_POST['accessories_name'], 'string');
		$newGoodsAccessories['create_time'] = to_timespan(Filter::doFilter($_POST['create_time'],'string'));
		$newGoodsAccessories['update_time'] = getGMTime();
		$newGoodsAccessories['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$where = "`id`=$id";
		$goodsAccessoriesModel = Model('goods_accessories');
		if ($goodsAccessoriesModel->update($newGoodsAccessories, $where)) {
			showSuccess('修改成功');
		} else {
			showError('修改失败');
		}
	}

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$goodsAccessoriesModel = Model('goods_accessories');
		if ($goodsAccessoriesModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

