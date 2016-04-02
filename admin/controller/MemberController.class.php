<?php
/**
 * @doc 用户管理控制器
 * @filesource MemberController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-05 23:17:32
 */
defined('InHeanes') or exit('Access Invalid!');

class MemberController extends BaseAdminController {
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){
		$this->listOp();
	}
	/**
	 * @doc 会员列表
	 * @author Heanes
	 * @time 2015-07-06 13:54:43
	 */
	public function listOp(){
		$usersModel = Model('users');
		$page = new Page(10);
		$memberParam['order'] = array('reg_time' => 'DESC');
		$member_list = $usersModel->getList($memberParam, $page);


		//查看用户角色名称
		$userRoleModel = Model('user_role');       //角色表
		foreach ($member_list as $key => $member) {
			if(!empty($member)){
				$userRoleInfo=$userRoleModel->getOneByID($member['role_id']);
				$member_list[$key]['role_name']=$userRoleInfo['name']; //根据role_id查询角色名称
			}
		}


		Tpl::assign('member_list', $member_list);
		Tpl::assign('pager', $page->getPager());
		Tpl::assign('page_title', '会员列表');
		Tpl::display('member/list');
	}

	/**
	 * @doc 添加
	 * @author Heanes
	 * @time 2015-06-29 09:25:04
	 */
	public function addOp(){
		$usersModel = Model('users');
		//获取自增ID
		$lastID = $usersModel->getAutoIncrementId();
		
		//角色名称下拉框
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('lastID', $lastID);
		Tpl::assign('page_title', '添加会员');
		Tpl::display();
	}
	
	/**
	 * @doc 插入操作
	 * @author Heanes
	 * @time 2015-06-29 13:23:17
	 */
	public function insertOp(){
		$newUsers['nickname'] = Filter::doFilter($_POST['nickname'], 'string');
		//判断用户名是否存在
		$usersModel = Model('users');
		$newUsers['user_name'] = Filter::doFilter($_POST['user_name'], 'string');
		$memberNameParam['where'] = "`user_name`='".$newUsers['user_name']."'";
		$memberNameList=$usersModel->getList($memberNameParam);
		if(empty($memberNameList)){
			//判断邮箱是否存在
			$newUsers['user_email'] = Filter::doFilter($_POST['user_email'], 'string');
			$memberEmailParam['where'] = "`user_email`='".$newUsers['user_email']."'";
			$memberEmailList=$usersModel->getList($memberEmailParam);
			//邮箱为空时，可以直接插入数据库
			if(empty($memberEmailList) && isset($newUsers['user_email']) || $newUsers['user_email']==''){
				$newUsers['user_pwd'] = Filter::doFilter($_POST['user_pwd'], 'string');
				$newUsers['user_pwd'] = md5($newUsers['user_pwd']);
				$newUsers['role_id'] = Filter::doFilter($_POST['role_id'], 'string');
				$newUsers['mobile'] = Filter::doFilter($_POST['mobile'], 'string');
				$newUsers['telephone'] = Filter::doFilter($_POST['telephone'], 'string');
				$newUsers['age'] = Filter::doFilter($_POST['age'], 'string');
				$newUsers['gender'] = Filter::doFilter($_POST['gender'], 'string');
				if($newUsers['gender'] == '男'){
					$newUsers['gender'] = "1";
				}
				if($newUsers['gender'] == '女'){
					$newUsers['gender'] = "2";
				}
				if($newUsers['gender'] == '未知'){
					$newUsers['gender'] = "3";
				}
				$newUsers['idcard'] = Filter::doFilter($_POST['idcard'], 'string');
				$newUsers['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
				$newUsers['reg_time'] = to_timespan(Filter::doFilter($_POST['reg_time'], 'string'));
				$newUsers['update_time'] = to_timespan(Filter::doFilter($_POST['update_time'], 'string'));
				$newUsers['reg_ip'] = Filter::doFilter($_POST['reg_ip'], 'string');
				$newUsers['current_login_ip'] = get_client_ip();
				$newUsers['last_login_time'] = getGMTime();
				$newUsers['login_times'] = array(     //用户登录次数
					'sign'  => 'increase',
					'value' => 1,
				);
				$birthday = Filter::doFilter($_POST['birthday_year'], 'string');
				if(!empty($birthday)){  //否则如果为空数据库插入的是1970年
					$birthday_year = strtotime($birthday);  //将日期时转为 时间戳格式
					$newUsers['birthday_year'] = date("Y", $birthday_year); //年
					$newUsers['birthday_month'] = date("m", $birthday_year); //月
					$newUsers['birthday_day'] = date("d", $birthday_year); //日
				}
				$newUsers['has_married'] = Filter::doFilter($_POST['has_married'], 'string');
				$newUsers['qq'] = Filter::doFilter($_POST['qq'], 'string');
				$newUsers['webchat'] = Filter::doFilter($_POST['webchat'], 'string');
				$newUsers['user_edu'] = Filter::doFilter($_POST['user_edu'], 'string');
				$newUsers['monthly_income'] = Filter::doFilter($_POST['monthly_income'], 'string');
				$newUsers['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
				$newUsers['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
				if ($usersModel->insert($newUsers)) {
					showSuccess('添加成功');
				} else {
					showError('添加失败');
				}
			}else{
				echo "<script>alert('邮箱已存在，请重新填写!');location.href='index.php?act=member&op=add';</script>";
			}
		}else{
			echo "<script>alert('此用户名已存在，请重新填写!');location.href='index.php?act=member&op=add';</script>";
		}
	}
	
	/**
	 * @doc 修改
	 * @author Heanes
	 * @time 2015-06-29 10:15:28
	 */
	public function editOp(){
		$id = Filter::doFilter($_GET['id'], 'integer');
		$usersModel = Model('users');
		$member = $usersModel->getOneByID($id);
		//角色名称下拉框
		$userRoleModel = Model('user_role');
		$roleUrl_List = $userRoleModel->getList();
		Tpl::assign('roleUrl_List',$roleUrl_List);
		
		Tpl::assign('member', $member);
		Tpl::assign('page_title', '修改会员');
		Tpl::display();
	}


	/**
	 * @doc 修改操作
	 * @author Heanes
	 * @time 2015-06-29 17:49:28
	 */
	public function updateOp(){
		$id = Filter::doFilter($_POST['user_id'], 'integer');
		$newUsers['nickname'] = Filter::doFilter($_POST['nickname'], 'string');
		//判断用户名是否存在
		$usersModel = Model('users');
		$newUsers['user_name'] = Filter::doFilter($_POST['user_name'], 'string');
		$memberNameParam['where'] = "`user_name`='".$newUsers['user_name']."' AND `id`<>'".$id."'";
		$memberNameList=$usersModel->getList($memberNameParam);
		$nameCount = count($memberNameList);
		if($nameCount<1){
			//判断邮箱是否存在
			$newUsers['user_email'] = Filter::doFilter($_POST['user_email'], 'string');
			$memberEmailParam['where'] = "`user_email`='".$newUsers['user_email']."' AND `id`<>'".$id."'";
			$memberEmailList=$usersModel->getList($memberEmailParam);
			$emailCount = count($memberEmailList);
			//邮箱都更改为空也可以
			if($emailCount<1 && isset($newUsers['user_email']) || $newUsers['user_email']==''){
				$newUsers['user_pwd'] = Filter::doFilter($_POST['user_pwd'], 'string');
				$newUsers['user_pwd'] = md5($newUsers['user_pwd']);
				$newUsers['role_id'] = Filter::doFilter($_POST['role_id'], 'string');
				$newUsers['mobile'] = Filter::doFilter($_POST['mobile'], 'string');
				$newUsers['telephone'] = Filter::doFilter($_POST['telephone'], 'string');
				$newUsers['age'] = Filter::doFilter($_POST['age'], 'string');
				$newUsers['gender'] = Filter::doFilter($_POST['gender'], 'string');
				if($newUsers['gender'] == '男'){
					$newUsers['gender'] = "1";
				}
				if($newUsers['gender'] == '女'){
					$newUsers['gender'] = "2";
				}
				if($newUsers['gender'] == '未知'){
					$newUsers['gender'] = "3";
				}
				$newUsers['idcard'] = Filter::doFilter($_POST['idcard'], 'string');
				$newUsers['real_name'] = Filter::doFilter($_POST['real_name'], 'string');
				$newUsers['reg_time'] = to_timespan(Filter::doFilter($_POST['reg_time'], 'string'));
				$newUsers['update_time'] = getGMTime();
				$newUsers['reg_ip'] = Filter::doFilter($_POST['reg_ip'], 'string');
				$newUsers['current_login_ip'] = get_client_ip();
				$newUsers['last_login_time'] = getGMTime();
				$newUsers['login_times'] = array(     //用户登录次数
					'sign'  => 'increase',
					'value' => 1,
				);
				$birthday = Filter::doFilter($_POST['birthday_year'], 'string');
				$birthday_year = strtotime($birthday);  //将日期时转为 时间戳格式
				$year = date("Y", $birthday_year); //年
				if($year!='1970'){  //否则如果非空且为--时，数据库插入的是1970年
					$newUsers['birthday_year'] = date("Y", $birthday_year); //年
					$newUsers['birthday_month'] = date("m", $birthday_year); //月
					$newUsers['birthday_day'] = date("d", $birthday_year); //日
				}
				$newUsers['has_married'] = Filter::doFilter($_POST['has_married'], 'string');
				$newUsers['qq'] = Filter::doFilter($_POST['qq'], 'string');
				$newUsers['webchat'] = Filter::doFilter($_POST['webchat'], 'string');
				$newUsers['user_edu'] = Filter::doFilter($_POST['user_edu'], 'string');
				$newUsers['monthly_income'] = Filter::doFilter($_POST['monthly_income'], 'string');
				$newUsers['is_enable'] = Filter::doFilter($_POST['is_enable'], 'integer');
				$newUsers['is_delete'] = Filter::doFilter($_POST['is_delete'], 'integer');
				$where = "`id`=$id";
				if ($usersModel->update($newUsers, $where)) {
					showSuccess('修改成功');
				} else {
					showError('修改失败');
				}
			}else{
				echo "<script>alert('邮箱已存在，请重新修改!');location.href='index.php?act=member&op=edit&id=$id';</script>";
			}
		}else{
			echo "<script>alert('此用户名已存在，请重新修改!');location.href='index.php?act=member&op=edit&id=$id';</script>";
		}
	}

	/**
	 * @doc 删除操作
	 * @author Heanes
	 * @time 2015-07-06 14:08:44
	 */
	public function deleteOp(){
		$id = Filter::doFilter($_POST['id'], 'integer');
		$where = "`id`=$id";
		$usersModel = Model('users');
		if ($usersModel->delete($where)) {
			showSuccess('删除成功');
		} else {
			showError('删除失败');
		}
	}
}

