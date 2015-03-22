<?php
/**
 * @filesource db.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-05 15:21:05
 * @doc 通用数据库类，根据不同驱动来加载实现
 */
defined('InHeanes') or exit('Access Invalid!');
class Db {
	
	// 驱动
	public $driver='mysqli';
	//数据库名称
	private $dbName='heanes.com';
	//数据库用户名
	private $dbUser='root';
	//数据库密码
	private $dbPassword='123456';
	function __construct() {
		if (!extension_loaded(self::$driver)){
			throw_exception("Db Error: $driver is not install");
		}
	}
	
	/**
	 * 设置驱动
	 * @param string $driver 驱动名称
	 */
	public static function setDriver($driver){
		$this->driver=$driver;
	}
	
	private static function connect($param) {
		;
	}
	/**
	 * 查询
	 * @param string $sql
	 */
	public static function select(string $sql) {
		;
	}
	
	/**
	 * 获取所有数据
	 * @param string $sql 查询语句
	 */
	public static function getAll($sql) {
	}
	
	/**
	 * 插入
	 * @param string $tableName  表名
	 * @param array $valueArray 插入的值（数组键值对形式），键名为表列名
	 */
	public static function insert($tableName,$valueArray){
		;
	}
	/**
	 * 批量插入数据
	 * @param unknown $param
	 */
	public static function insertAll($param) {
		;
	}
	
	/**
	 * 更新
	 * @param string $tableName 表名
	 * @param array  $tableName 更新后的值（数组键值对形式）
	 * @param string $where     查询条件
	 */
	public static function update($tableName,$updateValueArray,$where='') {
		;
	}
	/**
	 * 删除
	 * @param string $tableName 表名
	 * @param string $where     查询条件
	 */
	public static function delete($tableName,$where='') {
		;
	}
	/**
	 * 查询
	 * @param string $qureyString 查询语句
	 */
	public static function query($sqlString) {
		;
	}
	
	public static function getLastId() {
		;
	}
	
	/**
	 * 取得一行信息
	 * @param array $param
	 */
	public static function getRow($param) {
		;
	}
	
	/**
	 * 列出所有表
	 * @param unknown $param
	 */
	public static function showTables($param) {
		;
	}
	/**
	 * 显示建表语句
	 * @param unknown $tableName
	 */
	public static function showCreateTable($tableName) {
		;
	}
	/**
	 * 显示表结构
	 * @param unknown $tableName
	 */
	public static function showColumns($tableName) {
		;
	}
	/**
	 * 取得数据库信息
	 * @param unknown $param
	 */
	public static function getServerInfo($param) {
		;
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
	 * @param unknown $param
	 */
	public static function commit($param) {
		;
	}
	/**
	 * 回滚事务
	 * @param unknown $param
	 */
	public static function rollback($param) {
		;
	}
}