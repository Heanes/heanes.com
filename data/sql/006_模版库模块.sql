use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_template_category表--------------------------------------------------------
/* 
 * @doc 模版库分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_template_category`;
create table `pre_template_category` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `name`          varchar(63) comment '分类名称',
    `description`   text comment '备注介绍',
    `order`         int unsigned comment '分类排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) comment '分类创建时间',
    `update_time`   int(10) comment '分类最后更新时间',
    `create_user`   int unsigned comment '创建人',
    `update_user`   int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '模版库分类表';
#----------pre_template_library表--------------------------------------------------------
/* 
 * @doc 模版库表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_template_library`;
create table `pre_template_library` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `cateogry_id`       int unsigned comment '模版分类',
    `name`              varchar(63) comment '分类名称',
    `path`              varchar(255) comment '模版路径',
    `file_name`         varchar(127) comment '模版名称',
    `screenshot_src`    varchar(255) comment '模版截图图片路径',
    `description`       text comment '备注介绍',
    `order`             int unsigned comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `insert_time`       int(10) comment '插入时间',
    `update_time`       int(10) comment '更新时间',
    `create_user`       int unsigned comment '创建人',
    `update_user`       int unsigned comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '模版库表';