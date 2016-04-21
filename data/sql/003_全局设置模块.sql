use `heanes.com`;
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
    `parent_id`     int unsigned comment '父ID，用来分组，以方便用户设置',
    `name`          varchar(255) comment '设置项名称',
    `code`          varchar(255) comment '设置项code',
    `input_type`    varchar(127) comment '设置输入形式',
    `input_range`   varchar(255) comment '设置项备选值范围',
    `store_value`   text comment '设置项存储值',
    `order`         int unsigned comment '排序',
    `can_edit`      tinyint unsigned default 1 comment '是否是可编辑项',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
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
    `title`         varchar(255) comment '标题',
    `keywords`      varchar(255) comment '关键词',
    `description`   varchar(255) comment '描述',
    `type`          varchar(127) comment '类型',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) comment '添加时间',
    `update_time`   int(10) comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
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
    `name`          varchar(255) comment '设置项名称',
    `value`         varchar(255) comment '设置项值',
    `type`          varchar(127) comment '设置输入形式',
    `order`         int unsigned comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) comment '添加时间',
    `update_time`   int(10) comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment 'WAP版网站设置表';
