use `heanes.com`;
#----------pre_admin_user后台菜单表--------------------------------------------------------
/* 
 * @doc 后台菜单表，存储后台菜单
 * @author Heanes
 * @time 2015-01-09 11:53:13
*/
set foreign_key_checks = 0;
drop table if exists pre_admin_user;
create table pre_admin_user(
admin_user_id int unsigned auto_increment comment'自增ID，主键',
admin_user_name varchar(63) comment'管理员用户名',
admin_user_pwd varchar(64) not null comment'管理员密码',
admin_user_email varchar(255) comment'管理员邮箱',
admin_user_role_id int unsigned comment'管理员权限角色ID',
admin_user_role_name varchar(63) comment'管理员权限角色名称',
admin_user_create_time int(10) comment'管理员创建时间',
admin_user_update_time int(10) comment'管理员资料最后更新时间',
admin_allow_login tinyint unsigned comment'是否允许登录',
admin_login_times int unsigned not null comment'登录次数',
admin_user_last_login_time int(10) comment'最后登陆时间',
admin_user_current_login_time int(10) comment'当前登陆时间',
admin_user_current_login_ip varchar(255) comment'当前登录IP',
admin_user_last_login_ip varchar(255) comment'上次登录IP',
primary key(admin_user_id)
)engine=innodb auto_increment = 1 default charset=utf8 comment'后台管理员用户表';

#----------pre_admin_role后台管理员用户角色权限表--------------------------------------------------------
/* 
 * @doc 后台菜单用户角色权限表，不同角色不同名称
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
drop table if exists pre_admin_role;
create table pre_admin_role(
admin_role_id int unsigned auto_increment comment'自增ID，主键',
admin_role_code varchar(63) comment'权限code',
admin_role_name varchar(63) comment'权限角色名称',
admin_role_order int unsigned comment'排序',
admin_role_enable tinyint unsigned default 1 comment'是否启用',
primary key(admin_role_id)
)engine=innodb auto_increment=1 default charset=utf8 comment'后台管理员用户角色权限表';