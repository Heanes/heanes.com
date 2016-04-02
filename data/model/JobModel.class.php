<?php
/**
 * @doc 职位模型类
 * @filesource JobModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-29 15:19:08
 */
defined('InHeanes') or exit('Access Invalid!');

class JobModel extends BaseModel{
	private $table = 'job';

	function __construct($table_name='job'){
		parent::__construct($table_name);
	}

	/**
	 * @doc 获取职位列表
	 * @param array $param 参数
	 * @param string $page 分页
	 * @return array 获取列表结果
	 * @author Heanes
	 * @time 2015-06-29 15:21:19
	 */
	public function getList($param = array(), $page = ''){
		$param['table'] = $this->table;
		$result = DB::select($param, $page);
		return $result;
	}

	/**
	 * @doc 获取一个职位
	 * @param string $job_id 职位ID
	 * @return array|bool
	 * @author Heanes
	 * @time 2015-07-03 14:08:32
	 */
	public function getJob($job_id){
		$param['table'] = $this->table;
		if (intval($job_id) > 0) {
			$param = array();
			$param['table'] = $this->table;
			$param['where'] = '`id`='.intval($job_id);
			$result = DB::getRow($param);
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * @doc 添加职位
	 * @param array|string $newJob 新职位数据数组
	 * @return bool|int|mixed|resource 插入结果
	 * @author Heanes
	 * @time 2015-06-29 17:53:18
	 */
	public function insert($newJob){
		if(empty($newJob)){
			return false;
		}
		$result=DB::insert($this->table,$newJob);
		return $result;
	}
	/**
	 * @doc 更新职位信息
	 * @param array|string $newJob 新职位数据数组
	 * @return bool|resource 更新结果
	 * @author Heanes
	 * @time 2015-06-29 17:53:11
	 */
	public function update($newJob,$where){
		if(empty($newJob)){
			return false;
		}
		$result=DB::update($this->table,$newJob,$where);
		return $result;
	}
}

