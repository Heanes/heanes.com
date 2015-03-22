use `heanes.com`;
#----------pre_template_category表--------------------------------------------------------
/* 
 * @doc 模版库分类表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_template_category;
create table pre_template_category(
tpl_category_id int unsigned auto_increment comment'自增ID，主键',
tpl_category_parent_id int unsigned default 0 comment'父分类ID',
tpl_category_name varchar(63) comment'分类名称',
tpl_category_comment varchar(255) comment'分类备注信息',
tpl_category_insert_time int(10) comment'分类创建时间',
tpl_category_update_time int(10) comment'分类最后更新时间',
tpl_category_order int unsigned comment'分类排序',
tpl_category_enable tinyint unsigned default 1 comment'是否启用',
primary key(tpl_category_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'模版库分类表';
#----------pre_template_library表--------------------------------------------------------
/* 
 * @doc 模版库表
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_template_library;
create table pre_template_library(
tpl_id int unsigned auto_increment comment'自增ID，主键',
tpl_cateogry_id int unsigned comment'模版分类',
tpl_name varchar(63) comment'分类名称',
tpl_path varchar(255) comment'模版路径',
tpl_file_name varchar(127) comment'模版名称',
tpl_screenshot_src varchar(255) comment'模版截图图片路径',
tpl_comment varchar(255) comment'模版备注信息',
tpl_insert_time int(10) comment'插入时间',
tpl_update_time int(10) comment'更新时间',
tpl_order int unsigned comment'排序',
tpl_enable tinyint unsigned default 1 comment'是否启用',
primary key(tpl_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'模版库表';