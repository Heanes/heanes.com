<?php
/**
 * @doc 后台管理用户模型
 * @filesource AdminUserModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-30 15:59:03
 */
defined('InHeanes') or exit('Access Invalid!');

class AdminUserModel extends BaseModel{

	function __construct($table_name='admin_user'){
		parent::__construct($table_name);
	}
	
	/**
	 * @doc 根据查询条件返回单个用户信息
	 * @param array $param 查询条件
	 * @return resource 查询结果
	 * @author Heanes
	 * @time 2015-06-18 11:22:28
	 */
	public function getAdminUser($param){
		$param['table']='admin_user';
		return DB::getRow($param);
	}

	/**
	 * @doc 根据查询条件返回多条用户信息
	 * @param $param
	 * @return array
	 * @author Heanes
	 * @time 2015-06-18 11:33:48
	 */
	public function getAdminUsers($param){
		return DB::select($param);
	}

	/**
	 * @doc 添加新用户
	 * @param array $new_user 新用户数据数组形式
	 * @return bool 添加成功-添加的用户信息|失败
	 * @author Heanes
	 * @time 2015-06-17 18:09:03
	 */
	public function addAdminUser($new_user){
		//插入数据
		if($new_user=DB::insert('admin_user',$new_user)){
			return $new_user;
		}else{
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
	public function updateAdminUser($update_user_data,$where){
		if(DB::update('admin_user',$update_user_data,$where)){
			return true;
		}else{
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
	public function deleteAdminUser($where){
		return DB::delete('admin_user',$where);
	}

	/**
	 * @doc 检查登录
	 * @param array $param 查询参数
	 * @return array 返回单个用户结果 ;
	 * @author Heanes
	 * @time 2015-07-01 09:40:45
	 */
	public function checkLogin($param) {
		if(isset($_SESSION['admin_is_login']) && $_SESSION['admin_is_login'] == '1') {
			@header("Location: ".getReferer());
			exit();
		}else{
			$param['table']='admin_user';
			return DB::getRow($param);
		}
	}
}
