use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_department表--------------------------------------------------------
/* 
 * @doc 部门表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department`;
create table `pre_department` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `pid`               int unsigned default 0 comment '所属父部门',
    `name`              varchar(255) default '' comment '部门名称',
    `english_name`      varchar(255) default '' comment '英文名称',
    `short_name`        varchar(255) default '' comment '部门名称缩写',
    `img_src`           varchar(255) default '' comment '部门图片logo地址',
    `description`       text comment '部门介绍',
    `manager_job_id`    int unsigned default 0 comment '部门管理职位ID，员工表中某员工的职位ID与此相同，则表明该员工为部门管理员',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint default 1 comment '是否有效',
    `is_deleted`        tinyint default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门表';

#----------pre_department_fields--------------------------------------------------------
/* 
 * @doc 部门额外数据字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department_fields`;
create table `pre_department_fields` (
    `id`                        int unsigned auto_increment comment '自增ID，主键',
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `value_unit`                varchar(255) default '' comment '值的单位',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `is_required`               tinyint unsigned default 0 comment '是否必须的',
    `allow_read_role`           varchar(255) default 0 comment '允许查看的角色ID,以逗号为分隔符',
    `allow_read_min_role_level` int unsigned default 0 comment '允许查看的最小角色ID',
    `as_filter`                 tinyint unsigned default 0 comment '是否作为筛选条件',
    `is_show`                   tinyint unsigned default 1 comment '是否显示',
    `order_number`              int unsigned default 0 comment '排序',
    `is_enable`                 tinyint unsigned default 1 comment '是否启用',
    `is_deleted`                tinyint unsigned default 0 comment '是否删除',
    `create_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门额外数据信息表';

#----------pre_department_fields_data--------------------------------------------------------
/*
 * @doc 部门额外数据表
 * @author Heanes
 * @time 2015-08-13 13:11:07
*/
drop table if exists `pre_department_fields_data`;
create table `pre_department_fields_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `borrow_id`     int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '借款属性值',
    `fields_price`  decimal(10, 2) comment '属性价格',
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
comment '部门额外数据信息表';

#----------pre_department_manager表--------------------------------------------------------
/*
 * @doc 部门管理员表 @todo 不一定要用，因为有职位表，可以根据用户部门ID和职位ID得知部门管理员
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_department_manager`;
create table `pre_department_manager` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `department_id` int unsigned default 0 comment '部门ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '插入时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '部门管理员表';

#----------pre_employee表--------------------------------------------------------
/* 
 * @doc 员工表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_employee`;
create table `pre_employee` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `user_id`       int unsigned default 0 comment '用户ID',
    `department_id` int unsigned default 0 comment '部门ID',
    `job_id`        int unsigned default 0 comment '职位ID',
    `leader_eid`    int unsigned default 0 comment '上级领导员工ID',
    `recommend_eid` int unsigned default 0 comment '推荐人员工ID',
    `apply_status`  tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
    `is_enable`     tinyint default 1 comment '是否有效',
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
comment '员工表';

#----------pre_employee_apply_status_log--------------------------------------------------------
/*
 * @doc 员工职位申请表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_employee_apply_status_log`;
create table `pre_employee_apply_status_log` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `employee_id`   int unsigned default 0 comment '用户ID',
    `actor_user_id` int unsigned default 0 comment '部门ID',
    `status`        tinyint default 0 comment '审核状态，0-审核中，1-通过，-1拒绝',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `create_user`   int unsigned default 0 comment '创建人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '员工职位申请状态操作记录表';

#----------pre_job表--------------------------------------------------------
/* 
 * @doc 职位表
 * @author Heanes
 * @time 2015-05-25 11:33:08
*/
drop table if exists `pre_job`;
create table `pre_job` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_id`   int unsigned default 0 comment '职位分类',
    `name`          varchar(255) default '' comment '职位名称',
    `code`          varchar(255) default '' comment '职位代码，一般即缩写',
    `description`   text comment '职位描述',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
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
comment '职位表';

#----------pre_job_category表--------------------------------------------------------
/* 
 * @doc 职位分类表
 * @author Heanes
 * @time 2015-05-25 11:33:08
*/
drop table if exists `pre_job_category`;
create table `pre_job_category` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_name` varchar(255) default '' comment '分类名称',
    `category_code` varchar(255) default '' comment '分类代码，一般即缩写',
    `description`   text comment '职位描述',
    `is_enable`     tinyint default 1 comment '是否有效',
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
comment '职位分类表';

