use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_vote--------------------------------------------------------
/*
 * @doc 投票表
 * @author Heanes
 * @time 2015-07-16 16:15:49
*/
drop table if exists `pre_vote`;
create table `pre_vote` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	`name` varchar(255) comment '投票名称',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '投票表';