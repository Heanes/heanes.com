use `heanes.com`;
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
comment '消息操作日志表';