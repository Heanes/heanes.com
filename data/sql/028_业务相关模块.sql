use `heanes.com`;
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
    `uid_master`    int unsigned comment '关系人主',
    `uid_slave`     int unsigned comment '关系人客',
    `ship_type`     tinyint comment '关系类型，friend-好友，customer-客户/业务，partjober-客户/兼职',
    `apply_now`     tinyint default 1 comment '是否立即递交申请',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '添加时间',
    `update_time`   int(10) unsigned comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
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
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '添加时间',
    `create_user`   int unsigned comment '创建人',
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
    `uid_master`    int unsigned comment '关系人主',
    `uid_slave`     int unsigned comment '关系人客',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '添加时间',
    `update_time`   int(10) unsigned comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
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
    `actor_user_id` int unsigned comment '关系人主',
    `customer_id`   int unsigned comment '关系人客',
    `status`        tinyint default 0 comment '关系状态，0-审核中，1-已通过，2-已拒绝',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '添加时间',
    `create_user`   int unsigned comment '创建人',
    `updae_user`    int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '兼职人员关系申请审核记录表';



