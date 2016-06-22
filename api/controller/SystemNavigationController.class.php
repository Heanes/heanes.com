<?php
/**
 * @filesource SystemNavigationController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-03-13 15:03:15
 * @doc 导航链接
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
     * @doc 导航列表
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-07 14:32:26 周二
     */
    public function listOp() {
        $navList = [
            [
                'id'               => 1,
                'name'             => '首页',
                'aHref'            => 'http://www.heanes.com/',
                'aTitle'           => '首页',
                'aTarget'          => '_blank',
                'imgSrc'           => 'image/nav/about.png',
                'imgSrcHover'      => 'image/nav/aboutHover.png',
                'imgSrcActive'     => 'image/nav/aboutActive.png',
                'styleClass'       => 'header-nav nav-about',
                'styleClassHover'  => 'nav-about-hover',
                'styleClassActive' => 'nav-about-active',
                'orderNumber'      => '1',
            ],
        ];
        $postNextPage = [
            'pageNumber'  => 2,
            'pageSize'    => 20,
            'pageSinceId' => 20,
        ];
        $data = [
            'rows'         => $navList,
            'total'        => count($navList),
            'postNextPage' => $postNextPage,
        ];
        $status = [
            'message' => 'success',
            'code'    => 0,
            'success' => true,
            'errors'  => null,
        ];
        $microTime = microtime(true);
        $apiTime = [
            'requestTime'        => REQUEST_TIME,
            'requestTimeString'  => date('Y-m-d H:i:s', REQUEST_TIME),
            'responseTime'       => $microTime,
            'responseTimeString' => date('Y-m-d H:i:s', $microTime),
        ];
        $result = [
            'body'    => $data,
            'status'  => $status,
            'APITime' => $apiTime,
        ];
        $this->returnJson($result);
    }

    /**
     * @doc 导航链接详情
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-08 18:48:37 周三
     */
    function detailOp(){
        $navDetail = [
            'id'               => 1,
            'name'             => '首页',
            'aHref'            => 'http://www.heanes.com/',
            'aTitle'           => '首页',
            'aTarget'          => '_blank',
            'imgSrc'           => 'image/nav/about.png',
            'imgSrcHover'      => 'image/nav/aboutHover.png',
            'imgSrcActive'     => 'image/nav/aboutActiver.png',
            'styleClass'       => 'header-nav nav-about',
            'styleClassHover'  => 'nav-about-hover',
            'styleClassActive' => 'nav-about-active',
            'orderNumber'      => '1',
        ];
        $status = [
            'message' => 'success',
            'code'    => 0,
            'success' => true,
            'errors'  => null,
        ];
        $microTime = microtime(true);
        $apiTime = [
            'requestTime'        => REQUEST_TIME,
            'requestTimeString'  => date('Y-m-d H:i:s', REQUEST_TIME),
            'responseTime'       => $microTime,
            'responseTimeString' => date('Y-m-d H:i:s', $microTime),
        ];
        $result = [
            'body'    => $navDetail,
            'status'  => $status,
            'APITime' => $apiTime,
        ];
        $this->returnJson($result);
    }

}