<?php
/**
 * @filesource index.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-13 15:03:15
 * @doc 首页控制文件
 */
defined('InHeanes') or exit('Access Invalid!');
class indexControl extends control {
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
	}
	public function indexOp() {
		//echo __METHOD__.'</br>';
		
		/* 模型操作 */
		$model_article=Model('article');
		$article_list=$model_article->getArticleList('','');
		Tpl::output('article_list',$article_list);
		/* 模版操作 */
		Tpl::showpage('index.php');
	}
}