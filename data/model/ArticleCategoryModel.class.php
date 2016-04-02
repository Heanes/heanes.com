<?php
/**
 * @filesource ArticleCategoryModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-19 11:04:49
 * @doc 文章分类模型
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleCategoryModel extends BaseModel {
	/**
	 * @var string $table 表名
	 */
	private $table = 'article_category';

	function __construct($table_name = 'article_category') {
		parent::__construct($table_name);
	}

	/**
	 * @doc 获得分级列表
	 * @return array 分级结果
	 * @author Heanes
	 * @time 2015-06-12 14:52:29
	 */
	public function getCategoryTree() {
		$result = $this->getArticleCategoryList();
		//处理生成分级列表
		$result = generateTree($result, 'id', 'parent_id', 'subCategory');
		return $result;
	}

	/**
	 * @doc 生成分类树
	 * @param integer $id 节点ID
	 * @author Heanes
	 * @time 2015-07-13 00:02:17
	 */
	public function generateCategoryTree($id=0) {
		;
	}

	/**
	 * @doc 生成上下级链表
	 * @param integer $id 节点ID
	 * @author Heanes
	 * @time 2015-07-13 00:03:44
	 */
	public function generateChain($id=0) {
		;
	}

	/**
	 * @doc 返回分类列表
	 * @return array $result 返回查询结果
	 * @author Heanes
	 * @time 2015-06-12 14:19:34
	 */
	public function getArticleCategoryList() {
		$param['table'] = $this->table;
		$param['field'] = 'id,parent_id,name,order';
		$param['field'] = array('id', 'parent_id', 'name', 'order');
		$result = DB::select($param);
		$data = array();
		foreach ($result as $key => $value) {
			$id = $value['id'];
			$data[$id] = $value;
		}
		if (count($data)) {
			return $data;
		} else {
			return 'null';
		}
	}

	/**
	 * @doc 检索分类记录
	 * @param array $param 查询条件
	 * @return resource 查询结果
	 * @author Heanes
	 * @time 2015-06-13 00:14:50
	 */
	public function selectArticleCategory($param) {
		$param['table'] = $this->table;
		$result = DB::select($param);
		return $result;
	}

	/**
	 * @doc 根据ID返回一个分类
	 * @param array $param 参数
	 * @return resource 查询结果
	 * @author Heanes
	 * @time 2015-06-13 00:17:11
	 */
	public function getOneCategory($param) {
		$param['table'] = $this->table;
		$result = DB::getRow($param);
		return $result;
	}

	/**
	 * @doc 插入数据
	 * @param array $param 参数
	 * @return bool|int|resource 插入结果|插入失败
	 * @author Heanes
	 * @time 2015-06-14 09:53:38
	 */
	public function insertArticleCategory($param = array()) {
		$insert_array = $param;
		$result = DB::insert($this->table, $insert_array);
		return $result;
	}
	
}