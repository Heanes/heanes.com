use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_borrow--------------------------------------------------------
/*
 * @doc 借款记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow`;
create table `pre_borrow` (
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `uid_master`            int unsigned default 0 comment '业务主ID',
    `uid_slave`             int unsigned default 0 comment '业务客ID',
    `usage_id`              int unsigned default 0 comment '贷款用途（标识ID），从借款用途表中取得',
    `usage_info`            text comment '借款用途备注',
    `total`                 float default 0.0 comment '贷款额度',
    `year_limit`            varchar(255) default '' comment '贷款年限，带单位，1d-天，2m-2个月，3y-3年',
    `rate`                  float default 0.0 comment '利息',
    `get_money_limit_time`  int(10) unsigned default 0 comment '贷款成功截止期限',
    `get_money_time`        int(10) unsigned default 0 comment '放款时间',
    `repay_money_time`      int(10) unsigned default 0 comment '还款时间',
    `has_colleague`         tinyint unsigned default 0 comment '是否有同行',
    `apply_time`            int(10) unsigned default 0 comment '贷款申请时间（发布时间）',
    `apply_status`          tinyint default 0 comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
    `apply_update_time`     int(10) unsigned default 0 comment '贷款申请最后更新时间',
    `progress_status`       smallint default 0 comment '进行状态，1-下户，2-评级，3-做卷，3-资料审核，4-批贷函，5-贷后管理（开始放款）',
    `progress_update_time`  int(10) unsigned default 0 comment '最后更新时间',
    `order_number`          int unsigned default 0 comment '排序',
    `is_enable`             tinyint default 1 comment '是否有效',
    `is_deleted`            tinyint default 0 comment '是否删除',
    `insert_time`           int(10) unsigned default 0 comment '插入时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款申请表';

#----------pre_borrow_apply_status_log--------------------------------------------------------
/*
 * @doc 借款申请记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_apply_status_log`;
create table `pre_borrow_apply_status_log` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `jk_id`         int unsigned default 0 comment '业务主ID',
    `actor_user_id` int unsigned default 0 comment '操作人ID',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `status`        tinyint default 0 comment '贷款申请状态，0-审核中，1-已通过，2-已拒绝',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '插入时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款申请记录表';

#----------pre_borrow_progress--------------------------------------------------------
/*
 * @doc 借款记录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_progress`;
create table `pre_borrow_progress` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `jk_id`         int unsigned default 0 comment '业务主ID',
    `actor_user_id` int unsigned default 0 comment '操作人ID',
    `reason`        text comment '处理原因',
    `description`   text comment '操作留下的备注信息,留给系统查看',
    `status`        smallint default 0 comment '贷款进行状态，1-下户，2-评级，3-做卷，4-资料审核，5-批贷函，6-贷后管理（开始放款）',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '进度插入时间',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款进度表';

#----------pre_borrow_category表--------------------------------------------------------
/*
 * @doc 借款分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_category`;
create table `pre_borrow_category` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(255) default '' comment '分类名称',
    `description`       varchar(1023) default '' comment '分类备注',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接title值',
    `img_src`           varchar(255) default '' comment '分类图标地址',
    `img_title`         varchar(255) default '' comment '分类图标title值',
    `user_role_id`      smallint unsigned default 0 comment '分类访问用户组权限',
    `user_rank`         int unsigned default 0 comment '分类访问用户积分',
    `access_password`   varchar(64) default '' comment '分类访问密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `insert_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款分类表';

#----------pre_borrow_type--------------------------------------------------------
/*
 * @doc 借款类型表，将借款属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_type`;
create table `pre_borrow_type` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
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
comment '借款类型表，将借款属性归为一类';

#----------pre_borrow_fields表--------------------------------------------------------
/*
 * @doc 借款属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_fields`;
create table `pre_borrow_fields` (
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
    `insert_time`               int(10) unsigned default 0 comment '添加时间',
    `update_time`               int(10) unsigned default 0 comment '更新时间',
    `create_user`               int unsigned default 0 comment '创建人',
    `update_user`               int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款属性名称字段表';

#----------pre_borrow_fields_data--------------------------------------------------------
/*
 * @doc 借款属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_fields_data`;
create table `pre_borrow_fields_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `borrow_id`     int unsigned default 0 comment '类型ID，为0表示通用类型',
    `fields_value`  varchar(255) default '' comment '借款属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '属性添加时间',
    `update_time`   int(10) unsigned default 0 comment '属性更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款属性映射表';

#----------pre_borrow_album表--------------------------------------------------------
/*
 * @doc借款相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_album`;
create table `pre_borrow_album` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
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
comment '借款相册表';


#----------pre_borrow_usage--------------------------------------------------------
/*
 * @doc 借款用途表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_borrow_usage`;
create table `pre_borrow_usage` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '借款用途',
    `code`          varchar(255)comment '代码',
    `description`   text comment '描述',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint default 1 comment '是否有效',
    `is_deleted`    tinyint default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '借款用途表';

