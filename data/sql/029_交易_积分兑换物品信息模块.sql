use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_ware表--------------------------------------------------------
/*
 * @doc 物品基本信息表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware`;
create table `pre_ware` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `category_id`       int unsigned default 0 comment '物品分类ID',
    `type_id`           int unsigned default 0 comment '类型ID',
    `name`              varchar(255) default '' comment '物品名称',
    `short_desc`        varchar(255) default '' comment '物品短描述',
    `serial`            varchar(64) default '' comment '物品序列号(平台)',
    `shop_price`        decimal(10, 2) default 0.00 comment '物品店铺价格(现价)',
    `original_price`    decimal(10, 2) default 0.00 comment '原价',
    `cost_price`        decimal(10, 2) default 0.00 comment '物品成本价',
    `market_price`      decimal(10, 2) default 0.00 comment '物品市面价格',
    `store_num`         int unsigned default 0 comment '物品库存数目',
    `total_sold_num`    int unsigned default 0 comment '物品已卖出总个数',
    `cover_img_src`     varchar(255) default '' comment '物品封面图片',
    `cover_img_title`   varchar(255) default '' comment '物品封面图片title值',
    `a_href`            varchar(255) default '' comment '物品可链接至外链',
    `a_title`           varchar(255) default '' comment '物品外链title值',
    `is_new`            tinyint unsigned default 1 comment '是否为新',
    `is_recommend`      tinyint unsigned default 0 comment '是否推荐',
    `is_top`            tinyint unsigned default 0 comment '是否置顶',
    `is_great`          tinyint unsigned default 0 comment '是否精品',
    `allow_comment`     tinyint unsigned default 1 comment '是否允许评论',
    `comment_num`       int unsigned default 0 comment '评论数',
    `comment_score`     smallint default 5 comment '文章评分，允许为负分',
    `read_num`          int unsigned default 1 comment '阅读次数',
    `click_count`       bigint unsigned default 1 comment '点击次数',
    `seo_title`         varchar(511) default '' comment 'SEO标题',
    `seo_keywords`      varchar(511) default '' comment 'SEO关键词',
    `seo_description`   varchar(511) default '' comment 'SEO描述',
    `description`       text comment '物品描述详情',
    `user_role_id`      int unsigned default 0 comment '物品查看用户角色',
    `user_rank`         int unsigned default 0 comment '物品查看用户积分',
    `access_password`   varchar(64) default '' comment '查看密码',
    `order_number`      int unsigned default 0 comment '排序',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 100001
default charset = `utf8`
comment '物品基本信息表';

#----------pre_ware_category表--------------------------------------------------------
/*
 * @doc 物品分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_category`;
create table `pre_ware_category` (
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
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品分类表';

#----------pre_ware_type--------------------------------------------------------
/*
 * @doc 物品类型表，将物品属性归为一类
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_type`;
create table `pre_ware_type` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '分类名称',
    `description`   varchar(1023) default '' comment '分类备注',
    `order_number`  int unsigned default 0 comment '排序',
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
comment '物品类型表，将物品属性归为一类';


#----------pre_ware_fields表--------------------------------------------------------
/*
 * @doc 物品属性名称字段表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_fields`;
create table `pre_ware_fields` (
    `id`                        int unsigned auto_increment comment '自增ID，主键',
    `type_id`                   int unsigned default 0 comment '类型ID，为0表示通用类型',
    `name`                      varchar(127) default '' comment '属性名称',
    `input_type`                varchar(15) default '' comment '属性输入类型',
    `input_value`               text comment '输入备选值',
    `accept_type`               varchar(255) default '' comment '允许上传的文件类型',
    `value_unit`                varchar(255) default '' comment '值的单位',
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
comment '物品属性名称字段表';

#----------pre_ware_fields_data--------------------------------------------------------
/*
 * @doc 物品属性映射表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_ware_fields_data`;
create table `pre_ware_fields_data` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `fields_id`     int unsigned default 0 comment '属性ID',
    `ware_id`       int unsigned default 0 comment '物品ID',
    `fields_value`  varchar(255) default '' comment '物品属性值',
    `fields_price`  decimal(10, 2) default 0.00 comment '属性价格',
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
comment '物品属性映射表';

#----------pre_ware_album表--------------------------------------------------------
/*
 * @doc物品相册表
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
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '物品相册表';

#----------pre_ware_collect--------------------------------------------------------
/*
 * @doc 积分商品收藏表
 * @author Heanes
 * @time 2015-09-11 09:55:51
*/
drop table if exists `pre_ware_collect`;
create table `pre_ware_ collect` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `ware_id`       int unsigned default 0 comment '产品ID',
    `user_id`       int unsigned default 0 comment '用户',
    `collect_time`  int(10) unsigned default 0 comment '收藏时间',
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
comment '积分商品收藏表';