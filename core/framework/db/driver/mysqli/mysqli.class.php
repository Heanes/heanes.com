<?php
/**
 * @doc mysqli版数据库
 * @filesource mysqli.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-28 17:09:31
 */
defined('InHeanes') or exit('Access Invalid!');
class DB {
	
	/**
	 * @var string 驱动名称
	 */
	public $driver='mysqli';
	/**
	 * @var mysqli|resource|array 连接器
	 */
	private static $link = array();
	/**
	 * @var array 配置信息
	 */
	private static $conf = array();
	/**
	 * @var bool 是否开启事务
	 */
	private static $if_transaction = true;
	/**
	 * @var integer 连接数据库计数器
	 */
	private static $i_connect = 0;
	/**
	 * @var integer 执行命令次数计数器
	 */
	private static $i_query = 0;
	
	function __construct() {
		if (!extension_loaded('mysqli')){
			Debug::throw_exception("Db Error: mysqli is not install");
		}
		if (empty(self::$link)) {
			Debug::throw_exception('"Connect failed: Can not connect with mysqli!');
		}
	}

	/**
	 * @doc 连接数据库
	 * @param string $host
	 * @author Heanes
	 * @times 2015-04-23 22:45:46
	 */
	private static function connect($host='master') {
		self::$i_connect++;
		/**
		 * @doc 数据库前缀定义
		 * @time 2015-01-13 10:05:48
		 */
		$conf = get_config_sys('db.'.$host);
		self::$conf=$conf;
		self::$link[$host]=new mysqli($conf['dbhost'], $conf['dbuser'], $conf['dbpwd'], $conf['dbname'], $conf['dbport']);
		if (self::$link[$host]->connect_errno) {
			Debug::throw_exception('Connect failed:'.self::$link[$host]->connect_error,false);
		}
		//数据库编码设置
		switch (strtoupper($conf['dbcharset'])) {
			case 'UTF-8':
				$query_string = "
		                 SET CHARACTER_SET_CLIENT = utf8,
		                 CHARACTER_SET_CONNECTION = utf8,
		                 CHARACTER_SET_DATABASE = utf8,
		                 CHARACTER_SET_RESULTS = utf8,
		                 CHARACTER_SET_SERVER = utf8,
		                 COLLATION_CONNECTION = utf8_general_ci,
		                 COLLATION_DATABASE = utf8_general_ci,
		                 COLLATION_SERVER = utf8_general_ci,
		                 sql_mode=''";
			break;
			case 'GBK':
				$query_string = "
		   			    SET CHARACTER_SET_CLIENT = gbk,
		                 CHARACTER_SET_CONNECTION = gbk,
		                 CHARACTER_SET_DATABASE = gbk,
		                 CHARACTER_SET_RESULTS = gbk,
		                 CHARACTER_SET_SERVER = gbk,
		                 COLLATION_CONNECTION = gbk_chinese_ci,
		                 COLLATION_DATABASE = gbk_chinese_ci,
		                 COLLATION_SERVER = gbk_chinese_ci,
		                 sql_mode=''";
				break;
			default:
				$error = "Db Error: charset is Invalid";
				Debug::throw_exception($error);
		}
		if (!self::$link[$host]->query($query_string)) {
			Debug::throw_exception(self::$link[$host]->error);
		}
	}

	/**
	 * @doc 数据库前缀修复
	 * @param string $pre
	 * @return string
	 * @author Heanes
	 * @time 2015-06-16 11:39:19
	 */
	public static function dbPreFix($pre='pre_'){
		return $pre;
	}
	
	/**
	 * @doc 执行sql命令
	 * @param string $sql sql命令
	 * @param string $host 连接
	 * @return resource MySQL数据库查询结果集
	 * @author Heanes
	 * @time 2014-10-24 14:54:14
	 */
	public static function query($sql,$host='master') {
		self::$i_query++;
		if (empty($sql)){
			Debug::throw_exception('Db Error: queryString param is empty!');
		}
		self::connect($host);
		Timer::mark(self::$i_query.'_query_start');
		//echo $sql;
		$query=self::$link[$host]->query($sql);
		Timer::mark(self::$i_query.'_query_end');
		Debug::log_sql(Debug::get_caller_info().$sql,Timer::getTime(self::$i_query.'_query_start',self::$i_query.'_query_end'));//调试模式处理
		if ($query===false) {
			$error = 'Db Error: '.self::$link[$host]->error;
			//$error = 'Db Error: '.mysqli_error(self::$link[$host]);
			echo $error;
			return false;
		}else {
			return $query;
		}
	}

	/**
	 * @doc 一次执行多条查询
	 * @param string $multi_sql 多条sql语句
	 * @param string $host 主从数据库
	 * @return bool 执行结果
	 * @author Heanes
	 * @time 2015-07-04 23:58:31
	 */
	public static function multi_query($multi_sql,$host='master'){
		//echo __METHOD__.'<br />';
		if (empty($multi_sql)){
			Debug::throw_exception('Db Error: queryString param is empty!');
		}
		self::connect($host);
		Timer::mark(self::$i_query.'_query_start');
		//$query=self::$link[$host]->multi_query($sql);

		if (self::$link[$host]->multi_query($multi_sql)) {                       //执行多条SQL命令
			do {
				if ($result = self::$link[$host]->store_result()) {                     //获取第一个结果集
					echo 'store_result'.'<br />';
					while ($row = $result->fetch_row()) {                         //遍历结果集中每条记录
						foreach($row as $data){                                      //从一行记录数组中获取每列数据
							echo $data."  ";                           //输出每列数据
						}
						echo "<br>";                                       //输出换行符号
					}
					$result->close();                               //关闭一个打开的结果集
				}
				if (!self::$link[$host]->more_results()) {                         //判断是否还有更多的结果集
					echo "-----------------<br>";                       //输出一行分隔线
				}else {
					break;
				}
			} while (self::$link[$host]->next_result());                          //获取下一个结果集，并继续执行循环
			Timer::mark(self::$i_query.'_query_end');
			Debug::log_sql(Debug::get_caller_info().$multi_sql,Timer::getTime(self::$i_query.'_query_start',self::$i_query.'_query_end'));//调试模式处理
			return true;
		}else{
			echo 'not success!';
			return false;
		}
	}

	/**
	 * @doc 执行SQL语句
	 * @param string $sql 待执行的SQL
	 * @param string $host 主从数据库
	 * @return mysqli_result 查询结果
	 * @author Heanes
	 * @time 2015-06-16 15:41:00
	 */
	public static function execute($sql, $host = 'master'){
		self::connect($host);
		$result = self::query($sql,$host);
		$array=array();
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		return $array;
	}

	/**
	 * @doc 直接执行SQL语句
	 * @param string $sql 待执行的SQL
	 * @param string $host 主从数据库
	 * @return mysqli_result 查询结果
	 * @author Heanes
	 * @time 2015-06-16 15:41:00
	 */
	public static function executeSql($sql, $host = 'master'){
		self::connect($host);
		$result = self::query($sql,$host);
		$array=array();
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		return $array;
	}

	/**
	 * @doc where子句
	 * @param string $key 字段名称
	 * @param string $value 值
	 * @param bool $escape 字段名包含符号，如MySQL的为`field`
	 * @return string 处理后的where子句
	 * @author Heanes
	 * @time 2015-06-16 12:49:24
	 */
	public function where($key,$value,$escape=true){
		return $this->_where($key,$value,'AND ',$escape);
	}

	/**
	 * @doc 处理where子句
	 * @param string $key 字段名称
	 * @param string $value 值
	 * @param string $type where子句类型，AND连接词
	 * @param bool $escape 字段名包含符号，如MySQL的为`field`
	 * @return $this 处理后的where子句
	 * @author Heanes
	 * @time 2015-06-16 13:00:25
	 */
	protected static function _where($key,$value,$type='AND ',$escape=true){
		if($escape){
			$key=self::parseKey($key);
		}
		$value=self::parseValue($value);
		$where=$type.$key.'='.$value;
		return $where;
	}
	
	/**
	 * @doc 查询数据
	 * @param array $param 参数
	 * 参数说明：
	 * 		$param['table']为表名称，必要
	 * 		$param['field']为查找字段，不必要；
	 * 		$param['index']为视图名称，不必要；
	 * 		$param['where']为查找where查找字段限定子句，不必要
	 * 		$param['limit']为限定个数，不必要；
	 * 		$param['count']为分页相关，用来统计数目，不必要；
	 * @param object|string $pager 分页对象
	 * @param string $host 主从数据库选择
	 * @return array 查询结果数组
	 * @author Heanes
	 * @time 2014-10-24 14:54:14
	 */
	public static function select($param=array() ,$pager='' ,$host='master') {
		// 对参数进行处理
		//为空
		if (empty($param)){
			Debug::throw_exception('Db Error: param is empty!');
			exit;
		}

		//from{1、单表查询||2、多表查询}@todo 多表查询
		$param['tables']=explode(',',$param['tables']);

		//数据字段为空则返回所有字段
		if (empty($param['field'])){
			$param['field'] = '*';
		}
		//若用逗号分隔符选择查询字段，如：$param['field']='id,name,enable';
		if(is_string($param['field'])){
			$param['field']=explode(',',$param['field']);
		}
		//若用数组形式选择查询字段，如：$param['field']=array('id','name','enable');
		if(is_array($param['field'])){
			$field_array=array();
			foreach ($param['field'] as $key => $value) {
				$field_array[$key]=self::parseKey($value);
			}
			$param['field']=implode(',',$field_array);
		}

		//计算总数，总是计算总数，因为要使用分页
		if (empty($param['count'])){
			$param['count'] = 'count(*)';
		}

		//是否使用索引
		if (isset($param['index']) && is_string($param['index']) && !empty($param['index'])){
			$index = 'USE INDEX ('.$param['index'].')';
		}else{
			$index='';
        }
		//-----对where子句的处理
		if (isset($param['where']) && is_string($param['where']) && !empty($param['where'])){
			$param['where']=trim($param['where']);
			$where=' WHERE '.$param['where'];
		}
		else {
			$where='';
		}

		//group by 分组
		$param['where_group'] = '';
		if (!empty($param['group'])){
			$param['where_group'] .= ' GROUP BY '.self::parseKey($param['group']);
		}

		//order by 排序
		$order='';
		if (!empty($param['order'])){
			$order .= ' ORDER BY ';
			foreach ($param['order'] as $key => $value) {
				$order.=self::parseKey($key);
				$order.= ' '.strtoupper(trim($value));
				if($value!=end($param['order'])){
					$order.= ',';
				}
			}
		}

		//处理查询语句
		$sql = 'SELECT '.$param['field'].' FROM `'.DBPRE.$param['table'].'` as `'.$param['table'].'` ' . $index . $where.$param['where_group'] . $order;
		$count_sql = 'SELECT '.$param['count'].' as count FROM `'.DBPRE.$param['table'].'` as `'.$param['table'].'` '.$index.' '.$where.$param['where_group'];
		//limit ，如果有分页对象的话，那么优先分页对象
		if (isset($pager) && $pager instanceof Page){
			$count_query = self::query($count_sql,$host);
			$count_fetch = mysqli_fetch_array($count_query,MYSQLI_ASSOC);
			$pager->setTotalNum($count_fetch['count']);
			$param['limit'] = $pager->getLimitStart().",".$pager->getPageSize();
		}
		//limit 子句
		if (isset($param['limit']) && $param['limit'] != ''){
			$sql .= ' LIMIT '.$param['limit'];
		}

		//全部判断完毕再执行
		//处理查询结果
		//echo $sql;
		$result = self::query($sql,$host);
		$array=array();
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}

		return $array;
	}
	
	/**
	 * @doc 直接执行sql语句，返回结果
	 * @param string $sql 查询语句
	 * @param string $host 主从数据库
	 * @return array|null 结果数据|查询失败
	 * @author Heanes
	 * @time 2014-10-24 14:54:14
	 */
	public static function getAll($sql,$page,$host='master') {
		$result = self::query($sql,$host);

		//结果处理
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}

		return !empty($array) ? $array : null;
	}

	/**
	 * @doc 取得一行信息
	 * @param array $param 参数
	 * 			$param['table']为表名，支持连表，必要;
	 * 			$param['field']为查找字段，不必要;
	 * 			$param['where']为where查找字段限定子句，不必要;
	 * @param string $host 主从数据库选择
	 * @return array 返回结果集数组|空
	 * @author Heanes
	 * @time 2015-04-23 22:42:28
	 */
	public static function getRow($param, $host = 'master'){
		$table_name=$param['table'];
		//-----对查找字段的处理
		//数据字段为空则返回所有字段
		if (empty($param['field'])){
			$param['field'] = '*';
		}
		//若用逗号分隔符选择查询字段
		elseif(is_string($param['field'])){
			$param['field']=explode(',',$param['field']);
		}
		//若用数组形式选择查询字段
		elseif(is_array($param['field'])){
			$field_array=array();
			foreach ($param['field'] as $key => $value) {
				$field_array[$key]=self::parseKey($value);
			}
			$param['field']=implode(',',$field_array);
		}

		//对where子句的处理
		if (isset($param['where']) && is_string($param['where']) && !empty($param['where'])){
			$param['where']=trim($param['where']);
			$where=' WHERE '.$param['where'];
		}
		else {
			$where='';
		}

		//order by 排序
		/*
		 * 使用方式
		 * $param['order']=array('field'=>'ASC');
		 */
		$order='';
		if (!empty($param['order'])){
			$order .= ' ORDER BY ';
			foreach ($param['order'] as $key => $value) {
				$order.=self::parseKey($key);
				$order.= ' '.strtoupper(trim($value)==''?'ASC':trim($value));
			}

		}

		//处理sql语句
		$sql = 'SELECT '.$param['field'].' FROM `'.DB_PRE.$table_name.'`'.$where.$order;
		//echo $sql;
		//exit;

		//结果处理
		$result = self::query($sql,$host);
		$row=$result->fetch_assoc();

		//只返回一行（第一行）数据；
		return !empty($row) ? $row : null;
		//return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}

	/**
	 * @doc 插入
	 * @param string $table_name 表名
	 * @param array $insert_array 插入的值（数组键值对形式），键名为表列名
	 * @param string $host 主从数据库选择
	 * @return bool|int|resource 插入结果|失败
	 * @author Heanes
	 * @time 2014-10-24 14:54:14
	 */
	public static function insert($table_name, $insert_array,$host='master'){
		//处理插入数据
		if (!is_array($insert_array)) {
			return false;
		}
		$fields=array();
		$value=array();
		foreach ($insert_array as $key => $val) {
			$fields[]=self::parseKey($key);
			$value[]=self::parseValue($val);
		}
		//处理sql语句
		$sql = 'INSERT INTO `'.DB_PRE.$table_name.'` ('.implode(',',$fields).') VALUES('.implode(',',$value).')';
		//当数据库没有自增ID的情况下，返回 是否成功，否则返回最后的id
		$result = self::query($sql, $host);
		$insert_id = self::getLastId($host);

		return $insert_id ? $insert_id : $result;
	}

	/**
	 * @doc 批量插入数据
	 * @param string $table_name 表名
	 * @param array $insertArray 插入数据
	 * @param string $host 主从数据库
	 * @return string 插入结果|插入失败
	 * @author Heanes
	 * @time 2014-10-24 14:54:14
	 */
	public static function insertAll($table_name, $insertArray=array(), $host = 'master') {
		if (!is_array($insertArray[0])) return false;
		$fields = array_keys($insertArray[0]);
		array_walk($fields,array(self,'parseKey'));
		$values = array();
		foreach ($insertArray as $data) {
			$value = array();
			foreach ($data as $key=>$val) {
				$val = self::parseValue($val);
				if (is_scalar($val)){
					$value[] = $val;
				}
			}
			$values[] = '('.implode(',',$value).')';
		}
		$sql = 'INSERT INTO `'.DBPRE.$table_name.'` ('.implode(',',$fields).') VALUES '.implode(',',$values);
		$result = self::query($sql,$host);
		$insertId = self::getLastId($host);
		return $insertId ? $insertId : $result;
	}
	
	/**
	 * @doc 更新
	 * @param string $table_name 表名
	 * @param array $update_array 更新后的值（数组键值对形式）
	 * @param string $where 查询条件
	 * @param string $host 主从数据库选择
	 * @return resource 更新结果|更新失败
	 * @author Heanes
	 * @time 2015-04-23 22:41:40
	 */
	public static function update($table_name, $update_array = array(), $where = '', $host = 'master'){
		if (!is_array($update_array)) return false;
		$string_value = '';
		foreach ($update_array as $k => $v){
			if (is_array($v)){
				switch ($v['sign']){
					case 'increase':
						$string_value .= " `$k` = `$k` + ". $v['value'] .",";
						break;
					case 'decrease':
						$string_value .= " `$k` = `$k` - ". $v['value'] .",";
						break;
					case 'calc':
						$string_value .= " `$k` = ". $v['value'] .",";
						break;
					default:
						$string_value .= " `$k` = ". self::parseValue($v['value']) .",";
				}
			}else {
				$string_value .= " `$k` = ". self::parseValue($v) .",";
			}
		}

		$string_value = trim(trim($string_value),',');

		//对where子句的处理，字符串方式，
		if (isset($where) && is_string($where) && !empty($where)){
			$where=trim($where);
			$where=' WHERE '.$where;
		}

		//处理sql语句
		$sql = 'UPDATE `'.DB_PRE.$table_name.'` AS `'.$table_name.'` SET '.$string_value.' '.$where;
		$result = self::query($sql, $host);
		return $result;
	}

	/**
	 * @doc 删除
	 * @param string $table_name 表名
	 * @param string $where 查询条件
	 * @param string $host 主从数据库选择
	 * @return resource|bool 删除结果|失败
	 * @author Heanes
	 * @time 2015-04-23 22:41:59
	 */
	public static function delete($table_name, $where, $host = 'master') {

		//-----对where子句的处理，兼容数组键值对和字符串等号连接方式
		//where查找子句，字符串方式，如：$where='id=1 and enable=1';
		if (isset($where) && is_string($where) && !empty($where)){
			$where=trim($where);
			$where=' WHERE '.$where;

			$sql = 'DELETE FROM `'.DB_PRE.$table_name.'` '.$where;
			return self::query($sql, $host);
		}else {
			Debug::throw_exception('Db Error: the condition of delete is empty!');
			return false;
		}

	}
	
	/**
	 * @doc 上一步插入产生的ID
	 * @param string $host
	 * @return int $id 返回整型上一步插入产生的ID
	 * @author Heanes
	 * @time 2015-04-23 22:42:14
	 */
	public static function getLastId($host='master') {
		//$id = mysqli_insert_id(self::$link[$host]);
		$id = self::$link[$host]->insert_id;
		if (!$id){
			$result=self::query('SELECT last_insert_id() AS id',$host);
			$id=$result->fetch_assoc();
			//过程话风格
			//$id = mysqli_fetch_array(self::query('SELECT last_insert_id() as id',$host),MYSQLI_ASSOC);
			$id = $id['id'];
		}
		return $id;
	}

	/**
	 * @doc 获取某个表的自增ID
	 * @param string $table_name 表名
	 * @param string $host 主从数据库
	 * @return integer 自增ID值
	 * @author Heanes
	 * @time 2015-07-04 14:44:34
	 */
	public static function getAutoIncrementId($table_name,$host='master'){
		self::connect($host);
		$sql="SHOW TABLE STATUS LIKE '".DBPRE."$table_name'";
		//$sql="SELECT auto_increment FROM `information_schema`.`TABLES` WHERE TABLE_SCHEMA='db_name' AND TABLE_NAME='$table_name'";
		//此条语句也可以实现，但是要和数据库名对应，稍显麻烦
		$result=self::query($sql,$host);
		$row=$result->fetch_assoc();
		return $row['Auto_increment'];
	}

	/**
	 * @doc 开始事务
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-04-23 22:44:18
	 */
	public static function beginTransaction($host='master') {
		self::connect($host);
		if (self::$if_transaction){
			self::$link[$host]->autocommit(false);//关闭自动提交
		}
		self::$if_transaction = false;
	}

	/**
	 * @doc 提交事务
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-04-23 22:44:33
	 */
	public static function commit($host='master') {
		if (!self::$if_transaction){
			$result = self::$link[$host]->commit();
			self::$link[$host]->autocommit(true);//开启自动提交
			self::$if_transaction = true;
			if (!$result){
				Debug::throw_exception("Db Error: ".mysqli_error(self::$link[$host]));
			}
		}
	}

	/**
	 * @doc 回滚事务
	 * @param string $host 主从数据库
	 * @author Heanes
	 * @time 2015-04-23 22:44:48
	 */
	public static function rollback($host='master') {
		if (!self::$if_transaction){
			$result = self::$link[$host]->rollback();
			self::$link[$host]->autocommit(true);
			self::$if_transaction = true;
			if (!$result){
				Debug::throw_exception("Db Error: ".mysqli_error(self::$link[$host]));
			}
		}
	}
	
	/**
	 * @doc 取得数据库信息
	 * @param string $host 主从数据库
	 * @return string 返回数据库软件服务器信息
	 * @author Heanes
	 * @time 2015-04-23 22:43:34
	 */
	public static function getServerInfo($host='master') {
		self::connect($host);
		if ($result=self::$link[$host]->server_info){
			return $result;
		} else {
			Debug::throw_exception('Error!Can not getServerInfo!');
			return false;
		}
		//$result = mysqli_get_server_info(self::$link[$host]);//过程化风格
	}

	/**
	 * @doc 显示某个表的字段信息
	 * @param $table_name
	 * @param string $host
	 * @return array|null
	 * @author Heanes
	 * @time 2015-07-04 14:31:24
	 */
	public static function describeTable($table_name,$host='master'){
		self::connect($host);
		$sql='DESCRIBE `'.DB_PRE.$table_name.'`';
		$result=self::query($sql,$host);
		$array=array();
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		count($array) ? null : $array=null;
		return $array;
	}
	
	/**
	 * @doc 列出所有表
	 * @param string $host 主从数据库
	 * @return array|null 该数据库下存在的所有表|空结果
	 * @author Heanes
	 * @time 2015-04-23 22:42:46
	 */
	public static function showAllTables($host='master') {
		self::connect($host);
		$sql='SHOW TABLES';
		$result=self::query($sql,$host);
		$tables=array();
		while ($row=$result->fetch_row()) {
			$tables[]=$row[0];
		}
		count($tables) ? null : $table=null;
		return $tables;
	}

	/**
	 * @doc 显示建表语句
	 * @param string $table_name 欲显示的表名称
	 * @param string $host 主从数据库
	 * @return array 建表语句
	 * @author Heanes
	 * @time 2015-04-23 22:43:02
	 */
	public static function showCreateTable($table_name,$host='master') {
		self::connect($host);
		$sql = 'SHOW CREATE TABLE `'.DB_PRE.$table_name.'`';
		$source=self::query($sql,$host);
		$result=$source->fetch_assoc();
		return $result['Create Table'];
	}

	/**
	 * @doc 显示表结构（数据字典）
	 * @param string $table_name 表名称
	 * @param string $database 数据库名称，若不定义则为当前系统的数据库
	 * @param string $host 主从数据库
	 * @return array 表结构信息
	 * @author Heanes
	 * @time 2015-04-23 22:43:17
	 */
	public static function showFields($table_name,$database='',$host='master') {
		self::connect($host);
		$table_sql = 'SELECT * FROM ';
		$table_sql .= '`INFORMATION_SCHEMA`.`TABLES` ';
		$table_sql .= 'WHERE ';
		if ($database=='') {
			$table_sql .= "`TABLE_NAME` = '".DBPRE.$table_name."'  AND `TABLE_SCHEMA` = '".self::$conf['dbname']."'";
		}else {
			$table_sql .= "`TABLE_NAME` = '".$table_name."'  AND `TABLE_SCHEMA` = '{$database}'";
		}
		$table_result=array();
		if ($table_resource=self::query($table_sql, $host)) {
			$table_result=$table_resource->fetch_assoc();
		}
		$table['table_info']=$table_result;

		$fields_sql = 'SELECT * FROM ';
		$fields_sql .= '`INFORMATION_SCHEMA`.`COLUMNS` ';
		$fields_sql .= 'WHERE ';
		$fields_sql .= "`TABLE_NAME` = '{$table_result['TABLE_NAME']}' AND `TABLE_SCHEMA` = '{$table_result['TABLE_SCHEMA']}'";
		$fields_array=array();
		if ($fields_resource=self::query($fields_sql, $host)) {
			while ($row=$fields_resource->fetch_assoc()) {
				$fields_array[]=$row;
			}
		}
		foreach ($fields_array as $key => $value) {
			$table['table_fields'][$key]=$value;
		}
		return $table;
	}
	
	/**
	 * @doc 显示数据库中的所有数据库信息
	 * @param string $host
	 * @return array 返回数据库中存在的数据库信息
	 * @author Heanes
	 * @time 2015-04-24 09:48:29
	 */
	public static function showDatabases($host='master') {
		$sql='SHOW DATABASES;';
		$result=self::query($sql,$host);
		$array=array();
		while ($row=$result->fetch_assoc()) {
			$array[]=$row;
		}
		count($array) ? null : $array=null;
		return $array;
	}
	
	/**
	 * @doc 显示某个数据库的数据字典
	 * @param string $database 数据库名称
	 * @param string $host
	 * @return array 数据字典
	 * @author Heanes
	 * @time 2015-04-24 12:17:18
	 */
	public static function showDatabaseDict($database='',$host='master') {
		self::connect($host);
		$tables=self::showAllTables();
		foreach ($tables as $key => $value) {
			$table_sql = 'SELECT * FROM ';
			$table_sql .= '`INFORMATION_SCHEMA`.`TABLES` ';
			$table_sql .= 'WHERE ';
			if ($database=='') {
				$table_sql .= "`TABLE_NAME` = '".$value['TABLE_NAME']."'  AND `TABLE_SCHEMA` = '".self::$conf['dbname']."'";
			}else {
				$table_sql .= "`TABLE_NAME` = '".$value['TABLE_NAME']."'  AND `TABLE_SCHEMA` = '{$database}'";
			}
			if ($table_resource=self::query($table_sql, $host)) {
				while ($table=$table_resource->fetch_assoc()) {
					$tables[$key]=$table;
				}
			}
		}
		//根据数据库中存在的表，循环读取表信息
		foreach ($tables as $key => $value) {
			$fields_sql = 'SELECT * FROM ';
			$fields_sql .= '`INFORMATION_SCHEMA`.`COLUMNS` ';
			$fields_sql .= 'WHERE ';
			$fields_sql .= "`TABLE_NAME` = '{$value['TABLE_NAME']}' AND `TABLE_SCHEMA` = '{$value['TABLE_SCHEMA']}'";
			$fields_array=array();
			if ($fields_resource=self::query($fields_sql, $host)) {
				while ($row=$fields_resource->fetch_assoc()) {
					$fields_array[]=$row;
				}
			}
			foreach ($fields_array as $field_key => $field_value) {
				$tables[$key]['TABLE_FIELDS'][]=$field_value;
			}
		}
		return $tables;
	}
	

	/**
	 * @doc 执行REPLACE操作
	 * @param string $table_name 表名
	 * @param array $replace_array 待更新的数据
	 * @param string $host 主从数据库
	 * @return bool|resource replace成功结果|失败
	 * @author Heanes
	 * @time 2015-06-16 13:42:43
	 */
	public static function replace($table_name, $replace_array = array(), $host = 'master'){
		if (!empty($replace_array)){
			$string_field='';
			$string_value='';
			foreach ($replace_array as $k => $v){
				$string_field .= " $k ,";
				$string_value .= " '". $v ."',";
			}
			$sql = 'REPLACE INTO `'.DBPRE.$table_name.'` ('.trim($string_field,', ').') VALUES('.trim($string_value,', ').')';
			return self::query($sql,$host);
		}else {
			return false;
		}
	}

	/**
	 * @doc SQL预处理语句
	 * @param array $sql sql语句
	 * @param string $host 主从数据库选择
	 * @return array 处理结果
	 * @author Heanes
	 * @time 2015-05-12 10:38:13
	 */
	public static function prepare($sql, $host = 'master') {
		$result=array();
		return $result;
	}

	
	/**
	 * @doc 释放数据库资源
	 * @param string $host 主从数据库
	 * @return boolean|string 释放成功|没有数据库连接
	 * @author Heanes
	 * @time 2015-04-25 10:39:12
	 */
	public static function close($host='master') {
		//echo __METHOD__.'<br/>';
		if (isset(self::$link[$host]) && count(self::$link[$host])>0) {
			self::$link[$host]->close();
			return true;
		}else {
			return 'not connect';
		}
	}
	
	//********************************工具性函数*******************************
	/**
	 * @doc 格式化字，给字段名加反引号`
	 * @param string $key 字段名
	 * @return string 加了反引号的键
	 * @author Heanes
	 * @time 2015-04-23 22:43:48
	 */
	public static function parseKey(&$key) {
		$key = trim ( $key );
		if (! preg_match ( '/[,\'\"\*\(\)`.\s]/', $key )) {
			$key = '`' . $key . '`';
		}
		return $key;
	}
	
	/**
	 * @doc 格式化值
	 * @param mixed $value
	 * @return string 加了单引号的值
	 * @author Heanes
	 * @time 2015-04-23 22:44:04
	 */
	public static function parseValue($value){
		$value = addslashes(stripslashes($value));//重新加斜线，防止从数据库直接读取出错
		return "'".$value."'";
	}

	/**
	 * @doc 显示数据字典页面
	 * @author Heanes
	 * @time 2015-04-24 14:33:47
	 * @todo 作为模版展示，并且模版页需要完善Tab切换时对应样式切换问题
	 */
	public static function displayDatabaseDict() {
		$tables=self::showDatabaseDict();
		$html = '';
		$title='数组字典';
		foreach ($tables as $key => $value) {
			$multi_tables[$key][0]=$tables[$key];
		}
		//按列字段排序
		foreach ($tables as $key => $value) {
			array_multisort($tables[$key]['TABLE_FIELDS']);
		}
		$multi_tables=array();
		foreach ($tables as $key => $value) {
			$multi_tables[$key][1]=$tables[$key];
		}
		foreach ($multi_tables as $key => $value) {
			$temp1[]=$multi_tables[$key][0];
			$temp2[]=$multi_tables[$key][1];
		}
		foreach ( $multi_tables as $k => $v ) {
			// $html .= '<p><h2>'. $v['TABLE_COMMENT']. '&nbsp;</h2>';
			$html .= '<h3><a id="'.$v[0] ['TABLE_NAME'].'">' .sprintf("%02d", $k+1).'. '. $v[0] ['TABLE_NAME']. '  ' . $v[0] ['TABLE_COMMENT']. '</a></h3>';
			$html .='<div>';
			$html .='<ul class="ul-sort-title">';
			$html .='<li class="active">';
			$html .='<span>自然结构</span>';
			$html .='</li>';
			$html .='<li>';
			$html .='<span>字段排序</span>';
			$html .='</li>';
			$html .='</ul>';
			$html .= '<table id="normal">';
			// $html .= '<caption>' . $v ['TABLE_NAME']. ' ' . $v ['TABLE_COMMENT']. '</caption>';
			$html .= '<tbody><tr><th>序号</th><th>字段名</th><th>数据类型</th><th>默认值</th><th>允许非空</th><th>自动递增</th><th>注释</th><th>备注</th></tr>';
			$html .= '';
			$i=0;
			foreach ( $v[0]['TABLE_FIELDS']as $f ) {
				$i++;
				$html .= '<tr><td class="c0">'.sprintf('%02d',$i).'</td><td class="c1">' . $f['COLUMN_NAME']. '</td>';
				$html .= '<td class="c2">' . $f['COLUMN_TYPE']. '</td>';
				$html .= '<td class="c3">' . $f['COLUMN_DEFAULT']. '</td>';
				$html .= '<td class="c4">' . $f['IS_NULLABLE']. '</td>';
				$html .= '<td class="c5">' . ($f['EXTRA']== 'auto_increment' ? 'YES' : '') . '</td>';
				$html .= '<td class="c6">' . $f['COLUMN_COMMENT']. '</td>';
				$html .= '<td class="c7"></td></tr>';
			}
			$html .= '</tbody></table>';
			$html .= '<table id="sort">';
			// $html .= '<caption>' . $v ['TABLE_NAME']. ' ' . $v ['TABLE_COMMENT']. '</caption>';
			$html .= '<tbody><tr><th>序号</th><th>字段名</th><th>数据类型</th><th>默认值</th><th>允许非空</th><th>自动递增</th><th>注释</th><th>备注</th></tr>';
			$html .= '';
			$i=0;

			foreach ( $v[1]['TABLE_FIELDS']as $f ) {
				$i++;
				$html .= '<tr><td class="c0">'.sprintf('%02d',$i).'</td><td class="c1">' . $f['COLUMN_NAME']. '</td>';
				$html .= '<td class="c2">' . $f['COLUMN_TYPE']. '</td>';
				$html .= '<td class="c3">' . $f['COLUMN_DEFAULT']. '</td>';
				$html .= '<td class="c4">' . $f['IS_NULLABLE']. '</td>';
				$html .= '<td class="c5">' . ($f['EXTRA']== 'auto_increment' ? 'YES' : '') . '</td>';
				$html .= '<td class="c6">' . $f['COLUMN_COMMENT']. '</td>';
				$html .= '<td class="c7"></td></tr>';
			}
			$html .= '</tbody></table>';
			$html .='</div>';
		}
		// 输出
		echo '<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>' . $title . '</title>
			<style>
			::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.3);-webkit-border-radius:10px;border-radius:10px}
			::-webkit-scrollbar{width:6px;height:5px}
			::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:rgba(0,0,0,0.39);_-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.5)}
			body{padding:0;margin:0;}
			body,td,th {font: 14px/1.3 TimesNewRoman, Arial, Verdana, tahoma, Helvetica, sans-serif}
			#sort{display:none}
			.ul-sort-title{margin:0;padding:0;}
			.ul-sort-title li{display:inline-block;background:darkseagreen;padding:5px;border:1px solid #aaa;cursor:pointer}
			.ul-sort-title li:hover{background:#84ACEA;padding:5px;border:1px solid #aaa;color: #791717;}
			.ul-sort-title li.active{background:#84ACEA;padding:5px;border:1px solid #aaa;color: #791717;}
			.table-list{width:1000px;margin:0 auto;}
			table{border-collapse:collapse;border:1px solid #CCC;background:#6089D4;}
			table caption{text-align:left; background-color:LightGreen; line-height:2em; font-size:14px; font-weight:bold;border: 1px solid #985454;padding: 10px; }
			table th{text-align:left; font-weight:bold;height:26px; line-height:25px; font-size:16px; border:1px solid #333; color:#ffffff; padding:5px;}
			table td{height:25px; font-size:12px; border:1px solid #333; background-color:#f0f0f0; padding:5px;}
			.c0{width:38px;}
			.c1{width:150px;}
			.c2{width:130px;}
			.c3{width:70px;}
			.c4{width:80px;}
			.c5{width:80px;}
			.c6{width:300px;}
			.fix-category{position:fixed;width:300px;height:100%;overflow:auto;top:0;left:0;background:rgba(241, 247, 253, 0.86);}
			.fix-category-hide{left:-300px;overflow:hidden;background-color:rgba(0, 23, 255, 0.22);cursor:pointer;}
			.fix-category ul{padding:5px;margin:0;}
			.fix-category ul li{margin:0;}
			.fix-category ul li:hover{background:darkseagreen;}
			.fix-category ul li a{display:block;padding: 5px 0 5px 8px;color:#1A407B;text-decoration:none;}
			.fix-category ul li a:hover{color:#fff;text-decoration:underline;}
			.lap-ul{display:inline-block;width:6px;height:35px;background:rgba(12, 137, 42, 0.43);border-bottom-right-radius:5px;border-top-right-radius:5px;position:fixed;top:50%;left:300px;cursor:pointer;border:1px solid rgba(31, 199, 58, 0.43);
				font-size: 12px;font-weight: normal;line-height: 35px;padding: 0 2px;
			}
			.lap-ul-off{left:0}
			.fix-category::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.3);-webkit-border-radius:10px;border-radius:10px}
			.fix-category::-webkit-scrollbar{width:6px;height:5px}
			.fix-category::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:rgba(231,178,13,0.31);_-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.5)}
			</style>
			</head>
			<body>';
		echo '<div><div class="fix-category" id="fix-category">'.
			'<ul>';
		foreach ( $tables as $k => $v ) {
			echo '<li><a href="#'.$v ['TABLE_NAME'].'">'.sprintf("%02d", $k+1).'. '.$v ['TABLE_NAME'].'</a></li>';
		}
		echo '</ul>'.
			'<b class="lap-ul" id="lap-ul">></b>'.
			'</div>';
		'<h2 style="text-align:center;">' . $title . '</h2>'.
		'<div class="table-list" id="table_list">';
		echo $html;
		?>
		<script type="text/javascript">
			var fixLap=document.getElementById('lap-ul');
			fixLap.onclick=function(){
				var fixCategory=document.getElementById('fix-category');
				if(this.className == 'lap-ul'){
					fixCategory.className = 'fix-category fix-category-hide';
					this.className = 'lap-ul lap-ul-off';
					this.innerHTML='<';
				}else if(this.className == 'lap-ul lap-ul-off'){
					fixCategory.className = 'fix-category';
					this.className = 'lap-ul';
					this.innerHTML='>';
				}
			};
			var table_list=document.getElementById('table_list');
			var ul_arr=table_list.getElementsByTagName('ul');

			for (var i = 0; i < ul_arr.length; i++) {
				var li_arr=ul_arr[i].getElementsByTagName('li');
				li_arr[0].onclick=function(){
					this.className = 'active';
					li_arr[1].className= '';
					var ul=this.parentNode;
					var div=ul.parentNode;
					var tables=div.getElementsByTagName('table');
					tables[0].style.display='block';
					tables[1].style.display='none';
				};
				li_arr[1].onclick=function(){
					this.className = 'active';
					li_arr[0].className= '';
					var ul=this.parentNode;
					var div=ul.parentNode;
					var tables=div.getElementsByTagName('table');
					tables[0].style.display='none';
					tables[1].style.display='block';
				};
			}
		</script>
		<?php
		echo '</div></body></html>';
	}
	
}