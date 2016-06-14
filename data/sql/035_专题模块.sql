use `heanes.com`;
set foreign_key_checks = 0;

#----------pre_special_category--------------------------------------------------------
/*
 * @doc 专题分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_category`;
create table `pre_special_category` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(63) not null default '' comment '分类名称',
    `code`              varchar(63) default '' comment 'code',
    `template_id`       int unsigned default 0 comment '分类模版ID',
    `a_href`            varchar(255) default '' comment '分类链接',
    `a_title`           varchar(255) default '' comment '分类链接标题',
    `img_src`           varchar(255) default '' comment '分类图标',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   text comment 'SEO描述',
    `description`       text comment '分类介绍',
    `user_role_id`      smallint unsigned default 0 comment '分类阅读用户角色权限',
    `user_rank`         int unsigned default 0 comment '分类阅读用户积分',
    `access_password`   varchar(64) default '' comment '分类阅读密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
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
comment '专题分类表';

#----------pre_special--------------------------------------------------------
/*
 * @doc 专题表
 * @author Heanes
 * @time 2015-08-26 14:11:33
*/
drop table if exists `pre_special`;
create table `pre_special` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '专题分类ID',
    `title`             varchar(1023) not null default '' comment '专题标题',
    `subtitle`          varchar(255) default '' comment '专题副标题',
    `cover_img_src`     varchar(255) default '' comment '专题封面图片',
    `user_id`           int unsigned default 0 comment '专题作者（用户）ID',
    `user_link`         varchar(255) default '' comment '专题作者链接',
    `author`            varchar(127) default '' comment '专题作者笔名',
    `editor`            varchar(127) default '' comment '责任编辑',
    `origin_source`     varchar(255) default '' comment '专题来源，为空表示原创',
    `content`           text comment '专题内容',
    `keywords`          varchar(255) default '' comment '关键词',
    `tags`              varchar(255) default '' comment '标签ID，形如1,2,3以逗号分开',
    `semantic_a_href`   varchar(255) default '' comment '语义化链接',
    `a_href`            varchar(255) default '' comment '专题链接',
    `a_title`           varchar(255) default '' comment '专题链接标题',
    `title_bg_color`    varchar(20) default '#FFF' comment '专题标题背景颜色',
    `content_bg_color`  varchar(20) default '#FFF' comment '专题内容背景颜色',
    `template_id`       int unsigned default 0 comment '专题模版ID',
    `template_path`     varchar(255) default '' comment '专题模版路径',
    `template_file`     varchar(255) default '' comment '专题模版文件名称',
    `is_new`            tinyint unsigned default 1 comment '是否为新发布专题',
    `is_promot`         tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '专题评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment '专题SEO标题',
    `seo_keywords`      varchar(511) default '' comment '专题SEO关键词',
    `seo_description`   varchar(511) default '' comment '专题SEO描述',
    `user_role_id`      smallint unsigned default 0 comment '专题阅读用户权限',
    `user_rank`         int unsigned default 0 comment '专题阅读用户积分',
    `access_password`   varchar(64) default '' comment '阅读密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `insert_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '专题表';

#----------pre_special_album表--------------------------------------------------------
/*
 * @doc 专题相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_album`;
create table `pre_ware_album` (
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
comment '专题相册表';

use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_special_template_category--------------------------------------------------------
/*
 * @doc 模版库分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_template_category`;
create table `pre_special_template_category` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `name`          varchar(63) default '' comment '分类名称',
    `description`   text comment '备注介绍',
    `order_number`  int unsigned default 0 comment '分类排序',
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
comment '专题模版库分类表';
#----------pre_special_template_library--------------------------------------------------------
/*
 * @doc 模版库表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_special_template_library`;
create table `pre_special_template_library` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `cateogry_id`       int unsigned default 0 comment '模版分类',
    `name`              varchar(63) default '' comment '分类名称',
    `path`              varchar(255) default '' comment '模版路径',
    `file_name`         varchar(127) default '' comment '模版名称',
    `screenshot_src`    varchar(255) default '' comment '模版截图图片路径',
    `description`       text comment '备注介绍',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
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
comment '专题模版库表';