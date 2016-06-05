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
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned comment '用户ID',
    `name`          varchar(255) comment '标题',
    `content`       text comment '内容',
    `pwd`           varchar(64) comment '阅读密码',
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
comment '备忘录、笔记本';