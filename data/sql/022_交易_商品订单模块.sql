use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_order_info表--------------------------------------------------------
/* 
 * @doc交易订单基本信息表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_info`;
create table `pre_order_info` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `sn`                varchar(255) default '' comment '平台订单号',
    `user_id`           int unsigned default 0 comment '下单用户ID',
    `address_id`        int unsigned default 0 comment '地址ID',
    `delivery_status`   tinyint default 0 comment '发货状态',
    `pay_status`        tinyint default 0 comment '订单支付状态',
    `status`            tinyint default 0 comment '订单状态',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '交易订单基本信息表';

#----------pre_order_goods表--------------------------------------------------------
/* 
 * @doc订单包含商品表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_goods`;
create table `pre_order_goods` (
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `order_id`              int unsigned default 0 comment '订单ID',
    `goods_id`              int unsigned default 0 comment '商品ID',
    `goods_name`            int unsigned default 0 comment '商品名称',
    `goods_serial`          varchar(64) default '' comment '平台编号',
    `goods_short_desc`      varchar(255) default '' comment '商品短描述',
    `goods_attr_serial`     varchar(255) default '' comment '购买的商品属性',
    `goods_shop_price`      decimal(10, 2) comment '商品店铺价格',
    `goods_cost_price`      decimal(10, 2) comment '商品成本价',
    `goods_market_price`    decimal(10, 2) comment '商品市面价格',
    `goods_category_id`     int unsigned default 0 comment '商品分类ID',
    `goods_category_name`   varchar(255) default '' comment '商品分类名称',
    `goods_cover_img_src`   varchar(255) default '' comment '商品封面图片',
    `goods_cover_img_title` varchar(255) default '' comment '商品封面图片title值',
    `goods_a_href`          varchar(255) default '' comment '商品可链接至外链',
    `goods_a_title`         varchar(255) default '' comment '商品外链title值',
    `goods_user_role_id`    int unsigned default 0 comment '商品查看用户角色ID',
    `goods_user_rank`       int unsigned default 0 comment '商品查看用户积分',
    `goods_pwd`             varchar(64) default '' comment '查看密码',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '订单包含商品表';

#----------pre_order_act_log表--------------------------------------------------------
/* 
 * @doc 交易订单操作记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_order_act_log`;
create table `pre_order_act_log` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `order_id`      int unsigned default 0 comment '对应订单ID',
    `user_id`       int unsigned default 0 comment '操作用户ID',
    `reason`        text comment '操作原因',
    `description`   text comment '操作留下的备注信息',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '交易订单操作记录表';