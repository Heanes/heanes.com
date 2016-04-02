use `heanes.com`;
set foreign_key_checks = 0;

/*
 * 建表必加字段及几个状态说明：
 * insert_time 基本要加
 * update_time 基本要加
 * is_enable 基本要加，有效状态，0-无效，1-有效
 * is_delete 基本要加，是否删除删除，0-删除，1-不删除
 * order 基本要加
 * 状态常量说明
 * 0-表示该字段逻辑上“不是的”，1-表示该字段逻辑上“成立”
 * 对于表示状态的字段，为空表示“未知”，0表示“否”状态，1表示“是”状态
 * 对于表示审核状态的字段，0为“审核中”，1表示“已通过”，-1表示“拒绝”
 */

#----------pre_表--------------------------------------------------------
/*
 * @doc
 * @author Heanes
 * @time 2015-02-09 14:19:41
*/
/*
drop table if exists `pre_`;
create table `pre_` (
	`id` int unsigned auto_increment comment '自增ID，主键',
	primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '';
*/