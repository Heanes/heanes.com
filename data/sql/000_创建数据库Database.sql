-- ----- 海利系统数据库创建脚本 --------------------------------------
/* 任务开始时间：2014.06.03
 * @author:Heanes
*/
#----------创建数据库 ---------------------------------------------------
/* 
 * @doc海利系统数据库
 * @author Heanes
 * @time 2015-01-09 11:53:57
*/
drop database if exists `heanes.com`;
create database if not exists `heanes.com` default character set utf8 collate utf8_general_ci;
use `heanes.com`;
show databases;
show tables;
show create database `heanes.com`;
