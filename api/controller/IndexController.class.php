<?php
/**
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-13 15:03:15
 * @doc 导航链接
 */
defined('InHeanes') or exit('Access Invalid!');

class IndexController extends BaseAPIController {
    function __construct() {
        //echo __METHOD__.'</br>';
        parent::__construct();
        //print_constants();

    }

    public function indexOp() {
        $result = [
            'body' => [],
            'message' => '后台接口调用成功',
            'errorCode' => 0,
            'success' => true
        ];
        $this->postJson($result);
    }

}