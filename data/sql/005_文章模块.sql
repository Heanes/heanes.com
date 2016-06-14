use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_article_category表--------------------------------------------------------
/* 
 * @doc 文章分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_category`;
create table `pre_article_category` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `parent_id`         int unsigned default 0 comment '父分类ID',
    `name`              varchar(63) default '' not null default '' comment '分类名称',
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
    `is_enable`         tinyint unsigned default 1 comment '是否有效',
    `is_deleted`        tinyint unsigned default 0 comment '是否已删除' comment '是否启用（显示）',
    `insert_time`       int(10) unsigned default 0 comment '创建时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章分类表';

#----------pre_article表--------------------------------------------------------
/* 
 * @doc 文章内容表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article`;
create table `pre_article` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '文章分类ID',
    `title`             varchar(1023) default '' not null default '' comment '文章标题',
    `subtitle`          varchar(255) default '' comment '文章副标题',
    `cover_img_src`     varchar(255) default '' comment '文章封面图片',
    `user_id`           int unsigned default 0 comment '文章作者（用户）ID',
    `user_link`         varchar(255) default '' comment '文章作者链接',
    `author`            varchar(127) default '' comment '文章作者笔名',
    `editor`            varchar(127) default '' comment '责任编辑',
    `origin_source`     varchar(255) default '' comment '文章来源，为空表示原创',
    `content`           text comment '文章内容',
    `keywords`          varchar(255) default '' comment '关键词',
    `tags`              varchar(255) default '' comment '标签ID，形如1,2,3以逗号分开',
    `semantic_a_href`   varchar(255) default '' comment '语义化链接',
    `a_href`            varchar(255) default '' comment '文章链接',
    `a_title`           varchar(255) default '' comment '文章链接标题',
    `title_bg_color`    varchar(20) default '#FFF' comment '文章标题背景颜色',
    `content_bg_color`  varchar(20) default '#FFF' comment '文章内容背景颜色',
    `template_id`       int unsigned default 0 comment '文章模版ID',
    `is_new`            tinyint unsigned default 1 comment '是否为新发布文章',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '文章评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment '文章SEO标题',
    `seo_keywords`      varchar(511) default '' comment '文章SEO关键词',
    `seo_description`   varchar(511) default '' comment '文章SEO描述',
    `user_role_id`      smallint unsigned default 1 comment '文章阅读用户权限',
    `user_rank`         int unsigned default 1 comment '文章阅读用户积分',
    `access_password`   varchar(64) default '' comment '阅读密码',
    `order_number`      int default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `insert_time`       int(10) unsigned default 0 comment '文章创建时间',
    `update_time`       int(10) unsigned default 0 comment '文章更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章内容表';

#----------pre_article_comment表--------------------------------------------------------
/* 
 * @doc 文章评论表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_comment`;
create table `pre_article_comment`(
    `id`          int unsigned auto_increment comment '自增ID，主键',
    `article_id`  int unsigned default 0 comment '被评论文章ID',
    `parent_id`   int unsigned default 0 comment '父评论，“盖楼”形式',
    `user_id`     int unsigned default 0 comment '评论人用户ID',
    `user_name`   varchar(255) default '' comment '评论人名称，若未注册用户评论，可以使用此字段作为临时用户名',
    `email`       varchar(255) default '' comment '评论人Email',
    `web_link`    varchar(255) default '' comment '评论人网站地址',
    `title`       varchar(1023) default '' comment '评论标题',
    `content`     text comment '评论内容',
    `score`       smallint default 5 comment '评分',
    `ip`          varchar(40) default '' comment '评论人IP，兼容IPv6',
    `isp`         varchar(255) default '' comment '评论人IP对应IPS提供商',
    `location`    varchar(255) default '' comment '评论人IP对应地理位置',
    `is_hot`      tinyint unsigned default 0 comment '是否热门',
    `is_top`      tinyint unsigned default 0 comment '是否置顶',
    `order_number`int unsigned default 0 comment '排序',
    `is_enable`   tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`  tinyint unsigned default 0 comment '是否已删除',
    `insert_time` int(10) unsigned default 0 comment '评论时间',
    `update_time` int(10) unsigned default 0 comment '评论更新时间',
    `create_user` int unsigned default 0 comment '创建人',
    `update_user` int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章评论表';

#----------pre_article_praise表--------------------------------------------------------
/*
 * @doc 文章点赞表
 * @author Heanes
 * @time 2015-06-24 09:48:28
*/
drop table if exists `pre_article_praise`;
create table `pre_article_praise`(
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `article_id`    int unsigned default 0 comment '被点赞文章ID',
    `user_id`       int unsigned default 0 comment '用户ID',
    `is_enable`     tinyint unsigned default 1 comment '是否启用（显示）',
    `is_deleted`    tinyint unsigned default 0 comment '是否已删除',
    `insert_time`   int(10) unsigned default 0 comment '点赞时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章点赞表';

#----------pre_article_favourite表--------------------------------------------------------
/*
 * @doc 文章收藏表
 * @author Heanes
 * @time 2015-06-24 09:48:28
*/
drop table if exists `pre_article_collect`;
create table `pre_article_collect` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `article_id`    int unsigned default 0 comment '文章ID',
    `user_id`       int unsigned default 0 comment '用户',
    `collect_time`  int(10) comment '收藏时间',
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
comment '文章收藏表';

#----------pre_article_comment_judge--------------------------------------------------------
/*
 * @doc 文章评论意见表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_comment_judge`;
create table `pre_article_comment_judge`(
    `id`                    int unsigned auto_increment comment '自增ID，主键',
    `article_comment_id`    int unsigned default 0 comment '文章评论ID',
    `user_id`               int unsigned default 0 comment '用户ID',
    `user_ip`               varchar(40) default '' comment '评论人IP，兼容IPv6',
    `type`                  smallint default 0 comment '操作类型，1-支持，-1反对，2-举报',
    `reason`                varchar(1023) default '' comment '操作原因',
    `order_number`          int unsigned default 0 comment '排序',
    `is_enable`             tinyint unsigned default 1 comment '是否有效',
    `is_deleted`            tinyint unsigned default 0 comment '是否已删除',
    `insert_time`           int(10) unsigned default 0 comment '操作时间',
    `update_time`           int(10) unsigned default 0 comment '更新时间',
    `create_user`           int unsigned default 0 comment '创建人',
    `update_user`           int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章评论意见表(支持，反对，举报)';

#----------pre_article_album--------------------------------------------------------
/*
 * @doc 文章相册表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_article_album`;
create table `pre_article_album` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `object_id`     int unsigned default 0 comment '对象ID，指外键',
    `name`          varchar(255) default '' comment '图片显示名称',
    `file_name`     varchar(255) default '' comment '图片实际存储名称',
    `a_href`        varchar(255) default '' comment '链接地址',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `insert_time`   int(10) unsigned default 0 comment '图片添加时间',
    `update_time`   int(10) unsigned default 0 comment '图片更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '文章相册表';