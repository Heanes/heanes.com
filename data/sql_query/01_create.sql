use `heanes.com`;
set foreign_key_checks = 0;

/*
 * 建表必加字段及几个状态说明：
 * insert_time 基本要加
 * update_time 基本要加
 * is_enable 基本要加，有效状态，0-无效，1-有效
 * is_delete 基本要加，是否删除删除，0-删除，1-不删除
 * order 基本要加
 * 状态常量说明
 * 0-表示该字段逻辑上“不是的”，1-表示该字段逻辑上“成立”
 * 对于表示状态的字段，为空表示“未知”，0表示“否”状态，1表示“是”状态
 * 对于表示审核状态的字段，0为“审核中”，1表示“已通过”，-1表示“拒绝”
 */

#----------pre_表--------------------------------------------------------
/*
 * @doc
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
/*
drop table if exists `pre_`;
create table `pre_` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '';
*/-- ----- 海利系统数据库创建脚本 --------------------------------------
/* 任务开始时间：2014.06.03
 * @author:Heanes
*/
#----------创建数据库 ---------------------------------------------------
/* 
 * @doc海利系统数据库
 * @author Heanes
 * @time 2015-01-09 11:53:57
*/
drop database if exists `heanes.com`;
create database if not exists `heanes.com`
	default character set `utf8`
	collate `utf8_general_ci`;
use `heanes.com`;
/*
show databases;
show tables;
show create database `heanes.com`;
*/
use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_admin_menu后台菜单表--------------------------------------------------------
/* 
 * @doc 后台菜单表，存储后台菜单
 * @author Heanes
 * @time 2015-01-09 11:53:13
*/
drop table if exists `pre_admin_menu`;
create table `pre_admin_menu` (
	`id`        int unsigned auto_increment comment '自增ID，主键',
	`parent_id` int unsigned comment '父菜单ID',
	`name`      varchar(255)     not null comment '菜单名称',
	`a_href`    varchar(511) comment '菜单链接地址',
	`a_title`   varchar(511) comment '菜单链接title值',
	`a_color`   varchar(12) comment '菜单链接颜色值',
	`img_src`   varchar(255) comment '菜单图片地址',
	`img_title` varchar(255) comment '菜单图片title值',
	`order`     int unsigned comment '排序',
	`is_enable` tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台菜单表';

#----------pre_admin_menu_priv后台菜单权限表--------------------------------------------------------
/* 
 * @doc 后台菜单权限表，不同管理员角色对应不同权限的操作
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_admin_menu_privilege`;
create table `pre_admin_menu_privilege` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_id`      int unsigned comment '管理员用户ID',
	`user_role_id` int unsigned comment '权限所需角色ID',
	`menu_id`      int unsigned comment '可操作菜单ID',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台菜单权限表';
use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_admin_user后台菜单表--------------------------------------------------------
/* 
 * @doc 后台菜单表，存储后台菜单
 * @author Heanes
 * @time 2015-01-09 11:53:13
*/
drop table if exists `pre_admin_user`;
create table `pre_admin_user` (
	`id`                 int unsigned auto_increment comment '自增ID，主键',
	`user_name`          varchar(63) comment '管理员用户名',
	`user_pwd`           varchar(64)  not null comment '管理员密码',
	`user_email`         varchar(255) comment '管理员邮箱',
	`mobile`             varchar(63) comment '用户手机号',
	`telephone`          varchar(63) comment '用户固定电话',
	`role_id`            int unsigned comment '管理员权限角色ID',
	`role_name`          varchar(63) comment '管理员权限角色名称',
	`create_time`        int(10) comment '管理员创建时间',
	`update_time`        int(10) comment '管理员资料最后更新时间',
	`allow_login`        tinyint unsigned comment '是否允许登录',
	`login_times`        int unsigned default 0 comment '登录次数',
	`last_login_time`    int(10) comment '最后登陆时间',
	`current_login_time` int(10) comment '当前登陆时间',
	`current_login_ip`   varchar(255) comment '当前登录IP',
	`last_login_ip`      varchar(255) comment '上次登录IP',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台管理员用户表';

#----------pre_admin_role后台管理员用户角色权限表--------------------------------------------------------
/* 
 * @doc 后台菜单用户角色权限表，不同角色不同名称
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_admin_role`;
create table `pre_admin_role` (
	`id`        int unsigned auto_increment comment '自增ID，主键',
	`code`      varchar(63) comment '权限code',
	`name`      varchar(63) comment '权限角色名称',
	`order`     int unsigned comment '排序',
	`is_enable` tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台管理员用户角色权限表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_setting_common网站全局设置表--------------------------------------------------------
/* 
 * @doc 网站全局设置表，存储公共设置项
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_setting_common`;
create table `pre_setting_common` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`parent_id`   int unsigned comment '父ID，用来分组，以方便用户设置',
	`name`        varchar(255) comment '设置项名称',
	`code`        varchar(255) comment '设置项code',
	`input_type`  varchar(127) comment '设置输入形式',
	`input_range` varchar(255) comment '设置项备选值范围',
	`store_value` text comment '设置项存储值',
	`order`       int unsigned comment '排序',
	`can_edit`    tinyint unsigned default 1 comment '是否是可编辑项',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站全局设置表';

#----------pre_seo网站SEO信息设置表--------------------------------------------------------
/*
 * @doc 网站SEO信息设置表，存储SEO信息，不同app可以设置不同seo信息
 * @author Heanes
 * @time 2015-06-10 17:11:19
*/
drop table if exists `pre_seo`;
create table `pre_seo` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`title`       varchar(255) comment '标题',
	`keywords`    varchar(255) comment '关键词',
	`description` varchar(255) comment '描述',
	`type`        varchar(127) comment '类型',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站SEO信息设置表';

#--------------------------------------------------------------------------手机版页面相关-------------------------------------------------------------------
#----------pre_setting_wap WAP版网站设置表--------------------------------------------------------
/*
 * @doc 网站全局设置表，存储公共设置项
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_setting_wap`;
create table `pre_setting_wap` (
	`id`        int unsigned auto_increment comment '自增ID，主键',
	`name`      varchar(255) comment '设置项名称',
	`value`     varchar(255) comment '设置项值',
	`type`      varchar(127) comment '设置输入形式',
	`order`     int unsigned comment '排序',
	`is_enable` tinyint unsigned default 1 comment '是否启用',
	`is_delete` tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment 'WAP版网站设置表';
use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_navigation表--------------------------------------------------------
/* 
 * @doc 前台网站导航栏表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_navigation`;
create table `pre_navigation` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`parent_id`     int unsigned default 0 comment '父导航ID',
	`name`          varchar(15) not null comment '导航栏名称',
	`a_href`        varchar(255) comment '导航链接',
	`a_title`       varchar(255) comment '链接title',
	`a_target`      tinyint unsigned comment '导航链接打开方式',
	`img_src`       varchar(255) comment '导航链接图标地址',
	`img_src_hover` varchar(255) comment '导航链接图标激活样式地址',
	`href_in_hover` text comment '激活样式链接库(控制器名称)',
	`insert_time`   int(10) comment '导航创建时间',
	`update_time`   int(10) comment '导航更新时间',
	`order`         int unsigned comment '排序',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`     tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '前台网站导航栏表';

#----------pre_navigation_wap--------------------------------------------------------
/*
 * @doc WAP版面网站导航表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_navigation_wap`;
create table `pre_navigation_wap` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`parent_id`     int unsigned default 0 comment '父导航ID',
	`name`          varchar(15) not null comment '导航栏名称',
	`a_href`        varchar(255) comment '导航链接',
	`a_title`       varchar(255) comment '链接title',
	`a_target`      tinyint unsigned comment '导航链接打开方式',
	`img_src`       varchar(255) comment '导航链接图标地址',
	`img_src_hover` varchar(255) comment '导航链接图标激活样式地址',
	`href_in_hover` text comment '激活样式链接库(控制器名称)',
	`insert_time`   int(10) comment '导航创建时间',
	`update_time`   int(10) comment '导航更新时间',
	`order`         int unsigned comment '排序',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`     tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment 'WAP版面网站导航表';

#----------首页幻灯设置表------------------------------------------------------
/* @doc 幻灯信息表
 * @author 方刚
 * @time 2014.06.19
*/
drop table if exists `pre_slide`;
create table `pre_slide` (
	`id`          int unsigned auto_increment comment '编号',
	`name`        varchar(255) comment '幻灯名称',
	`img_src`     varchar(255) comment '幻灯文件地址，设计可以存储网络文件地址',
	`a_href`      varchar(255) comment '幻灯链接地址',
	`a_target`    tinyint unsigned default 1 comment '是否新窗口，0-不是，1-是',
	`title`       varchar(255) comment '显示标题',
	`description` varchar(255) comment '幻灯备注信息',
	`order`       int unsigned comment '排序',
	`insert_time` int(10) comment '幻灯创建时间',
	`update_time` int(10) comment '幻灯最后修改时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '首页幻灯设置表';

#----------首页幻灯设置表(WAP端)------------------------------------------------------
/* @doc 幻灯信息表
 * @author 方刚
 * @time 2014.06.19
*/
drop table if exists `pre_slide_wap`;
create table `pre_slide_wap` (
	`id`          int unsigned auto_increment comment '编号',
	`name`        varchar(255) comment '幻灯名称',
	`img_src`     varchar(255) comment '幻灯文件地址，设计可以存储网络文件地址',
	`a_href`      varchar(255) comment '幻灯链接地址',
	`a_target`    tinyint unsigned default 1 comment '是否新窗口，0-不是，1-是',
	`title`       varchar(255) comment '显示标题',
	`description` varchar(255) comment '幻灯备注信息',
	`order`       int unsigned comment '排序',
	`insert_time` int(10) comment '幻灯创建时间',
	`update_time` int(10) comment '幻灯最后修改时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '首页幻灯设置表(WAP端)';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_article_category表--------------------------------------------------------
/* 
 * @doc 文章分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_category`;
create table `pre_article_category` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`parent_id`       int unsigned comment '父分类ID',
	`name`            varchar(63) not null comment '分类名称',
	`code`            varchar(63) comment 'code',
	`template_id`     int unsigned comment '分类模版ID',
	`a_href`          varchar(255) comment '分类链接',
	`a_title`         varchar(255) comment '分类链接标题',
	`img_src`         varchar(255) comment '分类图标',
	`seo_keywords`    varchar(511) comment 'SEO关键词',
	`seo_description` text comment 'SEO描述',
	`description`     text comment '分类介绍',
	`user_role_id`    smallint unsigned comment '分类阅读用户角色权限',
	`user_rank`       int unsigned comment '分类阅读用户积分',
	`pwd`             varchar(64) comment '分类阅读密码',
	`order`           int unsigned comment '排序',
	`insert_time`     int(10) comment '创建时间',
	`update_time`     int(10) comment '更新时间',
	`is_enable`       tinyint unsigned default 1 comment '是否有效',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除' comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章分类表';

#----------pre_article表--------------------------------------------------------
/* 
 * @doc 文章内容表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article`;
create table `pre_article` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id`     int unsigned comment '文章分类ID',
	`title`           varchar(1023) not null comment '文章标题',
	`subtitle`        varchar(255) comment '文章副标题',
	`cover_img_src`   varchar(255) comment '文章封面图片',
	`user_id`         int unsigned comment '文章作者（用户）ID',
	`user_link`       varchar(255) comment '文章作者链接',
	`author`          varchar(127) comment '文章作者笔名',
	`editor`          varchar(127) comment '责任编辑',
	`origin_source`   varchar(255) comment '文章来源，为空表示原创',
	`content`         text comment '文章内容',
	`keywords`        varchar(255) comment '关键词',
	`tags`            varchar(255) comment '标签ID，形如1,2,3以逗号分开',
	`semantic_a_href` varchar(255) comment '语义化链接',
	`a_href`          varchar(255) comment '文章链接',
	`a_title`         varchar(255) comment '文章链接标题',
	`title_bg_color`  varchar(20) default '#FFF' comment '文章标题背景颜色',
	`content_bg_color`varchar(20) default '#FFF' comment '文章内容背景颜色',
	`template_id`     int unsigned comment '文章模版ID',
	`is_new`          tinyint unsigned default 1 comment '是否为新发布文章',
	`is_recommend`    tinyint unsigned default 0 comment '是否推荐',
	`is_top`          tinyint unsigned default 0 comment '是否置顶',
	`is_great`        tinyint unsigned default 0 comment '是否精品',
	`allow_comment`   tinyint unsigned default 1 comment '是否允许评论',
	`comment_num`     int unsigned default 0 comment '评论数',
	`comment_score`   smallint default 5 comment '文章评分，允许为负分',
	`read_num`        int unsigned default 1 comment '阅读次数',
	`click_count`     bigint unsigned default 1 comment '点击次数',
	`seo_title`       varchar(511) comment '文章SEO标题',
	`seo_keywords`    varchar(511) comment '文章SEO关键词',
	`seo_description` varchar(511) comment '文章SEO描述',
	`user_role_id`    smallint unsigned comment '文章阅读用户权限',
	`user_rank`       int unsigned comment '文章阅读用户积分',
	`pwd`             varchar(64) comment '阅读密码',
	`insert_time`     int(10) comment '文章创建时间',
	`update_time`     int(10) comment '文章更新时间',
	`order`           int comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`       tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章内容表';

#----------pre_article_comment表--------------------------------------------------------
/* 
 * @doc 文章评论表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_comment`;
create table `pre_article_comment`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`article_id`  int unsigned comment '被评论文章ID',
	`parent_id`   int unsigned comment '父评论，“盖楼”形式',
	`user_id`     int unsigned comment '评论人用户ID',
	`user_name`   varchar(255) comment '评论人名称，若未注册用户评论，可以使用此字段作为临时用户名',
	`email`       varchar(255) comment '评论人Email',
	`web_link`    varchar(255) comment '评论人网站地址',
	`title`       varchar(1023) comment '评论标题',
	`content`     text comment '评论内容',
	`score`       smallint comment '评分',
	`ip`          varchar(40) comment '评论人IP，兼容IPv6',
	`ips`         varchar(40) comment '评论人IP对应地理位置',
	`is_hot`      tinyint unsigned default 0 comment '是否热门',
	`is_top`      tinyint unsigned default 0 comment '是否置顶',
	`insert_time` int(10) comment '评论时间',
	`update_time` int(10) comment '评论更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章评论表';

#----------pre_article_praise表--------------------------------------------------------
/*
 * @doc 文章点赞表
 * @author Heanes
 * @time 2015-06-24 09:48:28
*/
drop table if exists `pre_article_praise`;
create table `pre_article_praise`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`article_id`  int unsigned comment '被点赞文章ID',
	`user_id`     int unsigned comment '用户ID',
	`insert_time` int(10) comment '点赞时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`   tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章点赞表';

#----------pre_article_favourite表--------------------------------------------------------
/*
 * @doc 文章点赞表
 * @author Heanes
 * @time 2015-06-24 09:48:28
*/
drop table if exists `pre_article_favourite`;
create table `pre_article_favourite`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`article_id`  int unsigned comment '文章ID',
	`user_id`     int unsigned comment '用户ID',
	`insert_time` int(10) comment '收藏时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`   tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章收藏表';

#----------pre_article_comment_judge--------------------------------------------------------
/*
 * @doc 文章评论意见表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_comment_judge`;
create table `pre_article_comment_judge`(
	`id`                 int unsigned auto_increment comment '自增ID，主键',
	`article_comment_id` int unsigned comment '文章评论ID',
	`user_id`            int unsigned comment '用户ID',
	`user_ip`            varchar(40) comment '评论人IP，兼容IPv6',
	`type`               smallint comment '操作类型，1-支持，-1反对，2-举报',
	`reason`             varchar(1023) comment '操作原因',
	`order`              int unsigned comment '排序',
	`insert_time`        int(10) comment '操作时间',
	`update_time`        int(10) comment '更新时间',
	`is_enable`          tinyint unsigned default 1 comment '是否有效',
	`is_delete`          tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章评论意见表(支持，反对，举报)';

#----------pre_article_album--------------------------------------------------------
/*
 * @doc 文章相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_album`;
create table `pre_article_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`object_id`   int unsigned comment '对象ID，指外键',
	`name`        varchar(255) comment '图片显示名称',
	`file_name`   varchar(255) comment '图片实际存储名称',
	`a_href`      varchar(255) comment '链接地址',
	`order`       int comment '排序',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章相册表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_template_category表--------------------------------------------------------
/* 
 * @doc 模版库分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_template_category`;
create table `pre_template_category` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`parent_id`   int unsigned default 0 comment '父分类ID',
	`name`        varchar(63) comment '分类名称',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '分类创建时间',
	`update_time` int(10) comment '分类最后更新时间',
	`order`       int unsigned comment '分类排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '模版库分类表';
#----------pre_template_library表--------------------------------------------------------
/* 
 * @doc 模版库表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_template_library`;
create table `pre_template_library` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`cateogry_id`    int unsigned comment '模版分类',
	`name`           varchar(63) comment '分类名称',
	`path`           varchar(255) comment '模版路径',
	`file_name`      varchar(127) comment '模版名称',
	`screenshot_src` varchar(255) comment '模版截图图片路径',
	`description`    text comment '备注介绍',
	`insert_time`    int(10) comment '插入时间',
	`update_time`    int(10) comment '更新时间',
	`order`          int unsigned comment '排序',
	`is_enable`      tinyint unsigned default 1 comment '是否启用',
	`is_delete`      tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '模版库表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_friend_link_category表--------------------------------------------------------
/* 
 * @doc 友情链接分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_friend_link_category`;
create table `pre_friend_link_category` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`parent_id`   int unsigned comment '父分类ID',
	`name`        varchar(255) comment '分组名称',
	`img_src`     varchar(255) comment '分类图标地址',
	`img_title`   varchar(255) comment '分类图片title值',
	`a_href`      varchar(255) comment '分类外链',
	`a_title`     varchar(255) comment '分类外链title值',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '分类添加时间',
	`update_time` int(10) comment '分类最后更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint unsigned default 1
	comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '友情链接分类表';

#----------pre_friend_link表--------------------------------------------------------
/* 
 * @doc 友情链接表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_friend_link`;
create table `pre_friend_link` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '链接名称',
	`email`       varchar(255) comment '友情链接Email',
	`a_href`      varchar(511) comment '链接地址',
	`a_title`     varchar(511) comment '链接title值',
	`a_target`    tinyint comment '链接打开方式',
	`img_src`     varchar(255) comment '链接图标地址',
	`img_title`   varchar(255) comment '链接图标title值',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '链接添加时间',
	`update_time` int(10) comment '链接更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '友情链接表';

#----------pre_friend_link_apply表--------------------------------------------------------
/* 
 * @doc  友情链接申请表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_friend_link_apply`;
create table `pre_friend_link_apply` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '链接名称',
	`email`       varchar(255) comment '链接Email',
	`a_href`      varchar(511) comment '链接地址',
	`img_src`     varchar(255) comment '链接图片地址',
	`ip`          varchar(255) comment '链接申请人IP',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '链接添加时间',
	`update_time` int(10) comment '链接更新时间',
	`status`      tinyint unsigned default 0 comment '申请状态',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '友情链接申请表';

#----------pre_friend_link_apply_act_log表--------------------------------------------------------
/* 
 * @doc  友情链接申请操作记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_friend_link_apply_act_log`;
create table `pre_friend_link_apply_act_log` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`link_apply_id`          varchar(255) comment '链接申请ID',
	`act_user_id`   int unsigned comment '链接操作用户ID',
	`act_comment`   varchar(1023) comment '链接处理备注信息',
	`act_time`      int(10) comment '链接处理时间',
	`act_status`    tinyint unsigned default 0 comment '链接申请状态处理结果',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '友情链接申请操作记录表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_contact表--------------------------------------------------------
/* 
 * @doc 联系方式表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_contact`;
create table `pre_contact` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`type`        smallint comment '联系方式类型',
	`name`        varchar(255) comment '联系方式名称',
	`value`       varchar(255) comment '联系方式途径（值）',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否有效',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '联系方式表';

/*
 * @doc 留言建议
 * @author Heanes
 * @time 2015-08-07 17:16:44
*/
drop table if exists `pre_msg_board`;
create table `pre_msg_board` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`sender_user_id`  int unsigned comment '发送人用户ID',
	`title`           varchar(1023) comment '私信标题',
	`content`         text comment '私信内容',
	`send_time`       int(10) comment '发送时间',
	`is_read`         tinyint comment '是否已读',
	`read_time`       int(10) comment '阅读时间',
	`delete_time`     int(10) comment '删除时间',
	`is_recycle`      tinyint comment '是否放入回收站',
	`recycle_time`    int(10) comment '回收时间',
	`is_time_limit`   tinyint comment '是否具有有效期',
	`limit_time_end`  int(10) comment '失效时间',
	`is_top`          tinyint(10) comment '是否置顶',
	`top_time_start`  int(10) comment '置顶开始时间',
	`top_time_end`    int(10) comment '置顶结束时间',
	`sender_ip`       varchar(63) comment '发送人ip',
	`order`           int unsigned comment '排序',
	`insert_time`     int(10) comment '创建时间',
	`update_time`     int(10) comment '更新时间',
	`is_enable`       tinyint unsigned default 1 comment '是否有效',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站留言咨询及投诉建议';
use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_web_visitor表--------------------------------------------------------
/* 
 * @doc 网站访问统计表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_web_visitor`;
create table `pre_web_visitor` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`access_url`  varchar(255) comment '访客访问页面',
	`refer_url`   varchar(255) comment '来源页面',
	`ip`          varchar(64) comment '访客IP',
	`borwser`     varchar(255) comment '访客浏览器信息',
	`os`          varchar(255) comment '访客操作系统信息',
	`language`    varchar(63) comment '访客地域语言',
	`country`     varchar(63) comment '访客所在国家',
	`province`    varchar(63) comment '访客所在省',
	`city`        varchar(63) comment '访客所在市',
	`come_time`   int(10) comment '访问时间',
	`leave_time`  int(10) comment '访客离开时间',
	`visit_times` int unsigned comment '访问次数',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站访问统计表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_users表--------------------------------------------------------
/* 
 * @doc 会员信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_users`;
create table `pre_users` (
	`id`                 int unsigned auto_increment comment '自增ID，主键',
	`user_name`          varchar(255) not null unique comment '用户名',
	`user_pwd`           varchar(64)  not null comment '用户密码',
	`user_email`         varchar(255) comment '用户Email',
	`mobile`             varchar(63) comment '用户手机号',
	`telephone`          varchar(63) comment '用户固定电话',
	`age`                smallint unsigned comment '用户年龄',
	`gender`             tinyint comment '用户性别',
	`idcard`             varchar(50) comment '用户身份证号',
	`real_name`          varchar(255) comment '用户真实姓名',
	`reg_time`           int(10) comment '用户注册时间',
	`update_time`        int(10) comment '用户资料更新时间',
	`reg_ip`             varchar(255) comment '用户注册IP',
	`current_login_ip`   varchar(255) comment '用户当前登陆IP',
	`last_login_ip`      varchar(255) comment '用户最后登陆IP',
	`current_login_time` int(10) comment '用户当前登陆时间',
	`last_login_time`    int(10) comment '用户最后登陆时间',
	`login_times`        int unsigned default 1 comment '用户登录次数',
	`visit_times`        int unsigned default 0 comment '用户资料被查看次数',
	`role_id`            int unsigned comment '用户角色ID',
	`allow_login`        tinyint default 1 comment '是否允许登陆',
	`user_status`        varchar(63) comment '用户状态',
	`audit_status`       tinyint default 0 comment '注册审核状态',
	`avatar_src`         varchar(255) comment '用户头像图片路径',
	`nickname`           varchar(255) comment '用户昵称',
	`signature`          varchar(1023) comment '个性签名',
	`birthday_year`      varchar(255) comment '用户生日（年）',
	`birthday_month`     varchar(255) comment '用户生日（月）',
	`birthday_day`       varchar(255) comment '用户生日（日）',
	`country`            varchar(255) comment '国籍',
	`province`           varchar(255) comment '省',
	`city`               varchar(255) comment '城市',
	`region`             varchar(255) comment '区/县',
	`town`               varchar(255) comment '镇',
	`address`            varchar(255) comment '更细的自定义输入地址',
	`has_married`        tinyint comment '婚姻状况，空为未知，0为未婚，1为没有',
	`qq`                 varchar(255) comment '用户QQ号',
	`sina_weibo`         varchar(255) comment '用户新浪微博号',
	`webchat`            varchar(255) comment '用户微信',
	`user_edu`           varchar(255) comment '用户教育水平',
	`user_job`           varchar(255) comment '职位',
	`monthly_income`     smallint unsigned comment '月收入',
	`has_house`          tinyint unsigned comment '是否购房',
	`has_car`            tinyint unsigned comment '是否有车',
	`drivers_license`    varchar(255) comment '驾驶证图片地址',
	`has_company`        varchar(255) comment '名下是否有公司',
	`user_question`      varchar(255) comment '用户安全问题',
	`user_ansewer`       varchar(255) comment '用户安全问题答案',
	`is_enable`          tinyint default 1 comment '是否有效',
	`is_delete`          tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 10001
default charset = `utf8`
comment '会员信息表';

#----------pre_user_fields--------------------------------------------------------c
/* 
 * @doc 用户额外属性字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_fields`;
create table `pre_user_fields` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '注册项名称',
	`input_type`  varchar(255) comment '注册项输入类型',
	`input_value` text comment '输入备选值',
	`value_unit`  varchar(255) comment '值的单位',
	`accept_type` varchar(255) comment '允许上传的文件类型',
	`order`       int comment '排序',
	`add_show`    tinyint unsigned comment '注册时是否显示此项',
	`is_required` tinyint unsigned comment '是否必须的',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段表';

#----------pre_user_fields_data--------------------------------------------------------
/* 
 * @doc 用户额外注册项数据映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_fields_data`;
create table `pre_user_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '注册项ID',
	`user_id`      int unsigned comment '用户ID',
	`fields_value` varchar(255) comment '注册项值',
	`insert_time`  int(10) comment '插入时间',
	`update_time`  int(10) comment '更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段数据映射表';

#----------pre_user_login_log表--------------------------------------------------------
/*
 * @doc 用户登录记录表
 * @author Heanes
 * @time 2015-07-05 01:02:09
*/
drop table if exists `pre_user_login_log`;
create table `pre_user_login_log` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`user_id`     int unsigned comment '用户ID',
	`login_ip`    varchar(255) comment '用户登陆IP',
	`login_time`  int(10) comment '用户登陆时间',
	`ips`         text comment 'IP所在地理位置',
	`region_id`   int unsigned comment '地理位置表中，位置ID',
	`insert_time` int(10) comment '添加时间',
	`is_delete`   tinyint unsigned comment '是否删除',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment '用户登录记录表';

#----------pre_privilege_url--------------------------------------------------------
/*
 * @doc 功能权限存储库表
 * @author Heanes
 * @time 2015-07-13 12:47:10
*/
drop table if exists `pre_privilege_url`;
create table `pre_privilege_url` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '权限名称',
	`class`       varchar(255) comment '控制器类名',
	`method`      varchar(255) comment '方法名',
	`description` text comment '权限描述',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint default 1 comment '是否启用',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户权限表';

#----------pre_user_privilege--------------------------------------------------------
/*
 * @doc 用户权限表
 * @author Heanes
 * @time 2015-07-13 12:47:10
*/
drop table if exists `pre_user_privilege`;
create table `pre_user_privilege` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`privilege_id` int unsigned comment '权限ID',
	`role_id`      int unsigned comment '角色ID',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`is_enable`    tinyint default 1 comment '是否启用',
	`is_delete`    tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户权限表';

#----------pre_user_role表--------------------------------------------------------
/*
 * @doc 用户角色表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_role`;
create table `pre_user_role` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '角色名称',
	`description` text comment '备注介绍',
	`level`       int comment '角色级别排序',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`order`       int comment '排序',
	`is_enable`   tinyint default 1 comment '是否启用',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户角色表';

#----------pre_user_group表--------------------------------------------------------
/* 
 * @doc 用户组表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_group`;
create table `pre_user_group` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`group_name`  varchar(255) comment '分组名称',
	`group_level` int comment '分组级别',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`order`       int comment '排序',
	`is_enable`   tinyint default 1 comment '是否启用',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户组表';

use `heanes.com`;
set foreign_key_checks = 0;
#---------pre_user_rank_type表--------------------------------------------------------
/* 
 * @doc 用户积分类型设置表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_rank_type`;
create table `pre_user_rank_type` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`code`        varchar(255) comment '积分Code',
	`name`        varchar(63) comment '积分名称',
	`unit`        varchar(63) comment '积分单位',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户积分类型设置表';

#----------pre_user_rank表--------------------------------------------------------
/* 
 * @doc 用户积分表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_rank`;
create table `pre_user_rank` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_id`      int unsigned comment '用户ID',
	`type_id`      int unsigned comment '积分类型ID',
	`value`        int unsigned comment '积分个数',
	`insert_time`  int(10) comment '日志插入时间',
	`update_time`  int(10) comment '日志更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户积分表';

#----------pre_user_rank_log表--------------------------------------------------------
/* 
 * @doc 积分变更记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_rank_log`;
create table `pre_user_rank_log` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_rank_id` int unsigned comment '用户ID',
	`chang_sign`   tinyint comment '积分变更标识，1-增加，-1-减少',
	`value`        int comment '积分变更值',
	`change_thing` varchar(255) comment '积分变更事件描述',
	`insert_time`  int(10) comment '日志插入时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '积分变更记录表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user_relationship表--------------------------------------------------------
/* 
 * @doc 用户关系映射表，与pre_user_relationship_group表相关
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_relationship`;
create table `pre_user_relationship` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`uid_master`  int unsigned comment '关系主用户ID ',
	`uid_slave`   int unsigned comment '关系从用户ID ',
	`group_id`    int unsigned comment '所属关系分组 ',
	`insert_time` int(10) comment '关系添加时间 ',
	`update_time` int(10) comment '关系更新时间 ',
	`type`        varchar(255) comment '关系类型 ',
	`value`       tinyint comment '关系值',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户关系映射表，与pre_user_relationship_group表相关';

#----------pre_user_relationship_group表--------------------------------------------------------
/* 
 * @doc 用户关系分组表，存储所有用户设置的分组名称
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_relationship_group`;
create table `pre_user_relationship_group` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`parent_id`   int unsigned comment '父分类ID',
	`user_id`     int unsigned comment '用户ID',
	`name`        varchar(255) comment '分类名称',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户关系分组表，存储所有用户设置的分组名称';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user_visitor表--------------------------------------------------------
/* 
 * @doc 访客关系表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_visitor`;
create table `pre_user_visitor` (
	`id`               int unsigned auto_increment comment '自增ID，主键',
	`master_user_id`   int unsigned comment '主用户ID',
	`slave_user_id`    int unsigned comment '客人用户ID',
	`type`             varchar(255) comment '访问类型',
	`visit_time`       int(10) comment '访问时间',
	`visit_hide`       tinyint unsigned comment '隐身访问',
	`is_delete`        tinyint unsigned comment '标记删除',
	`visitor_ip`       varchar(64) comment '访客IP',
	`visitor_country`  varchar(63) comment '访客国家',
	`visitor_province` varchar(63) comment '访客省',
	`visitor_cityp`    varchar(63) comment '访客市区',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '访客关系表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user_message表--------------------------------------------------------
/* 
 * @doc 会员私信表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_message`;
create table `pre_user_message` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`recvier_user_id` int unsigned comment '接收人用户ID',
	`sender_user_id`  int unsigned comment '发送人用户ID',
	`title`           varchar(1023) comment '私信标题',
	`content`         text comment '私信内容',
	`send_time`       int(10) comment '发送时间',
	`is_read`         tinyint comment '是否已读',
	`read_time`       int(10) comment '阅读时间',
	`delete_time`     int(10) comment '删除时间',
	`is_recycle`      tinyint comment '是否放入回收站',
	`recycle_time`    int(10) comment '回收时间',
	`is_emergency`    tinyint comment '是否紧急',
	`is_timing_auto`  tinyint comment '是否定时发送',
	`auto_send_time`  int(10) comment '定时发送时间',
	`is_time_limit`   tinyint comment '是否具有有效期',
	`limit_time_end`  int(10) comment '失效时间',
	`is_top`          tinyint(10) comment '是否置顶',
	`top_time_start`  int(10) comment '置顶开始时间',
	`top_time_end`    int(10) comment '置顶结束时间',
	`order`           int unsigned comment '排序',
	`insert_time`     int(10) comment '创建时间',
	`update_time`     int(10) comment '更新时间',
	`is_enable`       tinyint unsigned default 1 comment '是否有效',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '会员私信表';


#----------pre_message_log表--------------------------------------------------------
/* 
 * @doc 消息操作日志表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_message_log`;
create table `pre_message_log` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`message_id`     int unsigned comment '被操作消息ID',
	`act_user_id`    int unsigned comment '用户ID',
	`act_type`       varchar(10) comment '操作类型',
	`actor_ip`       varchar(64) comment '操作者IP',
	`actor_browser`  varchar(63) comment '操作者浏览器',
	`actor_os`       varchar(63) comment '操作者操作系统',
	`actor_language` varchar(63) comment '操作者浏览器语言',
	`actor_country`  varchar(63) comment '操作者国家',
	`actor_province` varchar(63) comment '操作者省',
	`actor_city`     varchar(63) comment '操作者市',
	`act_time`       int(10) comment '操作时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '消息操作日志表';use `heanes.com`;
set foreign_key_checks = 0;
#---------pre_user_asset表--------------------------------------------------------
/* 
 * @doc 其他用户资产表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_asset`;
create table `pre_user_asset` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_id`      int unsigned comment '用户ID',
	`money_total`  decimal(10, 2) comment '总用户余额',
	`money_borrow` decimal(10, 2) comment '借款数额',
	`money_invest` decimal(10, 2) comment '投资数额',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户资产表';

#---------pre_user_bank表--------------------------------------------------------
/*
 * @doc 用户银行卡存储表
 * @author Heanes
 * @time 2015-07-03 12:46:49
*/
drop table if exists `pre_user_bank`;
create table `pre_user_bank` (
	`id`                   int unsigned auto_increment comment '自增ID，主键',
	`user_id`              int unsigned comment '用户ID',
	`real_name`            varchar(32) comment '真实姓名',
	`bank_id`              int unsigned comment '银行卡类型',
	`bank_no`              varchar(255) comment '银行卡号',
	`account_bank_address` varchar(255) comment '开户行地点',
	`front_pic_src`        varchar(255) comment '正面照片保存地址',
	`insert_time`          int(10) comment '上传时间',
	`update_time`          int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户银行卡存储表';

#---------pre_user_bank表--------------------------------------------------------
/*
 * @doc 银行卡库存储表
 * @author Heanes
 * @time 2015-07-03 12:46:49
*/
drop table if exists `pre_bank`;
create table `pre_bank` (
	`id`          int unsigned auto_increment comment '编号',
	`name`        varchar(255) comment '银行名称',
	`code`        varchar(63) comment '银行代码',
	`img_url`     varchar(255) comment '银行logo图标地址',
	`a_href`      varchar(100) comment '银行链接地址',
	`description` text comment '银行描述信息',
	`order`       int comment '排序',
	`insert_time` int(10) comment '上传时间',
	`update_time` int(10) comment '更新时间',
	`is_commend`  tinyint comment '是否推荐',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '银行卡分类存储表';

#---------pre_user_property--------------------------------------------------------
/*
 * @doc 用户财产存储表
 * @author Heanes
 * @time 2015-07-03 12:46:49
*/
drop table if exists `pre_user_property`;
create table `pre_user_property` (
	`id`          int unsigned auto_increment comment '编号',
	`user_id`     int unsigned comment '用户ID',
	`property_id` int unsigned comment '资产类型ID',
	`order`       int comment '排序',
	`insert_time` int(10) comment '上传时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户资产数据存储表';

#----------pre_user_property_fields_data--------------------------------------------------------
/*
 * @doc 用户额外注册项数据映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_property_fields_data`;
create table `pre_user_property_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_id`      int unsigned comment '用户ID',
	`fields_id`    int unsigned comment '字段ID',
	`fields_value` varchar(255) comment '字段值',
	`insert_time`  int(10) comment '插入时间',
	`update_time`  int(10) comment '更新时间',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment '用户资产额外属性字段数据映射表';

#---------pre_property--------------------------------------------------------
/*
 * @doc 财产类型库存储表
 * @author Heanes
 * @time 2015-07-03 12:46:49
*/
drop table if exists `pre_property`;
create table `pre_property` (
	`id`          int unsigned auto_increment comment '编号',
	`name`        varchar(255) comment '资产类型名称',
	`order`       int comment '排序',
	`add_show`    tinyint unsigned comment '注册/添加时是否显示此项',
	`is_required` tinyint unsigned comment '是否必须的',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '财产类型库存储表';

#---------pre_property--------------------------------------------------------
/*
 * @doc 财产类型属性存储表
 * @author Heanes
 * @time 2015-07-03 12:46:49
*/
drop table if exists `pre_property_fields`;
create table `pre_property_fields` (
	`id`          int unsigned auto_increment comment '编号',
	`property_id` int unsigned comment '资产类型ID',
	`name`        varchar(255) comment '资产类型名称',
	`input_type`  varchar(255) comment '输入方式',
	`input_value` text comment '输入备选值',
	`value_unit`  varchar(255) comment '值的单位',
	`accept_type` varchar(255) comment '允许上传的文件类型',
	`add_show`    tinyint unsigned comment '注册/添加时是否显示此项',
	`is_required` tinyint unsigned comment '是否必须的',
	`order`       int comment '排序',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '财产类型属性存储表';
use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_user_certification-----------------------------------------------------
/* @doc 用户认证方式信息表
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_user_certification`;
create table `pre_user_certification` (
	`id`          int unsigned auto_increment comment '编号',
	`user_id`     int unsigned comment '外键用户ID',
	`type_id`     varchar(20) comment '外键认证方式ID',
	`message`     text comment '申请审核留言',
	`insert_time` int(10) unsigned comment '申请认证时间',
	`update_time` int(10) unsigned comment '更新时间',
	`status`      tinyint comment '认证状态 0-审核中 1-已通过验证 -1-未通过验证',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment '用户认证信息表';

#----------pre_user_certification_check_log-----------------------------------------------------
/* @doc 用户认证信息审核操作
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_user_certification_check_log`;
create table `pre_user_certification_check_log` (
	`id`            int unsigned auto_increment comment '编号',
	`user_certification_id` int unsigned comment '外键认证ID',
	`actor_user_id` int unsigned comment '操作人ID',
	`reason`        text comment '处理原因',
	`description`   text comment '操作留下的备注信息,留给系统查看',
	`insert_time`   int(10) unsigned comment '处理时间',
	`status`        tinyint comment '处理结果 0-审核中 1-已通过验证 -1-未通过验证',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment '用户认证信息审核操作表';

#----------pre_certification_type-----------------------------------------------------
/* @doc 认证方式类别表
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_certification_type`;
create table `pre_certification_type` (
	`id`          int unsigned auto_increment comment '编号',
	`name`        varchar(255) comment '认证方式名称，如“身份证认证”、“手机认证”、“邮箱认证”、“实地认证”’',
	`code`        varchar(100) comment '认证方式code',
	`img_src`     varchar(255) comment '认证方式对应显示的图片',
	`img_alt`     varchar(255) comment '认证方式对应显示的图片alt属性',
	`description` varchar(255) comment '认证方式备注信息',
	`requirement` text comment '必要条件介绍',
	`tips`        varchar(1023) comment '上传时小提示',
	`point`       int comment '认证通过加分值',
	`add_show`    tinyint unsigned comment '注册/添加时是否显示此项',
	`is_required` tinyint unsigned comment '是否必须的',
	`insert_time` int(10) unsigned comment '认证方式类型添加时间',
	`update_time` int(10) unsigned comment '认证方式类型修改时间',
	`order`       smallint unsigned comment '认证方式显示排序',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
	engine = innodb
	auto_increment = 1
	default charset = `utf8`
	comment '用户认证方式类别表';

#----------pre_certification_type_fields--------------------------------------------------------c
/*
 * @doc 用户额外属性字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_certification_type_fields`;
create table `pre_certification_type_fields` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '注册项名称',
	`type_id`     int unsigned comment '认证类型ID',
	`input_type`  varchar(255) comment '注册项输入类型',
	`input_value` text comment '输入备选值',
	`accept_type` varchar(255) comment '允许上传的文件类型',
	`value_unit`  varchar(255) comment '值的单位',
	`order`       int comment '排序',
	`add_show`    tinyint unsigned default 1 comment '注册/添加时是否显示此项',
	`is_required` tinyint unsigned default 0 comment '是否必须的',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段表';

#----------pre_user_certification_fields_data--------------------------------------------------------
/*
 * @doc 用户额外注册项数据映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_certification_fields_data`;
create table `pre_user_certification_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '注册项ID',
	`user_id`      int unsigned comment '用户ID',
	`fields_value` varchar(255) comment '注册项值',
	`insert_time`  int(10) comment '插入时间',
	`update_time`  int(10) comment '更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段数据映射表';
use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_department表--------------------------------------------------------
/* 
 * @doc 部门表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department`;
create table `pre_department` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`pid`            int comment '所属父部门',
	`name`           varchar(255) comment '部门名称',
	`english_name`   varchar(255) comment '英文名称',
	`short_name`     varchar(255) comment '部门名称缩写',
	`img_src`        varchar(255) comment '部门图片logo地址',
	`description`    text comment '部门介绍',
	`manager_job_id` int unsigned comment '部门管理职位ID，员工表中某员工的职位ID与此相同，则表明该员工为部门管理员',
	`order`          int comment '排序',
	`insert_time`    int(10) comment '添加时间',
	`update_time`    int(10) comment '更新时间',
	`is_enable`      tinyint default 1 comment '是否有效',
	`is_delete`      tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门表';

#----------pre_department_fields--------------------------------------------------------
/* 
 * @doc 部门额外数据字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department_fields`;
create table `pre_department_fields` (
	`id`                        int unsigned auto_increment comment '自增ID，主键',
	`type_id`                   int unsigned comment '类型ID，为0表示通用类型',
	`name`                      varchar(127) comment '属性名称',
	`input_type`                varchar(15) comment '属性输入类型',
	`input_value`               text comment '输入备选值',
	`value_unit`                varchar(255) comment '值的单位',
	`accept_type`               varchar(255) comment '允许上传的文件类型',
	`is_required`               tinyint unsigned default 0 comment '是否必须的',
	`allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
	`allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
	`as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
	`is_show`                   tinyint unsigned default 1 comment '是否显示',
	`order`                     int unsigned comment '排序',
	`insert_time`               int(10) comment '添加时间',
	`update_time`               int(10) comment '更新时间',
	`is_enable`                 tinyint unsigned default 1 comment '是否启用',
	`is_delete`                 tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门额外数据信息表';

#----------pre_department_fields_data--------------------------------------------------------
/*
 * @doc 部门额外数据表
 * @author Heanes
 * @time 2015-08-13 13:11:07
*/
drop table if exists `pre_department_fields_data`;
create table `pre_department_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '属性ID',
	`borrow_id`    int unsigned comment '类型ID，为0表示通用类型',
	`fields_value` varchar(255) comment '借款属性值',
	`fields_price` decimal(10, 2) comment '属性价格',
	`insert_time`  int(10) comment '属性添加时间',
	`update_time`  int(10) comment '属性更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门额外数据信息表';

#----------pre_department_manager表--------------------------------------------------------
/*
 * @doc 部门管理员表 @todo 不一定要用，因为有职位表，可以根据用户部门ID和职位ID得知部门管理员
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department_manager`;
create table `pre_department_manager` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`department_id` int unsigned comment '部门ID',
	`user_id`       int unsigned comment '用户ID',
	`insert_time`   int(10) comment '插入时间',
	`update_time`   int(10) comment '更新时间',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门管理员表';

#----------pre_employee表--------------------------------------------------------
/* 
 * @doc 员工表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_employee`;
create table `pre_employee` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`user_id`       int unsigned comment '用户ID',
	`department_id` int unsigned comment '部门ID',
	`job_id`        int unsigned comment '职位ID',
	`leader_eid`    int unsigned comment '上级领导员工ID',
	`recommend_eid` int unsigned comment '推荐人员工ID',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '更新时间',
	`apply_status`  tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '员工表';

#----------pre_employee_apply_status_log--------------------------------------------------------
/*
 * @doc 员工职位申请表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_employee_apply_status_log`;
create table `pre_employee_apply_status_log` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`employee_id`   int unsigned comment '用户ID',
	`actor_user_id` int unsigned comment '部门ID',
	`status`        tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
	`reason`        text comment '处理原因',
	`description`   text comment '操作留下的备注信息,留给系统查看',
	`insert_time`   int(10) comment '添加时间',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '员工职位申请状态操作记录表';

#----------pre_job表--------------------------------------------------------
/* 
 * @doc 职位表
 * @author Heanes
 * @time 2015-05-25 11:33:08
*/
drop table if exists `pre_job`;
create table `pre_job` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id` int unsigned comment '职位分类',
	`name`        varchar(255) comment '职位名称',
	`code`        varchar(255) comment '职位代码，一般即缩写',
	`description`     text comment '职位描述',
	`insert_time`     int(10) comment '添加时间',
	`update_time`     int(10) comment '更新时间',
	`order`           int comment '排序',
	`is_enable`       tinyint default 1 comment '是否有效',
	`is_delete`       tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '职位表';

#----------pre_job_category表--------------------------------------------------------
/* 
 * @doc 职位分类表
 * @author Heanes
 * @time 2015-05-25 11:33:08
*/
drop table if exists `pre_job_category`;
create table `pre_job_category` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`category_name` varchar(255) comment '分类名称',
	`category_code` varchar(255) comment '分类代码，一般即缩写',
	`description`   text comment '职位描述',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '更新时间',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '职位分类表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_goods表--------------------------------------------------------
/*
 * @doc 商品基本信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods`;
create table `pre_goods` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id`     int unsigned comment '商品分类ID',
	`type_id`         int unsigned comment '类型ID',
	`name`            varchar(255) comment '商品名称',
	`short_desc`      varchar(255) comment '商品短描述',
	`serial`          varchar(64) comment '商品序列号（平台）',
	`shop_price`      decimal(10, 2) comment '商品店铺价格',
	`cost_price`      decimal(10, 2) comment '商品成本价',
	`market_price`    decimal(10, 2) comment '商品市面价格',
	`store_num`       int unsigned comment '商品库存数目',
	`total_sold_num`  int unsigned comment '商品已卖出总个数',
	`cover_img_src`   varchar(255) comment '商品封面图片',
	`cover_img_title` varchar(255) comment '商品封面图片title值',
	`a_href`          varchar(255) comment '商品可链接至外链',
	`a_title`         varchar(255) comment '商品外链title值',
	`is_new`          tinyint unsigned default 1 comment '是否为新',
	`is_recommend`    tinyint unsigned default 0 comment '是否推荐',
	`is_top`          tinyint unsigned default 0 comment '是否置顶',
	`is_great`        tinyint unsigned default 0 comment '是否精品',
	`allow_comment`   tinyint unsigned default 1 comment '是否允许评论',
	`comment_num`     int unsigned default 0 comment '评论数',
	`comment_score`   smallint default 5 comment '平均评分值，允许为负分',
	`read_num`        int unsigned default 1 comment '阅读次数',
	`click_count`     bigint unsigned default 1 comment '点击次数',
	`seo_title`       varchar(511) comment 'SEO标题',
	`seo_keywords`    varchar(511) comment 'SEO关键词',
	`seo_description` varchar(511) comment 'SEO描述',
	`description`     text comment '商品描述详情',
	`user_role_id`    int unsigned comment '商品查看用户角色',
	`user_rank`       int unsigned comment '商品查看用户积分',
	`pwd`             varchar(64) comment '查看密码',
	`insert_time`     int(10) comment '商品添加时间',
	`update_time`     int(10) comment '商品更新时间',
	`order`           int unsigned comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`       tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品基本信息表';

#----------pre_goods_accessories--------------------------------------------------------
/*
 * @doc 商品配件基本信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_accessories`;
create table `pre_goods_accessories` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`goods_id`        int unsigned comment '商品ID',
	`name`            varchar(255) comment '配件名称',
	`insert_time`     int(10) comment '商品添加时间',
	`update_time`     int(10) comment '商品更新时间',
	`order`           int unsigned comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品配件基本信息表';

#----------pre_goods_category表--------------------------------------------------------
/*
 * @doc 商品分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_category`;
create table `pre_goods_category` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`parent_id`    int unsigned comment '父分类ID',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`a_href`       varchar(255) comment '分类链接',
	`a_title`      varchar(255) comment '分类链接title值',
	`img_src`      varchar(255) comment '分类图标地址',
	`img_title`    varchar(255) comment '分类图标title值',
	`user_role_id` smallint unsigned comment '分类访问用户组权限',
	`user_rank`    int unsigned comment '分类访问用户积分',
	`pwd`          varchar(64) comment '分类访问密码',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品分类表';

#----------pre_goods_type--------------------------------------------------------
/*
 * @doc 商品类型表，将商品属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_type`;
create table `pre_goods_type` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品类型表，将商品属性归为一类';


#----------pre_goods_fields表--------------------------------------------------------
/*
 * @doc 商品属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_fields`;
create table `pre_goods_fields` (
	`id`                        int unsigned auto_increment comment '自增ID，主键',
	`type_id`                   int unsigned comment '类型ID，为0表示通用类型',
	`name`                      varchar(127) comment '属性名称',
	`input_type`                varchar(15) comment '属性输入类型',
	`input_value`               text comment '输入备选值',
	`accept_type`               varchar(255) comment '允许上传的文件类型',
	`value_unit`                varchar(255) comment '值的单位',
	`is_required`               tinyint unsigned default 0 comment '是否必须的',
	`allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
	`allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
	`as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
	`is_show`                   tinyint unsigned default 1 comment '是否显示',
	`order`                     int unsigned comment '排序',
	`is_enable`                 tinyint unsigned default 1 comment '是否启用',
	`is_delete`                 tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品属性名称字段表';

#----------pre_goods_fields_data--------------------------------------------------------
/*
 * @doc 商品属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_fields_data`;
create table `pre_goods_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '属性ID',
	`goods_id`     int unsigned comment '商品ID',
	`fields_value` varchar(255) comment '商品属性值',
	`fields_price` decimal(10, 2) comment '属性价格',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品属性映射表';

#----------pre_goods_album表--------------------------------------------------------
/*
 * @doc商品相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_goods_album`;
create table `pre_goods_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`object_id`   int unsigned comment '对象ID，指外键',
	`name`        varchar(255) comment '图片显示名称',
	`file_name`   varchar(255) comment '图片实际存储名称',
	`a_href`      varchar(255) comment '链接地址',
	`order`       int comment '排序',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '商品相册表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_borrow--------------------------------------------------------
/*
 * @doc 借款记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow`;
create table `pre_borrow` (
	`id`                   int unsigned auto_increment comment '自增ID，主键',
	`uid_master`           int unsigned comment '业务主ID',
	`uid_slave`            int unsigned comment '业务客ID',
	`usage_id`             int unsigned comment '贷款用途（标识ID），从借款用途表中取得',
	`usage_info`           text comment '借款用途备注',
	`total`                float comment '贷款额度',
	`year_limit`           varchar(255) comment '贷款年限，带单位，1d-天，2m-2个月，3y-3年',
	`rate`                 float comment '利息',
	`get_money_limit_time` int(10) comment '贷款成功截止期限',
	`get_money_time`       int(10) comment '放款时间',
	`repay_money_time`     int(10) comment '还款时间',
	`has_colleague`        tinyint comment '是否有同行',
	`apply_time`           int(10) comment '贷款申请时间（发布时间）',
	`apply_status`         tinyint comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
	`apply_update_time`    int(10) comment '贷款申请最后更新时间',
	`progress_status`      smallint comment '进行状态，1-下户，2-评级，3-做卷，3-资料审核，4-批贷函，5-贷后管理（开始放款）',
	`progress_update_time` int(10) comment '最后更新时间',
	`order`                int comment '排序',
	`insert_time`          int(10) comment '插入时间',
	`update_time`          int(10) comment '更新时间',
	`is_enable`            tinyint default 1 comment '是否有效',
	`is_delete`            tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款申请表';

#----------pre_borrow_apply_status_log--------------------------------------------------------
/*
 * @doc 借款申请记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_apply_status_log`;
create table `pre_borrow_apply_status_log` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`jk_id`         int unsigned comment '业务主ID',
	`actor_user_id` int unsigned comment '操作人ID',
	`reason`        text comment '处理原因',
	`description`   text comment '操作留下的备注信息,留给系统查看',
	`status`        tinyint comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
	`insert_time`   int(10) comment '插入时间',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款申请记录表';

#----------pre_borrow_progress--------------------------------------------------------
/*
 * @doc 借款记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_progress`;
create table `pre_borrow_progress` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`jk_id`         int unsigned comment '业务主ID',
	`actor_user_id` int unsigned comment '操作人ID',
	`reason`        text comment '处理原因',
	`description`   text comment '操作留下的备注信息,留给系统查看',
	`insert_time`   int(10) comment '进度插入时间',
	`status`        smallint comment '贷款进行状态，1-下户，2-评级，3-做卷，4-资料审核，5-批贷函，6-贷后管理（开始放款）',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款进度表';

#----------pre_borrow_category表--------------------------------------------------------
/*
 * @doc 借款分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_category`;
create table `pre_borrow_category` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`parent_id`    int unsigned comment '父分类ID',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`a_href`       varchar(255) comment '分类链接',
	`a_title`      varchar(255) comment '分类链接title值',
	`img_src`      varchar(255) comment '分类图标地址',
	`img_title`    varchar(255) comment '分类图标title值',
	`user_role_id` smallint unsigned comment '分类访问用户组权限',
	`user_rank`    int unsigned comment '分类访问用户积分',
	`pwd`          varchar(64) comment '分类访问密码',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款分类表';

#----------pre_borrow_type--------------------------------------------------------
/*
 * @doc 借款类型表，将借款属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_type`;
create table `pre_borrow_type` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款类型表，将借款属性归为一类';

#----------pre_borrow_fields表--------------------------------------------------------
/*
 * @doc 借款属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_fields`;
create table `pre_borrow_fields` (
	`id`                        int unsigned auto_increment comment '自增ID，主键',
	`type_id`                   int unsigned comment '类型ID，为0表示通用类型',
	`name`                      varchar(127) comment '属性名称',
	`input_type`                varchar(15) comment '属性输入类型',
	`input_value`               text comment '输入备选值',
	`value_unit`                varchar(255) comment '值的单位',
	`accept_type`               varchar(255) comment '允许上传的文件类型',
	`is_required`               tinyint unsigned default 0 comment '是否必须的',
	`allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
	`allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
	`as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
	`is_show`                   tinyint unsigned default 1 comment '是否显示',
	`order`                     int unsigned comment '排序',
	`insert_time`               int(10) comment '添加时间',
	`update_time`               int(10) comment '更新时间',
	`is_enable`                 tinyint unsigned default 1 comment '是否启用',
	`is_delete`                 tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款属性名称字段表';

#----------pre_borrow_fields_data--------------------------------------------------------
/*
 * @doc 借款属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_fields_data`;
create table `pre_borrow_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '属性ID',
	`borrow_id`    int unsigned comment '类型ID，为0表示通用类型',
	`fields_value` varchar(255) comment '借款属性值',
	`fields_price` decimal(10, 2) comment '属性价格',
	`insert_time`  int(10) comment '属性添加时间',
	`update_time`  int(10) comment '属性更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款属性映射表';

#----------pre_borrow_album表--------------------------------------------------------
/*
 * @doc借款相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_album`;
create table `pre_borrow_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`object_id`   int unsigned comment '对象ID，指外键',
	`name`        varchar(255) comment '图片显示名称',
	`file_name`   varchar(255) comment '图片实际存储名称',
	`a_href`      varchar(255) comment '链接地址',
	`order`       int comment '排序',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款相册表';


#----------pre_borrow_usage--------------------------------------------------------
/*
 * @doc 借款用途表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_usage`;
create table `pre_borrow_usage` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '借款用途',
	`code`        varchar(255)comment '代码',
	`description` text comment '描述',
	`order`       smallint comment '排序',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款用途表';

use `heanes.com`;
set foreign_key_checks = 0;
#---------- pre_shopping_cart表--------------------------------------------------------
/* 
 * @doc 购物车表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_shopping_cart`;
create table `pre_shopping_cart` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`user_id`       int unsigned comment '用户ID',
	`session_id`    varchar(64) comment 'Session字符串',
	`goods_id`      int unsigned comment '商品ID',
	`goods_buy_num` int unsigned comment '购买商品个数',
	`goods_attr`    int unsigned comment '购买商品的属性',
	`order`         int comment '排序',
	`is_checked`    tinyint comment '是否已勾选状态，好方便用户作“结算”、“删除”等操作',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '修改时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '购物车表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_payment-----------------------------------------------------
/* @doc 支付方式类别表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_payment`;
create table `pre_payment` (
	`id`          int unsigned auto_increment comment '编号',
	`code`        varchar(50) comment '支付方式英文字段，供后台区分以调用',
	`name`        varchar(50) comment '支付方式名称',
	`service_fee` varchar(50) default '0' comment '支付费用，由网站收取中间费用，还可以是由支付方式决定',
	`config`      text comment '支付方式配置信息，作序列化处理',
	`img_src`     varchar(255) comment '支付方式对应图片logo地址',
	`user_rank`   smallint comment '可以使用该支付方式的最低会员级别',
	`description` text comment '支付方式描述信息',
	`order`       int comment '排序',
	`insert_time` int(10) comment '上传时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '支付方式存储库表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_order_info表--------------------------------------------------------
/* 
 * @doc交易订单基本信息表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_info`;
create table `pre_order_info` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`sn`              varchar(255) comment '平台订单号',
	`user_id`         int unsigned comment '下单用户ID',
	`address_id`      int unsigned comment '地址ID',
	`delivery_status` tinyint comment '发货状态',
	`pay_status`      tinyint comment '订单支付状态',
	`status`          tinyint comment '订单状态',
	`insert_time`     int(10) comment '插入时间',
	`update_time`     int(10) comment '更新时间',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '交易订单基本信息表';

#----------pre_order_goods表--------------------------------------------------------
/* 
 * @doc订单包含商品表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_goods`;
create table `pre_order_goods` (
	`id`                    int unsigned auto_increment comment '自增ID，主键',
	`order_id`              int unsigned comment '订单ID',
	`goods_id`              int unsigned comment '商品ID',
	`goods_name`            int unsigned comment '商品名称',
	`goods_serial`          varchar(64) comment '平台编号',
	`goods_short_desc`      varchar(255) comment '商品短描述',
	`goods_attr_serial`     varchar(255) comment '购买的商品属性',
	`goods_shop_price`      decimal(10, 2) comment '商品店铺价格',
	`goods_cost_price`      decimal(10, 2) comment '商品成本价',
	`goods_market_price`    decimal(10, 2) comment '商品市面价格',
	`goods_category_id`     int unsigned comment '商品分类ID',
	`goods_category_name`   varchar(255) comment '商品分类名称',
	`goods_cover_img_src`   varchar(255) comment '商品封面图片',
	`goods_cover_img_title` varchar(255) comment '商品封面图片title值',
	`goods_a_href`          varchar(255) comment '商品可链接至外链',
	`goods_a_title`         varchar(255) comment '商品外链title值',
	`goods_user_role_id`    int unsigned comment '商品查看用户角色ID',
	`goods_user_rank`       int unsigned comment '商品查看用户积分',
	`goods_pwd`             varchar(64) comment '查看密码',
	`goods_insert_time`     int(10) comment '商品添加时间',
	`goods_update_time`     int(10) comment '商品更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '订单包含商品表';

#----------pre_order_act_log表--------------------------------------------------------
/* 
 * @doc 交易订单操作记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_act_log`;
create table `pre_order_act_log` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`order_id`    int unsigned comment '对应订单ID',
	`user_id`     int unsigned comment '操作用户ID',
	`reason`      text comment '操作原因',
	`description` text comment '操作留下的备注信息',
	`insert_time` int(10) comment '操作时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '交易订单操作记录表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_buyer_address表--------------------------------------------------------
/* 
 * @doc 其他表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_buyer_address`;
create table `pre_buyer_address` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`user_id`       int unsigned comment '买家用户ID',
	`receiver_name` varchar(255) comment '收件人名称',
	`region_id`     int unsigned comment '地区ID',
	`detail`        varchar(255) comment '详细地址',
	`phone_cell`    varchar(255) comment '买家手机号',
	`phone_fixed`   varchar(255) comment '买家固定电话',
	`insert_time`   int(10) comment '插入时间',
	`update_time`   int(10) comment '更新时间',
	`order`         int unsigned comment '排序',
	`is_default`    tinyint unsigned default 0 comment '是否为默认',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '买家收件地址表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_express_company表--------------------------------------------------------
/* 
 * @doc 快递公司表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_express_company`;
create table `pre_express_company` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`name`           varchar(255) comment '快递公司名称',
	`img_src`        varchar(255) comment '快递公司图片logo',
	`company_a_href` varchar(255) comment '快递公司链接',
	`description`    text comment '快递公司介绍',
	`insert_time`    int(10) comment '插入时间',
	`update_time`    int(10) comment '更新时间',
	`order`          int unsigned comment '排序',
	`is_enable`      tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '快递公司表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_表--------------------------------------------------------
/*
 * @doc
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
/*
drop table if exists `pre_`;
create table `pre_` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '';
*/use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_表--------------------------------------------------------
/*
 * @doc
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
/*
drop table if exists `pre_`;
create table `pre_` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '';
*/use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_verify_code表--------------------------------------------------------
/* 
 * @doc 系统生成验证码保存表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_verify_code`;
create table `pre_verify_code` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`verify_code` varchar(15)  not null comment '验证码',
	`receiver`    varchar(127) not null comment '接收人，可以是手机或者邮件地址',
	`type`        varchar(31)  not null comment '验证类型，手机(mobile)或邮件(email)',
	`insert_time` int(10) comment '插入时间',
	`client_ip`   varchar(63) comment '客户IP地址',
	`status`      tinyint unsigned comment '验证状态 0-验证中 1-已通过验证 -1-未通过验证',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '系统生成验证码保存表';

#----------pre_sms_log表--------------------------------------------------------
/*
 * @doc 系统外发信息记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_sms_log`;
create table `pre_sms_log` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`receiver`    varchar(127) not null comment '接收人，可以是手机或者邮件地址',
	`content`     text         not null comment '发送内容',
	`type`        varchar(31)  not null comment '验证类型，手机(mobile)或邮件(email)',
	`insert_time` int(10) comment '插入时间',
	`client_ip`   varchar(63) comment '客户IP地址',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '系统外发信息记录表';

#----------pre_msg_template--------------------------------------------------------
/*
 * @doc 系统外发信息模版表
 * @author Heanes
 * @time 2015-07-02 10:48:01
*/
drop table if exists `pre_msg_template`;
create table `pre_msg_template` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`code`        varchar(127) not null comment '代码',
	`content`     text         not null comment '发送内容',
	`type`        varchar(31)  not null comment '模版类型，手机(mobile)或邮件(email)',
	`is_html`     tinyint comment '是否是html模版',
	`insert_time` int(10) comment '插入时间',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '系统外发信息模版表';

#----------pre_msg_interface--------------------------------------------------------
/*
 * @doc 系统外发信息模版表
 * @author Heanes
 * @time 2015-07-02 10:48:01
*/
drop table if exists `pre_msg_interface`;
create table `pre_msg_interface` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(127) not null comment '名称',
	`code`        varchar(127) comment '代码',
	`account`     varchar(127) comment '账户名称',
	`password`    varchar(64) comment '密码',
	`config`      varchar(1023) comment '配置信息',
	`content`     text comment '发送内容',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`is_default`  tinyint default 1 comment '是否默认使用',
	`is_enable`   tinyint default 1 comment '是否有效',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '系统外发信息第三方接口配置表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_customer--------------------------------------------------------
/*
 * @doc 客户关系表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_customer`;
create table `pre_customer`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`uid_master`  int unsigned comment '关系人主',
	`uid_slave`   int unsigned comment '关系人客',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`ship_type`   tinyint comment '关系类型，friend-好友，customer-客户/业务，partjober-客户/兼职',
	`apply_now`   tinyint default 1 comment '是否立即递交申请',
	`status`      tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '客户关系表';

#----------pre_customer_status_log--------------------------------------------------------
/*
 * @doc 客户关系表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_customer_status_log`;
create table `pre_customer_status_log`(
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`actor_user_id` int unsigned comment '关系人主',
	`customer_id`   int unsigned comment '关系人客',
	`insert_time`   int(10) comment '插入时间',
	`status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '客户关系申请表';

#----------pre_part_time_job--------------------------------------------------------
/*
 * @doc 兼职人员表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_part_time_job`;
create table `pre_part_time_job`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`uid_master`  int unsigned comment '关系人主',
	`uid_slave`   int unsigned comment '关系人客',
	`insert_time` int(10) comment '插入时间',
	`update_time` int(10) comment '更新时间',
	`status`      tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
	`is_enable`   tinyint default 1 comment '是否有效',
	`is_delete`   tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '兼职人员关系表';

#----------pre_part_time_job_apply--------------------------------------------------------
/*
 * @doc 兼职人员关系申请表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_part_time_job_status_log`;
create table `pre_part_time_job_status_log`(
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`actor_user_id` int unsigned comment '关系人主',
	`customer_id`   int unsigned comment '关系人客',
	`insert_time`   int(10) comment '插入时间',
	`status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
	`is_enable`     tinyint default 1 comment '是否有效',
	`is_delete`     tinyint default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '兼职人员关系申请审核记录表';



use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_ware表--------------------------------------------------------
/*
 * @doc 物品基本信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware`;
create table `pre_ware` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id`     int unsigned comment '物品分类ID',
	`type_id`         int unsigned comment '类型ID',
	`name`            varchar(255) comment '物品名称',
	`short_desc`      varchar(255) comment '物品短描述',
	`serial`          varchar(64) comment '物品序列号（平台）',
	`shop_price`      decimal(10, 2) comment '物品店铺价格（现价）',
	`original_price`  decimal(10,2) comment '原价',
	`cost_price`      decimal(10, 2) comment '物品成本价',
	`market_price`    decimal(10, 2) comment '物品市面价格',
	`store_num`       int unsigned comment '物品库存数目',
	`total_sold_num`  int unsigned comment '物品已卖出总个数',
	`cover_img_src`   varchar(255) comment '物品封面图片',
	`cover_img_title` varchar(255) comment '物品封面图片title值',
	`a_href`          varchar(255) comment '物品可链接至外链',
	`a_title`         varchar(255) comment '物品外链title值',
	`is_new`          tinyint unsigned default 1 comment '是否为新',
	`is_recommend`    tinyint unsigned default 0 comment '是否推荐',
	`is_top`          tinyint unsigned default 0 comment '是否置顶',
	`is_great`        tinyint unsigned default 0 comment '是否精品',
	`allow_comment`   tinyint unsigned default 1 comment '是否允许评论',
	`comment_num`     int unsigned default 0 comment '评论数',
	`comment_score`   smallint default 5 comment '文章评分，允许为负分',
	`read_num`        int unsigned default 1 comment '阅读次数',
	`click_count`     bigint unsigned default 1 comment '点击次数',
	`seo_title`       varchar(511) comment 'SEO标题',
	`seo_keywords`    varchar(511) comment 'SEO关键词',
	`seo_description` varchar(511) comment 'SEO描述',
	`description`     text comment '物品描述详情',
	`user_role_id`    int unsigned comment '物品查看用户角色',
	`user_rank`       int unsigned comment '物品查看用户积分',
	`pwd`             varchar(64) comment '查看密码',
	`insert_time`     int(10) comment '物品添加时间',
	`update_time`     int(10) comment '物品更新时间',
	`order`           int unsigned comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`       tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 100001
default charset = `utf8`
comment '物品基本信息表';

#----------pre_ware_category表--------------------------------------------------------
/*
 * @doc 物品分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_category`;
create table `pre_ware_category` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`parent_id`    int unsigned comment '父分类ID',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`a_href`       varchar(255) comment '分类链接',
	`a_title`      varchar(255) comment '分类链接title值',
	`img_src`      varchar(255) comment '分类图标地址',
	`img_title`    varchar(255) comment '分类图标title值',
	`user_role_id` smallint unsigned comment '分类访问用户组权限',
	`user_rank`    int unsigned comment '分类访问用户积分',
	`pwd`          varchar(64) comment '分类访问密码',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品分类表';

#----------pre_ware_type--------------------------------------------------------
/*
 * @doc 物品类型表，将物品属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_type`;
create table `pre_ware_type` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品类型表，将物品属性归为一类';


#----------pre_ware_fields表--------------------------------------------------------
/*
 * @doc 物品属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_fields`;
create table `pre_ware_fields` (
	`id`                        int unsigned auto_increment comment '自增ID，主键',
	`type_id`                   int unsigned comment '类型ID，为0表示通用类型',
	`name`                      varchar(127) comment '属性名称',
	`input_type`                varchar(15) comment '属性输入类型',
	`input_value`               text comment '输入备选值',
	`accept_type`               varchar(255) comment '允许上传的文件类型',
	`value_unit`                varchar(255) comment '值的单位',
	`is_required`               tinyint unsigned default 0 comment '是否必须的',
	`allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
	`allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
	`as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
	`is_show`                   tinyint unsigned default 1 comment '是否显示',
	`order`                     int unsigned comment '排序',
	`is_enable`                 tinyint unsigned default 1 comment '是否启用',
	`is_delete`                 tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品属性名称字段表';

#----------pre_ware_fields_data--------------------------------------------------------
/*
 * @doc 物品属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_fields_data`;
create table `pre_ware_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '属性ID',
	`ware_id`     int unsigned comment '物品ID',
	`fields_value` varchar(255) comment '物品属性值',
	`fields_price` decimal(10, 2) comment '属性价格',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品属性映射表';

#----------pre_ware_album表--------------------------------------------------------
/*
 * @doc物品相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_album`;
create table `pre_ware_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`object_id`   int unsigned comment '对象ID，指外键',
	`name`        varchar(255) comment '图片显示名称',
	`file_name`   varchar(255) comment '图片实际存储名称',
	`a_href`      varchar(255) comment '链接地址',
	`order`       int comment '排序',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品相册表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_file_type表--------------------------------------------------------
/* 
 * @doc 文件类型表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_type`;
create table `pre_file_type` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`type`        varchar(63) comment '文件类型名称字符串',
	`name`        varchar(63) comment '文件类型描述',
	`description` text comment '备注介绍',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文件类型表';

#----------pre_file_category表--------------------------------------------------------
/* 
 * @doc文件分类表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_category`;
create table `pre_file_category` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`parent_id`    int unsigned comment '父分类ID',
	`name`         varchar(255) comment '分类名称',
	`desc`         text comment '分类信息介绍',
	`path`         varchar(255) comment '分类存储路径',
	`file_type`    varchar(255) comment '允许存储文件的类型',
	`user_role_id` int unsigned comment '允许访问角色',
	`pwd`          varchar(64) comment '访问密码',
	`description`  text comment '备注介绍',
	`insert_time`  int(10) comment '插入时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文件分类表';

#----------pre_file表--------------------------------------------------------
/* 
 * @doc 文件信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file`;
create table `pre_file` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`category_id`  int unsigned comment '文件分类ID',
	`real_name`    varchar(255) comment '文件实际名称',
	`name`         varchar(255) comment '文件显示名称',
	`user_role_id` int unsigned comment '允许访问角色',
	`pwd`          varchar(64) comment '访问密码',
	`insert_time`  int(10) comment '上传时间',
	`update_time`  int(10) comment '更新时间',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文件信息表';

#----------pre_file_upload_log表--------------------------------------------------------
/* 
 * @doc 其他文件上传记录日志表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_upload_log`;
create table `pre_file_upload_log` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`act_user_id`    int unsigned comment '用户ID',
	`act_type`       varchar(10) comment '操作类型',
	`actor_ip`       varchar(64) comment '操作者IP',
	`actor_browser`  varchar(63) comment '操作者浏览器',
	`actor_os`       varchar(63) comment '操作者操作系统',
	`actor_language` varchar(63) comment '操作者浏览器语言',
	`actor_country`  varchar(63) comment '操作者国家',
	`actor_province` varchar(63) comment '操作者省',
	`actor_city`     varchar(63) comment '操作者市',
	`act_time`       int(10) comment '操作时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '其他文件上传记录日志表';

# alter table `heanes.com`.`pre_file_upload_log` add `usage_info` text comment '借款用途备注';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_log_search表--------------------------------------------------------
/* 
 * @doc 搜索记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_log_search`;
create table `pre_log_search` (
	`id`         int unsigned auto_increment comment '自增ID，主键',
	`string`     varchar(255) comment '搜索关键词',
	`access_url` varchar(255) comment '搜索操作所在页面',
	`time`       int(10) comment '搜索时间',
	`serach_ip`  varchar(64) comment '搜索者IP',
	`country`    varchar(63) comment '搜索者国家',
	`province`   varchar(63) comment '搜索者省',
	`city_name`  varchar(63) comment '搜索者城市名称',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '搜索记录表';

#----------pre_hot_string表--------------------------------------------------------
/* 
 * @doc 其他搜索关键词热门词表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_hot_string`;
create table `pre_hot_string` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '搜索热词',
	`insert_time` int(10) comment '添加时间',
	`update_time` int(10) comment '更新时间',
	`order`       int unsigned comment '排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '其他搜索关键词热门词表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_product--------------------------------------------------------
/*
 * @doc 产品基本信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product`;
create table `pre_product` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id`     int unsigned comment '产品分类ID',
	`type_id`         int unsigned comment '类型ID',
	`name`            varchar(255) comment '产品名称',
	`short_desc`      varchar(255) comment '产品短描述',
	`serial`          varchar(64) comment '产品序列号（平台）',
	`shop_price`      decimal(10, 2) comment '产品店铺价格',
	`cost_price`      decimal(10, 2) comment '产品成本价',
	`market_price`    decimal(10, 2) comment '产品市面价格',
	`store_num`       int unsigned comment '产品库存数目',
	`total_sold_num`  int unsigned comment '产品已卖出总个数',
	`cover_img_src`   varchar(255) comment '产品封面图片',
	`a_href`          varchar(255) comment '产品可链接至外链',
	`is_new`          tinyint unsigned default 1 comment '是否为新',
	`is_recommend`    tinyint unsigned default 0 comment '是否推荐',
	`is_top`          tinyint unsigned default 0 comment '是否置顶',
	`is_great`        tinyint unsigned default 0 comment '是否精品',
	`allow_comment`   tinyint unsigned default 1 comment '是否允许评论',
	`comment_num`     int unsigned default 0 comment '评论数',
	`comment_score`   smallint default 5 comment '平均评分值，允许为负分',
	`read_num`        int unsigned default 1 comment '阅读次数',
	`click_count`     bigint unsigned default 1 comment '点击次数',
	`seo_title`       varchar(511) comment 'SEO标题',
	`seo_keywords`    varchar(511) comment 'SEO关键词',
	`seo_description` varchar(511) comment 'SEO描述',
	`description`     text comment '产品描述详情',
	`user_role_id`    int unsigned comment '产品查看用户角色',
	`user_rank`       int unsigned comment '产品查看用户积分',
	`pwd`             varchar(64) comment '查看密码',
	`insert_time`     int(10) comment '产品添加时间',
	`update_time`     int(10) comment '产品更新时间',
	`order`           int unsigned comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`       tinyint unsigned default 0 comment '是否删除',
	#特殊业务字段
	`loan_type`       varchar(255) comment '贷款类型',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品基本信息表';

# @todo 产品配件表
# @todo 产品标签表

#----------pre_product_category表--------------------------------------------------------
/*
 * @doc 产品分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_category`;
create table `pre_product_category` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`parent_id`    int unsigned comment '父分类ID',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`a_href`       varchar(255) comment '分类链接',
	`a_title`      varchar(255) comment '分类链接title值',
	`img_src`      varchar(255) comment '分类图标地址',
	`img_title`    varchar(255) comment '分类图标title值',
	`user_role_id` smallint unsigned comment '分类访问用户组权限',
	`user_rank`    int unsigned comment '分类访问用户积分',
	`pwd`          varchar(64) comment '分类访问密码',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品分类表';

#----------pre_product_type--------------------------------------------------------
/*
 * @doc 产品类型表，将产品属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_type`;
create table `pre_product_type` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`name`         varchar(255) comment '分类名称',
	`description`  varchar(1023) comment '分类备注',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`order`        int unsigned comment '排序',
	`is_enable`    tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品类型表，将产品属性归为一类';

#----------pre_product_fields表--------------------------------------------------------
/*
 * @doc 产品属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_fields`;
create table `pre_product_fields` (
	`id`                        int unsigned auto_increment comment '自增ID，主键',
	`type_id`                   int unsigned comment '类型ID，为0表示通用类型',
	`name`                      varchar(127) comment '属性名称',
	`input_type`                varchar(15) comment '属性输入类型',
	`input_value`               text comment '输入备选值',
	`value_unit`                varchar(255) comment '值的单位',
	`accept_type`               varchar(255) comment '允许上传的文件类型',
	`is_required`               tinyint unsigned default 0 comment '是否必须的',
	`allow_read_role`           varchar(255) comment '允许查看的角色ID,以逗号为分隔符',
	`allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
	`as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
	`is_show`                   tinyint unsigned default 1 comment '是否显示',
	`order`                     int unsigned comment '排序',
	`insert_time`               int(10) comment '添加时间',
	`update_time`               int(10) comment '更新时间',
	`is_enable`                 tinyint unsigned default 1 comment '是否启用',
	`is_delete`                 tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品属性名称字段表';

#----------pre_product_fields_data--------------------------------------------------------
/*
 * @doc 产品属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_fields_data`;
create table `pre_product_fields_data` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`fields_id`    int unsigned comment '属性ID',
	`product_id`   int unsigned comment '类型ID，为0表示通用类型',
	`fields_value` varchar(255) comment '产品属性值',
	`fields_price` decimal(10, 2) comment '属性价格',
	`insert_time`  int(10) comment '属性添加时间',
	`update_time`  int(10) comment '属性更新时间',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品属性映射表';

#----------pre_product_album表--------------------------------------------------------
/*
 * @doc产品相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_album`;
create table `pre_product_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`name`        varchar(255) comment '图片显示名称',
	`dir_name`    varchar(255) comment '图片实际存储名称',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品相册表';

#----------pre_product_collect--------------------------------------------------------
/*
 * @doc 产品收藏表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_collect`;
create table `pre_product_collect` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`product_id`   int unsigned comment '产品ID',
	`user_id`      int unsigned comment '用户',
	`collect_time` int(10) comment '收藏时间',
	`insert_time`  int(10) comment '添加时间',
	`update_time`  int(10) comment '更新时间',
	`is_enable`    tinyint unsigned default 1 comment '是否启用',
	`is_delete`    tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品收藏表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_vote--------------------------------------------------------
/*
 * @doc 投票表
 * @author Heanes
 * @time 2015-07-16 16:15:49
*/
drop table if exists `pre_vote`;
create table `pre_vote` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	`name` varchar(255) comment '投票名称',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '投票表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_money_quick_apply--------------------------------------------------------
/*
 * @doc 贷款快速申请数据存储表
 * @author Heanes
 * @time 2015-07-16 16:15:49
*/
drop table if exists `pre_money_quick_apply`;
create table `pre_money_quick_apply` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`product_id`     int unsigned comment '产品ID',
	`real_name`      varchar(255) comment '姓名',
	`phone`          varchar(63) comment '联系电话',
	`money_want`     varchar(32) comment '贷款额度',
	`loan_type`      tinyint comment '贷款类型,1-抵押贷款，2-信用贷款',
	`usage_id`       int unsigned comment '贷款用途ID',
	`usage_desc`     varchar(255) comment '贷款用途',
	`user_ip`        varchar(64) comment '客户IP',
	`is_read`        tinyint unsigned default 0 comment '是否已读',
	`read_time`      int(10) comment '阅读时间',
	`had_contact`    tinyint default 0 comment '联系状态',
	`is_handle`      tinyint unsigned default 0 comment '是否已处理',
	`handle_user_id` int unsigned comment '最后处理人用户ID',
	`handle_result`  tinyint comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
	`handle_desc`    varchar(255) comment '处理结果备注',
	`handle_time`    int(10) comment '处理时间',
	`is_recycle`     tinyint unsigned default 0 comment '是否放入回收站',
	`is_top`         tinyint(10) comment '是否置顶',
	`order`          int unsigned comment '排序',
	`insert_time`    int(10) comment '添加时间',
	`update_time`    int(10) comment '更新时间',
	`is_enable`      tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`      tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '贷款快速申请数据存储表';

#----------pre_money_quick_apply_log--------------------------------------------------------
/*
 * @doc 贷款快速申请数据存储操作记录表
 * @author Heanes
 * @time 2015-07-16 16:15:49
*/
drop table if exists `pre_money_quick_apply_log`;
create table `pre_money_quick_apply_log` (
	`id`            int unsigned auto_increment comment '自增ID，主键',
	`apply_id`      int comment '申请ID',
	`actor_user_id` int unsigned comment '处理者用户ID',
	`handle_result` tinyint comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
	`handle_desc`   varchar(255) comment '处理结果备注',
	`log_desc`      text comment '日志说明',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '更新时间',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`     tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '贷款快速申请数据存储操作记录表';

use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_special_category--------------------------------------------------------
/*
 * @doc 专题分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_category`;
create table `pre_special_category` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`parent_id`       int unsigned comment '父分类ID',
	`name`            varchar(63) not null comment '分类名称',
	`code`            varchar(63) comment 'code',
	`template_id`     int unsigned comment '分类模版ID',
	`a_href`          varchar(255) comment '分类链接',
	`a_title`         varchar(255) comment '分类链接标题',
	`img_src`         varchar(255) comment '分类图标',
	`seo_keywords`    varchar(511) comment 'SEO关键词',
	`seo_description` text comment 'SEO描述',
	`description`     text comment '分类介绍',
	`user_role_id`    smallint unsigned comment '分类阅读用户角色权限',
	`user_rank`       int unsigned comment '分类阅读用户积分',
	`pwd`             varchar(64) comment '分类阅读密码',
	`order`           int unsigned comment '排序',
	`insert_time`     int(10) comment '创建时间',
	`update_time`     int(10) comment '更新时间',
	`is_enable`       tinyint unsigned default 1 comment '是否有效',
	`is_delete`       tinyint unsigned default 0 comment '是否已删除' comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题分类表';

#----------pre_special--------------------------------------------------------
/*
 * @doc 专题表
 * @author Heanes
 * @time 2015-08-26 14:11:33
*/
drop table if exists `pre_special`;
create table `pre_special` (
	`id`              int unsigned auto_increment comment '自增ID，主键',
	`category_id`     int unsigned comment '专题分类ID',
	`title`           varchar(1023) not null comment '专题标题',
	`subtitle`        varchar(255) comment '专题副标题',
	`cover_img_src`   varchar(255) comment '专题封面图片',
	`user_id`         int unsigned comment '专题作者（用户）ID',
	`user_link`       varchar(255) comment '专题作者链接',
	`author`          varchar(127) comment '专题作者笔名',
	`editor`          varchar(127) comment '责任编辑',
	`origin_source`   varchar(255) comment '专题来源，为空表示原创',
	`content`         text comment '专题内容',
	`keywords`        varchar(255) comment '关键词',
	`tags`            varchar(255) comment '标签ID，形如1,2,3以逗号分开',
	`semantic_a_href` varchar(255) comment '语义化链接',
	`a_href`          varchar(255) comment '专题链接',
	`a_title`         varchar(255) comment '专题链接标题',
	`title_bg_color`  varchar(20) default '#FFF' comment '专题标题背景颜色',
	`content_bg_color`varchar(20) default '#FFF' comment '专题内容背景颜色',
	`template_id`     int unsigned comment '专题模版ID',
	`template_path`   varchar(255) comment '专题模版路径',
	`template_file`   varchar(255) comment '专题模版文件名称',
	`is_new`          tinyint unsigned default 1 comment '是否为新发布专题',
	`is_promot`       tinyint unsigned default 0 comment '是否推荐',
	`is_top`          tinyint unsigned default 0 comment '是否置顶',
	`is_great`        tinyint unsigned default 0 comment '是否精品',
	`is_delete`       tinyint unsigned default 0 comment '是否删除',
	`allow_comment`   tinyint unsigned default 1 comment '是否允许评论',
	`comment_num`     int unsigned default 0 comment '评论数',
	`comment_score`   smallint default 5 comment '专题评分，允许为负分',
	`read_num`        int unsigned default 1 comment '阅读次数',
	`click_count`     bigint unsigned default 1 comment '点击次数',
	`seo_title`       varchar(511) comment '专题SEO标题',
	`seo_keywords`     varchar(511) comment '专题SEO关键词',
	`seo_description` varchar(511) comment '专题SEO描述',
	`user_role_id`    smallint unsigned comment '专题阅读用户权限',
	`user_rank`       int unsigned comment '专题阅读用户积分',
	`pwd`             varchar(64) comment '阅读密码',
	`insert_time`     int(10) comment '专题创建时间',
	`update_time`     int(10) comment '专题更新时间',
	`order`           int comment '排序',
	`is_enable`       tinyint unsigned default 1 comment '是否启用（显示）',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题表';

#----------pre_special_album表--------------------------------------------------------
/*
 * @doc 专题相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_album`;
create table `pre_ware_album` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`object_id`   int unsigned comment '对象ID，指外键',
	`name`        varchar(255) comment '图片显示名称',
	`file_name`   varchar(255) comment '图片实际存储名称',
	`a_href`      varchar(255) comment '链接地址',
	`order`       int comment '排序',
	`insert_time` int(10) comment '图片添加时间',
	`update_time` int(10) comment '图片更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题相册表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_special_template_category--------------------------------------------------------
/*
 * @doc 模版库分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_template_category`;
create table `pre_special_template_category` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`parent_id`   int unsigned default 0 comment '父分类ID',
	`name`        varchar(63) comment '分类名称',
	`description` text comment '备注介绍',
	`insert_time` int(10) comment '分类创建时间',
	`update_time` int(10) comment '分类最后更新时间',
	`order`       int unsigned comment '分类排序',
	`is_enable`   tinyint unsigned default 1 comment '是否启用',
	`is_delete`   tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题模版库分类表';
#----------pre_special_template_library--------------------------------------------------------
/*
 * @doc 模版库表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_template_library`;
create table `pre_special_template_library` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`cateogry_id`    int unsigned comment '模版分类',
	`name`           varchar(63) comment '分类名称',
	`path`           varchar(255) comment '模版路径',
	`file_name`      varchar(127) comment '模版名称',
	`screenshot_src` varchar(255) comment '模版截图图片路径',
	`description`    text comment '备注介绍',
	`insert_time`    int(10) comment '插入时间',
	`update_time`    int(10) comment '更新时间',
	`order`          int unsigned comment '排序',
	`is_enable`      tinyint unsigned default 1 comment '是否启用',
	`is_delete`      tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题模版库表';