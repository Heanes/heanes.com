<?php
/**
 * @filesource ArticleController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2016-06-19 10:37:05 周日
 * @doc 文章相关
 */
defined('InHeanes') or exit('Access Invalid!');

class SystemNavigationController extends BaseAPIController {
    function __construct() {
        //echo __METHOD__.'</br>';
        parent::__construct();
        //print_constants();

    }

    public function indexOp() {

    }

    /**
     * @doc 文章列表
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-19 11:22:28 周日
     */
    public function listOp() {
        $result = [];
        $this->returnJson($result);
    }

    /**
     * @doc 文章详情
     * @author Heanes fang <heanes@163.com>
     */
    public function detailOp() {
        $result = [];
        $this->returnJson($result);
    }

}