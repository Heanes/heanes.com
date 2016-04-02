<?php
/**
 * @doc 贷款产品控制器
 * @filesource ProductController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-16 14:44:22
 */
defined('InHeanes') or exit('Access Invalid!');

class ProductController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc 默认控制器
	 * @author Heanes
	 * @time 2015-07-16 14:07:09
	 */
	public function indexOp(){
		if (isset($_GET['id'])) {
			$this->showOp();
		} else {
			//若取分类
			if(isset($_GET['category']) && !empty($_GET['category'])){
				$this->listOp();
			}else{
				//1.获取有效产品分类
				$productCategoryModel = Model('product_category');
				$productCategoryParam['where']="`is_enable`=1 AND `is_delete`=0";
				$productCategoryParam['order']=array('order'=>'ASC');
				$productCategoryList=$productCategoryModel->getList($productCategoryParam);
				foreach ($productCategoryList as $key => $productCategory) {
					$productCategoryList[$key]['img_src']=PATH_BASE_FILE_UPLOAD.'image/product/category-icon/'.$productCategory['img_src'];
				}
				Tpl::assign('productCategoryList',$productCategoryList);
				Tpl::assign('html_title','私人定制贷款产品');
				Tpl::display();
			}
		}
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-16 12:08:39
	 */
	public function listOp(){
		//获取角色ID
		if (isset($_SESSION['user_id'])) {
			$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
			$userModel = Model('users');
			$user = $userModel->getOneByID($user_id);
		} else {
			$user['role_id'] = 0;
		}
		//1.获取有效产品分类
		$productCategoryModel = Model('product_category');
		$productCategoryParam['where']="`is_enable`=1 AND `is_delete`=0";
		$productCategoryParam['order']=array('order'=>'ASC');
		$productCategoryList=$productCategoryModel->getList($productCategoryParam);
		foreach ($productCategoryList as $key => $productCategory) {
			$productCategoryList[$key]['img_src']=PATH_BASE_FILE_UPLOAD.'image/product/category-icon/'.$productCategory['img_src'];
		}
		Tpl::assign('productCategoryList',$productCategoryList);
		//2.获取有效产品类型
		$productTypeModel = Model('product_type');
		$productFieldsModel = Model('product_fields');
		$productFieldsDataModel = Model('product_fields_data');
		$productTypeParam['where']="`is_enable`=1 AND `is_delete`=0";
		$productTypeList=$productTypeModel->getList($productTypeParam);
		$productTypeIn=implode("','",array_column($productTypeList,'id'));
		//3.获取过滤条件列表
		$productFieldsParam['where'] = "(`type_id` IN ('".$productTypeIn."') OR `type_id`='0') AND `as_filter`=1 AND ('".$user['role_id']."'in(`allow_read_role`) OR `allow_read_min_role_level`<='".$user['role_id']."' )AND `is_enable`=1 AND `is_delete`=0";
		$productFieldsParam['group']='name';
		$productFieldsParam['order']=array('order'=>'ASC');
		$productFilterList = $productFieldsModel->getList($productFieldsParam);
		Tpl::assign('productFilterList',$productFilterList);
		//var_dump($productFilterList);
		/*
		foreach ($productList as $key => $product) {
			//3.获取产品类型属性
			$productList[$key]['_type'] = $productTypeModel->getOneByID($product['id']);
			$productFieldsParam['where'] = "(`type_id`='".$productList[$key]['_type']['id']."' OR `type_id`='0') AND `as_filter`=1 AND ('".$user['role_id']."'in(`allow_read_role`) OR `allow_read_min_role_level`<='".$user['role_id']."' )AND `is_enable`=1 AND `is_delete`=0";
			$productList[$key]['_fields'] = $productFieldsModel->getList($productFieldsParam);
			//3.获取产品类型属性值
			foreach ($productList[$key]['_fields'] as $sub_fields_key => $sub_field) {
				$productFieldsDataParam['where'] = "`fields_id`='".$sub_field['id']."' AND `product_id`='".$product['id']."'";
				$productList[$key]['_fieldsData'][] = $productFieldsDataModel->getOne($productFieldsDataParam);
			}
		}
		*/
		//3.获取产品数据
		$productModel = Model('product');
		$page=new Page('10');
		$productParam['where']="`is_enable`=1 AND `is_delete`=0";
		$articleParam['order']=array('order'=>'ASC','insert_time'=>'DESC');
		if(isset($_GET['category']) && !empty($_GET['category'])){
			$category=Filter::doFilter($_GET['category'],'string');
			$productCategoryParam['where'] = "`id`='$category'";
			$productCategory = $productCategoryModel->getOne($productCategoryParam);
			if($productCategory){
				$productParam['where'].=" AND `category_id`='".$productCategory['id']."'";
				$html_title=$productCategory['name'].' -分类文章列表';
			}
		}
		//如果设置了过滤条件
		/*
		if (isset($_GET['filter'])) {
			//通过过滤值查得符合条件的属性值
			$filter_value=Filter::doFilter($_GET['filter'],'string');
			$productFieldsDataParam['where']="`fields_value`='$filter_value'";
			$productFieldsDataParam['field']='product_id';
			$productIDList=$productFieldsDataModel->getList($productFieldsDataParam);
			$productIDIn=implode("','",array_column($productIDList,'product_id'));
			$productParam['where']="`id` IN('$productIDIn')";
		}
		*/
		$productList = $productModel->getList($productParam,$page);
		Tpl::assign('productList', $productList);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('html_title', '产品列表');
		Tpl::display('product/list');
	}

	/**
	 * @doc 分类
	 * @author Heanes
	 * @time 2015-08-31 13:45:19
	 */
	public function categoryOp(){
		$this->listOp();
	}

	/**
	 * @doc 详情
	 * @author Heanes
	 * @time 2015-07-16 13:04:13
	 */
	public function showOp(){
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$id = Filter::doFilter($_GET['id'], 'integer');
			//获取角色ID
			if (isset($_SESSION['user_id'])){
				$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
				$userModel = Model('users');
				$user = $userModel->getOneByID($user_id);
				//获取收藏情况
				$productCollectModel = Model('product_collect');
				$productCollectParam['where'] = "`product_id`='$id' AND `user_id`='$user_id' AND `is_enable`=1 AND `is_delete`=0";
				$productCollect = $productCollectModel->getOne($productCollectParam);
				Tpl::assign('productCollect', $productCollect);
			} else{
				$user['role_id'] = 0;
			}
			$productModel = Model('product');
			$product = $productModel->getOneByID($id);
			//获取product对应类型
			$productTypeModel = Model('product_type');
			$productType = $productTypeModel->getOneByID($product['type_id']);
			//获取product对应类型属性字段
			$productFieldsModel = Model('product_fields');
			$productFieldsParam['where'] = "(`type_id`='" . $productType['id'] . "' OR `type_id`='0') AND ('" . $user['role_id'] . "'in(`allow_read_role`) OR `allow_read_min_role_level`<='" . $user['role_id'] . "' ) AND `is_show`=1 AND `is_enable`=1 AND `is_delete`=0";
			$productFieldsParam['order'] = array('order' => 'ASC');
			$productFieldsList = $productFieldsModel->getList($productFieldsParam);
			//根据字段ID查询该字段的输入值
			$productFieldsDataModel = Model('product_fields_data');
			foreach ($productFieldsList as $key => $productFields) {
				$productFieldsDataParam['where'] = "`fields_id`='" . $productFields['id'] . "' AND `product_id`='$id'";
				$productFieldsList[$key]['fieldsData'] = $productFieldsDataModel->getOne($productFieldsDataParam);
			}
			Tpl::assign('productFieldsList', $productFieldsList);
			Tpl::assign('product', $product);
			Tpl::assign('html_title', '产品详情');
			Tpl::display('product/show', 'productApplyLayout');
		}else{
			showError('参数错误！');
		}
	}

	/**
	 * @doc 产品收藏列表
	 * @author Heanes
	 * @time 2015-08-22 01:30:10
	 */
	public function collectListOp() {
		$this->needLogin();
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		$productCollectModel=Model('product_collect');
		$productCollectParam['field']='product_id,collect_time';
		$productCollectParam['where']="`user_id`='$user_id' AND `is_enable`=1";
		$productCollectParam['order']=array('collect_time'=>'DESC');
		$productCollectList=$productCollectModel->getList($productCollectParam);
		$sql='select'
				.' `c`.`product_id`, `c`.`collect_time`,`p`.`name`, `p`.`cover_img_src`, `p`.`description`, `p`.`loan_type`'
			.' from'
				.' `'.DB_PRE.'product_collect` `c`, `'.DB_PRE.'product` `p`'
			.' where'
				.' `c`.`user_id` = '.$user_id
					.' and `c`.`product_id` = `p`.`id`'
					.' and `c`.`is_enable` = 1 and `p`.`is_enable`=1'
					.' and `c`.`is_delete` = 0 and `p`.`is_delete`=0'
					.' order by'
					.' `c`.`collect_time` desc';
		if(isset($_GET['page']) && !empty($_GET['page'])){
			$limit_start=(Filter::doFilter($_GET['page'],'integer')-1)*10;
			$limit_end  =Filter::doFilter($_GET['page'],'integer')*10;
			$sql.=' limit '.$limit_start.','.$limit_end;
		}else{
			//$sql.=' limit 0,5';
		}
		//echo $sql;
		//@todo 实现分页
		$productCollectList=$productCollectModel->executeSql($sql);
		if($productCollectList){
			//根据收藏日期进行分组，具体到天
			$productCollectListOrdered=array();
			foreach ($productCollectList as $key => $productCollect) {
				$collect_date=date('Y-m-d',$productCollect['collect_time']);
				$collect_date_exists=array_column($productCollectListOrdered,'collect_date');
				if(in_array($collect_date,$collect_date_exists)){
					$collect_date_key=array_search($collect_date,$collect_date_exists);
					$productCollectListOrdered[$collect_date_key]['collect_date']=$collect_date;
					$productCollectListOrdered[$collect_date_key]['collect_products'][]=$productCollect;
				}else{
					$productCollectListOrdered[]=array(
												'collect_date'=>$collect_date,
												'collect_products'=>array($productCollect));
				}
			}
		}else{
			$productCollectListOrdered=array();
		}
		Tpl::assign('productCollectListOrdered',$productCollectListOrdered);
		Tpl::assign('html_title','产品收藏列表');
		Tpl::display('product/collectList');
	}

	/**
	 * @doc 产品收藏功能
	 * @author Heanes
	 * @time 2015-08-21 10:34:24
	 */
	public function collectOp(){
		if(isset($_POST['product_id']) && isset($_POST['user_id'])){
			$newProductCollect['product_id']=Filter::doFilter($_POST['product_id'],'integer');
			$newProductCollect['user_id']=Filter::doFilter($_POST['user_id'],'integer');
			if(empty($newProductCollect['product_id']) || empty($newProductCollect['user_id'])){
				ajax_return(array('status'=>'-1','msg'=>'参数错误'));
				exit;
			}
			$productCollectModel=Model('product_collect');
			$productCollectParam['where']="`product_id`='".$newProductCollect['product_id']."' AND `user_id`='".$newProductCollect['user_id']."' AND `is_enable`=1";
			$productCollect=$productCollectModel->getOne($productCollectParam);
			if(count($productCollect)){
				//若已经收藏则取消收藏，将is_delete置为1
				$productCollect['is_delete']==1 ? $newProductCollect['is_delete']=0 : $newProductCollect['is_delete']=1;
				$productCollect['is_delete']==1 ? $newProductCollect['collect_time']=getGMTime() : null;
				$newProductCollect['update_time']=getGMTime();
				$productCollectWhere="`product_id`='".$newProductCollect['product_id']."' AND `user_id`='".$newProductCollect['user_id']."' AND `is_enable`=1";
				if($productCollectModel->update($newProductCollect,$productCollectWhere)){
					$productCollect['is_delete']==1 ? $result=array('status'=>1,'msg'=>'收藏成功') : $result=array('status'=>0,'msg'=>'取消收藏成功');
				}else{
					$result=array('status'=>-1,'msg'=>'抱歉，操作失败！');
				}
			}else{
				$newProductCollect['insert_time']=getGMTime();
				$newProductCollect['collect_time']=getGMTime();
				if($productCollectModel->insert($newProductCollect)){
					$result=array('status'=>1,'msg'=>'加入收藏成功！');
				}else{
					$result=array('status'=>-1,'msg'=>'抱歉，加入收藏失败，请稍后再试！');
				}
			}
			ajax_return($result);
		}else{
			//显示收藏列表
			$this->collectListOp();
		}
	}
}
