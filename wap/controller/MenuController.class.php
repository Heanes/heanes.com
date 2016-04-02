<?php
/**
 * @doc 菜单控制器
 * @filesource MenuController.class.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-09 18:07:05
 */
defined('InHeanes') or exit('Access Invalid!');

class MenuController extends BaseWapController{
	function __construct(){
		parent::__construct();
		$this->needLogin();
	}

	/**
	 * @doc
	 * @author Heanes
	 * @time 2015-07-22 09:15:55
	 */
	public function indexOp(){
		$this->defaultOp();
	}

	/**
	 * @doc 默认菜单
	 * @author Heanes
	 * @time 2015-07-22 09:19:39
	 */
	public function defaultOp(){
		showError('你好像迷路了哦~');
	}

	/**
	 * @doc 搜索菜单
	 * @author Heanes
	 * @time 2015-07-22 09:19:55
	 */
	public function searchOp(){
		$searchMenuArray = array(
			0 => array(
				'text' => '客户查询',
				'href' => BASE_URL.'index.php?act=customer&op=search',
				'icon' => 'image/menu-icon/employee.png',
			),
			1 => array(
				'text' => '贷款查询',
				'href' => BASE_URL.'index.php?act=borrow&op=search',
				'icon' => 'image/menu-icon/partjober.png',
			),
			3=>array(
				'text'=>'员工查询',
				'href'=>BASE_URL.'index.php?act=employee&op=search',
				'icon'=>'image/menu-icon/employee.png',
			),
			4=>array(
				'text'=>'部门查询',
				'href'=>BASE_URL.'index.php?act=department&op=search',
				'icon'=>'image/menu-icon/department.png',
			),
		);
		Tpl::assign('menuArray', $searchMenuArray);
		Tpl::assign('html_title', '查询信息');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 审核页面
	 * @author Heanes
	 * @time 2015-07-07 14:14:27
	 */
	public function checkOp(){
		$checkMenuArray = array(
			0 => array(
				'text' => '客户审核',
				'href' => BASE_URL.'index.php?act=customer&op=checkList',
				'icon' => 'image/menu-icon/employee.png',
			),
			1 => array(
				'text' => '金鹰审核',
				'href' => BASE_URL.'index.php?act=employee&op=checkList',
				'icon' => 'image/menu-icon/partjober.png',
			),
			2 => array(
				'text' => '贷款审核',
				'href' => BASE_URL.'index.php?act=borrow&op=checkList',
				'icon' => 'image/menu-icon/money.png',
			),
		);
		Tpl::assign('menuArray', $checkMenuArray);
		Tpl::assign('html_title', '审核信息');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 录入页面
	 * @author Heanes
	 * @time 2015-07-07 14:15:07
	 */
	public function recordOp(){
		$recordMenuArray = array(
			/*
			0 => array(
				'text' => '录入客户',
				'href' => BASE_URL.'index.php?act=customer&op=add',
				'icon' => 'image/menu-icon/employee.png',
			),
			*/
			0 => array(
				'text' => '录入贷款',
				'href' => BASE_URL.'index.php?act=borrow&op=addFromNewUser',
				'icon' => 'image/menu-icon/money.png',
			),
			1 => array(
				'icon' => 'image/menu-icon/partjober.png',
				'href' => BASE_URL.'index.php?act=employee&op=add',
				'text' => '录入金鹰',
			),
			2 => array(
				'text' => '存量客户',
				'href' => BASE_URL.'index.php?act=borrow&op=add',
				'icon' => 'image/menu-icon/employee.png',
			),
		);
		Tpl::assign('menuArray', $recordMenuArray);
		Tpl::assign('html_title', '录入信息');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 添加贷款菜单
	 * @author Heanes
	 * @time 2015-09-16 17:04:08
	 */
	public function addBorrowOp(){
		$addBorrowMenu = array(
			array(
				'text' => '添加贷款',
				'href' => BASE_URL.'index.php?act=borrow&op=addFromNewUser',
				'icon' => 'image/menu-icon/employee.png',
			),
			array(
				'text' => '存量客户',
				'href' => BASE_URL.'index.php?act=borrow&op=addFromExistsCustomer',
				'icon' => 'image/menu-icon/employee.png',
			),
		);
		Tpl::assign('menuArray', $addBorrowMenu);
		Tpl::assign('html_title', '添加贷款');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 贷款管理
	 * @author Heanes
	 * @time 2015-09-22 11:20:48
	 */
	public function borrowOp(){
		$borrowMenu = array(
			array(
				'text' => '添加贷款',
				'href' => BASE_URL.'index.php?act=borrow&op=addFromNewUser',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '存量客户',
				'href' => BASE_URL.'index.php?act=borrow&op=addFromExistsCustomer',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '贷款记录',
				'href' => BASE_URL.'index.php?act=borrow&op=myList',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '贷款统计',
				'href' => BASE_URL.'index.php?act=borrow&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
		);
		Tpl::assign('menuArray', $borrowMenu);
		Tpl::assign('html_title', '贷款管理');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 客户管理
	 * @author Heanes
	 * @time 2015-09-22 11:25:19
	 */
	public function customerOp(){
		$customerMenu = array(
			array(
				'text' => '添加客户',
				'href' => BASE_URL.'index.php?act=customer&op=add',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '我的客户',
				'href' => BASE_URL.'index.php?act=customer&op=mine',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '贷款统计',
				'href' => BASE_URL.'index.php?act=customer&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
		);
		Tpl::assign('menuArray', $customerMenu);
		Tpl::assign('html_title', '客户管理');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 金鹰管理
	 * @author Heanes
	 * @time 2015-09-22 11:25:19
	 */
	public function employeeOp(){
		$employeeMenu = array(
			array(
				'text' => '添加金鹰',
				'href' => BASE_URL.'index.php?act=employee&op=add',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '我的金鹰',
				'href' => BASE_URL.'index.php?act=employee&op=mine',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '金鹰统计',
				'href' => BASE_URL.'index.php?act=employee&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
		);
		Tpl::assign('menuArray', $employeeMenu);
		Tpl::assign('html_title', '金鹰管理');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 业绩统计
	 * @author Heanes
	 * @time 2015-09-22 11:25:19
	 */
	public function performanceOp(){
		$performanceMenu = array(
			array(
				'text' => '贷款统计',
				'href' => BASE_URL.'index.php?act=borrow&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '客户统计',
				'href' => BASE_URL.'index.php?act=customer&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
			array(
				'text' => '金鹰统计',
				'href' => BASE_URL.'index.php?act=employee&op=count',
				'icon' => 'image/menu-icon/default.png',
			),
		);
		Tpl::assign('menuArray', $performanceMenu);
		Tpl::assign('html_title', '我的业绩');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 统计页面
	 * @author Heanes
	 * @time 2015-07-07 14:17:26
	 */
	public function countOp(){
		$countMenuArray = array(
			0 => array(
				'text' => '客户统计',
				'href' => BASE_URL.'index.php?act=customer&op=count',
				'icon' => 'image/menu-icon/employee.png',
			),
			1 => array(
				'text' => '金鹰统计',
				'href' => BASE_URL.'index.php?act=employee&op=count',
				'icon' => 'image/menu-icon/partjober.png',
			),
			2 => array(
				'text' => '贷款统计',
				'href' => BASE_URL.'index.php?act=borrow&op=count',
				'icon' => 'image/menu-icon/money.png',
			),
		);
		Tpl::assign('menuArray', $countMenuArray);
		Tpl::assign('html_title', '信息统计');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 收藏管理菜单
	 * @author Heanes
	 * @time 2015-09-10 11:29:25
	 */
	public function collectOp(){
		$collectMenuArray = array(
			array(
				'text' => '产品收藏',
				'href' => BASE_URL.'index.php?act=product&op=collectList',
				'icon' => 'image/menu-icon/product.svg',
			),
			array(
				'text' => '积分商城收藏',
				'href' => BASE_URL.'index.php?act=wareShop&op=collectList',
				'icon' => 'image/menu-icon/wareCollect.svg',
			),
			array(
				'text' => '文章收藏',
				'href' => BASE_URL.'index.php?act=article&op=collectList',
				'icon' => 'image/menu-icon/articleCollect.svg',
			),
		);
		Tpl::assign('menuArray', $collectMenuArray);
		Tpl::assign('html_title','收藏管理');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 服务中心
	 * @author Heanes
	 * @time 2015-08-13 16:38:37
	 */
	public function serviceOp() {
		$serviceMenuArray = array(
			array(
				'text' => '投诉建议',
				'href' => BASE_URL.'index.php?act=service&op=suggest',
				'icon' => 'image/menu-icon/feedback.png',
			),
			array(
				'text' => '联系我们',
				'href' => BASE_URL.'index.php?act=service&op=contactUs',
				'icon' => 'image/menu-icon/contact-us.png',
			),
			array(
				'text' => '关于我们',
				'href' => BASE_URL.'index.php?act=article&op=about',
				'icon' => 'image/menu-icon/about-us.png',
			),
		);
		Tpl::assign('menuArray', $serviceMenuArray);
		Tpl::assign('html_title','服务中心');
		Tpl::display('menu/subMenuDefaultStyle');
	}

	/**
	 * @doc 设置功能
	 * @author Heanes
	 * @time 2015-08-23 22:13:25
	 */
	public function settingOp() {
		$settingMenuArray = array(
			array(
				'text' => '帐号与安全',
				'href' => BASE_URL.'index.php?act=service&op=suggest',
			),
			array(
				'text' => '关于',
				'href' => BASE_URL.'index.php?act=setting&op=about',
			),
		);
		Tpl::assign('menuArray', $settingMenuArray);
		Tpl::assign('html_title','服务中心');
		Tpl::display('menu/subMenuDefaultStyle');
	}
	/**
	 * @doc 工具箱
	 * @author Heanes
	 * @time 2015-09-22 10:22:00
	 */
	public function toolsOp() {
		$toolsMenuArray = array(
			array(
				'text' => '计算器',
				'href' => BASE_URL.'index.php?act=tools&op=calculator',
				'icon' => 'image/menu-icon/default.png',
				'is_new_function'=>true,
			),
			array(
				'text' => '备忘录',
				'href' => BASE_URL.'index.php?act=tools&op=note',
				'icon' => 'image/menu-icon/default.png',
				'is_new_function'=>true,
			),
		);
		Tpl::assign('menuArray', $toolsMenuArray);
		Tpl::assign('html_title','工具箱');
		Tpl::display('menu/subMenuDefaultStyle');
	}
}

