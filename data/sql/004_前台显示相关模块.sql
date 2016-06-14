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
    `is_enable`                 tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `insert_time`               int(10) unsigned default 0 comment '导航创建时间',
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
    `is_enable`                 tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `insert_time`               int(10) unsigned default 0 comment '导航创建时间',
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
    `is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '幻灯创建时间',
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
    `is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '幻灯创建时间',
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
    `is_enable`                 tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `insert_time`               int(10) unsigned default 0 comment '创建时间',
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
    `is_enable`         tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `insert_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '手机端会员中心菜单库表';