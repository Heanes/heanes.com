use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_file_type表--------------------------------------------------------
/* 
 * @doc 文件类型表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_type`;
create table `pre_file_type` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `type`          varchar(63) comment '文件类型名称字符串',
    `name`          varchar(63) comment '文件类型描述',
    `description`   text comment '备注介绍',
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
comment '文件类型表';

#----------pre_file_category表--------------------------------------------------------
/* 
 * @doc文件分类表 
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_category`;
create table `pre_file_category` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned comment '父分类ID',
    `name`          varchar(255) comment '分类名称',
    `desc`          text comment '分类信息介绍',
    `path`          varchar(255) comment '分类存储路径',
    `file_type`     varchar(255) comment '允许存储文件的类型',
    `user_role_id`  int unsigned comment '允许访问角色',
    `pwd`           varchar(64) comment '访问密码',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned comment '排序',
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
comment '文件分类表';

#----------pre_file表--------------------------------------------------------
/* 
 * @doc 文件信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file`;
create table `pre_file` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_id`   int unsigned comment '文件分类ID',
    `real_name`     varchar(255) comment '文件实际名称',
    `name`          varchar(255) comment '文件显示名称',
    `user_role_id`  int unsigned comment '允许访问角色',
    `pwd`           varchar(64) comment '访问密码',
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
comment '文件信息表';

#----------pre_file_upload_log表--------------------------------------------------------
/* 
 * @doc 其他文件上传记录日志表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_file_upload_log`;
create table `pre_file_upload_log` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `act_user_id`       int unsigned comment '用户ID',
    `act_type`          varchar(10) comment '操作类型',
    `actor_ip`          varchar(64) comment '操作者IP',
    `actor_browser`     varchar(63) comment '操作者浏览器',
    `actor_os`          varchar(63) comment '操作者操作系统',
    `actor_language`    varchar(63) comment '操作者浏览器语言',
    `actor_country`     varchar(63) comment '操作者国家',
    `actor_province`    varchar(63) comment '操作者省',
    `actor_city`        varchar(63) comment '操作者市',
    `act_time`          int(10) unsigned comment '操作时间',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `insert_time`       int(10) unsigned comment '添加时间',
    `create_user`       int unsigned comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '其他文件上传记录日志表';