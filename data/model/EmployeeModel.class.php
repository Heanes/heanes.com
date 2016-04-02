<?php
/**
 * @doc 员工模型类
 * @filesource EmployeeModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:19:08
 */
defined('InHeanes') or exit('Access Invalid!');

class EmployeeModel extends BaseModel{
	private $table = 'employee';

	function __construct($table_name='employee'){
		parent::__construct($table_name);
	}

	/**
	 * @doc 获取某个部门下的员工统计数目
	 * @param integer $department_id 部门ID
	 * @author Heanes
	 * @return int 分类下文章
	 * @time 2015-07-08 11:11:46
	 */
	public function getCountInDepartment($department_id){
		$param = array();
		$param['table'] = $this->table;
		$param['where']="`department_id`='$department_id'";
		return count(DB::select($param));
	}
}

