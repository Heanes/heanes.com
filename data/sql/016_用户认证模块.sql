use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_user_certification-----------------------------------------------------
/* @doc 用户认证方式信息表
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_user_certification`;
create table `pre_user_certification` (
    `id`            int unsigned auto_increment comment '编号',
    `user_id`       int unsigned default 0 comment '外键用户ID',
    `type_id`       varchar(20) default '' comment '外键认证方式ID',
    `message`       text comment '申请审核留言',
    `status`        tinyint default 0 comment '认证状态 0-审核中 1-已通过验证 -1-未通过验证',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
    engine = innodb
    auto_increment = 1
    default charset = `utf8`
    comment '用户认证信息表';

#----------pre_user_certification_check_log-----------------------------------------------------
/* @doc 用户认证信息审核操作
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_user_certification_check_log`;
create table `pre_user_certification_check_log` (
    `id`                    int unsigned auto_increment comment '编号',
    `user_certification_id` int unsigned default 0 comment '外键认证ID',
    `actor_user_id`         int unsigned default 0 comment '操作人ID',
    `reason`                varchar(255) default '' comment '处理原因',
    `description`           varchar(255) default '' comment '操作留下的备注信息,留给系统查看',
    `status`                tinyint default 0 comment '处理结果 0-审核中 1-已通过验证 -1-未通过验证',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `create_user`           int unsigned default 0 comment '创建人',
    primary key (`id`)
)
    engine = innodb
    auto_increment = 1
    default charset = `utf8`
    comment '用户认证信息审核操作表';

#----------pre_certification_type-----------------------------------------------------
/* @doc 认证方式类别表
 * @author 方刚
 * @time 2014.06.24
*/
drop table if exists `pre_certification_type`;
create table `pre_certification_type` (
    `id`            int unsigned auto_increment comment '编号',
    `name`          varchar(255) default '' comment '认证方式名称，如“身份证认证”、“手机认证”、“邮箱认证”、“实地认证”’',
    `code`          varchar(100) default '' comment '认证方式code',
    `img_src`       varchar(255) default '' comment '认证方式对应显示的图片',
    `img_alt`       varchar(255) default '' comment '认证方式对应显示的图片alt属性',
    `description`   varchar(255) default '' comment '认证方式备注信息',
    `requirement`   text comment '必要条件介绍',
    `tips`          varchar(1023) default '' comment '上传时小提示',
    `point`         int unsigned default 0 comment '认证通过加分值',
    `add_show`      tinyint unsigned default 0 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `order_number`  int unsigned default 0 comment '认证方式显示排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '认证方式类型添加时间',
    `update_time`   int(10) unsigned default 0 comment '认证方式类型修改时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
    engine = innodb
    auto_increment = 1
    default charset = `utf8`
    comment '用户认证方式类别表';

#----------pre_certification_type_fields--------------------------------------------------------c
/*
 * @doc 用户额外属性字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_certification_type_fields`;
create table `pre_certification_type_fields` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '注册项名称',
    `type_id`       int unsigned default 0 comment '认证类型ID',
    `input_type`    varchar(255) default '' comment '注册项输入类型',
    `input_value`   text comment '输入备选值',
    `accept_type`   varchar(255) default '' comment '允许上传的文件类型',
    `value_unit`    varchar(255) default '' comment '值的单位',
    `order_number`  int unsigned default 0 comment '排序',
    `add_show`      tinyint unsigned default 1 comment '注册/添加时是否显示此项',
    `is_required`   tinyint unsigned default 0 comment '是否必须的',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段表';

#----------pre_user_certification_fields_data--------------------------------------------------------
/*
 * @doc 用户额外注册项数据映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_certification_fields_data`;
create table `pre_user_certification_fields_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '注册项ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `fields_value`  varchar(255) default '' comment '注册项值',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户额外属性字段数据映射表';
