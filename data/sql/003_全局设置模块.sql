use `heanes.com`;
#----------pre_setting_common网站全局设置表--------------------------------------------------------
/* 
 * @doc 网站全局设置表，存储公共设置项
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_setting_common;
create table pre_setting_common(
setting_id int unsigned auto_increment comment'自增ID，主键',
setting_name varchar(255) comment'设置项名称',
setting_value varchar(255) comment'设置项值',
setting_type varchar(127) comment'设置输入形式',
setting_order int unsigned comment'排序',
setting_enable tinyint unsigned default 1 comment'是否启用',
primary key(setting_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'后台管理员用户角色权限表';