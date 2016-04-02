<?php
/**
 * @doc 后台菜单配置数组
 * @filesource menu.php
 * @copyright heanes.com
 * @author Heanes
 * @time 2015-07-01 15:30:59
 */
defined('InHeanes') or exit('Access Invalid!');
return array(
	/*
	0 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '常用功能',
		'menu_info' => '常用功能',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '文章模块',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '文章列表',
						'menu_action' => 'article',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '文章回收站',
						'menu_action' => 'article',
						'menu_op'     => 'recycle',
					),
				),
			),
			1 => array(
				'menu_name' => '客户管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '客户列表',
						'menu_action' => 'customer',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '添加客户',
						'menu_action' => 'customer',
						'menu_op'     => 'add',
					),
				),
			),
			2 => array(
				'menu_name' => '贷款管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '贷款记录列表',
						'menu_action' => 'borrow',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '借款申请列表',
						'menu_action' => 'borrowApply',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '借款进度列表',
						'menu_action' => 'borrowProgress',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '借款用途列表',
						'menu_action' => 'borrowUsage',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
	*/
	1 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '前端管理',
		'menu_info' => '前端管理',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '文章管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '文章列表',
						'menu_action' => 'article',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '文章回收站',
						'menu_action' => 'article',
						'menu_op'     => 'list&status=recycle',
					),
					2 => array(
						'menu_name'   => '文章评论',
						'menu_action' => 'articleComment',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '文章分类',
						'menu_action' => 'articleCategory',
						'menu_op'     => 'list',
					),
				),
			),
			1 => array(
				'menu_name' => '友情链接',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '友情链接列表',
						'menu_action' => 'friendLink',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '申请列表',
						'menu_action' => 'friendLinkApply',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '申请操作记录',
						'menu_action' => 'friendLinkOperate',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '链接分类列表',
						'menu_action' => 'friendLinkCategory',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
	2 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '交易管理',
		'menu_info' => '交易管理',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '客户管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '添加客户',
						'menu_action' => 'customer',
						'menu_op'     => 'add',
					),
					1 => array(
						'menu_name'   => '客户列表',
						'menu_action' => 'customer',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '客户申请',
						'menu_action' => 'customerApply',
						'menu_op'     => 'list',
					),
				),
			),
			1 => array(
				'menu_name' => '贷款管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '贷款记录列表',
						'menu_action' => 'borrow',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '贷款快速申请',
						'menu_action' => 'moneyQuickApply',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '快速申请记录',
						'menu_action' => 'moneyQuickApplyLog',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '借款申请列表',
						'menu_action' => 'borrow',
						'menu_op'     => 'list&applyStatus=0',
					),
					4 => array(
						'menu_name'   => '借款进度列表',
						'menu_action' => 'borrowProgress',
						'menu_op'     => 'list',
					),
					5 => array(
						'menu_name'   => '借款用途列表',
						'menu_action' => 'borrowUsage',
						'menu_op'     => 'list',
					),
				),
			),
			2 => array(
				'menu_name' => '贷款产品',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '产品基本信息',
						'menu_action' => 'product',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '产品分类',
						'menu_action' => 'productCategory',
						'menu_op'     => 'list',
					),
					
					2 => array(
						'menu_name'   => '产品类型',
						'menu_action' => 'productType',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '产品属性',
						'menu_action' => 'proAttribute',
						'menu_op'     => 'list',
					),
					4 => array(
						'menu_name'   => '产品属性映射',
						'menu_action' => 'proAttributeData',
						'menu_op'     => 'list',
					),
				),
			),
			3 => array(
					'menu_name' => '积分商城',
					'sub_menu'  => array(
							0 => array(
									'menu_name'   => '物品基本信息',
									'menu_action' => 'ware',
									'menu_op'     => 'list',
							),
							1 => array(
									'menu_name'   => '物品分类',
									'menu_action' => 'wareCategory',
									'menu_op'     => 'list',
							),
							2 => array(
									'menu_name'   => '物品类型',
									'menu_action' => 'wareType',
									'menu_op'     => 'list',
							),
							3 => array(
									'menu_name'   => '物品属性',
									'menu_action' => 'wareAttribute',
									'menu_op'     => 'list',
							),
							4 => array(
									'menu_name'   => '物品属性映射',
									'menu_action' => 'wareAttributeData',
									'menu_op'     => 'list',
							),
							5 => array(
									'menu_name'   => '物品相册',
									'menu_action' => 'wareAlbum',
									'menu_op'     => 'list',
							),
					),
			),
			4 => array(
				'menu_name' => '商品管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '商品基本信息',
						'menu_action' => 'goods',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '商品配件信息',
						'menu_action' => 'goodsAccessories',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '商品分类',
						'menu_action' => 'goodsCategory',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '商品类型',
						'menu_action' => 'goodsType',
						'menu_op'     => 'list',
					),
					4 => array(
					'menu_name'   => '商品属性',
					'menu_action' => 'goodsAttribute',
					'menu_op'     => 'list',
				),
					5 => array(
						'menu_name'   => '商品属性映射',
						'menu_action' => 'goodsAttributeData',
						'menu_op'     => 'list',
					),
					6 => array(
						'menu_name'   => '商品相册',
						'menu_action' => 'goodsAlbum',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
	3 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '会员与留言',
		'menu_info' => '会员与留言',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '会员管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '会员列表',
						'menu_action' => 'member',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '会员审核',
						'menu_action' => 'member',
						'menu_op'     => 'check',
					),
					2 => array(
						'menu_name'   => '会员额外属性',
						'menu_action' => 'UserAttribute',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '注册项数据映射',
						'menu_action' => 'UserAttributeData',
						'menu_op'     => 'list',
					),
				),
			),
			1 => array(
				'menu_name' => '认证管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '认证列表',
						'menu_action' => 'UserCertification',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '审核认证',
						'menu_action' => 'CertificationCheck',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '认证方式类别',
						'menu_action' => 'CertificationType',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '认证属性',
						'menu_action' => 'CertificationTypeAttribute',
						'menu_op'     => 'list',
					),
					4 => array(
						'menu_name'   => '认证属性映射',
						'menu_action' => 'CertificationAttributeData',
						'menu_op'     => 'list',
					),
				),
			),
			2 => array(
				'menu_name' => '用户资产',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '用户资产存储',
						'menu_action' => 'userProperty',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '资产类型',
						'menu_action' => 'property',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '资产属性',
						'menu_action' => 'propertyAttribute',
						'menu_op'     => 'list',
					),
					
					3 => array(
						'menu_name'   => '用户资产数据',
						'menu_action' => 'userPropertyData',
						'menu_op'     => 'list',
					),
					4 => array(
						'menu_name'   => '用户银行卡',
						'menu_action' => 'userBank',
						'menu_op'     => 'list',
					),
				),
			),
			3 => array(
				'menu_name' => '权限管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '权限功能存储',
						'menu_action' => 'privilegeUrl',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '用户权限',
						'menu_action' => 'userPrivilege',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '用户角色',
						'menu_action' => 'userRole',
						'menu_op'     => 'list',
					),
				),
			),
			4 => array(
				'menu_name' => '发送私信',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '会员私信列表',
						'menu_action' => 'userMessage',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '消息操作日志',
						'menu_action' => 'messageLog',
						'menu_op'     => 'list',
					),
				),
			),
			5 => array(
				'menu_name' => '用户积分',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '用户积分类型',
						'menu_action' => 'userRankType',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '用户积分列表',
						'menu_action' => 'userRank',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '积分变更记录',
						'menu_action' => 'userRankLog',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
	4 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '公司管理',
		'menu_info' => '公司管理',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '部门管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '部门列表',
						'menu_action' => 'department',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '添加部门',
						'menu_action' => 'department',
						'menu_op'     => 'add',
					),
				),
			),
			1 => array(
				'menu_name' => '员工管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '员工列表',
						'menu_action' => 'employee',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '添加员工',
						'menu_action' => 'employee',
						'menu_op'     => 'add',
					),
					2 => array(
						'menu_name'   => '申请操作记录',
						'menu_action' => 'employeeStatus',
						'menu_op'     => 'list',
					),
				),
			),
			2 => array(
				'menu_name' => '职位管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '职位列表',
						'menu_action' => 'job',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '添加职位',
						'menu_action' => 'job',
						'menu_op'     => 'add',
					),
					3 => array(
						'menu_name'   => '职位分类',
						'menu_action' => 'jobCategory',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
	5 => array(
		'menu_code' => 'frequently-used',
		'menu_name' => '系统设置',
		'menu_info' => '系统设置',
		'sub_menu'  => array(
			0 => array(
				'menu_name' => '网站设置',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '网站设置',
						'menu_action' => 'setting',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '导航链接',
						'menu_action' => 'navigation',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => 'WAP版网站导航',
						'menu_action' => 'navigationWap',
						'menu_op'     => 'list',
					),
					3 => array(
						'menu_name'   => '首页幻灯',
						'menu_action' => 'slide',
						'menu_op'     => 'list',
					),
					4 => array(
						'menu_name'   => '首页幻灯WAP端',
						'menu_action' => 'slideWap',
						'menu_op'     => 'list',
					),
				),
			),
			1 => array(
				'menu_name' => '短信管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '发送记录',
						'menu_action' => 'smsLog',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '内容模版',
						'menu_action' => 'smsTemplate',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '短信接口',
						'menu_action' => 'smsInterfere',
						'menu_op'     => 'list',
					),
				),
			),
			2 => array(
				'menu_name' => '邮件管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '发送记录',
						'menu_action' => 'smsLog',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '内容模版',
						'menu_action' => 'smsTemplate',
						'menu_op'     => 'list',
					),
					2 => array(
						'menu_name'   => '邮件接口',
						'menu_action' => 'emailInterface',
						'menu_op'     => 'list',
					),
				),
			),
			3 => array(
				'menu_name' => '内容库',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '银行卡管理',
						'menu_action' => 'bank',
						'menu_op'     => 'list',
					),
				),
			),
			4 => array(
				'menu_name' => '数据库',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '数据库备份',
						'menu_action' => 'dbTools',
						'menu_op'     => 'backup',
					),
					1 => array(
						'menu_name'   => 'SQL操作',
						'menu_action' => 'dbTools',
						'menu_op'     => 'runSQL',
					),
				),
			),
			5 => array(
				'menu_name' => '系统日志',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '日志列表',
						'menu_action' => 'log',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '访问统计',
						'menu_action' => 'webVisitor',
						'menu_op'     => 'list',
					),
				),
			),
			6 => array(
				'menu_name' => '文件管理',
				'sub_menu'  => array(
					0 => array(
						'menu_name'   => '文件类型',
						'menu_action' => 'fileType',
						'menu_op'     => 'list',
					),
					1 => array(
						'menu_name'   => '存储分类',
						'menu_action' => 'fileCategory',
						'menu_op'     => 'list',
					),
				),
			),
		),
	),
);
