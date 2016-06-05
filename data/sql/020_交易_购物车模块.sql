use `heanes.com`;
set foreign_key_checks = 0;
#---------- pre_shopping_cart表--------------------------------------------------------
/* 
 * @doc 购物车表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_shopping_cart`;
create table `pre_shopping_cart` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned comment '用户ID',
    `session_id`    varchar(64) comment 'Session字符串',
    `goods_id`      int unsigned comment '商品ID',
    `goods_buy_num` int unsigned comment '购买商品个数',
    `goods_attr`    int unsigned comment '购买商品的属性',
    `order_number`  int comment '排序',
    `is_checked`    tinyint comment '是否已勾选状态，好方便用户作“结算”、“删除”等操作',
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
comment '购物车表';