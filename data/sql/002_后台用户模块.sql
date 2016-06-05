use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_admin_user后台菜单表--------------------------------------------------------
/* 
 * @doc 后台菜单表，存储后台菜单
 * @author Heanes
 * @time 2015-01-09 11:53:13
*/
drop table if exists `pre_admin_user`;
create table `pre_admin_user` (
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `user_name`             varchar(63) comment '管理员用户名',
    `user_pwd`              varchar(64)  not null comment '管理员密码',
    `user_email`            varchar(255) comment '管理员邮箱',
    `mobile`                varchar(63) comment '用户手机号',
    `telephone`             varchar(63) comment '用户固定电话',
    `role_id`               int unsigned comment '管理员权限角色ID',
    `role_name`             varchar(63) comment '管理员权限角色名称',
    `allow_login`           tinyint unsigned comment '是否允许登录',
    `login_times`           int unsigned default 0 comment '登录次数',
    `last_login_time`       int(10) unsigned comment '最后登陆时间',
    `current_login_time`    int(10) unsigned comment '当前登陆时间',
    `current_login_ip`      varchar(255) comment '当前登录IP',
    `last_login_ip`         varchar(255) comment '上次登录IP',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `insert_time`           int(10) unsigned comment '添加时间',
    `update_time`           int(10) unsigned comment '更新时间',
    `create_user`           int unsigned comment '创建人',
    `update_user`           int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台管理员用户表';

#----------pre_admin_role后台管理员用户角色权限表--------------------------------------------------------
/* 
 * @doc 后台菜单用户角色权限表，不同角色不同名称
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_admin_role`;
create table `pre_admin_role` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(63) comment '权限code',
    `name`          varchar(63) comment '权限角色名称',
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
comment '后台管理员用户角色权限表';