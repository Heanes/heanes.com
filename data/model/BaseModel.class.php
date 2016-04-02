<?php
/**
 * @filesource BaseModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 10:33:28
 * @doc 基础模型类
 */
defined('InHeanes') or exit('Access Invalid!');

class BaseModel extends Model{

	function __construct($table_name){
		parent::__construct($table_name);
	}


}