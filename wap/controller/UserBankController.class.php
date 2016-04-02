<?php
/**
 * @doc 银行卡
 * @filesource UserBankController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-11 18:05:09
 */
defined('InHeanes') or exit('Access Invalid!');

class UserBankController extends BaseWapController {
	function __construct() {
		parent::__construct();
	}

	public function indexOp() {
		if (isset($_GET['id'])) {
			$this->showOp();
		}else{
			$this->listOp();
		}
	}

	public function listOp() {
		$user_id = $_SESSION['user_id'];
		//银行卡信息
		$userBankModel = Model('user_bank');
		$userBankParam['where'] = "`user_id`='" . $user_id . "'";
		$page = new Page(10);
		$userBankList = $userBankModel->getList($userBankParam, $page);
		$bankModel = Model('bank');
		foreach ($userBankList as $key => $bank) {
			$userBankList[$key]['bank_name'] = $bankModel->getOneByID($bank['bank_id'])['name'];
		}
		Tpl::assign('userBankList', $userBankList);
		Tpl::assign('html_title', '用户银行卡列表');
		Tpl::display('bank/userBankList');
	}

	public function showOp() {
		$user_id = $_SESSION['user_id'];
		//银行卡信息
		$userBankModel = Model('user_bank');
		$bank_id = intval(Filter::doFilter($_GET['id'], 'integer'));
		$userBank = $userBankModel->getOneByID($bank_id);
		$bankModel = Model('bank');
		$userBank['bank_name'] = $bankModel->getOneByID($userBank['bank_id'])['name'];
		Tpl::assign('userBank', $userBank);
		Tpl::assign('html_title', '银行卡信息');
		Tpl::display('bank/userBankInfo');
	}

	//银行卡添加页
	public function addOp() {
		$bankModel = Model('bank');
		$bankList = $bankModel->getList();
		Tpl::assign('html_title', '添加银行卡');
		Tpl::assign('bankList', $bankList);
		Tpl::display('bank/addUserBank');
	}

	//执行添加程序
	public function uploadOp() {
		// $file_info =  var_dump($_FILES);
		$picname = array('front_pic_src');
		$upload = new UploadFile();
		//设置允许上传大小
		$upload->set('max_size', 10240);
		//生成新图的扩展名为.jpg
		$upload->set('new_ext', 'jpg');
		//检查允许上传大小
		if ($_FILES['input_file_name']['size'] <= 1024 * 1024 * 10) {
			//上传操作
			foreach ($picname as $v => $i) {
				//设置存储路径
				$upload->setPath('bank' . DS . $i);
				$result = $upload->upload($i);
				if ($result) {
					//echo '上传成功';
					$a = $upload->getUploadResult();
					$uploadFile[$i] = $a['save_path'] . $a['save_name'];
				} else {
					$upload->getError();
				}
			}
			//var_dump($uploadFile);
		}
		if (isSubmit('bank_form_submit')) {
			$bank_data = array(
				'user_id'              => Filter::doFilter($_SESSION['user_id'], 'integer'),
				'real_name'            => Filter::doFilter($_POST['real_name'], 'string'),
				'bank_id'              => Filter::doFilter($_POST['bank_id'], 'integer'),
				'bank_no'              => Filter::doFilter($_POST['bank_no'], 'string'),
				'account_bank_address' => Filter::doFilter($_POST['account_bank_address'], 'string'),
				'front_pic_src'        => Filter::doFilter($uploadFile['front_pic_src'], 'string'),
				'insert_time'          => Filter::doFilter(getGMTime(), 'string'),
				'update_time'          => Filter::doFilter(getGMTime(), 'string'),

			);
			// echo "<pre>";
			// var_dump($bank_data);
			// echo "</pre>";
			$user_bankModel = Model('user_bank');
			$bank_update = $user_bankModel->insert($bank_data);
			if ($bank_update) {
				showSuccess('恭喜您！添加成功。');
			} else {
				showError('对不起！添加失败。');
			}
		} else {
			showError('请不要重复提交，亲！');
		}
	}

	//修改页面
	public function editOp() {
		$userBankModel = Model('user_bank');
		$bank_id = intval(Filter::doFilter($_GET['id'], 'integer'));
		$cid = Filter::doFilter($_SESSION['user_id'], 'integer');
		$bank_param['where'] = "`id`='$bank_id' and `user_id`='$cid' ";
		$userBank = $userBankModel->getList($bank_param);
		// var_dump($userBank);
		$bankModel = Model('bank');
		$bankList = $bankModel->getList();
		Tpl::assign('userBank', $userBank);
		Tpl::assign('bankList', $bankList);
		Tpl::assign('html_title', '银行卡修改');
		Tpl::display('bank/editUserBank');
	}

	//执行修改程序
	public function edit_updateOp() {
		$picname = array('front_pic_src');
		$upload = new UploadFile();
		//设置允许上传大小
		$upload->set('max_size', 10240);
		//生成新图的扩展名为.jpg
		$upload->set('new_ext', 'jpg');
		//检查允许上传大小
		if ($_FILES['input_file_name']['size'] <= 1024 * 1024 * 10) {
			//上传操作
			foreach ($picname as $v => $i) {
				//设置存储路径
				$upload->setPath('bank' . DS . $i);
				$result = $upload->upload($i);
				if ($result) {
					//echo '上传成功';
					$a = $upload->getUploadResult();
					$uploadFile[$i] = $a['save_path'] . $a['save_name'];
				} else {
					$upload->getError();
				}
			}
			//var_dump($uploadFile);
		}
		$bank_data = array(
			'user_id'              => Filter::doFilter($_SESSION['user_id'], 'integer'),
			'real_name'            => Filter::doFilter($_POST['real_name'], 'string'),
			'bank_id'              => Filter::doFilter($_POST['bank_id'], 'integer'),
			'bank_no'              => Filter::doFilter($_POST['bank_no'], 'string'),
			'account_bank_address' => Filter::doFilter($_POST['account_bank_address'], 'string'),
			'front_pic_src'        => Filter::doFilter($uploadFile['front_pic_src'], 'string'),
			'insert_time'          => Filter::doFilter(getGMTime(), 'string'),
			'update_time'          => Filter::doFilter(getGMTime(), 'string'),
		);
		// echo "<pre>";
		// var_dump($bank_data);
		// echo "</pre>";
		$id = Filter::doFilter($_POST['id'], 'integer');
		//  echo $id;
		$user_bankModel = Model('user_bank');
		$where = "`id`=$id";
		$bank_update = $user_bankModel->update($bank_data, $where);
		if ($bank_update) {
			showSuccess('亲！修改成功。');
		} else {
			showError('对不起！修改失败了。');
		}
	}

}

