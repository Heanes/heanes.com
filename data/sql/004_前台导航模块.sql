use `heanes.com`;
#----------pre_navigation表--------------------------------------------------------
/* 
 * @doc 前台网站导航栏表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_navigation;
create table pre_navigation(
nav_id int unsigned auto_increment comment'自增ID，主键',
nav_parent_id int unsigned default 0 comment'父导航ID',
nav_name varchar(15) not null comment'导航栏名称',
nav_a_href varchar(255) comment'导航链接',
nav_a_title varchar(255) comment'',
nav_a_target tinyint unsigned comment'导航链接打开方式',
nav_img_src varchar(255) comment'导航链接图标地址',
nav_insert_time int(10) comment'导航创建时间',
nav_update_time int(10) comment'导航更新时间',
nav_sort int unsigned comment'排序',
nav_enable tinyint unsigned comment'是否启用（显示）',
primary key(nav_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'前台网站导航栏表';