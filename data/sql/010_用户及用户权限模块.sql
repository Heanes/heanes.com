use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_user表--------------------------------------------------------
/* 
 * @doc 会员信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user`;
create table `pre_user` (
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `user_name`             varchar(255) not null unique comment '用户名',
    `user_pwd`              varchar(64)  not null default '' comment '用户密码',
    `user_email`            varchar(255) default '' comment '用户Email',
    `mobile`                varchar(63) default '' comment '用户手机号',
    `telephone`             varchar(63) default '' comment '用户固定电话',
    `age`                   smallint unsigned default 0 comment '用户年龄',
    `gender`                tinyint unsigned default 0 comment '用户性别',
    `idcard`                varchar(50) default '' comment '用户身份证号',
    `real_name`             varchar(255) default '' comment '用户真实姓名',
    `reg_time`              int(10) unsigned default 0 comment '用户注册时间',
    `reg_ip`                varchar(255) default '' comment '用户注册IP',
    `current_login_ip`      varchar(255) default '' comment '用户当前登陆IP',
    `last_login_ip`         varchar(255) default '' comment '用户最后登陆IP',
    `current_login_time`    int(10) unsigned default 0 comment '用户当前登陆时间',
    `last_login_time`       int(10) unsigned default 0 comment '用户最后登陆时间',
    `login_times`           int unsigned default 1 comment '用户登录次数',
    `visit_times`           int unsigned default 0 comment '用户资料被查看次数',
    `role_id`               int unsigned default 0 comment '用户角色ID',
    `allow_login`           tinyint default 1 comment '是否允许登陆',
    `user_status`           varchar(63) default '' comment '用户状态',
    `audit_status`          tinyint default 0 comment '注册审核状态',
    `avatar_src`            varchar(255) default '' comment '用户头像图片路径',
    `nickname`              varchar(255) default '' comment '用户昵称',
    `signature`             varchar(1023) default '' comment '个性签名',
    `birthday_year`         varchar(255) default '' comment '用户生日（年）',
    `birthday_month`        varchar(255) default '' comment '用户生日（月）',
    `birthday_day`          varchar(255) default '' comment '用户生日（日）',
    `country`               varchar(255) default '' comment '国籍',
    `province`              varchar(255) default '' comment '省',
    `city`                  varchar(255) default '' comment '城市',
    `region`                varchar(255) default '' comment '区/县',
    `town`                  varchar(255) default '' comment '镇',
    `address`               varchar(255) default '' comment '更细的自定义输入地址',
    `has_married`           tinyint unsigned default 0 comment '婚姻状况，空为未知，0为未婚，1为没有',
    `qq`                    varchar(255) default '' comment '用户QQ号',
    `sina_weibo`            varchar(255) default '' comment '用户新浪微博号',
    `webchat`               varchar(255) default '' comment '用户微信',
    `user_edu`              varchar(255) default '' comment '用户教育水平',
    `user_job`              varchar(255) default '' comment '职位',
    `monthly_income`        smallint unsigned default 0 comment '月收入',
    `has_house`             tinyint unsigned default 0 comment '是否购房',
    `has_car`               tinyint unsigned default 0 comment '是否有车',
    `drivers_license`       varchar(255) default '' comment '驾驶证图片地址',
    `has_company`           varchar(255) default '' comment '名下是否有公司',
    `user_question`         varchar(255) default '' comment '用户安全问题',
    `user_ansewer`          varchar(255) default '' comment '用户安全问题答案',
    `is_enable`             tinyint unsigned default 1 comment '是否启用',
    `is_deleted`            tinyint unsigned default 0 comment '是否删除',
    `create_time`           int(10) unsigned default 0 comment '添加时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 10001
default charset = `utf8`
comment '会员信息表';

#----------pre_user_field--------------------------------------------------------c
/* 
 * @doc 用户额外属性字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_field`;
create table `pre_user_field` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '注册项名称',
    `input_type`    varchar(255) default '' comment '注册项输入类型',
    `input_value`   text comment '输入备选值',
    `value_unit`    varchar(255) default '' comment '值的单位',
    `accept_type`   varchar(255) default '' comment '允许上传的文件类型',
    `order_number`  int unsigned default 0 comment '排序',
    `add_show`      tinyint unsigned default 0 comment '注册时是否显示此项',
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

#----------pre_user_field_data--------------------------------------------------------
/* 
 * @doc 用户额外注册项数据映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_field_data`;
create table `pre_user_field_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `field_id`      int unsigned default 0 comment '注册项ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `fields_value`  varchar(255) default '' comment '注册项值',
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
comment '用户额外属性字段数据映射表';

#----------pre_user_login_log表--------------------------------------------------------
/*
 * @doc 用户登录记录表
 * @author Heanes
 * @time 2015-07-05 01:02:09
*/
drop table if exists `pre_user_login_log`;
create table `pre_user_login_log` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `login_ip`      varchar(255) default '' comment '用户登陆IP',
    `login_time`    int(10) unsigned default 0 comment '用户登陆时间',
    `ips`           text comment 'IP所在地理位置',
    `region_id`     int unsigned default 0 comment '地理位置表中，位置ID',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
    engine = innodb
    auto_increment = 1
    default charset = `utf8`
    comment '用户登录记录表';

#----------pre_privilege_url--------------------------------------------------------
/*
 * @doc 功能权限存储库表
 * @author Heanes
 * @time 2015-07-13 12:47:10
*/
drop table if exists `pre_privilege_url`;
create table `pre_privilege_url` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '权限名称',
    `class`         varchar(255) default '' comment '控制器类名',
    `method`        varchar(255) default '' comment '方法名',
    `description`   text comment '权限描述',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户权限表';

#----------pre_user_privilege--------------------------------------------------------
/*
 * @doc 用户权限表
 * @author Heanes
 * @time 2015-07-13 12:47:10
*/
drop table if exists `pre_user_privilege`;
create table `pre_user_privilege` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `privilege_id`  int unsigned default 0 comment '权限ID',
    `role_id`       int unsigned default 0 comment '角色ID',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户权限表';

#----------pre_user_role表--------------------------------------------------------
/*
 * @doc 用户角色表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_role`;
create table `pre_user_role` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '角色名称',
    `description`   text comment '备注介绍',
    `level`         int unsigned default 0 comment '角色级别',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户角色表';

#----------pre_user_group表--------------------------------------------------------
/* 
 * @doc 用户组表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_user_group`;
create table `pre_user_group` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `group_name`    varchar(255) default '' comment '分组名称',
    `group_level`   int unsigned default 0 comment '分组级别',
    `description`   varchar(1023) comment '备注介绍',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否启用',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '用户组表';

