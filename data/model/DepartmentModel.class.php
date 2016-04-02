<?php
/**
 * @doc 部门模块
 * @filesource DepartmentModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.25 025 10:53
 */
defined('InHeanes') or exit('Access Invalid!');

class DepartmentModel extends BaseModel{
	private $table='department';

	function __construct($table_name = 'department'){
		parent::__construct($table_name = 'department');
	}

	/**
	 * @doc 获取分类树
	 * @param integer $id ID值
	 * @return array 结果树数组
	 * @author Heanes
	 * @time 2015-06-29 16:09:44
	 */
	public function getTreeList($id){
		$treeList=array();
		return $treeList;
	}

	/**
	 * @doc 删除一个部门
	 * @author hancaiyan
	 * @time 
	 */
	public function deleteOp(){
		if (isset($_REQUEST['id'])) {
			$department_id=Filter::doFilter($_REQUEST['id'],'integer');
			//获取文章数据
			$departmentModel = Model('department');
			if($departmentModel->deleteDepartment($department_id)){
				showSuccess('删除成功');
			}else{
				showError('删除失败');
			}
		} else {
			showError('参数错误');
		}
	}
}

