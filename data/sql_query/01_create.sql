use `heanes.com`;
set foreign_key_checks = 0;

/*
 * 建表必加字段及几个状态说明：
 * id           int unsigned auto_increment 主键，必要时候可以为bigint类型，必加字段
 * create_time  int(10) unsigned 添加时间，基本要加
 * update_time  int(10) unsigned 更新时间，基本要加
 * is_enable    tinyint unsigned default 1 有效状态，0-无效，1-有效，基本要加
 * is_delete    tinyint unsigned default 1 是否删除删除，0-删除，1-不删除，基本要加
 * create_user  int unsigned comment '创建人'，基本要加
 * update_user  int unsigned comment '更新人'，基本要加
 * order_number int 排序序号，基本要加
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否已删除' comment '是否启用(显示)',
    `create_time`   int(10) unsigned default 0 comment '创建时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人'
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父菜单ID',
    `name`          varchar(255) not null default '' comment '菜单名称',
    `a_href`        varchar(511) default '' comment '菜单链接地址',
    `a_title`       varchar(511) default '' comment '菜单链接title值',
    `a_color`       varchar(12) default '' comment '菜单链接颜色值',
    `img_src`       varchar(255) default '' comment '菜单图片地址',
    `img_title`     varchar(255) default '' comment '菜单图片title值',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '管理员用户ID',
    `user_role_id`  int unsigned default 0 comment '权限所需角色ID',
    `menu_id`       int unsigned default 0 comment '可操作菜单ID',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `user_name`             varchar(63) default '' comment '管理员用户名',
    `user_pwd`              varchar(64) not null default '' comment '管理员密码',
    `user_email`            varchar(255) default '' comment '管理员邮箱',
    `mobile`                varchar(63) default '' comment '用户手机号',
    `telephone`             varchar(63) default '' comment '用户固定电话',
    `role_id`               int unsigned default 0 comment '管理员权限角色ID',
    `role_name`             varchar(63) default '' comment '管理员权限角色名称',
    `allow_login`           tinyint unsigned default 0 comment '是否允许登录',
    `login_times`           int unsigned default 0 comment '登录次数',
    `last_login_time`       int(10) unsigned default 0 comment '最后登陆时间',
    `current_login_time`    int(10) unsigned default 0 comment '当前登陆时间',
    `current_login_ip`      varchar(255) default '' comment '当前登录IP',
    `last_login_ip`         varchar(255) default '' comment '上次登录IP',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(63) default '' comment '权限code',
    `name`          varchar(63) default '' comment '权限角色名称',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父ID，用来分组，以方便用户设置',
    `name`          varchar(255) default '' comment '设置项名称',
    `code`          varchar(255) default '' comment '设置项code',
    `input_type`    varchar(127) default '' comment '设置输入形式',
    `input_range`   varchar(255) default '' comment '设置项备选值范围',
    `store_value`   text comment '设置项存储值',
    `order_number`  int unsigned default 0 comment '排序',
    `can_edit`      tinyint unsigned default 1 comment '是否是可编辑项',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '创建时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `title`         varchar(255) default '' comment '标题',
    `keywords`      varchar(255) default '' comment '关键词',
    `description`   varchar(255) default '' comment '描述',
    `type`          varchar(127) default '' comment '类型',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '设置项名称',
    `value`         varchar(255) default '' comment '设置项值',
    `type`          varchar(127) default '' comment '设置输入形式',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                        int unsigned auto_increment comment '自增ID，主键',
    `parent_id`                 int unsigned default 0 comment '父导航ID',
    `name`                      varchar(15) not null default '' comment '导航栏名称',
    `a_href`                    varchar(255) default '' comment '导航链接',
    `a_title`                   varchar(255) default '' comment '链接title',
    `a_target`                  varchar(255) default '' comment '导航链接打开方式',
    `img_src`                   varchar(255) default '' comment '导航链接图标地址',
    `img_src_hover`             varchar(255) default '' comment '导航链接图标鼠标浮上时地址',
    `img_src_active`            varchar(255) default '' comment '导航链接激活时图标地址',
    `href_active_match_path`    text comment '链接激活匹配的控制器',
    `style_class`               varchar(255) default '' comment '链接样式',
    `style_class_hover`         varchar(255) default '' comment '链接鼠标浮上时样式',
    `style_class_acitve`        varchar(255) default '' comment '链接激活的样式',
    `order_number`              int unsigned default 0 comment '排序序号',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '导航创建时间',
    `update_time`               int(10) unsigned default 0 comment '导航更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`                        int unsigned auto_increment comment '自增ID，主键',
    `parent_id`                 int unsigned default 0 comment '父导航ID',
    `name`                      varchar(15) not null default '' comment '导航栏名称',
    `a_href`                    varchar(255) default '' comment '导航链接',
    `a_title`                   varchar(255) default '' comment '链接title',
    `a_target`                  varchar(255) default '' comment '导航链接打开方式',
    `img_src`                   varchar(255) default '' comment '导航链接图标地址',
    `img_src_hover`             varchar(255) default '' comment '导航链接图标鼠标浮上时地址',
    `img_src_active`            varchar(255) default '' comment '导航链接激活时图标地址',
    `href_active_match_path`    text comment '链接激活匹配的控制器',
    `style_class`               varchar(255) default '' comment '链接样式',
    `style_class_hover`         varchar(255) default '' comment '链接鼠标浮上时样式',
    `style_class_acitve`        varchar(255) default '' comment '链接激活的样式',
    `order_number`              int unsigned default 0 comment '排序序号',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '导航创建时间',
    `update_time`               int(10) unsigned default 0 comment '导航更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '幻灯名称',
    `img_src`       varchar(255) default '' comment '幻灯文件地址，设计可以存储网络文件地址',
    `a_href`        varchar(255) default '' comment '幻灯链接地址',
    `a_target`      tinyint unsigned default 1 comment '是否新窗口，0-不是，1-是',
    `title`         varchar(255) default '' comment '显示标题',
    `description`   varchar(255) default '' comment '幻灯备注信息',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '幻灯创建时间',
    `update_time`   int(10) unsigned default 0 comment '幻灯最后修改时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '幻灯名称',
    `img_src`       varchar(255) default '' comment '幻灯文件地址，设计可以存储网络文件地址',
    `a_href`        varchar(255) default '' comment '幻灯链接地址',
    `a_target`      tinyint unsigned default 1 comment '是否新窗口，0-不是，1-是',
    `title`         varchar(255) default '' comment '显示标题',
    `description`   varchar(255) default '' comment '幻灯备注信息',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '幻灯创建时间',
    `update_time`   int(10) unsigned default 0 comment '幻灯最后修改时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '首页幻灯设置表(WAP端)';

#----------pre_wap_member_center_menu--------------------------------------------------------
/*
 * @doc 手机端会员中心菜单表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_wap_member_center_menu`;
create table `pre_wap_member_center_menu` (
    `id`                        int unsigned auto_increment comment '自增ID，主键',
    `parent_id`                 int unsigned default 0 comment '父ID',
    `name`                      varchar(15) not null default '' comment '栏名称',
    `a_href`                    varchar(255) default '' comment '链接',
    `a_title`                   varchar(255) default '' comment '链接title',
    `a_target`                  tinyint unsigned default 0 comment '链接打开方式',
    `icon_src`                  varchar(255) default '' comment '链接图标地址',
    `icon_src_hover`            varchar(255) default '' comment '链接图标激活样式地址',
    `href_in_hover`             text comment '激活样式链接库(控制器名称)',
    `allow_read_role`           varchar(255) default '' comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `group`                     int unsigned default 0 comment '分组',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '创建时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '手机端会员中心菜单表';

#----------pre_wap_member_center_menu_lib--------------------------------------------------------
/*
 * @doc 手机端会员中心菜单表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_wap_member_center_menu_lib`;
create table `pre_wap_member_center_menu_lib` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父ID',
    `name`              varchar(15) not null default '' comment '栏名称',
    `a_href`            varchar(255) default '' comment '链接',
    `a_title`           varchar(255) default '' comment '链接title',
    `a_target`          tinyint unsigned default 0 comment '链接打开方式',
    `icon_src`          varchar(255) default '' comment '链接图标地址',
    `icon_src_hover`    varchar(255) default '' comment '链接图标激活样式地址',
    `href_in_hover`     text comment '激活样式链接库(控制器名称)',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '手机端会员中心菜单库表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_article_category表--------------------------------------------------------
/* 
 * @doc 文章分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_category`;
create table `pre_article_category` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(63) default '' not null default '' comment '分类名称',
    `code`              varchar(63) default '' comment 'code',
    `template_id`       int unsigned default 0 comment '分类模版ID',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接标题',
    `img_src`           varchar(255) default '' comment '分类图标',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   text comment 'SEO描述',
    `description`       text comment '分类介绍',
    `user_role_id`      smallint unsigned default 0 comment '分类阅读用户角色权限',
    `user_rank`         int unsigned default 0 comment '分类阅读用户积分',
    `access_password`   varchar(64) default '' comment '分类阅读密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否有效',
    `is_deleted`        tinyint unsigned default 0 comment '是否已删除' comment '是否启用(显示)',
    `create_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '文章分类ID',
    `title`             varchar(1023) default '' not null default '' comment '文章标题',
    `subtitle`          varchar(255) default '' comment '文章副标题',
    `cover_img_src`     varchar(255) default '' comment '文章封面图片',
    `user_id`           int unsigned default 0 comment '文章作者(用户)ID',
    `user_link`         varchar(255) default '' comment '文章作者链接',
    `author`            varchar(127) default '' comment '文章作者笔名',
    `editor`            varchar(127) default '' comment '责任编辑',
    `origin_source`     varchar(255) default '' comment '文章来源，为空表示原创',
    `content`           text comment '文章内容',
    `keywords`          varchar(255) default '' comment '关键词',
    `tags`              varchar(255) default '' comment '标签ID，形如1,2,3以逗号分开',
    `semantic_a_href`   varchar(255) default '' comment '语义化链接',
    `a_href`            varchar(255) default '' comment '文章链接',
    `a_title`           varchar(255) default '' comment '文章链接标题',
    `title_bg_color`    varchar(20) default '#FFF' comment '文章标题背景颜色',
    `content_bg_color`  varchar(20) default '#FFF' comment '文章内容背景颜色',
    `template_id`       int unsigned default 0 comment '文章模版ID',
    `is_new`            tinyint unsigned default 1 comment '是否为新发布文章',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '文章评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment '文章SEO标题',
    `seo_keywords`      varchar(511) default '' comment '文章SEO关键词',
    `seo_description`   varchar(511) default '' comment '文章SEO描述',
    `user_role_id`      smallint unsigned default 1 comment '文章阅读用户权限',
    `user_rank`         int unsigned default 1 comment '文章阅读用户积分',
    `access_password`   varchar(64) default '' comment '阅读密码',
    `order_number`      int default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '文章创建时间',
    `update_time`       int(10) unsigned default 0 comment '文章更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `article_id`  int unsigned default 0 comment '被评论文章ID',
    `parent_id`   int unsigned default 0 comment '父评论，“盖楼”形式',
    `user_id`     int unsigned default 0 comment '评论人用户ID',
    `user_name`   varchar(255) default '' comment '评论人名称，若未注册用户评论，可以使用此字段作为临时用户名',
    `email`       varchar(255) default '' comment '评论人Email',
    `web_link`    varchar(255) default '' comment '评论人网站地址',
    `title`       varchar(1023) default '' comment '评论标题',
    `content`     text comment '评论内容',
    `score`       smallint default 5 comment '评分',
    `ip`          varchar(40) default '' comment '评论人IP，兼容IPv6',
    `isp`         varchar(255) default '' comment '评论人IP对应IPS提供商',
    `location`    varchar(255) default '' comment '评论人IP对应地理位置',
    `is_hot`      tinyint unsigned default 0 comment '是否热门',
    `is_top`      tinyint unsigned default 0 comment '是否置顶',
    `order_number`int unsigned default 0 comment '排序',
    `is_enable`   tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`  tinyint unsigned default 0 comment '是否已删除',
    `create_time` int(10) unsigned default 0 comment '评论时间',
    `update_time` int(10) unsigned default 0 comment '评论更新时间',
    `create_user` int unsigned default 0 comment '创建人',
    `update_user` int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `article_id`    int unsigned default 0 comment '被点赞文章ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否已删除',
    `create_time`   int(10) unsigned default 0 comment '点赞时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章点赞表';

#----------pre_article_favourite表--------------------------------------------------------
/*
 * @doc 文章收藏表
 * @author Heanes
 * @time 2015-06-24 09:48:28
*/
drop table if exists `pre_article_collect`;
create table `pre_article_collect` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `article_id`    int unsigned default 0 comment '文章ID',
    `user_id`       int unsigned default 0 comment '用户',
    `collect_time`  int(10) comment '收藏时间',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `article_comment_id`    int unsigned default 0 comment '文章评论ID',
    `user_id`               int unsigned default 0 comment '用户ID',
    `user_ip`               varchar(40) default '' comment '评论人IP，兼容IPv6',
    `type`                  smallint default 0 comment '操作类型，1-支持，-1反对，2-举报',
    `reason`                varchar(1023) default '' comment '操作原因',
    `order_number`          int unsigned default 0 comment '排序',
    `is_enable`             tinyint unsigned default 1 comment '是否有效',
    `is_deleted`            tinyint unsigned default 0 comment '是否已删除',
    `create_time`           int(10) unsigned default 0 comment '操作时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '图片添加时间',
    `update_time`   int(10) unsigned default 0 comment '图片更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `name`          varchar(63) default '' comment '分类名称',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned default 0 comment '分类排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '分类创建时间',
    `update_time`   int(10) unsigned default 0 comment '分类最后更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `cateogry_id`       int unsigned default 0 comment '模版分类',
    `name`              varchar(63) default '' comment '分类名称',
    `path`              varchar(255) default '' comment '模版路径',
    `file_name`         varchar(127) default '' comment '模版名称',
    `screenshot_src`    varchar(255) default '' comment '模版截图图片路径',
    `description`       text comment '备注介绍',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '插入时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `name`          varchar(255) default '' comment '分组名称',
    `img_src`       varchar(255) default '' comment '分类图标地址',
    `img_title`     varchar(255) default '' comment '分类图片title值',
    `a_href`        varchar(255) default '' comment '分类外链',
    `a_title`       varchar(255) default '' comment '分类外链title值',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned default 0 comment '排序',
    `create_time`   int(10) unsigned default 0 comment '分类添加时间',
    `update_time`   int(10) unsigned default 0 comment '分类最后更新时间',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '链接名称',
    `email`         varchar(255) default '' comment '友情链接Email',
    `a_href`        varchar(511) default '' comment '链接地址',
    `a_title`       varchar(511) default '' comment '链接title值',
    `a_target`      tinyint unsigned default 0 comment '链接打开方式',
    `img_src`       varchar(255) default '' comment '链接图标地址',
    `img_title`     varchar(255) default '' comment '链接图标title值',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned default 0 comment '排序',
    `create_time`   int(10) unsigned default 0 comment '链接添加时间',
    `update_time`   int(10) unsigned default 0 comment '链接更新时间',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '链接名称',
    `email`         varchar(255) default '' comment '链接Email',
    `a_href`        varchar(511) default '' comment '链接地址',
    `img_src`       varchar(255) default '' comment '链接图片地址',
    `ip`            varchar(255) default '' comment '链接申请人IP',
    `description`   text comment '备注介绍',
    `status`        tinyint unsigned default 0 comment '申请状态',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '链接添加时间',
    `update_time`   int(10) unsigned default 0 comment '链接更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `link_apply_id` varchar(255) default '' comment '链接申请ID',
    `act_user_id`   int unsigned default 0 comment '链接操作用户ID',
    `act_comment`   varchar(1023) default '' comment '链接处理备注信息',
    `act_time`      int(10) unsigned default 0 comment '链接处理时间',
    `act_status`    tinyint unsigned default 0 comment '链接申请状态处理结果',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `type`          smallint default 0 comment '联系方式类型',
    `name`          varchar(255) default '' comment '联系方式名称',
    `value`         varchar(255) default '' comment '联系方式途径(值)',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否已删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `sender_user_id`    int unsigned default 0 comment '发送人用户ID',
    `title`             varchar(1023) default '' comment '私信标题',
    `content`           text comment '私信内容',
    `send_time`         int(10) unsigned default 0 comment '发送时间',
    `is_read`           tinyint unsigned default 0 comment '是否已读',
    `read_time`         int(10) unsigned default 0 comment '阅读时间',
    `delete_time`       int(10) unsigned default 0 comment '删除时间',
    `is_recycle`        tinyint unsigned default 0 comment '是否放入回收站',
    `recycle_time`      int(10) unsigned default 0 comment '回收时间',
    `is_time_limit`     tinyint unsigned default 0 comment '是否具有有效期',
    `limit_time_end`    int(10) unsigned default 0 comment '失效时间',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `top_time_start`    int(10) unsigned default 0 comment '置顶开始时间',
    `top_time_end`      int(10) unsigned default 0 comment '置顶结束时间',
    `sender_ip`         varchar(63) default '' comment '发送人ip',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否有效',
    `is_deleted`        tinyint unsigned default 0 comment '是否已删除',
    `create_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `access_url`  varchar(255) default '' comment '访客访问页面',
    `refer_url`   varchar(255) default '' comment '来源页面',
    `ip`          varchar(64) default '' comment '访客IP',
    `borwser`     varchar(255) default '' comment '访客浏览器信息',
    `os`          varchar(255) default '' comment '访客操作系统信息',
    `language`    varchar(63) default '' comment '访客地域语言',
    `country`     varchar(63) default '' comment '访客所在国家',
    `province`    varchar(63) default '' comment '访客所在省',
    `city`        varchar(63) default '' comment '访客所在市',
    `visit_time`  int(10) unsigned default 0 comment '访问时间',
    `leave_time`  int(10) unsigned default 0 comment '访客离开时间',
    `visit_times` int unsigned default 0 comment '访问次数',
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
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `user_name`             varchar(255) not null unique comment '用户名',
    `user_pwd`              varchar(64)  not null default '' comment '用户密码',
    `user_email`            varchar(255) default '' comment '用户Email',
    `mobile`                varchar(63) default '' comment '用户手机号',
    `telephone`             varchar(63) default '' comment '用户固定电话',
    `age`                   smallint unsigned default 0 comment '用户年龄',
    `gender`                tinyint unsigned default 0 comment '用户性别',
    `idcard`                varchar(50) default '' comment '用户身份证号',
    `real_name`             varchar(255) default '' comment '用户真实姓名',
    `reg_time`              int(10) unsigned default 0 comment '用户注册时间',
    `reg_ip`                varchar(255) default '' comment '用户注册IP',
    `current_login_ip`      varchar(255) default '' comment '用户当前登陆IP',
    `last_login_ip`         varchar(255) default '' comment '用户最后登陆IP',
    `current_login_time`    int(10) unsigned default 0 comment '用户当前登陆时间',
    `last_login_time`       int(10) unsigned default 0 comment '用户最后登陆时间',
    `login_times`           int unsigned default 1 comment '用户登录次数',
    `visit_times`           int unsigned default 0 comment '用户资料被查看次数',
    `role_id`               int unsigned default 0 comment '用户角色ID',
    `allow_login`           tinyint default 1 comment '是否允许登陆',
    `user_status`           varchar(63) default '' comment '用户状态',
    `audit_status`          tinyint default 0 comment '注册审核状态',
    `avatar_src`            varchar(255) default '' comment '用户头像图片路径',
    `nickname`              varchar(255) default '' comment '用户昵称',
    `signature`             varchar(1023) default '' comment '个性签名',
    `birthday_year`         varchar(255) default '' comment '用户生日(年)',
    `birthday_month`        varchar(255) default '' comment '用户生日(月)',
    `birthday_day`          varchar(255) default '' comment '用户生日(日)',
    `country`               varchar(255) default '' comment '国籍',
    `province`              varchar(255) default '' comment '省',
    `city`                  varchar(255) default '' comment '城市',
    `region`                varchar(255) default '' comment '区/县',
    `town`                  varchar(255) default '' comment '镇',
    `address`               varchar(255) default '' comment '更细的自定义输入地址',
    `has_married`           tinyint unsigned default 0 comment '婚姻状况，空为未知，0为未婚，1为没有',
    `qq`                    varchar(255) default '' comment '用户QQ号',
    `sina_weibo`            varchar(255) default '' comment '用户新浪微博号',
    `webchat`               varchar(255) default '' comment '用户微信',
    `user_edu`              varchar(255) default '' comment '用户教育水平',
    `user_job`              varchar(255) default '' comment '职位',
    `monthly_income`        smallint unsigned default 0 comment '月收入',
    `has_house`             tinyint unsigned default 0 comment '是否购房',
    `has_car`               tinyint unsigned default 0 comment '是否有车',
    `drivers_license`       varchar(255) default '' comment '驾驶证图片地址',
    `has_company`           varchar(255) default '' comment '名下是否有公司',
    `user_question`         varchar(255) default '' comment '用户安全问题',
    `user_ansewer`          varchar(255) default '' comment '用户安全问题答案',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '注册项名称',
    `input_type`    varchar(255) default '' comment '注册项输入类型',
    `input_value`   text comment '输入备选值',
    `value_unit`    varchar(255) default '' comment '值的单位',
    `accept_type`   varchar(255) default '' comment '允许上传的文件类型',
    `order_number`  int unsigned default 0 comment '排序',
    `add_show`      tinyint unsigned default 0 comment '注册时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '注册项ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `fields_value`  varchar(255) default '' comment '注册项值',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `login_ip`      varchar(255) default '' comment '用户登陆IP',
    `login_time`    int(10) unsigned default 0 comment '用户登陆时间',
    `ips`           text comment 'IP所在地理位置',
    `region_id`     int unsigned default 0 comment '地理位置表中，位置ID',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '权限名称',
    `class`         varchar(255) default '' comment '控制器类名',
    `method`        varchar(255) default '' comment '方法名',
    `description`   text comment '权限描述',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `privilege_id`  int unsigned default 0 comment '权限ID',
    `role_id`       int unsigned default 0 comment '角色ID',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '角色名称',
    `description`   text comment '备注介绍',
    `level`         int unsigned default 0 comment '角色级别',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `group_name`    varchar(255) default '' comment '分组名称',
    `group_level`   int unsigned default 0 comment '分组级别',
    `description`   varchar(1023) comment '备注介绍',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(255) default '' comment '积分Code',
    `name`          varchar(63) default '' comment '积分名称',
    `unit`          varchar(63) default '' comment '积分单位',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `type_id`       int unsigned default 0 comment '积分类型ID',
    `value`         int unsigned default 0 comment '积分个数',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '日志插入时间',
    `update_time`   int(10) unsigned default 0 comment '日志更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `user_rank_id` int unsigned default 0 comment '用户ID',
    `chang_sign`   tinyint unsigned default 0 comment '积分变更标识，1-增加，-1-减少',
    `value`        int default 0 comment '积分变更值',
    `change_thing` varchar(255) default '' comment '积分变更事件描述',
    `create_time`  int(10) unsigned default 0 comment '日志插入时间',
    `create_user`  int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `uid_master`    int unsigned default 0 comment '关系主用户ID ',
    `uid_slave`     int unsigned default 0 comment '关系从用户ID ',
    `group_id`      int unsigned default 0 comment '所属关系分组 ',
    `type`          varchar(255) default '' comment '关系类型 ',
    `value`         tinyint unsigned default 0 comment '关系值',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '关系添加时间 ',
    `update_time`   int(10) unsigned default 0 comment '关系更新时间 ',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `name`          varchar(255) default '' comment '分类名称',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `master_user_id`   int unsigned default 0 comment '主用户ID',
    `slave_user_id`    int unsigned default 0 comment '客人用户ID',
    `type`             varchar(255) default '' comment '访问类型',
    `visit_time`       int(10) unsigned default 0 comment '访问时间',
    `visit_hide`       tinyint unsigned default 0 comment '隐身访问',
    `is_deleted`       tinyint unsigned default 0 comment '标记删除',
    `visitor_ip`       varchar(64) default '' comment '访客IP',
    `visitor_country`  varchar(63) default '' comment '访客国家',
    `visitor_province` varchar(63) default '' comment '访客省',
    `visitor_cityp`    varchar(63) default '' comment '访客市区',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `recvier_user_id`   int unsigned default 0 comment '接收人用户ID',
    `sender_user_id`    int unsigned default 0 comment '发送人用户ID',
    `title`             varchar(1023) default '' comment '私信标题',
    `content`           text comment '私信内容',
    `send_time`         int(10) unsigned default 0 comment '发送时间',
    `is_read`           tinyint unsigned default 0 comment '是否已读',
    `read_time`         int(10) unsigned default 0 comment '阅读时间',
    `delete_time`       int(10) unsigned default 0 comment '删除时间',
    `is_recycle`        tinyint unsigned default 0 comment '是否放入回收站',
    `recycle_time`      int(10) unsigned default 0 comment '回收时间',
    `is_emergency`      tinyint unsigned default 0 comment '是否紧急',
    `is_timing_auto`    tinyint unsigned default 0 comment '是否定时发送',
    `auto_send_time`    int(10) unsigned default 0 comment '定时发送时间',
    `is_time_limit`     tinyint unsigned default 0 comment '是否具有有效期',
    `limit_time_end`    int(10) unsigned default 0 comment '失效时间',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `top_time_start`    int(10) unsigned default 0 comment '置顶开始时间',
    `top_time_end`      int(10) unsigned default 0 comment '置顶结束时间',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `message_id`     int unsigned default 0 comment '被操作消息ID',
    `act_user_id`    int unsigned default 0 comment '用户ID',
    `act_type`       varchar(10) default '' comment '操作类型',
    `actor_ip`       varchar(64) default '' comment '操作者IP',
    `actor_browser`  varchar(63) default '' comment '操作者浏览器',
    `actor_os`       varchar(63) default '' comment '操作者操作系统',
    `actor_language` varchar(63) default '' comment '操作者浏览器语言',
    `actor_country`  varchar(63) default '' comment '操作者国家',
    `actor_province` varchar(63) default '' comment '操作者省',
    `actor_city`     varchar(63) default '' comment '操作者市',
    `create_time`    int(10) unsigned default 0 comment '操作时间',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `money_total`   decimal(10, 2) comment '总用户余额',
    `money_borrow`  decimal(10, 2) comment '借款数额',
    `money_invest`  decimal(10, 2) comment '投资数额',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '图片添加时间',
    `update_time`   int(10) unsigned default 0 comment '图片更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `user_id`               int unsigned default 0 comment '用户ID',
    `real_name`             varchar(32) default '' comment '真实姓名',
    `bank_id`               int unsigned default 0 comment '银行卡类型',
    `bank_no`               varchar(255) default '' comment '银行卡号',
    `account_bank_address`  varchar(255) default '' comment '开户行地点',
    `front_pic_src`         varchar(255) default '' comment '正面照片保存地址',
    `is_enable`             tinyint unsigned default 1 comment '是否有效',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '上传时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '银行名称',
    `code`          varchar(63) default '' comment '银行代码',
    `img_url`       varchar(255) default '' comment '银行logo图标地址',
    `a_href`        varchar(100) default '' comment '银行链接地址',
    `description`   text comment '银行描述信息',
    `order_number`  int unsigned default 0 comment '排序',
    `is_commend`    tinyint unsigned default 0 comment '是否推荐',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '上传时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `user_id`       int unsigned default 0 comment '用户ID',
    `property_id`   int unsigned default 0 comment '资产类型ID',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '上传时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `fields_id`     int unsigned default 0 comment '字段ID',
    `fields_value`  varchar(255) default '' comment '字段值',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '资产类型名称',
    `order_number`  int unsigned default 0 comment '排序',
    `add_show`      tinyint unsigned default 0 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `property_id`   int unsigned default 0 comment '资产类型ID',
    `name`          varchar(255) default '' comment '资产类型名称',
    `input_type`    varchar(255) default '' comment '输入方式',
    `input_value`   text comment '输入备选值',
    `value_unit`    varchar(255) default '' comment '值的单位',
    `accept_type`   varchar(255) default '' comment '允许上传的文件类型',
    `add_show`      tinyint unsigned default 0 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `user_id`       int unsigned default 0 comment '外键用户ID',
    `type_id`       varchar(20) default '' comment '外键认证方式ID',
    `message`       text comment '申请审核留言',
    `status`        tinyint default 0 comment '认证状态 0-审核中 1-已通过验证 -1-未通过验证',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                    int unsigned auto_increment comment '编号',
    `user_certification_id` int unsigned default 0 comment '外键认证ID',
    `actor_user_id`         int unsigned default 0 comment '操作人ID',
    `reason`                varchar(255) default '' comment '处理原因',
    `description`           varchar(255) default '' comment '操作留下的备注信息,留给系统查看',
    `status`                tinyint default 0 comment '处理结果 0-审核中 1-已通过验证 -1-未通过验证',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `create_user`           int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '认证方式名称，如“身份证认证”、“手机认证”、“邮箱认证”、“实地认证”’',
    `code`          varchar(100) default '' comment '认证方式code',
    `img_src`       varchar(255) default '' comment '认证方式对应显示的图片',
    `img_alt`       varchar(255) default '' comment '认证方式对应显示的图片alt属性',
    `description`   varchar(255) default '' comment '认证方式备注信息',
    `requirement`   text comment '必要条件介绍',
    `tips`          varchar(1023) default '' comment '上传时小提示',
    `point`         int unsigned default 0 comment '认证通过加分值',
    `add_show`      tinyint unsigned default 0 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `order_number`  int unsigned default 0 comment '认证方式显示排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '认证方式类型添加时间',
    `update_time`   int(10) unsigned default 0 comment '认证方式类型修改时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '注册项名称',
    `type_id`       int unsigned default 0 comment '认证类型ID',
    `input_type`    varchar(255) default '' comment '注册项输入类型',
    `input_value`   text comment '输入备选值',
    `accept_type`   varchar(255) default '' comment '允许上传的文件类型',
    `value_unit`    varchar(255) default '' comment '值的单位',
    `order_number`  int unsigned default 0 comment '排序',
    `add_show`      tinyint unsigned default 1 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '注册项ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `fields_value`  varchar(255) default '' comment '注册项值',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `pid`               int unsigned default 0 comment '所属父部门',
    `name`              varchar(255) default '' comment '部门名称',
    `english_name`      varchar(255) default '' comment '英文名称',
    `short_name`        varchar(255) default '' comment '部门名称缩写',
    `img_src`           varchar(255) default '' comment '部门图片logo地址',
    `description`       text comment '部门介绍',
    `manager_job_id`    int unsigned default 0 comment '部门管理职位ID，员工表中某员工的职位ID与此相同，则表明该员工为部门管理员',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint default 1 comment '是否有效',
    `is_deleted`        tinyint default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `borrow_id`     int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '借款属性值',
    `fields_price`  decimal(10, 2) comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `department_id` int unsigned default 0 comment '部门ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `user_id`       int unsigned default 0 comment '用户ID',
    `department_id` int unsigned default 0 comment '部门ID',
    `job_id`        int unsigned default 0 comment '职位ID',
    `leader_eid`    int unsigned default 0 comment '上级领导员工ID',
    `recommend_eid` int unsigned default 0 comment '推荐人员工ID',
    `apply_status`  tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `employee_id`   int unsigned default 0 comment '用户ID',
    `actor_user_id` int unsigned default 0 comment '部门ID',
    `status`        tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_id`   int unsigned default 0 comment '职位分类',
    `name`          varchar(255) default '' comment '职位名称',
    `code`          varchar(255) default '' comment '职位代码，一般即缩写',
    `description`   text comment '职位描述',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `category_name` varchar(255) default '' comment '分类名称',
    `category_code` varchar(255) default '' comment '分类代码，一般即缩写',
    `description`   text comment '职位描述',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '商品分类ID',
    `type_id`           int unsigned default 0 comment '类型ID',
    `name`              varchar(255) default '' comment '商品名称',
    `short_desc`        varchar(255) default '' comment '商品短描述',
    `serial`            varchar(64) default '' comment '商品序列号(平台)',
    `shop_price`        decimal(10, 2) comment '商品店铺价格',
    `cost_price`        decimal(10, 2) comment '商品成本价',
    `market_price`      decimal(10, 2) comment '商品市面价格',
    `store_num`         int unsigned default 0 comment '商品库存数目',
    `total_sold_num`    int unsigned default 0 comment '商品已卖出总个数',
    `cover_img_src`     varchar(255) default '' comment '商品封面图片',
    `cover_img_title`   varchar(255) default '' comment '商品封面图片title值',
    `a_href`            varchar(255) default '' comment '商品可链接至外链',
    `a_title`           varchar(255) default '' comment '商品外链title值',
    `is_new`            tinyint unsigned default 1 comment '是否为新',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '平均评分值，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment 'SEO标题',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   varchar(511) default '' comment 'SEO描述',
    `description`       text comment '商品描述详情',
    `user_role_id`      int unsigned default 0 comment '商品查看用户角色',
    `user_rank`         int unsigned default 0 comment '商品查看用户积分',
    `access_password`   varchar(64) default '' comment '查看密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '商品添加时间',
    `update_time`       int(10) unsigned default 0 comment '商品更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `goods_id`      int unsigned default 0 comment '商品ID',
    `name`          varchar(255) default '' comment '配件名称',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `create_time`   int(10) unsigned default 0 comment '商品添加时间',
    `update_time`   int(10) unsigned default 0 comment '商品更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `description`       varchar(1023) default '' comment '分类备注',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接title值',
    `img_src`           varchar(255) default '' comment '分类图标地址',
    `img_title`         varchar(255) default '' comment '分类图标title值',
    `user_role_id`      smallint unsigned default 0 comment '分类访问用户组权限',
    `user_rank`         int unsigned default 0 comment '分类访问用户积分',
    `access_password`   varchar(64) default '' comment '分类访问密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `goods_id`      int unsigned default 0 comment '商品ID',
    `fields_value`  varchar(255) default '' comment '商品属性值',
    `fields_price`  decimal(10, 2) comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '图片添加时间',
    `update_time`   int(10) unsigned default 0 comment '图片更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `uid_master`            int unsigned default 0 comment '业务主ID',
    `uid_slave`             int unsigned default 0 comment '业务客ID',
    `usage_id`              int unsigned default 0 comment '贷款用途(标识ID)，从借款用途表中取得',
    `usage_info`            text comment '借款用途备注',
    `total`                 float default 0.0 comment '贷款额度',
    `year_limit`            varchar(255) default '' comment '贷款年限，带单位，1d-天，2m-2个月，3y-3年',
    `rate`                  float default 0.0 comment '利息',
    `get_money_limit_time`  int(10) unsigned default 0 comment '贷款成功截止期限',
    `get_money_time`        int(10) unsigned default 0 comment '放款时间',
    `repay_money_time`      int(10) unsigned default 0 comment '还款时间',
    `has_colleague`         tinyint unsigned default 0 comment '是否有同行',
    `apply_time`            int(10) unsigned default 0 comment '贷款申请时间(发布时间)',
    `apply_status`          tinyint default 0 comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
    `apply_update_time`     int(10) unsigned default 0 comment '贷款申请最后更新时间',
    `progress_status`       smallint default 0 comment '进行状态，1-下户，2-评级，3-做卷，3-资料审核，4-批贷函，5-贷后管理(开始放款)',
    `progress_update_time`  int(10) unsigned default 0 comment '最后更新时间',
    `order_number`          int unsigned default 0 comment '排序',
    `is_enable`             tinyint default 1 comment '是否有效',
    `is_deleted`            tinyint default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '插入时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `jk_id`         int unsigned default 0 comment '业务主ID',
    `actor_user_id` int unsigned default 0 comment '操作人ID',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `status`        tinyint default 0 comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `jk_id`         int unsigned default 0 comment '业务主ID',
    `actor_user_id` int unsigned default 0 comment '操作人ID',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `status`        smallint default 0 comment '贷款进行状态，1-下户，2-评级，3-做卷，4-资料审核，5-批贷函，6-贷后管理(开始放款)',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '进度插入时间',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `description`       varchar(1023) default '' comment '分类备注',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接title值',
    `img_src`           varchar(255) default '' comment '分类图标地址',
    `img_title`         varchar(255) default '' comment '分类图标title值',
    `user_role_id`      smallint unsigned default 0 comment '分类访问用户组权限',
    `user_rank`         int unsigned default 0 comment '分类访问用户积分',
    `access_password`   varchar(64) default '' comment '分类访问密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用(显示)',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `borrow_id`     int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '借款属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '属性添加时间',
    `update_time`   int(10) unsigned default 0 comment '属性更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '借款用途',
    `code`          varchar(255)comment '代码',
    `description`   text comment '描述',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `user_id`       int unsigned default 0 comment '用户ID',
    `session_id`    varchar(64) default '' comment 'Session字符串',
    `goods_id`      int unsigned default 0 comment '商品ID',
    `goods_buy_num` int unsigned default 0 comment '购买商品个数',
    `goods_attr`    int unsigned default 0 comment '购买商品的属性',
    `order_number`  int unsigned default 0 comment '排序',
    `is_checked`    tinyint unsigned default 0 comment '是否已勾选状态，好方便用户作“结算”、“删除”等操作',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '编号',
    `code`          varchar(50) default '' comment '支付方式英文字段，供后台区分以调用',
    `name`          varchar(50) default '' comment '支付方式名称',
    `service_fee`   decimal(10, 2) default 0.00 comment '支付费用，由网站收取中间费用，还可以是由支付方式决定',
    `config`        text comment '支付方式配置信息，作序列化处理',
    `img_src`       varchar(255) default '' comment '支付方式对应图片logo地址',
    `user_rank`     smallint unsigned default 0 comment '可以使用该支付方式的最低会员级别',
    `description`   text comment '支付方式描述信息',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `sn`                varchar(255) default '' comment '平台订单号',
    `user_id`           int unsigned default 0 comment '下单用户ID',
    `address_id`        int unsigned default 0 comment '地址ID',
    `delivery_status`   tinyint default 0 comment '发货状态',
    `pay_status`        tinyint default 0 comment '订单支付状态',
    `status`            tinyint default 0 comment '订单状态',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `order_id`              int unsigned default 0 comment '订单ID',
    `goods_id`              int unsigned default 0 comment '商品ID',
    `goods_name`            int unsigned default 0 comment '商品名称',
    `goods_serial`          varchar(64) default '' comment '平台编号',
    `goods_short_desc`      varchar(255) default '' comment '商品短描述',
    `goods_attr_serial`     varchar(255) default '' comment '购买的商品属性',
    `goods_shop_price`      decimal(10, 2) comment '商品店铺价格',
    `goods_cost_price`      decimal(10, 2) comment '商品成本价',
    `goods_market_price`    decimal(10, 2) comment '商品市面价格',
    `goods_category_id`     int unsigned default 0 comment '商品分类ID',
    `goods_category_name`   varchar(255) default '' comment '商品分类名称',
    `goods_cover_img_src`   varchar(255) default '' comment '商品封面图片',
    `goods_cover_img_title` varchar(255) default '' comment '商品封面图片title值',
    `goods_a_href`          varchar(255) default '' comment '商品可链接至外链',
    `goods_a_title`         varchar(255) default '' comment '商品外链title值',
    `goods_user_role_id`    int unsigned default 0 comment '商品查看用户角色ID',
    `goods_user_rank`       int unsigned default 0 comment '商品查看用户积分',
    `goods_pwd`             varchar(64) default '' comment '查看密码',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `order_id`      int unsigned default 0 comment '对应订单ID',
    `user_id`       int unsigned default 0 comment '操作用户ID',
    `reason`        text comment '操作原因',
    `description`   text comment '操作留下的备注信息',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `user_id`       int unsigned default 0 comment '买家用户ID',
    `receiver_name` varchar(255) default '' comment '收件人名称',
    `region_id`     int unsigned default 0 comment '地区ID',
    `detail`        varchar(255) default '' comment '详细地址',
    `phone_cell`    varchar(255) default '' comment '买家手机号',
    `phone_fixed`   varchar(255) default '' comment '买家固定电话',
    `order_number`  int unsigned default 0 comment '排序',
    `is_default`    tinyint unsigned default 0 comment '是否为默认',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `name`              varchar(255) default '' comment '快递公司名称',
    `img_src`           varchar(255) default '' comment '快递公司图片logo',
    `company_a_href`    varchar(255) default '' comment '快递公司链接',
    `description`       text comment '快递公司介绍',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `verify_code` varchar(15)  not null default '' comment '验证码',
    `receiver`    varchar(127) not null default '' comment '接收人，可以是手机或者邮件地址',
    `type`        varchar(31) not null default '' comment '验证类型，手机(mobile)或邮件(email)',
    `client_ip`   varchar(63) default '' comment '客户IP地址',
    `status`      tinyint unsigned default 0 comment '验证状态 0-验证中 1-已通过验证 -1-未通过验证',
    `create_time` int(10) unsigned default 0 comment '插入时间',
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
    `receiver`    varchar(127) not null default '' comment '接收人，可以是手机或者邮件地址',
    `content`     text not null comment '发送内容',
    `type`        varchar(31)  not null default '' comment '验证类型，手机(mobile)或邮件(email)',
    `client_ip`   varchar(63) default '' comment '客户IP地址',
    `create_time` int(10) unsigned default 0 comment '插入时间',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(127) not null default '' comment '代码',
    `content`       text not null comment '发送内容',
    `type`          varchar(31) not null default '' comment '模版类型，手机(mobile)或邮件(email)',
    `is_html`       tinyint unsigned default 0 comment '是否是html模版',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(127) not null default '' comment '名称',
    `code`          varchar(127) default '' comment '代码',
    `account`       varchar(127) default '' comment '账户名称',
    `password`      varchar(64) default '' comment '密码',
    `config`        varchar(1023) default '' comment '配置信息',
    `content`       text comment '发送内容',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `uid_master`    int unsigned default 0 comment '关系人主',
    `uid_slave`     int unsigned default 0 comment '关系人客',
    `ship_type`     tinyint default 0 comment '关系类型，friend-好友，customer-客户/业务，partjober-客户/兼职',
    `apply_now`     tinyint default 1 comment '是否立即递交申请',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `actor_user_id` int unsigned default 0 comment '关系人主',
    `customer_id`   int unsigned default 0 comment '关系人客',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `uid_master`    int unsigned default 0 comment '关系人主',
    `uid_slave`     int unsigned default 0 comment '关系人客',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `actor_user_id` int unsigned default 0 comment '关系人主',
    `customer_id`   int unsigned default 0 comment '关系人客',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `updae_user`    int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '物品分类ID',
    `type_id`           int unsigned default 0 comment '类型ID',
    `name`              varchar(255) default '' comment '物品名称',
    `short_desc`        varchar(255) default '' comment '物品短描述',
    `serial`            varchar(64) default '' comment '物品序列号(平台)',
    `shop_price`        decimal(10, 2) default 0.00 comment '物品店铺价格(现价)',
    `original_price`    decimal(10, 2) default 0.00 comment '原价',
    `cost_price`        decimal(10, 2) default 0.00 comment '物品成本价',
    `market_price`      decimal(10, 2) default 0.00 comment '物品市面价格',
    `store_num`         int unsigned default 0 comment '物品库存数目',
    `total_sold_num`    int unsigned default 0 comment '物品已卖出总个数',
    `cover_img_src`     varchar(255) default '' comment '物品封面图片',
    `cover_img_title`   varchar(255) default '' comment '物品封面图片title值',
    `a_href`            varchar(255) default '' comment '物品可链接至外链',
    `a_title`           varchar(255) default '' comment '物品外链title值',
    `is_new`            tinyint unsigned default 1 comment '是否为新',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '文章评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment 'SEO标题',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   varchar(511) default '' comment 'SEO描述',
    `description`       text comment '物品描述详情',
    `user_role_id`      int unsigned default 0 comment '物品查看用户角色',
    `user_rank`         int unsigned default 0 comment '物品查看用户积分',
    `access_password`   varchar(64) default '' comment '查看密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `description`       varchar(1023) default '' comment '分类备注',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接title值',
    `img_src`           varchar(255) default '' comment '分类图标地址',
    `img_title`         varchar(255) default '' comment '分类图标title值',
    `user_role_id`      smallint unsigned default 0 comment '分类访问用户组权限',
    `user_rank`         int unsigned default 0 comment '分类访问用户积分',
    `access_password`   varchar(64) default '' comment '分类访问密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `ware_id`       int unsigned default 0 comment '物品ID',
    `fields_value`  varchar(255) default '' comment '物品属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品相册表';

#----------pre_ware_collect--------------------------------------------------------
/*
 * @doc 积分商品收藏表
 * @author Heanes
 * @time 2015-09-11 09:55:51
*/
drop table if exists `pre_ware_collect`;
create table `pre_ware_ collect` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `ware_id`       int unsigned default 0 comment '产品ID',
    `user_id`       int unsigned default 0 comment '用户',
    `collect_time`  int(10) unsigned default 0 comment '收藏时间',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '积分商品收藏表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_file_type表--------------------------------------------------------
/* 
 * @doc 文件类型表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_type`;
create table `pre_file_type` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `type`          varchar(63) default '' comment '文件类型名称字符串',
    `name`          varchar(63) default '' comment '文件类型描述',
    `description`   text comment '备注介绍',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `desc`              text comment '分类信息介绍',
    `path`              varchar(255) default '' comment '分类存储路径',
    `file_type`         varchar(255) default '' comment '允许存储文件的类型',
    `user_role_id`      int unsigned default 0 comment '允许访问角色',
    `access_password`   varchar(64) default '' comment '访问密码',
    `description`       text comment '备注介绍',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '文件分类ID',
    `real_name`         varchar(255) default '' comment '文件实际名称',
    `name`              varchar(255) default '' comment '文件显示名称',
    `user_role_id`      int unsigned default 0 comment '允许访问角色',
    `access_password`   varchar(64) default '' comment '访问密码',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `act_user_id`       int unsigned default 0 comment '用户ID',
    `act_type`          varchar(10) default '' comment '操作类型',
    `actor_ip`          varchar(64) default '' comment '操作者IP',
    `actor_browser`     varchar(63) default '' comment '操作者浏览器',
    `actor_os`          varchar(63) default '' comment '操作者操作系统',
    `actor_language`    varchar(63) default '' comment '操作者浏览器语言',
    `actor_country`     varchar(63) default '' comment '操作者国家',
    `actor_province`    varchar(63) default '' comment '操作者省',
    `actor_city`        varchar(63) default '' comment '操作者市',
    `act_time`          int(10) unsigned default 0 comment '操作时间',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `create_user`       int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '其他文件上传记录日志表';use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_log_search表--------------------------------------------------------
/* 
 * @doc 搜索记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_log_search`;
create table `pre_log_search` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `string`        varchar(255) default '' comment '搜索关键词',
    `access_url`    varchar(255) default '' comment '搜索操作所在页面',
    `serach_ip`     varchar(64) default '' comment '搜索者IP',
    `country`       varchar(63) default '' comment '搜索者国家',
    `province`      varchar(63) default '' comment '搜索者省',
    `city_name`     varchar(63) default '' comment '搜索者城市名称',
    `device_type`   varchar(63) default '' comment '使用设备类型',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '搜索热词',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '产品分类ID',
    `type_id`           int unsigned default 0 comment '类型ID',
    `name`              varchar(255) default '' comment '产品名称',
    `short_desc`        varchar(255) default '' comment '产品短描述',
    `serial`            varchar(64) default '' comment '产品序列号(平台)',
    `shop_price`        decimal(10, 2) default 0.00 comment '产品店铺价格',
    `cost_price`        decimal(10, 2) default 0.00 comment '产品成本价',
    `market_price`      decimal(10, 2) default 0.00 comment '产品市面价格',
    `store_num`         int unsigned default 0 comment '产品库存数目',
    `total_sold_num`    int unsigned default 0 comment '产品已卖出总个数',
    `cover_img_src`     varchar(255) default '' comment '产品封面图片',
    `a_href`            varchar(255) default '' comment '产品可链接至外链',
    `is_new`            tinyint unsigned default 1 comment '是否为新',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '平均评分值，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment 'SEO标题',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   varchar(511) default '' comment 'SEO描述',
    `description`       text comment '产品描述详情',
    `user_role_id`      int unsigned default 0 comment '产品查看用户角色',
    `user_rank`         int unsigned default 0 comment '产品查看用户积分',
    `access_password`   varchar(64) default '' comment '查看密码',
    #特殊业务字段
    `loan_type`         varchar(255) default '' comment '贷款类型',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `description`       varchar(1023) default '' comment '分类备注',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接title值',
    `img_src`           varchar(255) default '' comment '分类图标地址',
    `img_title`         varchar(255) default '' comment '分类图标title值',
    `user_role_id`      smallint unsigned default 0 comment '分类访问用户组权限',
    `user_rank`         int unsigned default 0 comment '分类访问用户积分',
    `access_password`   varchar(64) default '' comment '分类访问密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default '' comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `as_match`                  tinyint unsigned default 0 comment '是否作为匹配属性',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `product_id`    int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '产品属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品属性映射表';

#----------pre_product_--------------------------------------------------------
/*
 * @doc 产品规格表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_fields_data`;
create table `pre_product_fields_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `product_id`    int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '产品属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
    engine = innodb
    auto_increment = 1
    default charset = `utf8`
    comment '产品规格表';

#----------pre_product_album表--------------------------------------------------------
/*
 * @doc产品相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_album`;
create table `pre_product_album` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `dir_name`      varchar(255) default '' comment '图片实际存储名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `product_id`    int unsigned default 0 comment '产品ID',
    `user_id`       int unsigned default 0 comment '用户',
    `collect_time`  int(10) unsigned default 0 comment '收藏时间',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '产品收藏表';

#----------pre_product_match--------------------------------------------------------
/*
 * @doc 产品属性匹配表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_product_match`;
create table `pre_product_match` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '匹配属性名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '投票名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `product_id`        int unsigned default 0 comment '产品ID',
    `real_name`         varchar(255) default '' comment '姓名',
    `phone`             varchar(63) default '' comment '联系电话',
    `money_want`        varchar(32) default '' comment '贷款额度',
    `loan_type`         tinyint default 0 comment '贷款类型,1-抵押贷款，2-信用贷款',
    `usage_id`          int unsigned default 0 comment '贷款用途ID',
    `usage_desc`        varchar(255) default '' comment '贷款用途',
    `user_ip`           varchar(64) default '' comment '客户IP',
    `is_read`           tinyint unsigned default 0 comment '是否已读',
    `read_time`         int(10) unsigned default 0 comment '阅读时间',
    `had_contact`       tinyint default 0 comment '联系状态',
    `is_handle`         tinyint unsigned default 0 comment '是否已处理',
    `handle_user_id`    int unsigned default 0 comment '最后处理人用户ID',
    `handle_result`     tinyint default 0 comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
    `handle_desc`       varchar(255) default '' comment '处理结果备注',
    `handle_time`       int(10) unsigned default 0 comment '处理时间',
    `is_recycle`        tinyint unsigned default 0 comment '是否放入回收站',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `apply_id`      int unsigned default 0 comment '申请ID',
    `actor_user_id` int unsigned default 0 comment '处理者用户ID',
    `handle_result` tinyint default 0 comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
    `handle_desc`   varchar(255) default '' comment '处理结果备注',
    `log_desc`      text comment '日志说明',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '贷款快速申请数据存储操作记录表';

#----------pre_loan_usage--------------------------------------------------------
/*
 * @doc 贷款用途表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_loan_usage`;
create table `pre_loan_usage` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '用途名称',
    `description`   text comment '用途描述',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '贷款用途表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_special_category--------------------------------------------------------
/*
 * @doc 专题分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_category`;
create table `pre_special_category` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(63) not null default '' comment '分类名称',
    `code`              varchar(63) default '' comment 'code',
    `template_id`       int unsigned default 0 comment '分类模版ID',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接标题',
    `img_src`           varchar(255) default '' comment '分类图标',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   text comment 'SEO描述',
    `description`       text comment '分类介绍',
    `user_role_id`      smallint unsigned default 0 comment '分类阅读用户角色权限',
    `user_rank`         int unsigned default 0 comment '分类阅读用户积分',
    `access_password`   varchar(64) default '' comment '分类阅读密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '专题分类ID',
    `title`             varchar(1023) not null default '' comment '专题标题',
    `subtitle`          varchar(255) default '' comment '专题副标题',
    `cover_img_src`     varchar(255) default '' comment '专题封面图片',
    `user_id`           int unsigned default 0 comment '专题作者(用户)ID',
    `user_link`         varchar(255) default '' comment '专题作者链接',
    `author`            varchar(127) default '' comment '专题作者笔名',
    `editor`            varchar(127) default '' comment '责任编辑',
    `origin_source`     varchar(255) default '' comment '专题来源，为空表示原创',
    `content`           text comment '专题内容',
    `keywords`          varchar(255) default '' comment '关键词',
    `tags`              varchar(255) default '' comment '标签ID，形如1,2,3以逗号分开',
    `semantic_a_href`   varchar(255) default '' comment '语义化链接',
    `a_href`            varchar(255) default '' comment '专题链接',
    `a_title`           varchar(255) default '' comment '专题链接标题',
    `title_bg_color`    varchar(20) default '#FFF' comment '专题标题背景颜色',
    `content_bg_color`  varchar(20) default '#FFF' comment '专题内容背景颜色',
    `template_id`       int unsigned default 0 comment '专题模版ID',
    `template_path`     varchar(255) default '' comment '专题模版路径',
    `template_file`     varchar(255) default '' comment '专题模版文件名称',
    `is_new`            tinyint unsigned default 1 comment '是否为新发布专题',
    `is_promot`         tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '专题评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment '专题SEO标题',
    `seo_keywords`      varchar(511) default '' comment '专题SEO关键词',
    `seo_description`   varchar(511) default '' comment '专题SEO描述',
    `user_role_id`      smallint unsigned default 0 comment '专题阅读用户权限',
    `user_rank`         int unsigned default 0 comment '专题阅读用户积分',
    `access_password`   varchar(64) default '' comment '阅读密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `name`          varchar(63) default '' comment '分类名称',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned default 0 comment '分类排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
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
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `cateogry_id`       int unsigned default 0 comment '模版分类',
    `name`              varchar(63) default '' comment '分类名称',
    `path`              varchar(255) default '' comment '模版路径',
    `file_name`         varchar(127) default '' comment '模版名称',
    `screenshot_src`    varchar(255) default '' comment '模版截图图片路径',
    `description`       text comment '备注介绍',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题模版库表';use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_tools_note--------------------------------------------------------
/*
 * @doc 记事本存储表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_tools_note`;
create table `pre_tools_note` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `user_id`           int unsigned default 0 comment '用户ID',
    `name`              varchar(255) default '' comment '标题',
    `content`           text comment '内容',
    `access_password`   varchar(64) default '' comment '阅读密码',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '备忘录、笔记本';# use `doctor.heanes.com`;
set foreign_key_checks = 0;

#----------pre_medical_record--------------------------------------------------------
/*
 * @doc 病案纪录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
 */
drop table if exists `pre_medical_record`;
create table `pre_medical_record` (
    `id`                               int unsigned auto_increment comment '自增ID，主键',
    `pay_type`                         tinyint unsigned default 0 comment  '付款方式',
    `patient_id`                       int unsigned default 0 comment '患者ID',
    `contact_user_name`                varchar(255) default '' comment '联系人姓名',
    `contact_relationship`             varchar(31) default '' comment '联系人关系',
    `contact_address`                  varchar(255) default '' comment '联系人地址',
    `contact_phone`                    varchar(31) default '' comment '联系人电话',
    `get_in_hospital_time`             int unsigned default 0 comment '入院时间',
    `get_out_hospital_time`            int unsigned default 0 comment '入院时间',
    `hospital_room`                    varchar(63) default '' comment '病房',
    `real_time_in_hospital`            float unsigned default 0 comment '实际住院天数',
    `clinic diagnosis`                 varchar(255) default '' comment '门诊诊断',
    `kezhuren`                         varchar(63) default '' comment '科主任',
    `zhuren_yishi`                     varchar(63) default '' comment '主任医师',
    `zhuzhi_yishi`                     varchar(63) default '' comment '主治医师',
    `zhuyuan_yishi`                    varchar(63) default '' comment '住院医师',
    `zeren_hushi`                      varchar(63) default '' comment '进修医师',
    `shixi_yishi`                      varchar(63) default '' comment '实习医师',
    `bianmayuan`                       varchar(63) default '' comment '编码员',
    `disease_quantity`                 tinyint unsigned default 0 comment '病案质量,1-甲,2-乙,3-丙',
    `zhikong_yishi`                    varchar(63) default '' comment '质控医师',
    `zhikog_hushi`                     varchar(63) default '' comment '质控护士',
    `zhikong_date`                     varchar(63) default '' comment '质控日期',
    `get_out_hospital_type`            tinyint unsigned default 0 comment '1-医嘱离院,2-医嘱转院,3-医嘱转社区卫生服务机构/乡镇卫生院,4-非医嘱离院,5-死亡,9-其他',
    `admit_hospital_type2`             varchar(255) default '' comment '拟接受医疗机构名称',
    `admit_hospital_type3`             varchar(255) default '' comment '拟接受医疗机构名称',
    `come_again_in_month`              tinyint unsigned default 0 comment '是否有出院31天内再住院计划,1-无,2-有',
    `come_again_purpose`               varchar(255) default '' comment '再住院目的',
    `head_harm_coma_time_before_day`   varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间天数',
    `head_harm_coma_time_before_hours` varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间小时数',
    `head_harm_coma_time_before_min`   varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间分钟数',
    `head_harm_coma_time_after_day`    varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间天数',
    `head_harm_coma_time_after_hours`  varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间小时数',
    `head_harm_coma_time_after_min`    varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间分钟数',
    `case_type`                        tinyint unsigned default 0 comment '病例分型,1-A,2-B,3-C,4-D',
    `has_ICU`                          tinyint unsigned default 0 comment '是否实施重症监护,1-无,2-有',
    `ICU_time_day`                     int unsigned default 0 comment '重症监护天数',
    `ICU_time_hours`                   int unsigned default 0 comment '重症监护小时数',
    `is_single_entity`                 tinyint unsigned default 0 comment '是否单病种管理,1-是,2-否',
    `clinic_manage`                    tinyint unsigned default 0 comment '实施临床路径管理,1-未进入,2-变异推出,3-完成',
    `DRGs_manage`                      tinyint unsigned default 0 comment '实施DGRs管理,1-无,2-按病种,3-按费用,4-两种都有',
    `use_antibiotic`                   tinyint unsigned default 0 comment '使用抗生素,1-使用,2-未使用',
    `bacteria_culture_check`           tinyint unsigned default 0 comment '细菌培养标本送检,1-是,2-否',
    `legal_infectious_diseases`        tinyint unsigned default 0 comment '法定传染病,1-甲类,2-乙类,3-丙类,4-未定',
    `cancer_stage`                     tinyint unsigned default 0 comment '肿瘤分期',
    `baby_apgar_score`                 int unsigned default 0 comment '新生儿Apgar评分',
    primary key (`id`),
    foreign key(patient_id) references `pre_patient`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '病案纪录表';

#----------pre_patient--------------------------------------------------------
/*
 * @doc 患者数据表
 * @author Heanes
 * @time 2015-02-09 14:19:41
 */
drop table if exists `pre_patient`;
create table `pre_patient` (
    `id`                          int unsigned auto_increment comment '自增ID，主键',
    `user_name`                   varchar(255) default '' comment '患者姓名',
    `gender`                      tinyint unsigned default 0 comment '性别',
    `birthday_year`               varchar(4) default '' comment '出生年份',
    `birthday_month`              varchar(2) default '' comment '出生月份',
    `birthday_date`               varchar(2) default '' comment '出生日期',
    `age`                         smallint unsigned default 0 comment '年龄',
    `country`                     varchar(255) default '' comment '国家',
    `baby_age_count_month`        int unsigned default 0 comment '新生儿年龄月数',
    `baby_weight_born`            varchar(6) default '' comment '新生儿出生体重',
    `baby_weight_now`             varchar(6) default '' comment '新生儿入院体重',
    `address_born`                varchar(255) default '' comment '出生地地址',
    `address_now`                 varchar(255) default '' comment '现居住地',
    `address_now_postcode`        char(6) comment '现在所在地邮编',
    `address_registered`          varchar(255) default '' comment '户口地址',
    `address_registered_postcode` char(6) comment '户口所在地邮编',
    `mobile`                      varchar(31) default '' comment '电话',
    `address_job`                 varchar(255) default '' comment '工作单位及地址',
    `job_phone`                   varchar(63) default '' comment '单位电话',
    `job_postcode`                char(6) comment '工作地邮编',
    `native_place`                varchar(255) default '' comment '籍贯 ',
    `nation`                      varchar(63) default '' comment '民族',
    `id_card`                     varchar(31) default '' comment '身份证号',
    `job`                         varchar(63) default '' comment '职业',
    `marriage`                    tinyint unsigned default 0 comment '婚姻情况,0-未婚,1-已婚,2-丧偶,3-离婚,4-其他',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者信息表';

#----------pre_patient_disease--------------------------------------------------------
/*
 * @doc 患者诊断疾病表
 * @author Heanes
 * @time
 */
drop table if exists `pre_patient_disease`;
create table `pre_patient_disease` (
    `id`                            int unsigned auto_increment comment '自增ID，主键',
    `case_id`                       int unsigned default 0 comment '病案ID',
    `chuyuan_diagnose`              varchar(63) default '' comment '出院诊断(病名)',
    `is_primary`                    tinyint unsigned default 0 comment '是否是主要诊断,不是则为其他诊断',
    `disease_code`                  varchar(10) default '' comment '疾病编码',
    `ruyuan_disease_type`           tinyint unsigned default 0 comment '入院病情类型,1-有,2-临床未确定,3-情况不明,4-无',
    `harm_poisoning_cause`          varchar(255) default '' comment '损伤,中毒的外部因素',
    `harm_poisoning_cause_dcode`    varchar(10) default '' comment '损伤中毒的外部因素疾病编码',
    `pathology_diagnose`            varchar(255) default '' comment '病理诊断',
    `pathology_diagnose_dcode`      varchar(10) default '' comment '病理诊断疾病编码',
    `pathology_diagnose_slice_code` varchar(10) default '' comment '病理切片号',
    `drug_allergy`                  tinyint unsigned default 0 comment '药物过敏史,0-无,1-有',
    `drug_allergy_medicine`         varchar(255) default '' comment '过敏药物',
    `dead_patient_body_check`       tinyint unsigned default 0 comment '死亡患者尸检,0-否,1-是',
    `blood_type`                    varchar(2) default '' comment '血型,1-A,2-B,3-O,4-AB,5-不详,6-未查',
    `blood_rh`                      tinyint unsigned default 0 comment '血型Rh,1-阴性,2-阳性,3-不详,4-未查',
    primary key (`id`),
    foreign key(`case_id`) references `pre_medical_record`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者诊断疾病表';

#----------pre_doctors--------------------------------------------------------
/*
 * @doc 诊断人数据表
 * @author Heanes
 * @time
 */
drop table if exists `pre_doctors`;
create table `pre_doctors` (
    `id`             int unsigned auto_increment comment '自增ID，主键',
    `user_name`      varchar(31) default '' comment '医师姓名',
    `id_card`        varchar(31) default '' comment '身份证号',
    `doc_level`      varchar(32) default '' comment '医师级别ID',
    `doc_gender`     tinyint unsigned default 0 comment '医师性别',
    `doc_work_year`  float comment '从业年龄',
    `mobilie`        varchar(14) default '' comment '联系电话',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医师信息表';

#----------pre_diagnose_operation--------------------------------------------------------
/*
 * @doc 病案手术信息
 * @author Heanes
 * @time
 */
drop table if exists `pre_diagnose_operation`;
create table `pre_diagnose_operation` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `case_id`           int unsigned default 0 comment '病案ID',
    `op_id`             int unsigned default 0 comment '手术ID',
    `op_level`          smallint unsigned default 0 comment '手术级别',
    `op_uid`            int unsigned default 0 comment '手术操作人',
    `op_helper1`        int unsigned default 0 comment '手术操作I助理',
    `op_helper2`        int unsigned default 0 comment '手术操作II助理',
    `notch_heal_level`  smallint unsigned default 0 comment '伤口愈合等级',
    `anesthesia_type`   tinyint unsigned default 0 comment '麻醉方式,0-全身麻醉,1-局部麻醉',
    `anesthesia_uid`    int unsigned default 0 comment '麻醉医师用户ID',
    `create_time`       int unsigned default 0 comment '手术操作日期',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`case_id`) references `pre_medical_record`(`id`),
    foreign key(`op_id`) references `pre_operation`(`id`),
    foreign key(`op_uid`) references `pre_doctors`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '病案手术信息';

#----------pre_operation--------------------------------------------------------
/*
 * @doc 手术信息库
 * @author Heanes
 * @time
 */
drop table if exists `pre_operation`;
create table `pre_operation` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(10) default '' comment '手术操作编码',
    `name`          varchar(255) default '' comment '手术及操作名称',
    `category`      int unsigned default 0 comment '手术类别',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '手术信息库';

#----------pre_patient_drugs--------------------------------------------------------
/*
 * @doc 患者用药表
 * @author Heanes
 * @time
 */
drop table if exists `pre_patient_drugs`;
create table `pre_patient_drugs` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `patient_id`        int unsigned default 0 comment '患者ID',
    `drug_id`           int unsigned default 0 comment '药品ID',
    `drug_name`         int unsigned default 0 comment '药品名称',
    `unit`              varchar(255) default '' comment '用药单位',
    `quantity`          int unsigned default 0 comment '用药数量',
    `remark`            varchar(255) default '' comment '用药备注',
    `doctor_id`         int unsigned default 0 comment '开药医师',
    `feed_doctor_id`    int unsigned default 0 comment '用药医师',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`patient_id`) references `pre_patient`(`id`),
    foreign key(`drug_id`) references `pre_drugs`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者用药表';

#----------pre_drugs--------------------------------------------------------
/*
 * @doc 药品库表
 * @author Heanes
 * @time
 */
drop table if exists `pre_drugs`;
create table `pre_drugs` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_id`   int unsigned default 0 comment '药品类别',
    `serial_no`     varchar(12) default '' comment '药品序列号',
    `code`          varchar(10) default '' comment '简称代码',
    `name`          varchar(255) default '' comment '名称',
    `unit`          varchar(4) default '' comment '单位',
    `price`         decimal comment '价格',
    `stock`         int unsigned default 0 comment '库存数量',
    `storage`       varchar(255) default '' comment '存储位置',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '药品库表';

#----------pre_drugs--------------------------------------------------------
/*
 * @doc 药品库分类表
 * @author Heanes
 * @time
 */
drop table if exists `pre_drugs`;
create table `pre_drugs` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '名称',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '药品库分类表';

#----------pre_hospital_department--------------------------------------------------------
/*
 * @doc 入院科别库
 * @author Heanes
 * @time
 */
drop table if exists `pre_hospital_department`;
create table `pre_hospital_department` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '入院科别名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '入院科别库';

#----------pre_sick_room--------------------------------------------------------
/*
 * @doc 医院病房库
 * @author Heanes
 * @time
 */
drop table if exists `pre_sick_room`;
create table `pre_sick_room` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `num`           varchar(255) default '' comment '病房编号',
    `name`          varchar(255) default '' comment '名称',
    `address`       varchar(255) default '' comment '地址',
    `telephone`     varchar(20) default '' comment '电话',
    `description`   text comment '描述',
    `capacity_num`  smallint unsigned default 0 comment '可住病人最大数量',
    `type`          varchar(255) default '' comment '类别',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医院病房库';

#----------pre_sick_bed--------------------------------------------------------
/*
 * @doc 医院床位资料库
 * @author Heanes
 * @time
 */
drop table if exists `pre_sick_bed`;
create table `pre_sick_bed` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `room_id`       int unsigned default 0 comment '病房编号',
    `name`          smallint unsigned default 0 comment '病床名称',
    `descrpiton`    text comment '描述',
    `type`          varchar(255) default '' comment '病床类别',
    `price`         decimal comment '价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`room_id`) references `pre_sick_room`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医院床位资料库';
