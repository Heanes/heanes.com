<?php
/**
 * @doc ajax处理及响应控制器
 * @filesource AjaxResponseController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-20 15:51:57
 */
defined('InHeanes') or exit('Access Invalid!');

class AjaxResponseController extends BaseWapController{
	function __construct(){
		parent::__construct();
	}

	/**
	 * @doc ajax方式文件上传
	 * @author Heanes
	 * @time 2015-07-20 15:53:58
	 */
	public function fileUploadOp(){
		$save_path = $_POST['save_path'];
		$field_name = $_POST['field_name'];
		//var_dump($_FILES);
		//var_dump($_REQUEST);
		//exit;
		$upload = new UploadFile();
		$upload->setPath($save_path);
		$upload->set('max_size', 10240);
		if ($_FILES[$field_name]['size'] <= 1024 * 1024 * 10) {
			$FileUploadResult = $upload->upload($field_name);
			if ($FileUploadResult) {
				$UploadResult = $upload->getUploadResult();
				$size = round($_FILES[$field_name]['size'] / 1024, 2);
				ajax_return(array('status'    => 1,
								  'save_path' => $UploadResult['save_path'],
								  'save_name' => $UploadResult['save_name'],
								  'msg'       => '上传成功',
								  'name'      => $_FILES[$field_name]['name'],
								  'pic'       => $UploadResult['save_name'],
								  'size'      => $size));
			} else {
				ajax_return(array('status' => 0, 'msg' => $upload->getError()));
			}
		}
	}
}