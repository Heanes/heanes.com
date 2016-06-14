use `heanes.com`;
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
    `insert_time` int(10) unsigned default 0 comment '插入时间',
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
    `content`     text not null default '' comment '发送内容',
    `type`        varchar(31)  not null default '' comment '验证类型，手机(mobile)或邮件(email)',
    `client_ip`   varchar(63) default '' comment '客户IP地址',
    `insert_time` int(10) unsigned default 0 comment '插入时间',
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
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
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
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '系统外发信息第三方接口配置表';