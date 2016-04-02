<?php

/**
 * @doc 核心模型类
 * @filesource Model.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-28 16:28:20
 */
class Model{
	/**
	 * @var string 表名
	 */
	protected $table_name = '';
	/**
	 * @var string 表前缀
	 */
	protected $table_prefix = '';
	/**
	 * @var string 主键名称
	 */
	protected $pk = 'id';
	/**
	 * @var array 表字段
	 */
	protected $fields = array();

	public function __construct($table_name){
		$this->table_name = $table_name;
	}

	/**
	 * @doc 获取列表
	 * @param array $param 参数
	 * @param Page|null $page 分页
	 * @return array
	 * @author Heanes
	 * @time 2015-07-04 17:05:15
	 */
	public function getList($param = array(), $page=null){
		$param['table'] = $this->table_name;
		$result = DB::select($param, $page);
		return $result;
	}

	/**
	 * @doc 获取一条数据，即使查询结果存在多条数据，也仅返回第一条匹配的数据
	 * @param array $param 查询条件，一般根据ID
	 * @return array 结果数据
	 * @author Heanes
	 * @time 2015-07-04 17:12:20
	 */
	public function getOne($param){
		$param['table'] = $this->table_name;
		$result = DB::getRow($param);
		return $result;
	}

	/**
	 * @doc 获取一条数据，即使查询结果存在多条数据，也仅返回第一条匹配的数据
	 * @param array $param 查询条件，一般根据ID
	 * @param Page $page 分页对象
	 * @return array 结果数据
	 * @author Heanes
	 * @time 2015-07-04 17:12:20
	 */
	public function find($param, $page){
		$param['table'] = $this->table_name;
		$result = DB::select($param, $page);
		return $result;
	}

	/**
	 * @doc 查询数据
	 * @param array $param 查询条件
	 * @param string $pager 分页对象
	 * @return array 结果数据
	 * @author Heanes
	 * @time 2015-07-05 02:41:28
	 */
	public function select($param, $pager = ''){
		$param['table'] = $this->table_name;
		$result = DB::select($param, $pager);
		return $result;
	}

	/**
	 * @doc 根据ID获取一条数据
	 * @param integer $id 查询ID
	 * @return array 一条结果数据
	 * @author Heanes
	 * @time 2015-07-04 17:12:20
	 */
	public function getOneByID($id){
		if (intval($id) > 0) {
			$param['table'] = $this->table_name;
			$param['where'] = "`$this->pk`='$id'";
			$result = DB::getRow($param);
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * @doc 插入数据
	 * @param array $insert_array 插入的数据数组
	 * @return bool|int|resource 插入结果
	 * @author Heanes
	 * @time 2015-07-04 17:01:00
	 */
	public function insert($insert_array){
		if (empty($insert_array)) {
			return false;
		}
		$result = DB::insert($this->table_name, $insert_array);
		return $result;
	}

	/**
	 * @doc 更新数据
	 * @param array|string $update_array 新的数据数组
	 * @param string $where 更新条件
	 * @return bool|resource 更新结果
	 * @author Heanes
	 * @time 2015-06-29 14:02:55
	 */
	public function update($update_array, $where){
		if (empty($update_array)) {
			return false;
		}
		$result = DB::update($this->table_name, $update_array, $where);
		return $result;
	}

	/**
	 * @doc 删除一条数据
	 * @param string $where 删除条件
	 * @return bool|resource 删除结果
	 * @author Heanes
	 * @time 2015-07-04 17:06:47
	 */
	public function delete($where){
		$result = DB::delete($this->table_name, $where);
		return $result;
	}

	/**
	 * @doc 根据ID删除一条数据
	 * @param string $id 指定ID
	 * @return bool|resource 删除结果
	 * @author Heanes
	 * @time 2015-07-05 17:54:06
	 */
	public function deleteByID($id){
		if (intval($id) > 0) {
			$where = "`$this->pk`='$id'";
			$result = DB::delete($this->table_name, $where);
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * @doc 获取表的自增ID
	 * @return int 自增ID值
	 * @author Heanes
	 * @time 2015-07-04 14:54:31
	 */
	public function getAutoIncrementID(){
		return DB::getAutoIncrementId($this->table_name);
	}
	/**
	 * @doc 获取上一步插入结果ID
	 * @return int 上一步插入的ID值
	 * @author Heanes
	 * @time 2015-07-03 23:21:00
	 */
	public function getLastInsertID(){
		return DB::getLastId();
	}

	/**
	 * @doc 获取分类树
	 * @param integer $id ID值
	 * @return array 结果树数组
	 * @author Heanes
	 * @time 2015-06-29 16:09:44
	 */
	public function getTreeList($id){
		$treeList = array();
		return $treeList;
	}

	/**
	 * @doc 过滤字段，若不存在于表中则销毁该列数据
	 * @param array $data 数据数组
	 * @return array 处理后的数据数组
	 * @author Heanes
	 * @time 2015-07-04 17:20:05
	 */
	public function filterField($data){
		if (!empty($this->fields[$this->table_name])) {
			foreach ($data as $key => $val) {
				if (!in_array($key, $this->fields[$this->table_name], true)) {
					unset($data[$key]);
				}
			}
		}
		return $data;
	}

	/**
	 * @doc 直接执行sql语句
	 * @author Heanes
	 * @param string $sql sql语句
	 * @return mysqli_result
	 * @time 2015-09-09 11:34:10
	 */
	public function executeSql($sql){
		return DB::executeSql($sql);
	}

	/**
	 * @doc 开始事务
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-07-06 15:48:18
	 */
	public function beginTransaction($host = 'master'){
		DB::beginTransaction($host);
	}

	/**
	 * @doc 提交事务
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-07-06 15:48:44
	 */
	public function commit($host = 'master'){
		DB::commit($host);
	}

	/**
	 * @doc 撤销操作
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-07-06 15:49:27
	 */
	public function rollback($host = 'master'){
		DB::rollback();
	}
}