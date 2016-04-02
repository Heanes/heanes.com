<?php
/**
 * @doc 文章模型
 * @filesource ArticelModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 09:35:58
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleModel extends BaseModel {
	/**
	 * @var string $table 表名
	 */
	private $table = 'article';

	function __construct($table_name = 'article') {
		parent::__construct($table_name);
		$this->table = $table_name;
	}

	/**
	 * @doc 获取单篇文章数据
	 * @param integer $article_id 文章ID
	 * @return bool|array $result 查找失败|单篇文章结果数据
	 * @author Heanes
	 * @time 2015-06-10 22:51:21
	 */
	public function getOneArticle($article_id) {
		if (intval($article_id) > 0) {
			$param = array();
			$param['table'] = $this->table;
			$param['where'] = '`id`=' . intval($article_id);
			$result = DB::getRow($param);
			$result['keywords'] = explode(',', $result['keywords']);
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * @doc 获取某个文章分类下的文章统计数目
	 * @param integer $category_id 分类ID
	 * @author Heanes
	 * @return int 分类下文章
	 * @time 2015-07-08 11:11:46
	 */
	public function getCountInCategory($category_id){
		$param = array();
		$param['table'] = $this->table;
		$param['where']="`category_id`='$category_id'";
		return count(DB::select($param));
	}
}