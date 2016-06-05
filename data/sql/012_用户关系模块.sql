use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user_relationship表--------------------------------------------------------
/* 
 * @doc 用户关系映射表，与pre_user_relationship_group表相关
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_relationship`;
create table `pre_user_relationship` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `uid_master`    int unsigned comment '关系主用户ID ',
    `uid_slave`     int unsigned comment '关系从用户ID ',
    `group_id`      int unsigned comment '所属关系分组 ',
    `type`          varchar(255) comment '关系类型 ',
    `value`         tinyint comment '关系值',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '关系添加时间 ',
    `update_time`   int(10) unsigned comment '关系更新时间 ',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户关系映射表，与pre_user_relationship_group表相关';

#----------pre_user_relationship_group表--------------------------------------------------------
/* 
 * @doc 用户关系分组表，存储所有用户设置的分组名称
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_relationship_group`;
create table `pre_user_relationship_group` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned comment '父分类ID',
    `user_id`       int unsigned comment '用户ID',
    `name`          varchar(255) comment '分类名称',
    `order_number`  int unsigned comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `insert_time`   int(10) unsigned comment '添加时间',
    `update_time`   int(10) unsigned comment '更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户关系分组表，存储所有用户设置的分组名称';