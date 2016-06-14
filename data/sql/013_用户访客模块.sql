use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user_visitor表--------------------------------------------------------
/* 
 * @doc 访客关系表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_visitor`;
create table `pre_user_visitor` (
    `id`               int unsigned auto_increment comment '自增ID，主键',
    `master_user_id`   int unsigned default 0 comment '主用户ID',
    `slave_user_id`    int unsigned default 0 comment '客人用户ID',
    `type`             varchar(255) default '' comment '访问类型',
    `visit_time`       int(10) unsigned default 0 comment '访问时间',
    `visit_hide`       tinyint unsigned default 0 comment '隐身访问',
    `is_deleted`       tinyint unsigned default 0 comment '标记删除',
    `visitor_ip`       varchar(64) default '' comment '访客IP',
    `visitor_country`  varchar(63) default '' comment '访客国家',
    `visitor_province` varchar(63) default '' comment '访客省',
    `visitor_cityp`    varchar(63) default '' comment '访客市区',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '访客关系表';