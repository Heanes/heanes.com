use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_log_search表--------------------------------------------------------
/* 
 * @doc 搜索记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_log_search`;
create table `pre_log_search` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `string`        varchar(255) default '' comment '搜索关键词',
    `access_url`    varchar(255) default '' comment '搜索操作所在页面',
    `serach_ip`     varchar(64) default '' comment '搜索者IP',
    `country`       varchar(63) default '' comment '搜索者国家',
    `province`      varchar(63) default '' comment '搜索者省',
    `city_name`     varchar(63) default '' comment '搜索者城市名称',
    `device_type`   varchar(63) default '' comment '使用设备类型',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '搜索记录表';

#----------pre_hot_string表--------------------------------------------------------
/* 
 * @doc 其他搜索关键词热门词表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_hot_string`;
create table `pre_hot_string` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '搜索热词',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '其他搜索关键词热门词表';