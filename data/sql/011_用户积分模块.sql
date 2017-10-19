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
comment '积分变更记录表';