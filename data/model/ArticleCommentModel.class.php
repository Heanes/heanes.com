<?php
/**
 * @doc 文章评论模块
 * @filesource ArticleCommentModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015.06.23 18:47:27
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleCommentModel extends BaseModel{
	/**
	 * @var string $table 表名
	 */
	private $table = 'article_comment';

	function __construct($table_name = 'article_comment'){
		parent::__construct($table_name);
		$this->table = $table_name;
	}

	/**
	 * @doc 获取某篇文章的评论列表
	 * @param string|int $article_id 文章ID
	 * @return array 评论列表
	 * @author Heanes
	 * @time 2015-06-24 09:59:49
	 */
	public function getArticleCommentList($article_id,$page){
		$param['table']='article_comment';
		$param['where']="`article_id`= '$article_id'";
		return DB::select($param,$page);
	}

	/**
	 * @doc 获取全部评论数据
	 * @return array 评论数据数组
	 * @author Heanes
	 * @time 2015-07-02 22:32:14
	 */
	public function getCommentList($page){
		$param['table']='article_comment';
		return DB::select($param,$page);
	}

	/**
	 * @doc 添加评论
	 * @param array $insert_array 添加的评论数据数组
	 * @return bool|int|resource 插入结果
	 * @author Heanes
	 * @time 2015-06-24 09:59:49
	 */
	public function addComment($insert_array){
		return DB::insert($this->table,$insert_array);
	}
}

