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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '投票名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
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
comment '投票表';