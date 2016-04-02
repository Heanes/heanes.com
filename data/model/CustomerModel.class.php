<?php
/**
 * @doc 用户关系模型
 * @filesource CustomerModel.class.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015-07-04 17:54:56
 */
defined('InHeanes') or exit('Access Invalid!');

class CustomerModel extends BaseModel{

	/**
	 * @var string $table 表名
	 */
	private $table = 'customer';

	function __construct($table_name = 'customer'){
		parent::__construct($table_name);
		$this->table = $table_name;
	}


	/**
	 * @doc 添加新用户
	 * @param array $new_user 新用户数据数组形式
	 * @return bool 添加成功-添加的用户信息|失败
	 * @author Heanes
	 * @time 2015-06-17 18:09:03
	 */
	public function addUser($new_user){
		//插入数据
		if ($new_user = DB::insert('customer', $new_user)) {
			return $new_user;
		} else {
			return $new_user;
		}
	}

	/**
	 * @doc 更新用户信息
	 * @param array $update_user_data 更新的用户数据，键值对形式
	 * @param string $where 查询条件
	 * @return bool
	 * @author Heanes
	 * @time 2015-06-18 11:36:02
	 */
	public function updateUser($update_user_data, $where){
		if (DB::update('customer', $update_user_data, $where)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @doc 删除用户
	 * @param string $where 查询条件
	 * @return bool|resource 删除结果
	 * @author Heanes
	 * @time 2015-06-30 16:01:07
	 */
	public function deleteUser($where){
		return DB::delete('customer', $where);
	}
}