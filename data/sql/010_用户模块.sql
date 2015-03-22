#----------pre_users用户信息表--------------------------------------------------------
/* @doc 用户信息表，包含基本信息
 * @author 方刚
 * @time 2015-01-09 11:53:13
*/
set foreign_key_checks = 0;
drop table if exists pre_users;
create table pre_users(
user_id int unsigned auto_increment comment'编号',
user_name varchar(20) comment'用户名',

primary key(user_id)
)engine = innodb auto_increment = 1001 default charset=utf8 comment'用户信息表';
