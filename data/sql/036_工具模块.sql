use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_tools_note--------------------------------------------------------
/*
 * @doc 记事本存储表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_tools_note`;
create table `pre_tools_note` (
	`id`          int unsigned auto_increment comment '自增ID，主键',
	`user_id`     int unsigned comment '用户ID',
	`name`        varchar(255) comment '标题',
	`content`     text comment '内容',
	`pwd`         varchar(64) comment '阅读密码',
	`insert_time` int(10) comment '创建时间',
	`update_time` int(10) comment '更新时间',
	`is_enable`   tinyint unsigned default 1 comment '是否有效',
	`is_delete`   tinyint unsigned default 0 comment '是否已删除',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '备忘录、笔记本';