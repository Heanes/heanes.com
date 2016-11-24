use `heanes.com`;
/*
 * @doc 显示表字段结构
 * @author Heanes
 * @time 2015-07-04 10:32:05
 */
DESCRIBE `pre_users`;
desc `pre_users`;
show columns from `pre_users`;
/**
 * @doc 显示建表语句
 * @author Heanes
 * @time 2015-07-46 11:00:57
 */
show create table `pre_users`;

/**
 * @doc 获取某个表的自增ID
 * @author Heanes
 * @time 2015-07-04 10:55:29
 */
SHOW TABLE STATUS WHERE `name`='pre_article';
SHOW TABLE STATUS LIKE 'pre_article';
SELECT auto_increment FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA`='heanes.com' AND `TABLE_NAME`='pre_users';

/**
 * @doc 修改表字段结构
 * @author Heanes
 * @time 2015-07-06 11:02:24
 */

/**
 * @doc 修改表数据
 * @author Heanes
 * @time 2015-07-06 11:03:08
 */

 /**
 * @doc 添加数据入表
 * @author Heanes
 * @time 2015-07-06 11:03:08
 */

/**
 * @doc 删除表数据
 * @author Heanes
 * @time 2015-07-06 11:03:08
 */


/**
 * @doc 添加一个用户
 * @author Heanes
 * @time 2015-07-29 11:10:34
 */
/*
create user 'web_user_heanes.com'@'%'
	identified by 'p()P]aHqCEfwVY@7';

grant all privileges on `heanes.com`.* to 'web_user_heanes.com'@'%'
identified by 'p()P]aHqCEfwVY@7'
with grant option;
Flush privileges;

create user 'user_web_r'@'%'
identified by '123456';

grant select on *.* to 'user_web_r'@'%'
identified by '123456'
with grant option;
Flush privileges;
*/

/**
 * @doc 添加主从数据库
 * @author Heanes
 * @time 2015-08-18 16:27:41
 */
/*
create user 'replication'@'localhost'
	identified by 'p()P]aHqCEfwVY@7';
grant all privileges on *.* to 'replication'@'localhost'
identified by 'p()P]aHqCEfwVY@7'
with grant option;
flush privileges;
*/

# 配置从数据库命令(Windows环境)
#change master to master_host='123.57.208.51',master_user='replication',master_password='p()P]aHqCEfwVY@7',master_port=3306,master_connect_retry=10;