use `heanes.com`;
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
