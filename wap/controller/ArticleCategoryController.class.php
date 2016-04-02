<?php
/**
 * @doc 文章分类控制器
 * @filesource ArticleCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-10 11:35:41
 */
defined('InHeanes') or exit('Access Invalid!');
class ArticleCategoryController extends BaseWapController {
	
	function __construct() {
		parent::__construct();
	}
	
	public function indexOp() {
		Tpl::display('article/articleSubject');
	}
	
}