<?php
/**
 * @doc 前台控制器基础类
 * @filesource BaseAPIController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-02-13 15:48:45
 */
defined('InHeanes') or exit('Access Invalid!');

class BaseAPIController {
    function __construct() {
        //echo __METHOD__.'</br>';

    }

    function __destruct() {
        //echo __METHOD__.'</br>';
    }

    function serviceResult() {
        return [
            'body' => [],
            'message' => null,
            'errorCode' => 0,
            'success' => false
        ];
    }

    /**
     * @doc 封装一层接口json输出
     * @param $anything
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-07 17:15:59 周二
     */
    function postJson($anything) {
        echo json_encode($anything);
        exit;
    }
}