<?php
/**
 * @doc 物品基本信息控制器
 * @filesource WareController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-13 23:08:07
 */
defined('InHeanes') or exit('Access Invalid!');

class WareController extends BaseAdminController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 物品基本信息列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$wareModel = Model('ware');
		$page = new Page(10);
		$ware_list = $wareModel->getList('', $page);
		
		//查询分类表里的分类名称
		$wareCategoryModel = Model('ware_category');
		//查询类型表里的类型名称
		$wareTypeModel = Model('ware_type');
		//角色表
		$userRoleModel = Model('user_role');       
		foreach ($ware_list as $key => $ware) {
			if(!empty($ware)){
				$wareCategoryInfo=$wareCategoryModel->getOneByID($ware['category_id']);
				$ware_list[$key]['category_name']=$wareCategoryInfo['name']; //分类ID
				
				$wareTypeInfo=$wareTypeModel->getOneByID($ware['type_id']);
				$ware_list[$key]['type_name']=$wareTypeInfo['name']; //类型ID
				
				$userRoleInfo=$userRoleModel->getOneByID($ware['user_role_id']);
				$ware_list[$key]['user_role_name']=$userRoleInfo['name']; //根据role_id查询物品用户角色
			}
		}
		
		Tpl::assign('ware_list', $ware_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '物品基本信息列表');
		Tpl::display('ware/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$wareModel = Model('ware');
		//获取自增ID
		$lastID = $wareModel->getAutoIncrementId();
		
		//下拉框  获取物品分类表的分类名称
		$wareCategoryModel = Model('ware_category');
		$wareCategoryList=$wareCategoryModel->getList();
		Tpl::assign('wareCategoryList',$wareCategoryList);
		//属性信息  下拉框  获取物品类型表的类型名称
		$wareTypeModel = Model('ware_type');
		$wareTypeList=$wareTypeModel->getList();
		Tpl::assign('wareTypeList',$wareTypeList);
		
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加物品基本信息');
		Tpl::display();
	}
	
	//属性信息   ajax获取
	public function ajaxGetFieldsOp(){
		$type_id=Filter::doFilter($_POST['type_id'], 'integer');
		//根据产品类型去查找该类型属性名称
		$wareFieldsModel=Model('ware_fields');
		$wareFieldsParam['where']="`type_id`='$type_id' AND `is_enable`=1 AND `is_delete`=0";
		$wareFieldsList=$wareFieldsModel->getList($wareFieldsParam);
		
		//选择类型ID下边显示对应的属性信息
		foreach ($wareFieldsList as $key=>$wareFields){
			$input_value = $wareFields['input_value'];
			if(!empty($input_value)){
				$wareFieldsList[$key]['input_value'] = explode(',',$input_value); 
			}
		}
		
		//编辑属性信息
		if(isset($_POST['ware_id'])&& !empty($_POST['ware_id'])){
			$ware_id=Filter::doFilter($_POST['ware_id'], 'integer');
			$wareFieldsDataModel=Model('ware_fields_data');
			foreach ($wareFieldsList as $key => $wareFields) {
				$wareFieldsDataParam['where']="`fields_id`='".$wareFields['id']."' AND `ware_id`='$ware_id'";
				$wareFieldsData=$wareFieldsDataModel->getOne($wareFieldsDataParam);
				$wareFieldsList[$key]['fields_value']=$wareFieldsData['fields_value'];
			}
		}
		
		ajax_return($wareFieldsList);
		Tpl::assign('wareFieldsData',$wareFieldsData);
	}
	
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newWare['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newWare['name'] = Filter::doFilter($_POST['ware_name'], 'string');
		$newWare['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$newWare['type_id'] = $type_fields_id;
		}
		$newWare['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newWare['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newWare['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newWare['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newWare['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newWare['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newWare['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newWare['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newWare['cover_img_title'] = Filter::doFilter($_POST['cover_img_title'], 'string');
		$newWare['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newWare['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newWare['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newWare['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newWare['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newWare['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newWare['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newWare['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newWare['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newWare['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newWare['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newWare['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newWare['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newWare['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newWare['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newWare['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newWare['pwd'] = md5($newWare['pwd']);
		$newWare['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newWare['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'],'string'));
		$newWare['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newWare['description'] = Filter::doFilter($_POST['description'], 'string');
		$wareModel = Model('ware');
		if ($newWareID=$wareModel->insert($newWare)) {
			//如果有插入额外属性数据
			$flag=true;
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
				$wareFieldsDataModel=Model('ware_fields_data');
				$wareFieldsModel=Model('ware_fields');
				
				//根据产品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string'); 
				$wareFieldsParam['where']="`type_id`='$type_id'";
				$wareFieldsList=$wareFieldsModel->getList($wareFieldsParam);
				$flag=false;
				foreach($wareFieldsList as $key=>$wareFields){
					$newWareFieldsData['fields_id'] = $wareFieldsList[$key]['id'];
					$newWareFieldsData['ware_id'] = $newWareID;
					$newWareFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$wareFieldsList[$key]['id']], 'string');
					$flag=$wareFieldsDataModel->insert($newWareFieldsData);
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
		$wareModel = Model('ware');
		$ware = $wareModel->getOneByID($id);
		
		//下拉框  获取产品分类表的分类名称
		$wareCategoryModel = Model('ware_category');
		$wareCategoryList=$wareCategoryModel->getList();
		Tpl::assign('wareCategoryList',$wareCategoryList);
		//修改属性信息  下拉框  获取产品类型表的类型名称
		$wareTypeModel = Model('ware_type');
		$wareTypeList=$wareTypeModel->getList();
		Tpl::assign('wareTypeList',$wareTypeList);
		//查看用户角色
		$userRoleModel = Model('user_role');
		$userRoleList = $userRoleModel->getList();
		Tpl::assign('userRoleList',$userRoleList);
		
		Tpl::assign('ware', $ware);
		Tpl::assign('page_title', '修改物品基本信息');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['ware_id'], 'integer');
		$where = "`id`=$id";
		$wareModel = Model('ware');
		$ware=$wareModel->getOneByID($id);
		$newWare['order'] = Filter::doFilter($_POST['order'], 'integer');
		$newWare['name'] = Filter::doFilter($_POST['ware_name'], 'string');
		$newWare['category_id'] = Filter::doFilter($_POST['category_id'], 'string');
		//修改类型id
		$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
		if(isset($type_fields_id) && !empty($type_fields_id) && $type_fields_id!=0){
			$old_type_id=$ware['type_id'];
			$newWare['type_id'] = $type_fields_id;
			//如果有插入额外属性数据
			$fields_data_flag=false;
			//获取类型ID
			$type_fields_id=Filter::doFilter($_POST['fields_type_id'], 'integer');
			$wareFieldsDataModel=Model('ware_fields_data');
			$wareFieldsModel=Model('ware_fields');
			if($type_fields_id == $old_type_id){
				//第一种:默认类型id,根据物品类型去查找该类型的属性id
				$type_id = Filter::doFilter($_POST['fields_type_id'], 'string');
				$wareFieldsParam['where']="`type_id`='$type_id'";
					
				$wareFieldsList=$wareFieldsModel->getList($wareFieldsParam);
				foreach($wareFieldsList as $key=>$wareFields){
					$newWareInsertData['fields_id'] = $wareFieldsList[$key]['id'];
					$newWareInsertData['ware_id'] = $ware['id'];
					$newWareInsertData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$wareFieldsList[$key]['id']], 'string');
					
					$wareFieldsParam['where']="`fields_id`='".$newWareInsertData['fields_id']."'";
					$wareFieldsDataList=$wareFieldsDataModel->getList($wareFieldsParam);
					//1.属性值为空，执行添加操作
					if (empty($wareFieldsDataList)) {
						$fields_data_flag=$wareFieldsDataModel->insert($newWareInsertData);
					}else {
						//2.属性值不为空，执行更行操作(对属性映射表的哪条数据进行修改，查询属性映射表id（物品->类型->属性->属性映射id）)
						foreach ($wareFieldsDataList as $datakey=>$wareFieldsData){
							$paramwhere = "`id`=$wareFieldsData[id]";
						}
						$paramwhere="`fields_id`='".$wareFields['id']."' AND `ware_id`='$id'";
						$fields_data_flag=$wareFieldsDataModel->update($newWareInsertData, $paramwhere);
					}
				}
			}else {
				//1.根据$old_type_id删除原有数据;
				$wareTypeParam['where']="`type_id`='$old_type_id'";
				$wareFieldsList=$wareFieldsModel->getList($wareTypeParam);
				$wareFieldsDataId=(array_column($wareFieldsList,'id'));  //array_column()获取二维数组中某个key的集合
				if (is_array($wareFieldsDataId)){
					$fieldsId = implode(',', $wareFieldsDataId);
					$fieds_data_where = "`fields_id` in($fieldsId) AND `ware_id`='".$ware['id']."'";
					$fields_data_flag=$wareFieldsDataModel->delete($fieds_data_where);
				}
				//2.添加新的fields_data数据
				$wareFieldsParam['where']="`type_id`='$type_fields_id'";
				$wareFieldsList=$wareFieldsModel->getList($wareFieldsParam);
				foreach($wareFieldsList as $key=>$wareFields){
					$newWareFieldsData['fields_id'] = $wareFields['id'];
					$newWareFieldsData['ware_id'] = $ware['id'];
					if($_POST['attribute_name'.$wareFieldsList[$key]['id']]!=''){
						$newWareFieldsData['fields_value'] = Filter::doFilter($_POST['attribute_name'.$wareFieldsList[$key]['id']], 'string');
					}
					$wareFieldsDataModel=Model('ware_fields_data');
					$fields_data_flag=$wareFieldsDataModel->insert($newWareFieldsData);
					unset($newWareFieldsData);  
				}
			}
		}
		$newWare['short_desc'] = Filter::doFilter($_POST['short_desc'], 'string');
		$newWare['serial'] = Filter::doFilter($_POST['serial'], 'string');
		$newWare['shop_price'] = Filter::doFilter($_POST['shop_price'], 'string');
		$newWare['cost_price'] = Filter::doFilter($_POST['cost_price'], 'string');
		$newWare['market_price'] = Filter::doFilter($_POST['market_price'], 'string');
		$newWare['store_num'] = Filter::doFilter($_POST['store_num'], 'string');
		$newWare['total_sold_num'] = Filter::doFilter($_POST['total_sold_num'], 'string');
		$newWare['cover_img_src'] = Filter::doFilter($_POST['cover_img_src'], 'string');
		$newWare['cover_img_title'] = Filter::doFilter($_POST['cover_img_title'], 'string');
		$newWare['a_href'] = Filter::doFilter($_POST['a_href'], 'string');
		$newWare['a_title'] = Filter::doFilter($_POST['a_title'], 'string');
		$newWare['is_new'] = Filter::doFilter($_POST['is_new'], 'integer');
		$newWare['is_recommend'] = Filter::doFilter($_POST['is_recommend'], 'integer');
		$newWare['is_top'] = Filter::doFilter($_POST['is_top'], 'integer');
		$newWare['is_great'] = Filter::doFilter($_POST['is_great'], 'integer');
		$newWare['allow_comment'] = Filter::doFilter($_POST['allow_comment'], 'integer');
		$newWare['comment_num'] = Filter::doFilter($_POST['comment_num'], 'integer');
		$newWare['comment_score'] = Filter::doFilter($_POST['comment_score'], 'integer');
		$newWare['click_count'] = Filter::doFilter($_POST['click_count'], 'integer');
		$newWare['seo_title'] = Filter::doFilter($_POST['seo_title'], 'string');
		$newWare['seo_keywords'] = Filter::doFilter($_POST['seo_keywords'], 'string');
		$newWare['seo_description'] = Filter::doFilter($_POST['seo_description'], 'string');
		$newWare['user_role_id'] = Filter::doFilter($_POST['user_role_id'], 'string');
		$newWare['user_rank'] = Filter::doFilter($_POST['user_rank'], 'string');
		$newWare['pwd'] = Filter::doFilter($_POST['pwd'], 'string');
		$newWare['pwd'] = md5($newWare['pwd']);
		$newWare['insert_time'] = to_timespan(Filter::doFilter($_POST['insert_time'],'string'));
		$newWare['update_time'] = getGMTime();
		$newWare['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
		$newWare['description'] = Filter::doFilter($_POST['description'], 'string');
		$ware_flag=$newWareID=$wareModel->update($newWare, $where);
		if ($ware_flag) {
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
		$wareModel = Model('ware');
		if ($wareModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
	
	
	
}

