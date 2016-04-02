<?php
/**
 * @doc 
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015年5月22日上午10:51:01
 */
defined('InHeanes') or exit('Access Invalid!');
class IndexController extends BaseWapController {
	
	function __construct() {
		parent::__construct();
	}
	function indexOp() {
		//获取幻灯显示
		$slideWapModel=Model('slide_wap');
		$slideWapParam['where']="`is_enable`=1 AND `is_delete`=0";
		$slideWapParam['order']=array('order'=>'ASC');
		$slideWapList=$slideWapModel->getList($slideWapParam);
		foreach ($slideWapList as $key => $value) {
			//从设置中获取该类型文件存储路径，再拼接成完整的文件位置
			$slideWapList[$key]['img_src']=PATH_BASE_FILE_UPLOAD.'wap/image/slide/'.$value['img_src'];
		}
		Tpl::assign('slideWapList',$slideWapList);
		Tpl::assign('html_title','首页');
		Tpl::display('index/index');
	}
}