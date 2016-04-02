use `heanes.com`;
set foreign_key_checks = 0;
#----------pre_admin_menu后台菜单表--------------------------------------------------------
/* 
 * @doc 后台菜单表，存储后台菜单
 * @author Heanes
 * @time 2015-01-09 11:53:13
*/
drop table if exists `pre_admin_menu`;
create table `pre_admin_menu` (
	`id`        int unsigned auto_increment comment '自增ID，主键',
	`parent_id` int unsigned comment '父菜单ID',
	`name`      varchar(255)     not null comment '菜单名称',
	`a_href`    varchar(511) comment '菜单链接地址',
	`a_title`   varchar(511) comment '菜单链接title值',
	`a_color`   varchar(12) comment '菜单链接颜色值',
	`img_src`   varchar(255) comment '菜单图片地址',
	`img_title` varchar(255) comment '菜单图片title值',
	`order`     int unsigned comment '排序',
	`is_enable` tinyint unsigned default 1 comment '是否启用',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台菜单表';

#----------pre_admin_menu_priv后台菜单权限表--------------------------------------------------------
/* 
 * @doc 后台菜单权限表，不同管理员角色对应不同权限的操作
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists `pre_admin_menu_privilege`;
create table `pre_admin_menu_privilege` (
	`id`           int unsigned auto_increment comment '自增ID，主键',
	`user_id`      int unsigned comment '管理员用户ID',
	`user_role_id` int unsigned comment '权限所需角色ID',
	`menu_id`      int unsigned comment '可操作菜单ID',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '后台菜单权限表';
