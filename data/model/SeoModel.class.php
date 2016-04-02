<?php
/**
 * @doc SEO模型
 * @filesource SeoModel.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-06-10 10:36:48
 */
defined('InHeanes') or exit('Access Invalid!');
class SeoModel extends BaseModel {

	private $table='seo';
	
	function __construct() {
		parent::__construct('seo');
	}

	/**
	 * @doc 取得SEO信息
	 * @param array/string $type Seo类型
	 * @author Heanes
	 * @time 2015-06-10 16:27:46
	 */
	public function type($type){
		;
	}

	/**
	 * @doc 设置SEO数据到数据库中
	 * @param $seoArray
	 * @author Heanes
	 * @time 2015-06-10 16:14:48
	 */
	public function setSEO($seoArray){
		//$param['table']=$this->table;
		//DB::update($seoArray,'id');
	}

	/**
	 * @doc 从数据库中获取SEO信息
	 * @author Heanes
	 * @time 2015-06-10 16:16:02
	 */
	public function getSEO(){
		return array(
			'seo_keywords'=>'金乐汇P2P|金乐汇|金乐汇金融超市|金乐汇金融|互联网金融|债权转让|网络贷款|网贷|企业贷|个人贷',
			'seo_description'=>'金乐汇打造互联网金融超市',
			'html_title'=>'金乐汇',
		);
	}

	/**
	 * @doc 显示SEO信息
	 * @author Heanes
	 * @time 2015-06-10 16:37:24
	 */
	public function show(){
		;
	}
}
