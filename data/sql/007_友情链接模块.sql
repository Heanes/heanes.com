use `heanes.com`;
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
    `insert_time`   int(10) unsigned default 0 comment '分类添加时间',
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
    `insert_time`   int(10) unsigned default 0 comment '链接添加时间',
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
    `insert_time`   int(10) unsigned default 0 comment '链接添加时间',
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
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '友情链接申请操作记录表';

