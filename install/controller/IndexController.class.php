<?php
/**
 * @doc 安装程序初始控制器类
 * @filesource IndexController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-05-11 23:03:27
 */
defined('InHeanes') or exit('Access Invalid!');
class IndexController extends BaseInstallController {
	function __construct() {
		//echo __METHOD__.'</br>';
		parent::__construct();
	}
	
	public function indexOp() {
		if(isInstalled()){
			exit;
		}else{
			Tpl::display('install/installConfirm');
		}
	}

	public function checkOp(){
		Tpl::assign('html_title','第一步，检查环境');
		Tpl::display('checkEnvironment/checkEnvironment');
	}

	/**
	 * @doc 安装第一步
	 * @author Heanes
	 * @time 2015-06-23 13:13:53
	 */
	public function step1Op(){
		if(isSubmit('install_setup_step1')){
			$this->databaseInitialize();
		}else{
			Tpl::assign('html_title','第二步，配置数据库');
			Tpl::display('install/installDbSetupStep1');
		}
	}

	/**
	 * @doc 数据库初始化操作
	 * @author Heanes
	 * @time 2015-06-23 13:14:12
	 */
	public function databaseInitialize(){
		//1.创建数据库，初始化表
		$sql_file_list=File::getFileList(PATH_ABS_BASE_DATA.'sql');
		//print_arr($sql_file_list);
		$file_name=PATH_ABS_BASE_DATA.'sql_query/01_create.sql';
		file_put_contents($file_name, '');
		$multi_sql='';
		foreach ($sql_file_list as $key => $sql_file) {
			if(substr($sql_file,strrpos($sql_file,".")+1)=='sql'){
				$sql=file_get_contents(iconv('utf-8','gb2312',$sql_file));
				file_put_contents($file_name, $sql, FILE_APPEND);
				$multi_sql.=$sql;
			}
		}
		//2.插入初始化数据至表中
		$sql_import_file=PATH_ABS_BASE_DATA.'sql_query/02_import.sql';
		$sql_import_string=file_get_contents(iconv('utf-8','gb2312',$sql_import_file));
		$multi_sql.=$sql_import_string;
		//3.插入样例数据至表中
		$sql_demo_file=PATH_ABS_BASE_DATA.'sql_query/03_demo_data.sql';
		$sql_demo_string=file_get_contents(iconv('utf-8','gb2312',$sql_demo_file));
		$multi_sql.=$sql_demo_string;
		//echo highlight_string($multi_sql);
		//exit;
		if(DB::multi_query($multi_sql)){
			@ob_clean();
			@header('Location: index.php?act=index&op=step2');
		}else{
			echo '出现问题！';
		}
	}

	public function step2Op(){
		if(isSubmit('install_system_setup_submit')){
			$this->systemInitialize();
		}else{
			Tpl::assign('第二步，配置系统账户');
			Tpl::display('install/installSystemSetup');
		}
	}

	/**
	 * @doc 系统初始化
	 * @author Heanes
	 * @time 2015-06-23 13:25:51
	 */
	protected function systemInitialize(){
		@ob_clean();
		@header('Location: index.php?act=index&op=success');
	}
	
	public function successOp(){
		Tpl::assign('html_title','恭喜，安装成功！');
		Tpl::display('install/installSuccess');
	}
}