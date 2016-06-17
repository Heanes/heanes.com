<?php
/**
 * @doc 商品基本信息控制器
 * @filesource GoodsController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class GoodsController extends BaseAdminController {
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
		$goodsModel = Model('goods');
		$page = new Page(10);
		$goods_list = $goodsModel->getList('', $page);
		
		//查询分类表里的分类名称
		$goodsCategoryModel = Model('goods_category');
		//查询类型表里的类型名称
		$goodsTypeModel = Model('goods_type');
		//角色表
		$userRoleModel = Model('user_role');
		foreach ($goods_list as $key => $goods) {
			if(!empty($goods)){
				$goodsCategoryInfo=$goodsCategoryModel->getOneByID($goods['category_id']);
				$goods_list[$key]['category_name']=$goodsCategoryInfo['name']; //分类ID
				
				$goodsTypeInfo=$goodsTypeModel->getOneByID($goods['type_id']);
				$goods_list[$key]['type_name']=$goodsTypeInfo['name']; //类型ID
				
				$userRoleInfo=$userRoleModel->getOneByID($goods['user_role_id']);
				$goods_list[$key]['user_role_name']=$userRoleInfo['name']; //根据role_id查询物品用户角色
			}
		}
		
		Tpl::assign('goods_list', $goods_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '商品基本信息列表');
		Tpl::display('goods/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$goodsModel = Model('goods');
		//获取自增ID
		$lastID = $goodsModel->getAutoIncrementId();
		//下拉框  获取商品分类表的分类名称
		$goodsCategoryModel = Model('goods_category');
		$goodsCategoryList=$goodsCategoryModel->getList();
		Tpl::assign('goodsCategoryList',$goodsCategoryList);
		//属性信息  下拉框  获取商品类型表的类型名称
		$goodsTypeModel = Model('goods_type');
		$goodsTypeList=$goodsTypeModel->getList();
		Tpl::assign('goodsTypeList',$goodsTypeList);
		
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加商品基本信息');
		Tpl::display();
	}
	
	//属性信息   ajax获取
	public function ajaxGetFieldsOp(){
		$type_id=Filter::doFilter($_POST['type_id'], 'integer');
		//根据商品类型去查找该类型属性名称
		$goodsFieldsModel=Model('goods_fields');
		$goodsFieldsParam['where']="`type_id`='$type_id' AND `is_enable`=1 AND `is_deleted`=0";
		$goodsFieldsList=$goodsFieldsModel->getList($goodsFieldsParam);
		
		//选择类型ID下边显示对应的属性信息
		foreach ($goodsFieldsList as $key=>$goodsFields){
			$input_value = $goodsFields['input_value'];
			if(!empty($input_value)){
				$goodsFieldsList[$key]['input_value'] = explode(',',$input_value);
			}
		}
		
		//编辑属性信息
		if(isset($_POST['goods_id'])&& !empty($_POST['goods_id'])){
			$goods_id=Filter::doFilter($_POST['goods_id'], 'integer');
			$goodsFieldsDataModel=Model('goods_fields_data');
			foreach ($goodsFieldsList as $key => $goodsFields) {
				$goodsFieldsDataParam['where']="`fields_id`='".$goodsFields['id']."' AND `goods_id`='$goods_id'";
				$goodsFieldsData=$goodsFieldsDataModel->getOne($goodsFieldsDataParam);
				$goodsFieldsList[$key]['fields_value']=$goodsFieldsData['fields_value'];
			}
		}
		
		ajax_return($goodsFieldsList);
		Tpl::assign('goodsFieldsData',$goodsFieldsData);
	}
	
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newGoods['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoods['name'] = Filter::doFilter($_POST['goods_name'], 'string');
		$newGoods['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$newGoods['type_id'] = $type_fields_id;
		}
		$newGoods['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newGoods['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newGoods['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newGoods['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newGoods['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newGoods['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newGoods['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newGoods['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newGoods['cover_img_title'] = Filter::doFilter($_POST['cover_img_title'], 'string');
		$newGoods['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newGoods['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newGoods['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newGoods['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newGoods['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newGoods['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newGoods['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newGoods['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newGoods['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newGoods['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newGoods['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newGoods['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newGoods['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newGoods['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newGoods['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newGoods['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newGoods['pwd'] = md5($newGoods['pwd']);
		$newGoods['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newGoods['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newGoods['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoods['description'] = Filter::doFilter($_POST['description'], 'string');
		$goodsModel = Model('goods');
		if ($newGoodsID=$goodsModel->insert($newGoods)) {
			//如果有插入额外属性数据
			$flag=true;
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
				$goodsFieldsDataModel=Model('goods_fields_data');
				$goodsFieldsModel=Model('goods_fields');
				
				//根据商品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string');
				$goodsFieldsParam['where']="`type_id`='$type_id'";
				$goodsFieldsList=$goodsFieldsModel->getList($goodsFieldsParam);
				$flag=false;
				foreach($goodsFieldsList as $key=>$goodsFields){
					$newGoodsFieldsData['fields_id'] = $goodsFieldsList[$key]['id'];
					$newGoodsFieldsData['goods_id'] = $newGoodsID;
					$newGoodsFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$goodsFieldsList[$key]['id']], 'string');
					$flag=$goodsFieldsDataModel->insert($newGoodsFieldsData);
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
		$goodsModel = Model('goods');
		$goods = $goodsModel->getOneByID($id);
		
		//下拉框  获取商品分类表的分类名称
		$goodsCategoryModel = Model('goods_category');
		$goodsCategoryList=$goodsCategoryModel->getList();
		Tpl::assign('goodsCategoryList',$goodsCategoryList);
		//修改属性信息  下拉框  获取商品类型表的类型名称
		$goodsTypeModel = Model('goods_type');
		$goodsTypeList=$goodsTypeModel->getList();
		Tpl::assign('goodsTypeList',$goodsTypeList);
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('goods', $goods);
		Tpl::assign('page_title', '修改商品基本信息');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['goods_id'], 'integer');
		$where = "`id`=$id";
		$goodsModel = Model('goods');
		$goods=$goodsModel->getOneByID($id);
		$newGoods['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newGoods['name'] = Filter::doFilter($_POST['goods_name'], 'string');
		$newGoods['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//修改类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$old_type_id=$goods['type_id'];
			$newGoods['type_id'] = $type_fields_id;
			//如果有插入额外属性数据
			$fields_data_flag=false;
			//获取类型ID
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			$goodsFieldsDataModel=Model('goods_fields_data');
			$goodsFieldsModel=Model('goods_fields');
			if($type_fields_id == $old_type_id){
				//第一种:默认类型id,根据商品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string');
				$goodsFieldsParam['where']="`type_id`='$type_id'";

				$goodsFieldsList=$goodsFieldsModel->getList($goodsFieldsParam);
				foreach($goodsFieldsList as $key=>$goodsFields){
					$newGoodsInsertData['fields_id'] = $goodsFieldsList[$key]['id'];
					$newGoodsInsertData['goods_id'] = $goods['id'];
					$newGoodsInsertData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$goodsFieldsList[$key]['id']], 'string');
					
					$goodsFieldsParam['where']="`fields_id`='".$newGoodsInsertData['fields_id']."'";
					$goodsFieldsDataList=$goodsFieldsDataModel->getList($goodsFieldsParam);
					//1.属性值为空，执行添加操作
					if (empty($goodsFieldsDataList)) {
						$fields_data_flag=$goodsFieldsDataModel->insert($newGoodsInsertData);
					}else {
						//2.属性值不为空，执行更行操作(对属性映射表的哪条数据进行修改，查询属性映射表id（商品->类型->属性->属性映射id）)
						foreach ($goodsFieldsDataList as $datakey=>$goodsFieldsData){
							$paramwhere = "`id`=$goodsFieldsData[id]";
						}
						$paramwhere="`fields_id`='".$goodsFields['id']."' AND `goods_id`='$id'";
						$fields_data_flag=$goodsFieldsDataModel->update($newGoodsInsertData, $paramwhere);
					}
				}
			}else {
				//1.根据$old_type_id删除原有数据;
				$goodsTypeParam['where']="`type_id`='$old_type_id'";
				$goodsFieldsList=$goodsFieldsModel->getList($goodsTypeParam);
				$goodsFieldsDataId=(array_column($goodsFieldsList,'id'));  //array_column()获取二维数组中某个key的集合
				if (is_array($goodsFieldsDataId)){
					$fieldsId = implode(',', $goodsFieldsDataId);
					$fieds_data_where = "`fields_id` in($fieldsId) AND `goods_id`='".$goods['id']."'";
					$fields_data_flag=$goodsFieldsDataModel->delete($fieds_data_where);
				}
				//2.添加新的fields_data数据
				$goodsFieldsParam['where']="`type_id`='$type_fields_id'";
				$goodsFieldsList=$goodsFieldsModel->getList($goodsFieldsParam);
				foreach($goodsFieldsList as $key=>$goodsFields){
					$newGoodsFieldsData['fields_id'] = $goodsFields['id'];
					$newGoodsFieldsData['goods_id'] = $goods['id'];
					if($_POST['attribute_name'.$goodsFieldsList[$key]['id']]!=''){
						$newGoodsFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$goodsFieldsList[$key]['id']], 'string');
					}
					$goodsFieldsDataModel=Model('goods_fields_data');
					$fields_data_flag=$goodsFieldsDataModel->insert($newGoodsFieldsData);
					unset($newGoodsFieldsData);
				}
			}
		}
		$newGoods['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newGoods['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newGoods['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newGoods['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newGoods['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newGoods['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newGoods['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newGoods['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newGoods['cover_img_title'] = Filter::doFilter($_POST['cover_img_title'], 'string');
		$newGoods['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newGoods['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newGoods['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newGoods['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newGoods['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newGoods['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newGoods['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newGoods['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newGoods['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newGoods['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newGoods['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newGoods['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newGoods['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newGoods['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newGoods['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newGoods['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newGoods['pwd'] = md5($newGoods['pwd']);
		$newGoods['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newGoods['update_time'] = getGMTime();
		$newGoods['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newGoods['description'] = Filter::doFilter($_POST['description'], 'string');
		$goods_flag=$newGoodsID=$goodsModel->update($newGoods, $where);
		if ($goods_flag) {
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
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$goodsModel = Model('goods');
		if ($goodsModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

