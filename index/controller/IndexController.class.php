<?php
/**
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-13 15:03:15
 * @doc 首页控制文件
 */
defined('InHeanes') or exit('Access Invalid!');
class indexController extends BaseIndexController {
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
		//print_constants();
		
	}
	public function indexOp() {
		//echo __METHOD__.'</br>';
		//var_dump(debug_backtrace());
		/* 模型操作 */
		/*
		$model_article=Model('Article');
		$article_list=$model_article->getArticleList('','');
		Tpl::assign('article_list',$article_list);
		$param['table']='article';
		$param['field']='article_title';
		$fields=array(0=>'article_title');
		DB::select($param,$fields);
		
		TPL::assign('from_behind','后台传来的值');
		TPL::assign('from_behind_json',json_encode('后台传来的值'));
		*/
		/* 模版操作 */
		//Tpl::makeHtml('index.php');
		Tpl::display('index');
		
		//sleep(10);
	}
	
	public function accept_postOp() {
		var_dump($_REQUEST);
	}
	
	
	public function showOp() {
		echo 'Show';
		echo $_GET['id'];
	}
}