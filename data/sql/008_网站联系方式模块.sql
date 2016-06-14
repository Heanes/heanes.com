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
    `value`         varchar(255) default '' comment '联系方式途径（值）',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否有效',
    `is_deleted`    tinyint unsigned default 0 comment '是否已删除',
    `insert_time`   int(10) unsigned default 0 comment '插入时间',
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
    `insert_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站留言咨询及投诉建议';
