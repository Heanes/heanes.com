<?php
/**
 * @filesource index.model.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 09:35:58
 * @doc 文章模型
 */
defined('InHeanes') or exit('Access Invalid!');
class articleModel extends model {
	function __construct() {
		parent::__construct();
	}
	
	public function getArticleList($where,$page='') {
		$param = array();
		$param['table'] = 'article';
		return Db::select($param,$page);
	}
}