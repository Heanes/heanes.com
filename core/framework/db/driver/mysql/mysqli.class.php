<?php
/**
 * @filesource mysqli.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-28 17:09:31
 * @doc mysqli版数据库
 */
defined('InHeanes') or exit('Access Invalid!');
class Db {
	
	// 驱动
	public $driver='mysqli';
	// 连接器
	private static $link = array();
	//数据库名称
	private $dbName='heanes.com';
	//数据库用户名
	private $dbUser='root';
	//数据库密码
	private $dbPassword='123456';
	function __construct() {
		if (!extension_loaded('mysqli')){
			throw_exception("Db Error: mysqli is not install");
		}
	}
	
	private static function connect($host='slave') {
		$conf = C('db.'.$host);
		self::$link[$host]=new mysqli($conf['dbhost'], $conf['dbuser'], $conf['dbpwd'], $conf['dbname'], $conf['dbport']);
		
	}
	
	/**
	 * 执行sql命令
	 * @param string $sqlString
	 * @param string $host
	 */
	public static function query($sqlString,$host='master') {
		if (empty($sqlString)) throw_exception('Db Error: queryString param is empty!');
		self::connect($host);
		$query=self::$link[$host]->query($sqlString);
		if ($query===false) {
			$error = 'Db Error: '.mysqli_error(self::$link[$host]);
		}else {
			return $query;
		}
	}
	
	/**
	 * 查询
	 * @param array $param 参数
	 * @param string $host
	 * @return array 查询结果数组
	 * @TODO 处理生成sql语句待完善
	 */
	public static function select($param,$page,$host='slave') {
		/* 对参数进行处理 */
		//为空
		if (empty($param)) {
			throw_exception('Db Error: param is empty!');
			exit;
		}
		//表参数
		if (empty($param['table'])) {
			throw_exception('Db Error: param is empty!');
			exit;
		}
		//选择列
		if (empty($param['field'])) {
			$param['field']='*';
		}
		//计算总数，总是计算总数，因为要使用分页
		if (empty($param['count'])) {
			$param['count']='count(*)';
		}
		//是否使用索引
		if (isset($param['index'])) {
			$param['index']='USE INDEX ('.$param['index'].')';
		}
		//查询条件
		if (trim($param['where']) != ''){
			if (strtoupper(substr(trim($param['where']),0,5)) != 'WHERE'){
				if (strtoupper(substr(trim($param['where']),0,3)) == 'AND'){
					$param['where'] = substr(trim($param['where']),3);
				}
				$param['where'] = 'WHERE '.$param['where'];
			}
		}else {
			$param['where'] = '';
		}
		//排序语句
		$param['where_order'] = '';
		if (!empty($param['order'])){
			$param['where_order'] .= ' order by '.$param['order'];
		}
		
		self::connect($host);
		
		//处理查询语句
		$sql="SELECT ".$param['field'].' FROM `'.DBPRE.$param['table'].'`';
		$result = self::query($sql,$host);
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		return $array;
	}
	
	/**
	 * 获取所有数据
	 * @param string $sql 查询语句
	 */
	public static function getAll($sql,$host='slave') {
		self::connect($host);
		$result = self::query($sql,$host);
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		return !empty($array) ? $array : null;
	}
	
	/**
	 * 插入
	 * @param string $tableName  表名
	 * @param array $valueArray 插入的值（数组键值对形式），键名为表列名
	 */
	public static function insert($tableName, $insert_array=array(),$host='master'){
		if (!is_array($insert_array)) {
			return false;
		}
		self::connect($host);
		$fields=array();
		$value=array();
		foreach ($insert_array as $key => $val) {
			$fields[]=self::parseKey($key);
			$value[]=self::parseValue($val);
		}
		$sql = 'INSERT INTO `'.DBPRE.$table_name.'` ('.implode(',',$fields).') VALUES('.implode(',',$value).')';
		echo $sql;
		
		//当数据库没有自增ID的情况下，返回 是否成功，否则返回最后的id
		$result = self::query($sql, $host);
		$insert_id = self::getLastId($host);
		return $insert_id ? $insert_id : $result;
	}
	/**
	 * 批量插入数据
	 * @param string $param
	 */
	public static function insertAll($param) {
		;
	}
	
	/**
	 * 更新
	 * @param string $table_name 表名
	 * @param array  $update_array 更新后的值（数组键值对形式）
	 * @param string $where     查询条件
	 */
	public static function update($table_name, $update_array = array(), $where = '', $host = 'master'){
		self::connect($host);
		if (!is_array($update_array)) return false;
		$string_value = '';
		foreach ($update_array as $k => $v){
			if (is_array($v)){
				switch ($v['sign']){
					case 'increase': $string_value .= " $k = $k + ". $v['value'] .","; break;
					case 'decrease': $string_value .= " $k = $k - ". $v['value'] .","; break;
					case 'calc': $string_value .= " $k = ". $v['value'] .","; break;
					default: $string_value .= " $k = ". self::parseValue($v['value']) .",";
				}
			}else {
				$string_value .= " $k = ". self::parseValue($v) .",";
			}
		}

		$string_value = trim(trim($string_value),',');
		if (trim($where) != ''){
			if (strtoupper(substr(trim($where),0,5)) != 'WHERE'){
				if (strtoupper(substr(trim($where),0,3)) == 'AND'){
					$where = substr(trim($where),3);
				}
				$where = ' WHERE '.$where;
			}
		}
		$sql = 'UPDATE `'.DBPRE.$table_name.'` AS `'.$table_name.'` SET '.$string_value.' '.$where;
		$result = self::query($sql, $host);
		return $result;
	}
	/**
	 * 删除
	 * @param string $table_name 表名
	 * @param string $where     查询条件
	 * @return boolean
	 */
	public static function delete($table_name, $where = '', $host = 'master') {
		self::connect($host);
		if (trim($where) != ''){
			if (strtoupper(substr(trim($where),0,5)) != 'WHERE'){
				if (strtoupper(substr(trim($where),0,3)) == 'AND'){
					$where = substr(trim($where),3);
				}
				$where = ' WHERE '.$where;
			}
			$sql = 'DELETE FROM `'.DBPRE.$table_name.'` '.$where;
			return self::query($sql, $host);
		}else {
			throw_exception('Db Error: the condition of delete is empty!');
		};
	}
	
	/**
	 * 上一步插入产生的ID
	 * @param string $host
	 * @return int $id 返回整型上一步插入产生的ID
	 */
	public static function getLastId($host='master') {
		self::connect($host);
		$id = mysqli_insert_id(self::$link[$host]);
		if (!$id){
			$result=self::query('SELECT last_insert_id() as id',$host);
			$id=$result->fetch_assoc();
			//过程话风格
			//$id = mysqli_fetch_array(self::query('SELECT last_insert_id() as id',$host),MYSQLI_ASSOC);
			$id = $id['id'];
		}
		return $id;;
	}
	
	/**
	 * 取得一行信息
	 * @param array $param
	 */
	public static function getRow($param, $fields = '*', $host = 'slave'){
		self::connect($host);
		$table = $param['table'];
		$wfield = $param['field'];
		$value = $param['value'];

		if (is_array($wfield)){
			$where = array();
			foreach ($wfield as $k => $v){
				$where[] = $v."='".$value[$k]."'";
			}
			$where = implode(' and ',$where);
		}else {
			$where = $wfield."='".$value."'";
		}

		$sql = "SELECT ".$fields." FROM `".DBPRE.$table."` WHERE ".$where;
		$result = self::query($sql,$host);
		return $result->fetch_assoc();
		//return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	/**
	 * 列出所有表
	 * @param string $param
	 */
	public static function showTables($param) {
		;
	}
	/**
	 * 显示建表语句
	 * @param string $tableName
	 */
	public static function showCreateTable($tableName) {
		;
	}
	/**
	 * 显示表结构
	 * @param string $tableName
	 */
	public static function showColumns($tableName) {
		;
	}
	/**
	 * 取得数据库信息
	 * @param string $param
	 */
	public static function getServerInfo($param) {
		self::connect($host);
		$result = mysqli_get_server_info(self::$link[$host]);
		return $result;
	}
	/**
	 * 格式化字，给字段名加反引号`
	 * @param string $key 字段名
	 * @return string
	 */
	public static function parseKey(&$key) {
		$key = trim ( $key );
		if (! preg_match ( '/[,\'\"\*\(\)`.\s]/', $key )) {
			$key = '`' . $key . '`';
		}
		return $key;
	}
	
	/**
	 * 格式化值
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	public static function parseValue($value){
		$value = addslashes(stripslashes($value));//重新加斜线，防止从数据库直接读取出错
		return "'".$value."'";
	}
	/**
	 * 开始事务
	 */
	public static function beginTransaction($param) {
		;
	}
	/**
	 * 提交事务
	 * @param string $param
	 */
	public static function commit($param) {
		;
	}
	/**
	 * 回滚事务
	 * @param string $param
	 */
	public static function rollback($param) {
		;
	}
}