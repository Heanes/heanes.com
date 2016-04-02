<?php
/**
 * @doc 产品基本信息控制器
 * @filesource ProductController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class ProductController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$productModel = Model('product');
		$page = new Page(10);
		$product_list = $productModel->getList('', $page);
		
		//查询分类表里的分类名称
		$productCategoryModel = Model('product_category');
		//查询类型表里的类型名称
		$productTypeModel = Model('product_type');
		//角色表
		$userRoleModel = Model('user_role');
		foreach ($product_list as $key => $product) {
			if(!empty($product)){
				$productCategoryInfo=$productCategoryModel->getOneByID($product['category_id']);
				$product_list[$key]['category_name']=$productCategoryInfo['name']; //分类ID
				
				$productTypeInfo=$productTypeModel->getOneByID($product['type_id']);
				$product_list[$key]['type_name']=$productTypeInfo['name']; //类型ID
				
				$userRoleInfo=$userRoleModel->getOneByID($product['user_role_id']);
				$product_list[$key]['user_role_name']=$userRoleInfo['name']; //根据role_id查询物品用户角色
			}
		}
		
		Tpl::assign('product_list', $product_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '产品基本信息列表');
		Tpl::display('product/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$productModel = Model('product');
		//获取自增ID
		$lastID = $productModel->getAutoIncrementId();
		
		//下拉框  获取产品分类表的分类名称
		$productCategoryModel = Model('product_category');
		$productCategoryList=$productCategoryModel->getList();
		Tpl::assign('productCategoryList',$productCategoryList);
		//属性信息  下拉框  获取产品类型表的类型名称
		$productTypeModel = Model('product_type');
		$productTypeList=$productTypeModel->getList();
		Tpl::assign('productTypeList',$productTypeList);
		
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加产品基本信息');
		Tpl::display();
	}
	
	//属性信息   ajax获取
	public function ajaxGetFieldsOp(){
		$type_id=Filter::doFilter($_POST['type_id'], 'integer');
		//根据产品类型去查找该类型属性名称
		$productFieldsModel=Model('product_fields');
		$productFieldsParam['where']="`type_id`='$type_id' AND `is_enable`=1 AND `is_delete`=0";
		$productFieldsList=$productFieldsModel->getList($productFieldsParam);
		
		//选择类型ID下边显示对应的属性信息
		foreach ($productFieldsList as $key=>$productFields){
			$input_value = $productFields['input_value'];
			if(!empty($input_value)){
				$productFieldsList[$key]['input_value'] = explode(',',$input_value); 
			}
		}
		
		//编辑属性信息
		if(isset($_POST['product_id'])&& !empty($_POST['product_id'])){
			$product_id=Filter::doFilter($_POST['product_id'], 'integer');
			$productFieldsDataModel=Model('product_fields_data');
			foreach ($productFieldsList as $key => $productFields) {
				$productFieldsDataParam['where']="`fields_id`='".$productFields['id']."' AND `product_id`='$product_id'";
				$productFieldsData=$productFieldsDataModel->getOne($productFieldsDataParam);
				$productFieldsList[$key]['fields_value']=$productFieldsData['fields_value'];
			}
		}
		
		ajax_return($productFieldsList);
		Tpl::assign('productFieldsData',$productFieldsData);
	}
	
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newProduct['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newProduct['name'] = Filter::doFilter($_POST['product_name'], 'string');
		$newProduct['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$newProduct['type_id'] = $type_fields_id;
		}
		$newProduct['loan_type'] = Filter::doFilter($_POST['loan_type'], 'string');
		$newProduct['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newProduct['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newProduct['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newProduct['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newProduct['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newProduct['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newProduct['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newProduct['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newProduct['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newProduct['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newProduct['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newProduct['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newProduct['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newProduct['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newProduct['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newProduct['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newProduct['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newProduct['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newProduct['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newProduct['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newProduct['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newProduct['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newProduct['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newProduct['pwd'] = md5($newProduct['pwd']);
		$newProduct['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newProduct['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newProduct['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newProduct['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newProduct['description'] = Filter::doFilter($_POST['description'], 'string');
		$productModel = Model('product');
		if ($newProductID=$productModel->insert($newProduct)) {
			//如果有插入额外属性数据
			$flag=true;
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
				$productFieldsDataModel=Model('product_fields_data');
				$productFieldsModel=Model('product_fields');
				
				//根据产品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string'); 
				$productFieldsParam['where']="`type_id`='$type_id'";
				$productFieldsList=$productFieldsModel->getList($productFieldsParam);
				$flag=false;
				foreach($productFieldsList as $key=>$productFields){
					$newProductFieldsData['fields_id'] = $productFieldsList[$key]['id'];
					$newProductFieldsData['product_id'] = $newProductID;
					$newProductFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$productFieldsList[$key]['id']], 'string');
					$flag=$productFieldsDataModel->insert($newProductFieldsData);
					if(!$flag){
						showError('添加失败');
					}
				}
			}
			if($flag){
				showSuccess('添加成功');
			}
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
		$productModel = Model('product');
		$product = $productModel->getOneByID($id);
		
		//下拉框  获取产品分类表的分类名称
		$productCategoryModel = Model('product_category');
		$productCategoryList=$productCategoryModel->getList();
		Tpl::assign('productCategoryList',$productCategoryList);
		//修改属性信息  下拉框  获取产品类型表的类型名称
		$productTypeModel = Model('product_type');
		$productTypeList=$productTypeModel->getList();
		Tpl::assign('productTypeList',$productTypeList);
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('product', $product);
		Tpl::assign('page_title', '修改产品基本信息');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['product_id'], 'integer');
		$where = "`id`=$id";
		$productModel = Model('product');
		$product=$productModel->getOneByID($id);
		$newProduct['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newProduct['name'] = Filter::doFilter($_POST['product_name'], 'string');
		$newProduct['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//修改类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$old_type_id=$product['type_id'];
			$newProduct['type_id'] = $type_fields_id;
			//如果有插入额外属性数据
			$fields_data_flag=false;
			//获取类型ID
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			$productFieldsDataModel=Model('product_fields_data');
			$productFieldsModel=Model('product_fields');
			if($type_fields_id == $old_type_id){
				//第一种:默认类型id,根据产品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string');
				$productFieldsParam['where']="`type_id`='$type_id'";
					
				$productFieldsList=$productFieldsModel->getList($productFieldsParam);
				foreach($productFieldsList as $key=>$productFields){
					$newProductInsertData['fields_id'] = $productFieldsList[$key]['id'];
					$newProductInsertData['product_id'] = $product['id'];
					$newProductInsertData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$productFieldsList[$key]['id']], 'string');
					
					$productFieldsParam['where']="`fields_id`='".$newProductInsertData['fields_id']."'";
					$productFieldsDataList=$productFieldsDataModel->getList($productFieldsParam);
					//1.属性值为空，执行添加操作
					if (empty($productFieldsDataList)) {
						$fields_data_flag=$productFieldsDataModel->insert($newProductInsertData);
					}else {
						//2.属性值不为空，执行更行操作(对属性映射表的哪条数据进行修改，查询属性映射表id（产品->类型->属性->属性映射id）)
						foreach ($productFieldsDataList as $datakey=>$productFieldsData){
							$paramwhere = "`id`=$productFieldsData[id]";
						}
						$paramwhere="`fields_id`='".$productFields['id']."' AND `product_id`='$id'";
						$fields_data_flag=$productFieldsDataModel->update($newProductInsertData, $paramwhere);
					}
				}
			}else {
				//1.根据$old_type_id删除原有数据;
				$productTypeParam['where']="`type_id`='$old_type_id'";
				$productFieldsList=$productFieldsModel->getList($productTypeParam);
				$productFieldsDataId=(array_column($productFieldsList,'id'));  //array_column()获取二维数组中某个key的集合
				if (is_array($productFieldsDataId)){
					$fieldsId = implode(',', $productFieldsDataId);
					$fieds_data_where = "`fields_id` in($fieldsId) AND `product_id`='".$product['id']."'";
					$fields_data_flag=$productFieldsDataModel->delete($fieds_data_where);
				}
				//2.添加新的fields_data数据
				$productFieldsParam['where']="`type_id`='$type_fields_id'";
				$productFieldsList=$productFieldsModel->getList($productFieldsParam);
				foreach($productFieldsList as $key=>$productFields){
					$newProductFieldsData['fields_id'] = $productFields['id'];
					$newProductFieldsData['product_id'] = $product['id'];
					if($_POST['attribute_name'.$productFieldsList[$key]['id']]!=''){
						$newProductFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$productFieldsList[$key]['id']], 'string');
					}
					$productFieldsDataModel=Model('product_fields_data');
					$fields_data_flag=$productFieldsDataModel->insert($newProductFieldsData);
					unset($newProductFieldsData);  
				}
			}
		}
		$newProduct['loan_type'] = Filter::doFilter($_POST['loan_type'], 'string');
		$newProduct['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newProduct['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newProduct['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newProduct['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newProduct['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newProduct['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newProduct['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newProduct['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newProduct['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newProduct['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newProduct['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newProduct['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newProduct['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newProduct['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newProduct['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newProduct['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newProduct['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newProduct['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newProduct['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newProduct['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newProduct['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newProduct['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newProduct['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newProduct['pwd'] = md5($newProduct['pwd']);
		$newProduct['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newProduct['update_time'] = getGMTime();
		$newProduct['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newProduct['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
		$newProduct['description'] = Filter::doFilter($_POST['description'], 'string');
		$product_flag=$newProductID=$productModel->update($newProduct, $where);
		if ($product_flag) {
			if(isset($fields_data_flag) && $fields_data_flag=true){
				showSuccess('修改成功');
			}else{
				showSuccess('修改成功');
			}
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
		$parent_delete_result=parent::deleteOp();
		if($parent_delete_result['status']){
			//删除属性操作
			;
		}
	}

}

