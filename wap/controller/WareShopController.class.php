<?php
/**
 * @doc 积分商城
 * @filesource WareShopController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.31 031
 */
defined('InHeanes') or exit('Access Invalid!');

class WareShopController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		if (isset($_GET['id'])) {
			$this->showOp();
		} else {
			//若取分类
			if(isset($_GET['category']) && !empty($_GET['category'])){
				$this->listOp();
			}else{
				//获取幻灯显示
				$slideWapModel=Model('slide_wap');
				$slideWapParam['where']="`is_enable`=1 AND `is_delete`=0";
				$slideWapParam['order']=array('order'=>'ASC');
				$slideWapList=$slideWapModel->getList($slideWapParam);
				foreach ($slideWapList as $key => $value) {
					//从设置中获取该类型文件存储路径，再拼接成完整的文件位置
					$slideWapList[$key]['img_src']=PATH_BASE_FILE_UPLOAD.'wap/image/slide/'.$value['img_src'];
				}
				Tpl::assign('slideWapList',$slideWapList);

				if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
					$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
					$userModel = Model('users');
					$user = $userModel->getOneByID($user_id);
					if($user['avatar_src']){
						$user['avatar_src']=PATH_BASE_FILE_UPLOAD.'user'.DS.$user_id.DS.'avatar'.DS.$user['avatar_src'];
					}
					//用户角色信息
					$userRoleModel = Model('user_role');
					$user['_role'] = $userRoleModel->getOneByID($user['role_id']);
					//用户积分信息
					$userRankModel = Model('user_rank');
					$userRankParam['where'] = "`user_id`='".$user['id']."'";
					$user['_rank'] = $userRankModel->getOne($userRankParam);
					Tpl::assign('user', $user);
				}
				//获取有效产品分类
				$wareCategoryModel = Model('ware_category');
				$wareCategoryParam['where']="`is_enable`=1 AND `is_delete`=0";
				$wareCategoryParam['order']=array('order'=>'ASC');
				$wareCategoryList=$wareCategoryModel->getList($wareCategoryParam);
				foreach ($wareCategoryList as $key => $wareCategory) {
					$wareCategoryList[$key]['img_src']=PATH_BASE_FILE_UPLOAD.'image/ware/category-icon/'.$wareCategory['img_src'];
				}
				Tpl::assign('wareCategoryList',$wareCategoryList);
				Tpl::assign('html_title','金宝街 - 首页');
				//获取所有积分商品列表
				$wareModel=Model('ware');
				$wareParam['where']="`is_enable`=1 AND `is_delete`=0";
				$wareParam['order']=array('order'=>'ASC','insert_time'=>'DESC');
				$page=new Page('20');
				$wareList=$wareModel->getList($wareParam,$page);
				foreach ($wareList as $key=>$ware) {
					$wareList[$key]['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image/ware/'.$ware['id'].'/album/'.$ware['cover_img_src'];
				}
				Tpl::assign('wareList',$wareList);
				Tpl::display();
			}
		}
	}

	/**
	 * @doc 物品列表
	 * @author Heanes
	 * @time 2015-09-10 11:47:00
	 */
	public function listOp(){
		$wareModel=Model('ware');
		$wareParam['where']="`is_enable`=1 AND `is_delete`=0";
		$wareParam['order']=array('order'=>'ASC','insert_time'=>'DESC');
		$wareList=$wareModel->getList($wareParam);
		Tpl::assign('wareList',$wareList);
		Tpl::assign('html_title','积分商品列表');
		Tpl::display();
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
	 * @doc 物品详情
	 * @author Heanes
	 * @time 2015-09-10 11:47:23
	 */
	public function showOp(){
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$ware_id=Filter::doFilter($_GET['id'],'integer');
			//获取角色ID
			if (isset($_SESSION['user_id'])) {
				$user_id = Filter::doFilter($_SESSION['user_id'], 'integer');
				$userModel = Model('users');
				$user = $userModel->getOneByID($user_id);
				//获取收藏情况
				$wareCollectModel=Model('ware_collect');
				$wareCollectParam['where']="`ware_id`='$ware_id' AND `user_id`='$user_id' AND `is_enable`=1 AND `is_delete`=0";
				$wareCollect=$wareCollectModel->getOne($wareCollectParam);
				Tpl::assign('wareCollect',$wareCollect);
			} else {
				$user['role_id'] = 0;
			}
			$wareModel=Model('ware');
			$wareParam['where']="`id`=$ware_id AND `is_enable`=1 AND `is_delete`=0";
			$ware=$wareModel->getOne($wareParam);
			if(count($ware)){
				$ware['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image/ware/'.$ware['id'].'/album/'.$ware['cover_img_src'];
				Tpl::assign('ware',$ware);
				Tpl::assign('html_title','商品详情');
				Tpl::display('wareShop/detail','productApplyLayout');
			}else{
				showError('此商品不存在！');
			}
		}else{
			showError('参数错误！');
		}
	}

	/**
	 * @doc 积分商城物品收藏管理
	 * @author Heanes
	 * @time 2015-09-10 11:45:54
	 */
	public function collectListOp(){
		$this->needLogin();
		$user_id=Filter::doFilter($_SESSION['user_id'],'integer');
		$wareCollectModel=Model('ware_collect');
		$wareCollectParam['field']='ware_id,collect_time';
		$wareCollectParam['where']="`user_id`='$user_id' AND `is_enable`=1";
		$wareCollectParam['order']=array('collect_time'=>'DESC');
		$wareCollectList=$wareCollectModel->getList($wareCollectParam);
		$sql='select'
			.' `c`.`ware_id`, `c`.`collect_time`,`p`.*'
			.' from'
			.' `'.DB_PRE.'ware_collect` `c`, `'.DB_PRE.'ware` `p`'
			.' where'
			.' `c`.`user_id` = '.$user_id
			.' and `c`.`ware_id` = `p`.`id`'
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
		$wareCollectList=$wareCollectModel->executeSql($sql);
		if($wareCollectList){
			//根据收藏日期进行分组，具体到天
			$wareCollectListOrdered=array();
			foreach ($wareCollectList as $key => $wareCollect) {
				$wareCollect['_cover_img_src']=PATH_BASE_FILE_UPLOAD.'image/ware/'.$wareCollect['ware_id'].'/album/'.$wareCollect['cover_img_src'];
				$collect_date=date('Y-m-d',$wareCollect['collect_time']);
				$collect_date_exists=array_column($wareCollectListOrdered,'collect_date');
				if(in_array($collect_date,$collect_date_exists)){
					$collect_date_key=array_search($collect_date,$collect_date_exists);
					$wareCollectListOrdered[$collect_date_key]['collect_date']=$collect_date;
					$wareCollectListOrdered[$collect_date_key]['collect_wares'][]=$wareCollect;
				}else{
					$wareCollectListOrdered[]=array(
						'collect_date'=>$collect_date,
						'collect_wares'=>array($wareCollect));
				}
			}
		}else{
			$wareCollectListOrdered=array();
		}
		Tpl::assign('wareCollectListOrdered',$wareCollectListOrdered);
		Tpl::assign('html_title','积分商品收藏');
		Tpl::display();
	}

	/**
	 * @doc 积分商品收藏
	 * @author Heanes
	 * @time 2015-09-11 09:59:18
	 */
	public function collectOp(){
		if(isset($_POST['ware_id']) && isset($_POST['user_id'])){
			$newWareCollect['ware_id']=Filter::doFilter($_POST['ware_id'],'integer');
			$newWareCollect['user_id']=Filter::doFilter($_POST['user_id'],'integer');
			if(empty($newWareCollect['ware_id']) || empty($newWareCollect['user_id'])){
				ajax_return(array('status'=>'-1','msg'=>'参数错误'));
				exit;
			}
			$wareCollectModel=Model('ware_collect');
			$wareCollectParam['where']="`ware_id`='".$newWareCollect['ware_id']."' AND `user_id`='".$newWareCollect['user_id']."' AND `is_enable`=1";
			$wareCollect=$wareCollectModel->getOne($wareCollectParam);
			if(count($wareCollect)){
				//若已经收藏则取消收藏，将is_delete置为1
				$wareCollect['is_delete']==1 ? $newWareCollect['is_delete']=0 : $newWareCollect['is_delete']=1;
				$wareCollect['is_delete']==1 ? $newWareCollect['collect_time']=getGMTime() : null;
				$newWareCollect['update_time']=getGMTime();
				$wareCollectWhere="`ware_id`='".$newWareCollect['ware_id']."' AND `user_id`='".$newWareCollect['user_id']."' AND `is_enable`=1";
				if($wareCollectModel->update($newWareCollect,$wareCollectWhere)){
					$wareCollect['is_delete']==1 ? $result=array('status'=>1,'msg'=>'收藏成功') : $result=array('status'=>0,'msg'=>'取消收藏成功');
				}else{
					$result=array('status'=>-1,'msg'=>'抱歉，操作失败！');
				}
			}else{
				$newWareCollect['insert_time']=getGMTime();
				$newWareCollect['collect_time']=getGMTime();
				if($wareCollectModel->insert($newWareCollect)){
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