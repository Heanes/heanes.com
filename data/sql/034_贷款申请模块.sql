use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_money_quick_apply--------------------------------------------------------
/*
 * @doc 贷款快速申请数据存储表
 * @author Heanes
 * @time 2015-07-16 16:15:49
*/
drop table if exists `pre_money_quick_apply`;
create table `pre_money_quick_apply` (
	`id`             int unsigned auto_increment comment '自增ID，主键',
	`product_id`     int unsigned comment '产品ID',
	`real_name`      varchar(255) comment '姓名',
	`phone`          varchar(63) comment '联系电话',
	`money_want`     varchar(32) comment '贷款额度',
	`loan_type`      tinyint comment '贷款类型,1-抵押贷款，2-信用贷款',
	`usage_id`       int unsigned comment '贷款用途ID',
	`usage_desc`     varchar(255) comment '贷款用途',
	`user_ip`        varchar(64) comment '客户IP',
	`is_read`        tinyint unsigned default 0 comment '是否已读',
	`read_time`      int(10) comment '阅读时间',
	`had_contact`    tinyint default 0 comment '联系状态',
	`is_handle`      tinyint unsigned default 0 comment '是否已处理',
	`handle_user_id` int unsigned comment '最后处理人用户ID',
	`handle_result`  tinyint comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
	`handle_desc`    varchar(255) comment '处理结果备注',
	`handle_time`    int(10) comment '处理时间',
	`is_recycle`     tinyint unsigned default 0 comment '是否放入回收站',
	`is_top`         tinyint(10) comment '是否置顶',
	`order`          int unsigned comment '排序',
	`insert_time`    int(10) comment '添加时间',
	`update_time`    int(10) comment '更新时间',
	`is_enable`      tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`      tinyint unsigned default 0 comment '是否删除',
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
	`apply_id`      int comment '申请ID',
	`actor_user_id` int unsigned comment '处理者用户ID',
	`handle_result` tinyint comment '处理结果，0-未知，1-符合要求，-1,-不符合要求',
	`handle_desc`   varchar(255) comment '处理结果备注',
	`log_desc`      text comment '日志说明',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '更新时间',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`     tinyint unsigned default 0 comment '是否删除',
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
	`id` int unsigned auto_increment comment '自增ID，主键',
	`name` varchar(255) comment '用途名称',
	`description` text comment '用途描述',
	`order`         int unsigned comment '排序',
	`insert_time`   int(10) comment '添加时间',
	`update_time`   int(10) comment '更新时间',
	`is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
	`is_delete`     tinyint unsigned default 0 comment '是否删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '贷款用途表';