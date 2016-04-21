use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_express_company表--------------------------------------------------------
/* 
 * @doc 快递公司表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_express_company`;
create table `pre_express_company` (
    `id`             int unsigned auto_increment comment '自增ID，主键',
    `name`           varchar(255) comment '快递公司名称',
    `img_src`        varchar(255) comment '快递公司图片logo',
    `company_a_href` varchar(255) comment '快递公司链接',
    `description`    text comment '快递公司介绍',
    `order`          int unsigned comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) comment '添加时间',
    `update_time`   int(10) comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '快递公司表';