use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_web_visitor表--------------------------------------------------------
/* 
 * @doc 网站访问统计表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_web_visitor`;
create table `pre_web_visitor` (
    `id`          int unsigned auto_increment comment '自增ID，主键',
    `access_url`  varchar(255) comment '访客访问页面',
    `refer_url`   varchar(255) comment '来源页面',
    `ip`          varchar(64) comment '访客IP',
    `borwser`     varchar(255) comment '访客浏览器信息',
    `os`          varchar(255) comment '访客操作系统信息',
    `language`    varchar(63) comment '访客地域语言',
    `country`     varchar(63) comment '访客所在国家',
    `province`    varchar(63) comment '访客所在省',
    `city`        varchar(63) comment '访客所在市',
    `visit_time`  int(10) unsigned comment '访问时间',
    `leave_time`  int(10) unsigned comment '访客离开时间',
    `visit_times` int unsigned comment '访问次数',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '网站访问统计表';

