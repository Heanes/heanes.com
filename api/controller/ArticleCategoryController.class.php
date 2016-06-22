<?php
/**
 * @filesource ArticleCategoryController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2016-06-19 10:38:03 周日
 * @doc 文章分类相关
 */
defined('InHeanes') or exit('Access Invalid!');

class ArticleCategoryController extends BaseAPIController {
    function __construct() {
        //echo __METHOD__.'</br>';
        parent::__construct();
        //print_constants();

    }

    public function indexOp() {

    }

    /**
     * @doc 文章分类列表
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-19 11:22:28 周日
     */
    public function listOp() {
        $result = [];
        $this->returnJson($result);
    }

    /**
     * @doc 文章分类详情
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-19 11:22:28 周日
     */
    public function detailOp() {
        $result = [];
        $this->returnJson($result);
    }
}