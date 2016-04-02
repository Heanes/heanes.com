<?php
/**
 * @doc 快速申请
 * @filesource queryModel.class.php
 * @copyright heanes.com
 * @author Carr
 * @time 2015-08-05 17:54:56
 */
defined('InHeanes') or exit('Access Invalid!');
class QueryModel extends BaseModel {
	
	function __construct($table_name = 'query') {
		parent::__construct($table_name);
	}
	
	/**
	 * @doc 检查登录
	 * @param array $param 查询参数
	 * @return array 返回单个用户结果 ;
	 * @author Heanes
	 * @time 2015-06-04 16:16:05
	 */
	public function checkLogin($param) {
		if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == '1') {
			@header("Location: ".getReferer());
			exit();
		}else{
			$param['table']='query';
			return DB::getRow($param);
		}
	}

	/**
	 * @doc 根据查询条件返回单个用户信息
	 * @param array $param 查询条件
	 * @return resource 查询结果
	 * @author Heanes
	 * @time 2015-06-18 11:22:28
	 */
	public function getUser($param){
		$param['table']='query';
		return DB::getRow($param);
	}

	/**
	 * @doc 根据查询条件返回多条用户信息
	 * @param $param
	 * @return array
	 * @author Heanes
	 * @time 2015-06-18 11:33:48
	 */
	public function getUsers($param){
		return DB::select($param);
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
		if($new_user=DB::insert('query',$new_user)){
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
	public function updateUser($update_user_data,$where){
		if(DB::update('query',$update_user_data,$where)){
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
	public function deleteUser($where){
		return DB::delete('query',$where);
	}
    public function query($sql){
        return DB::execute($sql);
    }
    /**
     * @doc 获取文章列表
     * @param array $param 数据字段
     * @param string $page 分页对象
     * @return array 文章结果列表
     * @author Heanes
     * @time 2015-06-10 22:43:14
     */
    public function getArticleList($param = array(), $page = '') {
        $param['table'] = 'query';
        $result = DB::select($param,$page);
        return $result;
    }
}