<?php
/**
 * @doc 公共控制器
 * @filesource Controller.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.07.06 006
 */
defined('InHeanes') or exit('Access Invalid!');
class Controller{
	/**
	 * @var string 模型名称，若存在则实例化模型文件，不存在则实例化公共模型文件
	 */
	public $baseModel='';

	/**
	 * @var string 表名
	 */
	public $table_name='';

	public function __construct($baseModel=''){
		$this->baseModel=$baseModel;
	}

	/**
	 * @doc 列表
	 * @author Heanes
	 * @time 2015-07-07 09:50:05
	 */
	public function listOp(){
		;
	}

	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-07-07 09:50:22
	 */
	public function editOp(){
		;
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-07-07 09:50:41
	 */
	public function addOp(){
		;
	}

	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-07-07 09:51:04
	 */
	public function insertOp(){
		;
	}

	/**
	 * @doc 更新操作
	 * @author Heanes
	 * @time 2015-07-07 09:51:23
	 */
	public function updateOp(){
		;
	}

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-09-23 13:53:35
	 */
	public function deleteOp(){
		if (isset($_POST['id']) && isset($_POST['data_object'])) {
			$dataID=Filter::doFilter($_POST['id'],'integer');
			$dataModel = Model(Filter::doFilter($_POST['data_object'],'string'));
			if(isset($_POST['real_delete']) && $_POST['real_delete']=='true'){
				//真实删除
				if($dataModel->deleteByID($dataID)){
					$result=array('status'=>'1','msg'=>'删除成功');
				}else{
					$result=array('status'=>'-1','msg'=>'删除失败');
				}
			}else{
				//置删除位
				$dataWhere="`id`='$dataID'";
				$newData=array('is_delete'=>'1');
				if($db_result=$dataModel->update($newData,$dataWhere)){
					$result=array('status'=>'1','msg'=>'删除成功2',$db_result);
				}else{
					$result=array('status'=>'-1','msg'=>'删除失败2',$db_result);
				}
			}
		} else {
			$result=array('status'=>'-1','msg'=>'参数错误');
		}
		//如果是ajax删除
		if(isset($_POST['is_ajax'])){
			$is_ajax=Filter::doFilter($_POST['is_ajax'],'string');
			if($is_ajax=='true'){
				ajax_return($result);
			}else{
				return $result;
			}
		}else{
			return $result;
		}
	}
}

