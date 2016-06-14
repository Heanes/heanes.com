use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_buyer_address表--------------------------------------------------------
/* 
 * @doc 其他表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_buyer_address`;
create table `pre_buyer_address` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '买家用户ID',
    `receiver_name` varchar(255) default '' comment '收件人名称',
    `region_id`     int unsigned default 0 comment '地区ID',
    `detail`        varchar(255) default '' comment '详细地址',
    `phone_cell`    varchar(255) default '' comment '买家手机号',
    `phone_fixed`   varchar(255) default '' comment '买家固定电话',
    `order_number`  int unsigned default 0 comment '排序',
    `is_default`    tinyint unsigned default 0 comment '是否为默认',
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
comment '买家收件地址表';