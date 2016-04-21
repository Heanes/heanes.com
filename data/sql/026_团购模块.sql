use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_表--------------------------------------------------------
/*
 * @doc
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
/*
drop table if exists `pre_`;
create table `pre_` (
    `id` int unsigned auto_increment comment '自增ID，主键',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '';
*/