use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_payment-----------------------------------------------------
/* @doc 支付方式类别表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_payment`;
create table `pre_payment` (
    `id`            int unsigned auto_increment comment '编号',
    `code`          varchar(50) comment '支付方式英文字段，供后台区分以调用',
    `name`          varchar(50) comment '支付方式名称',
    `service_fee`   varchar(50) default '0' comment '支付费用，由网站收取中间费用，还可以是由支付方式决定',
    `config`        text comment '支付方式配置信息，作序列化处理',
    `img_src`       varchar(255) comment '支付方式对应图片logo地址',
    `user_rank`     smallint comment '可以使用该支付方式的最低会员级别',
    `description`   text comment '支付方式描述信息',
    `order_number`  int comment '排序',
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
comment '支付方式存储库表';

